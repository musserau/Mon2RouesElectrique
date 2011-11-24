<!-- Block permanent links module HEADER -->
<div id="permalinks">
	<div class="permalinksLeftBg"></div>
<ul id="header_links">
	<li id="header_link_home"><a href="{$base_dir}" title="home"><span>{l s='home'}</span></a></li>
	<li id="header_link_contact"><a href="{$base_dir_ssl}contact-form.php" title="{l s='contact' mod='blockpermanentlinks'}"><span>{l s='contact' mod='blockpermanentlinks'}</span></a></li>
	<li id="header_link_sitemap"><a href="{$base_dir}sitemap.php" title="{l s='sitemap' mod='blockpermanentlinks'}"><span>{l s='sitemap' mod='blockpermanentlinks'}</span></a></li>
	<li id="header_link_bookmark">
		<script type="text/javascript">writeBookmarkLink('{$come_from}', '{$shop_name|addslashes|addslashes}', '<span>{l s='bookmark' mod='blockpermanentlinks'}</span>');</script>
	</li>
</ul>
</div>
<!-- /Block permanent links module HEADER -->
