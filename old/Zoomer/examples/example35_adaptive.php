<!DOCTYPE html>
<html>
	<head>
		<title>35_adaptive</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
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

			/* padding bottom defines the aspect ratio */
			#playerOuterWrap {
				padding-bottom: 60%;
			}

			/* wrapper for player and gallery */
			#playerInnerWrap {
				position: relative;
				height: 100%;
				border-color: #AAA;
				border-style: solid;
				border-width: 1px 1px 1px 1px;
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
				right: -1px;
			}

			#cropSliderVertical .axZmThumbSlider_wrap {
				border-right-width: 0 !important;
			}

			#cropSliderHorizontal .axZmThumbSlider_wrap {
				border-bottom-width: 0 !important;
			}

			/* override some css of the slider, e.g. color of selct border */
			#cropSliderHorizontal li.selected,
			#cropSliderVertical li.selected {
				border-color: #2379b5;
				box-shadow: #2379b5 0px 0px 0px 1px;
			}

			#cropSliderWrapHorizontal {
				position: relative;
				background-color: #FFFFFF;
				width: 100%;
				height: 99px;
			}

			#cropSliderHorizontal {
				height: 100px;
				position: relative;
				width: 100%;
			}

			/* Portrait */
			@media screen and (orientation:portrait) {
				#cropSliderWrapVertical {
					/* hide vertical gallery */
					display: none;
				}
				#playerInnerWrap {
					/* padding to the bottom where horizontal gallery is placed */
					padding-bottom: 99px;
					padding-right: 0;
				}
				#playerOuterWrap {
					/* set / reset aspect ratio */
					padding-bottom: 70%;
					padding-bottom: calc(60% + 100px);
				}
			}
			/* Landscape */
			@media screen and (orientation:landscape) {
				#cropSliderWrapHorizontal {
					/* hide horizontal gallery */
					display: none;
				}
				#playerInnerWrap {
					/* remove bpadding at bottom */
					padding-bottom: 0;
					/* padding to the right where vertical gallery is placed */
					padding-right: 99px;
				}
				#playerOuterWrap {
					/* set / reset aspect ratio */
					padding-bottom: 60%;
				}
			}

			#axZmFsSpaceRight div,
			#axZmFsSpaceBottom div {
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
			<h1 class="page-header">AJAX-ZOOM with <strong>adaptive (vertical / horizontal) galleries</strong> for 2D or 360 degree product tour</h1>
			<p>This example loads the results of what has been produced in <a href="example35.php">example35.php</a>. 
				Both galleries - vertical and horizontal are loaded at the same time and are shown / hidden over CSS media queries 
				depending on window portrait / landcrape mode. <strong>Resize the browser window to see this adaptive effect.</strong>
				All code lines are commented. The design of the galleries and AJAX-ZOOM player is fully skinable.
			</p>
			<!-- Responsive container using, padding bottom defines the aspect ratio 
				padding bottom could be refined with @media queries as an idea... -->
			<div class="az_embed-responsive" id="playerOuterWrap">

				<!-- limit height of the embed-responsive-item to somewhat less than browser height -->
				<div class="az_embed-responsive-item">

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

						<!-- Horizontal thumb slider with croped images -->
						<div id="cropSliderWrapHorizontal">
							<div id="cropSliderHorizontal">
								<ul></ul>
							</div>
						</div>

					</div>
				</div>
			</div>

			<script type="text/javascript" id="exampleJs">
			;(function($) {
				// Init the vertical slider
				// Thumbs will be appended instantly with $.axZmImageCropLoad
				// More info about thumbslider: /axZm/extensions/axZmThumbSlider/
				$("#cropSliderVertical").axZmThumbSlider({
					orientation: "vertical",
					/* btn: false, */
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

				// Init the horizontal slider
				// More info about thumbslider: /axZm/extensions/axZmThumbSlider/
				$("#cropSliderHorizontal").axZmThumbSlider({
					orientation: "horizontal",
					/* btn: false, */
					btnOver: true,
					btnHidden: true,
					btnFwdStyle: {borderRadius: 0, width: 20, right: -1, height: 100},
					btnBwdStyle: {borderRadius: 0, width: 20, left: -1, height: 100},
					thumbLiStyle: {
						height: 90,
						width: 90,
						lineHeight: 90,
						borderRadius: 0,
						margin: 3
					}
				});

				// Helper function
				var isLandscapeMode = function() {
					return $(window).width() >= $(window).height();
				};

				// AJAX-ZOOM
				// Create empty object
				var ajaxZoom = {};

				// Define the path to the axZm folder, adjust the path if needed!
				ajaxZoom.path = "../axZm/"; 

				// ID of element where AJAX-ZOOM will be loaded into
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

						var cropLoadObj = {
							cropJsonURL: "../pic/cropJSON/eos_1100d_demo.json",
							sliderID: "", // ID of the slider
							spinToSpeed: "2500", // as string to override spinDemoTime when clicked on the thumbs
							spinToMotion: "easeOutQuint", // optionally pass spinToMotion to override spinToMotion set in config file, def. easeOutQuad
							handleTexts: function(title, description) {
								// One of the possible things to do with title and description
								// e.g. display texts with $.axZm.expButton.js (AJAX-ZOOM additional plugin)
								$.axZmEb({
									title: title,
									descr: description,
									gravity: "top", // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
									marginY: 5,  // vertical margin depending on gravity
									zoomSpinPanRemove: "#cropSliderVertical,#cropSliderHorizontal", // removes button / layer when there is some action inside AJAX-ZOOM
									autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
									removeOnClose: false // removes button when extended state is closed
								});
							}
						};

						// Load slider for vertical gallery
						$.axZmImageCropLoad($.extend({}, cropLoadObj, {sliderID: "cropSliderVertical"}));

						// Load horizontal slider
						$.axZmImageCropLoad($.extend({}, cropLoadObj, {sliderID: "cropSliderHorizontal"}));

						// Possible motions types: 
						// "swing", "linear", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeInQuart", 
						// "easeOutQuart","easeInOutQuart", "easeInQuint","easeOutQuint", "easeInOutQuint", "easeInSine", "easeOutSine", "easeInOutSine", 
						// "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeInElastic", "easeOutElastic",
						// "easeInOutElastic", "easeInBack", "easeOutBack", "easeInOutBack", "easeInBounce", "easeOutBounce", "easeInOutBounce"

						// This would be the code for additionally loading hotspots made e.g. with example33.php
						// $.fn.axZm.loadHotspotsFromJsFile('../pic/hotspotJS/eos_1100D.js', false);
					},
					onBeforeStart: function() {
						// most AJAX-ZOOM options can be also set with JS
						if ($.axZm.spinMod) {
							$.axZm.restoreSpeed = 300;
						} else {
							$.axZm.restoreSpeed = 0;
						}

					},
					onFullScreenStartFromRel: function() {
						// Set extra space to the right or bottom at fullscreen mode for the crop gallery
						$.fn.axZm.setFullScreenSpace({
							right: isLandscapeMode() ? $("#cropSliderVertical").outerWidth() : 0,
							top: 0,
							bottom: !isLandscapeMode() ? $("#cropSliderVertical").outerHeight() : 0,
							left: 0,
							layout: 1
						});
					},
					onFullScreenSpaceAdded: function() {
						// Append galleries to the extra space to the right or bottom
						if (isLandscapeMode()) {
							$("#cropSliderVertical")
							.css({right: 0, zIndex: 555})
							.appendTo("#axZmFsSpaceRight");
						} else {
							$("#cropSliderHorizontal")
							//.css({bottom: 0, right: 0, height: "100%", zIndex: 555})
							.appendTo("#axZmFsSpaceBottom");
						}
					},
					onFullScreenCloseEndFromRel: function() {
						// Show over player elements if they have been hidden
						$.fn.axZm.tapShow();

						// Restore position of the sliders
						$("#cropSliderVertical")
						.css({right: "", zIndex: ""})
						.appendTo("#cropSliderWrapVertical");

						$("#cropSliderHorizontal")
						//.css({bottom: "", right: "", zIndex: ""})
						.appendTo("#cropSliderWrapHorizontal");
					}
				};

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

			<div>
				<h3>JavaScript and CSS in head</h3>
				<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
				<?php
				echo '<pre style="display: none;"><code class="language-markup">';
				echo htmlspecialchars('
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
<!-- Responsive container using, padding bottom defines the aspect ratio 
	padding bottom could be refined with @media queries as an idea... -->
<div class="az_embed-responsive" id="playerOuterWrap">

	<!-- limit height of the embed-responsive-item to somewhat less than browser height -->
	<div class="az_embed-responsive-item">

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

			<!-- Horizontal thumb slider with croped images -->
			<div id="cropSliderWrapHorizontal">
				<div id="cropSliderHorizontal">
					<ul></ul>
				</div>
			</div>

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
				<?php
				if (file_exists(dirname(__FILE__).'/extensions_doc/docu_imageCropLoad.inc.html')) {
					echo '<h3>$.axZmImageCropLoad documentation</h3>';
					include dirname(__FILE__).'/extensions_doc/docu_imageCropLoad.inc.html';
				}
				?>
				<?php
				if (file_exists(dirname(__FILE__).'/footer.php')) {
					// This is only for the demo, you can remove it
					define('COMMENTS_BOOTSTRAP', true);
					include dirname(__FILE__).'/footer.php';
				}
				?>
			</div>

			<!-- Link load documentation -->
			<p id="docuParent">
				<script>var optionsHeader = '$.axZmImageCropLoad documentation'; var optionsText = '';</script>
				<a href="javascript: void(0)" onclick="$.ajax({url: 'extensions_doc/docu_imageCropLoad.inc.html', cache: false, complete: function(r){$('#docuParent').html(r.responseText)}})">Load documentaion</a> for $.axZmImageCropLoad
			</p>
		</div>
	</body>
</html>