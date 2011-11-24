<?php /* Smarty version Smarty-3.0.7, created on 2011-11-24 10:32:18
         compiled from "C:\wamp\www\prestashop/themes/theme001/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103054ece0f22ec3681-81457557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16a07d94f7c2f3780c2c5571514f307cb536c628' => 
    array (
      0 => 'C:\\wamp\\www\\prestashop/themes/theme001/footer.tpl',
      1 => 1321696382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103054ece0f22ec3681-81457557',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
            </div>
            
            <div id="right_column" class="column">
                <?php echo $_smarty_tpl->getVariable('HOOK_RIGHT_COLUMN')->value;?>

            </div>
        </div>
        </div>
        <div id="footer"><div class="footerRight"><div class="clear"><div class="indent"><div class="width"><?php echo $_smarty_tpl->getVariable('HOOK_FOOTER')->value;?>
<br />
Prestashop templates by <a href="http://templatemonster.com">templatemonster.com</a></div></div></div></div></div>
    </div>
	<?php }?>
	</body>
</html>
