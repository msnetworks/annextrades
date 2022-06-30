<!DOCTYPE html>
<html>
<head>
<title>13</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- jQuery core, needed only for some examples -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- Enable fullscreen on mobile devices -->
<script type="text/javascript" src="../axZm/axZm.iframe.js"></script>

<!-- Optional, more accurate handling of proportions with JS -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.embedResponsive.min.js"></script>

<!-- Javascript to style the syntax, not needed! Disabled for IE less 9 -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css">
<script>if (document.addEventListener){document.write('<script src=\"../axZm/plugins/demo/prism/prism.min.js\"><\/script>');}</script>

<!-- lazyload is not needed, some example below however, use lazyload to demonstate the functionality with it -->
<script type="text/javascript" src="../axZm/plugins/lazyload/jquery.lazyload.min.js"></script>

<style type="text/css">
	.ajaxzoom_iframe,
	.ajaxzoom_image {
		position: relative;
		width: 100%;
		height: 50vh;
		max-height: 700px;
		text-align: center;
	}

	.ajaxzoom_image {
		border: #eee solid 1px;
		box-sizing: border-box;
	}

	.ajaxzoom_image,
	.ajaxzoom_image img {
		cursor: pointer;
	}

	.ajaxzoom_image img {
		position: absolute;
		max-width: 100%;
		max-height: 100%;
		margin: auto;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
	}

	/* copy of bootstraps embed-responsive and embed-responsive-item CSS classes
		if bootstrap or simmilar is included you could use the native classes (without az_) */
	.az_embed-responsive {
		box-sizing: border-box;
		position: relative;
		display: block;
		height: 0;
		padding: 0;
		overflow: hidden;
	}

	.az_embed-responsive-item {
		box-sizing: border-box;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: 0;
	}

	/* fix for some touch devices */
	iframe.embed-responsive-item,
	iframe.az-embed-responsive-item {
		z-index: 1;
	}

	@media screen and (max-width: 1024px) {
		#outerDiv{
			width: 100%; 
			padding: 0 10px 0 10px;
		} 
	}

</style>
</head>
<body>

<?php
// This include is just for the demo, you can remove it
if (file_exists(dirname(__FILE__).'/navi.php')) {
	include dirname(__FILE__).'/navi.php';
}
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">AJAX-ZOOM - load zoom & 360 degree viewer in an (responsive) iframe</h1>
			<p>There are several reasons why you would want to embed AJAX-ZOOM 
				into an iframe. In fact this is the easiest way to embed AJAX-ZOOM 
				as you do not need the jQuery core in the parent page and you do not 
				need any other scripts too. One of the immanent reasons is that because of  
				simple API usage and programming you can not have more than one 
				instances of AJAX-ZOOM showing simultaneously at a time within one page. 
				You can however switch between several instances like 
				in <a href="example29.php">example29.php</a>.
			</p>

			<p>If your iframe is responsive and AJAX-ZOOM is triggered fullscreen inside this iframe, 
				then it will adjust instantly when iframe is resized. 
				Additionally  you can place more than one player into a page. 
				Mouse wheel zoom on player is disabled in this examples 
				when the player is not in fullscreen view but it can be enabled if needed. 
				Please note that "cross-domain" usage is not supported by the regular license.
			</p>

			<p><span style="color: red;">New:</span> if you include "/axZm/axZm.iframe.js" 
				into parent page (e.g. like this page with iframes) and pass iframe ID to the player over query string, 
				then fullscreen will also work for mobile devices.
			</p>

			<h3 style="margin-top: 50px;">360° spin Local</h3>
			<p>Not triggered with browser API fullscreen and does work on mobile devices including IOS
				without opening new window or something like that.
			</p>
			<iframe 
				class="ajaxzoom_iframe" 
				width="100%" 
				id="ajaxzoom_frame_1" 
				frameborder="0" 
				src="example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali&fullScreenApi=0&spinReverse=0&mouseScrollEnable=1&spinNoInit=1&iframeID=ajaxzoom_frame_1" 
				scrolling="no" 
				allowfullscreen>
			</iframe>
 			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!--
* Copy only axZm.iframe.js once into head or body, 
* No other files from AJAX-ZOOM are needed on the page / server which includes iframe 
* jQuery is not needed
* PHP is not needed -> this page could be HTML

* axZm.iframe.js is only needed if you want AJAX-ZOOM player 
* to be able to open at fullscreen on mobile devices from within iframe 
* or full browser window on any device when AJAX-ZOOM option "fullScreenApi" is disabled
* allowfullscreen is not needed then
-->
<script type="text/javascript" src="../axZm/axZm.iframe.js"></script>

<!--
* The iframe element can be responsive
* It should have an (unique) ID!
* The value of its ID should be passed as "iframeID" parameter to AJAX-ZOOM

* example33_vario.php is just an example which is prepared to respond to several parameters
* You can create your own file or change the parameters, 
* retrieve data from DB within this file or whatever...

* PARAMETERS of example33_vario.php TO DEFINE WHICH DATA TO LOAD
* @ 3dDir - path to folder with 360 degree images, or
* @ zoomData - multiple 2D image paths devided by vertical dash |, or
* @ zoomDir - path to folder with several images for gallery

* SOME OPTIONAL PARAMETERS, AJAX-ZOOM HAS HUNDREDS OTHER
* @ spinReverse - reverse spin direction
* @ spinReverseZ - reverse spin direction for 3D on vertical axis
* @ spinBounce - should be enabled when it is e.g. about 180 degree spin and not full 360 rotation
* @ mouseScrollEnable - disable mouse wheel zoom for desktop devices when not in fullscreen
* @ spinNoInit - do not start spinning on load
* @ fullScreenApi - if 0 or false is passed, the player will not use fullscreen desktop browser API
* @ stepZoom - disable zoom transition when zooming with mouse wheel

* @ example - value of configuration - set defined in /axZm/zoomConfigCustom.inc.php
			  default "example" value in example33_vario.php is "spinIpad"
			  in /axZm/zoomConfigCustom.inc.php you can create your own sets
-->
<iframe 
	class="ajaxzoom_iframe" 
	width="100%" 
	frameborder="0" 
	id="ajaxzoom_frame_1" 
	src="example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali&fullScreenApi=0&spinReverse=0&mouseScrollEnable=1&spinNoInit=1&iframeID=ajaxzoom_frame_1" 
	scrolling="no" 
	allowfullscreen>
</iframe>');
				echo '</code></pre>';
			?>
			</div>
			
			<h3 style="margin-top: 50px;">Replace some image (or any other html element) on click with AJAX-ZOOM 360 product spin, AJAX-ZOOM gallery or whatever else</h3>

			<div class="ajaxzoom_image" 
				data-isrc="https://www.ajax-zoom.com/examples/example33_vario.php?3dDir=/pic/zoom3d/Canon_1100D&mouseScrollEnable=1&fullScreenApi=0">
				<img src="../axZm/icons/media-360-1200.png">
			</div> 

			<script type="text/javascript">
			jQuery("body").on("click", ".ajaxzoom_image", function() {
				if ($(this).attr("data-isrc")) {
					// generate a unique ID if not present
					// other than class the ID of an element should be unique anyway
					if (!$(this).attr("id")) {
						var min = 11111111111;
						var max = 99999999999;
						$(this).attr("id", "ajaxzoom_" + new Date().getTime() + Math.floor(Math.random() * (max - min + 1)) + min)
					}
					// create iframe and put as src the data-src of the div
					var iframe = $("<iframe />");
					iframe.attr({
						width: "100%",
						frameborder: "0",
						class: "ajaxzoom_iframe",
						scrolling: "no",
						id: $(this).attr("id"),
						allowfullscreen: true,
						// set src of the iframe and add iframeID query string parameter instantly
						src: $(this).attr("data-isrc") + "&iframeID=" + $(this).attr("id")
					});

					$(this).replaceWith(iframe);
				}
			});
			</script>
			<p style="margin-top: 30px">Here we have a DIV element which contains an image as placeholder. 
				The DIV has a class "ajaxzoom_image" which can be changed if you wish. It only sets the desired proportion 
				which can be achieved with various CSS methods or JS. 
				The "data-src" attribute contains the link to a file including parameters and sets 
				the desired content you want to load into AJAX-ZOOM player. This can be a 360/3D, plain image or gallery...
			</p>
			<pre><code class="language-markup">
				<?php
				echo htmlspecialchars ('
<div class="ajaxzoom_image" 
	data-src="https://www.ajax-zoom.com/examples/example33_vario.php?3dDir=/pic/zoom3d/Canon_1100D&mouseScrollEnable=1&fullScreenApi=0">
	<img src="../axZm/icons/media-360-1200.png">
</div>
				');
				
				?>
			</code></pre>

			<p>Now we only need some JavaScript to replace this image with the iframe when the user clicks on that DIV.
				It creates an iframe element with jQuery and sets "src" attribute taken from "data-src" of the div. 
				The id of the element is instantly passed over query string as additional parameter. 
				Since "ajaxzoom_image" is a CSS class selector, the below code can be applied to more than one 
				DIV and you only need to insert this JavaScript once.
			</p>
			<pre><code class="language-markup">
				<?php
				echo htmlspecialchars ('
<script type="text/javascript" src="../axZm/axZm.iframe.js"></script>
<script type="text/javascript">
jQuery("body").on("click", ".ajaxzoom_image", function() {
	if ($(this).attr("data-isrc")) {
		// generate a unique ID if not present
		// other than class the ID of an element should be unique anyway
		if (!$(this).attr("id")) {
			var min = 11111111111;
			var max = 99999999999;
			$(this).attr("id", "ajaxzoom_" + new Date().getTime() + Math.floor(Math.random() * (max - min + 1)) + min)
		}
		// create iframe and put as src the data-src of the div
		var iframe = $("<iframe />");
		iframe.attr({
			width: "100%",
			frameborder: "0",
			class: "ajaxzoom_iframe",
			scrolling: "no",
			id: $(this).attr("id"),
			allowfullscreen: true,
			// set src of the iframe and add iframeID query string parameter instantly
			src: $(this).attr("data-isrc") + "&iframeID=" + $(this).attr("id")
		});

		$(this).replaceWith(iframe);
	}
});
</script>
				');
				?>
			</code></pre>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h3 style="margin-top: 50px;">Two iframes with 360° from https://www.ajax-zoom.com side by side (bootstrap col-sm-6) and use of jQuery lazyload plugin</h3>
			<div class="alert alert-danger">Please note that older versions of jQuery lazyload plugin do not support iframes! 
				If you already have jQuery lazyload in your template make sure that you have one of the latest versions / update it. 
				A minified version of lazyload plugin which works is included in head of this example file. 
			</div>
		</div>
		<div class="col-md-6">
			<div style="padding: 3px; border: #eee 1px solid; margin-top: 5px;">
				<div class="embed-responsive" style="padding-bottom: 69%;">
					<iframe
						class="embed-responsive-item lazy"
						width="100%"
						frameborder="0"
						id="ajaxzoom_frame_a1"
						data-original="https://www.ajax-zoom.com/examples/example33_vario.php?3dDir=/pic/zoom3d/Speed_Strength_BlackJacket&fullScreenApi=0&spinReverse=1&mouseScrollEnable=0&spinNoInit=0&iframeID=ajaxzoom_frame_a1"
						scrolling="no"
						allowfullscreen>
					</iframe>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div style="padding: 3px; border: #eee 1px solid; margin-top: 5px;">
				<div class="embed-responsive" style="padding-bottom: 69%;">
					<iframe
						class="embed-responsive-item lazy"
						width="100%"
						frameborder="0"
						id="ajaxzoom_frame_a2"
						data-original="https://www.ajax-zoom.com/examples/example33_vario.php?3dDir=/pic/zoom3d/Speed_Strength_WhiteJacket&fullScreenApi=0&spinReverse=1&mouseScrollEnable=0&spinNoInit=1&iframeID=ajaxzoom_frame_a2"
						scrolling="no"
						allowfullscreen>
					</iframe>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<p style="margin-top: 30px;">Here we use bootstrap "embed-responsive" class for the outer DIV and "embed-responsive-item" bootstrap class for the iframe item. 
				"embed-responsive" is nice when you want to set exact proportions of the div by defining the padding-bottom as the percentage value. Other than one would 
				expect the percentage is calculated out of width of the element... 
				Additionally the class "lazy" to identify the iframes which should be lazy loaded. 
				Note that same as with images the src attribute is not defined. Instead the lazy load plugin 
				uses "data-original" html5 attribute and sets the "src" when the user scrolls the iframe in view.
			</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<div class="embed-responsive" style="padding-bottom: 69%;">
	<iframe
		class="embed-responsive-item lazy"
		width="100%"
		frameborder="0"
		id="ajaxzoom_frame_a1"
		data-original="https://www.ajax-zoom.com/examples/example33_vario.php?3dDir=/pic/zoom3d/Speed_Strength_BlackJacket&fullScreenApi=0&spinReverse=1&mouseScrollEnable=0&spinNoInit=1&iframeID=ajaxzoom_frame_a1"
		scrolling="no"
		allowfullscreen>
	</iframe>
</div>

<script type="text/javascript">
	$("iframe.lazy").lazyload();
</script>
				');
				echo '</code></pre>';
			?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h3 style="margin-top: 50px;">Some image (gallery) from https://www.ajax-zoom.com with a border around iframe</h3>
			<div style="padding: 5px; border: #eee 1px solid">
				<iframe 
					class="ajaxzoom_iframe" 
					width="100%" 
					id="ajaxzoom_frame_2" 
					frameborder="0" 
					src="https://www.ajax-zoom.com/examples/example33_vario.php?zoomDir=trasportation&zoomFile=transportation_007.jpg&mouseScrollEnable=1&iframeID=ajaxzoom_frame_2" 
					scrolling="no" 
					allowfullscreen>
				</iframe>
			</div>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<iframe 
	class="ajaxzoom_iframe" 
	width="100%" 
	frameborder="0" 
	id="ajaxzoom_frame_2" 
	src="https://www.ajax-zoom.com/examples/example33_vario.php?zoomDir=trasportation&zoomFile=transportation_007.jpg&mouseScrollEnable=1&iframeID=ajaxzoom_frame_2" 
	scrolling="no" 
	allowfullscreen>
</iframe>');
				echo '</code></pre>';
			?>
			</div>

			<h3 style="margin-top: 50px;">360° spin from https://www.ajax-zoom.com and lazy load</h3>
			<iframe 
				class="ajaxzoom_iframe lazy" 
				width="100%" 
				id="ajaxzoom_frame_3"
				frameborder="0" 
				data-original="https://www.ajax-zoom.com/examples/example33_vario.php?3dDir=/pic/zoom3d/Ecco&spinReverse=1&mouseScrollEnable=1&spinNoInit=1&iframeID=ajaxzoom_frame_3" 
				scrolling="no" 
				allowfullscreen>
			</iframe>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<iframe 
	class="ajaxzoom_iframe lazy" 
	width="100%" 
	frameborder="0" 
	id="ajaxzoom_frame_3" 
	data-original="https://www.ajax-zoom.com/examples/example33_vario.php?3dDir=/pic/zoom3d/Ecco&spinReverse=1&mouseScrollEnable=1&spinNoInit=1&iframeID=ajaxzoom_frame_3" 
	scrolling="no" 
	allowfullscreen>
</iframe>');
				echo '</code></pre>';
			?>
			</div>

			<h3 style="margin-top: 50px;">Local iframe with one image and lazy load</h3>
			<iframe 
				class="ajaxzoom_iframe lazy" 
				width="100%" 
				id="ajaxzoom_frame_5" 
				frameborder="0" 
				data-original="example33_vario.php?zoomData=/pic/zoom/furniture/furniture_006.jpg&mouseScrollEnable=1&iframeID=ajaxzoom_frame_5" 
				scrolling="no" 
				allowfullscreen>
			</iframe>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<iframe 
	class="ajaxzoom_iframe lazy" 
	width="100%" 
	frameborder="0" 
	id="ajaxzoom_frame_5" 
	data-original="example33_vario.php?zoomData=/pic/zoom/furniture/furniture_006.jpg&mouseScrollEnable=1&iframeID=ajaxzoom_frame_5" 
	scrolling="no" 
	allowfullscreen>
</iframe>');
				echo '</code></pre>';
			?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<h3 style="margin-top: 50px;">More accurate proportions handling with jquery.axZm.embedResponsive.js;
				single high resolution image example loaded from https://www.ajax-zoom.com and lazy load enabled.
			</h3>
			<p>Proportions can be easily handled with CSS. Bootstrap offers embed-responsive, 
				embed-responsive-item and e.g. embed-responsive-4by3 classes for responsive containers. 
				The problem is that especially portrait type of proportions will most likely 
				exceed the screen height on many devices and layouts.
			</p>
			<p>Since we did not find any stable CSS solution without CSS preprocessing, 
				we have wrote a simple JavaScript extension (jquery.axZm.embedResponsive.js), which handles the proportions dynamically. 
				It can be used with images, 360/3D or galleries, below is an example with portrait type of image.
			</p>
			<p class="alert alert-success">So the main goal is to provide desired proportions whenever possible in responsive layout 
				but make sure that the size of the player always fully fits inside the screen. Resize the browser window horizontally to see the effect. 
				If you see white background between the image and dotted line around the container, 
				then the proportions are adjusted by the script to fit in view and do not correspond to the intended here 1:1.33
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<!-- Just an unneeded container with border -->
			<div style="border: #f00 10px dashed; border-radius: 5px; margin-bottom: 10px;">
				<!-- Parent iframe container for the desired proportions -->
				<div class="az_embed-responsive" id="ajaxzoom_frame_6_parent">
					<iframe 
						class="az_embed-responsive-item lazy" 
						id="ajaxzoom_frame_6" 
						frameborder="0" 
						data-original="https://www.ajax-zoom.com/examples/example33_vario.php?zoomData=/pic/zoom/high_res/high_res_003.jpg&mouseScrollEnable=1&fullScreenApi=0&iframeID=ajaxzoom_frame_6" 
						scrolling="no" 
						allowfullscreen>
					</iframe>
				</div>
			</div>
			<script type="text/javascript">
				// Set proportions over JS
				$("#ajaxzoom_frame_6_parent")
				.axZmEmbedResponsive( {
					ratio: "1:1.334521687462864",
					heightLimit: 90, // %
					maxWidthArr: [{
						maxWidth: 767,
						ratio: "1:1.334521687462864",
						heightLimit: 80 // %
					}]
				} );
			</script>
		</div>
		<div class="col-md-6">
			<div style="border: #f00 10px dashed; border-radius: 5px; margin-bottom: 10px;">
				<div class="az_embed-responsive" id="ajaxzoom_frame_7_parent" data-ratio="1:1.334521687462864" data-heightLimit="90" data-maxWidthArr="[{&#34;maxWidth&#34;: 767, &#34;ratio&#34;: &#34;1:1.334521687462864&#34;, &#34;heightLimit&#34;: 80}]">
					<iframe 
						class="az_embed-responsive-item lazy" 
						id="ajaxzoom_frame_7" 
						frameborder="0" 
						data-original="https://www.ajax-zoom.com/examples/example33_vario.php?zoomData=/pic/zoom/high_res/high_res_004.jpg&mouseScrollEnable=1&fullScreenApi=0&iframeID=ajaxzoom_frame_7" 
						scrolling="no" 
						allowfullscreen>
					</iframe>
				</div>
			</div>
			<script type="text/javascript">
				// Set proportions over JS, options are set as data attributes
				$("#ajaxzoom_frame_7_parent").axZmEmbedResponsive();
			</script>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<p>Html for the player inside iframe:</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- Parent iframe container for the desired proportions -->
<div class="az_embed-responsive" id="ajaxzoom_frame_6_parent">
	<iframe 
		class="az_embed-responsive-item lazy" 
		id="ajaxzoom_frame_6" 
		frameborder="0" 
		data-original="https://www.ajax-zoom.com/examples/example33_vario.php?zoomData=/pic/zoom/high_res/high_res_003.jpg&mouseScrollEnable=1&fullScreenApi=0&iframeID=ajaxzoom_frame_6" 
		scrolling="no" 
		allowfullscreen>
	</iframe>
</div>');
				echo '</code></pre>';
			?>
			</div>
			<p>JavaScript for proportions, options are passed over object to jQuery.fn.axZmEmbedResponsive:</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<script type="text/javascript">
	// Set proportions over JS
	$("#ajaxzoom_frame_6_parent")
	.axZmEmbedResponsive( {
		ratio: "1:1.334521687462864",
		heightLimit: 95,
		maxWidthArr: [{
			maxWidth: 767,
			ratio: "1:1.334521687462864",
			heightLimit: 80
		}]
	} );
</script>
');
				echo '</code></pre>';
			?>
			</div>
			<p>You can also define options in data html attributes</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<div class="az_embed-responsive" id="ajaxzoom_frame_7_parent" data-ratio="1:1.334521687462864" data-heightLimit="90" data-maxWidthArr="[{&#34;maxWidth&#34;: 767, &#34;ratio&#34;: &#34;1:1.334521687462864&#34;, &#34;heightLimit&#34;: 80}]">
	<iframe 
		class="az_embed-responsive-item lazy" 
		id="ajaxzoom_frame_7" 
		frameborder="0" 
		data-original="https://www.ajax-zoom.com/examples/example33_vario.php?zoomData=/pic/zoom/high_res/high_res_004.jpg&mouseScrollEnable=1&fullScreenApi=0&iframeID=ajaxzoom_frame_7" 
		scrolling="no" 
		allowfullscreen>
	</iframe>
</div>
<script type="text/javascript">
	// Set proportions over JS, options are set as data attributes
	$("#ajaxzoom_frame_7_parent").axZmEmbedResponsive();
</script>');
				echo '</code></pre>';
			?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<h2 style="margin-top: 100px;">Final notes!</h2>
			<p>For lazy load you will of course need to initiate it at some point, e.g. on document ready:</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-js">';
				echo htmlspecialchars ('
jQuery( document ).ready(function($) {
	$("iframe.lazy").lazyload();
});');
				echo '</code></pre>';
			?>
			</div>
			<p>Optional but useful amendment to the page where iframes with AJAX-ZOOM content are created
				is to disable right click when mouse is down for a longer time. This happens when the 
				user pans the image with the right mouse hold down and releases it outside the iframe area. 
				In this case the right mouse click event is triggered on your page. If you do not want 
				to prevent right click in general but for panning only, the following snippet will help:
			</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-js">';
				echo htmlspecialchars ('
(function($) {
	var clickstarted = 0;
	jQuery("body")
	.on("mousedown", function(e) {
		if (e.which == 2 || e.which == 3 && e.type && e.type.indexOf("mouse") != -1) {
			clickstarted = e.timeStamp;
		}
	})
	.on("contextmenu", function(e) {
		if (e.timeStamp - clickstarted > 350) {
			return false;
		}
	});
})(jQuery);');
				echo '</code></pre>';
			?>
			<div style="margin-bottom: 100px;"></div>
			<?php
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				// This is only for the demo, you can remove it
				define('COMMENTS_BOOTSTRAP', true);
				include dirname(__FILE__).'/footer.php';
			}
			?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("iframe.lazy").lazyload();
</script>
<script type="text/javascript">
/* Optional but useful: 
	prevent right click when dragging with right mouse out of the borderline of iframe but allow right click in general
*/
(function($) {
	var clickstarted = 0;
	jQuery('body')
	.on('mousedown', function(e) {
		if (e.which == 2 || e.which == 3 && e.type && e.type.indexOf('mouse') != -1) {
			clickstarted = e.timeStamp;
		}
	})
	.on('contextmenu', function(e) {
		if (e.timeStamp - clickstarted > 350) {
			return false;
		}
	});
})(jQuery);
</script>
</body>
</html>