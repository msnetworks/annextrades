<!DOCTYPE html>
<html>
<head>
<title>16</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- jQuery core, needed! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- AJAX-ZOOM thumbGallery extension, needed! -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css" id="codeCssExec">
	@media (min-width: 992px) {
		#outerRight {
			height: 600px;
			height: 66vh;
		}

		#thumbsParentContainer {
			overflow-y: auto;
			overflow-x: hidden;
			padding-right: 5px;
		}
	}

	#zoomInlineContent {
		height: 600px;
		height: 66vh;
		border: #838383 solid 1px;
	}

	#thumbsParentContainer {
		height: 63%;
	}

	#thumbsParentContainer.thumbsParentContainerFullHeight {
		height: 100%;
	}

	.axZmMapParent {
		position: absolute;
		visibility: hidden;
		left: 15px; 
		bottom: 0; 
		/* subtract padding of col-md-6 #outerRight */
		width: calc(100% - 32px);
		height: 35%
	}

	/* align zoom map internal container at bottom */
	.axZmMapParent #axZm_zoomMapHolder {
		bottom: 0;
		left: 0;
	}

	@media (max-width: 991px) {
		#zoomInlineContent {
			margin-bottom: 20px;
		}

		/* remove map on small screens */
		.axZmMapParent {
			display: none!important;
		}
	}
</style>
</head>
<body>

<?php
// This is only for the demo, you can remove it
include ('navi.php');
?>
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header" style="margin-bottom: 30px;">
				AJAX-ZOOM - no toolbar, image map outside, zoom slider enabled, custom navi using api functions. Responsive ready!
			</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6" id="outerLeft">
			<!-- Container where AJAX-ZOOM will be loaded into -->
			<div id="zoomInlineContent"></div>
		</div>
		<div class="col-md-6" id="outerRight">
			<!-- Container where thumbs will be loaded into -->
			<div id="thumbsParentContainer"></div>
			<!-- Container for map -->
			<div id="mapContainer" style=""></div>
		</div>
	</div>

	
	<style type="text/css">@media (max-width: 991px) {#testEmbedMapInThumb{display: none;}}</style>
	<div class="row" style="margin-top: 25px;" id="testEmbedMapInThumb">
		<div class="col-md-6">
		</div>
		<div class="col-md-6" style="border-top: #CCC 1px dotted">
			Test: <input type="checkbox" value="true" name="embedMapInThumb" onchange="setOpt('embedMapInThumb')"> 
			- display the above AJAX-ZOOM "image map" in place of selected thumbnail.
		</div>
	</div>

	<!-- Fire azThumbGallery, that's it -->
	<script type="text/javascript" id="codeJsExec">
		jQuery.azThumbGallery({
			axZmPath: "../axZm/", // Path to /axZm directory, e.g. /test/axZm/
			zoomData: [ // Paths to images
				"/pic/zoom/fashion/fashion_001.jpg",
				"/pic/zoom/fashion/fashion_002.jpg",
				"/pic/zoom/fashion/fashion_003.jpg",
				"/pic/zoom/fashion/fashion_010.jpg",
				"/pic/zoom/boutique/boutique_006.jpg",
				"/pic/zoom/boutique/boutique_004.jpg",
				"/pic/zoom/boutique/boutique_005.jpg",
				"/pic/zoom/boutique/boutique_001.jpg",
				"/pic/zoom/boutique/boutique_003.jpg",
				"/pic/zoom/fashion/fashion_009.jpg",
				"/pic/zoom/fashion/fashion_007.jpg",
				"/pic/zoom/fashion/fashion_005.jpg"
			],

			firstFolder: null, // After page loads select from which subfolder thumbnails should be loaded, integer or string
			folderSelect: false, // Possible values: "select", "folders", "imgFolders"
			thumbModel: "grid", // Possible values: "fixed" or "grid"
			thumbUlClassGrid: "azGridThumb azGrid-6-xxl azGrid-4-xl azGrid-4-lg azGrid-6-md azGrid-4-sm azGrid-3-xs",
			axZmCallBacks: { // AJAX-ZOOM has several callbacks
				onBeforeStart: function() {
					// Set several AJAX-ZOOM settings before 

					// enable AJAX-ZOOM "image map"
					jQuery.axZm.useMap = true;

					// set id of the parent container for AJAX-ZOOM "image map", which is part of the HTML of this example
					jQuery.axZm.mapParent = 'mapContainer';
					jQuery.axZm.mapParCenter = false;
					jQuery.axZm.mapSelClickZoomOut = false;

					// Set some controls over JS
					jQuery.axZm.mNavi.enabled = true;
					jQuery.axZm.mNavi.fullScreenShow = true;
					jQuery.axZm.mNavi.mouseOver = true;
					jQuery.axZm.mNavi.gravity = 'bottomRight';
					jQuery.axZm.mNavi.offsetVert = 5;
					jQuery.axZm.mNavi.offsetVertFS = 5;

					jQuery.axZm.mNavi.alt.enabled = false;
					jQuery.axZm.mNavi.order = {
						mZoomOut: 5,
						mZoomIn: 5,
						mReset: 0
					}

					jQuery.axZm.icons.mZoomIn = {file: 'transparent/button_iPad_in', ext: 'png', w: 25, h: 25};
					jQuery.axZm.icons.mZoomOut = {file: 'transparent/button_iPad_out', ext: 'png', w: 25, h: 25};
					jQuery.axZm.icons.mReset = {file: 'transparent/button_iPad_reset', ext: 'png', w: 25, h: 25};

					jQuery.axZm.zoomSlider = true;
					jQuery.axZm.zoomSliderHorizontal = true;
					jQuery.axZm.zoomSliderHeight = 80;
					jQuery.axZm.zoomSliderHandleSize = 11;
					jQuery.axZm.zoomSliderWidth = 5;
					jQuery.axZm.zoomSliderMarginH = 10;
					jQuery.axZm.zoomSliderPosition = 'bottomLeft';
					jQuery.axZm.zoomSliderMouseOver = true;

					var param = jQuery.azThumbGallery.getParam('thumbsParentContainer');
					if (!param.embedMode) {
						jQuery.axZm.zoomSlider = false;
						jQuery.axZm.mNavi.enabled = false;
					}
				}
			},
			fullScreenApi: false, // Try to open AJAX-ZOOM at browsers fullscreen mode
			thumbsPerPage: null, // Show this number of thumbnails at once
			thumbsContainer: "thumbsParentContainer", // ID of the element where thumbnails appended to
			selectContainer: "selectParentContainer", // ID of the element where the select with subfolders will be appended to
			embedMode: true, // Display AJAX-ZOOM next to the thumbs
			embedResponsive: true, // if "embedDivID" is responsive, set it to true
			embedMapInThumb: false, // Show AJAX-ZOOM "image map" in place of selected thumbnail. 
			embedExample: 18, // Configuration set which is passed to AJAX-ZOOM when "embedMode" is enabled
			embedDivID: "zoomInlineContent", // ID of the element (placeholder) where AJAX-ZOOM has to be inserted into 
			embedZoomSwitchAnm: "SwipeHorz", // Possible values: "Center", "Top", "Right", "Bottom", "Left", "StretchVert", "StretchHorz", "SwipeHorz", "SwipeVert", "Vert", "Horz" 
			embedZoomSwitchSpeed: 300
		});
	</script>

	<!--  This is just a helper function for the demo to switch options -->
	<script type="text/javascript" language="javascript">
		function setOpt(opt) {
			var param = $.azThumbGallery.getParam('thumbsParentContainer'),
				val = $("input[name='"+opt+"']:checked").val();

			if (val == undefined) {
				val = $("select[name='"+opt+"'] option:selected").val();
			}

			if (val == 'true') {
				val = true;
			}

			if (val == 'false') {
				val = false;
			}

			param[opt] = val;

			if (opt == 'thumbsPerPage') {
				$('#thumbsParentContainer').data('reloadThumbs')();
			}

			if (opt == 'folderSelect') {
				$('#thumbsParentContainer').data('reloadFolders')();
			}

			if (opt == 'embedMapInThumb') {
				$('#mapContainer').css('visibility', 'hidden').appendTo('#outerRight');
				var initOpt = $('#thumbsParentContainer').data('aZiO');
				initOpt[opt] = val;
				$.azThumbGallery(initOpt);
				if (val == true) {
					$('#thumbsParentContainer').addClass('thumbsParentContainerFullHeight');
				} else {
					$('#thumbsParentContainer').removeClass('thumbsParentContainerFullHeight');
				}
			}
		}
	</script>

	<div class="row" style="margin-top: 50px;">
		
		<div class="col-md-12">
			<p>In this example several images from different location are passed to the $.axZm.thumbGallery over "zoomData" option. 
				The plugin generates a grid of thumbs next to AJAX-ZOOM player instantly. It is also possible to load images from a folder.
				When clicked on the thumbs images in the player are switched to the selection.
			</p>

			<p>To achieve simmilar result one could also use AJAX-ZOOM native API (without $.axZm.thumbGallery plugin).
				Most important API function for this is: 
				<a href="http://www.ajax-zoom.com/index.php?cid=docs#api_zoomSwitch">$.fn.axZm.zoomSwitch</a>;  
				$.axZm.thumbGallery is commented and could be edited by interesting programmers. 
				The plugin is used in several other examples you might want to take a look at<sup><a href="#o_sup_1">1</a></sup>.
			</p>

			<p><b>Toolbar:</b> in this example the "native" toolbar is completly disabled. 
				Instead "mNavi" buttons are set in onBeforeStart callback with JS. 
				Can be also done in /axZm/zoomConfig.inc.php or /axZm/zoomConfigCustom.inc.php 
				after <code>elseif ($_GET['example'] == 18){</code> 
				See also "embedExample" option below.
			</p>

			<p><b>Image map:</b> unlike in most other examples the image map is positioned outside of AJAX-ZOOM player. 
				This can be done with the option "mapParent" in /axZm/zoomConfig.inc.php or zoomConfigCustom.inc.php; 
				"mapParent" defines the ID of a block element e.g. a DIV on the page. 
				The map fits inside the responsive parent container difined by "mapParent" option, in this example directly over JS 
				in onBeforeStart callback as jQuery.axZm.mapParent = 'mapContainer'; you can also place the AJAX-ZOOM "image map" 
				over / in place of selected thumbnail. In this particular layout we have chose to hide AJAX-ZOOM "image map" on small screens 
				(below 991px) over @media CSS rule.
			</p>

			<!-- Code head -->
			<h3>JavaScript & CSS files</h3>
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
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>
			');
			echo '</code></pre>';
			?>
			</div>

			<!-- Code head -->
			<h3>Example lyout</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup" id="codeCss">';
				echo htmlspecialchars ('

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
<div class="row" id="outerParent">
	<div class="col-md-6" id="outerLeft">
		<!-- Container where AJAX-ZOOM will be loaded into -->
		<div id="zoomInlineContent"></div>
	</div>
	<div class="col-md-6" id="outerRight">
			<!-- Container where thumbs will be loaded into -->
			<div id="thumbsParentContainer"></div>

			<!-- Container for map -->
			<div id="mapContainer" style=""></div>
	</div>
</div>
			');
			echo '</code></pre>';
			?>
			</div>

			<!-- Code js -->
			<h3>JavaScript</h3>
			<div style="clear: both; margin: 5px 0px 5px 0px;">
				<pre>
					<code id="codeJs"></code>
				</pre>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						if (!window.Prism){return;}
						jQuery('#codeJs').html(jQuery('#codeJsExec').html()).addClass("language-js");
						jQuery('#codeCss').html(jQuery('#codeCssExec').html()).addClass("language-css");
						Prism.highlightElement(jQuery('#codeJs')[0]);
					});
				</script>
			</div>

			<!-- Docu -->
			<h3>$.azThumbGallery - documentation (options)</h3>
			<div>
				<?php include (dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html');?>
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