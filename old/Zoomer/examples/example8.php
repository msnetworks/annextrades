<!DOCTYPE html>
<html>
<head>
<title>8</title>
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
/* Override some default styles for the demo */
.axZm_zoomNavigation {
	background-image: none;
	background-color: transparent;
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
	<h1 class="page-header" style="margin-bottom: 50px">
		AJAX-ZOOM - embedded implementation with custom gallery next to the player.
		Get all images from a folder with "zoomDir".
		Responsive ready.
	</h1>

	<div class="row">
		<div class="col-md-6">
			<p>Ver. 4.2.1+ This example has been totally rewritten. It does not contain required PHP code within the actual page any more.
				Also all JavaScript has been wrapped into one plugin ($.axZm.thumbGallery) which is controllable
				over various options passed to it.
			</p>
			<p>The plugin generates a select form element or some other html to display the subfolders.
				When changed / clicked on the folder thumbnailed images are instantly generated and displayed in a responsive way.
				Clicking on a thumb switches the image in AJAX-ZOOM player which is displayed next to the external gallery.
			</p>
		</div>

		<div class="col-md-6">
			<h3 style="margin-top: 0;">Try some options</h3>
			<!--  This is just a helper function for the demo to switch between ajaxZoomOpenMode option -->
			<script type="text/javascript" language="javascript">
				function setOpt(opt) {
					var param = $.azThumbGallery.getParam('thumbsParentContainer'),
						val = $("input[name='"+opt+"']:checked").val();

					if (val == undefined) {
						val = $("select[name='"+opt+"'] option:selected").val();
					}

 					if (val == 'true'){val = true;}
 					if (val == 'false'){val = false;}

 					param[opt] = val;

 					if (opt == 'thumbsPerPage' || opt == 'thumbsPerPageResponsive') {

 						if (opt == 'thumbsPerPageResponsive' && val === true) {
 							param.thumbsPerPage = null;
 							$('select[name="thumbsPerPage"]').val('null');
						} else if (opt == 'thumbsPerPage') {
							param.thumbsPerPageResponsive = false;
							$('input[name="thumbsPerPageResponsive"][value="false"]').prop('checked', true);
						}

 						$('#'+param.thumbsContainer).data('reloadThumbs')();
					}

 					if (opt == 'folderSelect') {
 						$('#'+param.thumbsContainer).data('reloadFolders')();
					}
				}
			</script>

			<!-- Demo options switch -->
			<div style="border-bottom: #AAA 1px solid; padding-bottom: 5px; margin-bottom: 10px">
				<table>
					<tr>
						<td> 
							Thumbs per page: 
							<select name="thumbsPerPage" autocomplete="off"  onchange="setOpt('thumbsPerPage')">
								<option value="null">All</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="8">8</option>
								<option value="10">9</option>
								<option value="10">10</option>
								<option value="12">12</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="20">20</option>
								<option value="25">25</option>
								<option value="30">30</option>
								<option value="50">50</option>
							</select> (fixed number)<br>
							Number of thumbs depends on screen size: 
							<input type="radio" autocomplete="off"  name="thumbsPerPageResponsive" onclick="setOpt('thumbsPerPageResponsive')" value="true"> - enabled 
							<input type="radio" autocomplete="off"  name="thumbsPerPageResponsive" onclick="setOpt('thumbsPerPageResponsive')" value="false" checked> - disabled
							<br>
							<small>If "thumbsPerPageResponsive" option (above) is enabled, the number of thumbs per page 
								depends on "thumbsPerPageNumber" option 
								and in this example it is set to be the same as the number of thumbnails in one row, 
								which is responsive per breakpoints too. You could also adjust this option to have two rows etc. 
								Resize the browser window to see the difference.
							</small>
						</td>
					</tr>
					<tr>
						<td style="padding-top: 15px; padding-bottom: 15px;">
							Display folders: 
							<select name="folderSelect" autocomplete="off"  onchange="setOpt('folderSelect')">
								<option value="imgFolders">- folders with image icons</option>
								<option value="folders" selected>- folder icons</option>
								<option value="select">- select form element</option>
								<option value="false">- disabled</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<!-- Container where AJAX-ZOOM will be loaded into -->
			<div id="zoomInlineContent" style="height: 600px; position: relative; max-height: calc(100vh - 50px); border: #AAA 1px solid"></div>
		</div>

		<div class="col-md-6">
			<!-- Container where folders navigation will be loaded into -->
			<div class="row col-md-12" style="margin-bottom: 20px;">
				<div id="selectParentContainer"></div>
			</div>
			
			<div class="row col-md-12" style="margin-bottom: 20px;">
				<!-- Container where thumbs will be loaded into -->
				<div id="thumbsParentContainer" style=""></div>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-12">
			<p style="margin-top: 30px;">
				To achieve simmilar result one could also use AJAX-ZOOM native API (without $.axZm.thumbGallery plugin).
				Most important API functions for this are:
				<a href="http://www.ajax-zoom.com/index.php?cid=docs#api_zoomSwitch">$.fn.axZm.zoomSwitch</a> and
				<a href="http://www.ajax-zoom.com/index.php?cid=docs#api_loadAjaxSet">$.fn.axZm.loadAjaxSet</a>;
				$.axZm.thumbGallery is commented and could be edited by interesting programmers.
				The plugin is used in several other examples you might want to take a look at<sup><a href="#o_sup_1">1</a></sup>.
			</p>
		</div>

		<!-- Fire azThumbGallery, that's it -->
		<script type="text/javascript" id="exampleJs">
			jQuery.azThumbGallery({
				axZmPath: "../axZm/", // Path to /axZm directory, e.g. /test/axZm/
				zoomDir: "/pic/zoom", // Path to subfolders with images
				firstFolder: "fashion", // After page loads select from which subfolder thumbnails should be loaded, integer or string
				folderSelect: "folders", // Possible values: "select", "folders", "imgFolders"
				axZmCallBacks: {}, // AJAX-ZOOM has several callbacks
				fullScreenApi: false, // Try to open AJAX-ZOOM at browsers fullscreen mode
				thumbModel: "grid", // possible values: grid, fixed

				// Class for the UL element, when "thumbModel" option value is "grid"
				thumbUlClassGrid: "azGridThumb azGrid-8-xxl azGrid-8-xl azGrid-6-lg azGrid-6-md azGrid-4-sm azGrid-2-xs",

				thumbsPerPageResponsive: true, // Number of thumbs per page depends on screen size
				thumbsPerPageNumber: {
					"xs": 2,
					"sm": 4,
					"md": 6,
					"lg": 6,
					"xl": 8,
					"xxl": 8
				},

				thumbsContainer: "thumbsParentContainer", // ID of the element where thumbnails appended to
				selectContainer: "selectParentContainer", // ID of the element where the select with subfolders will be appended to

				embedMode: true, // Display AJAX-ZOOM next to the thumbs
				embedExample: 9, // Configuration set which is passed to AJAX-ZOOM when "embedMode" is enabled
				embedDivID: "zoomInlineContent", // ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
			});
		</script>

		<div class="col-md-12">
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
			<h3>HTML makup in body</h3>
			<p>All containers can be responsive! If the container where AJAX-ZOOM will be loaded into is responsive,
				then set "embedResponsive" option below to true.
			</p>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<div class="row">
	<div class="col-md-6">
		<!-- Container where AJAX-ZOOM will be loaded into -->
		<div id="zoomInlineContent" style="height: 600px; position: relative; max-height: calc(100vh - 50px); border: #AAA 1px solid"></div>
	</div>

	<div class="col-md-6">
		<!-- Container where folders navigation will be loaded into -->
		<div class="row col-md-12" style="margin-bottom: 20px;">
			<div id="selectParentContainer"></div>
		</div>

		<div class="row col-md-12" style="margin-bottom: 20px;">
			<!-- Container where thumbs will be loaded into -->
			<div id="thumbsParentContainer" style=""></div>
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
				<pre><code class="language-js" id="exampleJsDemo"></code></pre>
				<script type="text/javascript">jQuery('#exampleJsDemo').html(jQuery('#exampleJs').html())</script>
			</div>

			<!-- Docu -->
			<h3>$.azThumbGallery - documentation (options)</h3>
			<div>
				<?php 
				if (file_exists(dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html')) {
					include (dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html');
				}
				?>
			</div>

			<?php
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				// This is only for the demo, you can remove it
				define('COMMENTS_BOOTSTRAP', true);
				include ('footer.php');
			}
			?>
		</div>
	</div>
</div>

</body>
</html>