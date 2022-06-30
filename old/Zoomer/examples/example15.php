<!DOCTYPE html>
<html>
<head>
<title>15</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<script type="text/javascript">
	if (window.location !== window.top.location) {window.top.location = window.location;}
</script>
 
<!--  Include jQuery core into head section -->
<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!--  AJAX-ZOOM javascript -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link type="text/css" href="../axZm/axZm.css" rel="stylesheet" />

<!-- Include axZm.thumbSlider -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

<!-- JavaScript for 360/3D gallery -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.360Gallery.js"></script>
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.360Gallery.css" />

<!--  Syntaxhighlighter is not needed, you should remove this block along with SyntaxHighlighter.all(); below -->
<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script>if (document.addEventListener){document.write('<script src=\"../axZm/plugins/demo/prism/prism.min.js\"><\/script>');}</script>

<style type="text/css">
	#axZm_zoomLogHolder {
		max-width: 70px !important;
	}
	#axZm_zoomLevel {
		font-size: 22px !important;
		color: #999 !important;
	}
</style>
</head>
<body>

<?php
// This include is just for the demo, you can remove it
include 'navi.php';
?>

<div class="container">
	<h1 class="page-header">AJAX-ZOOM - 360°/3D Spin & Zoom JavaScript player - "Responsive Ready!"</h1>

	<div class="row">
		<div class="col-md-8">
			<div class="embed-responsive" style="padding-bottom: 69%;">
				<!-- Placeholder for AJAX-ZOOM player -->
				<div id="axZmPlayerContainer" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
					Loading, please wait...
				</div>
			</div>
			<div class="aze_notice" style="border-top: 1px solid #eee; margin-top: 10px;">
				Notice: the actually not needed toolbar above can be replaced with an over canvas one, reskinned, extended, reduced or completely removed.
				Do not pay attention to the design or control elements. Everything is adjustable via 400+ configuration parameters, css and API.
			</div>

			<h3 class="page-header">360° object photography examples</h3>

			<!-- Slider with 360 objects (optionally). You can put it somewhere else, e.g. under the player, besides the player or whereever -->
			<div id="spinGalleryContainer" style="min-height: 80px; position: relative">
				<div id="spinGallery" style="min-height: 80px; width: 100%; position: releative">
					<!-- Temp message that will be removed after the slider initialization -->
					<div id="spinGallery_temp" class="spinGallery_temp" style="margin-top: 0;">
						Gallery with 360° objects will be loaded after the first spin is fully loaded, please wait...
					</div>
				</div>
			</div>

			<h3>Modules / Extensions</h3>
			<a href="https://www.ajax-zoom.com/index.php?cid=modules">"Modules / plugins or extensions"</a> 
			are not needed to use AJAX-ZOOM 360°. 
			However they will facilitate the integration into various established CMS or e-commerce systems like 
			<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=magento">Magento</a>, 
			<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=prestashop">Prestashop</a>,
			<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=opencart">Opencart</a>, 
			<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=woocommerce">WooCommerce</a> (WordPress), 
			<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=shopware">Shopware</a> or 
			<a href="https://www.ajax-zoom.com/index.php?cid=modules&module=oxid">OXID</a>.  
			Recently we have started to develop and already published some of the modules. 
			More information about modules can be found <a href="https://www.ajax-zoom.com/index.php?cid=modules">here</a>.

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

			<h3>Hand picked AJAX-ZOOM 360° example highlights</h3>
			<div class="aze_example_boxes">
				<!-- example32 -->
				<div class="aze_example_box clearfix">
					<a href="example32.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_32.jpg" alt="Mouseover zoom + 360 + responsive" title="Mouseover zoom + 360 + responsive"></a>
					Fully responsive mouseover zoom with integrated 360°/3D support is a perfect all-in-one solution for e-commerce.
					Most our e-commerce plugins are based on this example. It does also support 360° "Product Tour" out of the box and 
					the <a href="/examples/example35.php">360° "Product Tour" editor</a> is directly integrated into the backend of the e-commerce modules. 
					Videos are also supported.
				</div>

				<!-- example35 -->
				<div class="aze_example_box clearfix">
					<a href="example35.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_35.jpg" alt="Crop editor" title="Crop editor"></a>
					Fully configurable "cropped thumbs gallery" / "product tour" with "spinTo" and "zoomTo" is definitely must-see! 
					It is integrated into all AJAX-ZOOM e-commerce modules.
					<br />
					<a class="aze_example_box_sub_image" href="example35_clean.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_35_clean.jpg" alt="Clean example" title="Clean example"></a>
					<a class="aze_example_box_sub_image" href="example35_clean_horizontal.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_35_clean_horizontal.jpg" alt="Horizontal slider" title="Horizontal slider"></a>
					<a class="aze_example_box_sub_image" href="example35_responsive.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_35_responsive.jpg" alt="Resopnsive" title="Resopnsive"></a>
					<a class="aze_example_box_sub_image" href="example35_gallery.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_35_gallery.jpg" alt="Free layout" title="Free layout"></a>
				</div>

				<!-- example29 -->
				<div class="aze_example_box clearfix">
					<a href="example29.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_29.jpg"></a>
					Show 360°/3D spins together with normal images, videos + documents as in "one player"<br />
					<a class="aze_example_box_sub_image" href="example29_clean.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_29_clean.jpg"  alt="Clean example" title="Clean example"></a>
					<a class="aze_example_box_sub_image" href="example29_responsive.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_29_responsive.jpg"  alt="Resopnsive" title="Resopnsive"></a>
					<a class="aze_example_box_sub_image" href="example29_responsive_easy.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_29_responsive_easy.jpg" 
						alt="Another responsive example of AJAX-ZOOM where settings are set the way that the user has only the possibility to spin at not zoomed state" 
						title="Another responsive example of AJAX-ZOOM where settings are set the way that the user has only the possibility to spin at not zoomed state"></a>
				</div>

				<!-- example33 -->
				<div class="aze_example_box clearfix">
					<a href="example33.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_33.jpg" alt="Hotspot configurator" title="Hotspot configurator"></a>
					Also check out the clickable and fully configurable <a href="example33.php">HOTSPOTS</a> configurator with really tons of interesting features! 
					It is integrated into all AJAX-ZOOM e-commerce modules.
					<br>
					<a class="aze_example_box_sub_image" href="example33_clean.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_33_clean.jpg" alt="Clean example" title="Clean example"></a>
					<a class="aze_example_box_sub_image" href="example33_responsive.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_33_responsive.jpg" alt="Resopnsive" title="Resopnsive"></a>
					<a class="aze_example_box_sub_image" href="example33_fullscreen.php"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_33_fullscreen.jpg" alt="Fullscreen" title="Fullscreen"></a>
				</div>

				<!-- example36 -->
				<div class="aze_example_box clearfix">
					<a href="example36.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_36.jpg" alt="Product configuration" title="Product configuration"></a>
					Switch between 360 / 3D at any state, also zoomed and fullscreen view. Perfect for product configuration tools. 
					Extendable to use with hotspots or <a href="example35.php">spinTo && zoomTo</a> product tours.<br>
				</div>
			</div>

			<h3>Derived / "clean" examples of example15.php</h3>
			<div class="aze_example_boxes">
				<div class="aze_example_box clearfix">
					<a href="example15_clean.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_15_clean.jpg"></a>
					For a clean example <b>without "360°/3D gallery"</b> and anything else please see here:<br>
					<a href="example15_clean.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example15_clean.php</a><br>
					(no PHP code required at the frontend!)
				</div>

				<div class="aze_example_box clearfix">
					<a href="example15_responsive.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_15_responsive.jpg"></a>
					To start AJAX-ZOOM <b>360°/3D in responsive / adaptive layout</b>, see <br>
					<a href="example15_responsive.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example15_responsive.php</a>
				</div>

				<div class="aze_example_box clearfix">
					<a href="example15_fullscreen.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_15_fullscreen.jpg"></a>
					To start AJAX-ZOOM <b>360°/3D in fullscreen mode</b>, see <br>
					<a href="example15_fullscreen.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example15_fullscreen.php</a>
				</div>

				<div class="aze_example_box clearfix">
					<a href='example15_gallery_clean.php' class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_15_gallery_clean.jpg"></a>
					For a clean example <b>with "360°/3D gallery"</b> and anything else please see here:<br>
					<a href='example15_gallery_clean.php' class="aze_word_break">https://www.ajax-zoom.com/examples/example15_gallery_clean.php</a><br>
					No PHP code required at the frontend. 
					The PHP code inside the file can be extracted into a different file and called over AJAX, 
					please see comments at the biginning of this PHP file.
				</div>
			</div>

			<h3>Some other implementations & examples of 360 spin tool</h3>
			<div class="aze_example_boxes">
				<div class="aze_example_box clearfix">
					<a href="example24.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_24.jpg"></a>
					To implement AJAX-ZOOM <b>360/3D in responsive / adaptive layout with or without gallery</b>, see<br>
					<a href="example24.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example24.php</a>
				</div>

				<div class="aze_example_box clearfix">
					<a href="example3.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_3.jpg"></a>
					To load AJAX-ZOOM <b>360/3D in a lightbox e.g. Fancybox</b>, see <br>
					<a href="example3.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example3.php</a>
				</div>

				<div class="aze_example_box clearfix">
					<a href="example27.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_27.jpg"></a>
					To load AJAX-ZOOM <b>360/3D in a responsive / adaptive lightbox</b>, see 
					<a href="example27.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example27.php</a> 
				</div>

				<div class="aze_example_box clearfix">
					<a href="example28.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_28.jpg"></a>
					Here you will find a <b>3D - multirow spin, rotate & zoom</b> example:<br>
					<a href="example28.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example28.php</a><br> 
					It is not included in the download package, but 
					the only difference between regular 360 spin and multirow is that original images are placed in subfolders of the target folder 
					(the one you will be pointing AJAX-ZOOM at). You do not need to define these subfolders anywhere separately. 
					AJAX-ZOOM will instantly detect and procede all the images in them.
				</div>
				<div class="aze_example_box clearfix">
					<a href="https://www.ajax-zoom.com/examples/example15_vr9.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_15_vr9.jpg"></a>
					Here is a truly VR spherical example with 9 rows and 90 images per row = 810 images 
					<a href="https://www.ajax-zoom.com/examples/example15_vr9.php" class="aze_word_break">https://www.ajax-zoom.com/examples/example15_vr9.php</a>
				</div>
			</div>
			
			<a class="btn btn-info btn-block" href="https://www.ajax-zoom.com/index.php?kw=3d_object&lang=en">All examples tagged with 360/3D</a>
		</div>
		
		<div class="col-md-4">
			<h3 style="margin-top: 0;">General information - non technical</h3>
			<p class="text-justify">AJAX-ZOOM is a unique "Flash" free tool to present 360°/ 3D product images on the web. 
				Users can rotate 360° object (the sprite contains a set of single images), 
				also on Z-axis (3D multirow) and additionally deep zoom on every frame. 
				The adoption of image tiles technology (image pyramid) allows utilizing high resolution images without 
				compression rates which would destroy the image quality.
			</p>

			<p class="text-justify">AJAX-ZOOM has full support for touch devices, e.g. pinch zoom with two fingers and works great on iPad. 
				In the full screen or responsive modes AJAX-ZOOM loads as many image tiles as needed to fit users screen resolution and 
				thus provides best details quality quickly also with low bandwidth connectivity, which is perfect for mobile implementations.
				AJAX-ZOOM player can be completely restyled (skinned) to fit any design / corporate identity. 
			</p>

			<h3>Some external controls and functionality over AJAX-ZOOM API</h3>
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.zoomIn({ajxTo: 750})">zoomIn</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.zoomOut({ajxTo: 750})">zoomOut</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.zoomReset()">reset</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.switchPan()">switch pan</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.switchSpin()">switch spin</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.switchCrop()">switch crop</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.spinStart(999)">start spin</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.spinStop()">stop spin</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.spinPlayToggle(999)">spin toggle</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.spinBy(1)">spinBy (1)</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.spinBy(-1)">spinBy (-1)</a> 
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" 
				onclick="jQuery.fn.axZm.spinTo(1, false, false, false, {'x1': ($.axZm.ow/2), 'y1': ($.axZm.oh/2), 'zoomLevel': '100%'})">spinTo third frame and zoom</a>
			<a href="javascript: void(0)" class="btn btn-default btn-xs aze_btn_space" onclick="jQuery.fn.axZm.initFullScreen()">Go fullscreen</a>
			

			<h3>360° Gallery</h3>
			<p class="text-justify">The gallery with other 360/3D objects under the player on this page is optional! 
				Most likely you will not need this gallery. However we also provide a "clean" 
				example with this gallery and no PHP in the frontend. 
				Player and gallery are loaded over one function - $.axZm360Gallery() and are really easy to configure. 
				Update: the "thumb slider" used for the external 360 gallery is replaced with our own which can 
				be configured in many different ways, see demo <a href="../axZm/extensions/axZmThumbSlider/">here</a>.
			</p>

			<h3>Do not like the toolbar?</h3>
			<p class="text-justify">
				<img src="https://www.ajax-zoom.com/pic/layout/option_screens/mNavi1.jpg" border="0" align="left" style="margin: 3px 10px 5px 0px">
				If you do not like the toolbar below the player see e.g. 
				<a href="https://www.ajax-zoom.com/examples/example28.php">example28.php</a> which is fully functional without this toolbar. 
				Of course you can also completely reskinn and disable certain buttons, 
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#Zoom_Navigation" target="_blank">remove</a> this toolbar completely, 
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#Mobile_Navigation" target="_blank">enable a different tollbar</a> 
				which looks more modern and has more options to configure. 
				And you can also reproduce the navi behaviour with buttons placed whereever in your layout using  
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#API_JS_METHODS" target="_blank">AJAX-ZOOM API</a>. 
				Please note that this black toolbar might not be seen if you are on iPad or some other mobile devices, 
				because the default settings of 
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#touchSettings" target="_blank">touchSettings</a> 
				option might be set to disable this navi for touch devices...
			</p>

			<h3>For developers - some technical stuff</h3>
			<p class="text-justify">Following is some very basic technical information about AJAX-ZOOM. If your are serious about trying and implementing AJAX-ZOOM on your webpage, 
				then viewing <a href="https://www.ajax-zoom.com/index.php?cid=examples">other examples</a> and browsing in 
				documentation are highly recommended as first step! After you have found an example which does conceptually suits your needs, 
				your should 
				<a href="https://www.ajax-zoom.com/index.php?cid=download" href="_blank">download</a> the package and 
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#heading_2" href="_blank">make it work</a> on your server or localhost. 
			</p>

			<p class="text-justify">While searching for a suitable example do not pay attention to design, galleries and other things, 
				which are all configurable, adjustable and can be disabled. 
				The point is, that AJAX-ZOOM is so flexible, that our team sometimes does not recognize its own product 
				after it has been implemented and adjusted by the customers. 
				If you are not sure what example is the right one to start with, you can 
				<a href="https://www.ajax-zoom.com/index.php?cid=contact">send us</a> 
				a mockup which would visualize your intent and we will gladly give you a hint. 
			</p>

			<p class="text-justify">Basically to load the 360 spinner all you need is to define the directory ("3dDir" parameter) where images (frames of 360) are located. 
				The number of frames depends on the number of images in this directory and will be determined instantly! 
				For a single row (360, not sptherical 3D) you should have at least 12 images. 
				The more images are available, the smoother is your animation. 
				However, the more images are loaded, the longer it takes for the preload. 
				Therefore we consider 72 images as perfectly smooth for the web; 
				36 images is a good average used by many customers these days.
			</p>

			<p class="text-justify">All image processing including the generation of image tiles is done on-the-fly during the first load of AJAX-ZOOM in the browser. 
				You can however pre-process all your 360s with the provided batch tool (/axZm/zoomBatch.php);
			</p>

			<p class="text-justify">There are several 360/3D specific <a href="https://www.ajax-zoom.com/index.php?cid=docs#VR_Object" target="_blank">options</a> 
				to adjust the spin behaviour and appearance. However all other options from plain 2D zoom are applicable to 360 degree player as well! 
				A small selection of selected parameters has been made to be visually changed in this example 
				(more parameters in the <a href="https://www.ajax-zoom.com/index.php?cid=docs">online documentation</a>): 
				<a href="javascript: void(0)" onclick="reverseSpin()">Reverse</a> spin direction.  
				<a href="javascript: void(0)" onclick="setSpinState(true)">Enable</a> | 
				<a href="javascript: void(0)" onclick="setSpinState(false)">disable</a> the blur effect. 
				<a href="javascript: void(0)" onclick="setNaviStatus(false)">Disable</a> | 
				<a href="javascript: void(0)" onclick="setNaviStatus(true)">enable</a> the navigation toolbar. 
				<a href="javascript: void(0)" onclick="setZoomSlider(false)">Disable</a> | 
				<a href="javascript: void(0)" onclick="setZoomSlider(true)">enable</a> the zoom slider and 
				<a href="javascript: void(0)" onclick="setSpinSlider(false)">disable</a> |
				<a href="javascript: void(0)" onclick="setSpinSlider(true)">enable</a> the spin slider.
			</p>

			<p class="text-justify">By defining the query string parameter in ajaxZoom.parameter "example=17" some default settings from 
				/axZm/zoomConfig.inc.php are overridden in /axZm/zoomConfigCustom.inc.php after <code>elseif ($_GET['example'] == 17){</code>.
				So if changes in /axZm/zoomConfig.inc.php have no effect look for the same options /axZm/zoomConfigCustom.inc.php; 
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#heading_3" target="_blank">Here</a> 
				you will find more information on how to setup options best.
			</p>

			<p class="text-justify">To interested developers AJAX-ZOOM offers a variety of 
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#API_JS_METHODS" target="_blank">methods</a> and 
				<a href="https://www.ajax-zoom.com/index.php?cid=docs#API_CALLBACKS" target="_blank">callbacks</a> 
				to develop a highly customized applications. Alternatively we can create your individual application as a custom work. 
			</p>

			<input type="button" class="btn btn-info btn-block" value="Download AJAX-ZOOM 360°/3D" onclick="window.location.href = 'https://www.ajax-zoom.com/index.php?cid=download'"> 
			<span class="small">free download with sample images and all the examples</span>

			<h3>About AJAX-ZOOM</h3>
			<p class="text-justify">AJAX-ZOOM is developed in Germany and was first released in the year 2010. 
				From then until now it has been continuously improved, enhanced and supported. 
				AJAX-ZOOM is based on jQuery (JavaScript) and PHP.
			</p>
			<p class="text-justify">With this fully-featured solution, it is possible to present even ultra-high-resolution photos online in best quality. 
				Via the approx. 400 optional parameters and CSS, AJAX-ZOOM is very flexibly configurable and re-skinable. 
				All controls can be individually disabled and/or changed in their appearance. 
				Seamless integration into any web page is thus guaranteed.
			</p>
			<p class="text-justify">All you need is a LAMP (Linux, Apache, MySQL and PHP) web server. 
				However AJAX-ZOOM can be also implemented in ASP.NET / IIS web applications without PHP via "Phalanger". 
				For optimal quality and speed, AJAX-ZOOM offers full ImageMagick® support, 
				although LibGD integrated into PHP is generally sufficient. 
				JPG, TIF, PNG, BMP, GIF and PSD image types are supported (TIF & PSD only with "Imagemagick").
			</p>
		</div>

		<!-- Init AJAX-ZOOM 360 and the 360 gallery -->
		<script type="text/javascript">
			// Init AJAX-ZOOM 360 and the 360 gallery
			$.axZm360Gallery ({
				axZmPath: "auto", // Path to /axZm/ directory, e.g. "/test/axZm/"
				embedResponsive: true, // if "divID" is responsive, set this to true
				// This is the path where we want to get other 360s or 3D from
				// So if under this path there are any other subfolders, 
				// then the first image will be loaded into the gallery
				// ajaxZoom.galleryFolder is used in onSpinPreloadEnd callback
				gallery3dDir: "/pic/zoom3d", // Path to the folder where in subfolders are images for several 360s/3D
				first3dDir: "/pic/zoom3d/Uvex_Occhiali", // index or name of the folder to be loaded at first

				// Configuration set value which is passed to ajax-zoom, e.g. 17 or "spinIpad"
				// some default settings from /axZm/zoomConfig.inc.php are overridden in 
				// /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 17){
				example: 17, 

				// Some of the AJAX-ZOOM option normally set in zoomConfig.inc.php and zoomConfigCustom.inc.php 
				// can be set directly as js var in this callback
				azOptions: {
					zoomSlider: false,
					spinSlider: false,
					//e.g.
					// zoomSlider: false,
					// gallerySlideNavi: true,
					// gallerySlideNaviOnlyFullScreen: true
				},

				divID: "axZmPlayerContainer", // The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
				spinGalleryContainerID: "spinGalleryContainer", // Parent container of gallery div
				spinGalleryID: "spinGallery", // ID of the menu container
				spinGallery_tempID: "spinGallery_temp", // ID of the menu container

				// background color of the player, possible values: #hex color or "auto" 
				// if "auto" AJAX-ZOOM will try to determin the background color
				// use "auto" only if you have e.g. black and white on different 360s
				backgroundColor: "#FFFFFF", 

				checkReverse: true, // Set to check spinReverse / spinReverseZ settings upon the below options (toReverseArr, toReverseArrZ)
				// Array with folder names where spinReverse option should be applied
				toReverseArr: ['Uvex_Occhiali', 'Atomic', 'Floete', 'Nike_Running', 'Pelican', 'Speed_Strength_BlackJacket', 'Speed_Strength_WhiteJacket', 'Uzi_32'], 
				toReverseArrZ: [], // Array with folder names where spinReverseZ option should be applied

				fullScreenApi: false, // try to open AJAX-ZOOM at browsers fullscreen mode
				thumbsAtFullscreen: false, // show 360 thumb gallery at fullscreen mode, possible values: "bottom", "top", false
				axZmThumbSlider: true, // use axZmThumbSlider extension for the thumbs, set false to disable

				// Options passed to axZmThumbSlider
				// For more information see /axZm/extensions/axZmThumbSlider/
				axZmThumbSliderParam: {
					// e.g.
					btn: false // disable left/right buttons
				},

				thumbsCache: true, // cache thumbnails
				thumbWidth: 68, // width of the thumbnail image
				thumbHeight: 68, // height of the thumbnail image
				thumbQual: 90, // jpg quality of the thumbnail image
				thumbMode: false, // possible values: "contain", "cover" or false
				thumbBackColor: "#FFFFFF", // background color of the thumb if thumbMode is set to "contain"
				thumbRetina: true, // true will double the resolution of the thumbnails
				thumbDescr: true, // Show thumb description

				// Custom description of the thumbs
				thumbDescrObj: {
					// e.g.
					//"Uvex_Occhiali": "test",
					//"some_other": "test123"
				},
				thumbIcon: true, // Show 360 or 3D icon for the thumbs

				// Object with AJAX-ZOOM callbacks, https://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
				axZmCallBacks: {
					// e.g.
					//onload: function(){console.log("onLoad fired")},
					//onSpinPreloadEnd: function(){console.log("spin preloaded")}
				}
			});
		</script>

		<!-- ********************************************* -->
		<!-- Following is not needed for AJAX-ZOOM to work -->
		<!-- ********************************************* -->
		<script type="text/javascript">
			// These js functions are just for the demo, they are not needed for the implementation
			var scrollToPageTop = function() {
				window.scrollTo(0, 0); 
			};

			var setSpinState = function(q) {
				if (jQuery.axZm) {
					jQuery.axZm.spinEffect.enabled = q;
					scrollToPageTop();
				}
			};

			var setNaviStatus = function(q) {
				if(jQuery.axZm) {
					if (q === false){
						jQuery('#axZm_zoomNavigation').css('display', 'none');
						jQuery.fn.axZm.switchSpin(true);
					} else {
						jQuery('#axZm_zoomNavigation').css('display', 'block');
					}
					scrollToPageTop();
				}
			};

			var reverseSpin = function() {
				if(jQuery.axZm){
					if (jQuery.axZm.spinReverse === true) {
						jQuery.axZm.spinReverse = false;
					} else {
						jQuery.axZm.spinReverse = true;
					}
					scrollToPageTop();
				}
			};

			var setZoomSlider = function(q) {
				if (q === false) {
					jQuery('#axZm_zoomSliderZoomContainer').css('visibility', 'hidden');
				} else {
					jQuery('#axZm_zoomSliderZoomContainer').css('visibility', 'visible');
				}
				scrollToPageTop();
			};

			var setSpinSlider = function(q) {
				if (q === false) {
					jQuery('#axZm_zoomSliderSpinContainer').css('display', 'none');
				} else {
					jQuery('#axZm_zoomSliderSpinContainer').css('display', 'block');
				}
				scrollToPageTop();
			};
		</script>
	</div>
	<div class="row">

		<div class="col-lg-12">
			<h2 style="margin-top: 50px;">Simple integration example code - fixed width and height without 360 gallery</h2>
			<p>The below code is from <a href="example15_clean.php">example15_clean.php</a>; 
				For 360 gallery and responsive examples please see derived examples and other above.
			</p>

			<!-- Code head -->
			<h4>JavaScript & CSS files in Head</h4>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
	<!--  Include jQuery core into head section -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

	<!--  AJAX-ZOOM javascript && CSS -->
	<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
			');
			echo "</code></pre>";
			?>
			</div>
			
			<!-- Code body -->
			<h4>HTML markup in body</h4>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
	<!--  Placeholder for AJAX-ZOOM player -->
	<div id="AZplayerParentContainer" style="margin: 5px 0px 0px 10px; width: 602px; min-height: 400px; color: gray;">
		Loading, please wait..
	</DIV>
			');
			echo "</code></pre>";
			?>
			</div>

			<!-- Code js -->
			<h4>JavaScript</h4>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-js">';
				echo htmlspecialchars ('
	// Create empty jQuery object which is interpreted in axZm/jquery.axZm.loader.js
	var ajaxZoom = {}; 

	// Define callbacks, for complete list check the docs
	// https://www.ajax-zoom.com/index.php?cid=docs#API_CALLBACKS
	ajaxZoom.opt = {
		onBeforeStart: function(){
			// Some of the options can be set directly as js var in this callback
			jQuery.axZm.spinReverse = true;
		}
	};

	// Define the path to the axZm folder, adjust the path if needed!
	ajaxZoom.path = "../axZm/"; 

	// Define your custom parameter query string
	// example=17 has many presets for 360 images*
	// 3dDir - best of all absolute path to the folder with 360/3D images
	// *By defining the query string parameter in ajaxZoom.parameter example=17 
	// some default settings from /axZm/zoomConfig.inc.php are overridden in 
	// /axZm/zoomConfigCustom.inc.php after elseif ($_GET[\'example\'] == 17){. 
	// So if changes in /axZm/zoomConfig.inc.php have no effect - 
	// look for the same options /axZm/zoomConfigCustom.inc.php; 
	ajaxZoom.parameter = "example=17&3dDir=/pic/zoom3d/Uvex_Occhiali"; 

	// The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
	ajaxZoom.divID = "AZplayerParentContainer";

	// Load AJAX-ZOOM
	jQuery(document).ready(function(){
		jQuery.fn.axZm.load({
			opt: ajaxZoom.opt,
			path: ajaxZoom.path,
			parameter: ajaxZoom.parameter,
			divID: ajaxZoom.divID
		});			
	});
				');
				echo "</code></pre>";
				?>
			</div>
		</div>
		<div class="col-lg-12">
			<h2>Even easier integration using iframe</h2>
			<div class="aze_example_boxes">
				<div class="aze_example_box clearfix">
					<a href="example13.php" class="aze_example_box_main_image"><img src="https://www.ajax-zoom.com/pic/layout/image-zoom_13.jpg"></a>
					For integration within iframe(s) please check <a href="example13.php">example13.php</a>. 
					There is almost no difference between regular integration and within an iframe. 
					Fullscreen or full browser window does also work on IOS. In this example mouse wheel zoom is disabled per parameter 
					so the user can scroll page down with mouse wheel. But if you want to put AJAX-ZOOM into a tab or it will have 
					smaller dimensions it does make sense to enable it.
				</div> 
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<?php
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				// This is only for the demo, you can remove it
				define('COMMENTS_BOOTSTRAP', true);
				include dirname(__FILE__).'/footer.php';
			}
			?>
		</div>
	</div>
</div>

</body>
</html>