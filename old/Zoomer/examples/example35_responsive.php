<!DOCTYPE html>
<html>
	<head>
		<title>35_responsive</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Include axZm.thumbSlider -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- Include jquery.axZm.imageCropLoad.js -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>

		<!-- A small function to add title button which will expend to full description -->
		<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.expButton.css"></link>
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css" id="exampleCss">
		/* copy of bootstraps embed-responsive and embed-responsive-item CSS classes
		if bootstrap or simmilar is included you could use them */
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

		/* padding bottom defines the aspect ratio or 
		e.g. height as persentage of screen height (50vh = 50% of screen) */
		#playerOuterWrap {
			padding-bottom: 50%;
			padding-bottom: 50vh; /* vh is not supported by IE9/10 */
		}

		/* playerWrap has padding to the right for the slider */
		#playerWrap {
			position: relative;
			padding-right: 99px;
			height: 100%;
		}

		/* outer container for the gallery */
		#cropSliderWrap {
			position: absolute;
			z-index: 11;
			width: 100px;
			height: 100%;
			right: -1px;
			top: 0px;
		}

		/* container where AJAX-ZOOM will be loaded into */
		#azParentContainer {
			height: 100%;
			position: relative;
		}

		/* container for slider */
		#cropSlider {
			position: absolute;
			width: 100px;
			height: 100%;
			background-color: #FFFFFF;
			overflow: hidden;
		}

		/* override some css when crop slider is at fullscreen */
		.axZmFsSpace .axZmThumbSlider_wrap {
			border-right-width: 0;
		}

		/* override some css of the slider, e.g. color of selct border */
		#cropSliderHorizontal li.selected,
		#cropSliderVertical li.selected {
			border-color: #2379b5;
			box-shadow: #2379b5 0px 0px 0px 1px;
		}
	</style>
	<style type="text/css">
		#highlightsText{
			position: absolute;
			bottom: 0;
			right: 0;
			width: 98px;
			height: 25px;
			line-height: 22px;
			text-align: left;
			padding: 2px 5px;
			font-family: monospace;
			font-size: 13px;
			background-color: #F2D3A2;
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
		<div style="min-height: 110px; background-color: #B9CC52; position: relative;">
			<h2 style="margin: 0; padding: 25px 10px 10px 10px;">
				Responsive cropped thumbs gallery with zoomTo or 360 spinTo and zoomTo
			</h2>
			<div id="highlightsText">Highlights</div>
		</div>

		<!-- Responsive container using, padding bottom defines the aspect ratio 
			padding bottom could be refined with @media queries as an idea... -->
		<div class="az_embed-responsive" id="playerOuterWrap">
			<div class="az_embed-responsive-item">
				<!-- playerWrap has padding to the right for the slider -->
				<div id="playerWrap">
					<!-- container where AJAX-ZOOM will be loaded into-->
					<div id="azParentContainer" style="">
						<!-- Content inside target will be removed -->
						<div style="padding: 20px">Loading, please wait...</div>
					</div>
					<!-- Thumb slider with croped images -->
					<div id="cropSliderWrap">
						<div id="cropSlider">
							<ul></ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" id="exampleJs">
		;(function($) {
			// Init the slider
			jQuery('#cropSlider').axZmThumbSlider({
				orientation: 'vertical',
				btnOver: true,
				btnHidden: true,
				btnFwdStyle: {borderRadius: 0, height: 20, bottom: -1, lineHeight: '20px'},
				btnBwdStyle: {borderRadius: 0, height: 20, top: -1, lineHeight: '20px'},

				thumbLiStyle: {
					height: 90,
					width: 90,
					lineHeight: 90,
					borderRadius: 0,
					margin: 3
				}
			});

			// AJAX-ZOOM
			// Create empty jQuery object (no not rename here)
			var ajaxZoom = {};

			// Define callbacks, for complete list check the docs
			ajaxZoom.opt = {

				onLoad: function() {

					// Load crop thumbs
					// You can also pass the path over query string, e.g.
					// example35.php?cropJsonURL=../pic/cropJSON/eos_1100d.json 
					// and skip cropJsonURL key in $.axZmImageCropLoad
					$.axZmImageCropLoad({
						cropJsonURL: '../pic/cropJSON/eos_1100d_demo.json',
						sliderID: 'cropSlider',
						spinToSpeed: '2500', // as string to override spinDemoTime when clicked on the thumbs,
						spinToMotion: 'easeOutQuint', // optionally pass spinToMotion to override spinToMotion set in config file, def. easeOutQuad
						handleTexts: function(title, description) {
							// One of the possible things to do with title and description
							// e.g. display texts with jquery.axZm.expButton.js (AJAX-ZOOM additional plugin)
							$.axZmEb({
								title: title,
								descr: description,
								gravity: 'top', // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
								marginY: 5,  // vertical margin depending on gravity
								zoomSpinPanRemove: 'cropSlider', // removes button / layer when there is some action inside AJAX-ZOOM
								autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
								removeOnClose: false // removes button when extended state is closed
							});
						}
					});

					// Possible motions types: 
					// 'swing', 'linear', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 
					// 'easeOutQuart','easeInOutQuart', 'easeInQuint','easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine', 
					// 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic',
					// 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce'

					// This would be the code for additionally loading hotspots made e.g. with example33.php
					//jQuery.aZcropEd.getJSONdataFromFile('../pic/cropJSON/eos_1100d.json');
				},

				onBeforeStart: function() {

					if ($.axZm.spinMod) {
						jQuery.axZm.restoreSpeed = 300;
					} else {
						jQuery.axZm.restoreSpeed = 0;
					}

					//jQuery.axZm.fullScreenCornerButton = false;
					jQuery.axZm.fullScreenExitText = false;

					// Chnage position of the map
					// jQuery.axZm.mapPos = 'bottomRight';

					// Set extra space to the right at fullscreen mode for the crop gallery
					jQuery.axZm.fullScreenSpace = {
						top: 0,
						right: 100,
						bottom: 0,
						left: 0,
						layout: 1
					};
				},
				onFullScreenSpaceAdded: function() {
					// Append slider to the extra space to the right
					jQuery('#cropSlider')
					.css({
						zIndex: 555
					})
					.appendTo('#axZmFsSpaceRight');
				},
				onFullScreenCloseEndFromRel: function() {
					// Restore position of the slider
					jQuery('#cropSlider')
					.css({
						zIndex: ''
					})
					.appendTo('#cropSliderWrap');
				}
			};

			// Define the path to the axZm folder, adjust the path if needed!
			ajaxZoom.path = "../axZm/"; 

			// Define your custom parameter query string
			// example=spinIpad has many presets for 360 images
			// 3dDir - best of all absolute path to the folder with 360/3D images
			// if it is a 2D image just pass zoomData=/path/to/your/image/image1.jpg|/path/to/other/image/image2.jpg instead of 3dDir
			// ajaxZoom.parameter = "example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali"; 
			// Define your custom parameter query string

			ajaxZoom.parameter = "example=spinIpad";
			ajaxZoom.parameter += "&3dDir=../pic/zoom3d/Uvex_Occhiali";

			ajaxZoom.divID = 'azParentContainer';

			// open AJAX-ZOOM responsive
			// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
			window.fullScreenStartSplash = {enable: false, className: false, opacity: 0.75};
			$.fn.axZm.openResponsive(
				ajaxZoom.path, // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
				ajaxZoom.parameter, // Defines which images and which options set to load
				ajaxZoom.opt, // callbacks
				ajaxZoom.divID, // target - container ID (default 'window' - fullscreen)
				true, // apiFullscreen- use browser fullscreen mode if available
				true, // disableEsc - prevent closing with Esc key
				false // postMode - use POST instead of GET
			);
		})(jQuery);
		</script>

		<div style="padding: 10px; background-color: #F2D3A2;">
			<p>The data for the above example with cropped thumbs gallery (product tour) 
				has been generated with <a href="example35.php">AJAX-ZOOM crop editor</a> (example35.php)
			</p>
			<p>If AJAX-ZOOM "responsive" parent container is resized with javascript by 
				e.g. click on a button (not browser resizing) which changes the size with css directly or adds a different CSS class to it,
				then you should call <code>jQuery.fn.axZm.resizeStart(3000);</code> when it starts resizing 
				and <code>jQuery.fn.axZm.resizeStart(1);</code> when it definitely ends. 
				No need to do this if your responsive layout is resized by window resize or orinetation change events, AJAX-ZOOM will do it instantly then.
			<p>
			<input type="button" class="btn btn-info" onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#playerWrap').stop(true, false).css('height', '400px'); setTimeout(function(){jQuery.fn.axZm.resizeStart(1)})" value="Resize to 400px height" style="width: 170px; text-align: left;">
			<input type="button" class="btn btn-info" onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#playerWrap').stop(true, false).animate({height: '500px', width: '40%'},{queue: false, easing: 'easeOutCirc', duration: 1500, complete: function(){jQuery.fn.axZm.resizeStart(1);}});" value="Resize with animation" style="width: 170px; text-align: left;">
			<input type="button" class="btn btn-info" onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#playerWrap').stop(true, false).css({height: '100%', width: ''}); setTimeout(function(){jQuery.fn.axZm.resizeStart(1)})" value="Restore" style="width: 170px; text-align: left;">
		</div>
		<div style="padding: 10px; background-color: #eee">
			<h3>JavaScript and CSS in head</h3>
			<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
			<?php
			echo '<pre style="display: none;"><code class="language-markup">';
			echo htmlspecialchars('
<!-- Include jQuery core into head section if not already present -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- Include axZm.thumbSlider -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<!-- Include jquery.axZm.imageCropLoad.js -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>

<!-- A small function to add title button which will expend to full description -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.expButton.css"></link>
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>
			');
			echo '</code></pre>';
			?>

			<h3>CSS</h3>
			<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
			<pre style="display: none;"><code class="language-css" id="exampleCssPrism"></code></pre>
			<script>
				// this is only for demo to show css code
				$('#exampleCssPrism').html($('#exampleCss').html());
			</script>
			<h3>HTML markup</h3>
			<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
			<?php
			echo '<pre style="display: none;"><code class="language-markup">';
			echo htmlspecialchars('
<!-- Responsive container using, padding bottom defines the aspect ratio 
	padding bottom could be refined with @media queries as an idea... -->
<div class="az_embed-responsive" id="playerOuterWrap">
	<div class="az_embed-responsive-item">
		<!-- playerWrap has padding to the right for the slider -->
		<div id="playerWrap">
			<!-- container where AJAX-ZOOM will be loaded into-->
			<div id="azParentContainer" style="">
				<!-- Content inside target will be removed -->
				<div style="padding: 20px">Loading, please wait...</div>
			</div>
			<!-- Thumb slider with croped images -->
			<div id="cropSliderWrap">
				<div id="cropSlider">
					<ul></ul>
				</div>
			</div>
		</div>
	</div>
</div>
			');
			echo '</code></pre>';
			?>
			<h3>Javascript</h3>
			<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle(); $(this).blur();">Show / Hide Code</a>
			<pre style="display: none;"><code class="language-js" id="exampleJsPrism"></code></pre>
			<script>
				// this is only for demo to show js code
				$('#exampleJsPrism').html($('#exampleJs').html());
			</script>
			<div style="margin-top: 40px;">
			<?php
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				// This is only for the demo, you can remove it
				define('COMMENTS_BOOTSTRAP', true);
				include dirname(__FILE__).'/footer.php';
			}
			?>
			</div>
		</div>
	</body>
</html>