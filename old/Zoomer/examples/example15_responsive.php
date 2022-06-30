<!DOCTYPE html>
<html>
	<head>
		<title>15_responsive</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<style type="text/css">
			.switchNumber {
				width: 30px;
				height: 30px;
				line-height: 26px;
				cursor: pointer;
				border-radius: 50%;
				display: inline-block;
				margin: 0 5px 5px 0;
				text-align: center;
				font-size: 18px;
				background-color: #5bc0de;
				color: white;
				border: #FFF 2px solid;
			}
		</style>

		<!-- Include jQuery core into head section if not already present -->
		<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  AJAX-ZOOM javascript && CSS -->
		<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

	</head>
	<body>
		<?php
		// This include is just for the demo, you can remove it
		if (file_exists(dirname(__FILE__).'/navi.php')) {
			include dirname(__FILE__).'/navi.php';
		}
		?>
		<div style="min-height: 110px; background-color: #B9CC52">
			<h2 style="margin: 0; padding: 25px 10px 10px 10px;">AJAX-ZOOM 360/3D responsive example, no PHP code in this file. 
				Integration can be done on the template level.
			</h2>
		</div>

		<div style="position: relative;">
			<!-- Basically only an element with any certain ID is needed, we call it AZplayerParentContainer here -->
			<div id="AZplayerParentContainer" style="height: 400px; width: 80%; overflow: hidden; z-index: 1; position: relative;"></div>

			<!-- We have made this right element with buttons absolute because while animating jQuery not always makes the best job when animating %, which might break the layout -->
			<div id="naviToTheRight" style="height: 400px; position: absolute; z-index: 1; top: 0px; right: 0px; width: 20%; background-color: #CECECE; overflow: hidden;">
				<div style="padding: 10px">
				
					Some Javascript driven resizing examples without browser window being resized:<br><br>
					<input type="button" class="btn btn-default btn-sm btn-block" value="Resize to 50% width" onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer, #naviToTheRight').stop(true, false).css('width', '50%'); setTimeout(function(){jQuery.fn.axZm.resizeStart(1)}, 0); $(this).blur();">
					<input type="button" class="btn btn-default btn-sm btn-block" value="Resize to 500px height" onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer, #naviToTheRight').stop(true, false).css('height', '500px'); setTimeout(function(){jQuery.fn.axZm.resizeStart(1)}, 0); $(this).blur();">
					<input type="button" class="btn btn-default btn-sm btn-block" value="Resize with animation" onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer').stop(true, false).animate({height: '700px', width: '70%'},{queue: false, easing: 'easeOutCirc', duration: 1500, complete: function(){jQuery.fn.axZm.resizeStart(1);}}); jQuery('#naviToTheRight').stop(true, false).animate({height: '700px', width: '30%'},{queue: false, easing: 'easeOutCirc', duration: 1500}); $(this).blur();">

					<!-- jQuery.fn.axZm.fillArea can be triggered in certain callbacks, same can be achieved with autoZoom option set in php config file -->
					<input type="button" class="btn btn-default btn-sm btn-block" value="API $.fn.axZm.fillArea" onclick="jQuery.fn.axZm.fillArea({ callback: function(){} }); $(this).blur();">
					<input type="button" class="btn btn-default btn-sm btn-block" value="Reset size and zoom" onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer').stop(true, false).css({height: '400px', width: '80%'}); jQuery('#naviToTheRight').stop(true, false).css({height: '400px', width: '20%'}); jQuery.fn.axZm.resizeStart(1, jQuery.fn.axZm.zoomReset); $(this).blur();">
				</div>
			</div>
		</div>
		<div style="background-color: #F2D3A2;">
			<div style="padding: 10px">
				<h4>Switch to a different 360 with the API <a href="https://www.ajax-zoom.com/index.php?cid=docs#api_loadAjaxSet">jQuery.fn.axZm.loadAjaxSet</a> API</h4>
				<div class="switchNumber" onclick="jQuery.fn.axZm.loadAjaxSet('example=17&3dDir=/pic/zoom3d/Uvex_Occhiali')">1</div>
				<div class="switchNumber" onclick="jQuery.fn.axZm.loadAjaxSet('example=17&3dDir=/pic/zoom3d/Uvex_Occhiali')">2</div>
				<div class="switchNumber" onclick="jQuery.fn.axZm.loadAjaxSet('example=17&3dDir=/pic/zoom3d/Uvex_Occhiali')">3</div>
				<div class="switchNumber" onclick="jQuery.fn.axZm.loadAjaxSet('example=17&3dDir=/pic/zoom3d/Uvex_Occhiali')">4</div>
			</div>
			<div style="padding: 10px;">
				<h4>Resize with JS / CSS</h4>
				<p>If AJAX-ZOOM "responsive" parent container is resized with javascript by 
					e.g. click on a button (not browser resizing) which changes the size with css directly or adds a different CSS class to it,
					then you should call <code>jQuery.fn.axZm.resizeStart(3000);</code> when it starts resizing 
					and <code>jQuery.fn.axZm.resizeStart(1);</code> when it definitely ends. 
					No need to do this if your responsive layout is resized by window resize or orinetation change events, AJAX-ZOOM will do it instantly then.
				<p>
				<h4>UI buttons</h4>
				<p>Also please note that among many, many other settings and design restyles you can also 
					<input type="button" class="btn btn-info btn-sm" value="disable" onclick="jQuery.axZm.displayNavi=false; jQuery.axZm.fullScreenNaviBar = false; $('#axZm_zoomNavigation').css('display', 'none'); jQuery.fn.axZm.resizeStart(1);"> 
					this <a href="https://www.ajax-zoom.com/index.php?cid=docs#Zoom_Navigation" target="_blank">black tollbar</a> under the player and 
					<input type="button" class="btn btn-info btn-sm" value="enable" onclick="jQuery.fn.axZm.spinStop(); jQuery.fn.axZm.openFullScreen('../axZm/', 'example=spinIpad&3dDir=/pic/zoom3d/Uvex_Occhiali', {onBeforeStart: function(){jQuery.axZm.spinReverse = true; jQuery('.axZm_zoomContainer').css({backgroundColor: '#FFFFFF'})}}, 'AZplayerParentContainer', false, true);"> 
					a different one if you want. Please also take a look at 
					<a href="example33_responsive.php">example33_responsive.php</a> with hotspots 
					made with <a href="example33.php">hotspots configurator (example33.php)</a>.
				</p>
			</div>
		</div>

		<script type="text/javascript">
			// If you are triggering jQuery.fn.axZm.openFullScreen outside of jQuery(document).ready,
			// then make sure it done after your parent container, in this case "AZplayerParentContainer"
			jQuery(document).ready(function() {
				// Define some callbacks
				var callbacks = {
					onBeforeStart: function(){
						// Some of the options can be set directly as js var in this callback, e.g. 
						jQuery.axZm.spinReverse = true;
						// jQuery.axZm.spinReverseZ = true;
					},

					onLoad: function(){
						jQuery.axZm.fullScreenExitText = false;
					}
				}

				// Define your custom parameter query string
				// example=17 has many presets for 360 images*
				// 3dDir - best of all absolute path to the folder with 360/3D images

				// * By defining the query string parameter example=17 
				// some default settings from /axZm/zoomConfig.inc.php are overridden in 
				// /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 17){. 
				// So if changes in /axZm/zoomConfig.inc.php have no effect - 
				// look for the same options /axZm/zoomConfigCustom.inc.php; 
				// To quickly check a different set of options you can write example=spinIpad
				// which is already preset in /axZm/zoomConfigCustom.inc.php

				// Open AJAX-ZOOM responsive
				// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
				$.fn.axZm.openResponsive(
					'../axZm/', // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
					'example=17&3dDir=/pic/zoom3d/Uvex_Occhiali', // Defines which images and which options set to load
					{}, // callbacks
					'AZplayerParentContainer', // target - container ID (default 'window' - fullscreen)
					false, // apiFullscreen- use browser fullscreen mode if available
					true, // disableEsc - prevent closing with Esc key
					false // postMode - use POST instead of GET
				);
			});
		</script>
	</body>
</html>