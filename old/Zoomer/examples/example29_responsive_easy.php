<!DOCTYPE html>
<html itemscope="itemscope" itemtype="https://schema.org/WebPage">
	<head>
		<title>29_responsive_easy</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!--  Include jQuery core into head section if not already present -->
		<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  AJAX-ZOOM javascript -->
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
		<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

		<!-- JavaScript for 360/3D gallery -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.360Gallery.js"></script>
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.360Gallery.css" />

		<!-- Include axZm.thumbSlider -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- IE < 9 @media query support -->
		<script src="../axZm/plugins/css3-mediaqueries.min.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css" id="exampleCss">
			/* Container where AJAX-ZOOM will be loaded into */
			#axZmPlayerContainer {
				height: 400px;
				height: 50vh;
				position: relative;
			}

			/* Container for thumb slider */
			#spinGalleryContainer {
				height: 100px;
				overflow: hidden;
			}

			/* Thumb slider */
			#spinGallery {
				height: 100px;
			}
		</style>

		<style type="text/css">
			/* overwrite some css from /axZm/axZm.css */
			.axZm_zoomMapSel {
				border-color: #0191FF;
			}
			.axZm_zoomMapSelArea {
				background-color: transparent;
			}
			.axZm_spinPreloaderBar {
				background-color: #0191ff;
				background-image: none;
			}
			.axZm_spinPreloaderHolder {
				background-image: url('../axZm/icons/tr_black_50.png');
				border-radius: 0px;
			}
			.axZm_zoomCustomNaviFS {
				display: none !important;
			}
			.axZm_displayBlockImportant {
				display: block !important;
			}
			#axZmFsSpaceBottom,
			#axZmFsSpaceBottomTempRemove {
				background-color: #EEE;
			}

			/* overwrite some css from /axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css */
			#spinGallery li {
				background-color: #FFF!important;
				box-shadow: none;
			}
			#spinGallery li.selected {
				box-shadow: 0 0 0 1px #AAA;
			}
			#spinGallery .axZmThumbSliderDescription {
				font-size: 10px;
				bottom: 2px;
			}

			/* responsive page layout, not needed */
			#topContainer {
				min-height: 110px;
				background-color: #B9CC52;
				position: relative
			}
			#leftSide {
				width: 66%;
				background-color: #FFF;
			}
			#rightSide {
				position: absolute;
				top: 0;
				right: 0;
				width: 34%;
				height: 100%;
				background-color: #F2D3A2;
			}

			/* media query to adjust the layout if it is lesser then 800px width */
			@media only screen and (max-width: 800px){
				#leftSide {
					width: 100%;
				}
				#rightSide {
					position: relative;
					width: auto;
					padding: 5px;
					min-height: 100px;
					background-color: #F2D3A2;
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
		<div id="topContainer">
			<h2 style="margin: 0; padding: 25px 10px 10px 10px;">
				"Simple" responsive multimedia gallery with 360° product spins, images with progressive zoom feature and videos
			</h2>
		</div>

		<div style="position: relative">
			<div id="leftSide">
				<!-- Container where AJAX-ZOOM will be loaded into -->
				<div id="axZmPlayerContainer">
					<!-- This div will be removed after anything is loaded into "axZmPlayerContainer" div -->
					<div style="padding: 20px; font-size: 16pt">Loading, please wait...</div>
				</div>

				<div id="spinGalleryContainer">
					<!-- Thumb slider -->
					<div id="spinGallery">
						<!-- Temp message that will be removed after the slider initialization -->
						<div id="spinGallery_temp" class="spinGallery_temp">
							Gallery with 360 objects will be loaded after the first spin is fully loaded, please wait...
						</div>
					</div>
				</div>
			</div>

			<div id="rightSide" style="overflow: auto">
				<div style="padding: 10px;">
					<h3>About</h3>
					<p>AJAX-ZOOM is fully integrateable into any responsive layout. 
						In this example AJAX-ZOOM settings 
						are set the way that the user has only the possibility to spin at not zoomed state;
						zoom on click goes down to 100%; an other click at zoomed state will zoom out again;
						additionally a button appears for zoom out; with "prevNextAllData" option enabled 
						it is farthermore posssible to switch between different types of data (video, 360, plain images) 
						over left/right buttons, also at fullscreen mode.
					</p>
					<p>The initialization of AJAX-ZOOM and the gallery is done over single jQuery.axZm360Gallery extension. 
						Nevertheless you can pass additional options to each of the scripts (main AJAX-ZOOM and the thumbslider) 
						over jQuery.axZm360Gallery options. So here we extensively use "azOptions" object, 
						"axZmCallBacks" object and "onBeforeStart" AJAX-ZOOM callback to overwrite AJAX-ZOOM options
						which are normally set in /axZm/zoomConfig.inc.php, /axZm/zoomConfigCustom.inc.php or /zoomConfigCustomAZ.inc.php; 
						So this examples might be also interesting for developers as even the config files are not modified.
					</p>
				</div>
			</div>
		</div>

		<script type="text/javascript" id="exampleJs">
			// Load 360 gallery and first spin
			jQuery.axZm360Gallery ({
				axZmPath: "../axZm/", // Path to /axZm/ directory, e.g. "/test/axZm/"
				divID: "axZmPlayerContainer", // The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
				embedResponsive: true, // if divID is responsive, set this to true
				spinGalleryContainerID: "spinGalleryContainer", // Parent container of gallery div
				spinGalleryID: "spinGallery",
				spinGallery_tempID: "spinGallery_temp",

				// Configuration set value which is passed to ajax-zoom when using "galleryData"; 
				// some default settings from /axZm/zoomConfig.inc.php are overridden in 
				// /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 'spinAnd2D_easy'){...;
				// additionally to $_GET['example'], image360 is passed over query string as a paramter 
				// when 360 or 3D are loaded, so it is available in the config file as $_GET['image360'] 
				// and the configuration set can be differed from plain images.
				exampleData: "spinAnd2D_easy",

				// Over galleryData" option you can precisely define which 360s or 3D have to beloaded. 
				// Additionally you can also define regular 2D images and videos located at 
				// some straming platform like youtube, iframed content or load content over ajax
				galleryData: [
					["image360", "/pic/zoom3d/Uvex_Occhiali"],
					["youtube", "YzVl970CUoo"],
					["imageZoom", "/pic/zoom/furniture/furniture_001.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_002.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_003.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_004.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_005.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_006.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_007.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_008.jpg"],
					["imageZoom", "/pic/zoom/furniture/furniture_009.jpg"]
				],

				firstToLoad: "image360",

				prevNextAllData: {
					enabled: true,
					next: {file: "[buttonSet]/zoombutton_slide_vert_next", ext: "png", w: 20, h: 100},
					prev: {file: "[buttonSet]/zoombutton_slide_vert_prev", ext: "png", w: 20, h: 100},
					posNext: {right: 0, top: "50%", marginTop: -50, position: "absolute", zIndex: 1002},
					posPrev: {left: 0, top: "50%", marginTop: -50, position: "absolute", zIndex: 1002}
				},

				// Some of the AJAX-ZOOM option normally set in zoomConfig.inc.php and zoomConfigCustom.inc.php 
				// can be set directly as js var in this callback
				azOptions: {
					mapPos: "bottomRight",
					mapBorder: {top: 0, right: 0, bottom: 0, left: 0},
					mapOpacity: 0.5,
					zoomMapSelOpacity: 0,

					spinPreloaderSettings: {
						text: "",
						width: "100%",
						height: 7,
						gravity: "bottom",
						gravityMargin: 0,
						borderW: 0,
						margin: 5,
						countMsg: false,
						statusMsg: false,
						barH: 7,
						barOpacity: 1
					},
					mapHorzMargin: 0,
					mapVertMargin: 0,
					mapMouseOver: false,
					mapSelSmoothDrag: false,
					zoomLoaderEnable: false
				},

				axZmCallBacks: {
					onBeforeStart: function(){
						// here you could overwrite some $.axZm options
					},

					onCropEnd: function(info){
						if (!$.axZm.panSwitched && 
							!(info.crop.x1 == 0 && info.crop.y1 == 0 && info.crop.x2 == $.axZm.ow && info.crop.y2 == $.axZm.oh) && 
							!(info.crop.x1 == 0 && info.crop.y1 == 0 && info.crop.x2 == 0 && info.crop.y2 == 0)
						) {
							// enable pan when zoomed
							$.fn.axZm.switchPan();
						}
					},

					onZoom: function(info) {
						// Enaable spin when not zoomed
						$("#axZm_zoomCustomNavi").addClass("axZm_displayBlockImportant");
						if (info.crop.x1 == 0 && info.crop.y1 == 0 && info.crop.x2 == $.axZm.ow && info.crop.y2 == $.axZm.oh){
							$("#axZm_zoomCustomNavi").removeClass("axZm_displayBlockImportant");

							if (!$.axZm.spinSwitched){
								$.fn.axZm.switchSpin();
							}
						}
					},

					onRestoreStart: function() {
						$.fn.axZm.switchSpin();
						$("#axZm_zoomCustomNavi").removeClass("axZm_displayBlockImportant");
					},

					onRestoreEnd: function(){
						$.fn.axZm.switchSpin();
						$("#axZm_zoomCustomNavi").removeClass("axZm_displayBlockImportant");
					}
				},

				axZmPar: "buttonSet=flat",

				zoomSwitchAnm: "Center",

				// use axZmThumbSlider extension for the thumbs, set false to disable
				axZmThumbSlider: true, 

				// Options passed to $.axZmThumbSlider
				// For more information see /axZm/extensions/axZmThumbSlider/
				axZmThumbSliderParam: {
					btn: true,
					btnHidden: true,
					orientation: "horizontal",
					scrollbar: false,
					centerNoScroll: true,
					wrapStyle: {borderWidth: 0}
				},
				thumbIcon: true, // Show 360 or 3D icon for the thumbs

				thumbIconFile: {
					text: "text_clean_256x256.png"
				},

				// try to open AJAX-ZOOM at browsers fullscreen mode
				fullScreenApi: false,

				// Show 360 thumb gallery at fullscreen mode, 
				// possible values: "bottom", "top", "left", "right" or false 
				thumbsAtFullscreen: "bottom",

				thumbsCache: true, // cache thumbnails
				thumbWidth: 87, // width of the thumbnail image
				thumbHeight: 87, // height of the thumbnail image
				thumbQual: 90, // jpg quality of the thumbnail image
				thumbMode: false, // possible values: "contain", "cover" or false
				thumbBackColor: "#FFFFFF", // background color of the thumb if thumbMode is set to "contain"
				thumbRetina: true, // true will double the resolution of the thumbnails
				thumbDescr: true, // Show thumb description

				// Custom description of the thumbs
				thumbDescrObj: {
					"Uvex_Occhiali": "360° of the chair",
					"furniture_001.jpg": "orange",
					"furniture_002.jpg": "black",
					"furniture_003.jpg": "cream",
					"furniture_004.jpg": "orange",
					"furniture_005.jpg": "black",
					"furniture_006.jpg": "cream",
					"furniture_007.jpg": "dining table",
					"furniture_008.jpg": "dining table",
					"furniture_009.jpg": "dining table"
				}
			});
		</script>

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div>
						<h3>JavaScript and CSS in head</h3>
						<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
						<?php
						echo '<pre style="display: none;"><code class="language-markup">';
						echo htmlspecialchars('
<!--  AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

<!-- JavaScript for 360/3D gallery -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.360Gallery.js"></script>
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.360Gallery.css" />

<!-- Include axZm.thumbSlider -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>
						');
						echo '</code></pre>';
						?>
						<h3>CSS</h3>
						<p>There is also some other css which overwrites the defaults from various css files. Please see source code.</p>
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
<!-- Container where AJAX-ZOOM will be loaded into -->
<div id="axZmPlayerContainer">
	<!-- This div will be removed after anything is loaded into "axZmPlayerContainer" div -->
	<div style="padding: 20px; font-size: 16pt">Loading, please wait...</div>
</div>

<div id="spinGalleryContainer">
	<!-- Thumb slider -->
	<div id="spinGallery">
		<!-- Temp message that will be removed after the slider initialization -->
		<div id="spinGallery_temp" class="spinGallery_temp">
			Gallery with 360 objects will be loaded after the first spin is fully loaded, please wait...
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
					</div>
				</div>
				<div class="col-lg-12">
					<h3>$.axZm360Gallery - documentation (options)</h3>
					<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
					<div style="display: none; margin-top: 10px;">
					<?php
					if (file_exists(dirname(__FILE__).'/extensions_doc/docu_360Gallery.inc.html')) {
						include dirname(__FILE__).'/extensions_doc/docu_360Gallery.inc.html';
					}
					?>
					</div>
					<div style="margin-top: 10px;">
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