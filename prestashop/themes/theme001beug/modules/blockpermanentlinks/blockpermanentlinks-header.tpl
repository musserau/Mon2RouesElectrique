<!-- Block permanent links module HEADER -->

<script type="text/javascript">
    $(document).ready(function(){  
      
        $("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)  
      
        $("ul.topnav li span").click(function() { //When trigger is clicked...  
      
            //Following events are applied to the subnav itself (moving subnav up and down)  
            $(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click  
      
            $(this).parent().hover(function() {  
            }, function(){  
                $(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up  
            });  
      
            //Following events are applied to the trigger (Hover events for the trigger)  
            }).hover(function() {  
                $(this).addClass("subhover"); //On hover over, add class "subhover"  
            }, function(){  //On Hover Out  
                $(this).removeClass("subhover"); //On hover out, remove class "subhover"  
        });  
      
    });  
</script>

<div id="permalinks">
	<div class="permalinksLeftBg"></div>
<ul id="header_links" class="topnav">
	<li id="header_link_scooter"><a href="{$base_dir}" title="{l s='Scooter' mod='blockpermanentlinks'}"><div class="items">{l s='Scooter' mod='blockpermanentlinks'}</div></a>
		<ul class="subnav">
			<li><a href="{$base_dir}" title="{l s='Scooter thermal' mod='blockpermanentlinks'}">{l s='Scooter thermal' mod='blockpermanentlinks'}</a></li>
			<li><a href="{$base_dir}" title="{l s='Scooter electric' mod='blockpermanentlinks'}">{l s='Scooter electric' mod='blockpermanentlinks'}</a></li>
		</ul>
	</li>
	<li id="header_link_cycle"><a href="{$base_dir_ssl}" title="{l s='Cycle' mod='blockpermanentlinks'}"><div class="items">{l s='Cycle' mod='blockpermanentlinks'}</div></a></li>
	<li id="header_link_accessory"><a href="{$base_dir}" title="{l s='Accessory' mod='blockpermanentlinks'}"><div class="items">{l s='Accessory' mod='blockpermanentlinks'}</div></a></li>
	<li id="header_link_bestSeler"><a href="{$base_dir}" title="{l s='Best Seler' mod='blockpermanentlinks'}"><div class="items">{l s='Best Seler' mod='blockpermanentlinks'}</div></a></li>
</ul>
</div>
<!-- /Block permanent links module HEADER -->
