<!DOCTYPE html>
<html>
	<head>
		<title>28_clean</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!--  Include jQuery core into head section if not already present -->
		<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

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
					<h1 class="page-header">3D/360° rotate javascript clean example</h1>
					<div style="padding: 5px; border: #EEE 1px solid">
						<div class="embed-responsive" style="padding-bottom: 50%;">
							<!-- Placeholder for AJAX-ZOOM player -->
							<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
								Loading, please wait...
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--  Init AJAX-ZOOM player -->
		<script type="text/javascript">
			// Create empty jQuery object
			var ajaxZoom = {}; 

			// Define callbacks, for complete list check the docs
			ajaxZoom.opt = {
				onBeforeStart: function(){
					// Some of the options can be set directly as js var in this callback
					jQuery.axZm.spinReverse = false;
					// jQuery.axZm.spinReverseZ = true;

					$.axZm.zoomSlider = false;
					$.axZm.spinSlider = false;
				}
			};

			// Define the path to the axZm folder, adjust the path if needed!
			ajaxZoom.path = "../axZm/"; 

			// The ID of the element where ajax-zoom has to be inserted into
			ajaxZoom.divID = "axZmPlayerContainer";

			// Define your custom parameter query string
			// example=spinIpad has many presets for 360 images
			// 3dDir - best of all absolute path to the folder with 360/3D images
			// ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali"; 
			ajaxZoom.parameter = "example=spinIpad"; 

			ajaxZoom.parameter += "&3dDir=/pic/zoom3d/Uvex_Occhiali";

			jQuery(document).ready(function(){
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
				jQuery.fn.axZm.openResponsive(
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