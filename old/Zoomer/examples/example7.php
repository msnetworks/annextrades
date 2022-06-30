<!DOCTYPE html>
<html>
<head>
<title>example7.php</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed! -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- jQuery core, needed if not already present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- AJAX-ZOOM thumbGallery extension, needed! -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css">
	@media (max-width: 991px) {
		#thumbsParentContainer {
			margin-top: 15px;
		}
	}
</style>

</head>
<body>

<?php
// This is only for the demo, you can remove it
if (file_exists(dirname(__FILE__).'/navi.php')) {
	include dirname(__FILE__).'/navi.php';
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">AJAX-ZOOM - embedded implementation with custom gallery next to the player. 
				Specified images with "zoomData". 
				Responsive ready.
			</h1>
		</div>
		<div class="col-md-12">
			<p style="margin-top: 40px;">Ver. 4.2.1+ This example has been totally rewritten. It does not contain indispensable PHP code within the actual page any more. 
				Also all JavaScript has been wrapped into one plugin ($.axZm.thumbGallery) which is controllable 
				over various options passed to it. 
			</p>
			<p>In this example several images from different location are passed to the $.axZm.thumbGallery over "zoomData" option. 
				The plugin then generates a grid of thumbs next to AJAX-ZOOM player. 
				When clicked on the thumbs images in the player are switched to the selection.
			</p>
		</div>

		<div class="col-md-6">
			<div style="border: #ccc 1px dotted; padding: 1%;">
				<!-- Container where AJAX-ZOOM will be loaded into -->
				<div id="zoomInlineContent" style="height: 600px; position: relative; max-height: calc(100vh - 50px);"></div>
			</div>
		</div>
		<div class="col-md-6">
			<!-- Container where thumbs will be loaded into -->
			<div id="thumbsParentContainer"></div>

			<!-- Not needed: some html for prev / next buttons -->
			<div style="text-align: center; margin-top: 20px">
				<input type="button" class="btn btn-default" onclick="jQuery.fn.axZm.zoomPrevNext('prev')" value="<<">
				<input type="button" class="btn btn-default" onclick="jQuery.fn.axZm.zoomPrevNext('next')" value=">>">
			</div>

			<div style="text-align: center; margin-top: 20px">
				Switch to next, prev image with API method 
				<a href="http://www.ajax-zoom.com/index.php?cid=docs#api_zoomPrevNext">$.fn.axZm.zoomPrevNext()</a>
			</div>
		</div>

		<div class="col-md-12">
			<p style="margin-top: 40px;">To achieve similar result one could also use AJAX-ZOOM native API (without $.axZm.thumbGallery plugin).
				Most important API function for this is: 
				<a href="http://www.ajax-zoom.com/index.php?cid=docs#api_zoomSwitch">$.fn.axZm.zoomSwitch</a>;  
				$.axZm.thumbGallery is commented and could be edited by interesting programmers. 
				The plugin is used in several other examples you might want to take a look at<sup><a href="#o_sup_1">1</a></sup>.
			</p>

			<!-- Code head -->
			<h3>JavaScript & CSS files in Head</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- jQuery core, needed if not already present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- AJAX-ZOOM thumbGallery extension, needed! -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>
			');
			echo "</code></pre>";	
			?>
			</div>

			<!-- Code body -->
			<h3>HTML markup in body</h3>
			<p>Both containers can be responsive! If the container where AJAX-ZOOM will be loaded into is responsive, 
				then set "embedResponsive" option below to true.
			</p>

			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<div class="col-md-6">
	<!-- Container where AJAX-ZOOM will be loaded into -->
	<div id="zoomInlineContent" style="height: 600px; position: relative; max-height: calc(100vh - 50px)"></div>
</div>
<div class="col-md-6">
	<!-- Container where thumbs will be loaded into -->
	<div id="thumbsParentContainer"></div>
</div>
			');
			echo "</code></pre>";
			?>
			</div>

			<!-- Code js -->
			<h3>JavaScript</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<pre><code class="language-js" id="exampleJsPrism"></code></pre>
			</div>

			<!-- Docu -->
			<h3>$.azThumbGallery - documentation (options)</h3>
			<div>
			<?php 
			if (file_exists(dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html')) {
				include dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html';
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

<!-- Fire azThumbGallery, that's it -->
<script type="text/javascript" id="exampleJs">
	/* 
	Please find more options and their more detailed description in the documentation below 
	or e.g. at https://www.ajax-zoom.com/example5.php
	*/

	jQuery.azThumbGallery({
		// Path to /axZm directory, e.g. /test/axZm/
		axZmPath: "../axZm/",

		// Instead of zoomDir (entire folder or subfolders) we here pass
		// zoomData with images from different locations
		zoomData: [
			"/pic/zoom/fashion/fashion_009.jpg", 
			"/pic/zoom/fashion/fashion_010.jpg", 
			"/pic/zoom/fashion/fashion_001.jpg", 
			"/pic/zoom/fashion/fashion_002.jpg", 
			"/pic/zoom/fashion/fashion_003.jpg", 
			"/pic/zoom/fashion/fashion_004.jpg", 
			"/pic/zoom/fashion/fashion_005.jpg", 
			"/pic/zoom/fashion/fashion_006.jpg", 
			"/pic/zoom/fashion/fashion_007.jpg", 
			"/pic/zoom/fashion/fashion_008.jpg",
		],

		// Possible values: "select", "folders", "imgFolders"
		folderSelect: false,

		// No AJAX-ZOOM callbacks required
		axZmCallBacks: {},

		// Try to open AJAX-ZOOM at browsers fullscreen mode
		fullScreenApi: true,

		thumbModel: "grid", // possible values: grid, fixed

		// Class for the UL element, when "thumbModel" option value is "grid"
		thumbUlClassGrid: "azGridThumb azGrid-6-xxl azGrid-6-xl azGrid-4-lg azGrid-6-md azGrid-6-sm azGrid-4-xs",
		thumbsContainer: "thumbsParentContainer", // ID of the element where thumbnails appended to

		// Display AJAX-ZOOM next to the thumbs
		embedMode: true,

		// Configuration set which is passed to AJAX-ZOOM when "embedMode" is enabled
		embedExample: "new9", 

		// ID of the element (placeholder) where AJAX-ZOOM has to be inserted into 
		embedDivID: "zoomInlineContent",

		// Possible values: "Center", "Top", "Right", "Bottom", "Left", "StretchVert", "StretchHorz", "SwipeHorz", "SwipeVert", "Vert", "Horz" 
		embedZoomSwitchAnm: "SwipeHorz",
		embedZoomSwitchSpeed: 300
	});
</script>

<script type="text/javascript">
	$('#exampleJsPrism').html($('#exampleJs').html());
</script>
</body>
</html>