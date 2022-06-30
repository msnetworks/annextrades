<!DOCTYPE html>
<html>
	<head>
		<title>22</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM javascript -->
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
		<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

		<style type="text/css">
			/* Layout */
			#azNaviLeft {
				float: left;
				width: 240px;
				background-color: #AAAAAA;
				border-right: #808080 solid 1px;
				overflow: hidden;
				font-size: 12px;
				color: #FFFFFF;
			}

			#azParentContainer {
				position: absolute;
				top: 0;
				right: 0;
				z-index: 1;
			}

			@media (max-width: 640px) {
				#azParentContainer {
					position: relative;
					width: 100% !important;
				}
				#azNaviLeft {
					position: relative;
					float: none;
					width: 100%;
					height: auto !important;
					border-right-width: 0;
					border-bottom: #808080 solid 1px;
				}
			}

			#footer {
				clear: both;
				/* height: 30px; */
			}
		</style>

	</head>

	<body>
		<!-- Top area -->
		<div id="header">
			<?php
			if (file_exists(dirname(__FILE__).'/navi.php')) {
				// This is only for the demo, you can remove it
				include dirname(__FILE__).'/navi.php';
			}
			?>
		</div>

		<div style="position: relative; width: 100%">
			<!-- Left area -->
			<div id="azNaviLeft">
				<div style="padding: 10px;">
					An example of AJAX-ZOOM placed inside a container with dynamic / responsive width and height 
					(depends on screen resolution and browser window size). Resize the window to see the adjustments. <br><br>
					Please note that the layout in this example is controlled by javascript (see "adjustHeight" function in the source code). 
					If you have responsive layout which adjusts instantly you do not need such a javascript control.<br><br>
					The vertical gallery to the right can be disabled or replaced with horizontal gallery.<br><br>
					With $.fn.axZm.loadAjaxSet() AJAX-ZOOM API you can change the set of loaded images easily: 
					e.g. $.fn.axZm.loadAjaxSet( 'zoomDir=/pic/zoom/estate&example=23' );<br><br>
					<div style="margin-bottom: 10px;">click <input type="button" class="btn btn-info btn-xs" value="HERE" onclick="jQuery.fn.axZm.loadAjaxSet('zoomDir=/pic/zoom/estate&example=23&zoomID=2')"> to try the above </div>
					<div style="margin-bottom: 10px;">click <input type="button" class="btn btn-info btn-xs" value="RESTORE" onclick="jQuery.fn.axZm.loadAjaxSet(ajaxZoom.queryString)"> to set back </div>
					For loading specific images use "zoomData" instead of "zoomDir"; "zoomData" is a CSV string separated with vertical slash ("|")
				</div>
			</div>

			<!-- Left area, where responsive AJAX-ZOOM will be put into -->
			<div id="azParentContainer">
				<!-- This div will be removed -->
				<div style="padding: 20px; font-size: 16px;">Loading, please wait...</div>
			</div>
		</div>

		<!-- Bottom area -->
		<div id="footer"></div>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				// A function to controll this responsive layout with JS
				var adjustHeight = function() {
					var a = (window.innerHeight ? window.innerHeight : $(window).height()) - jQuery('#header').outerHeight() - jQuery('#footer').outerHeight();
					jQuery('#azParentContainer').css({height: a, width: jQuery(window).width() - jQuery('#azNaviLeft').outerWidth()});
					jQuery('#azNaviLeft').css('height', a);
					window.scrollTo(0, 0);
				};

				// Trigger adjustHeight on jQuery(document).ready
				adjustHeight();

				// Bind adjustHeight to window onresize event
				jQuery(window).bind('resize orientationchange', adjustHeight);

				// Define some var to hold AJAX-ZOOM related values
				window.ajaxZoom = {};

				// Path to /axZm/ folder, adjust the path in your implementaion
				ajaxZoom.path = '../axZm/';

				// Define the ID of the responsive container
				ajaxZoom.targetID = 'azParentContainer';

				// Images to load
				ajaxZoom.zoomData = [
					'/pic/zoom/boutique/boutique_001.jpg',
					'/pic/zoom/boutique/boutique_002.jpg',
					'/pic/zoom/boutique/boutique_003.jpg',
					'/pic/zoom/boutique/boutique_004.jpg',
					'/pic/zoom/boutique/boutique_005.jpg',
					'/pic/zoom/boutique/boutique_006.jpg',
					'/pic/zoom/boutique/boutique_007.jpg',
					'/pic/zoom/boutique/boutique_008.jpg',
					'/pic/zoom/fashion/fashion_001.jpg',
					'/pic/zoom/fashion/fashion_002.jpg',
					'/pic/zoom/fashion/fashion_003.jpg',
					'/pic/zoom/fashion/fashion_004.jpg',
					'/pic/zoom/fashion/fashion_005.jpg'
				];

				// "example" in query string which is passed to AJAX-ZOOM defines an options set
				// which differs from default values. You can find the options set of this example 
				// in /axZm/zoomConfigCustom.inc.php after 
				// elseif ($_GET['example'] == 23)
				ajaxZoom.queryString = 'example=23';

				// Pass images as CSV separated with '|'
				ajaxZoom.queryString += '&zoomData='+ajaxZoom.zoomData.join('|');

				// AJAX-ZOOM callbacks (there are many others)
				ajaxZoom.ajaxZoomCallbacks = {
					onVertGalLoaded: function() {
						// A function to place image name and resolution as description of the thumbs
						$.each($.axZm.zoomGA, function(k, v) {
							$.fn.axZm.setDescr(k, null, v.img+' ('+v.ow+'x'+v.oh+')');
						});
					}
				};

				// Enable overlay before AJAX-ZOOM loads
				window.fullScreenStartSplash = {'enable': true, 'className': false, 'opacity': 0.75};

				// Use jQuery.fn.axZm.openFullScreen() API to trigger AJAX-ZOOM responsive
				jQuery.fn.axZm.openResponsive(
					ajaxZoom.path,
					ajaxZoom.queryString,
					ajaxZoom.ajaxZoomCallbacks,
					ajaxZoom.targetID,
					false, // apiFullscreen- use browser fullscreen mode if available
					true, // disableEsc - prevent closing with Esc key
					false // postMode - use POST instead of GET
				);

			});
		</script>

	</body>
</html>