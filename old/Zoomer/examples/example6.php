<!DOCTYPE html>
<html>
	<head>
		<title>6</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed! -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- jQuery core, needed if not present! -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM core, needed! -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- AJAX-ZOOM thumbGallery extension, needed! -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.hoverThumb.css" type="text/css">
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.hoverThumb.js"></script>

		<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, 
		only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional -->
		<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.js"></script>

		<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, 
		requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

		<!-- Colorbox plugin, only needed if ajaxZoomOpenMode below is set to "colorbox", optional -->
		<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>

		<!-- IE < 9 @media query support -->
		<script src="../axZm/plugins/css3-mediaqueries.min.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

		<style type="text/css">
			.block_1_parent{
				/* same as border-right in block_1 */
				margin-right: -5px;
				margin-bottom: 20px;
			}
			.block_1{
				float: left;
				width: 12.5%;
				height: auto;
				box-sizing: border-box;
				border-right: 5px solid #FFF;
				border-bottom: 5px solid #FFF;
			}

			@media only screen and (max-width: 1600px) {
				.block_1{width: 16.6666666666%;}
			}

			@media only screen and (max-width: 1400px) {
				.block_1{width: 20%;}
			}
			@media only screen and (max-width: 900px) {
				.block_1{width: 25%;}
			}
			@media only screen and (max-width: 700px) {
				.block_1{width: 33.333333333333333%;}
			}
			@media only screen and (max-width: 500px) {
				.block_1{width: 50%;}
			}
			@media only screen and (max-width: 400px) {
				.block_1{width: 100%;}
			}

			.block_1_parent_2 .block_1 {
				background-color: #000;
				padding: 4px;
			}

			.block_2_parent {
				/* same as border-right in block_2 */
				margin-right: -5px;
			}

			.block_2 {
				float: left;
				width: 200px;
				height: 136px;
				box-sizing: border-box;
				border-right: 5px solid #FFF;
				border-bottom: 5px solid #FFF;
			}

			.block_3_parent {
				/* same as border-right in block_2 */
				margin-right: -5px;
				padding: 10px 10px 5px 10px;
				text-align: center;
				background-color: #333;
			}

			.block_3 {
				display: inline-block;
				height: 136px;
				box-sizing: border-box;
			}

		</style>
		<style type="text/css">
			h3 {
				margin-top: 35px;
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

		<div class="container-fluid">

			<h1 class="page-header">AJAX-ZOOM - thumb hover zoom gallery</h1>

			<p>Responsive thumbnails gallery plugin with hover zoom effect and various other options.
			</p>

			<p>On click, the AJAX-ZOOM viewer opens in a lightbox such as responsive "Fancybox". 
				The viewer can also open at fullscreen or as full browser window overlay.
			</p>

			<p>All JavaScript is within the <code>jquery.axZm.hoverThumb.js</code> file, which is an AJAX-ZOOM extension. 
				The documentation of the <code>$.azHoverThumb</code> options is at the bottom of this page.
			</p>

			<h3>Responsive width ranging from 12.5% to 100% depending on the resolution of the screen</h3>
			<p>Depending on resolution, 
				the width changes over adjustable CSS3 @media Queries to 12.5%, 16.66%, 20%, 25%, 33.33%, 50% or 100%.
				The height is set instantly via the <code>parentHeightRatio</code>option, which is a fixed width/height image ratio;
			</p>

			<!-- Container with hover thumbs -->
			<div class="block_1_parent clearfix">
				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="Optional title: car 1" data-img="/pic/zoom/trasportation/transportation_001.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_001.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="Optional title: car 2" data-img="/pic/zoom/trasportation/transportation_002.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_002.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="" data-img="/pic/zoom/trasportation/transportation_003.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_003.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="" data-img="/pic/zoom/trasportation/transportation_004.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_004.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="" data-img="/pic/zoom/trasportation/transportation_005.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_005.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="" data-img="/pic/zoom/trasportation/transportation_006.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_006.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="" data-img="/pic/zoom/trasportation/transportation_007.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_007.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="" data-img="/pic/zoom/trasportation/transportation_008.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_008.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="cars1" data-descr="" data-img="/pic/zoom/trasportation/transportation_009.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_009.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

			</div>

			<!-- Fire azHoverThumb on .azHoverThumb under block_1_parent -->
			<script type="text/javascript">
				$('.block_1_parent .azHoverThumb').azHoverThumb({
					parentHeightRatio: 0.665,
					zoomRatio: 1.34
				});
			</script>

			<h3>Example with the <code>parentHeightRatio</code> option set to 0.6 and images having different proportions. 
				The <code>zoomRatio</code> option is set to 2.5
			</h3>
			<p>Images center within their parent containers. 
				Background color refers to the parent containers CSS class, and the border is set via CSS padding.
			</p>

			<div class="block_1_parent block_1_parent_2 clearfix">
				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 1" data-img="/pic/zoom/fashion/fashion_001.jpg" src="../axZm/zoomLoad.php?previewPic=fashion_001.jpg&previewDir=/pic/zoom/fashion&qual=90&width=400&height=400" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 2" data-img="/pic/zoom/fashion/fashion_002.jpg" src="../axZm/zoomLoad.php?previewPic=fashion_002.jpg&previewDir=/pic/zoom/fashion&qual=90&width=400&height=400" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 3" data-img="/pic/zoom/fashion/fashion_003.jpg" src="../axZm/zoomLoad.php?previewPic=fashion_003.jpg&previewDir=/pic/zoom/fashion&qual=90&width=400&height=400" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 4" data-img="/pic/zoom/fashion/fashion_004.jpg" src="../axZm/zoomLoad.php?previewPic=fashion_004.jpg&previewDir=/pic/zoom/fashion&qual=90&width=400&height=400" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 5" data-img="/pic/zoom/fashion/fashion_005.jpg" src="../axZm/zoomLoad.php?previewPic=fashion_005.jpg&previewDir=/pic/zoom/fashion&qual=90&width=400&height=400" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 6" data-img="/pic/zoom/estate/house_01.jpg" src="../axZm/zoomLoad.php?previewPic=house_01.jpg&previewDir=/pic/zoom/estate&qual=90&width=400&height=400" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 7" data-img="/pic/zoom/estate/house_02.jpg" src="../axZm/zoomLoad.php?previewPic=house_02.jpg&previewDir=/pic/zoom/estate&qual=90&width=400&height=400" alt="" />
				</div>

				<div class="block_1">
					<img class="azHoverThumb" data-group="world" data-descr="world image 8" data-img="/pic/zoom/estate/house_03.jpg" src="../axZm/zoomLoad.php?previewPic=house_03.jpg&previewDir=/pic/zoom/estate&qual=90&width=400&height=400" alt="" />
				</div>
			</div>

			<!-- Fire azHoverThumb on .azHoverThumb under block_1_parent_2 -->
			<script type="text/javascript">
				$('.block_1_parent_2 .azHoverThumb').azHoverThumb({
					parentHeightRatio: 0.6,
					parentHeightLL: 0.6,
					zoomRatio: 2.5,
					overlayColor: '#FFF'
				});
			</script>

			<!-- Container with hover thumbs -->
			<h3>Fixed width and height of the thumbnails</h3>
			<p>The width and height of the parent thumbnails are not responsive but set via CSS class as fixed px values. 
				Neither <code>parentHeightRatio</code> nor <code>parentWidthRatio</code> apply below.
			</p>

			<div class="block_2_parent clearfix">

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_001.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_001.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_002.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_002.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_003.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_003.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_004.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_004.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_005.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_005.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_006.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_006.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_007.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_007.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_008.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_008.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_2">
					<img class="azHoverThumb" data-group="cars2" data-descr="" data-img="/pic/zoom/trasportation/transportation_009.jpg" src="../axZm/zoomLoad.php?previewPic=transportation_009.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" alt="" />
				</div>

			</div>

			<!-- Fire azHoverThumb on .azHoverThumb under block_2_parent -->
			<script type="text/javascript">
				$(".block_2_parent .azHoverThumb").azHoverThumb({
					zoomRatio: 2,
					zoomInSpeed: 600,
					zoomOutSpeed: 300
				});
			</script>


			<!-- Container with hover thumbs -->
			<h3>Fixed height of the thumbnails (the unit of the height may be responsive as %) and <code>parentWidthRatio</code> option set to "auto"</h3>
			<p>The "auto" value of the <code>parentWidthRatio</code> option also works in IE < 9.
			</p>

			<div class="block_3_parent clearfix">
				<h3 style="color: #FFF; margin-top: 0; margin-bottom: 20px;">Gallery box</h3>
				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_001.jpg" src="../axZm/zoomLoad.php?previewPic=animals_001.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_002.jpg" src="../axZm/zoomLoad.php?previewPic=animals_002.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_003.jpg" src="../axZm/zoomLoad.php?previewPic=animals_003.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_004.jpg" src="../axZm/zoomLoad.php?previewPic=animals_004.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_005.jpg" src="../axZm/zoomLoad.php?previewPic=animals_005.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_006.jpg" src="../axZm/zoomLoad.php?previewPic=animals_006.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_007.jpg" src="../axZm/zoomLoad.php?previewPic=animals_007.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_008.jpg" src="../axZm/zoomLoad.php?previewPic=animals_008.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_009.jpg" src="../axZm/zoomLoad.php?previewPic=animals_009.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_010.jpg" src="../axZm/zoomLoad.php?previewPic=animals_010.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_011.jpg" src="../axZm/zoomLoad.php?previewPic=animals_011.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_012.jpg" src="../axZm/zoomLoad.php?previewPic=animals_012.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>

				<div class="block_3">
					<img class="azHoverThumb" data-group="animals1" data-descr="" data-img="/pic/zoom/animals/animals_013.jpg" src="../axZm/zoomLoad.php?previewPic=animals_013.jpg&previewDir=/pic/zoom/animals&qual=90&width=400&height=300" alt="" />
				</div>
			</div>

			<!-- Fire azHoverThumb on .azHoverThumb under block_2_parent -->
			<script type="text/javascript">
				$(".block_3_parent .azHoverThumb").azHoverThumb({
					parentWidthRatio: 'auto'
				});
			</script>

			<!-- Switch between different ajaxZoomOpenMode option values, not needed -->
			<div>
				<!--  This is just a helper function for the demo to switch between ajaxZoomOpenMode option, not needed -->
				<script type="text/javascript" language="javascript">
					function setOpt(opt) {
						var val = $("input[name='"+opt+"']:checked").val();

						if (val == undefined){
							val = $("select[name='"+opt+"'] option:selected").val();
						}

						if (val == 'true') {
							val = true;
						}

						if (val == 'false') {
							val = false;
						}

						$('.block_1_parent .block_1, .block_2_parent .block_2, .block_3_parent .block_3')
						.data(opt, val);
					}
				</script>

				<h3>Try various AJAX-ZOOM open mods</h3>
				<table>
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
						<td> 
							Enable monitor size fullscreen: 
							<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="true"> - enable 
							<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="false" checked> - disable
						</td>
					</tr>
				</table>
			</div>

			<h3>JavaScript & CSS files in Head</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
<?php
echo '<pre><code class="language-markup">';
echo htmlspecialchars ('
	<!-- jQuery core, needed! -->
	<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

	<!-- AJAX-ZOOM core, needed! -->
	<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
	<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

	<!-- AJAX-ZOOM thumbGallery extension, needed! -->
	<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.hoverThumb.css" type="text/css">
	<script type="text/javascript" src="../axZm/extensions/jquery.axZm.hoverThumb.js"></script>

	<!--  Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional -->
	<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
	<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.js"></script>

	<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, 
	requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
	<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

	<!-- Colorbox plugin, only needed if ajaxZoomOpenMode below is set to "colorbox", optional -->
	<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
	<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>
');
echo '</code></pre>';
?>
			</div>

			<h3>CSS</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
<?php
echo '<pre><code class="language-css">';
echo htmlspecialchars ('
	.block_1{
		float: left;
		width: 12.5%;
		height: auto;
		box-sizing: border-box;
		border-right: 5px solid #FFF;
		border-bottom: 5px solid #FFF;
	}

	.block_1_parent{
		/* same as border-right in .block_1 */
		margin-right: -5px;
		margin-bottom: 20px;
	}

	@media only screen and (max-width: 1600px) {
		.block_1{width: 16.6666666666%;}
	}	

	@media only screen and (max-width: 1400px) {
		.block_1{width: 20%;}
	}
	@media only screen and (max-width: 900px) {
		.block_1{width: 25%;}
	}
	@media only screen and (max-width: 700px) {
		.block_1{width: 33.333333333333333%;}
	}
	@media only screen and (max-width: 500px) {
		.block_1{width: 50%;}
	}
	@media only screen and (max-width: 400px) {
		.block_1{width: 100%;}
	}
');
echo '</code></pre>';
?>
			</div>

			<h3>HTML makup in body</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
<?php
echo '<pre><code class="language-markup">';
echo htmlspecialchars ('
<!-- Container where subfolders will be loaded into -->
<div class="block_1_parent clearfix">
	<div class="block_1">
		<img class="azHoverThumb" 
			data-group="cars" 
			data-descr="Optional title: car 1" 
			data-img="/pic/zoom/trasportation/transportation_005.jpg" 
			src="../axZm/zoomLoad.php?previewPic=transportation_005.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" 
			alt="">
	</div>

	<div class="block_1">
		<img class="azHoverThumb" 
			data-group="cars" 
			data-descr="Optional title: car 2" 
			data-img="/pic/zoom/trasportation/transportation_006.jpg" 
			src="../axZm/zoomLoad.php?previewPic=transportation_006.jpg&previewDir=/pic/zoom/trasportation&qual=90&width=400&height=300" 
			alt="">
	</div>
</div>
');
echo '</code></pre>';
?>
			</div>

			<h3>JavaScript</h3>
			<div style="clear:both; margin: 5px 0px 5px 0px;">
				<?php
				echo '<pre><code class="language-js">';
				echo htmlspecialchars ('
					// Fire azHoverThumb on .azHoverThumb under block_1_parent
					$(".block_1_parent .azHoverThumb").azHoverThumb({
					parentHeightRatio: 0.665,
					zoomRatio: 1.34
					});
				');
				echo '</code></pre>';
				?>

			</div>

			<h3>$.azHoverThumb - documentation (options)</h3>
			<div style="overflow-x: hidden;">
				<?php
				if (file_exists(dirname(__FILE__).'/extensions_doc/docu_hoverThumb.inc.html')) {
					include dirname(__FILE__).'/extensions_doc/docu_hoverThumb.inc.html';
				}
				?>
			</div>

			<?php
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				define('COMMENTS_BOOTSTRAP', true);
				include dirname(__FILE__).'/footer.php';
			}
			?>
		</div>
	</body>
</html>