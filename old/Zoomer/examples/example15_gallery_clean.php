<!DOCTYPE html>
<html>
	<head>
		<title>15_gallery_clean</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!--  Include jQuery core into head section if not present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  AJAX-ZOOM javascript -->
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
		<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

		<!-- Include axZm.thumbSlider -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- JavaScript for 360/3D gallery -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.360Gallery.js"></script>
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.360Gallery.css" />
		<style type="text/css">
			#axZm_zoomLogHolder {
				max-width: 70px !important;
			}
			#axZm_zoomLevel {
				font-size: 22px !important;
				color: #999 !important;
			}
			#axZmFsSpaceTop {
				background-color: #EEE;
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
					<h1 class="page-header">Clean AJAX-ZOOM 360°/3D with objects gallery.</h1>
					<!-- Slider with 360 objects (optionally). You can put it somewhere else, e.g. under the player, besides the player or whereever -->
					<div id="spinGalleryContainer" style="min-height: 80px; position: relative">
						<div id="spinGallery" style="min-height: 80px; width: 100%; position: releative">
							<!-- Temp message that will be removed after the slider initialization -->
							<div id="spinGallery_temp" class="spinGallery_temp" style="margin-top: 0;">
								Gallery with 360° objects will be loaded after the first spin is fully loaded, please wait...
							</div>
						</div>
					</div>

					<div class="embed-responsive" style="padding-bottom: 69%;">
						<!-- Placeholder for AJAX-ZOOM player -->
						<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
							Loading, please wait...
						</div>
					</div>

				</div>
				<div class="col-md-12">
					<div id="docuParent" style="margin-top: 100px;">
						<a href="#" class="btn btn-info" onclick="$.ajax({url: 'extensions_doc/docu_360Gallery.inc.html', complete: function(r){$('#docuParent').html(r.responseText)}})">Load documentaion for $.axZm360Gallery</a>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			// Init AJAX-ZOOM 360 and the 360 gallery
			$.axZm360Gallery ({
				axZmPath: "auto", // Path to /axZm/ directory, e.g. "/test/axZm/"
				embedResponsive: true, // if "divID" is responsive, set this to true
				// This is the path where we want to get other 360s or 3D from
				// So if under this path there are any other subfolders, 
				// then the first image will be loaded into the gallery
				// ajaxZoom.galleryFolder is used in onSpinPreloadEnd callback
				gallery3dDir: "/pic/zoom3d", // Path to the folder where in subfolders are images for several 360s/3D
				first3dDir: "/pic/zoom3d/Uvex_Occhiali", // index or name of the folder to be loaded at first

				// Configuration set value which is passed to ajax-zoom, e.g. 17 or "spinIpad"
				// some default settings from /axZm/zoomConfig.inc.php are overridden in 
				// /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 17){
				example: 17, 

				// Some of the AJAX-ZOOM option normally set in zoomConfig.inc.php and zoomConfigCustom.inc.php 
				// can be set directly as js var in this callback
				azOptions: {
					zoomSlider: false,
					spinSlider: false,
					//e.g.
					// zoomSlider: false,
					// gallerySlideNavi: true,
					// gallerySlideNaviOnlyFullScreen: true
				},

				divID: "axZmPlayerContainer", // The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
				spinGalleryContainerID: "spinGalleryContainer", // Parent container of gallery div
				spinGalleryID: "spinGallery", // ID of the menu container
				spinGallery_tempID: "spinGallery_temp", // ID of the menu container

				// background color of the player, possible values: #hex color or "auto" 
				// if "auto" AJAX-ZOOM will try to determin the background color
				// use "auto" only if you have e.g. black and white on different 360s
				backgroundColor: "#FFFFFF", 

				checkReverse: true, // Set to check spinReverse / spinReverseZ settings upon the below options (toReverseArr, toReverseArrZ)
				// Array with folder names where spinReverse option should be applied
				toReverseArr: ['Uvex_Occhiali', 'Atomic', 'Floete', 'Nike_Running', 'Pelican', 'Speed_Strength_BlackJacket', 'Speed_Strength_WhiteJacket', 'Uzi_32'], 
				toReverseArrZ: [], // Array with folder names where spinReverseZ option should be applied

				fullScreenApi: false, // try to open AJAX-ZOOM at browsers fullscreen mode
				thumbsAtFullscreen: "top", // show 360 thumb gallery at fullscreen mode, possible values: "bottom", "top", false
				axZmThumbSlider: true, // use axZmThumbSlider extension for the thumbs, set false to disable

				// Options passed to axZmThumbSlider
				// For more information see /axZm/extensions/axZmThumbSlider/
				axZmThumbSliderParam: {
					// e.g.
					btn: false // disable left/right buttons
				},

				thumbsCache: true, // cache thumbnails
				thumbWidth: 68, // width of the thumbnail image
				thumbHeight: 68, // height of the thumbnail image
				thumbQual: 90, // jpg quality of the thumbnail image
				thumbMode: false, // possible values: "contain", "cover" or false
				thumbBackColor: "#FFFFFF", // background color of the thumb if thumbMode is set to "contain"
				thumbRetina: true, // true will double the resolution of the thumbnails
				thumbDescr: true, // Show thumb description

				// Custom description of the thumbs
				thumbDescrObj: {
					// e.g.
					//"Uvex_Occhiali": "test",
					//"some_other": "test123"
				},
				thumbIcon: true, // Show 360 or 3D icon for the thumbs

				// Object with AJAX-ZOOM callbacks, https://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
				axZmCallBacks: {
					// e.g.
					//onload: function(){console.log("onLoad fired")},
					//onSpinPreloadEnd: function(){console.log("spin preloaded")}
				}
			});

		</script>

	</body>
</html>