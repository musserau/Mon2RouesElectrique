<?php /* Smarty version Smarty-3.0.7, created on 2011-11-24 10:32:17
         compiled from "C:\wamp\www\prestashop/themes/theme001/modules/blocksearch/blocksearch-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:325664ece0f217c9834-77040243%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ecc58f8a216ba922e74b3677b6e571fe7460b40' => 
    array (
      0 => 'C:\\wamp\\www\\prestashop/themes/theme001/modules/blocksearch/blocksearch-top.tpl',
      1 => 1321741607,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '325664ece0f217c9834-77040243',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Block search module TOP -->
<div id="search_block_top">
	<form method="get" action="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
search.php" id="searchbox">
	<p>
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input type="text" id="search_query" name="search_query" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->getVariable('ENT_QUOTES')->value,'utf-8'));?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Search ...','mod'=>'blocksearch'),$_smarty_tpl);?>
<?php }?>" onFocus="if(this.value=='<?php echo smartyTranslate(array('s'=>'Search ...','mod'=>'blocksearch'),$_smarty_tpl);?>
')this.value='';" onBlur="if(this.value=='')this.value='<?php echo smartyTranslate(array('s'=>'Search ...','mod'=>'blocksearch'),$_smarty_tpl);?>
';"  />
		<input type="submit" name="submit_search" value="" class="button" />
	</p>
	</form>
</div>
<?php if ($_smarty_tpl->getVariable('ajaxsearch')->value){?>
	<script type="text/javascript">
		
		
		function formatSearch(row) {
			return row[2] + ' > ' + row[1];
		}

		function redirectSearch(event, data, formatted) {
			$('#search_query').val(data[1]);
			document.location.href = data[3];
		}
		
		$('document').ready( function() {
			$("#search_query").autocomplete(
				'<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
search.php', {
				minChars: 3,
				max:10,
				selectFirst:false,
				width:500,
				scroll: false,
				formatItem:formatSearch,
				extraParams:{ajaxSearch:1,id_lang:<?php echo $_smarty_tpl->getVariable('cookie')->value->id_lang;?>
}
			}).result(redirectSearch)
		});
		
	</script>
<?php }?>
<!-- /Block search module TOP -->
