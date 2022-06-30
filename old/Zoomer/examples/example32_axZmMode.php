<!doctype html>
<html>
<head>
<title>32_axZmMode</title>
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

<!-- Javascript to style the syntax, not needed! Disabled for IE less 9 -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script>if (document.addEventListener){document.write('<script src=\"../axZm/plugins/demo/prism/prism.min.js\"><\/script>');}</script>

<style type="text/css">
	html, body {
		margin: 0;
		padding: 0;
		width: 100%;
		height: 100%;
	}
	.axZm_mouseOverZoomContainerWrap {
		border-color: #EEE;
		border-width: 1px;
	}
	.axZm_mouseOverTitle_text {
		font-size: 16px;
	}
	#az_title_outside {
		margin-bottom: 20px;
		background-color: #EEE;
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

	<div class="container" style="max-width: 1170px !important;">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">Mouseover extension, "axZmMode" option test</h1>
				<div id="az_title_outside" class="clearfix"></div>

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

				<h3 style="margin-top: 30px">About</h3>
				<p>Enabling "axZmMode" option will let the mouseover extension act as most other AJAX-ZOOM examples: 
					the AJAX-ZOOM player is displayed directly inline. Users can zoom in with mouse wheel / pinch zoom without clicking on mouseover image. 
					Accordingly, the mouseover / preview images are not loading. 
					This option is added within this extension primary because AJAX-ZOOM mouseover extension is already 
					implemented into several <a href="https://www.ajax-zoom.com/index.php?cid=modules" target="_blank">e-commerce plugins / modules</a> 
					and it is simply convenient if you want to display AZ like this.
				</p>

				<h3 style="margin-bottom: 10px;">Documentation Mouseover Extension Ver. 5</h3>

				<div>
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
		</div>
	</div>

	<script type="text/javascript">
	var jsonData1 = [{"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_010.jpg&qual=90&width=180&height=180&cache=1&x1=659&y1=324&x2=924&y2=590","zoomID": 10,"imgName": "EOS_1100D_LOW_RES_18F_010.jpg","crop": [659, 324, 924, 590],"title": "SHOOTING","descr": "<p>Theme-based scene modes select a combination of aperture, shutter speed, ISO and focus mode that is appropriate for the subject being photographed. Choose from Portrait, Landscape, Close-up, Sports and Night Portrait, and let the EOS 1100D do the hard work for you.</p>\n\n<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Modes</th>\n\t\t<td>Auto, Portrait, Landscape, Close-up, Sports, Night Portrait, No Flash, Creative Auto, Program AE , Shutter priority AE, Aperture priority AE, Manual, A-DEP</td>\n\t</tr><tr>\n\t\t<th>Picture Styles</th>\n\t\t<td>Standard, Portrait, Landscape, Neutral, Faithful, Monochrome, User Defined (x3)</td>\n\t</tr><tr>\n\t\t<th>Colour Space</th>\n\t\t<td>sRGB and Adobe RGB</td>\n\t</tr><tr>\n\t\t<th>Image Processing</th>\n\t\t<td>Highlight Tone Priority<BR>Auto Lighting Optimizer (4 settings)<BR>Long exposure noise reduction<BR>High ISO speed noise reduction (4 settings)<BR>Auto Correction of Lens Peripheral illumination<BR>Basic+ (Shoot by ambience selection, Shoot by lighting or scene type)</td>\n\t</tr><tr>\n\t\t<th>Drive Modes</th>\n\t\t<td>Single, Continuous, Self timer (2s, 10s, 10s + continuous shots 2-10)</td>\n\t</tr><tr>\n\t\t<th>Continuous Shooting</th>\n\t\t<td>Max. JPEG Approx. 3fps for approx. 830 images¹³<BR>Max. RAW Approx  2fps for up to approx. 5 images</td>\t\n\t</tr>\n</table>\n\n<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\n</p>\n\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. \n</p>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_015.jpg&qual=90&width=180&height=180&cache=1&x1=1009&y1=298&x2=1423&y2=712","zoomID": 15,"imgName": "EOS_1100D_LOW_RES_18F_015.jpg","crop": [1009, 298, 1423, 712],"title": "VIEWFINDER","descr": "<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Type</th>\n\t\t<td>Pentamirror</td>\n\t</tr><tr>\n\t\t<th>Coverage (Vertical/Horizontal)</th>\n\t\t<td>Approx. 95%</td>\n\t</tr><tr>\n\t\t<th>Magnification</th>\n\t\t<td>Approx. 0.80x¹</td>\n\t</tr><tr>\n\t\t<th>Eyepoint</th>\n\t\t<td>Approx. 21mm (from eyepiece lens center)</td>\n\t</tr><tr>\n\t\t<th>Dioptre Correction</th>\n\t\t<td>-2.5 to +0.5 m-1 (dioptre)</td>\n\t</tr><tr>\n\t\t<th>Focusing Screen</th>\n\t\t<td>Fixed</td>\n\t</tr><tr>\n\t\t<th>Mirror</th>\n\t\t<td>Quick-return half mirror (Transmission: reflection ratio of 40:60, no mirror cut-off with EF600mm f/4 or shorter)</td>\n\t</tr><tr>\n\t\t<th>Viewfinder Information</th>\n\t\t<td>AF information: AF points, focus confirmation light<BR>Exposure information: Shutter speed, aperture value, ISO speed (always displayed), AE lock, exposure level/compensation, spot metering circle, exposure warning, AEB<BR>Flash information: Flash ready, high-speed sync, FE lock, flash exposure compensation, red-eye reduction light<BR>Image information: Highlight tone priority (D+), monochrome shooting, maximum burst (1 digit display), White balance correction, SD card information</td>\n\t</tr><tr>\n\t\t<th>Depth of Field Preview</th>\n\t\t<td>Yes, assigned to SET button with C.Fn-8-5</td>\n\t</tr><tr>\n\t\t<th>Eyepiece Shutter</th>\n\t\t<td>On strap</td>\t\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_004.jpg&qual=90&width=180&height=180&cache=1&x1=817&y1=47&x2=1231&y2=461","zoomID": 4,"imgName": "EOS_1100D_LOW_RES_18F_004.jpg","crop": [817, 47, 1231, 461],"title": "FLASH","descr": "<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Type</th>\n\t\t<td>TTL-CT-SIR with a CMOS sensor</td>\t\n\t</tr><tr>\n\t\t<th>AF System/ Points</th>\n\t\t<td>9 AF points (f/5.6 cross type at centre)</td>\t\n\t</tr><tr>\n\t\t<th >AF Working Range</th>\n\t\t<td>EV 0 - 18 (at 23°C & ISO100)</td>\t\n\t</tr><tr>\n\t\t<th >AF Modes</th>\n\t\t<td>AI Focus<BR>One Shot<BR>AI Servo </td>\t\n\t</tr><tr>\n\t\t<th>AF Point Selection</th>\n\t\t<td>Automatic selection, Manual selection</td>\t\n\t</tr><tr>\n\t\t<th>Selected AF Point Display</th>\n\t\t<td>Superimposed in viewfinder and indicated on LCD monitor</td>\t\n\t</tr><tr>\n\t\t<th>Predictive AF</th>\n\t\t<td>Yes, up to 10m</td>\n\t</tr><tr>\n\t\t<th>AF Lock </th>\n\t\t<td>Locked when shutter button is pressed half way in One Shot AF mode</td>\n\t</tr><tr>\n\t\t<th>AF Assist Beam</th>\n\t\t<td>Intermittent firing of built-in flash or emitted by optional dedicated Speedlite</td>\n\t</tr><tr>\n\t\t<th>Manual Focus</th>\n\t\t<td>Selected on lens, default in Live View Mode</td>\t\n\t</tr><tr>\n\t\t<th>AF Microadjustment</th>\n\t\t<td>No</td>\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_013.jpg&qual=90&width=180&height=180&cache=1&x1=793&y1=123&x2=1105&y2=435","zoomID": 13,"imgName": "EOS_1100D_LOW_RES_18F_013.jpg","crop": [793, 123, 1105, 435],"title": "FLASH SHOE","descr": "<p>When it comes to flash photography, the Canon Speedlite range of flashguns offers unparalleled access to creativity. \nUsed on-camera, their high power gives them more range than an EOS built-in flash, while their specification includes features such as bounce flash, for softer portrait lighting. It’s also possible to use a Canon Speedlite flash off-camera, triggering it wirelessly with the optional Speedlite ST-E2 infrared transmitter. Lighting a subject in this way lets a photographer control exactly where light is coming from and where shadows are falling.\n</p>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_014.jpg&qual=90&width=180&height=180&cache=1&x1=642&y1=566&x2=1213&y2=1138","zoomID": 14,"imgName": "EOS_1100D_LOW_RES_18F_014.jpg","crop": [642, 566, 1213, 1138],"title": "LCD MONITOR","descr": "<p>Intuitive handling, ergonomic design and an intelligent control layout make the EOS 1100D a DSLR you will want to take everywhere with you. The EOS 1100D’s Feature Guide provides descriptions of many of the camera’s functions, as well as advice on how to use them in your own photography.\n</p>\n\n<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr>\n\t\t<th>Type</th>\n\t\t<td>6.8cm (2.7&#34;) TFT, approx. 230k dots</td>\n\t</tr><tr>\n\t\t<th>Coverage</th>\n\t\t<td>Approx. 100%</td>\n\t</tr><tr>\n\t\t<th>Viewing Angle (Horizontally/Vertically)</th>\n\t\t<td>Approx 170°</td>\n\t</tr><tr>\n\t\t<th>Brightness Adjustment</th>\n\t\t<td>Adjustable to one of seven levels</td>\n\t</tr><tr>\n\t\t<th>Display Options</th>\n\t\t<td>(1) Quick Control Screen<BR>(2) Camera settings</td>\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_004.jpg&qual=90&width=180&height=180&cache=1&x1=333&y1=379&x2=1161&y2=1208","zoomID": 4,"imgName": "EOS_1100D_LOW_RES_18F_004.jpg","crop": [333, 379, 1161, 1208],"title": "LENS / FOCUSING","descr": "<table cellpadding=&#34;0&#34; cellspacing=&#34;0&#34; border=&#34;0&#34;>\n\t<tr><th>Type</th>\n\t\t<td>TTL-CT-SIR with a CMOS sensor</td>\n\t</tr><tr>\n\t\t<th>AF System/ Points</th>\n\t\t<td>9 AF points (f/5.6 cross type at centre)</td>\n\t</tr><tr>\n\t\t<th>AF Working Range</th>\n\t\t<td>EV 0 - 18 (at 23°C & ISO100)</td>\n\t</tr><tr>\n\t\t<th>AF Modes</th>\n\t\t<td>AI Focus<br>One Shot<br>AI Servo </td>\n\t</tr><tr>\n\t\t<th>AF Point Selection</th>\n\t\t<td>Automatic selection, Manual selection</td>\t</tr>\n\t<tr><tr>\n\t\t<th>Selected AF Point Display</th>\n\t\t<td>Superimposed in viewfinder and indicated on LCD monitor</td>\n\t</tr><tr>\n\t\t<th>Predictive AF</th>\n\t\t<td>Yes, up to 10m¹</td>\n\t</tr><tr>\n\t\t<th>AF Lock </th>\n\t\t<td>Locked when shutter button is pressed half way in One Shot AF mode</td>\n\t</tr><tr>\n\t\t<th>AF Assist Beam</th>\n\t\t<td>Intermittent firing of built-in flash or emitted by optional dedicated Speedlite</td>\n\t</tr><tr>\n\t\t<th>Manual Focus</th>\n\t\t<td>Selected on lens, default in Live View Mode</td>\n\t</tr><tr>\n\t\t<th>AF Microadjustment</th>\n\t\t<td>No</td>\n\t</tr>\n</table>"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_006.jpg&qual=90&width=180&height=180&cache=1&x1=327&y1=53&x2=1511&y2=1237","zoomID": 6,"imgName": "EOS_1100D_LOW_RES_18F_006.jpg","crop": [327, 53, 1511, 1237],"title": "MANUFACTURER IFRAME LINK","descr": "iframe:https://www.canon.co.uk/For_Home/Product_Finder/Cameras/Digital_SLR/EOS_1100D"}, {"qString": "previewDir=/pic/zoom3d/Uvex_Occhiali/&previewPic=EOS_1100D_LOW_RES_18F_004.jpg&qual=90&width=180&height=180&cache=1&x1=260&y1=0&x2=1660&y2=1400","zoomID": 4,"imgName": "EOS_1100D_LOW_RES_18F_004.jpg","crop": [260, 0, 1660, 1400],"descr": "iframe://www.youtube.com/embed/eLvvPr6WPdg?feature=player_detailpage"}];

	var jsonDataImg = {"testing":{"hotspotImage":"","hotspotImageOnHover":"","hotspotClass":"axZm_cssHotspot_green axZm_pulse","backColor":"","zIndex":"1","borderColor":"rgb(255, 0, 0)","borderRadius":"0","hotspotTextCss":{},"hotspotObjects":{},"altTitle":"","labelTitle":"click to test<br>hotspot","labelGravity":"bottomLeft","labelIndPar":{},"labelLine":1,"labelLineColor":"rgb(0, 0, 0)","draftPosLeft":"20","draftPosTop":"10","draftBorderColor":"","draftBackColor":"","draftFontColor":"","draftLine":"1","draftIndPos":{},"toolTipTitle":"","toolTipHtml":"","toolTipOverlayColor":"rgb(0, 0, 0)","expTitle":"","expHtml":"","perspective":{"keyFrame":false,"perspective":32,"tilt":0,"reverse":false},"position":{"fashion_004.jpg":{"left":"55.073242%","top":"42.027995%"}}}};
	</script>

	<!-- Init extension -->
	<script type="text/javascript" id='mouseOverZoomInit'>
	jQuery.mouseOverZoomInit({
		axZmPath: "../axZm/", // Path to AJAX-ZOOM, e.g. /zoomTest/axZm/
		divID: "az_mouseOverZoomContainer", // DIV for mouseover zoom
		galleryDivID: "az_mouseOverZoomGallery", // DIV id of the gallery, set to false to disable gallery
		axZmMode: true,
		maxZoomMode: false,
		images: {
			1: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 1", hotspotFilePath: jsonDataImg}, // jsonDataImg is defined elsewhere
			2: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "Test Title 2"},
			3: {img: "/pic/zoom/fashion/fashion_001.jpg", title: "Test Title 3"},
			4: {img: "/pic/zoom/fashion/fashion_002.jpg", title: "Test Title 4"},
			5: {img: "/pic/zoom/fashion/fashion_008.jpg", title: "Test Title 5"},
			6: {img: "/pic/zoom/fashion/fashion_010.jpg", title: "Test Title 6"}
		},

		images360: { // path(s) to the folder with 360 images
			1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, crop: jsonData1, title: "360 product tour"}, // jsonData1 is defined elsewhere
			2: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, title: "360 product view"}
		},

		videos: {
			1: {key: "YmcyTNWs9_Q", type: "youtube", position: "last", thumbImg: false, title: "youtube video"},
			2: {key: "171617419", type: "vimeo", position: "last", thumbImg: false, title: "vimeo video"},
			3: {key: "x37x496", type: "dailymotion", position: "last", thumbImg: false, title: "dailymotion video"},
			4: {key: "https://vjs.zencdn.net/v/oceans.mp4", type: "html5", position: "last", thumbImg: false, settings: {test: '{"a": "v"}'}, title: "mp4 video"}
		},

		images360firstToLoad: true, // Show 360 image first instead of plain image
		images360Thumb: true, // show first image of the spin as thumb
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
		thumbSliderPosition: 'right-bottom',
		heightRatio: 0.633, // If "responsive" option is enabled, "heightRatio" with instantly adjust the height of mouseover container depending on width
		maxSizePrc: "1|-120|-25", // If "responsive" option is enabled
		floorWidth: true,

		disableScrollAnm: true,
		fullScreenApi: false,
		prevNextArrows: true,
		prevNextArrowsTouch: true,

		mouseOverZoomParam: {
			showTitle: true, // bool, enable / disable title on zoom window			
			titlePosition: "above", // position of the title: top or bottom or "above"
			titleParentContainer: '#az_title_outside', // 5.1.1 e.g. #az_title_outside
			titlePermanent: true
		}
	});
	</script>

</body>
</html>