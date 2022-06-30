<!DOCTYPE html>
<html>
<head>
<title>19</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!--  AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

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

	@media (max-width: 640px) {
		#axZm_spinSliderParent {
			display: none;
		}
	}

	/* override some css of the player */
	#axZm_zoomGalHorArea,
	#axZm_zoomGalHorDiv,
	#axZm_zoomGalHorCont
	#axZm_zoomGalHor {
		background-color: #191919;
	}

	.axZm_zoomContainer {
		background-color: #000000 !important;
	}

	#axZm_zoomGalHorCont li {
		background-color: transparent !important;
		border-radius: 0 !important;
	}

	#azParentContainer {
		background-color: #191919;
	}

	#axZm_spinSliderParent {
		position: relative;
		margin: 0 0 50px 0;
		padding: 20px;
		min-height: 55px;
		background-color: #191919;
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
	<h1 class="page-header">AJAX-ZOOM - high resolution animations</h1>

	<p>In this 360° animation the internal horizontal gallery is turned on. 
		Normally it would show all the available frames/images of the animation. 
		But as you can see not all of the frames are displayed. They are filtered by "zoomCueFrames" 
		parameter which is passed to AJAX-ZOOM along with other data (see Javascript code below).
	</p>

	<!-- Responsive wrapper which uses embed-responsive Bootstrap CSS class -->
	<div id="ajaxZoomContainerParent" class="az_embed-responsive">
		<!-- Div where AJAX-ZOOM is loaded into -->
		<div id="azParentContainer" class="az_embed-responsive-item">
			Loading, please wait...
		</div>
	</div>
	<!-- When spinSlider is enabled you can put it outside of the player in a container (spinSliderParent opntion) -->
	<div id="axZm_spinSliderParent"></div>

	<!-- Trigger AJAX-ZOOM -->
	<script type="text/javascript" id="exampleJs">
		// Helper plugin to deal with embed-responsive bootstrap class 
		$("#ajaxZoomContainerParent")
		.axZmEmbedResponsive({
			prc: 80,
			//ratio: '1:1.5', // ratio 1:1.5 is same as prc 150
			heightLimit: 80,
			maxWidthArr: [{
				maxWidth: 767,
				prc: 80,
				heightLimit: 80
			}]
		});

		// Create a var to hold the settings
		window.ajaxZoom = {}; 

		// AJAX-ZOOM callbacks
		ajaxZoom.opt = {
			// e.g. onBeforeStart
			onBeforeStart: function() {
				// do something
				jQuery.axZm.gallerySlideNavi = false;
				jQuery.axZm.spinSliderParent = 'axZm_spinSliderParent';
				jQuery.axZm.zoomSlider = false;
				jQuery.axZm.spinSlider = true;
			}
		};

		// Path to /axZm/ folder, best set absolute path
		ajaxZoom.path = "../axZm/"; 

		// 3dDir - path to the folder with 360 images
		ajaxZoom.parameter = "3dDir=/pic/zoom3d/Uvex_Occhiali";

		// example - options set in /axZm/zoomConfigCustom.inc.php after 
		// elseif ($_GET['example'] == 21){
		ajaxZoom.parameter += "&example=21";

		// zoomCueFrames - CSV of frames which should be shown in the gallery
		ajaxZoom.parameter += "&zoomCueFrames=1,4,8,10,12,15,18"; 

		// The ID of the element where ajax-zoom has to be inserted into
		ajaxZoom.divID = "azParentContainer";

		// Tigger AJAX-ZOOM not responsive
		/*
		jQuery(document).ready(function(){
			jQuery.fn.axZm.load({
				opt: ajaxZoom.opt,
				path: ajaxZoom.path,
				parameter: ajaxZoom.parameter,
				divID: ajaxZoom.divID
			});
		});
		*/

		// open AJAX-ZOOM responsive
		// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
		$(document).ready(function() {
			$.fn.axZm.openResponsive(
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

	<h3>Alternatives</h3>
	<p style="margin-top: 0;">In <a href="example35.php">example35.php</a> you can create a similar gallery but with much more options like zoom level,  
		instant generation of the thumbnails and add descriptions for each crop. 
	</p>

	<!-- Code head -->
	<h3>JavaScript & CSS files in Head</h3>
	<div style="clear:both; margin: 5px 0px 5px 0px;">
		<?php
		echo '<pre><code class="language-markup">';
		echo htmlspecialchars ('
<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!--  AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

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

	@media (max-width: 640px) {
		#axZm_spinSliderParent {
			display: none;
		}
	}
</style>
		');
		echo '</code></pre>';
		?>
	</div>

	<!-- HTML -->
	<h3>HTML markup</h3>
	<div style="clear: both; margin: 5px 0px 5px 0px;">
		<?php
		echo '<pre><code class="language-markup">';
		echo htmlspecialchars ('
<!-- Responsive wrapper which uses embed-responsive Bootstrap CSS class -->
<div id="ajaxZoomContainerParent" class="az_embed-responsive">
	<!-- Div where AJAX-ZOOM is loaded into -->
	<div id="azParentContainer" class="az_embed-responsive-item">
		Loading, please wait...
	</div>
</div>
<!-- When spinSlider is enabled you can put it outside of the player in a container (spinSliderParent opntion) -->
<div id="axZm_spinSliderParent"></div>
		');
		echo '</code></pre>';
		?>
	</div>

	<!-- Javascript -->
	<h3>Javascript</h3>
	<div style="clear: both; margin: 5px 0px 5px 0px;">
		<pre><code class="language-js" id="exampleJsPrism"></code></pre>
	</div>

	<?php
	if (file_exists(dirname(__FILE__).'/footer.php')) {
		// This is only for the demo, you can remove it
		define('COMMENTS_BOOTSTRAP', true);
		include dirname(__FILE__).'/footer.php';
	}
	?>

</div>

<script>
	// this is only for demo to show js code
	$('#exampleJsPrism').html($('#exampleJs').html());
</script>

</body>
</html>