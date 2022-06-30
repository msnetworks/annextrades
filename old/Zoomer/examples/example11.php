<!DOCTYPE html>
<html>
	<head>
		<title>11</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed! -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- jQuery core, needed if jQuery core is not already present! -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- AJAX-ZOOM gallery extension -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>

		<!-- jQuery splitter plugin for changing the size of the "windows" -->
		<link rel="stylesheet" href="../axZm/plugins/demo/jquery.splitter/css/jquery.splitter.css" />
		<script type="text/javascript" src="../axZm/plugins/demo/jquery.splitter/js/jquery.splitter.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>


		<style type="text/css" id="exampleCss"> 
			/* CSS for layout */
			body, html {
				height: 100%;
				overflow: hidden;
				margin: 0;
				padding: 0;
			}

			#splitLayoutWrap {
				position: absolute;
				overflow: hidden;
				width: 100%;
				height: calc(100% - 58px);
				left: 0;
				right: 0;
				bottom: 0;
			}

			#splitLayoutWrap, #splitLayoutWrap * {
				box-sizing: border-box;
			}

			@media screen and (max-width: 768px) {
				#splitLayoutWrap {
					height: calc(100% - 42px);
				}
			}

			#splitLayoutParent {
				position: absolute;
				width: 100%;
				height 100%;
				left: 0;
				top: 0;
				right: 0;
				bottom: 0;
			}

			#zoomInlineContent {
				position: absolute;
				width: 50%;
				height: 100%;
				overflow: hidden;
				z-index: 1;
			}

			#rightHalf {
				position: absolute;
				width: 50%;
				height: 100%;
				right: 0;
				background-color: #f9f9f9;
				z-index: 1;
				overflow-x: hidden;
			}

			#rightFoldersParent {
				position: absolute;
				height: 180px;
				top: 0;
				overflow-x: hidden;
				overflow-y: auto;
				-webkit-overflow-scrolling: touch;
			}

			#rightThumbsParent {
				position: absolute;
				height: calc(100% - 180px);
				bottom: 0;
				overflow-x: hidden;
				overflow-y: auto;
				-webkit-overflow-scrolling: touch;
			}
		</style>

		<style type="text/css">
			/* some cosmetics */
			::-webkit-scrollbar-track-piece{
				background-color: #f9f9f9;
				-webkit-border-radius:0;
			}

			::-webkit-scrollbar{
				width:8px;
				height:8px;
			}

			::-webkit-scrollbar-thumb{
				height: 50px;
				background-color: #999;
				-webkit-border-radius: 4px;
				outline: 2px solid #f9f9f9;
				outline-offset: -2px;
				border: 2px solid #f9f9f9;
			}

			::-webkit-scrollbar-thumb:hover{
				height: 50px;
				background-color: #9f9f9f;
				-webkit-border-radius: 4px;
			}

			.splitter_panel .hsplitter {
				background-color: grey;
			}

			@media screen and (max-width: 600px) {
				#unneededText {
					display: none;
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

		<!-- Layout wrap -->
		<div id="splitLayoutWrap">

			<!-- Splitters wrap -->
			<div id="splitLayoutParent">

				<!-- This is where AJAX-ZOOM will be inserted into -->
				<div id="zoomInlineContent"></div>

				<!-- Parent container for folders and thumbs -->
				<div id="rightHalf">

					<div id="rightFoldersParent">
						<!-- This is where folders or select element will be inserted into -->
						<div id="selectParentContainer" style="padding: 10px;"></div>
					</div>

					<div id="rightThumbsParent">
						<!-- This is where thumbnails will be inserted into -->
						<div id="thumbsParentContainer" style="padding: 10px;"></div>

						<div style="padding: 10px; clear: both; overflow-x: hidden;">
							<h3>About</h3>
							<p>In this example the $.azThumbGallery AJAX-ZOOM extension is integrated into responsive layout. 
								It does not require any PHP code within the actual page. 
								A third party jQuery "split" plugin is used to split the page horizontally and 
								the right part vertically, so there are three windows, which can be resized on the screen. 
								Apparently this paricular example is not very suitable for an iphone, 
								there are however few other, where same $.azThumbGallery extension is used and 
								the high-resolution image opens at fullscreen. On an iPad size of the mobile device, 
								this example is absolutely usable. If AJAX-ZOOM is used anyway in a "DAM" system
							</p>
							<p>On default, the folders at top are subfolders of a particular path, which is passed from plugin. 
								Subsolders of subforders are not displayed, so recursive nabigation is not possible. 
								However, it is possible to change the plugin to accomplish this task too if needed.
							</p>
						</div>

						<!-- Below is not needed, this is just some content -->
						<div id="unneededText" style="padding: 10px; clear: both; overflow-x: hidden;">
							<!-- Code head -->
							<h3>JavaScript & CSS files in Head</h3>
							<div style="clear:both; margin: 5px 0px 5px 0px;">
								<?php
								echo '<pre><code class="language-markup">';
								echo htmlspecialchars ('
<!-- jQuery core, needed if jQuery core is not already present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- AJAX-ZOOM gallery extension -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.azGrid.css" type="text/css">
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.thumbGallery.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.thumbGallery.js"></script>

<!-- jQuery splitter plugin for changing the size of the "windows" -->
<link rel="stylesheet" href="../axZm/plugins/demo/jquery.splitter/css/jquery.splitter.css" />
<script type="text/javascript" src="../axZm/plugins/demo/jquery.splitter/js/jquery.splitter.js"></script>
								');
								echo '</code></pre>';
								?>
							</div>

							<h3>CSS in Head (can be put into a css file)</h3>
							<div style="clear:both; margin: 5px 0px 5px 0px;">
								<pre><code class="language-css" id="exampleCssDiv"></code></pre>
							</div>

							<!-- Code body -->
							<h3>HTML makup in body</h3>
							<p>All containers are responsive in this example! Note that "embedResponsive" option below is set to true.
							</p>

							<div style="clear:both; margin: 5px 0px 5px 0px;">
								<?php
								echo '<pre><code class="language-markup">';
								echo htmlspecialchars ('
<!-- Layout wrap -->
<div id="splitLayoutWrap">

	<div id="splitLayoutParent">

		<!-- This is where AJAX-ZOOM will be inserted into -->
		<div id="zoomInlineContent"></div>

		<!-- Parent container for folders and thumbs -->
		<div id="rightHalf">

			<div id="rightFoldersParent">
				<!-- This is where folders or select element will be inserted into -->
				<div id="selectParentContainer" style="padding: 10px;"></div>
			</div>

			<div id="rightThumbsParent">
				<!-- This is where thumbnails will be inserted into -->
				<div id="thumbsParentContainer" style="padding: 10px;"></div>
			</div>
		</div>
	</div>
</div>
								');
								echo '</code></pre>';
								?>
							</div>

							<!-- Code js -->
							<h3>JavaScript</h3>
							<div style="clear:both; margin: 5px 0px 5px 0px;">
								<pre><code class="language-js" id="exampleJsDiv"></code></pre>
							</div>

							<?php
							if (file_exists(dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html')) {
								?><h3>Documentation</h3><?php
								include dirname(__FILE__).'/extensions_doc/docu_thumbGallery.inc.html';
							}

							if (file_exists(dirname(__FILE__).'/footer.php')) {
								// This is only for the demo, you can remove it
								define('COMMENTS_BOOTSTRAP', true);
								include dirname(__FILE__).'/footer.php';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" id="exampleJs">
			jQuery(function($) {

				// The split plugin sets height in pixel on page load, but does not adjust it on resize. 
				// So we need to adjust it differently event if it is css responsive
				var onResizePage = function() {
					var hh = $('#splitLayoutParent').parent().innerHeight();
					$('#splitLayoutParent, #rightHalf').css('height', hh);
				};

				$(window).bind('resize orientationchange', onResizePage);

				// Splitter between folders and thumbnails
				$("#rightHalf").split({
					orientation: "horizontal",
					limit: 120,
					position: "30%"
				});

				// Splitter between left and right side
				$("#splitLayoutParent").split({
					orientation: "vertical",
					limit: 240,
					position: "50%",
					onDragStart: function(){
						$.fn.axZm.resizeStart(30000);
					},
					onDragEnd: function(){
						$.fn.axZm.resizeStart(1);
					}
				});

				// Init AJAX-ZOOM gallery extension
				$.azThumbGallery({
					axZmPath: "../axZm/", // Path to /axZm directory, e.g. /test/axZm/
					zoomDir: "/pic/zoom", // Path to subfolders with images
					firstFolder: "boutique", // After page loads select from which subfolder thumbnails should be loaded, integer or string
					folderSelect: "folders", // Possible values: "select", "folders", "imgFolders"
					axZmCallBacks: {}, // AJAX-ZOOM has several callbacks
					fullScreenApi: false, // Try to open AJAX-ZOOM at browsers fullscreen mode

					thumbModel: "fixed", // Possible values: grid, fixed
					thumbsCache: true, // Cache thumbnails
					thumbWidth: 100, // Width of the thumbnail image
					thumbHeight: 100, // Height of the thumbnail image
					thumbQual: 90, // jpg quality of the thumbnail image
					thumbPadding: 5, // Padding 
					thumbMarginRight: 8, // Margin right
					thumbMarginBottom: 28, // Margin bottom

					thumbsPerPage: null, // Show this number of thumbnails at once
					thumbDescr: ["fileName"], // Show filename under thumbs
					thumbDescrTruncate: 25, // Trancate filename string after 25 chars
					thumbsContainer: "thumbsParentContainer", // ID of the element where thumbnails appended to
					selectContainer: "selectParentContainer", // ID of the element where the select with subfolders will be appended to

					embedMode: true, // Display AJAX-ZOOM next to the thumbs
					embedModeMinSize: 0, // Always display ebed mode
					embedResponsive: true, // if "embedDivID" is responsive, set it to true
					embedExample: 9, // Configuration set which is passed to AJAX-ZOOM when "embedMode" is enabled
					embedDivID: "zoomInlineContent", // ID of the element (placeholder) where AJAX-ZOOM has to be inserted into 
					embedZoomSwitchAnm: "SwipeHorz", // Possible values: "Center", "Top", "Right", "Bottom", "Left", "StretchVert", "StretchHorz", "SwipeHorz", "SwipeVert", "Vert", "Horz" 
					embedZoomSwitchSpeed: 300 // // Set speed of switching between images
				});
			});
		</script>

		<script type="text/javascript">
			jQuery('#exampleJsDiv').html(jQuery('#exampleJs').html());
			jQuery('#exampleCssDiv').html(jQuery('#exampleCss').html());
		</script>
	</body>
</html>