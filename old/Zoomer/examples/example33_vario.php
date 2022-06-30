<?php
/*
This file loads 2D (zoomData) or 360/3d (3dDir) passed over query string to display in an iframe of hotspot tooltip
*/
error_reporting(0);
if (!(isset($_GET['3dDir']) || isset($_GET['zoomData']) || isset($_GET['zoomDir']))) {
	die('No parameters passed');
} else {
	foreach($_GET as $k => $v) {
		$_GET[$k] = preg_replace('/<[^>]*>[^<]*<[^>]*>/', '', $_GET[$k]);
		$_GET[$k] = filter_var($_GET[$k], FILTER_SANITIZE_STRING);
		if (strstr($_GET[$k], ';>') || stristr($_GET[$k], 'base64_encode') || strstr($_GET[$k], 'GLOBALS') || strstr($_GET[$k], '_REQUEST') || strstr($_GET[$k], '\.')) {
			unset($_GET[$k]);
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>AJAX-ZOOM in iframe</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<style type="text/css">
	/* keep body and html */
	html {height: 100% !important; width: 100% !important; overflow: hidden !important; font-family: Tahoma, Arial; font-size: 10pt; margin: 0; padding: 0;}
	body {height: 100% !important; width: 100% !important; overflow: hidden !important; margin: 0; padding: 0;}
	body:-webkit-fullscreen {width: 100%; height: 100%;}
	body:-ms-fullscreen {width: 100%; height: 100%;}
	a {color: blue; outline: 0; outline-style: none; text-decoration: none;} a:visited {color: blue;} a:hover {color: green;}
	h2 {padding:0px; margin: 35px 0px 15px 0px; font-size: 22px;}
	h3 {font-family: Arial; color: #1A4A7A; font-size: 18px; padding: 20px 0px 3px 0px; margin: 0;}

	@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
		.axZm_clickToSpin {
			transform: scale(0.5);
		}
	}
</style>

<!-- jQuery core, needed! -->
<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core -->
<link rel="stylesheet" type="text/css" href="../axZm/axZm.css" media="all" />
<link href="../axZm/themes/white/axZm_white.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- Only needed for the click example with fancybox -->
<link href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.zIndex.css" type="text/css" media="screen" rel="stylesheet">
<script src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.js" type="text/javascript"></script>

</head>
<body>

<div id="azTargetDiv" style="width: 100%; height: 100%;"></div>

<!--  Init AJAX-ZOOM player -->
<script type="text/javascript">

// Create empty object
window.ajaxZoom = {};
window.ajaxZoom.divID = 'azTargetDiv';

// Parameters passed query string
window.ajaxZoom.pathParameter = "<?php if (isset($_GET['3dDir'])){echo '3dDir='.$_GET['3dDir'];}elseif(isset($_GET['zoomData'])){echo 'zoomData='.$_GET['zoomData'];}elseif(isset($_GET['zoomDir'])){echo 'zoomDir='.$_GET['zoomDir'];}?>";
window.ajaxZoom.pathParameter += "<?php if (isset($_GET['zoomFile'])){echo '&zoomFile='.$_GET['zoomFile'];}?>";

// API fullscreen (does not work on mobile and is instantly disabled)
window.ajaxZoom.fullScreenApi = true;
window.ajaxZoom.iframeID = '';

<?php
// iframeID (id of the iframe) passed as parameter from page which calls AJAX-ZOOM in iframe
if (isset($_GET['iframeID']) && $_GET['iframeID']) {
	echo '
		window.ajaxZoom.iframeID = "'.$_GET['iframeID'].'";
	';
}

// Disable fullScreenApi by parameter passed
if (isset($_GET['fullScreenApi']) && ($_GET['fullScreenApi'] == 'false' || $_GET['fullScreenApi'] == 0)) {
	echo '
		window.ajaxZoom.fullScreenApi = false;
	';
}
?>

// Test if iframe id passed exists on parent page
// Perform this before AZ is inited
if (window.ajaxZoom.iframeID) {
	jQuery.fn.axZm.setParentFrameID(window.ajaxZoom.iframeID);
}

// Define callbacks, for complete list check the docs
window.ajaxZoom.opt = {
	onBeforeStart: function() {
		// Do not display exit text
		jQuery.axZm.fullScreenExitText = false;

		// Disable left/right buttons
		jQuery.axZm.gallerySlideNavi = false;

		// Negotiate fullscreen button
		if (jQuery.fn.axZm.getTestParentFrameID()) {
			jQuery.axZm.fullScreenCornerButton = true;
		} else {
			// Enable fullscreen button depending on fullscreen support
			if (window.ajaxZoom.fullScreenApi) {
				jQuery.axZm.fullScreenCornerButton = jQuery.fn.axZm.fsReady() ? true : false;
			} else {
				jQuery.axZm.fullScreenCornerButton = false;
			}
		}

		jQuery.axZm.gallerySlideNaviMargin = 5;

		<?php
		// Enable left/right buttons in certain cases
		if (isset($_GET['zoomDir']) || (isset($_GET['zoomData']) && count(explode('|', $_GET['zoomData'])) > 1)) {
			echo '
				jQuery.axZm.gallerySlideNavi = true;
			';
		} else {
			echo '
				jQuery.axZm.gallerySlideNavi = false;
			';
		}

		// Some other parameters which can be passed over query string and set in onBeforeStart callback
		if (isset($_GET['spinBounce'])) {
			echo '
				jQuery.axZm.spinBounce=\'bounce\';
			';
		}

		if (isset($_GET['spinReverse']) && $_GET['spinReverse'] != '0' && $_GET['spinReverse'] != 'false') {
			echo '
				jQuery.axZm.spinReverse=true;
			';
		} else {
			echo 'jQuery.axZm.spinReverse=false; ';
		}

		if (isset($_GET['spinReverseZ']) && $_GET['spinReverseZ'] != '0' && $_GET['spinReverseZ'] != 'false') {
			echo '
				jQuery.axZm.spinReverseZ = true;
			';
		} else {
			echo 'jQuery.axZm.spinReverseZ = false; ';
		}

		if (isset($_GET['stepZoom']) && $_GET['stepZoom'] != '0' && $_GET['stepZoom'] != 'false') {
			echo '
				jQuery.axZm.scrollAnm = false;
				jQuery.axZm.scrollZoom = 11;
				jQuery.axZm.scrollAjax = 200;
				jQuery.axZm.pyrTilesFadeInSpeed = 300;
				jQuery.axZm.pyrTilesFadeLoad = 30;
			';
		}

		if (isset($_GET['spinNoInit']) && $_GET['spinNoInit'] != '0' && $_GET['spinNoInit'] != 'false') {
			echo '
				jQuery.axZm.spinNoInit.enabled = true;
			';
		}

		if (isset($_GET['mouseScrollEnable']) && $_GET['mouseScrollEnable'] != '0' && $_GET['mouseScrollEnable'] != 'false') {
			echo '
				jQuery.axZm.mouseScrollEnable = true;
				jQuery.axZm.scroll = false;
			';
		}
		?>

		jQuery.axZm.mNavi.enabled = true;

		jQuery.axZm.mNavi.gravity = 'bottomLeft', //topLeft, topRight, bottomRight, bottomLeft, bottom, top, right, left
		jQuery.axZm.mNavi.buttonDescr = false;
		jQuery.axZm.mNavi.alt.enabled = false;

		<?php
		if (isset($_GET['3dDir'])) {
			echo '
				jQuery.axZm.mNavi.order = {mPan: 5, mSpin: 0};
			';
		} elseif (isset($_GET['zoomDir'])) {
			echo '
				jQuery.axZm.mNavi.order = {mGallery: 5, mReset: 0};
			';
		} elseif (isset($_GET['zoomData'])) {
			if (count(explode('|', $_GET['zoomData'])) > 1) {
				echo '
					jQuery.axZm.mNavi.order = {mGallery: 5, mReset: 0};
				';
			} else {
				echo '
					jQuery.axZm.mNavi.order = {mReset: 0};
				';
			}
		}

		if (isset($_GET['mNavi'])) {
			echo '
				jQuery.axZm.mNavi.order = {'.$_GET['mNavi'].'};
			';
		}

		if (isset($_GET['mNavi_enabled']) && ($_GET['mNavi_enabled'] == '0' || $_GET['mNavi_enabled'] == 'false')) {
			echo '
				jQuery.axZm.mNavi.enabled = false;
			';
		}

		if (isset($_GET['mNavi_onlyFullScreen']) && ($_GET['mNavi_onlyFullScreen'] == '1' || $_GET['mNavi_onlyFullScreen'] == 'true')) {
			echo '
				jQuery.axZm.mNavi.onlyFullScreen = true;
			';
		}
		?>

	}
};

var adjustHeight = function() {
	window.scrollTo(0, 0); // ios7
};

jQuery(document).ready(function() {
	adjustHeight();
	jQuery(document).bind('resize orientationchange', adjustHeight);
});

// Define the path to the axZm folder, adjust the path if needed!
window.ajaxZoom.path = "../axZm/";

// Define your custom parameter query string
// example=spinIpad has many presets for 360 images
// 3dDir - best of all absolute path to the folder with 360/3D images
// ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali";
window.ajaxZoom.parameter = "example=<?php echo isset($_GET['example']) ? $_GET['example'] : 'spinIpad'; ?>&"+window.ajaxZoom.pathParameter;

// Init fullscreen
window.fullScreenStartSplash = {
	'enable': <?php echo isset($_GET['noSplash']) ? 'false' : 'true'; ?>,
	'className': false,
	'opacity': 0.75
};

// Open AJAX-ZOOM in
jQuery.fn.axZm.openResponsive(
	window.ajaxZoom.path,
	window.ajaxZoom.parameter,
	window.ajaxZoom.opt,
	window.ajaxZoom.divID,
	window.ajaxZoom.fullScreenApi
);

</script>

</body>
</html>