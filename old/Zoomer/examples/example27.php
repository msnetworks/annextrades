<!DOCTYPE html>
<html>
	<head>
		<title>27</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- Include AJAX-ZOOM javascript && css, adjust the path if needed. Best set absolute path -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Include Fancybox lightbox css / js, adjust the path if needed. Best set absolute path -->
		<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

		<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

		<!-- Enable fullscreen for IOS when dealing with iframes -->
		<script type="text/javascript" src="../axZm/axZm.iframe.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css" media="screen"> 
			.linkImage {
				border: 1px solid #aaa;
				width: 150px;
				height: auto;
				margin: 0 10px 10px 0;
			}
			h3 {
				margin-top: 40px;
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
		<div class="container">

			<h1 class="page-header">AJAX-ZOOM Responsive Full Screen Lightbox (Fancybox) Examples</h1>

			<p>In this example AJAX-ZOOM is loaded into the maximized lighbox (Fancybox). 
				The sizes of the Fancybox and AJAX-ZOOM player inside are determined by the window size. 
				By changing the browser window size (orientation change on iOS) all sizes are instantly adjusted.  
				In order to call AJAX-ZOOM with Fancybox in such a way we have created a wrapper extension 
				jquery.axZm.openAjaxZoomInFancyBox.js which handles everything needed. 
			</p> 

			<p>Besides jQuery core library (e.g. https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js) you will need Fancybox JavaScript 
				and AJAX-ZOOM main JavaScript file (/axZm/jquery.axZm.js) to include into the head section of the page. 
				For some methods retrieving the images (CSV) our slightly modified version of Fancybox is required (look for explanation below). 
				The <a href="https://www.ajax-zoom.com/index.php?cid=download">download package</a> contains all necessary files. 
			</p>

			<p><span style="font-weight: bold;">$.axZm.openAjaxZoomInFancyBox.js is also used as option in other extensions and examples:</span> <br />
				<a href="example32.php"><img class="linkImage" src="https://www.ajax-zoom.com/pic/layout/image-zoom_32.jpg" /></a>
				<a href="example5.php"><img class="linkImage" src="https://www.ajax-zoom.com/pic/layout/image-zoom_5.jpg" /></a>
				<a href="example21.php"><img class="linkImage" src="https://www.ajax-zoom.com/pic/layout/image-zoom_21.jpg" /></a>
				<a href="example6.php"><img class="linkImage" src="https://www.ajax-zoom.com/pic/layout/image-zoom_6.jpg" /></a>
				<a href="example3.php"><img class="linkImage" src="https://www.ajax-zoom.com/pic/layout/image-zoom_3.jpg" style="margin-right: 0" /></a>
			</p>

			<p>By the way - this example can serve as tutorial on defining the content to load into AJAX-ZOOM player! 
				There are some other ways of embedding and passing this information to AJAX-ZOOM (see other examples), 
				but the main parameters <b>(zoomData, zoomDir, 3dDir, zoomFile and zoomID)</b> remain unchanged on default. 
				See <a href="https://www.ajax-zoom.com/index.php?cid=docs#heading_10" target="_blank">appendix in the documentation</a> 
				if you need to define your own parameters.
			</p>

			<!--////////////////////////////////////////////////////
			/// zoomData method 1 - full CSV paths to the images ///
			////////////////////////////////////////////////////////
			-->
			<h3>Defining images over "zoomData" parameter and separate image paths with '|' </h3>
			<a href="javascript:void(0)" class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomData=/pic/zoom/boutique/boutique_001.jpg|/pic/zoom/boutique/boutique_002.jpg|/pic/zoom/boutique/boutique_003.jpg|/pic/zoom/boutique/boutique_004.jpg|/pic/zoom/boutique/boutique_005.jpg|/pic/zoom/boutique/boutique_006.jpg|/pic/zoom/boutique/boutique_007.jpg|/pic/zoom/boutique/boutique_008.jpg|/pic/zoom/fashion/fashion_002.jpg|/pic/zoom/fashion/fashion_005.jpg');">
				1. Click me: CSV - zoomData full paths separated  by "|" </a>
			<p>Same results as "PHP array compressed zoomData" below can be achieved by simply passing CSV as zoomData parameter - by "|" separated paths to the images. 
				This does not require any PHP code in your actual application.
			</p>

			<div class="alert alert-warning">PLEASE NOTE: in order to do this we have slightly modified the latest fancybox Ver. 1.3.4;
				Please use our modified version, because the standard version will expect an image if it founds .jpg, .png or other image formats in a string and will 
				return a massage saying the image can't be found. The modification enforces ajax request if "zoomData" is found in the string. 
				You can however use Fancybox Ver. 2 without any modifications.
			</div>

			<?php
			// This is only syntax highlighting, not needed
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<!-- Simple link with onclick -->
				<a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox(\'example=23&
				zoomData=/pic/zoom/boutique/boutique_001.jpg|/pic/zoom/boutique/boutique_002.jpg|
				/pic/zoom/boutique/boutique_003.jpg|/pic/zoom/boutique/boutique_004.jpg|
				/pic/zoom/boutique/boutique_005.jpg|/pic/zoom/boutique/boutique_006.jpg|
				/pic/zoom/boutique/boutique_013.jpg|/pic/zoom/boutique/boutique_014.jpg|
				/pic/zoom/fashion/fashion_002.jpg|/pic/zoom/fashion/fashion_005.jpg\')">2. CSV - zoomData full paths separated  by "|"</a>
			');
			echo '</code></pre>';
			?>

			<p>Additionally you can pass "zoomID" parameter. The value of "zoomID" (number of an image in the array) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomID=2&zoomData=/pic/zoom/boutique/boutique_001.jpg|/pic/zoom/boutique/boutique_002.jpg|/pic/zoom/boutique/boutique_003.jpg|/pic/zoom/boutique/boutique_004.jpg|/pic/zoom/boutique/boutique_005.jpg|/pic/zoom/boutique/boutique_006.jpg|/pic/zoom/boutique/boutique_007.jpg|/pic/zoom/boutique/boutique_008.jpg|/pic/zoom/fashion/fashion_002.jpg|/pic/zoom/fashion/fashion_005.jpg');">
					Test: open specific file first with zoomID
				</a>
			</p> 

			<p>Instead of "zoomID" you can pass "zoomFile" parameter. The value of "zoomFile" (full path with the image filename) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomFile=/pic/zoom/boutique/boutique_004.jpg&zoomData=/pic/zoom/boutique/boutique_001.jpg|/pic/zoom/boutique/boutique_002.jpg|/pic/zoom/boutique/boutique_003.jpg|/pic/zoom/boutique/boutique_004.jpg|/pic/zoom/boutique/boutique_005.jpg|/pic/zoom/boutique/boutique_006.jpg|/pic/zoom/boutique/boutique_007.jpg|/pic/zoom/boutique/boutique_014.jpg|/pic/zoom/fashion/fashion_002.jpg|/pic/zoom/fashion/fashion_005.jpg');">
					Test: open specific file first with zoomFile
				</a>
			</p> 

			<p><a href="javascript:void(0)" id="exampleLink2" class="btn btn-info btn-block">
					1a. Binding with $('selector').openAjaxZoomInFancyBox(options);
				</a>
			</p>
			<script type="text/javascript">
				jQuery("#exampleLink2").openAjaxZoomInFancyBox({
					axZmPath: "../axZm/",
					queryString: "example=23&zoomID=2&zoomData=/pic/zoom/fashion/fashion_1.jpg&zoomData=/pic/zoom/boutique/boutique_001.jpg|/pic/zoom/boutique/boutique_002.jpg|/pic/zoom/boutique/boutique_003.jpg|/pic/zoom/boutique/boutique_004.jpg|/pic/zoom/boutique/boutique_005.jpg|/pic/zoom/boutique/boutique_006.jpg|/pic/zoom/boutique/boutique_007.jpg|/pic/zoom/boutique/boutique_008.jpg|/pic/zoom/fashion/fashion_002.jpg|/pic/zoom/fashion/fashion_005.jpg",
					fullScreenApi: false,
					boxMargin: 30,
					boxPadding: 10,
					boxShowCloseButton: true,

					ajaxZoomCallbacks: {
						/*
						onLoad: function (){
							alert ("This is test alert call");
						},
						onImageChange: function(info){
							console.log(info);
						}
						*/
					}
				});
			</script>

			<?php
			echo '<pre><code class="language-js">';
			echo htmlspecialchars ('
				jQuery("#exampleLink2").openAjaxZoomInFancyBox({
					axZmPath: "../axZm/",
					queryString: "example=23&zoomID=2&zoomData=/pic/zoom/boutique/boutique_001.jpg|
					/pic/zoom/boutique/boutique_002.jpg|/pic/zoom/boutique/boutique_003.jpg|
					/pic/zoom/boutique/boutique_004.jpg|/pic/zoom/boutique/boutique_005.jpg|
					/pic/zoom/boutique/boutique_006.jpg|/pic/zoom/boutique/boutique_013.jpg|
					/pic/zoom/boutique/boutique_014.jpg|/pic/zoom/fashion/fashion_002.jpg|
					/pic/zoom/fashion/fashion_005.jpg",
					fullScreenApi: false,
					boxMargin: 30,
					boxPadding: 10,
					boxShowCloseButton: true,

					ajaxZoomCallbacks: {
					/*
					onLoad: function (){
						alert ("This is test alert call");
					},
					onImageChange: function(info){
						console.log(info);
					}
					*/
					}
				});
			');
			echo '</code></pre>';
			?>

			<h3>Defining images over "zoomData" parameter as string serialized and compressed from PHP array</h3>
			<?php
			////////////////////////////////////////////////////////
			/// zoomData method 2 - compressing PHP into string ////
			////////////////////////////////////////////////////////

			// With this function you can optionally compress a PHP array with images to a string
			// This string can then be passed to AJAX-ZOOM as "zoomData" parameter
			// It will be instantly decompressed into PHP array inside AJAX-ZOOM (/axZm/zoomObjects.inc.php)
			function axZmCompress($data){
				return strtr(base64_encode(addslashes(gzcompress(serialize($data),9))), '+/=', '-_,');
			}

			$zoomData = array();

			// Add images to the array
			$zoomData[1] = '/pic/zoom/boutique/boutique_001.jpg';
			$zoomData[2] = '/pic/zoom/boutique/boutique_002.jpg'; 
			$zoomData[3] = '/pic/zoom/boutique/boutique_003.jpg'; 
			$zoomData[4] = '/pic/zoom/boutique/boutique_004.jpg'; 
			$zoomData[5] = '/pic/zoom/boutique/boutique_005.jpg'; 
			$zoomData[6] = '/pic/zoom/boutique/boutique_006.jpg'; 
			$zoomData[7] = '/pic/zoom/boutique/boutique_013.jpg'; 
			$zoomData[8] = '/pic/zoom/boutique/boutique_014.jpg'; 
			$zoomData[9] = '/pic/zoom/fashion/fashion_002.jpg'; 
			$zoomData[10] = '/pic/zoom/fashion/fashion_005.jpg';

			$zoomData = axZmCompress($zoomData);
			?>

			<a href="javascript:void(0)" class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomData=<?php echo $zoomData;?>');">
				2. Click me: PHP array compressed zoomData</a><br>
			<p>Images are gathered in a PHP array. Afterwards they are compressed to a string. 
				Finally this string will be passed as "zoomData" query string parameter to AJAX-ZOOM. 
			</p>


			<?php
			// This is only syntax highlighting, not needed
			echo '<pre><code class="language-php">';
			echo htmlspecialchars ('
				// With this function you can compress a PHP array with images to a string
				// This string can then be passed to AJAX-ZOOM as "zoomData" parameter
				// It will be instantly decompressed into PHP array inside AJAX-ZOOM (/axZm/zoomObjects.inc.php)
				function axZmCompress($data){
					return strtr(base64_encode(addslashes(gzcompress(serialize($data),9))), "+/=", "-_,");
				}

				// Create empty array
				$zoomData = array();

				// Add images to the array
				$zoomData[1] = \'/pic/zoom/boutique/boutique_001.jpg\';
				$zoomData[2] = \'/pic/zoom/boutique/boutique_002.jpg\';
				$zoomData[3] = \'/pic/zoom/boutique/boutique_003.jpg\';
				$zoomData[4] = \'/pic/zoom/boutique/boutique_004.jpg\';
				$zoomData[5] = \'/pic/zoom/boutique/boutique_005.jpg\';
				$zoomData[6] = \'/pic/zoom/boutique/boutique_006.jpg\';
				$zoomData[7] = \'/pic/zoom/boutique/boutique_013.jpg\';
				$zoomData[8] = \'/pic/zoom/boutique/boutique_014.jpg\';
				$zoomData[9] = \'/pic/zoom/fashion/fashion_002.jpg\';
				$zoomData[10] = \'/pic/zoom/fashion/fashion_005.jpg\';

				// Compress array into string
				$zoomData = axZmCompress($zoomData);
			');
			echo '</code></pre>';

			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<!-- Simple link with onclick -->
				<a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox(\'example=23&zoomData=<?php echo $zoomData;?>\');">1. PHP array compressed zoomData</a>
			');
			echo '</code></pre>';
			?>

			<p>Additionally you can pass "zoomID" parameter. The value of "zoomID" (number of an image in the array) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomID=4&zoomData=<?php echo $zoomData;?>');">
					Test: open specific file first with zoomID
				</a>
			</p> 

			<p>Instead of "zoomID" you can pass "zoomFile" parameter. The value of "zoomFile" (full path with the image filename) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomFile=<?php echo axZmCompress('/pic/zoom/boutique/boutique_004.jpg');?>&zoomData=<?php echo $zoomData;?>');">
					Test: open specific file first with zoomFile
				</a>
			</p> 

			<!--//////////////////////////////////////////////////////////////////////////
			/// zoomData method 1 & 2 with use Path defined in $zoom['config']['pic'] ////
			//////////////////////////////////////////////////////////////////////////////
			-->
			<h3>No need to define absolute paths in "zoomData" parameter</h3>
			<a href="javascript:void(0)" class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomData=fashion/fashion_1.jpg&zoomData=boutique/boutique_001.jpg|boutique/boutique_002.jpg|boutique/boutique_003.jpg|boutique/boutique_004.jpg|boutique/boutique_005.jpg|boutique/boutique_006.jpg|boutique/boutique_007.jpg|boutique/boutique_008.jpg|fashion/fashion_002.jpg|fashion/fashion_005.jpg');">3. Click me: $zoom['config']['pic'] as prefix</a>
			<p>$zoom['config']['pic'] in /axZm/zoomConfig.inc.php can be used as prefix to all paths passed to AJAX-ZOOM. 
				If you need to point to the image located in "/pic/zoom/boutique/boutique_004.jpg" and $zoom['config']['pic'] is "/pic/zoom/" the path can be just "boutique/boutique_004.jpg". 
				No matter what is defined in $zoom['config']['pic'] you can pass the full path too, e.g "/pic/zoom/boutique/boutique_004.jpg" will work as well. 
			</p>

			<div class="alert alert-warning">PLEASE NOTE: in order to do this we have slightly modified the latest fancybox Ver. 1.3.4;
				Please use our modified version, because the standard version will expect an image if it founds .jpg, .png or other image formats in a string and will 
				return a massage saying the image can't be found. The modification enforces ajax request if "zoomData" is found in the string. 
				You can however use Fancybox Ver. 2 without any modifications.
			</div>

			<?php
			// This is only syntax highlighting, not needed
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<!-- Simple link with onclick -->
				<a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox(\'example=23&zoomData=
				fashion/fashion_1.jpg&zoomData=boutique/boutique_001.jpg|boutique/boutique_002.jpg|
				boutique/boutique_003.jpg|boutique/boutique_004.jpg|boutique/boutique_005.jpg|
				boutique/boutique_006.jpg|boutique/boutique_013.jpg|boutique/boutique_014.jpg|
				fashion/fashion_002.jpg|fashion/fashion_005.jpg\');">3. $zoom[\'config\'][\'pic\'] as prefix</a>
			');
			echo '</code></pre>';
			?>

			<p>Additionally you can pass "zoomID" parameter. The value of "zoomID" (number of an image in the array) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomID=4&zoomData=boutique/bag_0.jpg|fashion/fashion_1.jpg&zoomData=boutique/boutique_001.jpg|boutique/boutique_002.jpg|boutique/boutique_003.jpg|boutique/boutique_004.jpg|boutique/boutique_005.jpg|boutique/boutique_006.jpg|boutique/boutique_007.jpg|boutique/boutique_008.jpg|fashion/fashion_002.jpg|fashion/fashion_005.jpg');">
					Test: open specific file first with zoomID
				</a>
			</p> 

			<p>Instead of "zoomID" you can pass "zoomFile" parameter. The value of "zoomFile" (full path with the image filename) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomFile=boutique/boutique_004.jpg&zoomData=fashion/fashion_1.jpg&zoomData=boutique/boutique_001.jpg|boutique/boutique_002.jpg|boutique/boutique_003.jpg|boutique/boutique_004.jpg|boutique/boutique_005.jpg|boutique/boutique_006.jpg|boutique/boutique_007.jpg|boutique/boutique_008.jpg|fashion/fashion_002.jpg|fashion/fashion_005.jpg');">
					Test: open specific file first with zoomFile
				</a>
			</p>

			<!--////////////////////////////////////////////////////////////////////////
			/// zoomDir - load entire directory with images with just one parameter ////
			////////////////////////////////////////////////////////////////////////////
			-->
			<h3>Load entire directory with "zoomDir" parameter</h3>
			<a href="javascript:void(0)" class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomDir=/pic/zoom/animals');">
				4. Click me: zoomDir - load entire directory with images</a>
			<p>You can load entire directory with images by passing zoomDir parameter e.g. "/pic/zoom/animals"; 
				As in method 3 above - provided, that $zoom['config']['pic'] is set to e.g. "/pic/" the value of zoomDir parameter can be just "zoom/animals" 
				or if $zoom['config']['pic'] is set to "/pic/zoom/", the value of zoomDir can be "animals".
			</p>

			<?php
			// This is only syntax highlighting, not needed
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<!-- Simple link with onclick -->
				<a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox(\'example=23&zoomDir=/pic/zoom/animals\');">4. zoomDir - load entire directory with images</a>
			');
			echo '</code></pre>';
			?>

			<p>Additionally you can pass "zoomID" parameter. The value of "zoomID" (number of an image in the array) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomID=2&zoomDir=/pic/zoom/animals');">
					Test: open specific file first with zoomID
				</a>
			</p> 

			<p>Instead of "zoomID" you can pass "zoomFile" parameter. The value of "zoomFile" (full path with the image filename) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=23&zoomFile=animals_002.jpg&zoomDir=/pic/zoom/animals');">
					Test: open specific file first with zoomFile
				</a>
			</p>

			<!--/////////////////////////////////////////////////////////////////////////
			/// 3dDir - load 360/3D by passing the path to the folder with images ///////
			/////////////////////////////////////////////////////////////////////////////
			-->
			<h3>Load 360/3D with "3dDir" parameter</h3>
			<a href="javascript:void(0)" class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox('example=17&3dDir=/pic/zoom3d/Uvex_Occhiali');">5. Click me: 3dDir - 360 / 3D animations</a>
			<p>Load 360/3D animations by passing the parameter 3dDir - path to the directory with images.
			</p>

			<p>Please Note: the only difference between regular 360 spin and 3D (multirow) is that original images are placed in subfolders of the target folder. 
				E.g. the path passed to the folder is "/pic/zoom3d/Uvex_Occhiali" images of each row are placed in subfolders, 
				e.g. /pic/zoom3d/Uvex_Occhiali/row_1, /pic/zoom3d/Uvex_Occhiali/row_2, /pic/zoom3d/Uvex_Occhiali/row_3; 
				You do not need to define these subfolders anywhere. AJAX-ZOOM will instantly detect them and procede all the images in them. 
			</p>

			<?php
			// This is only syntax highlighting, not needed
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<!-- Simple link with onclick -->
				<a href="javascript:void(0)" class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox(\'example=17&3dDir=/pic/zoom3d/Uvex_Occhiali\');">5. 3dDir - 360 / 3D animations</a>
			');
			echo '</code></pre>';
			?>

			<p>Additionally you can pass "zoomID" parameter. The value of "zoomID" (number of an image in the array) determines which image has to be loaded first. -> 
				<br><a href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox('example=17&zoomID=15&3dDir=/pic/zoom3d/Uvex_Occhiali');">
					Test: open specific file first with zoomID
				</a>
			</p> 

			<h3>Load anything above in responsive Fancybox as IFRAME</h3>
			<a class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox({href: 'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg', iframe: true})" href="javascript:void(0)">IFRAME gallery</a>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<a class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox({href: \'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg\', iframe: true})" href="javascript:void(0)">IFRAME gallery</a>
			');
			echo '</code></pre>';
			?>
			<a class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox({href: 'example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali', iframe: true})" href="javascript:void(0)">IFRAME 360</a>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<a class="btn btn-info btn-block" onclick="jQuery.openAjaxZoomInFancyBox({href: \'example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali\', iframe: true})" href="javascript:void(0)">IFRAME 360</a>
			');
			echo '</code></pre>';
			?>

			<h3>$.openAjaxZoomInFancyBox documentation</h3>
			<p>$.openAjaxZoomInFancyBox(options) - if options is an object you can define all the the options below. 
				If however you do not care about the options, then options parameter can be a string representing "queryString" option below.
			</p>
			<?php 
			if (file_exists(dirname(__FILE__).'/extensions_doc/docu_openAjaxZoomInFancyBox.inc.html')) {
				include (dirname(__FILE__).'/extensions_doc/docu_openAjaxZoomInFancyBox.inc.html');
			}
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				// This is only for the demo, you can remove it
				define('COMMENTS_BOOTSTRAP', true);
				include dirname(__FILE__).'/footer.php';
			}
			?>
		</div>
	</body>
</html>