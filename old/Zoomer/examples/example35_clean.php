<!DOCTYPE html>
<html>
	<head>
		<title>35_clean</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not really needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Include axZm.thumbSlider plugin -->
		<link rel="stylesheet" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" type="text/css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- Include jquery.axZm.imageCropLoad.js -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>

		<!-- A small function to add title button which will expend to full description -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.expButton.css" type="text/css" />
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>

		<style type="text/css">
			/* copy of bootstraps embed-responsive and embed-responsive-item CSS classes
				if bootstrap or simmilar is included you could use them */
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

			/* wrapper for player and gallery */
			#playerInnerWrap {
				position: relative;
				height: 100%;
				border-left: 1px solid #AAAAAA;
				border-top: 1px solid #AAAAAA;
				border-bottom: 1px solid #AAAAAA;
				/* padding to the right where vertical gallery is placed */
				padding-right: 100px;
			}

			/* Div where AJAX-ZOOM is loaded into */
			#azParentContainer {
				position: relative;
				width: 100%;
				height: 100%
			}

			/* we need a container to change the gallery location in fullscreen mode */
			#cropSliderWrapVertical {
				position: absolute;
				background-color: #FFFFFF;
				z-index: 11;
				width: 100px; 
				height: 100%; 
				right: 0px; 
				top: 0px;
			}

			#cropSliderVertical {
				position: absolute;
				width: 100px; 
				height: 100%;
			}

			#cropSliderVertical li.selected {
				border-color: #2379b5;
				box-shadow: #2379b5 0px 0px 0px 1px;
			}

			#axZmFsSpaceRight div {
				box-sizing: border-box;
			}

			.axZmThumbSlider li.vertical.first {
				margin-top: 3px !important;
			}

			.axZmThumbSlider li.vertical.last {
				margin-bottom: 3px !important; 
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
			<h1 class="page-header">Cropped thumbs <strong>vertical gallery</strong> with 2D zoomTo or 360 degree product spinTo and zoomTo (product tour)</h1>
			<p>This example loads the results of what has been produced in <a href="example35.php">example35.php</a>
				into verical thumbnail gallery / slider. The design of the gallery and AJAX-ZOOM player is fully skinable.
			</p>
			<!-- Responsive container using, padding bottom defines the aspect ratio 
				padding bottom could be refined with @media queries as an idea... -->
			<div class="az_embed-responsive" style="padding-bottom: 60%;">

				<!-- limit height of the embed-responsive-item to somewhat less than browser height -->
				<div class="az_embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">

					<!-- Need this for padding to the right where vertical gallery is placed -->
					<div id="playerInnerWrap">

						<!-- Div where AJAX-ZOOM is loaded into -->
						<div id="azParentContainer">
							<!-- Content inside target will be removed -->
							<div style="padding: 20px">Loading, please wait...</div>
						</div>

						<!-- Vertical thumb slider with croped images -->
						<div id="cropSliderWrapVertical">
							<div id="cropSliderVertical">
								<ul></ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				// Init the slider
				// Thumbs will be appended instantly with $.axZmImageCropLoad
				jQuery("#cropSliderVertical").axZmThumbSlider({
					orientation: "vertical",
					btnOver: true,
					btnHidden: true,
					btnFwdStyle: {borderRadius: 0, height: 20, bottom: -1, lineHeight: "20px"},
					btnBwdStyle: {borderRadius: 0, height: 20, top: -1, lineHeight: "20px"},

					thumbLiStyle: {
						height: 90,
						width: 90,
						lineHeight: 90,
						borderRadius: 0,
						margin: 3
					}
				});

				// AJAX-ZOOM
				// Create empty jQuery object (no not rename here)
				var ajaxZoom = {}; 

				// Define the path to the axZm folder, adjust the path if needed!
				ajaxZoom.path = "../axZm/"; 

				// Id of element where AJAX-ZOOM will be loaded into
				ajaxZoom.divID = "azParentContainer";

				// Define your custom parameter query string
				// example=spinIpad has many presets for 360 images
				// 3dDir - best of all absolute path to the folder with 360/3D images
				// if it is a 2D image just pass zoomData=/path/to/your/image/image1.jpg|/path/to/other/image/image2.jpg instead of 3dDir
				// ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali"; 
				// Define your custom parameter query string
				ajaxZoom.parameter = "example=spinIpad";

				ajaxZoom.parameter += "&3dDir=../pic/zoom3d/Uvex_Occhiali";

				// Define callbacks, for complete list check the docs
				ajaxZoom.opt = {
					onLoad: function() {
						// Load crop thumbs
						// You can also pass the path over query string, e.g.
						// example35.php?cropJsonURL=../pic/cropJSON/eos_1100d.json 
						// and skip cropJsonURL key in $.axZmImageCropLoad
						$.axZmImageCropLoad({
							cropJsonURL: "../pic/cropJSON/eos_1100d_demo.json",
							sliderID: "cropSliderVertical",
							spinToSpeed: "2500", // as string to override spinDemoTime when clicked on the thumbs
							spinToMotion: "easeOutQuint", // optionally pass spinToMotion to override spinToMotion set in config file, def. easeOutQuad
							handleTexts: function(title, description) {
								// One of the possible things to do with title and description
								// e.g. display texts with jquery.axZm.expButton.js (AJAX-ZOOM additional plugin)
								$.axZmEb({
									title: title,
									descr: description,
									gravity: "top", // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
									marginY: 5,  // vertical margin depending on gravity
									zoomSpinPanRemove: "cropSliderVertical", // removes button / layer when there is some action inside AJAX-ZOOM
									autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
									removeOnClose: false // removes button when extended state is closed
								});
							}
						});
						// Possible motions types: 
						// "swing", "linear", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeInQuart", 
						// "easeOutQuart","easeInOutQuart", "easeInQuint","easeOutQuint", "easeInOutQuint", "easeInSine", "easeOutSine", "easeInOutSine", 
						// "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeInElastic", "easeOutElastic",
						// "easeInOutElastic", "easeInBack", "easeOutBack", "easeInOutBack", "easeInBounce", "easeOutBounce", "easeInOutBounce"


						// This would be the code for additionally loading hotspots made e.g. with example33.php
						// $.fn.axZm.loadHotspotsFromJsFile('../pic/hotspotJS/eos_1100D.js', false);
					},
					onBeforeStart: function(){

						if ($.axZm.spinMod) {
							jQuery.axZm.restoreSpeed = 300;
						}else{
							jQuery.axZm.restoreSpeed = 0;
						}

						//jQuery.axZm.fullScreenCornerButton = false;
						jQuery.axZm.fullScreenExitText = false;

						// Chnage position of the map
						//jQuery.axZm.mapPos = "bottomLeft";

						// Set extra space to the right at fullscreen mode for the crop gallery
						jQuery.axZm.fullScreenSpace = {
							right: $("#cropSliderVertical").outerWidth(),
							top: 0,
							bottom: 0,
							left: 0,
							layout: 1
						};
					},
					onFullScreenSpaceAdded: function() {
						jQuery("#cropSliderVertical")
						.css({bottom: 0, right: 0, height: "100%", zIndex: 555})
						.appendTo("#axZmFsSpaceRight");
					},
					onFullScreenClose: function(){
						jQuery.fn.axZm.tapShow();

						jQuery("#cropSliderVertical")
						.css({bottom: "", right: "", zIndex: ""})
						.appendTo("#cropSliderWrapVertical");
					},
					onFullScreenCloseEndFromRel: function(){
						// Restore position of the slider
						jQuery("#cropSliderVertical")
						.css({bottom: "", right: "", zIndex: ""})
						.appendTo("#cropSliderWrapVertical");
					}
				};

				// Load AJAX-ZOOM not responsive
				/*
				jQuery.fn.axZm.load({
					opt: ajaxZoom.opt,
					path: ajaxZoom.path,
					postMode: false,
					apiFullscreen: false,
					parameter: ajaxZoom.parameter,
					divID: ajaxZoom.divID
				});
				*/

				// open AJAX-ZOOM responsive
				// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
				window.fullScreenStartSplash = {enable: false, className: false, opacity: 0.75};
				$.fn.axZm.openResponsive(
					ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
					ajaxZoom.parameter, // Defines which images and which options set to load
					ajaxZoom.opt, // callbacks
					ajaxZoom.divID, // target - container ID (default 'window' - fullscreen)
					false, // apiFullscreen- use browser fullscreen mode if available
					true, // disableEsc - prevent closing with Esc key
					false // postMode - use POST instead of GET
				);
			</script>

			<div id="docuParent" style="margin-top: 100px;">
				<a class="btn btn-info" onclick="$.ajax({url: 'extensions_doc/docu_imageCropLoad.inc.html', complete: function(r){$('#docuParent').html('<h3>Documentaion for $.axZmImageCropLoad</h3>' + r.responseText)}})">Load documentaion for $.axZmImageCropLoad</a>
			</div>
		</div>
	</body>
</html>