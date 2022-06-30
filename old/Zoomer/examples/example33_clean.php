<!doctype html>
<html>
	<head>
		<title>33_clean</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM javascript and CSS, adjust the path if needed. Best set absolute path -->
		<link  href="../axZm/axZm.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

        <!-- Include thumbSlider JS & CSS -->
        <link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
        <script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>
        <script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>

		<!-- Only needed for the click example with fancybox -->
		<link href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.zIndex.css" type="text/css" media="screen" rel="stylesheet">
		<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.js"></script>

		<!-- A small function to add different type of description, not necessarily needed -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.expButton.css">
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.min.js"></script>

		<style type="text/css">
			@media (max-width: 640px) {
				#axZm_zoomCustomNavi img{
					width: 25px!important;
					height: 25px!important;
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

		<div class="container" style="max-width: 1170px !important;">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-header">AJAX-ZOOM 360 Hotspots clean example</h1>
					<div class="embed-responsive" style="padding-bottom: 70%;">
						<!-- Placeholder for AJAX-ZOOM player -->
						<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
							Loading, please wait...
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Init AJAX-ZOOM player -->
		<script type="text/javascript">

			// Create empty jQuery object
			window.ajaxZoom = {};

			// The ID of the element where ajax-zoom has to be inserted into
			ajaxZoom.divID = "axZmPlayerContainer";

			// Define the path to the axZm folder, adjust the path if needed!
			ajaxZoom.path = "../axZm/";

			// Define callbacks, for complete list check the docs
			ajaxZoom.opt = {
				onBeforeStart: function() {
					// Set backgrounf color, can also be done in css file
					jQuery('.zoomContainer').css({backgroundColor: '#FFFFFF'});
					// Set mNavi buttons here if you want
					if (typeof jQuery.axZm.mNavi == 'object') {
						jQuery.axZm.mNavi.order = {mPan: 5, mSpin: 10, mHotspots: 5, mSpinPlay: 0};
						jQuery.axZm.mNavi.mouseOver = true;
						/*
						jQuery.axZm.mNavi.customPos = {
							mHotspots: {
								css: {
									right: 5,
									bottom: 5,
									position: 'absolute',
									zIndex: 123
								},
								mouseOver: true
							}
						};
						*/
					}

					jQuery.axZm.gallerySlideNavi = false;
					jQuery.axZm.spinDemoTime = 2500;
					jQuery.axZm.spinDemoRounds = 999;

					// Define hotspots!
					// jQuery.axZm.hotspots = hotspotsDev;
					// jQuery.fn.initHotspots()
				},
				onLoad: function(){ // onSpinPreloadEnd
					jQuery.axZm.spinReverse = false;

					// Load hotspots over this function... or just define jQuery.axZm.hotspots here and trigger jQuery.fn.axZm.initHotspots(); after this.
					jQuery.fn.axZm.loadHotspotsFromJsFile('../pic/hotspotJS/eos_1100D.js', false);
				}
			};

			// Define your custom parameter query string
			// example=hotSpotEdit has many presets for 360 images
			// 3dDir - best of all absolute path to the folder with 360/3D images
			ajaxZoom.parameter = "example=spinIpad&3dDir=../pic/zoom3d/Uvex_Occhiali";

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