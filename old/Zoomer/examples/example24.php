<!DOCTYPE html>
<html>
<head>
<title>24</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!--  Include jQuery core into head section -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

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

<style type="text/css" media="screen"> 
	html {font-family: Tahoma, Arial; font-size: 10pt; margin: 0; padding: 0; border: 0; overflow: hidden;}
	body {margin: 0; padding: 0; height: 100%; overflow: hidden;}
	a {color: blue; outline: 0; outline-style: none; text-decoration: none;} a:visited {color: blue;} a:hover {color: green;}
	h2 {padding:0px; margin: 35px 0px 15px 0px; font-size: 22px;}
	h3 {font-family: Arial; color: #1A4A7A; font-size: 18px; padding: 20px 0px 3px 0px; margin: 0;}
	p {text-align: justify; text-justify: newspaper;}
	.clearfix:after {content: "."; display: block; clear: both; visibility: hidden; line-height: 0; height: 0;}	 
	.clearfix {display: inline-block;}
	html[xmlns] .clearfix {display: block;}
	* html .clearfix {height: 1%;}
	#axZmTempLoading{background-color: #FFF;}

	#nav{
		float: left;
		min-width: 300px;
		max-width: 395px;
		width: 30%;
		background-color: #BABABA;
		border-right: #808080 solid 1px;
		padding: 0;
		overflow: hidden;
		overflow-y: auto;
	}
	
	#content{
		height: 150px;
		float: right;
		background-color: #FFFFFF;
		overflow: hidden;
        position: relative;
	}
	
	#footer{
		height: 20px;
		clear: both;
		color: #FFFFFF; 
		font-size: 12px; 
		line-height: 14px; 
		text-align: center;	
		background-color: #BABABA;
	}
	
	#header{
		height: 20px; 
		background-color: #808080; 
		overflow: hidden; 
		color: #FFFFFF; 
		font-size: 12px; 
		line-height: 14px; 
		text-align: center;	
	}
	
	#spinGallery_temp{
		color: #FFF;
		background-image: none;
	}
	
</style>

</head>
<body>
 
	<div id="header">
		[Optional Header - this one is 20px]
	</div>
	<div id="nav">
 		<?php
		include ('navi.php');
		?>
		<div style="padding: 7px 0px 0px 7px; color: #FFFFFF; font-size: 18px;">
			AJAX-ZOOM 360 / 3D Gallery
		</div>
		
		<div style="clear: both; margin: 7px; font-size: 80%;">
			For more information please see 
			<a href="example29.php">example29.php</a>
		</div>
		
		<!--  Slider with 360 objects (optionally). You can put it somewhere else, e.g. under the player, besides the player or whereever -->
		<div id="spinGalleryContainer" style="padding: 7px 0px 0px 7px; color: #FFFFFF;">
			<div id="spinGallery" style="position: releative">
				<!-- Temp message that will be removed after the slider initialization -->
				<div id="spinGallery_temp" class="spinGallery_temp" style="">
					Gallery with 360 objects will be loaded after the first spin is fully loaded, please wait...
				</div>
			</div>
		</div>


	</div>
	
	<div id="content">
		<!-- This div will be removed after anything is loaded into "content" div -->
		<div style="padding:20px; color: #000000; font-size: 16pt">Loading, please wait...</div>
	</div>
	
	<div id="footer">
		[Optional Footer - this one is 20px]
	</div>

	<script type="text/javascript">
		// This function manages the layout of the page
		var adjustHeight = function(){
			var a = (window.innerHeight ? window.innerHeight : $(window).height()) - jQuery('#header').outerHeight() - jQuery('#footer').outerHeight();
			jQuery('#content').css({height: a, width: jQuery(window).width() - jQuery('#nav').outerWidth() - 1});
			jQuery('#nav').css('height', a);
			window.scrollTo(0,0);
		};
 
		jQuery(document).ready(function(){
			// Init AJAX-ZOOM 360 and the 360 gallery
			// Adjust hight when the page is loaded
			adjustHeight();
			
			// Adjust hight when window size changes
			jQuery(window).bind('resize', adjustHeight);
			
			// Load 360 gallery and first spin
			jQuery.axZm360Gallery ({
				axZmPath: "auto", // Path to /axZm/ directory, e.g. "/test/axZm/"
				
				// This is the path where we want to get other 360s or 3D from
				// So if under this path there are any other subfolders, 
				// then the first image will be loaded into the gallery
				// ajaxZoom.galleryFolder is used in onSpinPreloadEnd callback
				// gallery3dDir: "/pic/zoom3d", // Path to the folder where in subfolders are images for several 360s/3D
				// first3dDir: "/pic/zoom3d/Uvex_Occhiali", // index or name of the folder to be loaded at first
				galleryData: [
					['image360', '/pic/zoom3d/Uvex_Occhiali'],
					["youtube", "q8acXvnsPnI"],
					["youtube", "p1bptkM-HkU"],
					["ajax", "extensions_doc/docu_360Gallery.inc.html"]
				],
				// optional hotspots, see example33.php
				galleryHotspots: {
					Uvex_Occhiali: '../pic/hotspotJS/eos_1100D.js'
				},

				// Some of the AJAX-ZOOM option normally set in zoomConfig.inc.php and zoomConfigCustom.inc.php 
				// can be set directly as js var in this callback
				azOptions: {
					//e.g.
					// zoomSlider: false,
					// gallerySlideNavi: true,
					// gallerySlideNaviOnlyFullScreen: true
				},

				divID: "content", // The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
				embedResponsive: true, // if divID is responsive, set this to true
				spinGalleryContainerID: "spinGalleryContainer", // Parent container of gallery div
				spinGalleryID: "spinGallery",  
				spinGallery_tempID: "spinGallery_temp", 
				
				// background color of the player, possible values: #hex color or "auto" 
				// if "auto" AJAX-ZOOM will try to determin the background color
				// use "auto" only if you have e.g. black and white on different 360s
				backgroundColor: "#FFFFFF", //  

				checkReverse: true, // Set to check spinReverse / spinReverseZ settings upon the below options (toReverseArr, toReverseArrZ)
				// Array with folder names where spinReverse option should be applied
				toReverseArr: ['Atomic', 'Floete', 'Nike_Running', 'Pelican', 'Speed_Strength_BlackJacket', 'Speed_Strength_WhiteJacket', 'Uzi_32'], 
				toReverseArrZ: [], // Array with folder names where spinReverseZ option should be applied
				toBounceArr:['Teva'],
				
				axZmThumbSlider: false, // use axZmThumbSlider extension for the thumbs, set false to disable
				fullScreenApi: true, // try to open AJAX-ZOOM at browsers fullscreen mode
				thumbsAtFullscreen: false, // show 360 thumb gallery at fullscreen mode, possible values: "bottom", "top", false

				thumbsCache: true, // cache thumbnails
				thumbWidth: 70, // width of the thumbnail image
				thumbHeight: 70, // height of the thumbnail image
				thumbQual: 90, // jpg quality of the thumbnail image
				thumbMode: false, // possible values: "contain", "cover" or false
				thumbBackColor: "#FFFFFF", // background color of the thumb if thumbMode is set to "contain"
				thumbRetina: true, // true will double the resolution of the thumbnails
				thumbDescr: true, // Show thumb description
				
				// Custom description of the thumbs
				thumbDescrObj: {
					// e.g.
					/*
					"Uvex_Occhiali": "test",
					"some_other": "test123",
					*/
					'159_0.jpg': '159_0.jpg',
					'high_res_002.jpg': 'high_res_002.jpg',
					'atomtest.jpg': 'atomtest.jpg',
					'boutique_013.jpg': 'boutique_013.jpg',
					'boutique_014.jpg': 'boutique_014.jpg',
					'Nike_Running': 'Nike_Running',
					'boutique_015.jpg': 'boutique_015.jpg',
					'Teva': 'Teva',
					'docu_360Gallery.inc.html': 'Documentation',
					//'nike': 'nike',
					'q57I1n4s5Hg': 'q57I1n4s5Hg',
					'78673338': '78673338',
					'x144odn': 'x144odn'
				},
				thumbImgObj:{
					//'high_res_002.jpg': 'https://www.ajax-zoom.com/pic/layout/image-zoom_29.jpg'
				},
				
				thumbIcon: true // Show 360 or 3D icon for the thumbs
			});
			
		});
	</script>

</body>
</html>