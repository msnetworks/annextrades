<!DOCTYPE html>
<html>
<head>
<title>18</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- Include jQuery core into head section if not already present -->
<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet">

<!-- Helper plugin to deal with embed-responsive class -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.embedResponsive.js"></script>

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css">
/* copy of bootstraps embed-responsive and embed-responsive-item CSS classes
	if bootstrap or simmilar is included you could use the native classes (without az_) */
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
</style>

<style type="text/css">
/* reduce navigation buttons on small screens */
@media (max-width: 640px) {
	#axZm_zoomNaviPanTd,
	#axZm_zoomNaviCropTd,
	#axZm_zoomNaviToolsDevider,
	#axZm_zoomNaviInOutDevider,
	#axZm_zoomNaviPanButTd,
	#axZm_zoomMapButtonTd,
	#axZm_zoomFullScreenButtonTd {
		display: none;
	}
}
</style>
</head>
<body>

<?php
if (file_exists(dirname(__FILE__).'/navi.php')) {
	include dirname(__FILE__).'/navi.php';
}
?>

<div class="container">
	<h1 class="page-header">AJAX-ZOOM - high resolution image gallery with horizontal thumbnails gallery using bootstrap classes</h1>

	<p >The design can be easily changed. Besides overriding CSS in arbitrary css file you could use some pre-configed skins 
		or create your own skins. Below you can try changing <code>$zoom['config']['themeCss']</code> 
		and <code>$zoom['config']['buttonSet']</code> options, whereby the toolbar can be disabled or replaced by 
		<code>$zoom['config']['mNavi']</code> suboptions which place diverse tool buttons over the player.
	</p>

	<div style="margin-bottom: 20px">
		<select class="form-control pull-left" id="themeCss" style="width: auto; margin-right: 5px;">
			<option>--themeCss--</option>
			<option value="">no theme</option>
			<option value="black" selected>black</option>
			<option value="grey">grey</option>
			<option value="white">white</option>
			<option value="transparent">transparent</option>
		</select>
		<select class="form-control pull-left" id="buttonSet" style="width: auto; margin-right: 5px;">
			<option>--buttonSet--</option>
			<option value="default">default</option>
			<option value="flat" selected>flat</option>
			<option value="transparent">transparent</option>
		</select>
		<a class="btn btn-info" id="aze_change_design">Change</a>
	</div>

	<div id="ajaxZoomContainerParent" class="az_embed-responsive">
		<!-- Div where AJAX-ZOOM is loaded into -->
		<div id="ajaxZoomContainer" class="az_embed-responsive-item">
			Loading, please wait...
		</div>
	</div>

	<script type="text/javascript" id="exampleJs">
	 	// Helper plugin to deal with embed-responsive bootstrap class 
		jQuery("#ajaxZoomContainerParent")
		.axZmEmbedResponsive({
			prc: 82,
			//ratio: '1:1.5', // ratio 1:1.5 is same as prc 150
			heightLimit: 82,
			maxWidthArr: [{
				maxWidth: 767,
				prc: 90,
				heightLimit: 90
			}]
		});

		// Create empty object
		window.ajaxZoom = {};

		// Define the path to the axZm folder
		ajaxZoom.path = "../axZm/"; 

		// Define your options set in /axZm/zoomConfigCustom.inc.php
		ajaxZoom.parameter = "example=20";

		// Define your images using zoomData parameter with image paths separated with vertical dash
		ajaxZoom.parameter += '&zoomData=';
		ajaxZoom.parameter += '/pic/zoom/animals/animals_001.jpg|';
		ajaxZoom.parameter += '/pic/zoom/animals/animals_002.jpg|';
		ajaxZoom.parameter += '/pic/zoom/animals/animals_003.jpg|';
		ajaxZoom.parameter += '/pic/zoom/portrait/portrait_003.jpg|';
		ajaxZoom.parameter += '/pic/zoom/portrait/portrait_004.jpg|';
		ajaxZoom.parameter += '/pic/zoom/trasportation/transportation_001.jpg|';
		ajaxZoom.parameter += '/pic/zoom/trasportation/transportation_002.jpg|';
		ajaxZoom.parameter += '/pic/zoom/trasportation/transportation_003.jpg|';
		ajaxZoom.parameter += '/pic/zoom/trasportation/transportation_004.jpg|';
		ajaxZoom.parameter += '/pic/zoom/trasportation/transportation_005.jpg|';
		ajaxZoom.parameter += '/pic/zoom/trasportation/transportation_006.jpg|';
		ajaxZoom.parameter += '/pic/zoom/estate/house_01.jpg|';
		ajaxZoom.parameter += '/pic/zoom/estate/house_02.jpg|';
		ajaxZoom.parameter += '/pic/zoom/estate/house_03.jpg|';

		// The ID of the element where ajax-zoom has to be inserted into
		ajaxZoom.divID = "ajaxZoomContainer";

		// Callbacks
		ajaxZoom.opt = {
			onLoad: function() {
				// Do something
			}
		};

		// open AJAX-ZOOM responsive
		// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
		$(document).ready(function() {
			jQuery.fn.axZm.openResponsive(
				ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
				ajaxZoom.parameter, // Defines which images and which options set to load
				ajaxZoom.opt, // callbacks
				ajaxZoom.divID, // target - container ID (default 'window' - fullscreen)
				false, // apiFullscreen- use browser fullscreen mode if available
				true, // disableEsc - prevent closing with Esc key
				false // postMode - use POST instead of GET
			);
		});
	</script>
	<p style="margin-top: 20px">Please note that on small screens, mostly mobile devices, the gallery is disabled 
		by options - <code>$zoom['config']['galleryHorHideMaxWidth']</code> 
		and <code>$zoom['config']['galleryHorHideMaxHeight']</code>. 
		The gallery thumbnail size is defined by <code>	$zoom['config']['galleryHorPicDim']</code> option which is set to 50x50 in this example.
		The toolbar below the player can be disabled by 
		<code>$zoom['config']['displayNavi']</code> and <code>$zoom['config']['fullScreenNaviBar']</code> options.
	</p>
	<p>By passing / defining the query string parameter <code>$_GET['example'] = 20;</code> (in source code) some default settings from /axZm/zoomConfig.inc.php 
		are overridden in /axZm/zoomConfigCustom.inc.php after <code>elseif ($_GET['example'] == 20){</code> 
		So if changes in /axZm/zoomConfig.inc.php have no effect look for the same options /axZm/zoomConfigCustom.inc.php; 
		You can also copy selected options from /axZm/zoomConfig.inc.php into /zoomConfigCustomAZ.inc.php 
		and change the values independent of which "example" parameter is passed. 
		Any control element can be disabled, placed at a different position or design changed...
	</p>
	<div class="alert alert-info">If you want to load 360 degree product rotations and / or videos into the gallery please check out 
		<a href="example29_responsive_easy.php">example29_responsive_easy.php</a>
	</div>

	<!-- Code head -->
	<h3>JavaScript & CSS files in Head</h3>
	<div style="clear:both; margin: 5px 0px 5px 0px;">
	<?php
	echo '<pre><code class="language-markup">';
	echo htmlspecialchars ('
<!-- Include jQuery core into head section if not already present -->
<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet">

<!-- Helper plugin to deal with embed-responsive class -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.embedResponsive.js"></script>

<style type="text/css">
/* copy of bootstraps embed-responsive and embed-responsive-item CSS classes
	if bootstrap or simmilar is included you could use the native classes (without az_) */
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
</style>
		');
	echo '</code></pre>';
	?>
	</div>

	<!-- Code body -->
	<h3>HTML markup</h3>
	<div style="clear:both; margin: 5px 0px 5px 0px;">
	<?php
	echo '<pre><code class="language-markup">';
	echo htmlspecialchars ('
<div id="ajaxZoomContainerParent" class="az_embed-responsive">
	<!-- Div where AJAX-ZOOM is loaded into -->
	<div id="ajaxZoomContainer" class="az_embed-responsive-item">
		Loading, please wait...
	</div>
</div>
	');
	echo '</code></pre>';
	?>

		<!-- Code body -->
	<h3>Javascript</h3>
	<div style="clear:both; margin: 5px 0px 5px 0px;">
		<pre><code class="language-js" id="exampleJsPrism"></code></pre>
		<script type="text/javascript">$('#exampleJsPrism').html($('#exampleJs').html());</script>
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
<script type="text/javascript">
	// This is not needed!
	$('#aze_change_design').bind('click', function() {
		if (!$.axZm) {return;}
		$.fn.axZm.removeAzThemes();
		setTimeout(function(){ 
			var themeCss = $('#themeCss').val() || '';
			var buttonSet = $('#buttonSet').val() || 'default';
			var par = ajaxZoom.parameter + '&buttonSet=' + buttonSet + '&themeCss=' + themeCss;
			jQuery.fn.axZm.removeAZ();
			jQuery.fn.axZm.openResponsive(ajaxZoom.path, par, ajaxZoom.opt, ajaxZoom.divID, false, true, false);
		}, 1);
	});
</script>
</body>
</html>