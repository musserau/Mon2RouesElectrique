<?php /* Smarty version Smarty-3.0.7, created on 2011-11-24 10:32:18
         compiled from "C:\wamp\www\prestashop/modules/jqueryslider/jqueryslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197594ece0f22197588-95364162%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a81a239cb27969c718f80f26ea5bf4837c60c5ba' => 
    array (
      0 => 'C:\\wamp\\www\\prestashop/modules/jqueryslider/jqueryslider.tpl',
      1 => 1321620686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197594ece0f22197588-95364162',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<!-- MODULE JQuerySlider Galery -->
<!-- www.tiendasvirtuales.com.ve -->

     <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
css/default/default.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
css/pascal/pascal.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
css/orman/orman.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
css/nivo-slider.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
css/style.css" type="text/css" media="screen" />

 <div class="slider-wrapper theme-default">
     <div class="ribbon"></div>
     <div id="slider" class="nivoSlider">
	  
          <?php  $_smarty_tpl->tpl_vars['home_link'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('xml')->value->link; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['home_link']->key => $_smarty_tpl->tpl_vars['home_link']->value){
?>
	       
		    <a href='<?php echo $_smarty_tpl->getVariable('home_link')->value->url;?>
'><img src='<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
<?php echo $_smarty_tpl->getVariable('home_link')->value->img;?>
'alt="" /></a>
	        
         <?php }} ?>
     
     </div>
     <!--<div id="htmlcaption" class="nivo-html-caption">
          <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
     </div>-->
</div>

     <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
js/jquery-1.6.1.min.js"></script>
     <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
js/jquery.nivo.slider.pack.js"></script>
     <script type="text/javascript">
	  $(window).load(function() {
	      $('#slider').nivoSlider();
	  });
     </script>
<!-- /MODULE JQuerySlider Galery -->

