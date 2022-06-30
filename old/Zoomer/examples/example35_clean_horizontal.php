<!DOCTYPE html>
<html>
	<head>
		<title>35_clean_horizontal</title>
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
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">

		<!-- Include axZm.thumbSlider -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- Include jquery.axZm.imageCropLoad.js -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>

		<!-- A small function to add title button which will expend to full description -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.expButton.css"></link>
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

			#cropSliderWrap{
				position: relative;
				margin-top: 10px;
				height: 100px; 
				left: 0px; 
				bottom: 0px;
			}

			#cropSlider{
				position: absolute;
				width: 100%; 
				height: 100%;
			}


			#axZmFsSpaceBottom div{
				box-sizing: border-box;
			}

			#axZmFsSpaceBottom{
				background-color: #3E3E3E;
			}

			.axZmThumbSlider li.horizontal.first {
				margin-left: 1px !important;
			}

			.axZmThumbSlider li.horizontal.last {
				margin-right: 1px !important; 
			}

			#axZmFsSpaceBottom .axZmThumbSlider li.horizontal.last {
				margin-right: 6px !important;
			}

			#axZmFsSpaceBottom .axZmThumbSlider li.horizontal.first {
				margin-left: 6px !important;
			}

			.axZmThumbSlider_wrap.horizontal{
				border-width: 0px;
			}

			.axZmThumbSlider li img.thumb{
				border-radius: 5px;
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
			<h1 class="page-header">Cropped thumbs <strong>horizontal gallery</strong> with 2D zoomTo or 360 degree product spinTo and zoomTo (product tour)</h1>
			<p>This example loads the results of what has been produced in <a href="example35.php">example35.php</a>
				into horizontal thumbnail gallery / slider. The design of the gallery and AJAX-ZOOM player is fully skinable.
			</p>

			<!-- Responsive container using, padding bottom defines the aspect ratio 
			padding bottom could be refined with @media queries as an idea... -->
			<div class="az_embed-responsive" style="padding-bottom: 50%;">

				<!-- Div where AJAX-ZOOM is loaded into -->
				<div class="az_embed-responsive-item" id="azParentContainer">
					<div style="padding: 20px">Loading, please wait...</div>
				</div>
			</div>

			<!-- Thumb slider with croped images -->
			<div id="cropSliderWrap">
				<div id="cropSlider">
					<ul></ul>
				</div>
			</div>

			<script type="text/javascript">
				;(function($) {
					// Init the slider
					// Thumbs will be appended instantly
					// More info about thumbslider: /axZm/extensions/axZmThumbSlider/
					$('#cropSlider').axZmThumbSlider({
						orientation: 'horizontal',
						btnOver: true,
						btnHidden: true,
						btnFwdStyle: {borderRadius: 5, height: 32, width: 32, right: 4, top: 33, lineHeight: '30px'},
						btnBwdStyle: {borderRadius: 5, height: 32, width: 32, left: 4, top: 33, lineHeight: '30px'},

						thumbLiStyle: {
							height: 90,
							width: 90,
							lineHeight: 90,
							margin: 3,
							borderRadius: 5
						}
					});

					// AJAX-ZOOM
					// Create empty object (no not rename here)
					var ajaxZoom = {}; 

					// Define callbacks, for complete list check the docs
					ajaxZoom.opt = {

						onLoad: function() { 
							// Load crop thumbs
							// You can also pass the path over query string, e.g.
							// example35.php?cropJsonURL=../pic/cropJSON/eos_1100d.json 
							// and skip cropJsonURL key in $.axZmImageCropLoad
							$.axZmImageCropLoad({
								cropJsonURL: '../pic/cropJSON/eos_1100d_demo.json',
								sliderID: 'cropSlider',
								spinToSpeed: '2500', // as string to override spinDemoTime when clicked on the thumbs,
								spinToMotion: 'easeOutQuint', // optionally pass spinToMotion to override spinToMotion set in config file, def. easeOutQuad
								handleTexts: function(title, description) {
									// One of the possible things to do with title and description
									// e.g. display texts with jquery.axZm.expButton.js (AJAX-ZOOM additional plugin)
									$.axZmEb({
										title: title,
										descr: description,
										gravity: 'top', // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
										marginY: 5,  // vertical margin depending on gravity
										zoomSpinPanRemove: 'cropSlider', // removes button / layer when there is some action inside AJAX-ZOOM
										autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
										removeOnClose: false // removes button when extended state is closed
									});
								}
							});

							// Possible motions types: 
							// 'swing', 'linear', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 
							// 'easeOutQuart','easeInOutQuart', 'easeInQuint','easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine', 
							// 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic',
							// 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce'

							// This would be the code for additionally loading hotspots made e.g. with example33.php
							// $.fn.axZm.loadHotspotsFromJsFile('../pic/hotspotJS/eos_1100D.js', false);
						},

						onBeforeStart: function() {
							// most AJAX-ZOOM options can be also set with JS
							// Chnage e.g. position of the map
							// jQuery.axZm.mapPos = 'bottomLeft';

							if ($.axZm.spinMod) {
								jQuery.axZm.restoreSpeed = 300;
							} else {
								jQuery.axZm.restoreSpeed = 0;
							}

							// Disable all buttons
							$.axZm.mNavi.enabled = false;

							// Set extra space to the right at fullscreen mode for the crop gallery
							jQuery.axZm.fullScreenSpace = {
								top: 0,
								right: 0,
								bottom: $('#cropSlider').outerHeight() + 6,
								left: 0,
								layout: 1
							};
						},
						onFullScreenSpaceAdded: function() {
							jQuery('#cropSlider')
							.css({
								top: 4,
								left: 0,
								zIndex: 555
							})
							.appendTo('#axZmFsSpaceBottom');
						},
						onFullScreenClose: function() {
							jQuery.fn.axZm.tapShow();

							jQuery('#cropSlider')
							.css({
								top: '',
								left: '',
								zIndex: ''
							})
							.appendTo('#cropSliderWrap');
						},

						onFullScreenCloseEndFromRel: function() {

							// Restore position of the slider
							jQuery('#cropSlider')
							.css({
								bottom: '',
								right: '',
								zIndex: ''
							})
							.appendTo('#cropSliderWrap');
						}
					};

					// Define the path to the axZm folder, adjust the path if needed!
					ajaxZoom.path = "../axZm/"; 

					// Define your custom parameter query string
					// example=spinIpad has many presets for 360 images
					// 3dDir - best of all absolute path to the folder with 360/3D images
					// if it is a 2D image just pass zoomData=/path/to/your/image/image1.jpg|/path/to/other/image/image2.jpg instead of 3dDir
					// ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali"; 
					// Define your custom parameter query string

					ajaxZoom.parameter = "example=spinIpad&3dDir=../pic/zoom3d/Uvex_Occhiali";

					ajaxZoom.divID = 'azParentContainer';

					// Load AJAX-ZOOM not responsive
					/*
					$.fn.axZm.load({
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
				})(jQuery);
			</script>

			<div id="docuParent" style="margin-top: 100px;">
				<a class="btn btn-info" onclick="$.ajax({url: 'extensions_doc/docu_imageCropLoad.inc.html', complete: function(r){$('#docuParent').html(r.responseText)}})">Load documentaion for $.axZmImageCropLoad</a>
			</div>
		</div>
	</body>
</html>