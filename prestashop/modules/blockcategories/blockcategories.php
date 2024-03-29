<?php
/*
* 2007-2011 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 8783 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class BlockCategories extends Module
{
	public function __construct()
	{
		$this->name = 'blockcategories';
		$this->tab = 'front_office_features';
		$this->version = '2.0';
		$this->author = 'PrestaShop';

		parent::__construct();

		$this->displayName = $this->l('Categories block');
		$this->description = $this->l('Adds a block featuring product categories.');
	}

	public function install()
	{
		if (!parent::install() OR
			!$this->registerHook('leftColumn') OR
			!$this->registerHook('header') OR
			// Temporary hooks. Do NOT hook any module on it. Some CRUD hook will replace them as soon as possible.
			!$this->registerHook('categoryAddition') OR
			!$this->registerHook('categoryUpdate') OR
			!$this->registerHook('categoryDeletion') OR
			!$this->registerHook('afterSaveAdminMeta') OR
			!Configuration::updateValue('BLOCK_CATEG_MAX_DEPTH', 3) OR
			!Configuration::updateValue('BLOCK_CATEG_DHTML', 1))
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall() OR
			!Configuration::deleteByName('BLOCK_CATEG_MAX_DEPTH') OR
			!Configuration::deleteByName('BLOCK_CATEG_DHTML'))
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitBlockCategories'))
		{
			$maxDepth = (int)(Tools::getValue('maxDepth'));
			$dhtml = Tools::getValue('dhtml');
			$nbrColumns = Tools::getValue('nbrColumns',4);
			if ($maxDepth < 0)
				$output .= '<div class="alert error">'.$this->l('Maximum depth: Invalid number.').'</div>';
			elseif ($dhtml != 0 AND $dhtml != 1)
				$output .= '<div class="alert error">'.$this->l('Dynamic HTML: Invalid choice.').'</div>';
			else
			{
				Configuration::updateValue('BLOCK_CATEG_MAX_DEPTH', (int)($maxDepth));
				Configuration::updateValue('BLOCK_CATEG_DHTML', (int)($dhtml));
				Configuration::updateValue('BLOCK_CATEG_NBR_COLUMN_FOOTER', $nbrColumns);
				$this->_clearBlockcategoriesCache();
				$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
			}
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		return '
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Maximum depth').'</label>
				<div class="margin-form">
					<input type="text" name="maxDepth" value="'.Configuration::get('BLOCK_CATEG_MAX_DEPTH').'" />
					<p class="clear">'.$this->l('Set the maximum depth of sublevels displayed in this block (0 = infinite)').'</p>
				</div>
				<label>'.$this->l('Dynamic').'</label>

				<div class="margin-form">
					<input type="radio" name="dhtml" id="dhtml_on" value="1" '.(Tools::getValue('dhtml', Configuration::get('BLOCK_CATEG_DHTML')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="dhtml" id="dhtml_off" value="0" '.(!Tools::getValue('dhtml', Configuration::get('BLOCK_CATEG_DHTML')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p class="clear">'.$this->l('Activate dynamic (animated) mode for sublevels').'</p>
				</div>
				<label>'.$this->l('Footer columns number').'</label>			
				<div class="margin-form">
					<input type="text" name="nbrColumns" value="'.Configuration::get('BLOCK_CATEG_NBR_COLUMN_FOOTER').'" />
					<p class="clear">'.$this->l('Set the number of footer columns').'</p>
				</div>
				<center><input type="submit" name="submitBlockCategories" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
	}

	public function getTree($resultParents, $resultIds, $maxDepth, $id_category = 1, $currentDepth = 0)
	{
		global $link;

		$children = array();
		if (isset($resultParents[$id_category]) AND sizeof($resultParents[$id_category]) AND ($maxDepth == 0 OR $currentDepth < $maxDepth))
			foreach ($resultParents[$id_category] as $subcat)
				$children[] = $this->getTree($resultParents, $resultIds, $maxDepth, $subcat['id_category'], $currentDepth + 1);
		if (!isset($resultIds[$id_category]))
			return false;
		return array('id' => $id_category, 'link' => $link->getCategoryLink($id_category, $resultIds[$id_category]['link_rewrite']),
					 'name' => $resultIds[$id_category]['name'], 'desc'=> $resultIds[$id_category]['description'],
					 'children' => $children);
	}

	public function hookLeftColumn($params)
	{
		global $smarty, $cookie;

		$id_customer = (int)($params['cookie']->id_customer);
		// Get all groups for this customer and concatenate them as a string: "1,2,3..."
		// It is necessary to keep the group query separate from the main select query because it is used for the cache
		$groups = $id_customer ? implode(', ', Customer::getGroupsStatic($id_customer)) : _PS_DEFAULT_CUSTOMER_GROUP_;
		$id_product = (int)(Tools::getValue('id_product', 0));
		$id_category = (int)(Tools::getValue('id_category', 0));
		$id_lang = (int)($params['cookie']->id_lang);
		$smartyCacheId = 'blockcategories|'.$groups.'_'.$id_lang.'_'.$id_product.'_'.$id_category;

		Tools::enableCache();
		if (!$this->isCached('blockcategories.tpl', $smartyCacheId))
		{
			$maxdepth = Configuration::get('BLOCK_CATEG_MAX_DEPTH');
			if (!$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
				SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
				FROM `'._DB_PREFIX_.'category` c
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)
				WHERE (c.`active` = 1 OR c.`id_category` = 1)
				'.((int)($maxdepth) != 0 ? ' AND `level_depth` <= '.(int)($maxdepth) : '').'
				AND cg.`id_group` IN ('.pSQL($groups).')
				GROUP BY id_category
				ORDER BY `level_depth` ASC, c.`position` ASC')
			)
				return;
				
			$resultParents = array();
			$resultIds = array();

			foreach ($result as &$row)
			{
				$resultParents[$row['id_parent']][] = &$row;
				$resultIds[$row['id_category']] = &$row;
			}

			$blockCategTree = $this->getTree($resultParents, $resultIds, Configuration::get('BLOCK_CATEG_MAX_DEPTH'));
			unset($resultParents);
			unset($resultIds);
			$isDhtml = (Configuration::get('BLOCK_CATEG_DHTML') == 1 ? true : false);

			if (Tools::isSubmit('id_category'))
			{
				$cookie->last_visited_category = $id_category;
				$smarty->assign('currentCategoryId', $cookie->last_visited_category);
			}
			if (Tools::isSubmit('id_product'))
			{
				if (!isset($cookie->last_visited_category) OR !Product::idIsOnCategoryId($id_product, array('0' => array('id_category' => $cookie->last_visited_category))))
				{
					$product = new Product($id_product);
					if (isset($product) AND Validate::isLoadedObject($product))
						$cookie->last_visited_category = (int)($product->id_category_default);
				}
				$smarty->assign('currentCategoryId', (int)($cookie->last_visited_category));
			}
			$smarty->assign('blockCategTree', $blockCategTree);

			if (file_exists(_PS_THEME_DIR_.'modules/blockcategories/blockcategories.tpl'))
				$smarty->assign('branche_tpl_path', _PS_THEME_DIR_.'modules/blockcategories/category-tree-branch.tpl');
			else
				$smarty->assign('branche_tpl_path', _PS_MODULE_DIR_.'blockcategories/category-tree-branch.tpl');
			$smarty->assign('isDhtml', $isDhtml);
		}
		$smarty->cache_lifetime = 31536000; // 1 Year
		$display = $this->display(__FILE__, 'blockcategories.tpl', $smartyCacheId);
		Tools::restoreCacheSettings();
		return $display;
	}

	public function hookFooter($params)
	{
		global $smarty, $cookie;

		$id_customer = (int)($params['cookie']->id_customer);
		// Get all groups for this customer and concatenate them as a string: "1,2,3..."
		$groups = $id_customer ? implode(', ', Customer::getGroupsStatic($id_customer)) : _PS_DEFAULT_CUSTOMER_GROUP_;
		$id_product = (int)(Tools::getValue('id_product', 0));
		$id_category = (int)(Tools::getValue('id_category', 0));
		$id_lang = (int)($params['cookie']->id_lang);
		$smartyCacheId = 'blockcategories|'.$groups.'_'.$id_lang.'_'.$id_product.'_'.$id_category;

		Tools::enableCache();
		if (!$this->isCached('blockcategories_footer.tpl', $smartyCacheId))
		{
			$maxdepth = Configuration::get('BLOCK_CATEG_MAX_DEPTH');

			if (!$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
				SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
				FROM `'._DB_PREFIX_.'category` c
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)
				WHERE (c.`active` = 1 OR c.`id_category` = 1)
				'.((int)($maxdepth) != 0 ? ' AND `level_depth` <= '.(int)($maxdepth) : '').'
				AND cg.`id_group` IN ('.pSQL($groups).')
				ORDER BY `level_depth` ASC, c.`position` ASC')
			)
				return;
			$resultParents = array();
			$resultIds = array();

			foreach ($result as &$row)
			{
				$resultParents[$row['id_parent']][] = &$row;
				$resultIds[$row['id_category']] = &$row;
			}
			//$nbrColumns = Configuration::get('BLOCK_CATEG_NBR_COLUMNS_FOOTER');
			$nbrColumns = Configuration::get('BLOCK_CATEG_NBR_COLUMN_FOOTER');
			if (!$nbrColumns)
				$nbrColumns=3;
			$numberColumn = abs(sizeof($result)/$nbrColumns);
			$widthColumn= floor(100/$nbrColumns);
			$smarty->assign('numberColumn', $numberColumn);
			$smarty->assign('widthColumn', $widthColumn);
			
			$blockCategTree = $this->getTree($resultParents, $resultIds, Configuration::get('BLOCK_CATEG_MAX_DEPTH'));
			unset($resultParents);
			unset($resultIds);
			$isDhtml = (Configuration::get('BLOCK_CATEG_DHTML') == 1 ? true : false);

			if (Tools::isSubmit('id_category'))
			{
				$cookie->last_visited_category = $id_category;
				$smarty->assign('currentCategoryId', $cookie->last_visited_category);
			}
			if (Tools::isSubmit('id_product'))
			{
				if (!isset($cookie->last_visited_category) OR !Product::idIsOnCategoryId($id_product, array('0' => array('id_category' => $cookie->last_visited_category))))
				{
					$product = new Product($id_product);
					if (isset($product) AND Validate::isLoadedObject($product))
						$cookie->last_visited_category = (int)($product->id_category_default);
				}
				$smarty->assign('currentCategoryId', (int)($cookie->last_visited_category));
			}
			$smarty->assign('blockCategTree', $blockCategTree);

			if (file_exists(_PS_THEME_DIR_.'modules/blockcategories/blockcategories_footer.tpl'))
				$smarty->assign('branche_tpl_path', _PS_THEME_DIR_.'modules/blockcategories/category-tree-branch.tpl');
			else
				$smarty->assign('branche_tpl_path', _PS_MODULE_DIR_.'blockcategories/category-tree-branch.tpl');
			$smarty->assign('isDhtml', $isDhtml);
		}
		$smarty->cache_lifetime = 31536000; // 1 Year
		$display = $this->display(__FILE__, 'blockcategories_footer.tpl', $smartyCacheId);
		Tools::restoreCacheSettings();
		return $display;
	}

	public function hookRightColumn($params)
	{
		return $this->hookLeftColumn($params);
	}

	public function hookHeader()
	{
		Tools::addJS(_THEME_JS_DIR_.'tools/treeManagement.js');
		Tools::addCSS(($this->_path).'blockcategories.css', 'all');
	}

	private function _clearBlockcategoriesCache()
	{
		$this->_clearCache('blockcategories.tpl');
		Tools::restoreCacheSettings();
	}

	public function hookCategoryAddition($params)
	{
		$this->_clearBlockcategoriesCache();
	}

	public function hookCategoryUpdate($params)
	{
		$this->_clearBlockcategoriesCache();
	}

	public function hookCategoryDeletion($params)
	{
		$this->_clearBlockcategoriesCache();
	}
	
	public function hookAfterSaveAdminMeta($params)
	{
		$this->_clearBlockcategoriesCache();
	}
}
