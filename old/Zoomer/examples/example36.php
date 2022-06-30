<!DOCTYPE html>
<html>
<head>
	<title>36</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="robots" content="noindex,nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

	<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

	<!--  Include jQuery core into head section -->
	<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

	<!--  AJAX-ZOOM javascript && CSS -->
	<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

	<style type="text/css" media="screen"> 
		body>.zFsO>.axZm_zoomContainer{background-color: #FFF !important;}
		.colorWrap{width: 40px; height: 40px; position: relative; display: inline-block; margin: 0 10px 10px 0; cursor: pointer; overflow: hidden; border-radius: 50%; border: 2px #FFF solid;}
		.colorWrap:hover{border-color: #267CB8}
		.color1 {position: absolute; width: 50%; height: 100%;}
		.color2 {position: absolute; width: 50%; height: 100%; right: 0;}
		#resizeButtons > div > div{
			margin-bottom: 5px;
		}
		
		@media screen and (min-width: 768px) {
			#resizeButtons > div:nth-child(odd) {
				padding-right: 0;
			}
		}

		#naviToTheRight {
			overflow-x: hidden;
			position: absolute;
			z-index: 1;
			top: 0px; 
			right: 0px; 
			width: 50%; 
			max-width: 100%;
			background-color: #CECECE;
			height: 600px;
			max-height: calc(100vh - 60px);
		}

		#AZplayerParentContainer {
			position: relative;
			overflow: hidden;
			width: 50%;
			max-width: 100%;
			height: 600px;
			max-height: calc(100vh - 60px);
		}

		@media screen and (max-width: 1023px) {
			#AZplayerParentContainer {
				width: 100%;
				min-width: 100%;
				position: relative;
			}
			#naviToTheRight {
				position: relative;
				width: 100%;
				min-width: 100%;
				max-height: none;
			}
		}
	</style>

</head>
<body>
	<?php
	// This include is just for the demo, you should remove it
	include ('navi.php');
	?>

	<div style="position: relative; max-width: 1600px; overflow-x: hidden; margin: 0 auto;">
		<!-- Basically only an element with any certain ID is needed, we call it AZplayerParentContainer here -->
		<div id="AZplayerParentContainer"></div>

		<!-- We have made this right element with buttons absolute because while animating jQuery not always makes the best job when animating %, which might break the layout -->
		<div id="naviToTheRight" style="padding: 15px;">
			<div class="row">
				<div class="col-sm-12">
					<h2 style="margin-top: 0">360° / 3D product configurator basics</h2>
					<div>
						<h5><span style="color: red;">New</span>: 
							API $.fn.axZm.loadAjax360Type; injects new 360 of the same size keeping same zoom level and frame number. 
							Perfect for 360 product configurators.
						</h5>
						<div id="az_colorSwathes" class="clearfix">
							<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjax360Type('example=colorSwatch&3dDir=../pic/zoom3d/Uvex_Occhiali')">
								<div class="color1" style="background-color: black;"></div>
								<div class="color2" style="background-color: #583e31;"></div>
							</div>
							<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjax360Type('example=colorSwatch&3dDir=../pic/zoom3d/set_your_path_1')">
								<div class="color1" style="background-color: black;"></div>
								<div class="color2" style="background-color: silver;"></div>
							</div>
							<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjax360Type('example=colorSwatch&3dDir=../pic/zoom3d/set_your_path_2')">
								<div class="color1" style="background-color: #dcccbf;"></div>
								<div class="color2" style="background-color: #d2a679;"></div>
							</div>
							<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjax360Type('example=colorSwatch&3dDir=../pic/zoom3d/set_your_path_3')">
								<div class="color1" style="background-color: #ec7032;"></div>
								<div class="color2" style="background-color: #583e31;"></div> 
							</div>
						</div>
					</div>
					<div>
						<h5>Old / alternative: API $.fn.axZm.loadAjaxSet; loads / reloads new 360 
							into player independent of new 360 image size and number of frames.
						</h5>
						<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjaxSet('example=colorSwatch&3dDir=../pic/zoom3d/Uvex_Occhiali&zoomID='+jQuery.axZm.zoomID)">
							<div class="color1" style="background-color: black;"></div>
							<div class="color2" style="background-color: #583e31;"></div>
						</div>
						<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjaxSet('example=colorSwatch&3dDir=../pic/zoom3d/set_your_path_1&zoomID='+jQuery.axZm.zoomID)">
							<div class="color1" style="background-color: black;"></div>
							<div class="color2" style="background-color: silver;"></div>
						</div>
						<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjaxSet('example=colorSwatch&3dDir=../pic/zoom3d/set_your_path_2&zoomID='+jQuery.axZm.zoomID)">
							<div class="color1" style="background-color: #dcccbf;"></div>
							<div class="color2" style="background-color: #d2a679;"></div>
						</div>
						<div class="colorWrap" onclick="jQuery.fn.axZm.loadAjaxSet('example=colorSwatch&3dDir=../pic/zoom3d/set_your_path_3&zoomID='+jQuery.axZm.zoomID)">
							<div class="color1" style="background-color: #ec7032;"></div>
							<div class="color2" style="background-color: #583e31;"></div> 
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<h4>Some Javascript driven resizing examples without browser window being resized:</h4>
				</div>
				<div id="resizeButtons">
					<div class="col-sm-6">
						<div class="btn btn-default btn-block" 
							onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer').stop(true, false).css('width', '70%'); jQuery('#naviToTheRight').stop(true, false).css({width: '30%'}); setTimeout(function(){jQuery.fn.axZm.resizeStart(1)})">
							Resize to 70% width
						</div>
					</div>
					<div class="col-sm-6">
						<div class="btn btn-default btn-block" 
							onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer, #naviToTheRight').stop(true, false).css('height', '840px'); setTimeout(function(){jQuery.fn.axZm.resizeStart(1)})">
							Resize to 840px height
						</div>
					</div>
					<div class="col-sm-6">
						<div class="btn btn-default btn-block" 
							onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer').stop(true, false).animate({height: $(window).height() - $(':first-child', 'body').outerHeight(), width: '70%'},{queue: false, easing: 'easeOutCirc', duration: 1500, complete: function(){jQuery.fn.axZm.resizeStart(1);}}); jQuery('#naviToTheRight').stop(true, false).animate({height: $(window).height() - $(':first-child', 'body').outerHeight(), width: '30%'},{queue: false, easing: 'easeOutCirc', duration: 1500})">
							Resize with animation
						</div>
					</div>
					<div class="col-sm-6">
						<div class="btn btn-default btn-block" 
							onclick="jQuery.fn.axZm.resizeStart(3000); jQuery('#AZplayerParentContainer').stop(true, false).css({height: '600px', width: '50%'}); jQuery('#naviToTheRight').stop(true, false).css({height: '600px', width: '50%'}); jQuery.fn.axZm.resizeStart(1,  jQuery.fn.axZm.zoomReset);">
							Reset size and zoom
						</div>
					</div>
					<div class="col-sm-6">
						<!-- jQuery.fn.axZm.fillArea can be triggered in certain callbacks, same can be achieved with autoZoom option set in php config file -->
						<div class="btn btn-default btn-block" onclick="jQuery.fn.axZm.fillArea({ callback: function(){} });">
						API $.fn.axZm.fillArea
					</div>
					<div class="col-sm-6">
					</div>
				</div>
			</div>
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
				},

				onFullScreenStartFromRel: function(){
					// Optionally clone and put colorswatches over AJAX-ZOOM when it goes fullscreen
					var az_colorSwathesClone = $('#az_colorSwathes')
					.clone(true, true)
					.attr('id', 'az_colorSwathes_clone')
					.css({position: 'absolute', zIndex: 2, bottom: 10, left: '50%', padding: 0})
					.appendTo('#axZm_zoomLayer');

					az_colorSwathesClone.css({marginLeft: -(az_colorSwathesClone.outerWidth() / 2)})
				},

				onFullScreenCloseFromRel: function(){
					$('#az_colorSwathes_clone' ,'#axZm_zoomLayer').remove();
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

			// Documentation - https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
			jQuery.fn.axZm.openResponsive('../axZm/', 'example=colorSwatch&3dDir=../pic/zoom3d/Uvex_Occhiali', callbacks, 'AZplayerParentContainer', true, true, true);

			/*
			// load ajax-zoom not responsice
			jQuery.fn.axZm.load({
			opt: callbacks,
			path: '../axZm/',
			parameter: 'example=colorSwatch&3dDir=/pic/armchair/black',
			divID: 'AZplayerParentContainer'
			});
			*/
		});
	</script>
</body>
</html>