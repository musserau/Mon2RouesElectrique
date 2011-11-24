<!-- Block permanent links module HEADER -->
<div id="permalinks">
	<div class="permalinksLeftBg"></div>
<nav id="topNav">
<ul id="header_links" class="topNav">
	<li id="header_link_scooter"><a href="{$base_dir}" class="items" title="{l s='Scooter' mod='blockpermanentlinks'}">{l s='Scooter' mod='blockpermanentlinks'}</a>
		<ul>
			<li><a href="{$base_dir}" title="{l s='Scooter thermal' mod='blockpermanentlinks'}">{l s='Scooter thermal' mod='blockpermanentlinks'}</a></li>
			<li><a href="{$base_dir}" title="{l s='Scooter electric' mod='blockpermanentlinks'}">{l s='Scooter electric' mod='blockpermanentlinks'}</a></li>
		</ul>
	</li>
	<li id="header_link_cycle"><a href="{$base_dir_ssl}" class="items" title="{l s='Cycle' mod='blockpermanentlinks'}">{l s='Cycle' mod='blockpermanentlinks'}</a></li>
	<li id="header_link_accessory"><a href="{$base_dir}" class="items" title="{l s='Accessory' mod='blockpermanentlinks'}">{l s='Accessory' mod='blockpermanentlinks'}</a></li>
	<li id="header_link_bestSeler"><a href="{$base_dir}" class="items" title="{l s='Best Seler' mod='blockpermanentlinks'}">{l s='Best Seler' mod='blockpermanentlinks'}</a></li>
</ul>
</nav>
<script type="text/javascript" src="{$content_dir}themes/theme001/js/modernizr.js"></script>
<script type="text/javascript">
	(function($){
		//cache nav
		var nav = $("#topNav");
				
		//add indicator and hovers to submenu parents
		nav.find("li").each(function() {
		if ($(this).find("ul").length > 0) {
		$("<span>").text("^").appendTo($(this).children(":first"));
		//show subnav on hover
		$(this).mouseenter(function() {
		$(this).find("ul").stop(true, true).slideDown();
						});					//hide submenus on exit
		    $(this).mouseleave(function() {					$(this).find("ul").stop(true, true).slideUp();
						});
					}
		});
	})(jQuery);
</script>
</div>
<!-- /Block permanent links module HEADER -->
