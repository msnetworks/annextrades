<!doctype html>
<html>
<head>
<title>33_fullscreen</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


<style type="text/css" media="screen">
	html {font-family: Tahoma, Arial; font-size: 10pt; margin: 0; padding: 0; border: 0;}
	body {margin: 0; padding: 0; height: 100%; overflow: hidden;}
	a {color: blue; outline: 0; outline-style: none; text-decoration: none;} a:visited {color: blue;} a:hover {color: green;}
	h2 {padding:0px; margin: 35px 0px 15px 0px; font-size: 22px;}
	h3 {font-family: Arial; color: #1A4A7A; font-size: 18px; padding: 20px 0px 3px 0px; margin: 0;}
	p {text-align: justify; text-justify: newspaper;}
</style>
<link rel="stylesheet" type="text/css" href="../axZm/axZm.css" media="all" />
<!-- jQuery core, needed! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core -->
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

</head>
<body>

<div id="headerNavi" style="width: 386px; z-index: 2147483647; position: absolute; left: 50%; top: 0; margin-left: -193px;"><?php include ('navi.php');?></div>


<!--  Init AJAX-ZOOM player -->
<script type="text/javascript">

// Create empty jQuery object
var ajaxZoom = {};

// Define callbacks, for complete list check the docs
ajaxZoom.opt = {
	onBeforeStart: function(){
		// Set backgrounf color, can also be done in css file
		jQuery('.axZm_zoomContainer').css({backgroundColor: '#FFFFFF'});
		jQuery.axZm.fullScreenCornerButton = false;
		jQuery.axZm.fullScreenExitText = false;
		jQuery.axZm.spinDemoTime = 2500;

		// Set mNavi buttons here if you want
		if (typeof jQuery.axZm.mNavi == 'object'){
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
	},
	onLoad: function(){ // onSpinPreloadEnd
		jQuery.axZm.spinReverse = false;
		// Load hotspots over this function... or just define jQuery.axZm.hotspots here and trigger jQuery.fn.axZm.initHotspots(); after this.
		jQuery.fn.axZm.loadHotspotsFromJsFile('../pic/hotspotJS/eos_1100D.js', false);

	}
};

// Define the path to the axZm folder, adjust the path if needed!
ajaxZoom.path = "../axZm/";

// Define your custom parameter query string
// example=spinIpad has many presets for 360 images
// 3dDir - best of all absolute path to the folder with 360/3D images
// ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali";
ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali/";

// Init fullscreen
jQuery.fn.axZm.openFullScreen(ajaxZoom.path, ajaxZoom.parameter, ajaxZoom.opt, 'window', false, true);

</script>

</body>
</html>