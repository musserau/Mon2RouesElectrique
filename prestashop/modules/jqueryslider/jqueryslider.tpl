{literal}
<!-- MODULE JQuerySlider Galery -->
<!-- www.tiendasvirtuales.com.ve -->

     <link rel="stylesheet" type="text/css" href="{/literal}{$this_path}{literal}css/default/default.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="{/literal}{$this_path}{literal}css/pascal/pascal.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="{/literal}{$this_path}{literal}css/orman/orman.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="{/literal}{$this_path}{literal}css/nivo-slider.css" type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css" href="{/literal}{$this_path}{literal}css/style.css" type="text/css" media="screen" />

 <div class="slider-wrapper theme-default">
     <div class="ribbon"></div>
     <div id="slider" class="nivoSlider">
	  {/literal}
          {foreach from=$xml->link item=home_link name=links}
	       {literal}
		    <a href='{/literal}{$home_link->url}{literal}'><img src='{/literal}{$this_path}{$home_link->img}{literal}'alt="" /></a>
	        {/literal}
         {/foreach}
     {literal}
     </div>
     <!--<div id="htmlcaption" class="nivo-html-caption">
          <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
     </div>-->
</div>

     <script type="text/javascript" src="{/literal}{$this_path}{literal}js/jquery-1.6.1.min.js"></script>
     <script type="text/javascript" src="{/literal}{$this_path}{literal}js/jquery.nivo.slider.pack.js"></script>
     <script type="text/javascript">
	  $(window).load(function() {
	      $('#slider').nivoSlider();
	  });
     </script>
<!-- /MODULE JQuerySlider Galery -->
{/literal}
