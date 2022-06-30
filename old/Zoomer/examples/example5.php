<!DOCTYPE html>
<html>
<head>
<title>5</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed! -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>" type="text/css">

<!-- jQuery core, needed if not present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link rel="stylesheet" href="../axZm/axZm.css<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>"></script>

<!-- AJAX-ZOOM thumbGallery extension, needed! -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>"></script>

<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM,
only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>"></script>

<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox,
requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>"></script>

<!-- Colorbox plugin, only needed if ajaxZoomOpenMode below is set to "colorbox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js<?php echo isset($az_files_version) ? '?pv='.$az_files_version : ''; ?>"></script>

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

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
			<h1 class="page-header">AJAX-ZOOM - responsive thumbnails gallery with ajax page switch (pagination)</h1>
		</div>
		<div class="col-md-12">
			<p>An example of creating a responsive image grid gallery with thumbnails and show large images on click using AJAX-ZOOM viewer.
			</p>
			<p>The AJAX-ZOOM image viewer can open in a modal window (responsive "Fancybox", "Fancybox", "Colorbox"), as an overlay of the full browser window or at fullscreen.
			</p>
			<p>All external CSS and JavaScript code to create such a gallery is put together into one AJAX-ZOOM <code>$.azThumbGallery</code> extension / jQuery plugin.
				The options of this plugin include pagination, thumbnails size, number of thumbnails in a row and many other useful features.
			</p>
			<p>With the below configuration, the plugin requests all images from the path that is set in the "zoomDir" option of the plugin.
				It then automatically generates the images thumbnails and places them into a container of your choice.
				Instead of the "zoomDir" option, you can use another option and let the plugin list images located under different directories.
			</p>
			<p>The <code>$.axZm.thumbGallery</code> JavaScript is a very flexible plugin with many options.
				Several other examples that look totally different use it too<sup><a href="#o_sup_1">1</a></sup>.
				You can find the links at the bottom of this page below the documentation of the plugin.
				The code of the plugin has comments, and as a developer, you could adapt it to your requirements.
			</p>
		</div>

		<div class="col-md-12">
			<h3 style="color: #aaa"><em>Demo images gallery</em></h3>
			<!-- Container where thumbs will be loaded into -->
			<div id="thumbsParentContainer" style="min-height: 150px;"></div>
		</div>

		<!-- Fire azThumbGallery, that's it -->
		<script type="text/javascript" id="exampleJs">
			jQuery.azThumbGallery({
				axZmPath: "../axZm/", // Path to /axZm directory, e.g. /test/axZm/
				zoomDir: "/pic/zoom/trasportation", // Path to a folder with images
				zoomData: null, // Particular images, see documentation
				folderSelect: false, // Possible values: "select", "folders", "imgFolders" or false
				axZmCallBacks: {}, // AJAX-ZOOM has several callbacks, http://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
				fullScreenApi: false, // try to open AJAX-ZOOM at browsers fullscreen mode
				thumbsPerPage: false, // Show this number of thumbnails at once
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
				ajaxZoomOpenMode: "fullscreen", // possible values: "fullscreen", "fancyboxFullscreen", "fancybox", "colorbox"
				exampleFullscreen: "mouseOverExtension", // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "fullscreen"
				exampleFancyboxFullscreen: "mouseOverExtension", // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "fancyboxFullscreen"
				exampleFancybox: 2, // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "fancybox"
				exampleColorbox: 'modal' // configuration set which is passed to ajax-zoom when ajaxZoomOpenMode is "colorbox"
			});
		</script>

		<!--  This is just a helper function for the demo to switch between ajaxZoomOpenMode option -->
		<script type="text/javascript" language="javascript">
			function setOpt(opt) {
				var param = $.azThumbGallery.getParam('thumbsParentContainer'),
					val = $("input[name='"+opt+"']:checked").val();

				if (val == undefined) {
					val = $("select[name='"+opt+"'] option:selected").val();
				}

				if (val == 'true') {
					val = true;
				} else if (val == 'false') {
					val = false;
				} else if (parseInt(val) == val) {
					val = parseInt(val);
				}

				param[opt] = val;

				if (opt == 'thumbsPerPage' || opt == 'thumbsPerPageResponsive' || opt == 'thumbsPerPageRows') {

					if (opt == 'thumbsPerPageResponsive' && val === true) {
						param.thumbsPerPage = null;
						$('select[name="thumbsPerPage"]').val('null');
						$('#thumbsPerPageRows_tr').css('display', '');
					} else if (opt == 'thumbsPerPageResponsive' && val === false) {
						$('#thumbsPerPageRows_tr').css('display', 'none');
					} else if (opt == 'thumbsPerPage') {
						param.thumbsPerPageResponsive = false;
						$('input[name="thumbsPerPageResponsive"][value="false"]').prop('checked', true);
						$('#thumbsPerPageRows_tr').css('display', 'none');
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
				<tr><td><h3>Few interesting extension options</h3></td></tr>
				<tr>
					<td>
						Enable monitor size fullscreen:
						<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="true"> - enable
						<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="false" checked> - disable
					</td>
				</tr>
				<tr>
					<td style="padding-top: 5px;">
						Thumbs per page:
						<select name="thumbsPerPage" autocomplete="off"  onchange="setOpt('thumbsPerPage')">
							<option value="null">null (all)</option>
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
					</td>
				</tr>
				<tr>
					<td style="padding-top: 5px;">
						Number of thumbs depends on screen size:
						<input type="radio" autocomplete="off"  name="thumbsPerPageResponsive" onclick="setOpt('thumbsPerPageResponsive')" value="true" checked> - enabled
						<input type="radio" autocomplete="off"  name="thumbsPerPageResponsive" onclick="setOpt('thumbsPerPageResponsive')" value="false"> - disabled
						<br>
						<small>If "thumbsPerPageResponsive" option (above) is enabled, the number of thumbs per page depends on "thumbsPerPageNumber" option
							and in this example, it is set to be the same as the number of thumbnails in <strong>one row</strong>, which is responsive per breakpoints too.
							You could also adjust this option (set "thumbsPerPageRows" option) to have two rows etc.
							Resize the browser window to see the difference.
						</small>
					</td>
				</tr>
				<tr id="thumbsPerPageRows_tr">
					<td style="padding-top: 5px;">
						Rows per page:
						<select name="thumbsPerPageRows" autocomplete="off"  onchange="setOpt('thumbsPerPageRows')">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select> - <small>if "thumbsPerPageResponsive" option is enabled you can set the number of rows for pagination with the "thumbsPerPageRows" option.</small>
					</td>
				</tr>
			</table>
		</div>
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
						overridden by "openModeEnforceFullscreen" option. Its default value is 1024 (pixels).
						If screen width is less than or equal to this value, the open method automatically changes to "fullscreen".
						</small>
					</td>
				</tr>
			</table>
		</div>

		<div class="col-md-12">
			<h3>JavaScript & CSS files in Head</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- jQuery core, needed if not already available! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- AJAX-ZOOM thumbGallery extension, needed! -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>

<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, only needed if "ajaxZoomOpenMode" below is set to "fancyboxFullscreen" or "fancybox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

<!-- Colorbox plugin, only needed if "ajaxZoomOpenMode" below is set to "colorbox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>
			');
				echo '</code></pre>';
			?>
			</div>

			<h3>HTML markup in body</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
			<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- Container where thumbs will be loaded into -->
<div id="thumbsParentContainer" class="clearfix" style="min-height: 150px; clear: both"></div>
			');
			echo "</code></pre>";
			?>
			</div>

			<h3>JavaScript</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<pre><code class="language-js" id="exampleJsPrism"></code></pre>
			</div>

			<h3 style="margin-top: 50px">$.azThumbGallery - documentation (options)</h3>
			<div>
				<?php
				if (file_exists(dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html')) {
					include dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html';
				}
				?>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$('#exampleJsPrism').html($('#exampleJs').html());
</script>

</body>
</html>