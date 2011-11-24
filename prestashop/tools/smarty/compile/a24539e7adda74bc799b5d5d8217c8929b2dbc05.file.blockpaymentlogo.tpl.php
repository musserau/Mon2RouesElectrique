<?php /* Smarty version Smarty-3.0.7, created on 2011-11-24 10:44:35
         compiled from "C:\wamp\www\prestashop/modules/blockpaymentlogo/blockpaymentlogo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:271394ece12031bc004-83300370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a24539e7adda74bc799b5d5d8217c8929b2dbc05' => 
    array (
      0 => 'C:\\wamp\\www\\prestashop/modules/blockpaymentlogo/blockpaymentlogo.tpl',
      1 => 1306138304,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '271394ece12031bc004-83300370',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Block payment logo module -->
<div id="paiement_logo_block_left" class="paiement_logo_block">
	<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getCMSLink($_smarty_tpl->getVariable('cms_payement_logo')->value);?>
">
		<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo_paiement_visa.jpg" alt="visa" width="33" height="21" />
		<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo_paiement_mastercard.jpg" alt="mastercard" width="32" height="21" />
		<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
logo_paiement_paypal.jpg" alt="paypal" width="61" height="21" />
	</a>
</div>
<!-- /Block payment logo module -->