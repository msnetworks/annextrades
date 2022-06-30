<!DOCTYPE html>
<html>
	<head>
		<title>35_gallery</title>
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

		<!-- Include jquery.axZm.imageCropLoad.js -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.imageCropLoad.css" type="text/css">
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>

		<!-- A small function to add title button which will expend to full description -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.expButton.css" type="text/css" />
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>

		<!-- Optionally: axZm.thumbSlider plugin is only needed if you use axZm.expButton above and whant to scroll overflow not with the native browser scrollbar-->
		<link rel="stylesheet" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" type="text/css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css" id="exampleCss">
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

			/* play with thumbnails */
			@media (max-width: 1201px) {
				#azThumbsCropArea li {
					width: 100px;
					height: 100px;
				}
			}
			@media (max-width: 991px) {
				#azThumbsCropArea li {
					width: 11.4%;
					padding: 0;
					border: 0;
					height: auto;
					margin: 0 1% 1% 0;
				}
				#axZm_zoomCustomNavi{
					display: none !important;
				}
			}
			@media (max-width: 375px) {
				#azThumbsCropArea li {
					width: 23.5%;
					padding: 0;
					border: 0;
					height: auto;
					margin: 0 1% 1% 0;
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
		<div class="container">
			<h1 class="page-header">Cropped thumbs gallery without slider and free layout</h1>
			<p>Previous examples use "thumb slider", this one does not. The thumbnails can be loaded anywhere.
			</p>

			<!-- This example uses bootstrap CSS classes -->
			<div class="row">
				<div class="col-md-9 col-md-push-3">
					<!-- Responsive container using, padding bottom defines the aspect ratio 
					padding bottom could be refined with @media queries as an idea... -->
					<div class="az_embed-responsive" style="padding-bottom: 68%;">
						<div class="az_embed-responsive-item" id="azParentContainer">
							<!-- Content inside target will be removed -->
							<div style="padding: 20px">Loading, please wait...</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-md-pull-9">
					<!-- Cropped thumbs -->
					<div id="azThumbsCropArea" style="position: relative; margin-top: 20px;">
					</div>
				</div>
			</div>

			<script type="text/javascript" id="exampleJs">
				// AJAX-ZOOM
				// Create empty jQuery object (no not rename here)
				var ajaxZoom = {}; 

				// Define the path to the axZm folder, adjust the path if needed!
				ajaxZoom.path = "../axZm/"; 

				// Define your custom parameter query string
				// example=spinIpad has many presets for 360 images
				// 3dDir - best of all absolute path to the folder with 360/3D images
				// if it is a 2D image just pass zoomData=/path/to/your/image/image1.jpg|/path/to/other/image/image2.jpg instead of 3dDir
				// ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali"; 
				// Define your custom parameter query string
				ajaxZoom.parameter = "example=spinIpad";
				ajaxZoom.parameter += '&3dDir=../pic/zoom3d/Uvex_Occhiali';

				// Id of element where AJAX-ZOOM will be loaded into
				ajaxZoom.divID = "azParentContainer";

				// Define callbacks, for complete list check the docs
				ajaxZoom.opt = {
					onStart: function() {
						$.axZm.useMap = false;
						$.axZm.gallerySlideNavi = false;
					},
					onLoad: function() { 
						// Load crop thumbs
						// You can also pass the path over query string, e.g.
						// example35.php?cropJsonURL=../pic/cropJSON/eos_1100d.json 
						// and skip cropJsonURL key in $.axZmImageCropLoad
						$.axZmImageCropLoad({
							cropJsonURL: "../pic/cropJSON/eos_1100d_demo.json",
							sliderID: null, // we do not use slider here

							thumbsContainerID: 'azThumbsCropArea', // without slider
							thumbsContainerUlClass: 'azThumbCrop', // class which will be added to the UL element
							thumbsContainerLiCss: { // quickly overwrite css e.g. margin of the li (thumbs)
								/* width: 100,
								height: 100,
								marginBottom: 16*/
							},
							cropImgParam: {
								width: 200,
								height: 200
							},
							thumbsContainerLiDescr: true, // add title from crop data to the thumb

							spinToSpeed: "2500", // as string to override spinDemoTime when clicked on the thumbs
							spinToMotion: "easeOutQuint", // optionally pass spinToMotion to override spinToMotion set in config file, def. easeOutQuad
							handleTexts: function(title, description) {
								// One of the possible things to do with title and description
								// e.g. display texts with jquery.axZm.expButton.js (AJAX-ZOOM additional plugin)
								$.axZmEb({
									title: title,
									descr: description,
									gravity: "top", // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
									marginX: 5, // horizontal margin
									marginY: -2,  // vertical margin depending on gravity
									zoomSpinPanRemove: "azThumbsCropArea", // removes button / layer when there is some action inside AJAX-ZOOM
									autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
									removeOnClose: false // removes button when extended state is closed
								});
							}
						});

						// This would be the code for additionally loading hotspots made e.g. with example33.php
						//jQuery.aZcropEd.getJSONdataFromFile("../pic/cropJSON/eos_1100d.json");
					},
					onBeforeStart: function() {

						if ($.axZm.spinMod) {
							jQuery.axZm.restoreSpeed = 300;
						}else{
							jQuery.axZm.restoreSpeed = 0;
						}

						//jQuery.axZm.fullScreenCornerButton = false;
						jQuery.axZm.fullScreenExitText = false;
					}
				};

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
			</script>
			
			<div class="row">
				<div class="col-lg-12">
					<h3>JavaScript and CSS in head</h3>
					<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
					<?php
					echo '<pre style="display: none;"><code class="language-markup">';
					echo htmlspecialchars('
		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Include axZm.thumbSlider -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- Include jquery.axZm.imageCropLoad.js -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>

		<!-- A small function to add title button which will expend to full description -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.expButton.css"></link>
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>
					');
					echo '</code></pre>';
					?>

					<h3>CSS</h3>
					<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
					<pre style="display: none;"><code class="language-css" id="exampleCssPrism"></code></pre>
					<script>
						// this is only for demo to show css code
						$('#exampleCssPrism').html($('#exampleCss').html());
					</script>
					<h3>HTML markup</h3>
					<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
					<?php
					echo '<pre style="display: none;"><code class="language-markup">';
					echo htmlspecialchars('
<!-- This example uses bootstrap CSS classes -->
<div class="row">
	<div class="col-md-9 col-md-push-3">
		<!-- Responsive container using, padding bottom defines the aspect ratio 
		padding bottom could be refined with @media queries as an idea... -->
		<div class="az_embed-responsive" style="padding-bottom: 68%;">
			<div class="az_embed-responsive-item" id="azParentContainer">
				<!-- Content inside target will be removed -->
				<div style="padding: 20px">Loading, please wait...</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-md-pull-9">
		<!-- Cropped thumbs -->
		<div id="azThumbsCropArea" style="position: relative; margin-top: 20px;">
		</div>
	</div>
</div>
					');
					echo '</code></pre>';
					?>
					<h3>Javascript</h3>
					<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
					<pre style="display: none;"><code class="language-js" id="exampleJsPrism"></code></pre>
					<script>
						// this is only for demo to show js code
						$('#exampleJsPrism').html($('#exampleJs').html());
					</script>
					<div style="margin-top: 40px;">
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