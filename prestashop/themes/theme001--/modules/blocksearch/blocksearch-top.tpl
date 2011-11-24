<!-- Block search module TOP -->
<div id="search_block_top">
	<form method="get" action="{$base_dir}search.php" id="searchbox">
	<p>
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input type="text" id="search_query" name="search_query" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|htmlentities:$ENT_QUOTES:'utf-8'|stripslashes}{else}{l s='Search ...' mod='blocksearch'}{/if}" onFocus="if(this.value=='{l s='Search ...' mod='blocksearch'}')this.value='';" onBlur="if(this.value=='')this.value='{l s='Search ...' mod='blocksearch'}';"  />
		<input type="submit" name="submit_search" value="" class="button" />
	</p>
	</form>
</div>
{if $ajaxsearch}
	<script type="text/javascript">
		{literal}
		
		function formatSearch(row) {
			return row[2] + ' > ' + row[1];
		}

		function redirectSearch(event, data, formatted) {
			$('#search_query').val(data[1]);
			document.location.href = data[3];
		}
		
		$('document').ready( function() {
			$("#search_query").autocomplete(
				'{/literal}{$base_dir}{literal}search.php', {
				minChars: 3,
				max:10,
				selectFirst:false,
				width:500,
				scroll: false,
				formatItem:formatSearch,
				extraParams:{ajaxSearch:1,id_lang:{/literal}{$cookie->id_lang}{literal}}
			}).result(redirectSearch)
		});
		{/literal}
	</script>
{/if}
<!-- /Block search module TOP -->
