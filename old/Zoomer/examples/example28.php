<!DOCTYPE html>
<html>
	<head>
		<title>28</title>
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
				<div class="col-lg-12">
					<h1 class="page-header">iPad style 3D/360° rotate example with no navigationbar and custom buttons</h1>
				</div>
				<div class="col-lg-7">
					<div style="padding: 5px; border: #EEE 1px solid">
						<div class="embed-responsive" style="padding-bottom: 70%;">
							<!-- Placeholder for AJAX-ZOOM player -->
							<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
								Loading, please wait...
							</div>
						</div>
					</div>
					<h3 style="margin-top: 40px">About</h3>	
					<p>It is possible to achieve full control over spin, zoom and pan of a 3D/360° object with just two buttons. 
						In this example the navigation bar, as well as spin and zoom sliders are deactivated. 
						Instead there are only two custom buttons placed directly over the player. 
						<strike>They are injected with JavaScript over callback function - see sourcecode.</strike> 
						Update: Ver. 4.0+ no need to use callbacks any more for this. 
						Just configure <a href="https://www.ajax-zoom.com/index.php?cid=docs#mNavi">mNavi</a> option.
					</p>
				</div>
				<div class="col-lg-5">
					<img src="https://www.ajax-zoom.com/pic/layout/3d_files.png" alt="multirow vr spin javascript" style="margin-bottom: 20px; max-width: 100%">
				</div>
				<div class="col-lg-12">
					<p>The example object loaded into the player on www.ajax-zoom.com is a multilevel (multirow) 3D one. 
						However it makes no difference to a regular 360° product spin with just one row.
					</p>
					<p>The only difference between regular 360 spin and multirow is that original images are placed in subfolders of the target folder. 
						E.g. the path passed to the folder is ajaxZoom.parameter = "example=17&3dDir=/pic/zoomVR/nike"; 
						images of each row are placed in subfolders, e.g. /pic/zoomVR/nike/0, /pic/zoomVR/nike/15, /pic/zoomVR/nike/30, 
						/pic/zoomVR/nike/45, /pic/zoomVR/nike/60, /pic/zoomVR/nike/75, /pic/zoomVR/nike/90; 
						It is not important how these subfolders are named (e.g. it could be row1, row2 ...) 
						and you also do not need to define these subfolder names anywhere. 
						AJAX-ZOOM will instantly detect them and proceede all the images in them. 
					</p>

					<p>Many more examples and information on 360° spins can be found in 
						<a href="https://www.ajax-zoom.com/examples/example15.php">example15.php</a>. 
						In the <a href="https://www.ajax-zoom.com/index.php?cid=docs#VR_Object">docs</a> you will find more options to adjust 360 spin tool.
					</p>
				</div>
				<div class="col-lg-12">
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