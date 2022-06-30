<!DOCTYPE html>
<html>
	<head>
		<title>17</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is actually not needed except embed-responsive and embed-responsive-item classes 
			which could be easily extracted -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">

		<!-- This is not needed at all -->
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM core files -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Helper plugin to deal with embed-responsive class -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.embedResponsive.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css">
			#mapContainer,
			#axZm_zoomContainer {
				background-color: #eeeeee;
			}
			#zFsO #axZmBtnCompare {
				position: absolute;
				z-index: 7;
				bottom: 5px;
				left: 50%;
				transform: translate(-50%, 0);
			}
			.btn-mrg {
				margin-bottom: 3px;
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
		<div class="container">
			<h1 class="page-header">AJAX-ZOOM - experiment: outer "image map" same size as initial image.
				Autozoom after image loads. Before / after image comparison JavaScript functionality.
			</h1>

			<div class="row">
				<div class="col-sm-6">
					<div class="embed-responsive" id="mapContainerParent">
						<!-- Placeholder for AJAX-ZOOM player -->
						<div id="mapContainer" class="embed-responsive-item">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="embed-responsive" id="axZmPlayerContainerParent">
						<!-- Placeholder for AJAX-ZOOM player -->
						<div id="axZmPlayerContainer" class="embed-responsive-item">
							Loading, please wait...
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 7px;">
				<div class="col-sm-6 col-xs-12">
					<div class="right">Image source: canon.com; Canon EOS 5DS; ISO: 100; 5792x8688px</div>
				</div>
				<!-- Buttons to switch between sets of images to be compared, not needed -->
				<div class="col-sm-3 col-xs-6">
					<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
						onclick="jQuery.fn.axZm.loadAjaxSet('zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/estate/house_02.jpg&example=19')">Set 1</a>
					<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
						onclick="jQuery.fn.axZm.loadAjaxSet('zoomData=/pic/zoom/erotic/erotic_001.jpg|/pic/zoom/erotic/erotic_002.jpg&example=19')">Set 2</a>
					<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
						onclick="jQuery.fn.axZm.loadAjaxSet('zoomData=/pic/zoom/fashion/fashion_007.jpg|/pic/zoom/fashion/fashion_008.jpg&example=19')">Set 3</a>
					<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
						onclick="jQuery.fn.axZm.loadAjaxSet('zoomData=/pic/zoom/fashion/fashion_009.jpg|/pic/zoom/fashion/fashion_003.jpg&example=19')">Set 4</a>
				</div>
				<!-- Buttons to switch between first and second image -->
				<div class="col-sm-3 col-xs-6" id="axZmBtnCompareParent">
					<div id="axZmBtnCompare">
						<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)" onclick="jQuery.fn.axZm.zoomSwitchQuick(1)">Image 1</a> vs. 
						<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)" onclick="jQuery.fn.axZm.zoomSwitchQuick(2)">Image 2</a>
					</div>
				</div>
			</div>

			<script type="text/javascript" id="exampleJs">
			;(function($){
				// embed-responsive bootstrap class is managed over js here
				// this allows to set max height of the player or other containers
				// in respect to window height
				$('#axZmPlayerContainerParent, #mapContainerParent')
				.axZmEmbedResponsive({
					prc: 150,
					//ratio: '1:1.5', // ratio 1:1.5 is same as prc 150
					heightLimit: 82,
					maxWidthArr: [{
						maxWidth: 767,
						prc: 150,
						heightLimit: 40
					}]
				});

				// Create new object and define functions within it
				// so they could be accessed and changed from outside later, e.g. window.ajaxZoom.zoomToOnStart
				window.ajaxZoom = {};

				window.ajaxZoom.setPrevNextKeys = function() {
					// switch with keyboard between images
					$("body")
					.unbind("keyup.azcomp")
					.bind("keyup.azcomp", function(e) {
						
						if ($.axZm && $.axZm.zoomPN && $.axZm.zoomID) {
							if (e.keyCode == 37) {
								$.fn.axZm.zoomSwitchQuick($.axZm.zoomPN[$.axZm.zoomID]["prev"]);
							} else if (e.keyCode == 39) {
								$.fn.axZm.zoomSwitchQuick($.axZm.zoomPN[$.axZm.zoomID]["next"]);
							}
						}
					});
				};

				window.ajaxZoom.zoomToOnStart = function() {
					jQuery.fn.axZm.zoomTo({
						x1: "50%",
						y1: "40%",
						speed: 0,
						speedZoomed: 0,
						ajxTo: 0,
						zoomLevel: "100%",
						callback: function(){
							// Show AJAX-ZOOM after zoomTo
							$("#axZm_zoomContainer").css('visibility', 'visible');
							window.ajaxZoom.setPrevNextKeys();
						}
					});
				};

				// AJAX-ZOOM callbacks / hooks
				ajaxZoom.opt = {
					onBeforeStart: function(){
						// Not all but some AJAX-ZOOM options can be set inside onBeforeStart callback
						jQuery.axZm.useMap = true;
						jQuery.axZm.mapParent = "mapContainer";
						jQuery.axZm.zoomSlider = true;
						jQuery.axZm.zoomSliderHorizontal = true;
						jQuery.axZm.zoomSliderHeight = 100;
						jQuery.axZm.zoomSliderHandleSize = 11;
						jQuery.axZm.zoomSliderWidth = 5;
						jQuery.axZm.zoomSliderMarginH = 10;
						jQuery.axZm.zoomSliderMarginV = 10;
						jQuery.axZm.zoomSliderPosition = "bottomLeft";
						jQuery.axZm.zoomSliderMouseOver = false;

						// Hide AJAX-ZOOM on loading
						$("#axZm_zoomContainer").css('visibility', 'hidden');
						$("body").unbind("keyup.azcomp");
					},
					onLoad: function(){
						window.ajaxZoom.setPrevNextKeys();
					},
					onFullScreenReady: function(){
						window.ajaxZoom.zoomToOnStart();
					},
					onLoadAjaxSet: function(){
						window.ajaxZoom.zoomToOnStart();
					},
					onFullScreenStartEndFromRel: function() {
						// Optionally append the buttons over the player
						$("#axZmBtnCompare").appendTo("#axZm_zoomLayer");
					},
					onFullScreenCloseEndFromRel: function() {
						// Restore buttons
						$("#axZmBtnCompare").appendTo("#axZmBtnCompareParent");

						// zoom to max level when closing fullscreen view
						setTimeout(function() {
							jQuery.fn.axZm.clearTiles(true);
							jQuery.fn.axZm.zoomTo({
								speed: 0,
								speedZoomed: 0,
								ajxTo: 0,
								zoomLevel: "100%"
							});
						}, 1);
					}
				};

				// Path to the axZm folder
				window.ajaxZoom.path = "../axZm/"; 

				// Define your custom parameter query string
				// By example=19 some settings are overridden in zoomConfigCustom.inc.php
				// zoomData is the php array with images turned into string
				window.ajaxZoom.parameter = "zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/estate/house_02.jpg&example=19"; 

				// The id of the Div where ajax-zoom has to be inserted into
				window.ajaxZoom.divID = "axZmPlayerContainer"; 

				// Load AJAX-ZOOM not responsive
				/*
				jQuery(document).ready(function(){
					jQuery.fn.axZm.load({
						opt: ajaxZoom.opt,
						path: ajaxZoom.path,
						parameter: ajaxZoom.parameter,
						divID: ajaxZoom.divID
					});
				});
				*/

				// Open AJAX-ZOOM responsive
				$.fn.axZm.openResponsive(
					window.ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
					window.ajaxZoom.parameter, // Defines which images and which options set to load
					window.ajaxZoom.opt, // callbacks
					window.ajaxZoom.divID, // target - container ID (default 'window' - fullscreen)
					false, // apiFullscreen- use browser fullscreen mode if available
					true, // disableEsc - prevent closing with Esc key
					false // postMode - use POST instead of GET
				);

			})(jQuery);
			</script>

			<h3>About before / after image comparison</h3>
			<p>In this example the "image map" is placed outside of AJAX-ZOOM player and has the same size as the player. 
				If you define more than one image which are passed to AJAX-ZOOM, then despite that all galleries are turned off 
				AJAX-ZOOM still knows about the other images. Provided that all images have the same dimensions (width x height) 
				you can switch between the images with the API <code>$.fn.axZm.zoomSwitchQuick()</code> without losing the zoom state. 
				This API function is bind to the onclick event of the "Image 1" vs. "Image 2" buttons below the player. 
				Optionally you can also switch between images with the keyboard arrow (or any other) keys, see code below.
			</p>
			<p>When you click on "Set x" buttons images sets are changed with <code>jQuery.fn.axZm.loadAjaxSet</code> API function.
				You are not limited to load only two images with it. If it does make sense it could also load a series of a timelapse frames, 
				Photoshop retouches, use it for scientific purposes and the like.
			</p>
			<p>Please note that as with any other AJAX-ZOOM examples you could also place hotspots on images
				either generated with <a href="example33.php">hotspot editor</a> or using AJAX-ZOOM API to generate 
				hotspots dynamically e.g. out of a database or external XML files with coordinates.
			</p>
			<p>Finally it is important to note that the buttons below the player are only an example to show 
				the functionality. You can retrieve information about images which should be compared out of 
				any other source and dynamically load them into the player...
			</p>
			<div>
				<!-- Code head -->
				<h3>JavaScript & CSS files in Head</h3>
				<div style="margin: 5px 0px 5px 0px;">
					<?php
					echo '<pre><code class="language-markup">';
					echo htmlspecialchars ('
<!-- Bootstrap is actually not needed except embed-responsive and embed-responsive-item classes 
	which could be easily extracted -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">

<!-- This is not needed at all -->
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core files -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- Helper plugin to deal with embed-responsive class -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.embedResponsive.js"></script>
					');
					echo '</code></pre>';
					?>
				</div>

				<h3>HTML makup in body</h3>
				<div style="margin: 5px 0px 5px 0px;">
					<?php
					echo '<pre><code class="language-markup">';
					echo htmlspecialchars ('
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<div class="embed-responsive" id="mapContainerParent">
				<!-- Placeholder for AJAX-ZOOM player -->
				<div id="mapContainer" class="embed-responsive-item">
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="embed-responsive" id="axZmPlayerContainerParent">
				<!-- Placeholder for AJAX-ZOOM player -->
				<div id="axZmPlayerContainer" class="embed-responsive-item">
					Loading, please wait...
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 7px;">
		<div class="col-sm-6 col-xs-12">
			<div class="right">Image source: canon.com; Canon EOS 5DS; ISO: 100; 5792x8688px</div>
		</div>
		<!-- Buttons to switch between sets of images to be compared, not needed -->
		<div class="col-sm-3 col-xs-6">
			<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
				onclick="jQuery.fn.axZm.loadAjaxSet(\'zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/estate/house_02.jpg&example=19\')">Set 1</a>
			<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
				onclick="jQuery.fn.axZm.loadAjaxSet(\'zoomData=/pic/zoom/erotic/erotic_001.jpg|/pic/zoom/erotic/erotic_002.jpg&example=19\')">Set 2</a>
			<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
				onclick="jQuery.fn.axZm.loadAjaxSet(\'zoomData=/pic/zoom/fashion/fashion_007.jpg|/pic/zoom/fashion/fashion_008.jpg&example=19\')">Set 3</a>
			<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)"
				onclick="jQuery.fn.axZm.loadAjaxSet(\'zoomData=/pic/zoom/fashion/fashion_009.jpg|/pic/zoom/fashion/fashion_003.jpg&example=19\')">Set 4</a>
		</div>
		<!-- Buttons to switch between first and second image -->
		<div class="col-sm-3 col-xs-6" id="axZmBtnCompareParent">
			<div id="axZmBtnCompare">
				<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)" onclick="jQuery.fn.axZm.zoomSwitchQuick(1)">Image 1</a> vs. 
				<a class="btn btn-sm btn-info btn-mrg" href="javascript:void(0)" onclick="jQuery.fn.axZm.zoomSwitchQuick(2)">Image 2</a>
			</div>
		</div>
	</div>
</div>
					');
					echo '</code></pre>';
					?>
				</div>

				<h3>JavaScript</h3>
				<div style="margin: 5px 0px 5px 0px;">
					<pre><code class="language-js" id="exampleJsPrism"></code></pre>
					<script type="text/javascript">jQuery('#exampleJsPrism').html(jQuery('#exampleJs').html())</script>
				</div>
			</div>

			<?php
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				// This is only for the demo, you can remove it
				define('COMMENTS_BOOTSTRAP', true);
				include dirname(__FILE__).'/footer.php';
			}
			?>
		</div>
	</body>
</html>