<!DOCTYPE html>
<html>
	<head>
		<title>15_clean</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!--  Include jQuery core into head section if not already present-->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  AJAX-ZOOM javascript && CSS -->
		<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
	</head>
	<body>
		<?php
		// This include is just for the demo, you can remove it
		if (file_exists(dirname(__FILE__).'/navi.php')) {
			include dirname(__FILE__).'/navi.php';
		}
		?>

		<div class="container" style="max-width: 1170px !important;">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-header">Clean 360 example, no PHP needed at frontend</h1>
					<div class="embed-responsive" style="padding-bottom: 60%;">
						<!-- Placeholder for AJAX-ZOOM player -->
						<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
							Loading, please wait...
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--  Init AJAX-ZOOM player and make some checks -->
		<script type="text/javascript">

			// Create empty jQuery object which is interpreted in axZm/jquery.axZm.loader.js
			var ajaxZoom = {}; 

			// Define callbacks, for complete list check the docs
			// https://www.ajax-zoom.com/index.php?cid=docs#API_CALLBACKS
			ajaxZoom.opt = {
				onBeforeStart: function(){
					// Some of the options can be set directly as js var in this callback
					jQuery.axZm.spinReverse = true;
					// jQuery.axZm.spinReverseZ = true;

					$.axZm.zoomSlider = false;
					$.axZm.spinSlider = false;
				}
			};

			// Define the path to the axZm folder, adjust the path if needed!
			ajaxZoom.path = "../axZm/"; 

			// Define your custom parameter query string
			// example=17 has many presets for 360 images*
			// 3dDir - best of all absolute path to the folder with 360/3D images

			// *By defining the query string parameter in ajaxZoom.parameter example=17 
			// some default settings from /axZm/zoomConfig.inc.php are overridden in 
			// /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 17){. 
			// So if changes in /axZm/zoomConfig.inc.php have no effect - 
			// look for the same options /axZm/zoomConfigCustom.inc.php; 
			ajaxZoom.parameter = "example=17&3dDir=/pic/zoom3d/Uvex_Occhiali"; 

			// The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
			ajaxZoom.divID = "axZmPlayerContainer";

			// Instead of using the loader file jquery.axZm.loader.js (see below)
			// you can use https://www.ajax-zoom.com/index.php?cid=docs#api_load
			// Following files need to be loaded before jQuery.fn.axZm.load is triggered:
			// 1. jQuery core (e.g. https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js), 
			// 2. /axZm/jquery.axZm.js (AJAX-ZOOM core file) 
			// 3. /axZm/axZm.css (AJAX-ZOOM css)
			// Do not use jQuery.fn.axZm.load and /axZm/jquery.axZm.loader.js together!

			jQuery(document).ready(function() {
				// open ajax-zoom not responsive
				// the size depends then on $zoom['config']['picDim']
				/*
				jQuery.fn.axZm.load({
					opt: ajaxZoom.opt,
					path: ajaxZoom.path,
					parameter: ajaxZoom.parameter,
					divID: ajaxZoom.divID
				});
				*/

				// Open AJAX-ZOOM responsive
				$.fn.axZm.openResponsive(
					ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
					ajaxZoom.parameter, // Defines which images and which options set to load
					ajaxZoom.opt, // callbacks
					ajaxZoom.divID, // target - container ID (default 'window' - fullscreen)
					false, // apiFullscreen- use browser fullscreen mode if available
					true, // disableEsc - prevent closing with Esc key
					false // postMode - use POST instead of GET
				);
			});
		</script>
	</body>
</html>