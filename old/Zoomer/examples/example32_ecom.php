<!doctype html>
<html>
<head>
<title>32_ecom</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
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

<!-- Scripts for 360 crop gallery! Only needed if you use 360 "Product Tour" or some features for hotspots -->
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

<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, 
only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional -->
<link href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<!-- AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

<!-- Videojs if used... -->
<link href="//vjs.zencdn.net/5.11.9/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="//vjs.zencdn.net/5.11.9/video.js"></script>

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

	.axZm_mouseOverFlyOut {
		box-shadow: none;
		border-color: #EEE;
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

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">AJAX-ZOOM mouseover extension, product detail page fictive example</h1>
				<div style="margin-bottom: 50px;">
					<p>Besides the <a href="https://www.ajax-zoom.com/index.php?cid=modules">modules / plugins for diverse e-commerce systems</a> like Magento, for which 
						we already have an integration, you can implement this mouseover zoom extension into your system manually. 
						In the source code you will find all needed HTML and JavaScript to trigger AJAX-ZOOM mouseover extension 
						with default parameters and content data like 360 degree rotations, images and videos.
					</p>
					<p>The illustrative product data to the right (or bottom on mobile devices) imitates the product detail page commonly used in nearly all cart systems. 
						The working part is the <strong>product variation switch</strong> or color swatch, here labeled as "color variant". 
					</p>
				</div>
			</div>

			<div class="col-md-12">
				<h2 style="margin-bottom: 30px; font-variant: small-caps;">Product detail page title</h2>
			</div>

			<div class="col-md-7">
				<!-- AJAX-ZOOM mouseover block; does not need to be adjusted -->
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
				<!--// Mouseover block end -->

				<!-- Init AJAX-ZOOM mouseover extension -->
				<script type="text/javascript">
					jQuery.mouseOverZoomInit({
						axZmPath: "../axZm/", // Path to AJAX-ZOOM, e.g. /zoomTest/axZm/
						divID: "az_mouseOverZoomContainer", // DIV for mouseover zoom
						galleryDivID: "az_mouseOverZoomGallery", //"az_mouseOverZoomGallery", // DIV id of the gallery, set to false to disable gallery
						axZmMode: false,
						images: {
							1: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 1"},
							2: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "Test Title 2"},
							3: {img: "/pic/zoom/fashion/fashion_001.jpg", title: "Test Title 3"},
							4: {img: "/pic/zoom/fashion/fashion_002.jpg", title: "Test Title 4"},
							5: {img: "/pic/zoom/fashion/fashion_008.jpg", title: "Test Title 5"},
							6: {img: "/pic/zoom/fashion/fashion_010.jpg", title: "Test Title 6"}
						},

						galleryAxZmThumbSlider: true,
						thumbSliderPosition: "left-bottom",

						images360: { // path(s) to the folder with 360 images
							1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, title: "360 product view"}
						},

						videos: {
							1: {key: "YmcyTNWs9_Q", type: "youtube", position: "last", thumbImg: false, title: "Youtube video"}
						},

						heightRatio: 1.0,
						heightMaxWidthRatio: ["960|0.8", "700|0.7"],
						maxSizePrc: "1|-160",

						mouseOverZoomWidth: 1200,
						mouseOverZoomHeight: 1200,

						disableScrollAnm: false,

						ajaxZoomOpenMode: "fancyboxFullscreen",
						ajaxZoomOpenModeTouch: "fullscreen",

						fullScreenApi: false,
						prevNextArrows: true,

						// Mouse hover zoom parameters
						mouseOverZoomParam: {
							position: "right",
							zoomWidth: "#productDetailsCol|-15",
							zoomHeight: "#productDetailsCol",
							autoMargin: 10,
							adjustX: 20,
							adjustY: -1,
							showTitle: false,
							titlePosition: "top"
						}
					});
				</script>

				<!-- 
				!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				!!! In order to just init AJAX-ZOOM mouseover extension there is nothing else needed below. !!!
				!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				-->

			</div>

			<!-- 
			The ID (or other selector) of the right column can be passed to javascript 
			to detect the flyout window size. See "zoomWidth" and "zoomHeight" options of 
			the "mouseOverZoomParam" object above!
			-->
			<div class="col-md-5" id="productDetailsCol">
				<div class="row">
					<div class="col-lg-5">
						<h2 style="margin-top: 3px">
							<span style="color: #de3d2c">$495.90 *</span>
							<span style="color: #FFF; background-color: red; padding: 3px;">%</span>
						</h2>
					</div>
					<div class="col-lg-7">
						<h4 style="margin-top: 3px;">
							<span style="text-decoration: line-through;">$879.90</span>
							<span>(43.6% saved)</span>
						</h4>
					</div>
				</div>

				<h4 style="margin-top: 20px">Color variant</h4>
				<div class="clearfix" style="margin-bottom: 10px;">
					<a id="product_variation_1" style="display: inline-block; width: 40px; height: 40px; background-color: #F59B00; cursor: pointer; margin-right: 10px; border-radius: 6px;" 
						title="Orange: images, 360 and video"></a>
					<a id="product_variation_2" style="display: inline-block; width: 40px; height: 40px; background-color: #005AF5; cursor: pointer; margin-right: 10px; border-radius: 6px;" 
						title="Blue: only images"></a>
					<a id="product_variation_3" style="display: inline-block; width: 40px; height: 40px; background-color: green; cursor: pointer; margin-right: 10px; border-radius: 6px;" 
						title="Green: no data"></a>
					<a id="product_variation_4" style="display: inline-block; width: 40px; height: 40px; background-color: #ff0000; cursor: pointer; margin-right: 10px; border-radius: 6px;" 
						title="Red: only video"></a>
					<a id="product_variation_5" style="display: inline-block; width: 40px; height: 40px; background-color: #555; cursor: pointer; margin-right: 10px; border-radius: 6px;" 
						title="Gray: only 360"></a>
				</div>

				<script type="text/javascript">
					/* Switch images, 360 and videos depending on variation */
					jQuery('#product_variation_1').bind('click', function() {
						jQuery.mouseOverZoomInit.replaceImages({
							divID: 'az_mouseOverZoomContainer',
							images: {
								1: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 1"},
								2: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "Test Title 2"},
								3: {img: "/pic/zoom/fashion/fashion_001.jpg", title: "Test Title 3"},
								4: {img: "/pic/zoom/fashion/fashion_002.jpg", title: "Test Title 4"},
								5: {img: "/pic/zoom/fashion/fashion_008.jpg", title: "Test Title 5"},
								6: {img: "/pic/zoom/fashion/fashion_010.jpg", title: "Test Title 6"}
							},

							images360: { // path(s) to the folder with 360 images
								1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, title: "360 product view"}
							},

							videos: {
								1: {key: "YmcyTNWs9_Q", type: "youtube", position: "last", thumbImg: false, title: "youtube video"}
							}
						});
					});

					jQuery('#product_variation_2').bind('click', function() {
						jQuery.mouseOverZoomInit.replaceImages({
							divID: 'az_mouseOverZoomContainer',
							images360: {
								// no 360
							},
							images: {
								1: {img: "/pic/zoom/fashion/fashion_007.jpg", title: "Test Title 1"},
								2: {img: "/pic/zoom/fashion/fashion_004.jpg", title: "Test Title 2"},
								3: {img: "/pic/zoom/fashion/fashion_003.jpg", title: "Test Title 3"},
								4: {img: "/pic/zoom/fashion/fashion_005.jpg", title: "Test Title 4"}
							},
							videos: {
								// no videos
							}
						});
					});

					// No 360, no images
					jQuery('#product_variation_3').bind('click', function() {
						jQuery.mouseOverZoomInit.replaceImages({
							divID: 'az_mouseOverZoomContainer',
							images360: {
								// no 360
							},
							images: {
								// no images
							},
							videos: {
								// no videos
							}
						});
					});

					// No 360, no images
					jQuery('#product_variation_4').bind('click', function() {
						jQuery.mouseOverZoomInit.replaceImages({
							divID: 'az_mouseOverZoomContainer',
							images360: {
								// no 360
							},
							images: {
								// no images
							},
							videos: {
								1: {key: "YmcyTNWs9_Q", type: "youtube", position: "last", thumbImg: false, title: "youtube video"}
							}
						});
					});

					jQuery('#product_variation_5').bind('click', function() {
						jQuery.mouseOverZoomInit.replaceImages({
							divID: 'az_mouseOverZoomContainer',
							images: {
								// no images
							},

							images360: { // path(s) to the folder with 360 images
								1: {path: "/pic/zoom3d/Uvex_Occhiali", position: "first", spinReverse: false, spinDemoTime: 4500, title: "360 product view"}
							},

							videos: {
								// no videos
							}
						});
					});
				</script>

				<ul>
					<li>Availability: <span style="color: green; font-weight: bolder;">available</span></li>
					<li>Free of shipping costs!</li>
					<li>Prices incl. VAT</li>
					<li>Brand: Xanthippe</li>
				</ul>

				<div class="row">
					<div class="col-sm-4">
						<select class="btn-lg btn-block" style="margin-top: 5px; font-size: 20px; outline: none !important">
							<option>Amount</option>
							<option>1 piece</option>
							<option>2 pieces</option>
							<option>4 pieces</option>
							<option>5 pieces</option>
						</select>
					</div>
					<div class="col-sm-8">
						<a class="btn btn-info btn-block btn-lg" style="margin-top: 5px;" 
							onclick="alert('This is a placeholder button, not a real shop')">Add to shopping cart
						</a>
					</div>
				</div>

				<div style="text-align: right;">
					<h5>Order number: AZ10123</h5>
				</div>

				<hr>

				<!-- This is just for the demo -->
				<a class="btn btn-default btn-block" id="optToggleBtn" onclick="clearTimeout(window.afterLoadHide); jQuery('#optDemoDiv').slideToggle()">Few important extension options (demo) - show / hide</a>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						window.afterLoadHide = setTimeout(function(){document.getElementById('optToggleBtn').click();}, 3000);
						jQuery('input, select', jQuery('#optDemoDiv')).one('click', function(){clearTimeout(window.afterLoadHide);});
					});
				</script>

				<div id="optDemoDiv">
					<div style="margin-bottom: 5px">
						<div style="width: 150px; float: left;">Inner zoom:</div>
						<input type="radio" name="position" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'position', 'mouseOverZoomParam', undefined, true)" 
							autocomplete=off value="inside"> - enabled
						<input type="radio" name="position" style="margin-left: 5px;" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'position', 'mouseOverZoomParam', undefined, true)" 
							autocomplete=off value="right" checked> - disabled
						<div style="padding-left: 150px;"><code>"position": "inside" // or "right", ...</code></div>
					</div>
					<div style="margin-bottom: 5px">
						<div style="width: 150px; float: left;">AJAX-ZOOM mode:</div>
						<input type="radio" name="axZmMode" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'axZmMode', null, null, null, true);" 
							autocomplete=off value="true"> - enabled 
						<input type="radio" name="axZmMode" style="margin-left: 5px;" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'axZmMode', null, null, null, true);" 
							autocomplete=off value="false" checked> - disabled 
						<div style="padding-left: 150px;"><code>"axZmMode": true // or false</code></div>
					</div>
					<div style="margin-bottom: 5px">
						<div style="width: 150px; float: left;">Max zoom on click:</div>
						<input type="radio" name="maxZoomMode" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'maxZoomMode', null, null, null, true)" 
							autocomplete=off value="true"> - enabled 
						<input type="radio" name="maxZoomMode" style="margin-left: 5px;" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'maxZoomMode', null, null, null, true)" 
							autocomplete=off value="false" checked> - disabled 
						<div style="padding-left: 150px;"><code>"maxZoomMode": true // or false</code></div>
					</div>
					<div style="margin-bottom: 5px">
						<div style="width: 150px; float: left;">Gallery:</div>
						<input type="radio" name="galleryDivID" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'dotNavigation', null, 400); jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'galleryDivID', null, null, null, true)" 
							autocomplete=off value="az_mouseOverZoomGallery" checked> - enabled 
						<input type="radio" name="galleryDivID" style="margin-left: 5px;" 
							onclick="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'dotNavigation', null, 99999); jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'galleryDivID', null, null, null, true);" 
							autocomplete=off value="false"> - disabled 
							<div style="padding-left: 150px;"><code>"galleryDivID": "az_mouseOverZoomGallery" // or false</code></div>
					</div>
					<div style="margin-bottom: 5px">
						<div style="width: 150px; float: left;">Gallery position:</div>
						<select name="thumbSliderPosition" 
							onchange="jQuery.mouseOverZoomInit.setOpt('az_mouseOverZoomContainer', 'thumbSliderPosition', null, null, null, true)" 
							autocomplete=off>
							<option value="top">top</option>
							<option value="right">right</option>
							<option value="bottom">bottom</option>
							<option value="left">left</option>
							<option value="left-right">left-right</option>
							<option value="right-left">right-left</option>
							<option value="right-bottom">right-bottom</option>
							<option value="right-top">right-top</option>
							<option value="left-bottom" selected="selected">left-bottom</option>
							<option  value="left-top">left-top</option>
							<option value="bottom-top">bottom-top</option>
							<option value="top-bottom">top-bottom</option>
						</select>
						<div style="padding-left: 150px;"><code>"thumbSliderPosition": "left-bottom"</code></div>
					</div>

					<div class="alert alert-warning" style="margin-top: 15px;">
						For full list of options (documentation) and background information please see <a href="example32.php">example32.php</a>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<p style="margin-top: 70px; margin-bottom: 100px;">
					The mouseover extension has all needed API to cope with variants selection of any complexity. 
					In this demo we simply define ids for each variation ellement. In your application you should 
					look for events and JavaScript functions which are triggered when the select elements or elements, which represent the selections
					are changed and hook on these events to trigger the change for images, videos and 360 animations. 
					This has nothing todo with AJAX-ZOOM. It just offers the API to change the content with JavaScript, which should be 
					sufficient to implent it into your system and cope with the potential complexity of variations.
				</p>
			</div>
		</div>
	</div>

</body>
</html>