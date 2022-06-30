<!doctype html>
<html>
<head>
<title>32</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed in this example -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- jQuery core, needed if not already present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- Include mousewheel script, optional -->
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>

<!-- Include thumbSlider JS & CSS, optional -->
<link href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<!-- Preloading spinner, optional -->
<script type="text/javascript" src="../axZm/plugins/spin/spin.min.js"></script>

<!-- Scripts for 360 crop gallery! Only needed if you use 360 "Product Tour" or some features for hotspots  -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.expButton.css" type="text/css" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>

<!-- AJAX-ZOOM mouse over zoom extension version 5, needed! -->
<link href="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoom.5.css" type="text/css" rel="stylesheet" />

<!-- Comment out if pngMode is enabled -->
<!--
<link href="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoomPng.5.css" type="text/css" rel="stylesheet" />
-->

<script type="text/javascript" src="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoom.5.js"></script>
<script type="text/javascript" src="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoomInit.5.js"></script>

<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional-->
<link href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<!-- AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

<!-- Videojs if used... -->
<link href="//vjs.zencdn.net/5.11.9/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="//vjs.zencdn.net/5.11.9/video.js"></script>

<!-- IE < 9 @media query support, not needed -->
<script src="../axZm/plugins/css3-mediaqueries.min.js"></script>

<!-- Javascript to style the syntax, not needed! Disabled for IE less 9 -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script>if (document.addEventListener){document.write('<script src=\"../axZm/plugins/demo/prism/prism.min.js\"><\/script>');}</script>

<style type="text/css">
	/*********************************************************
		Responsive page layout used for this demo, not needed 
	**********************************************************/
	#responsiveContainer{padding: 10px; position: relative;}
	#topContainer {min-height: 110px; background-color: #B9CC52; position: relative;}
	#leftSide {width: 36%; background-color: #FFF; float: left; position: relative; z-index: 1; /* pos and zindex - fix for IE7*/}

	#middleSide {margin-left: 36%; margin-right: 500px; background-color: #FFF; min-height: 600px;}
	#middleSideInner {margin-left: 10px; background-color: #EEE; overflow: hidden;}
	#middleSideContent {padding: 10px 10px 30px 10px; position: relative;}

	#rightSide {width: 500px; position: absolute; right: 0px; top: 0; height: 100%;}
	#rightSideInner {background-color: #E66E55; position: absolute; top: 10px; right: 10px; bottom: 10px; left: 0px;}
	#rightSideContent {padding: 10px; color: #FFF;}
	#rightSideContent a {color: #FFF; font-weight: bold;}
	#rightSideContent a:hover {color: blue; font-weight: bold;}
	#rightSideContent h3 {margin: 0; padding-top: 10px; color: inherit;}
	#rightSideContent p {margin-top: 5px;}
	#colorOuter {padding: 10px; margin-top: 5px; clear: both; border: #AAA 1px solid;}
	#descrDiv {clear: both; padding: 10px; margin: 0 10px 0 10px; background-color: #777777; color: #FFF;}
	#descrDivLeft {float: left; width: 36%;}
	#descrDivLeft>div {padding-right: 10px;}
	#descrDivRight {margin-left: 36%;}
	#descrDivRight>div {padding-left: 10px;}
	#codeDiv {clear: both; padding: 10px; margin: 10px 10px 0 10px; background-color: #EEEEEE;}
	#depDiv {clear: both; padding: 10px; margin: 10px 10px 0 10px; background-color: #EEEEEE;}
	#docuDiv {clear: both; padding: 10px; margin: 10px 10px 0 10px; background-color: #FFF;}
	#commentDiv {clear: both; padding: 10px; margin: 10px 10px 10px 10px; background-color: #EEEEEE;}

	#colorSwatch td{width: 8%; font-size: 80%; padding: 3px; text-align: center;}

	.colorSwitchTest {display: inline-block; width: 40px; height: 40px; cursor: pointer; border: 2px solid #FFF; border-radius: 22px;}
	.colorSwitchTest:hover {border: 2px solid transparent;}
	#az_title_outside {height: 0px !important; width: 100%; overflow: visible; margin-top: 60px; position: relative; display: inline-block;}
	#az_title_outside .axZm_mouseOverTitle {width: 100%; position: absolute; bottom: 0;}
	#az_title_outside .axZm_mouseOverTitle_inner {width: 100%;}
	#az_title_outside .axZm_mouseOverTitle_text {color: #000; background-color: #F2D3A2; padding: 10px;}

	.cclearfix:after {content: "."; clear: both; display: block; visibility: hidden; height: 0px;}
	.table-borderless > tbody > tr > td,
	.table-borderless > tbody > tr > th,
	.table-borderless > tfoot > tr > td,
	.table-borderless > tfoot > tr > th,
	.table-borderless > thead > tr > td,
	.table-borderless > thead > tr > th {
		border: none;
		padding: 3px;
	}

	.ul2 {
		list-style-type: circle;
		margin: 0 0 15px 16px;
		padding: 0;
	}

	.ul2 li {
		margin: 0px 0px 7px 0px;
		padding: 0 0 0 15px;
	}
	/**********************************************************************
		media query to adjust the layout if it is lesser then 960px width
		responsive page layout used for this demo, not needed
	**********************************************************************/
	@media only screen and (min-width: 1921px) {
		#leftSide {}
		#middleSide {margin-right: 600px;}
		#rightSide {width: 600px;}
	}
	@media only screen and (max-width: 1600px) {
		#leftSide{width: 50%;}
		#middleSide{width: 50%; float: right; margin-left: 0; margin-right: 0; margin-bottom: 10px;}
		#rightSide {width: 100%; float: none; position: static; height: auto; overflow-x: hidden;}
		#rightSideInner {position: relative; top: 0; right: 0; bottom: 0; left: 0;}
		#rightSideContent {column-count: 2; column-gap: 20px;}
		#middleSideContent {padding: 10px 10px 10px 10px;}
		#descrDivLeft {width: 50%;}
		#descrDivLeft>div {padding-right: 10px;}
		#descrDivRight {margin-left: 50%;}
		#descrDivRight>div {padding-left: 10px;}
	}
	@media only screen and (max-width: 960px) {
		#responsiveContainer {padding: 0; overflow-x: hidden;}
		#az_mouseOverZoomContainer {border-width: 0px!important;}
		.axZm_mouseOverZoomContainerWrap {border-width: 0px!important;}

		#leftSide {width: 100%; float: none;}

		#middleSide {width: 100%; margin-left: 0; float: none; min-height: 100px; background-color: #F2D3A2; overflow-x: hidden;}
		#middleSideInner {margin-left: 0;}
		#middleSideContent {padding: 10px;}

		#rightSide {width: 100%; float: none; position: static; height: auto; overflow-x: hidden;}
		#rightSideInner {position: static;} 

		#descrDiv {margin: 0; overflow-x: visible;}
		#descrDivLeft {width: 100%; float: none;}
		#descrDivLeft>div {padding-right: 0; margin-bottom: 25px;}
		#descrDivRight {margin-left: 0;}
		#descrDivRight>div {padding-left: 0;}
		#codeDiv {margin: 0; overflow-x: hidden;}
		#depDiv {margin: 0; overflow-x: hidden;}
		#docuDiv {margin: 0; overflow-x: hidden;}
		#commentDiv {margin: 0; overflow-x: hidden;}
		#colorOuter {margin-top: 0; border-width: 0; background-color: #EEE;}
		#az_title_outside{margin-bottom: 0;}
		#az_title_outside .axZm_mouseOverTitle_inner {}
		#az_title_outside .axZm_mouseOverTitle_text {border: none; background-color: #AAA; color: #FFF; padding: 10px;}
	}
	@media only screen and (max-width: 768px) {
		#rightSideContent {column-count: 1;}
	}
</style>

</head>
<body>
<?php
// This include is just for the demo, you can remove it
if (file_exists(dirname(__FILE__).'/navi.php')) {
	include dirname(__FILE__).'/navi.php';
}
?>
<div id="topContainer">
	<h2 style="margin: 0; padding: 25px 10px 10px 10px;">Responsive AJAX-ZOOM Mousehover Zoom / Slider - jQuery Multimedia Extension Ver. 5 
		with <u>optional</u> 360° Spins, Multilevel 3D, Videos, Product Tour, Hotspots...
	</h2>
</div>

<div id="responsiveContainer">

	<div id="leftSide" class="images">
		<!-- AJAX-ZOOM mouseover block  -->
		<div class="axZm_mouseOverWithGalleryContainer">

			<!-- Parent container for offset to the left or right -->
			<div class="axZm_mouseOverZoomContainerWrap">

				<!-- Alternative container for title of the images -->
				<div class="axZm_mouseOverTitleParentAbove"></div>

				<!-- Container for mouse over image -->
				<div id="az_mouseOverZoomContainer" class="axZm_mouseOverZoomContainer">
					<!-- Optional CSS aspect ratio and message to preserve layout before JS is triggered -->
					<div class="axZm_mouseOverAspectRatio">
						<div>
							<span>Mouseover Zoom loading...</span>
						</div>
					</div>
				</div>
			</div>

			<!-- gallery with thumbs (will be filled with thumbs by javascript) -->
			<div id="az_mouseOverZoomGallery" class="axZm_mouseOverGallery"></div>
		</div>

		<div id="az_title_outside"></div>

		<!-- AJAX-ZOOM mouseover block END -->
		<div id="colorOuter">
			<h3 style="margin: 0; padding-top: 10px; margin-bottom: 10px; clear: both;">Load different images / 360° set and other API</h3>
			<table id="colorSwatch">
				<tr>
					<td><div id="color_1" class="colorSwitchTest" style="background-color: #D83E2D;"></div></td>
					<td><div id="color_2" class="colorSwitchTest" style="background-color: #33354E;"></div></td>
					<td><div id="color_3" class="colorSwitchTest" style="background-color: red;"></div></td>
					<td><div id="color_4" class="colorSwitchTest" style="background-color: yellow;"></div></td>
					<td><div id="color_5" class="colorSwitchTest" style="background-color: gray;"></div></td>
					<td><div id="color_6" class="colorSwitchTest" style="background-color: #D88448;"></div></td>
					<td><div id="color_7" class="colorSwitchTest" style="background-color: green;"></div></td>
					<td><div id="color_8" class="colorSwitchTest" style="background-color: blueviolet;"></div></td>
				</tr>
				<tr>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages1', true); jQuery('#color_1').trigger('click')">360 +<br>images</a></td>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages2', true); jQuery('#color_2').trigger('click')">only<br>images</a></td>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages3', true); jQuery('#color_3').trigger('click')">only one 360</a></td>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages4', true); jQuery('#color_4').trigger('click')">two 360<br>or more</a></td>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages5', true); jQuery('#color_5').trigger('click')">only one image</a></td>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages6', true); jQuery('#color_6').trigger('click')">one 360 with product tour</a></td>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages7', true); jQuery('#color_7').trigger('click')">no 360<br>no images</a></td>
					<td><a href="javascript: void(0)" onclick="replaceHeighlight('#replaceImages8', true); jQuery('#color_8').trigger('click')">only videos</a></td>
				</tr>
			</table>

			<script type="text/javascript" id="replaceImages1">
				// 360 + images
				jQuery('#color_1').bind('click', function(){
					jQuery.mouseOverZoomInit.replaceImages({
						divID: 'az_mouseOverZoomContainer',
						images: {
							1: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 1", hotspotFilePath: jsonDataImg}, // jsonDataImg is defined elsewhere
							2: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "Test Title 2"},
							3: {img: "/pic/zoom/fashion/fashion_001.jpg", title: "Test Title 3"},
							4: {img: "/pic/zoom/fashion/fashion_002.jpg", title: "Test Title 4"},
							5: {img: "/pic/zoom/fashion/fashion_008.jpg", title: "Test Title 5"},
							6: {img: "/pic/zoom/fashion/fashion_010.jpg", title: "Test Title 6"}
						},
						images360: { // path(s) to the folder with 360 images
							1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, crop: jsonData1}, // jsonData1 is defined elsewhere
							2: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500}
						}
					});
				});
			</script>

			<script type="text/javascript" id="replaceImages2">
				// Bind jQuery.mouseOverZoomInit.replaceImages to the element with ID #color_2
				// We only need the reference to "az_mouseOverZoomContainer" 
				// and define images obeject and or images360 object
				jQuery('#color_2').bind('click', function(){
					jQuery.mouseOverZoomInit('replaceImages', {
						divID: 'az_mouseOverZoomContainer',
						images360: {
							// You could put a different 360 in here
						},
						images: {
							1: {img: "/pic/zoom/fashion/fashion_001.jpg", title: "Test Title 1"},
							2: {img: "/pic/zoom/fashion/fashion_002.jpg", title: "Test Title 2"},
							3: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "Test Title 3"},
							4: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 4"},
							5: {img: "/pic/zoom/fashion/fashion_005.jpg", title: "Test Title 5"},
							6: {img: "/pic/zoom/fashion/fashion_006.jpg", title: "Test Title 6"}
						}
					});
				});
			</script>

			<script id="replaceImages3">
				// Only one 360
				jQuery('#color_3').bind('click', function(){
					jQuery.mouseOverZoomInit.replaceImages({
						divID: 'az_mouseOverZoomContainer',
						images360: { // path(s) to the folder with 360 images
							1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500}
						},
						images: {
							// no images
						}
					});
				});
			</script>

			<script type="text/javascript" id="replaceImages4">
				// Two 360 or more
				jQuery('#color_4').bind('click', function(){
					jQuery.mouseOverZoomInit.replaceImages({
						divID: 'az_mouseOverZoomContainer',
						images360Overlay: false,
						images360: {
							1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500},
							2: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, crop: jsonData1}  // jsonData1 is defined elsewhere
						},
						images: {
							// no images
						}
					});
				});
			</script>

			<script type="text/javascript" id="replaceImages5">
				// No 360, one image
				jQuery('#color_5').bind('click', function(){
					jQuery.mouseOverZoomInit.replaceImages({
						divID: 'az_mouseOverZoomContainer',
						images360: {
							// no 360
						},
						images: {
							1: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 4"}
						}
					});
				});
			</script>

			<script type="text/javascript" id="replaceImages6">
				// 360 with product tour, crop defined in jsonData1 - external js variable
				jQuery('#color_6').bind('click', function(){
					jQuery.mouseOverZoomInit.replaceImages({
						divID: 'az_mouseOverZoomContainer',
						images360: {
							1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, crop: jsonData1} 
						},
						images: {
							// no images
						}
					});
				});
			</script>

			<script type="text/javascript" id="replaceImages7">
				// No 360, no images
				jQuery('#color_7').bind('click', function(){
					jQuery.mouseOverZoomInit.replaceImages({
						divID: 'az_mouseOverZoomContainer',
						images360: {
							// no 360
						},
						images: {
							// no images
						}
					});
				});
			</script>

			<script type="text/javascript" id="replaceImages8">
				// Only video
				jQuery('#color_8').bind('click', function(){
					jQuery.mouseOverZoomInit.replaceImages({
						divID: 'az_mouseOverZoomContainer',
						images360: {
							// no 360
						},
						images: {
							// no images
						},
						videos: {
							1: {key: "YmcyTNWs9_Q", type: "youtube", position: "last", thumbImg: false, title: "youtube video"},
							2: {key: "171617419", type: "vimeo", position: "last", thumbImg: false, title: "vimeo video"},
							3: {key: "x37x496", type: "dailymotion", position: "last", thumbImg: false, title: "dailymotion video"},
							4: {key: "https://vjs.zencdn.net/v/oceans.mp4", type: "html5", position: "last", thumbImg: false, settings: {test: '{"a": "v"}'}, title: "Ground round andouille salami jerky meatloaf, kevin picanha chuck short ribs tri-tip. "}
						}
					});
				});
			</script>

			<script type="text/javascript">
				var replaceHeighlight = function(s, open){
					if (!window.Prism){return;}
					jQuery('#codeExample_replaceImages_parent div:eq(0)').remove();
					jQuery('#codeExample_replaceImages_parent').append('<pre id="codeExample_replaceImages"><code class="language-js"></code></pre>');
					jQuery('code', jQuery('#codeExample_replaceImages')).html(jQuery(s).html());
					Prism.highlightElement(jQuery('code', jQuery('#codeExample_replaceImages'))[0]);
					//SyntaxHighlighter.highlight();
					if (open){
						jQuery('#codeExample_replaceImages_parent').slideDown();
					}
				};
			</script>

			<div id="codeExample_replaceImages_parent" style="display: none; position: relative; top: 20px;">
				<a href="javascript: void(0)" onclick="jQuery('#codeExample_replaceImages_parent').slideToggle();" style="position: absolute; right: 1%; top: -20px">Close code</a>
			</div>

			<p>A common situation is that the images in mouseover zoom have to be changed, 
				e.g. depending on color / variants selection of an article. 
				With <code>jQuery.mouseOverZoomInit.replaceImages</code> you can easily change images and / or 360° / videos objects... 
				Click on the text links below the circles to see which code is executed when you click on them. 
				But of course if you use one of our e-commerce modules you do not have to care about this all. 
				This is just in case you want to integrate this AJAX-ZOOM extension somewhere manually.
			</p>

		</div>
	</div>

	<div id="middleSide">
		<div id="middleSideInner">
			<div id="middleSideContent">
				<h3 style="margin-top: 10px">Alternative AJAX-ZOOM (high resolution zoom view on click) opening methods and few other options</h3>
				<div>
					<table class="table table-borderless">
						<thead>
							<tr>
								<th colspan="2" style="text-align: left;"><span style="color: red">New:</span> "axZmMode" option</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="2">
									<input type="radio" name="axZmMode" 
										onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'axZmMode', null, null, null, true); jQuery('#openModeTable, #mouseOverSettingsTable').css('display', 'none');" 
										autocomplete=off value="true"> - enable 
									<input type="radio" name="axZmMode" 
										onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'axZmMode', null, null, null, true); jQuery('#openModeTable, #mouseOverSettingsTable').css('display', 'table');" 
										autocomplete=off value="false" checked> - disable
								</td>
							</tr>
							<tr>
								<td colspan="2" class="small">Enabling "axZmMode" option will let the mouseover extension act as most other AJAX-ZOOM examples: 
									the AJAX-ZOOM player is displayed directly inline. Users can zoom in with mouse wheel / pinch zoom without clicking on mouseover image. 
									Accordingly, the mouseover / preview images are not loading. 
									This option were added within this extension primary because of AJAX-ZOOM mouseover extension being already 
									implemented into several <a href="https://www.ajax-zoom.com/index.php?cid=modules" target="_blank">e-commerce plugins / modules</a> 
									and it is simply convenient if you want to display AZ like this.
								</td>
							</tr>
						</tbody>
					</table>

					<table class="table table-borderless">
						<thead>
							<tr>
								<th style="text-align: left;">Some other AJAX-ZOOM settings</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div style="width: 150px; float: left;">Enable monitor size fullscreen:</div>
									<input type="radio" name="fullScreenApi" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'fullScreenApi', null, null, null, true)" autocomplete=off value="true"> - enable 
									<input type="radio" name="fullScreenApi" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'fullScreenApi', null, null, null, true)" autocomplete=off value="false" checked> - disable
								</td>
							</tr>

							<tr>
								<td> 
									<div style="width: 150px; float: left;">Disable scroll animation:</div>
									<input type="radio" name="disableScrollAnm" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'disableScrollAnm', null, null, null, true)" autocomplete=off value="false" > - enable 
									<input type="radio" name="disableScrollAnm" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'disableScrollAnm', null, null, null, true)" autocomplete=off value="true" checked> - disable
								</td>
							</tr>

							<tr>
								<td> 
									<div style="width: 150px; float: left;">Max zoom on click:</div>
									<input type="radio" name="maxZoomMode" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'maxZoomMode', null, null, null, true)" autocomplete=off value="true" > - enable 
									<input type="radio" name="maxZoomMode" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'maxZoomMode', null, null, null, true)" autocomplete=off value="false" checked> - disable
								</td>
							</tr>

							<tr>
								<td> 
									<script>
									var changeAxZmSpinToZoomEffect = function(){
										var v = jQuery('#axZmSpinToZoomEffectSel').val();
										if (v == 'sel') {
											delete window.axZmSpinToZoomEffect;
										} else {
											window.axZmSpinToZoomEffect = v;
										}
									}
									</script>
									<div style="width: 150px; float: left;">SpinTo effect:</div>
									<select id="axZmSpinToZoomEffectSel" style="width: 165px" autocomplete="off" onchange="changeAxZmSpinToZoomEffect()">
										<option value="sel">Choose effect for 360 "Product tour"</option>
										<option value="0">0. Spin and zoom simultaneously</option>
										<option value="1">1. Zoom out and zoomin while spinning</option>
										<option value="2">2. Zoom out while spinning, then zoom in</option>
										<option value="3">3. Zoom out, then spin and zoom</option>
										<option value="4">4. Zoom out, spin, zoom in after spinning</option>
										<option value="5">5. Zoom out and zoomin while spinning with extra round</option>
										<option value="6">6. Zoom out 1/3 out, zoom in from 2/3 to 1 while spinning with extra round</option>
										<option value="7">7. Zoom out while spinning with extra round, zoom in after spinning</option>
										<option value="8">8. Zoom out, spin with extra round, zoom in after spinning</option>
										<option value="rand">9: Randomly from the above</option>
									</select>
									<div class="small" style="padding-left: 150px">For 360° / 3D "Product Tour" (on ajax-zoom.com click on the bag)</div>
								</td>
							</tr>
						</tbody>
					</table>

					<table class="table table-borderless" id="openModeTable">
						<thead>
							<tr>
								<th colspan="2" style="text-align: left;">This will change "ajaxZoomOpenMode" option when  "axZmMode" is not enabled</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td width="30"><input type="radio" name="ajaxZoomOpenMode" autocomplete=off onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'ajaxZoomOpenMode')"  value="fullscreen"></td>
								<td>Open AJAX-ZOOM at fullscreen mode</td>
							</tr>
							<tr>
								<td><input type="radio" name="ajaxZoomOpenMode" autocomplete=off onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'ajaxZoomOpenMode')" value="fancyboxFullscreen" checked></td>
								<td>Open AJAX-ZOOM in responsive "Fancybox"</td>
							</tr>
						</tbody>
					</table>

					<table class="table table-borderless" id="mouseOverSettingsTable">
						<thead>
							<tr>
								<th style="text-align: left;">Some mouseover settings</th>
							</tr>
						</thead>
						<tbody>
							<tr id="tintFilter_div">
								<td>
									<div style="width: 150px; float: left;">Tint filter:</div>
									<select name="tintFilter" onchange="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'tintFilter', 'mouseOverZoomParam', undefined, true)" autocomplete=off>
										<option value="false"> none </option>
										<option value="blur"> blur </option>
										<option value="grayscale"> grayscale </option>
										<option value="lighten"> lighten </option>
										<option value="darken"> darken </option>
										<option value="sepia"> sepia </option>
										<option value="invert"> invert </option>
										<option value="saturate"> saturate </option>
										<option value="custom"> custom </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> 
									<div style="width: 150px; float: left;">Mouseover Zoom:</div>
									<input type="radio" name="noMouseOverZoom" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'noMouseOverZoom', 'mouseOverZoomParam', undefined, true)" autocomplete=off value="false" checked> - enabled 
									<input type="radio" name="noMouseOverZoom" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'noMouseOverZoom', 'mouseOverZoomParam', undefined, true)" autocomplete=off value="true"> - disabled	                	 
								</td>
							</tr>
							<tr>
								<td> 
									<div style="width: 150px; float: left;">Inner Zoom:</div>
									<input type="radio" name="position" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'position', 'mouseOverZoomParam', undefined, true)" autocomplete=off value="inside"> - enabled 
									<input type="radio" name="position" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'position', 'mouseOverZoomParam', undefined, true)" autocomplete=off value="right" checked> - disabled	                	 
								</td>
							</tr>
							<tr>
								<td> 
									<div style="width: 150px; float: left;">Slider effect:</div>
									<select name="slideOutDest" onchange="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'slideOutDest', 'mouseOverZoomParam', undefined, true)" autocomplete=off>
										<option value="1"> 1 </option>
										<option value="2"> 2 </option>
										<option value="3"> 3 </option>
										<option value="4" selected="selected"> 4 </option>
									</select>
								</td>
							</tr>
							<tr>
								<td> 
									<div style="width: 150px; float: left;">Prev, next arrows:</div>
									<input type="radio" name="prevNextArrows" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'prevNextArrows'); jQuery('#az_mouseOverZoomContainer>.axZm_mouseOverPrevNextArrows').css('display', 'block');" autocomplete=off value="true" checked> - enabled 
									<input type="radio" name="prevNextArrows" onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'prevNextArrows'); jQuery('#az_mouseOverZoomContainer>.axZm_mouseOverPrevNextArrows').css('display', 'none');" autocomplete=off value="false"> - disabled	                	 
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="well well-sm">Many other configuration options are to find in the documentation below. 
					Within the e-commerce modules, all these options are adjustable in administrator / backend section.
				</div>

				<h3 style="clear: both; padding-top: 20px;">E-Commerce modules</h3>
				<div>The logotypes below are used for illustration purposes only. 
					AJAX-ZOOM is not affiliated or in partnership with any of the ecommerce software companies represented below. 
					The AJAX-ZOOM extensions / modules / plugins are not official extensions of these companies. 
				</div>

				<div class="aze_modules_6">
					<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=magento">
						<img border="0" src="https://www.ajax-zoom.com/pic/layout/logos/logo_magento_400.png">
					</a>
					<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=prestashop">
						<img border="0" src="https://www.ajax-zoom.com/pic/layout/logos/logo_prestashop_400.png">
					</a>
					<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=opencart">
						<img border="0" src="https://www.ajax-zoom.com/pic/layout/logos/logo_opencart_400.png">
					</a>
					<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=shopware">
						<img border="0" src="https://www.ajax-zoom.com/pic/layout/logos/logo_shopware_400.png">
					</a>
					<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=woocommerce">
						<img border="0" src="https://www.ajax-zoom.com/pic/layout/logos/logo_woocommerce_400.png">
					</a>
					<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=oxid">
						<img border="0" src="https://www.ajax-zoom.com/pic/layout/logos/logo_oxid_400.png">
					</a>
				</div>

				<p>Please be aware, that the e-commerce modules listed above <strong>are not needed</strong> to use this example.
					You can implement it manually, wherever.
				</p>

				<h3>Integrated 360° / 3D "Product Tour"</h3>
				<p>This interactive and at the same time guided 360° "Product Tour" is a very user friendly way to present highlights of any product.  
					Thanks to our <a href="example35.php">crop editor</a> such a product tour is very easy and fast to configure. 
					For a trained administrator the process will take less than a minute. Starting with "Prestashop" module, we will update all other ecommerce systems 
					with backend integration for optionally configuring such a product tour... (in case we do not have a module for your system be aware that  
					internally this crop editor can be put into "cms mode" and connected over a controller to any other system without modifications)
				</p>

				<h3>Integrated 360° / 3D "Hotspots" </h3>
				<p>With the help of our <a href="https://www.ajax-zoom.com/examples/example33.php" target="_blank">hotspot editor</a> 
					you can create multiple hotspots or rectangle image areas, setup several click / mouseover actions for them 
					e.g. links, tooltips, popup lightboxes or bind your own JavaScript functions 
					including AJAX-ZOOM API. The produced JSON type of result for the hotspot configuration can be passed to 
					this mouseover extension manually, however same as with the "Product Tour" the "Hotspot Editor" is 
					integrated into most AJAX-ZOOM ecommerce plugins so you do not have to take care about 
					transfering data anywere but get creative right away. 
				</p>

				<h3>Compatibility</h3>
				<div>
					<p>AJAX-ZOOM works in all modern browsers but is also able to work in legacy IE 7 and IE 8 for the most features.
						On mobile touch devices AJAX-ZOOM supports pinch-zoom, double tap and two finger pan.
						On Windows devices, which have a mouse control and touchscreen, AJAX-ZOOM works great as well.
					</p>
					<img width="32" height="32" src="../axZm/icons/browser_ie.png" alt="6.0+" title="6.0+" style="margin: 0 5px 5px 0">
					<img width="32" height="32" src="../axZm/icons/browser_firefox.png" alt="2.0+" title="2.0+" style="margin: 0 5px 5px 0">
					<img width="32" height="32" src="../axZm/icons/browser_safari.png" alt=">2.0+" title=">2.0+" style="margin: 0 5px 5px 0">
					<img width="32" height="32" src="../axZm/icons/browser_chrome.png" alt="1.0+" title="1.0+" style="margin: 0 5px 5px 0">
					<img width="32" height="32" src="../axZm/icons/browser_opera.png" alt="9.5+" title="9.5+" style="margin: 0 5px 5px 0">
					<img width="32" height="32" src="../axZm/icons/browser_android.png" alt="2.0+" title="2.0+" style="margin: 0 5px 5px 0">
					<img width="32" height="32" src="../axZm/icons/browser_ios.png" alt="4.0+" title="4.0+" style="margin: 0 5px 5px 0">
					<img width="32" height="32" src="../axZm/icons/browser_ipad.png" alt="Pinch zoom, tap zoom, swipe" style="margin: 0 5px 5px 0" title="Pinch zoom, tap zoom, swipe">
					<img width="32" height="32" src="../axZm/icons/browser_ie10.png" alt="Windows touchscreen - Chrome, IE, Edge - pinch zoom, tap zoom, swipe" style="margin: 0 5px 5px 0" title="Windows touchscreen - Chrome, IE, Edge - pinch zoom, tap zoom, swipe">
				</div>

				<h3>Features (short list)</h3>
				<!-- padding-left: 0; margin-top: 5px; list-style-position: inside; list-style-type: circle; -->
				<ul class="ul2">
					<li> Responsive mouseover area and flyout window with variable or fixed proportions, e.g. 1:1</li>
					<li> Adjustable for fixed or flexible image proportions</li>
					<li> Permanent or automatic inner zoom depending on resolution / layout</li>
					<li> Responsive modal or full screen views on click with AJAX-ZOOM</li>
					<li> Everything works great on touch devices including mouseover zoom if enabled</li>
					<li> Optional 360°/3D animations support with (pinch) zoom and full screen view</li>
					<li> Full multimedia gallery (images, 360°/3D, video) at full screen view</li>
					<li> Optional responsive thumbnail slider with instant orientation change if set accordingly</li>
					<li> Fast loading high resolution images, also for 360°/3D animations</li>
					<li> No need to pre-generate any thumbnails</li>
					<li> Integrated videos support - Youtube, Vimeo, HTML5</li>
					<li> Integrated 360°/3D "Product Tour" - very recommendable as it is easy and fast to make</li>
					<li> Integrated 360°/3D "Hotspots" support</li>
					<li> Integrated support for "Hotspots" on regular images in full screen / modal view</li>
					<li> 200+ other options</li>
					<li> Simple markup (does not need to be adjusted for gallery position any more) - easy integration</li>
					<li> Localizable</li>
					<li> All components mainly adjustable over one JavaScript (jQuery) "controller"</li>
					<li> API, callbacks / hooks for developers of all skill levels</li>
					<li> Perfect for product presentations and e-commerce</li>
					<li> Continuous development and improvements, technical support</li>
				</ul>
			</div>
		</div>
	</div>

	<div id="rightSide">
		<div id="rightSideInner">
			<div id="rightSideContent">
				<h3>About this fully responsive mousehover zoom</h3>
				<p>Prior to Ver. 4.0 of this AJAX-ZOOM mousehover zoom extension it was responsive for the flyout window only. 
					The actual "preview image" was not really responsive. In this new extension everything is absolutely responsive now. 
					A positive side effect caused by the added responsiveness is that a single image can be used as "preview image" - 
					the image which is hovered and the big "flyout image". But this is optional and not necessarily needed. 
				</p>
				<p>It has been tested in various Browsers including IE7. 
					Plays nicely with Bootstrap.  
					If you discover any bugs please do not hesitate to report. 
					We will fix them with highest priority. 
				</p>

				<h3>About 360°/3D rotate</h3>
				<p>The integrated 360°/3D object spin support is optional! 
					You do not need to have a 360° for every product. However you can put more than one 360° into the gallery. 
				</p>

				<h3>About 360°/3D hotspots</h3>
				<p>The extension supports passing hotspots to the player. 
					Hotspots can be made with <a href="https://www.ajax-zoom.com/examples/example33.php">example33.php</a>. 
					This hotspot editor is integrated directly into the backend of the most AJAX-ZOOM ecommerce plugins.
				</p>

				<h3>About 360° / 3D "Product Tour"</h3>
				<p>The extension supports passing JSON code produces by the special 
					<a href="https://www.ajax-zoom.com/examples/example35.php">editor</a>
					which is also integrated into backend of most AJAX-ZOOM ecommerce plugins. 
					The "Product Tour" can be combined with hotspots for the same 360. 
				</p>
			
				<h3>About Videos</h3>
				<p>Ver. 5 of this mouseover zoom extension supports videos as well. 
					Youtube, Vimeo and Dailymotion are lastly integrated over iframe. 
					HTML5 (mp4) videos over video tag with options "videojs" player support. 
					Great for SEO over videos. Vimeo can be used to stream mp4 as paid service.
				</p>

				<h3>About Touch Slide</h3>
				<p>In Ver. 4.1 of this extension there is a new feature for "touch slide" images 
					in order to switch between them. It can be enabled for all devices by setting 
					"noMouseOverZoom" || "noMouseOverZoomTouch" options to true. 
					Starting from Ver. 5 the new "mouseOverZoomHybrid" option together with 
					"noMouseOverZoomTouch" are enabled on default. Thus the user can slide the image with the mouse 
					and see mouseover effect as well at the same time. For touch devices / events mouseover 
					is disabled but could be enabled over options.
				</p>
				<p>Touch slide is also enabled for AJAX-ZOOM in fullscreen view or within responsive fancybox.
				</p>

 				<h3>About Gallery / Thumbnail Slider</h3>
				<p>
					The sliding thumbnail gallery below the mousehover image is optional. 
					It can be replaced or disabled so you have only thumbs floating somewhere else. 
					On default we use <a href="../axZm/extensions/axZmThumbSlider">jQuery.axZmThumbSlider</a> which is one of AJAX-ZOOM extensions. 
					It is highly configurable, skinable, responsive and touch friendly. 
					You can configure it to be displayed horizontally, vertically or even depending on screen resolution / other factors.
				</p>

				<h3>About Fancybox</h3>
				<p>The version packaged with AJAX-ZOOM is 1.3.4. 
					It was modified to work with AJAX-ZOOM. However everything will also 
					work with Fancybox 2.x which is available separately.
				</p>

				<h3>Is this free</h3>
				<p>In most cases, the answer is lastly nagative.</p>
			</div>
		</div>
	</div>
	
</div>

<div id="descrDiv" class="cclearfix">
	<div id="descrDivLeft">
		<div>
			<h3 style="padding-top: 0; color: #FFF;">About AJAX-ZOOM: what makes the difference exactly?</h3>
			<img src="https://www.ajax-zoom.com/pic/layout/tiles_pyramid_1.jpg" style="float: left; margin: 5px 15px 15px 0; max-width: 50%;">
			<p style="margin-top: 0">On default only the high resolution "master images" (source images) are needed to be defined  
				(see "images" object / array in the example code below). This "images" object is basically the only thing 
				which needs to be replaced / set dynamically by your application. 
			</p>
			<p>All thumbnails and flyout view images are instantly generated by AJAX-ZOOM "image server" 
				which is located at your place (server). The size of the flyout image can be set to e.g. 1200x1200px, 
				which are at most 1.44 Mio. pixels. For a 21 megapixels master image made by e.g. 
				Canon EOS 5D these are around 5-7% of the actual resolution and size. 
			</p>
			<p>Alternatively to AJAX-ZOOM PHP based "image server" the paths to these flyout "preview" images can be hardset 
				(see "images" option below) to point to some static (already scaled) images.
			</p>
			<p>By clicking on the lens your users can explore the details of the entire big image with AJAX-ZOOM, which 
				utilizes image tiles technology (simmilar to google maps where the view "gets sharp" when you zoom in), 
				so the big master image never loads into browsers cache;  
				it can be even protected from direct access over http e.g. with .htaccess - (simply put 
				.htaccess file with this code and nothing else into the top directory with your master images: <code>deny  from all</code>).
			</p>
			<p>Same as with thumbnails all image tiles can be generated instantly on-the-fly or pregenerated with AJAX-ZOOM special batch tool...
			</p>
		</div>
	</div>
	<div id="descrDivRight">
		<div>
			<h3 style="padding-top: 0; color: #FFF;">Details about responsiveness</h3>
			<p style="margin-top: 0">The width of the container in the left column of this responsive page layout 
				is set to 32% of the window width. Consequently the child elements in the 
				left column are 100% width and do change their width instantly depending on window width. 
				So does AJAX-ZOOM mouseover zoom extension.
			</p>
			<p> But what about the height of this mouseover zoom? 
				It can be set to a fixed pixel value; if your responsive layout takes into account the height it can 
				also be set to some variable value; but most likely you would just want to preserve a 
				certain proportion of the height depending on width. In this case just set the new 
				"heightRatio" option e.g. to 1.0 and the height of mouseover will be instantly adjusted making the 
				mouseover square. If your images are mostly portrait orientated (common for fashion retailers), then 
				you could set "heightRatio" value to e.g. 1.5; setting "heightRatio" to 'auto' will set the proportion 
				instantly to the proportion of the actual image. Be aware though that if proportion of the images 
				in the gallery is different the height will change on image switching, which might be unwanted behavior.
			</p>
			<p>Setting "heightRatio" option may result in that the height of the mouseover zoom is bigger than window height and the image is not fully visible. 
				To prevent this you can limit the calculated height with the "maxSizePrc" option. 
				The value of 1.0 would limit the height to 100% of window height; a value of 0.8 to 80% of window height; 
				you can also define two values, e.g. '1.0|-120' which would be window height minus 120px. 
			</p>
			<p>This responsive example page layout "collapses" the three column layout  
				when the width of the browser window is less than a certain amount of pixels. 
				This is done over CSS "media queries" and max-width condition which is common in modern templates, 
				e.g. <code>@media only screen and (max-width: 960px){...}</code>
				With the new options called "heightMaxWidthRatio" and "widthMaxHeightRatio" you can take account of these changes 
				and adjust e.g. "heightRatio" depending on max-width, e.g. <code>heightMaxWidthRatio: ["960|0.8", "700|0.7"]</code>. 
				The above basically means that below 960px of window width the "heightRatio" option turns into 0.8 and below 700px 
				"heightRatio" turns into 0.7;
			</p>
			<p>The "flyout" window with bigger image is set to cover the middle column div (the text over gray background) -  
				"zoomWidth" and "zoomHeight" options of "mouseOverZoomParam" are set to the selector '#middleSideContent' 
				which is simply the id of the middle column. In case the browsers window is less than 960px the design of this 
				example page changes in the way that the width of mouse over image is 100%; consequently there is no room 
				for the flyout window, so this mousehover changes the "position" option of "mouseOverZoomParam" from 'right' to 
				'inside' (inner zoom). 
			</p>
			<p>Notes: this responsive page layout is not well elaborated and is only meant to show how  
				the new responsiveness of AJAX-ZOOM mouseover zoom extension does work. Resize the browser window to see the effect.
			</p>
		</div>
	</div>
</div>

<div id="codeDiv">
	<h3 style="padding-top: 0; margin-bottom: 10px;">JavaScript & CSS files in Head</h3>
	Please note that depending on configuration not all of these js and css files are needed! See "Dependencies" below;<br><br>
	<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle()">Show / hide - JavaScript & CSS files in Head</a>
	<div style="clear: both; margin: 5px 0px 5px 0px; display: none;">
		<?php
		echo '<pre><code class="language-markup">';
		echo htmlspecialchars ('
<!-- jQuery core, needed if not already present! -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- Include mousewheel script, optional -->
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>

<!-- Include thumbSlider JS & CSS, optional -->
<link href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<!-- Preloading spinner, optional -->
<script type="text/javascript" src="../axZm/plugins/spin/spin.min.js"></script>

<!-- Scripts for 360 crop gallery! Only needed if you use 360 "Product Tour" -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.expButton.css" type="text/css" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>

<!-- AJAX-ZOOM mouse over zoom extension version 5, needed! -->
<link href="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoom.5.css" type="text/css" rel="stylesheet" />
<!-- Comment out if pngMode is enabled -->
<!--
<link href="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoomPng.5.css" type="text/css" rel="stylesheet" />
-->

<script type="text/javascript" src="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoom.5.js"></script>
<script type="text/javascript" src="../axZm/extensions/axZmMouseOverZoom/jquery.axZm.mouseOverZoomInit.5.js"></script>

<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen", optional... Fancybox 2 is also supported -->
<link href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<!-- AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

<!-- Videojs if used... -->
<link href="//vjs.zencdn.net/5.11.9/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="//vjs.zencdn.net/5.11.9/video.js"></script>

		');
		echo '</code></pre>';
		?>
	</div>

	<h3>HTML markup</h3>
	Please note that the HTML markup has been slightly changed in mousehover zoom extension version 5. 
	It will still work with old layout, however some new responsive features enabled on default will not work as expected 
	which might be indended if you e.g. want the gallery to be displayed completly somewhere else. 
	What you need anyway is the "container for mouse over image" with some unique ID and CSS class "axZm_mouseOverZoomContainer". 
	Also an container for gallery images with an unique ID with optional! CSS class "axZm_mouseOverGallery". 
	Depending on the gallery container having this CSS class named "axZm_mouseOverGallery" additional classes will be 
	added or not added to gallery container. These classes and CSS will be added depending on resolution of the screen and 
	options settings.<br><br>
	<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle()">Show / hide - HTML markup</a>
	<div style="clear: both; margin: 5px 0px 5px 0px; display: none;">
		<?php
		echo '<pre><code class="language-markup">';
		echo htmlspecialchars ('
<!-- AJAX-ZOOM mouseover block  -->
<div class="axZm_mouseOverWithGalleryContainer">

	<!-- Parent container for offset to the left or right -->
	<div class="axZm_mouseOverZoomContainerWrap">

		<!-- Container for mouse over image -->
		<div id="az_mouseOverZoomContainer" class="axZm_mouseOverZoomContainer">
			<!-- Optional CSS aspect ratio and message to preserve layout before JS is triggered -->
			<div class="axZm_mouseOverAspectRatio">
				<div><span>Mouseover Zoom loading...</span></div>
			</div>
		</div>
	</div>

	<!-- gallery with thumbs (will be filled with thumbs by javascript) -->
	<div id="az_mouseOverZoomGallery" class="axZm_mouseOverGallery"></div>

 </div>
		');
		echo '</code></pre>';
		?>
	</div>

	<h3>Javascript</h3>
	You do not need all the options below to be listed as most of them are set to their default values. <br><br>
	<a class="btn btn-default btn-sm btn-block" href="javascript: void(0)" onclick="jQuery(this).next().slideToggle()">Show / hide - Javascript</a>
	<div style="clear: both; margin: 5px 0px 5px 0px; display: none;">
		<pre><code id="codeExample"></code></pre>
	</div>

	<!-- Not needed -->
	<script type="text/javascript">
		jQuery(document).ready(function(){
			if (!window.Prism){return;}
 			jQuery('#codeExample').html(jQuery('#mouseOverZoomInit').html()).addClass("language-js");
			Prism.highlightElement(jQuery('#codeExample')[0]);
 		});
	</script>

</div>

<div id="docuDiv">

	<h3 style="margin-bottom: 10px;">Documentation Mouseover Extension Ver. 5</h3>

	<div style="margin-left: -10px; margin-right: -10px;">
	<?php 
		$docuclass_path = dirname(dirname(__FILE__)).'/axZm/classes/AzMouseoverSettings.php';
		if (file_exists($docuclass_path)) {
			include $docuclass_path;
			$AzMouseoverSettings = new AzMouseoverSettings();
			echo $AzMouseoverSettings->docuCss(array('tag' => true));
			echo $AzMouseoverSettings->getDocu(array('skip_cat' => array('plugin_settings')));
			echo '<div style="padding: 0 10px 5px 0; text-align: right;">Last updated: '.$AzMouseoverSettings->last_updated.'</div>';
			echo $AzMouseoverSettings->docuJS(array('tag' => true));
		} else {
			echo $docuclass_path.' <br> not found';
		}
	?>
	</div>
</div>

<div id="depDiv">
	<h3 style="padding-top: 0; margin-bottom: 10px;">Dependencies</h3>
	<p style="margin-top: 0;">	Several different plugins are used in this mouseover zoom tool. 
		Depending on the configuration not all of them are needed but they all  
		are included in the <a href="https://www.ajax-zoom.com/index.php?cid=download">download package</a>. 
		The options below refer to jQuery.mouseOverZoomInit(options) which acts like a proxy to the other plugins. 
	</p>

	Needed plugins:
	<ul>
		<li>jquery.axZm.mouseOverZoom.js - main mouseover zoom extension;
		</li>
		<li>jquery.axZm.mouseOverZoomInit.js - function to build all needed html and call other plugins which simplifies integration; 
		</li>
		<li>jquery.axZm.js - main AJAX-ZOOM javascript file which loads AJAX-ZOOM to display high resolution image when the user clicks on the lens; 
			depending on AJAX-ZOOM configuration AJAX-ZOOM loads some other stoff dynamically, so you do not have to worry about it.
		</li>
	</ul>

	Optional plugins to open AJAX-ZOOM:
	<ul>
		<li>jquery.fancybox-1.3.4.js and jquery.axZm.openAjaxZoomInFancyBox.js - are needed if "ajaxZoomOpenMode" option is set to 'fancyboxFullscreen'; 
			Fancybox version 2.x is supported too but since it is not MIT licensed any more, 
			Fancybox version 2 is not included into AJAX-ZOOM download package but it does not need any modifications. 
			The included version is 1.3.4 and it has been modified to work with AJAX-ZOOM properly. 
		</li>
	</ul>

	Optional plugins:
	<ul>
		<li>jquery.axZm.thumbSlider.js - needed if "galleryAxZmThumbSlider" option is set to true; 
			this is the replacement for previously used jcarousel (jQuery plugin for sliding thumbs which has got too old).
		</li>
		<li>spin.js - needed if "spinner" option is set to true.
		</li>
		<li>jquery.mousewheel.js - needed if in "galleryAxZmThumbSlider" option is set to true and in 
			"galleryAxZmThumbSliderParamVert" || "galleryAxZmThumbSliderParamHorz" the suboption "mouseWheelScrollBy" is used.
		</li>
		<li>jquery.axZm.imageCropLoad.js and jquery.axZm.expButton.js - needed if 360 "Product Tour" is used or some features for hotspots require it.
		</li>
	</ul>
</div>

<div id="commentDiv">
	<?php
	if (file_exists(dirname(__FILE__).'/footer.php')) {
		// This is only for the demo, you can remove it
		define('COMMENTS_BOOTSTRAP', true);
		include dirname(__FILE__).'/footer.php';
	}
	?>
</div>

<script type="text/javascript">
	var jsonData1 = [{"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_010.jpg&qual=90&width=180&height=180&cache=1&x1=659&y1=324&x2=924&y2=590","zoomID": 10,"imgName": "EOS_1100D_LOW_RES_18F_010.jpg","crop": [659, 324, 924, 590],"title": "SHOOTING","descr": "<p>Theme-based scene modes select a combination of aperture, shutter speed, ISO and focus mode that is appropriate for the subject being photographed. Choose from Portrait, Landscape, Close-up, Sports and Night Portrait, and let the EOS 1100D do the hard work for you.</p>\n\n<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Modes</th>\n\t\t<td>Auto, Portrait, Landscape, Close-up, Sports, Night Portrait, No Flash, Creative Auto, Program AE , Shutter priority AE, Aperture priority AE, Manual, A-DEP</td>\n\t</tr><tr>\n\t\t<th>Picture Styles</th>\n\t\t<td>Standard, Portrait, Landscape, Neutral, Faithful, Monochrome, User Defined (x3)</td>\n\t</tr><tr>\n\t\t<th>Colour Space</th>\n\t\t<td>sRGB and Adobe RGB</td>\n\t</tr><tr>\n\t\t<th>Image Processing</th>\n\t\t<td>Highlight Tone Priority<BR>Auto Lighting Optimizer (4 settings)<BR>Long exposure noise reduction<BR>High ISO speed noise reduction (4 settings)<BR>Auto Correction of Lens Peripheral illumination<BR>Basic+ (Shoot by ambience selection, Shoot by lighting or scene type)</td>\n\t</tr><tr>\n\t\t<th>Drive Modes</th>\n\t\t<td>Single, Continuous, Self timer (2s, 10s, 10s + continuous shots 2-10)</td>\n\t</tr><tr>\n\t\t<th>Continuous Shooting</th>\n\t\t<td>Max. JPEG Approx. 3fps for approx. 830 images¹³<BR>Max. RAW Approx  2fps for up to approx. 5 images</td>\t\n\t</tr>\n</table>\n\n<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\n</p>\n\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. \n</p>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_015.jpg&qual=90&width=180&height=180&cache=1&x1=1009&y1=298&x2=1423&y2=712","zoomID": 15,"imgName": "EOS_1100D_LOW_RES_18F_015.jpg","crop": [1009, 298, 1423, 712],"title": "VIEWFINDER","descr": "<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Type</th>\n\t\t<td>Pentamirror</td>\n\t</tr><tr>\n\t\t<th>Coverage (Vertical/Horizontal)</th>\n\t\t<td>Approx. 95%</td>\n\t</tr><tr>\n\t\t<th>Magnification</th>\n\t\t<td>Approx. 0.80x¹</td>\n\t</tr><tr>\n\t\t<th>Eyepoint</th>\n\t\t<td>Approx. 21mm (from eyepiece lens center)</td>\n\t</tr><tr>\n\t\t<th>Dioptre Correction</th>\n\t\t<td>-2.5 to +0.5 m-1 (dioptre)</td>\n\t</tr><tr>\n\t\t<th>Focusing Screen</th>\n\t\t<td>Fixed</td>\n\t</tr><tr>\n\t\t<th>Mirror</th>\n\t\t<td>Quick-return half mirror (Transmission: reflection ratio of 40:60, no mirror cut-off with EF600mm f/4 or shorter)</td>\n\t</tr><tr>\n\t\t<th>Viewfinder Information</th>\n\t\t<td>AF information: AF points, focus confirmation light<BR>Exposure information: Shutter speed, aperture value, ISO speed (always displayed), AE lock, exposure level/compensation, spot metering circle, exposure warning, AEB<BR>Flash information: Flash ready, high-speed sync, FE lock, flash exposure compensation, red-eye reduction light<BR>Image information: Highlight tone priority (D+), monochrome shooting, maximum burst (1 digit display), White balance correction, SD card information</td>\n\t</tr><tr>\n\t\t<th>Depth of Field Preview</th>\n\t\t<td>Yes, assigned to SET button with C.Fn-8-5</td>\n\t</tr><tr>\n\t\t<th>Eyepiece Shutter</th>\n\t\t<td>On strap</td>\t\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_004.jpg&qual=90&width=180&height=180&cache=1&x1=817&y1=47&x2=1231&y2=461","zoomID": 4,"imgName": "EOS_1100D_LOW_RES_18F_004.jpg","crop": [817, 47, 1231, 461],"title": "FLASH","descr": "<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Type</th>\n\t\t<td>TTL-CT-SIR with a CMOS sensor</td>\t\n\t</tr><tr>\n\t\t<th>AF System/ Points</th>\n\t\t<td>9 AF points (f/5.6 cross type at centre)</td>\t\n\t</tr><tr>\n\t\t<th >AF Working Range</th>\n\t\t<td>EV 0 - 18 (at 23°C & ISO100)</td>\t\n\t</tr><tr>\n\t\t<th >AF Modes</th>\n\t\t<td>AI Focus<BR>One Shot<BR>AI Servo </td>\t\n\t</tr><tr>\n\t\t<th>AF Point Selection</th>\n\t\t<td>Automatic selection, Manual selection</td>\t\n\t</tr><tr>\n\t\t<th>Selected AF Point Display</th>\n\t\t<td>Superimposed in viewfinder and indicated on LCD monitor</td>\t\n\t</tr><tr>\n\t\t<th>Predictive AF</th>\n\t\t<td>Yes, up to 10m</td>\n\t</tr><tr>\n\t\t<th>AF Lock </th>\n\t\t<td>Locked when shutter button is pressed half way in One Shot AF mode</td>\n\t</tr><tr>\n\t\t<th>AF Assist Beam</th>\n\t\t<td>Intermittent firing of built-in flash or emitted by optional dedicated Speedlite</td>\n\t</tr><tr>\n\t\t<th>Manual Focus</th>\n\t\t<td>Selected on lens, default in Live View Mode</td>\t\n\t</tr><tr>\n\t\t<th>AF Microadjustment</th>\n\t\t<td>No</td>\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_013.jpg&qual=90&width=180&height=180&cache=1&x1=793&y1=123&x2=1105&y2=435","zoomID": 13,"imgName": "EOS_1100D_LOW_RES_18F_013.jpg","crop": [793, 123, 1105, 435],"title": "FLASH SHOE","descr": "<p>When it comes to flash photography, the Canon Speedlite range of flashguns offers unparalleled access to creativity. \nUsed on-camera, their high power gives them more range than an EOS built-in flash, while their specification includes features such as bounce flash, for softer portrait lighting. It’s also possible to use a Canon Speedlite flash off-camera, triggering it wirelessly with the optional Speedlite ST-E2 infrared transmitter. Lighting a subject in this way lets a photographer control exactly where light is coming from and where shadows are falling.\n</p>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_014.jpg&qual=90&width=180&height=180&cache=1&x1=642&y1=566&x2=1213&y2=1138","zoomID": 14,"imgName": "EOS_1100D_LOW_RES_18F_014.jpg","crop": [642, 566, 1213, 1138],"title": "LCD MONITOR","descr": "<p>Intuitive handling, ergonomic design and an intelligent control layout make the EOS 1100D a DSLR you will want to take everywhere with you. The EOS 1100D’s Feature Guide provides descriptions of many of the camera’s functions, as well as advice on how to use them in your own photography.\n</p>\n\n<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Type</th>\n\t\t<td>6.8cm (2.7&#34;) TFT, approx. 230k dots</td>\n\t</tr><tr>\n\t\t<th>Coverage</th>\n\t\t<td>Approx. 100%</td>\n\t</tr><tr>\n\t\t<th>Viewing Angle (Horizontally/Vertically)</th>\n\t\t<td>Approx 170°</td>\n\t</tr><tr>\n\t\t<th>Brightness Adjustment</th>\n\t\t<td>Adjustable to one of seven levels</td>\n\t</tr><tr>\n\t\t<th>Display Options</th>\n\t\t<td>(1) Quick Control Screen<BR>(2) Camera settings</td>\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_004.jpg&qual=90&width=180&height=180&cache=1&x1=333&y1=379&x2=1161&y2=1208","zoomID": 4,"imgName": "EOS_1100D_LOW_RES_18F_004.jpg","crop": [333, 379, 1161, 1208],"title": "LENS / FOCUSING","descr": "<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr><th>Type</th>\n\t\t<td>TTL-CT-SIR with a CMOS sensor</td>\n\t</tr><tr>\n\t\t<th>AF System/ Points</th>\n\t\t<td>9 AF points (f/5.6 cross type at centre)</td>\n\t</tr><tr>\n\t\t<th>AF Working Range</th>\n\t\t<td>EV 0 - 18 (at 23°C & ISO100)</td>\n\t</tr><tr>\n\t\t<th>AF Modes</th>\n\t\t<td>AI Focus<br>One Shot<br>AI Servo </td>\n\t</tr><tr>\n\t\t<th>AF Point Selection</th>\n\t\t<td>Automatic selection, Manual selection</td>\t</tr>\n\t<tr><tr>\n\t\t<th>Selected AF Point Display</th>\n\t\t<td>Superimposed in viewfinder and indicated on LCD monitor</td>\n\t</tr><tr>\n\t\t<th>Predictive AF</th>\n\t\t<td>Yes, up to 10m¹</td>\n\t</tr><tr>\n\t\t<th>AF Lock </th>\n\t\t<td>Locked when shutter button is pressed half way in One Shot AF mode</td>\n\t</tr><tr>\n\t\t<th>AF Assist Beam</th>\n\t\t<td>Intermittent firing of built-in flash or emitted by optional dedicated Speedlite</td>\n\t</tr><tr>\n\t\t<th>Manual Focus</th>\n\t\t<td>Selected on lens, default in Live View Mode</td>\n\t</tr><tr>\n\t\t<th>AF Microadjustment</th>\n\t\t<td>No</td>\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_006.jpg&qual=90&width=180&height=180&cache=1&x1=327&y1=53&x2=1511&y2=1237","zoomID": 6,"imgName": "EOS_1100D_LOW_RES_18F_006.jpg","crop": [327, 53, 1511, 1237],"title": "MANUFACTURER IFRAME LINK","descr": "iframe:https://www.canon.co.uk/For_Home/Product_Finder/Cameras/Digital_SLR/EOS_1100D"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_004.jpg&qual=90&width=180&height=180&cache=1&x1=260&y1=0&x2=1660&y2=1400","zoomID": 4,"imgName": "EOS_1100D_LOW_RES_18F_004.jpg","crop": [260, 0, 1660, 1400],"descr": "iframe://www.youtube.com/embed/eLvvPr6WPdg?feature=player_detailpage"}];

	var jsonDataImg = {"testing":{"hotspotImage":"","hotspotImageOnHover":"","hotspotClass":"axZm_cssHotspot_green axZm_pulse","backColor":"","zIndex":"1","borderColor":"rgb(255, 0, 0)","borderRadius":"0","hotspotTextCss":{},"hotspotObjects":{},"altTitle":"","labelTitle":"click to test<br>hotspot","labelGravity":"bottomLeft","labelIndPar":{},"labelLine":1,"labelLineColor":"rgb(0, 0, 0)","draftPosLeft":"20","draftPosTop":"10","draftBorderColor":"","draftBackColor":"","draftFontColor":"","draftLine":"1","draftIndPos":{},"toolTipTitle":"","toolTipHtml":"","toolTipOverlayColor":"rgb(0, 0, 0)","expTitle":"","expHtml":"","perspective":{"keyFrame":false,"perspective":32,"tilt":0,"reverse":false},"position":{"fashion_004.jpg":{"left":"55.073242%","top":"42.027995%"}}}};
</script>

<!-- Init mouseover -->
<script type="text/javascript" id='mouseOverZoomInit'>
// or
// jQuery('#az_mouseOverZoomContainer').mouseOverZoomInit
// if you need it chainable
jQuery.mouseOverZoomInit({
	axZmPath: "../axZm/", // Path to AJAX-ZOOM, e.g. /zoomTest/axZm/
	divID: "az_mouseOverZoomContainer", // DIV for mouseover zoom
	galleryDivID: "az_mouseOverZoomGallery", // DIV id of the gallery, set to false to disable gallery
	images: {
		1: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 1", hotspotFilePath: jsonDataImg}, // jsonDataImg is defined elsewhere
		2: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "Test Title 2"},
		3: {img: "/pic/zoom/fashion/fashion_001.jpg", title: "Test Title 3"},
		4: {img: "/pic/zoom/fashion/fashion_002.jpg", title: "Test Title 4"},
		5: {img: "/pic/zoom/fashion/fashion_008.jpg", title: "Test Title 5"},
		6: {img: "/pic/zoom/fashion/fashion_010.jpg", title: "Test Title 6"}
	},

	images360: { // path(s) to the folder with 360 images
		1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, crop: jsonData1}, // jsonData1 is defined elsewhere
		2: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500}
	},

	videos: {
		1: {key: "YmcyTNWs9_Q", type: "youtube", position: "last", thumbImg: false, title: "youtube video"},
		2: {key: "171617419", type: "vimeo", position: "last", thumbImg: false, title: "vimeo video"},
		3: {key: "x37x496", type: "dailymotion", position: "last", thumbImg: false, title: "dailymotion video"},
		4: {key: "https://vjs.zencdn.net/v/oceans.mp4", type: "html5", position: "last", thumbImg: false, settings: {test: '{"a": "v"}'}, title: "Ground round andouille salami jerky meatloaf, kevin picanha chuck short ribs tri-tip. "}
	},

	images360firstToLoad: false, // Show 360 image first instead of plain image

	images360Thumb: true, // show first image of the spin as thumb

	cropAxZmThumbSliderParam: {},
	cropSliderPosition: 'bottom',

	galleryAxZmThumbSliderParamVert: {
		thumbLiStyle: {
			borderRadius: 3
		},
		btnClass: "axZmThumbSlider_button_new",
		btnHidden: true,
		btnOver: false
	},

	galleryAxZmThumbSliderParamHorz: {
		thumbLiStyle: {
			borderRadius: 3
		},
		btnClass: "axZmThumbSlider_button_new",
		btnHidden: true,
		btnOver: false
	},

	preloadMouseOverImages: 'oneByOne', // preload all preview and mouse over images, possible values: false, true, "oneByOne" 
	heightRatio: 1.0, // If "responsive" option is enabled, "heightRatio" with instantly adjust the height of mouseover container depending on width
	heightMaxWidthRatio:  ["960|0.8", "700|0.7"], // Set "heightRatio" depending on window width
	maxSizePrc: "1|-120", // If "responsive" option is enabled

	mouseOverZoomWidth: 1200, 
	mouseOverZoomHeight: 1200, 

	// If fancybox is used in "ajaxZoomOpenMode" option, below are some fancybox options
	fancyBoxParam: {
		boxMargin: 0,
		boxPadding: 0,
		boxCenterOnScroll: true
	},
	disableScrollAnm: true,
	fullScreenApi: false,
	prevNextArrows: true,
	prevNextArrowsTouch: true, 
	oneSrcImg: false,
	postMode: false,

	// Mouse hover zoom parameters
	mouseOverZoomParam: {
		position: "right",
		zoomWidth: "#middleSideContent", // width of the zoom window e.g. 530 or "auto" or jQuery selector|correction value, e.g. "#refWidthTest|+20"
		zoomHeight: "#leftSide", // height of the zoom window e.g. 375, or "auto"!
		autoMargin: 10, // if zoomWidth or zoomHeight are set to "auto", the margin to the edge of the screen
		adjustX: 10, // horizontal margin of the zoom window
		adjustY: -1,

		autoScroll: "200|-10", // scroll window vertically on thumb gallery click if image is not fully visible
		
		showTitle: true, // bool, enable / disable title on zoom window			
		titlePosition: "above", // position of the title: top or bottom or "above"
		titleParentContainer: '#az_title_outside', // 5.1.1 e.g. #az_title_outside
		titlePermanent: true
	}
});
</script>

</body>
</html>