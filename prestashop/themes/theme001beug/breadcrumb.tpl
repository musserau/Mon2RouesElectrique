<!-- Breadcrumb -->
{if isset($smarty.capture.path)}{assign var='path' value=$smarty.capture.path}{/if}
<div class="breadcrumb">
	{include file="$tpl_dir./binding_top.tpl"} 
	<a href="{$base_dir}" title="{l s='return to'} {l s='Home'}">{l s='Home'}</a>{if $path}<span class="navigation-pipe">{$navigationPipe|escape:html:'UTF-8'}</span>{if !$path|strpos:'span'}<span class="navigation_page">{$path}</span>{else}{$path}{/if}{/if}
    {include file="$tpl_dir./binding_bottom.tpl"} 
</div>
<!-- /Breadcrumb -->