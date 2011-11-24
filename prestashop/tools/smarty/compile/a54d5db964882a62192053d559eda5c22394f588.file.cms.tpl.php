<?php /* Smarty version Smarty-3.0.7, created on 2011-11-24 10:47:03
         compiled from "C:\wamp\www\prestashop/themes/theme001/cms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214324ece129728dae9-75786746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a54d5db964882a62192053d559eda5c22394f588' => 
    array (
      0 => 'C:\\wamp\\www\\prestashop/themes/theme001/cms.tpl',
      1 => 1322128019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214324ece129728dae9-75786746',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
	<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>$_smarty_tpl->getVariable('cms')->value->meta_title),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
	<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./binding_top.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php if ($_smarty_tpl->getVariable('cms')->value){?>
	<div class="rte<?php if ($_smarty_tpl->getVariable('content_only')->value){?> content_only<?php }?>">
		<?php echo $_smarty_tpl->getVariable('cms')->value->content;?>

	</div>
<?php }else{ ?>
	<?php echo smartyTranslate(array('s'=>'This page does not exist.'),$_smarty_tpl);?>

<?php }?>
<br />
<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
	<p><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/home.gif" alt="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
" class="icon" /></a><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
</a></p>
<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./binding_bottom.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>