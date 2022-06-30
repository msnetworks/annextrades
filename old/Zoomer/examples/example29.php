<!DOCTYPE html>
<html>
<head>
<title>29</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!--  Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!--  Include jQuery core into head section if not already exists -->
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

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css">
	#playerWrap {
		padding-right: 120px; /* width of the gallery */
		height: 600px;
		max-height: calc(100vh - 50px);
		position: relative;
	}

	#spinGalleryContainer {
		position: absolute;
		z-index: 11;
		width: 120px; 
		height: 100%; 
		right: 0px;
		top: 0px;
	}

	#axZmPlayerContainer {
		position: relative;
		height: 100%;
	}

	#spinGallery {
		position: absolute;
		right: 0;
		width: 110px;
		height: 100%;
		overflow: hidden;
	}

	/* hide gallery for small screens */
	@media (max-width: 768px) {
		#spinGalleryContainer {
			display: none;
		}
		#playerWrap {
			padding-right: 0;
			height: 400px;
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

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">
				Minimalistic design, custom buttons, 3D/360 object, plain 2D images and videos in one custom gallery (controlled with API).
			</h1>
		</div>
		<div class="col-md-12">
			<div style="border: #eee 1px solid; padding: 5px;">
				<div id="playerWrap">
					<!-- Container where AJAX-ZOOM will be loaded into -->
					<div id="axZmPlayerContainer">
						<!-- This div will be removed after anything is loaded into "content" div -->
						<h4>Loading, please wait...</h4>
					</div>

					<div id="spinGalleryContainer">
						<!-- Thumb slider -->
						<div id="spinGallery">
							<!-- Temp message that will be removed after the slider initialization -->
							<div id="spinGallery_temp" class="spinGallery_temp">
								<!-- Gallery will be loaded after first object is loaded... -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--  Init AJAX-ZOOM player -->
		<script type="text/javascript" id="exampleJs">
		// Load 360 gallery and first spin
		jQuery.axZm360Gallery ({
			axZmPath: "../axZm/", // Path to /axZm/ directory, e.g. "/test/axZm/"

			// Over galleryData" option you can precisely define which 360s or 3D have to beloaded. 
			// Additionally you can also define regular 2D images and videos located at 
			// some straming platform like youtube, iframed content or load content over ajax
			galleryData: [
				["image360", "/pic/zoom3d/Uvex_Occhiali"],
				["imageZoom", "/pic/zoom/boutique/boutique_001.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_002.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_003.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_004.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_005.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_006.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_007.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_008.jpg"],
				["imageZoom", "/pic/zoom/boutique/boutique_009.jpg"],
				["youtube", "n3rPDLzted4"],
				["vimeo", "162826208"],
				/*["dailymotion", "x20g8k1"],*/
				["ajax", "extensions_doc/docu_360Gallery.inc.html"],
				["iframe", "extensions_doc/docu_360Gallery.inc.html"]
			],

			// AJAX-ZOOM supports "hotspots" which can be optionally loaded 
			// for 3D/360 or 2D (plain images). 
			// Hotspots can be configured manually in example33.php 
			galleryHotspots: {
				bike360: "../pic/hotspotJS/bike.js"
			},

			firstToLoad: "imageZoom", // name of 360, "imageZoom" or null

			// Some of the AJAX-ZOOM option normally set in zoomConfig.inc.php and zoomConfigCustom.inc.php 
			// can be set directly as js var in this callback
			azOptions: {
				//e.g.
				// zoomSlider: false,
				// gallerySlideNavi: true,
				// gallerySlideNaviOnlyFullScreen: true
			},

			divID: "axZmPlayerContainer", // The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
			embedResponsive: true, // if divID is responsive, set this to true
			spinGalleryContainerID: "spinGalleryContainer", // Parent container of gallery div
			spinGalleryID: "spinGallery",
			spinGallery_tempID: "spinGallery_temp",

			// background color of the player, possible values: #hex color or "auto" 
			// if "auto" AJAX-ZOOM will try to determin the background color
			// use "auto" only if you have e.g. black and white on different 360s
			backgroundColor: "#FFFFFF",

			// Set to check spinReverse / spinReverseZ settings upon the below options (toReverseArr, toReverseArrZ)
			checkReverse: true,

			// Array with folder names where spinReverse option should be applied
			toReverseArr: [
				"Uvex_Occhiali",
				"Atomic",
				"Floete",
				"Nike_Running",
				"Pelican",
				"Speed_Strength_BlackJacket",
				"Speed_Strength_WhiteJacket",
				"Uzi_32"
			], 

			// Array with folder names where spinReverseZ option should be applied
			toReverseArrZ: [],
			toBounceArr: ["Teva"],

			// use axZmThumbSlider extension for the thumbs, set false to disable
			axZmThumbSlider: true,

			// Options passed to $.axZmThumbSlider
			// For more information see /axZm/extensions/axZmThumbSlider/
			axZmThumbSliderParam: {
				btn: false,
				orientation: "vertical",
				scrollbar: true,
				scrollbarMargin: 10,
				wrapStyle: {borderWidth: 0}
				//scrollbarClass: "axZmThumbSlider_scrollbar_thin"
			},

			// try to open AJAX-ZOOM at browsers fullscreen mode
			fullScreenApi: false,

			// Show 360 thumb gallery at fullscreen mode, 
			// possible values: "bottom", "top", "left", "right" or false 
			thumbsAtFullscreen: false,

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
				"boutique_001.jpg": "Image 1",
				"boutique_002.jpg": "Image 2",
				"boutique_003.jpg": "Image 3",
				"boutique_004.jpg": "Image 4",
				"boutique_005.jpg": "Image 5",
				"boutique_006.jpg": "Image 6",
				"boutique_007.jpg": "Image 7",
				"boutique_008.jpg": "Image 8",
				"boutique_009.jpg": "Image 9",
				"Uvex_Occhiali": "EOS_1100D",
				"docu_360Gallery.inc.html": "Documentation",
				"n3rPDLzted4": "Youtube video",
				"162826208": "Vimeo video",
				"x20g8k1": "Dailymotion"
			},
			thumbIcon: true // Show 360 or 3D icon for the thumbs
		});
		</script>

		<div class="col-md-12">
			<!-- Bla, bla-->
			<h3>About</h3>
 			<p>It has been often asked how to manage 360/3D product spins and plain 2D images in one gallery. 
				The vertical and horizontal galleries which are integrated into AJAX-ZOOM do not support it. 
				However it is possible to make a custom HTML gallery with both - 360 and 2D images and control the player 
				over <span style="text-decoration: line-through;">API functions. In this example we have made a custom function jQuery.axZmSwitchImage() including some 
				additional logic - when switching between regular 2D images and 360 object it is necessary (or more easy) 
				to reload the player in the background. Thus the javascript function jQuery.axZmSwitchImage() handels the task. 
				You will find the code in the source of this file. Edit, adjust the function as needed - it is commented. </span> 
				options of $.axZm360Gallery extension which has been introduced in Ver. 4.2.1; all options are listed below. 
			</p>

			<h4>What's new in $.axZm360Gallery compared to the old version: </h4>
			<ul>
				<li>HTML markup shrinked to couple lines</li>
				<li>Easy to configure over options including definition of the content</li>
				<li>Optionally included $.axZmThumbSlider plugin which manages displaying and scrolling of the gallery</li>
				<li>Almost the same code for responsive and none responsive layout. Basically only the HTML markup needs to be changed and "embedResponsive" option turned on</li>
				<li>Additionally to YouTube added the possibility to define Vimeo and Dailymotion videos</li>
				<li>All thumbnails including Video links are loaded instantly</li>
				<li>Added AJAX and Iframe content</li>
				<li>Subtle control over all features</li>
			</ul>

			<p>$.axZm360Gallery plugin can be used with only 2D images or only 360/3D. 
				So in case you don't have a 360 photography for a product you can still use the same layout for displaying any media available.
			</p>

			<p>One of the example objects loaded into the player on www.ajax-zoom.com is a multilevel (multirow) 3D object. 
				However it makes no difference to a regular 360° product spin with just one row. 
				The only difference between regular 360 spin and multirow is that original images are placed in subfolders of the target folder. 
				E.g. the path passed to the folder is ajaxZoom.parameter = "example=17&3dDir=/pic/zoomVR/nike"; images of each row are placed in subfolders, 
				e.g. /pic/zoomVR/nike/0, /pic/zoomVR/nike/15, /pic/zoomVR/nike/30, /pic/zoomVR/nike/45, /pic/zoomVR/nike/60, /pic/zoomVR/nike/75, /pic/zoomVR/nike/90; 
				You do not need to define these subfolders anywhere. AJAX-ZOOM will instantly detect them and procede all the images in them. 
			</p>

			<p>You can find the old version which uses one simple function but has less features and a different HTML markup 
				in <a href="example29_clean_old.php">example29_clean_old.php</a>. 
				If you want to make something completly different it might be easier to edit. 
				However before you decide to use this legacy example, please explore all the options of the new $.axZm360Gallery plugin.
			</p>

			<p>Please note: some default settings from /axZm/zoomConfig.inc.php are overridden in /axZm/zoomConfigCustom.inc.php after 
				<code>elseif ($_GET['example'] == 'spinAnd2D'){</code>
				So if changes in /axZm/zoomConfig.inc.php have no effect look for the same options /axZm/zoomConfigCustom.inc.php; 
			</p>

			<p>Last but not least: there is no PHP needed to run it in your actual application so 
				you can use it e.g. with Phalanger in ASP.NET environment.
			</p>

			<!-- Code head -->
			<h3>JavaScript & CSS files in Head</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!--  Include jQuery core into head section if not already exists -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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
				echo "</code></pre>";
				?>
			</div>

			<!-- CSS -->
			<h3>CSS in Head</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-css">';
				echo htmlspecialchars ('
#playerWrap {
	padding-right: 120px; /* width of the gallery */
	height: 600px;
	max-height: calc(100vh - 50px);
	position: relative;
}

#spinGalleryContainer {
	position: absolute;
	z-index: 11;
	width: 120px; 
	height: 100%; 
	right: 0px;
	top: 0px;
}

#axZmPlayerContainer {
	position: relative;
	height: 100%;
}

#spinGallery {
	position: absolute;
	right: 0;
	width: 110px;
	height: 100%;
	overflow: hidden;
}

/* hide gallery for small screens */
@media (max-width: 768px) {
	#spinGalleryContainer {
		display: none;
	}
	#playerWrap {
		padding-right: 0;
		height: 400px;
	}
}
			');
				echo '</code></pre>';
				?>
			</div>

			<!-- Code body -->
			<h3>HTML markup in body</h3>
			<p>All containers can be responsive! If the container where AJAX-ZOOM will be loaded into is responsive, 
				then set "embedResponsive" option below to true.
			</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
<div id="playerWrap">
	<!-- Container where AJAX-ZOOM will be loaded into -->
	<div id="axZmPlayerContainer">
		<!-- This div will be removed after anything is loaded into "content" div -->
		<h4>Loading, please wait...</h4>
	</div>

	<div id="spinGalleryContainer">
		<!-- Thumb slider -->
		<div id="spinGallery">
			<!-- Temp message that will be removed after the slider initialization -->
			<div id="spinGallery_temp" class="spinGallery_temp">
				Gallery will be loaded...
			</div>
		</div>
	</div>
</div>
			');
			echo "</code></pre>";	
			?>
			</div>

			<!-- Code js -->
			<h3>JavaScript</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<pre><code class="language-js" id="exampleJsPrism"></code></pre>
				<script>
					/* This is for demo, not needed */
					$('#exampleJsPrism').html($('#exampleJs').html());
				</script>
			</div>

			<h3>$.axZm360Gallery - documentation (options)</h3>
			<div>
			<?php 
			if (file_exists(dirname(__FILE__).'/extensions_doc/docu_360Gallery.inc.html')) {
				include dirname(__FILE__).'/extensions_doc/docu_360Gallery.inc.html';
			}
			?>
			</div>

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

</body>
</html>