<!DOCTYPE html>
<html>
<head>
<title>26</title>
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

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

</head>
<body>

<?php
if (file_exists(dirname(__FILE__).'/navi.php')) {
	// This is only for the demo, you can remove it
	include dirname(__FILE__).'/navi.php';
}
?>

<div class="container">

	<h1 class="page-header">AJAX-ZOOM - short tutorial - JAVASCRIPT</h1>

	<p>Unlike in <a href="example18.php">example18.php</a> 
		this and most other examples do not require any PHP codes in the frontend and could be even posted 
		with WYSIWYG editor into a CMS content. All you have to do is to define ajaxZoom.parameter 
		string with paths to the source images and adjust the path to axZm directory.
	</p>

	<div class="embed-responsive" style="padding-bottom: 50%;">
		<!-- Div where AJAX-ZOOM is loaded into -->
		<div id="ajaxZoomContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
			Loading, please wait...
		</div>
	</div>

	<p>In the code below we show two possibilities. 
		The first one requires that jQuery core, AJAX-ZOOM javascript and css files are already in head. 
		If you do not have access to head you can also use the second possibility and 
		insert jquery.axZm.loader.js in a script tag which will byload jQuery core if not already present 
		and other javascript / css files instantly.
	</p>

	<h3>Possibility I (one)</h3>
	Requires some files to be in head section though they could be also pasted in body.

	<h4>Javascript and CSS in head section</h4>
	<?php
	echo '<pre><code class="language-markup">';
	echo htmlspecialchars ('
<!--  Include jQuery core into head section if not already present -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<!--  AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />
');
	echo '</code></pre>';
	?>

	<h4>HTML in body</h4>
	<?php
	echo '<pre><code class="language-markup">';
	echo htmlspecialchars ('
<div class="embed-responsive" style="padding-bottom: 50%;">
	<!-- Div where AJAX-ZOOM is loaded into -->
	<div id="ajaxZoomContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
		Loading, please wait...
	</div>
</div>
	');
	echo '</code></pre>';
	?>

	<h4>Javascript in body</h4>
	<?php
	echo '<pre><code class="language-js">';
	echo htmlspecialchars ('
<script type="text/javascript">
	// Create empty object
	var ajaxZoom = {}; 

	// Define the path to the axZm folder
	ajaxZoom.path = "../axZm/"; 

	// Define your custom parameter query string
	ajaxZoom.parameter = "example=2&zoomData=/pic/zoom/furniture/furniture_004.jpg\
	|/pic/zoom/furniture/furniture_003.jpg\
	|/pic/zoom/boutique/boutique_001.jpg\
	|/pic/zoom/boutique/boutique_002.jpg\
	"; 

	// The ID of the element where ajax-zoom has to be inserted into
	ajaxZoom.divID = "ajaxZoomContainer";

	ajaxZoom.opt = {
		onLoad: function(){
			// Do something
		}
	};
	
	// Load AJAX-ZOOM 
	jQuery(document).ready(function(){
		// Load AJAX-ZOOM not responsive
		/*
		jQuery.fn.axZm.load({
			opt: ajaxZoom.opt,
			path: ajaxZoom.path,
			parameter: ajaxZoom.parameter,
			divID: ajaxZoom.divID
		});
		*/

		// open AJAX-ZOOM responsive
		// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
		$.fn.axZm.openResponsive(
			ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. "/axZm/"
			ajaxZoom.parameter, // Defines which images and which options set to load
			ajaxZoom.opt, // callbacks
			ajaxZoom.divID, // target - container ID (default "window" - fullscreen)
			false, // apiFullscreen- use browser fullscreen mode if available
			true, // disableEsc - prevent closing with Esc key
			false // postMode - use POST instead of GET
		);
	});
</script>
	');
	echo '</code></pre>';
	?>

	<h3>Possibility II (two)</h3>
	The way with the "loader" javascript file. First we define over Javascript where to find /axZm directory (ajaxZoom.path), 
	then we define which files and with which configuration set they should be loaded (ajaxZoom.parameter), 
	then the container ID where AJAX-ZOOM schould be loaded into. Finally we insert "jquery.axZm.loader.js" 
	which will load everything else needed.

	<h4>HTML in body</h4>
	<?php
	echo '<pre><code class="language-markup">';
	echo htmlspecialchars ('
<!-- Div where AJAX-ZOOM is loaded into -->
<div id="ajaxZoomContainer" style="min-height: 462px;">Loading, please wait...</div>
	');
	echo '</code></pre>';
	?>

	<?php
	echo '<pre><code class="language-js">';
	echo htmlspecialchars ('
<script type="text/javascript">
	// Create empty object
	var ajaxZoom = {}; 

	// Define the path to the axZm folder
	ajaxZoom.path = "../axZm/"; 

	// Define your custom parameter query string
	ajaxZoom.parameter = "example=2&zoomData=/pic/zoom/furniture/furniture_004.jpg\
	|/pic/zoom/furniture/furniture_003.jpg\
	|/pic/zoom/boutique/boutique_001.jpg\
	|/pic/zoom/boutique/boutique_002.jpg\
	"; 

	// The ID of the element where ajax-zoom has to be inserted into
	ajaxZoom.divID = "ajaxZoomContainer";
	ajaxZoom.responsive = true; // Embed responsive

	ajaxZoom.opt = {
		onLoad: function(){
			// Do something
		}
	};
</script>
<!-- Insert the loader file that will take the above settings (ajaxZoom) and load the player -->
<script type="text/javascript" src="../axZm/jquery.axZm.loader.js"></script>
	');
	echo '</code></pre>';
	?>

	<h3>Possibility III (three)</h3>
	If you experience any problems with the above or need more then one instance of AJAX-ZOOM showing simultaneously 
	you could also use iframes. For more information on iframes please see <a href="example13.php">example13.php</a>

	<h4>HTML in body</h4>
	<?php
	echo '<pre><code class="language-markup">';
	echo htmlspecialchars ('
	<!-- AJAX-ZOOM will be loaded into iframe -->
	<iframe src="../examples/example33_vario.php?zoomData=/pic/zoom/furniture/furniture_003.jpg|/pic/zoom/boutique/boutique_001.jpg" width="100%" height="400" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" allowfullscreen></iframe>
	');
	echo '</code></pre>';
	?>

	<h3>Important notes</h3>
	<p>By defining the query string parameter in ajaxZoom.parameter example=2 some default settings from /axZm/zoomConfig.inc.php 
		are overridden in /axZm/zoomConfigCustom.inc.php after <code>elseif ($_GET['example'] == 2){</code> 
		So if changes in /axZm/zoomConfig.inc.php have no effect look for the same options /axZm/zoomConfigCustom.inc.php; 
	</p>

	Thus in /axZm/zoomConfigCustom.inc.php after <code>elseif ($_GET['example'] == 2){</code> you could for example set: 
	<ul>
		<li><code>$zoom['config']['picDim']</code> - inner size of the player.</li>
		<li><code>$zoom['config']['useHorGallery']</code> - enable / disable horizontal gallery.</li>
		<li><code>$zoom['config']['useGallery']</code> - enable / disable vertical gallery.</li>
		<li><code>$zoom['config']['displayNavi']</code> - enable / disable navigation bar.</li>
		<li><code>$zoom['config']['innerMargin']</code> - border width around the player.</li>
		<li>and many others...</li>
	</ul>

	<?php
	if (file_exists(dirname(__FILE__).'/footer.php')) {
		// This is only for the demo, you can remove it
		define('COMMENTS_BOOTSTRAP', true);
		include dirname(__FILE__).'/footer.php';
	}
	?>
</div>

<script type="text/javascript">
	// Create empty object
	var ajaxZoom = {}; 

	// Define the path to the axZm folder
	ajaxZoom.path = "../axZm/"; 
	
	// Define your options set
	ajaxZoom.parameter = "example=2";
	
	// Define your images
	ajaxZoom.parameter += "&zoomData=/pic/zoom/furniture/furniture_006.jpg\
	|/pic/zoom/furniture/furniture_007.jpg\
	|/pic/zoom/furniture/furniture_008.jpg\
	|/pic/zoom/furniture/furniture_009.jpg\
	|/pic/zoom/furniture/furniture_010.jpg\
	|/pic/zoom/furniture/furniture_001.jpg\
	|/pic/zoom/furniture/furniture_002.jpg\
	|/pic/zoom/furniture/furniture_004.jpg\
	"; 

	// The ID of the element where ajax-zoom has to be inserted into
	ajaxZoom.divID = "ajaxZoomContainer";
	ajaxZoom.responsive = true; // Embed responsive

	ajaxZoom.opt = {
		onLoad: function(){
			// Do something
		}
	};
</script>

<!-- Insert the loader file that will take the above settings (ajaxZoom) and load the player -->
<script type="text/javascript" src="../axZm/jquery.axZm.loader.js"></script>

</body>
</html>