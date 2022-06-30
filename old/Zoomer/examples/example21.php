<!DOCTYPE html>
<html>
	<head>
		<title>21</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed! -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- jQuery core, needed if not present! -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM core, needed! -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- AJAX-ZOOM thumbGallery extension, needed! -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>

		<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, 
		only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional -->
		<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

		<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, 
		requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

		<!-- Colorbox plugin, only needed if ajaxZoomOpenMode below is set to "colorbox", optional -->
		<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>

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

			<h1 class="page-header">AJAX-ZOOM - responsive thumbnails gallery</h1>

			<p>Ver. 4.2.1+ This example has been totally rewritten. It does not contain indispensable PHP code within the actual page any more. 
				Also all JavaScript has been wrapped into one plugin (jQuery.axZm.thumbGallery) which is controllable 
				over various options passed to it. 
			</p>

			<p>The plugin generates a select form element or some other html to display the subfolders. 
				When changed / clicked on the folder thumbnailed images are instantly generated and displayed in a responsive way. 
				Clicking on a thumb opens high resolution tiled image view in "AJAX-ZOOM" player. 
				Depending on the option passed to the plugin, "AJAX-ZOOM" player ("ajaxZoomOpenMode") 
				opens at fullscreen mode, responsive lightbox, "fancybox" or "colorbox". 
			</p>

			<p>One of the notable options is "thumbsPerPage" where you can limit the number of thumbs displayed on page.
			</p>

			<!-- Container where subfolders will be loaded into -->
			<div id="selectParentContainer" class="clearfix" style='margin-bottom: 10px; min-height: 86px; border-bottom: #CCC 1px solid; padding-bottom: 3px;' ></div>

			<!-- Container where thumbs will be loaded into -->
			<div id='thumbsParentContainer' class="clearfix" style="min-height: 150px; clear: both"></div>

			<!-- Fire azThumbGallery, that's it -->
			<script type="text/javascript" id="exampleJs">

				jQuery.azThumbGallery({
					axZmPath: "../axZm/", // Path to /axZm directory, e.g. /test/axZm/
					zoomDir: "/pic/zoom/", // Path to subfolders with images
					zoomData: null, // Particular images, see documentation
					folderSelect: 'imgFolders', // Possible values: "select", "folders", "imgFolders"
					axZmCallBacks: {}, // AJAX-ZOOM has several callbacks, http://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
					fullScreenApi: false, // try to open AJAX-ZOOM at browsers fullscreen mode
					thumbsPerPage: null, // Show this number of thumbnails at once
					thumbsContainer: "thumbsParentContainer", // ID of the element where thumbnails appended to
					selectContainer: "selectParentContainer", // ID of the element where the select with subfolders will be appended to
					firstFolder: 1, // After page loads select from which subfolder thumbnails should be loaded, integer or string
					thumbModel: "grid", // possible values: grid, fixed
					// Class for the UL element, when "thumbModel" option value is "grid"
					thumbUlClassGrid: "azGridThumb azGrid-12-xxl azGrid-8-xl azGrid-6-lg azGrid-6-md azGrid-4-sm azGrid-2-xs",

					thumbsPerPageResponsive: false, // Number of thumbs per page depends on screen size
					thumbsPerPageNumber: {
						"xs": 2,
						"sm": 4,
						"md": 6,
						"lg": 6,
						"xl": 8,
						"xxl": 12
					},
					thumbsContainer: "thumbsParentContainer", // ID of the element where thumbnails appended to
					ajaxZoomOpenMode: "fullscreen", // possible values: "fullscreen", "fancyboxFullscreen", "fancybox", "colorbox"
					exampleFullscreen: "mouseOverExtension", // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "fullscreen"
					exampleFancyboxFullscreen: "mouseOverExtension", // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "fancyboxFullscreen"
					exampleFancybox: 2, // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "fancybox"
					exampleColorbox: 'modal' // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "colorbox"
				});
			</script>

			<div class="row" style="margin-top: 20px; border-top: #ccc 1px dotted">
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
				<div class="col-md-6">
					<table>
						<tr><td colspan="2"><h3>Try various AJAX-ZOOM open mods</h3></td></tr>
						<tr>
							<td width="30"><input type="radio" autocomplete="off"  name="ajaxZoomOpenMode" onclick="setOpt('ajaxZoomOpenMode')"  value="fullscreen" checked></td>
							<td>Open AJAX-ZOOM at fullscreen mode</td>
						</tr>
						<tr>
							<td><input type="radio" autocomplete="off"  name="ajaxZoomOpenMode" onclick="setOpt('ajaxZoomOpenMode')" value="fancyboxFullscreen"></td>
							<td>Open AJAX-ZOOM in responsive "Fancybox"</td>
						</tr>
						<tr>
							<td><input type="radio" autocomplete="off"  name="ajaxZoomOpenMode" onclick="setOpt('ajaxZoomOpenMode')" value="fancybox"></td>
							<td>Open AJAX-ZOOM in regular "Fancybox"</td>
						</tr>
						<tr>
							<td><input type="radio" autocomplete="off"  name="ajaxZoomOpenMode" onclick="setOpt('ajaxZoomOpenMode')" value="colorbox"></td>
							<td>Open AJAX-ZOOM in "Colorbox"</td>
						</tr>
						<tr>
							<td>&zwj;</td>
							<td><small>Please note, that the "ajaxZoomOpenMode" option above can be 
								overridden by by "openModeEnforceFullscreen" option, which value is set to 1024 (pixels) on default. 
								If screen width is less than or equal of this value, the open method will be "fullscreen".
								</small>
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<table>
						<tr><td><h3>Few other extension options</h3></td></tr>
						<tr>
							<td> 
								Enable monitor size fullscreen: 
								<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="true"> - enable 
								<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="false" checked> - disable
							</td>
						</tr>
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
					</table>
				</div>
			</div>

			<h3>JavaScript & CSS files in Head</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- jQuery core, needed if not present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- AJAX-ZOOM thumbGallery extension, needed! -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>

<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, 
only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, 
requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

<!-- Colorbox plugin, only needed if ajaxZoomOpenMode below is set to "colorbox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>
				');
				echo '</code></pre>';
				?>
			</div>

			<h3>HTML makup in body</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- Container where subfolders will be loaded into -->
<div id="selectParentContainer"> - switch folders with AJAX</div>

<!-- Container where thumbs will be loaded into -->
<div id="thumbsParentContainer" style="min-height: 150px;"></div>
				');
				echo '</code></pre>'
				?>
			</div>

			<h3>JavaScript</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<pre><code class="language-js" id="exampleJsDemo"></code></pre>
				<script type="text/javascript">jQuery('#exampleJsDemo').html(jQuery('#exampleJs').html());</script>
			</div>

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
	</body>
</html>