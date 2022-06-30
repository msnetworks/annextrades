<!DOCTYPE html>
<html>
<head>
<title>20</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!--  AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

<!-- Include mousewheel script, optional -->
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>

<!-- Include thumbSlider JS & CSS, optional -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<!-- Include mouseOverZoomTiles JS & CSS, needed! -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.mouseOverZoomTiles.css" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.mouseOverZoomTiles.js"></script>

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css"> 
	/* Overwrite some css from /axZm/axZm.css */
	#axZm_zoomMapSel {
		border-color: #2379b5;
	}

	#axZm_zoomMapSelArea {
		background-color: #2379b5;
	}

	#axZm_zoomMapLoading {
		background-color: #FFFFFF;
	}

	#axZm_zoomMapHolder {
		background-color: #FFFFFF;
	}
	
	/* layout, not needed */
	.wrapLayer {
		box-sizing: border-box;
		padding: 0 40px 0 40px
	}
	.innerLayer {
		margin: 0px auto;
		max-width: 1250px;
	}

	.rightLeftLayer {
		margin-top: 5px
	}

	.mouseOverTilesWrapper {
		box-sizing: border-box;
		width: 50%;
		padding-right: 20px;
		float: left;
	}

	.rightLayer {
		box-sizing: border-box;
		width: 50%;
		padding-left: 20px;
		float: right;
	}

	@media only screen and (max-width: 900px) {
		.mouseOverTilesWrapper{
			width: 100%;
			padding: 0;
		}

		.rightLayer {
			width: 100%;
			padding: 0;
			margin-top: 30px;
		}
	}
</style>

</head>
<body>

<?php
if (file_exists(dirname(__FILE__).'/navi.php')) {
	// This is only for the demo, you can remove it
	include dirname(__FILE__).'/navi.php';
}
?>

<div class="wrapLayer">
	<div class="innerLayer">
		<h1 class="page-header">AJAX-ZOOM - "image map" outside. Mouseover initialization - hover over the image zoom (flyout zoom / hover zoom)</h1>

		<div class="rightLeftLayer">
			<!-- Wrapper for media data, position relative or absolute! -->
			<div class="mouseOverTilesWrapper">
				
				<!-- Container for preview image (AJAX-ZOOM "image map") -->
				<div id="mouseOverTilesMapContainer" style="height: 300px;">
					<!-- Optional enlarge icon -->
					<div class="mouseOverTilesEnlarge"></div>
					
					<!-- Optional message -->
					<div class="mouseOverTilesMsg">use mousewheel to zoom in and out, click to enlarge</div>
				</div>

				<!-- Gallery with thumbs (will be filled with JS instantly as UL, LI) -->
				<div id="mouseOverTilesGallery" class="horizontal">
					Gellery loading...
				</div> 
				
			</div>

			<!-- Init Mouse over zoom with tiles -->
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery.mouseOverZoomTiles({
					axZmPath: "../axZm/", // path to /axZm directory, e.g. /test/axZm/ or "auto" (auto might not always work)
					mapDivID: "mouseOverTilesMapContainer", // ID of the container for mouseover element
					galleryDivID: "mouseOverTilesGallery", // ID of the container where thumbnails will be inserted into
					images: {
						1: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "fashion_004.jpg"},
						2: {img: "/pic/zoom/fashion/fashion_005.jpg", title: "fashion_005.jpg"},
						3: {img: "/pic/zoom/fashion/fashion_006.jpg", title: "fashion_006.jpg"},
						4: {img: "/pic/zoom/fashion/fashion_008.jpg", title: "fashion_008.jpg"},
						5: {img: "/pic/zoom/fashion/fashion_001.jpg", title: "fashion_001.jpg"},
						6: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "fashion_003.jpg"}
					},
					firstImageToLoad: 1,
					mediaQueryFullWidth: 900,
					thumbWidth: 86, // width of the thumbnail image
					thumbHeight: 86, // height of the thumbnail image
					galleryAxZmThumbSlider: true, // use $.axZmThumbSlider for the gallery. If false a different Ul->LI structure will be applied without scrolling capeability
					heightRatio: "1.0|+140", // Instantly adjust the height of the parent contaoner for mouseover image (defined as "mapDivID" option) depending on it's width which can be responsive
					disableTouchMouseover: true, // Disable mouseover for touch devices.
					zoomWidth: ".rightLayer", // max width of the image that will be shown in the zoom window
					zoomHeight: "#mouseOverTilesMapContainer|+105", // max height of the image that will be shown in the zoom window
					adjustX: 20, // space between mouse over zoom ("mapDivID") and flyout window to the right
					adjustY: 0, // vertical shift of the flyout window
					mapSelSmoothDrag: false, // activate smooth drag
					mapSelSmoothDragSpeed: 500, // speed of the dragging
					scrollZoom: 16, // prc zoom on mouse scroll
					fullScreenApi: false, // try to open AJAX-ZOOM at browsers fullscreen mode, possible on modern browsers 
					axZmCallBacks: {}  // callbacks which can be passed to AJAX-ZOOM
				});
				});
			</script>

 			<!-- right side -->
			<div class="rightLayer">

				<h3>2015.09.23 - <span style="color: red;">new:</span> now fully responsive / adaptive!</h3>
				<p>This mouseover zoom extension has been updated to be responsive / adaptive now. 
					Resize the window / reload to see how it behaves.
				</p>

				<h3>About this mouseover zoom</h3>
				<p>In this example we simulate the zoom effect used in many web shops these days. 
					The main advantage of using AJAX-ZOOM is that it does not require the client to load the entire high resolution image. 
					Only some image tiles for a particular zoom level and viewpoint are loaded at first. 
					More tiles are by loaded when the user pans around or zooms in and out (similar to Google maps). 
					This way the source image can be of any size and quality.
				</p>

				<h3>#alternatives {example32: yes <span style="color: red;">!important</span>;}</h3>
				<div style="min-height: 169px; padding: 5px; margin-top: 0; border: #1a4a7a 1px solid; font-size: 11pt; text-align: left;">
					<a href="example32.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_32.jpg" border="0" width="300" height="169" style="cursor: pointer;float: right; margin-left: 7px; position: relative; right: -5px;" /></a>
					If you are looking for a "normal" mouseover zoom without tiled view in the flyout window 
					but would like to apply tiled view when the user clicks to see bigger image, then <br>
					<input type="button" value="example32" onclick="location.href='example32.php'" />
 					is the right plugin for you! Anyway it is worth taking a look at because example32 mouseover zoom 
 					looks very similar but it is conceptually different!
				</div>

				<h3>New version uses $.mouseOverZoomTiles(options) to trigger</h3>
				<p>With the AJAX-ZOOM Ver. 4.2.1 this example has been completely overhauled! 
					We now have $.mouseOverZoomTiles extension which is used as regular plugin 
					and controlled over several options listed below. So it is much easier to implement. 
					Also the flyout window can be configured to be responsive e.g. suit the size of a 
					container to the right or just fill in the available space to the right entirely.
				</p>

				<h3>Zoom in / out, expand to fullscreen</h3>
				<p>Users with the mouse can change the zoom level using mousewheel. 
					Clicking on the mouse over image will result in opening AJAX-ZOOM at fullscreen (browser window size or fullscreen 
					depending on browsers support and option settings - "fullScreenApi"). 
					Note that after opened at fullscreen the point where user clicks at is also magnified at fullscreen! 
					You can change that icon or reposition it with css.
				</p>

				<p>At top right of the mouse over image area there is an optional magnifier icon. 
					Clicking on it triggers the initialization of fullscreen without image being already magnified. 
					Alternatively you can trigger the same by clicking on any other icon using AJAX-ZOOM API method $.fn.axZm.initFullScreen().
				</p>

				<h3>Gallery / Slider</h3>
				<p>For the thumbnails below we do not use jCarousel plugin any more. Instead we use our own 
					<a href="https://www.ajax-zoom.com/axZm/extensions/axZmThumbSlider" target="_blank">$.axZmThumbSlider</a> 
					plugin which is also packaged with AJAX-ZOOM. This plugin is responsive, can be vertical or horizontal 
					and it also plays well with touch devices of any kind. The predefined options settings of 
					$.axZmThumbSlider can be simply overridden by "galleryAxZmThumbSliderParam" option passed over $.mouseOverZoomTiles;
				</p>

				<p>Unless not specified in "images" option the thumbnails are generated instantly by AJAX-ZOOM dynamic image creator. 
					$.axZmThumbSlider does not necessarily need to be enabled. It can be disabled with "galleryAxZmThumbSlider" option.
					In general thumbnails can be put anywhere, e.g. left to the mouseover area and displayed vertically under each other, 
					also with $.axZmThumbSlider;
				</p>
			</div>

		</div>

		<div style="clear: both; overflow-x: hidden;">
			<!-- Code head -->
			<h3>JavaScript & CSS files in Head</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- jQuery core, needed if not already present! -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- Include mousewheel script, optional -->
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>

<!-- Include thumbSlider JS & CSS, optional -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<!-- Include mouseOverZoomTiles JS & CSS, needed! -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.mouseOverZoomTiles.css" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.mouseOverZoomTiles.js"></script>
			');
			echo '</code></pre>';
			?>
			</div>

			<!-- Code body -->
			<h3>HTML markup in body</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- Wrapper for media data, position relative or absolute! -->
<div class="mouseOverTilesWrapper">
	
	<!-- Container for preview image (AJAX-ZOOM "image map") -->
	<div id="mouseOverTilesMapContainer" style="height: 300px;">
		<!-- Optional enlarge icon -->
		<div class="mouseOverTilesEnlarge"></div>
		
		<!-- Optional message -->
		<div class="mouseOverTilesMsg">use mousewheel to zoom in and out, click to enlarge</div>
	</div>

	<!-- Gallery with thumbs (will be filled with JS instantly as UL, LI) -->
	<div id="mouseOverTilesGallery" class="horizontal">
		Gellery loading...
	</div> 
	
</div>
			');
			echo '</code></pre>';
			?>
			</div>

			<!-- Code js -->
			<h3>JavaScript</h3>
			<p>Initialization with some essential options, please find the full list below. 
			jquery.axZm.mouseOverZoomTiles.js can be customized if needed.
			</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-js">';
				echo htmlspecialchars ('
jQuery(document).ready(function(){
	jQuery.mouseOverZoomTiles({
		axZmPath: "../axZm/", // path to /axZm directory, e.g. /test/axZm/ or "auto" (auto might not always work)
		mapDivID: "mouseOverTilesMapContainer", // ID of the container for mouseover element
		galleryDivID: "mouseOverTilesGallery", // ID of the container where thumbnails will be inserted into
		images: {
			1: {img: "/pic/zoom/fashion/test_fashion1.png", title: "test_fashion1.png"},
			2: {img: "/pic/zoom/fashion/test_fashion2.png", title: "test_fashion2.png"},
			3: {img: "/pic/zoom/fashion/test_fashion3.png", title: "test_fashion3.png"},
			4: {img: "/pic/zoom/fashion/test_fashion4.png", title: "test_fashion4.png"},
			5: {img: "/pic/zoom/portrait/test_portrait1.png", title: "test_portrait1.png"},
			6: {img: "/pic/zoom/portrait/test_portrait2.png", title: "test_portrait2.png"},
			7: {img: "/pic/zoom/portrait/test_portrait3.png", title: "test_portrait3.png"},
			8: {img: "/pic/zoom/world/test_world1.png", title: "test_world1.png"},
			9: {img: "/pic/zoom/world/test_world2.png", title: "test_world2.png"},
			10: {img: "/pic/zoom/world/test_world3.png", title: "test_world3.png"}
		},
		firstImageToLoad: 1,
		mediaQueryFullWidth: 900,
		thumbWidth: 86, // width of the thumbnail image
		thumbHeight: 86, // height of the thumbnail image
		galleryAxZmThumbSlider: true, // use $.axZmThumbSlider for the gallery. If false a different Ul->LI structure will be applied without scrolling capeability
		heightRatio: "1.0|+140", // Instantly adjust the height of the parent contaoner for mouseover image (defined as "mapDivID" option) depending on its width which can be responsive
		disableTouchMouseover: true, // Disable mouseover for touch devices.
		zoomWidth: ".rightLayer", // max width of the image that will be shown in the zoom window
		zoomHeight: "#mouseOverTilesMapContainer|+105", // max height of the image that will be shown in the zoom window
		adjustX: 20, // space between mouse over zoom ("mapDivID") and flyout window to the right
		adjustY: 0, // vertical shift of the flyout window
		mapSelSmoothDrag: false, // activate smooth drag
		mapSelSmoothDragSpeed: 500, // speed of the dragging
		scrollZoom: 16, // prc zoom on mouse scroll
		fullScreenApi: false, // try to open AJAX-ZOOM at browsers fullscreen mode, possible on modern browsers 
		axZmCallBacks: {}  // callbacks which can be passed to AJAX-ZOOM
	});
});
				');
				echo '</code></pre>';
				?>

			</div>

			<!-- Options -->
			<h3>$.axZm.mouseOverZoomTiles Options</h3>
			<div style="overflow-x: hidden;">
			<?php 
			if (file_exists(dirname(__FILE__).'/extensions_doc/docu_mouseOverZoomTiles.inc.html')) {
				include dirname(__FILE__).'/extensions_doc/docu_mouseOverZoomTiles.inc.html';
			}
			?>
			</div>

			<div style="margin-top: 20px">
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
</div>

</body>
</html>