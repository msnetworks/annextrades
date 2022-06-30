<!DOCTYPE html>
<html>
	<head>
		<title>2</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- jQuery core, needed for the lightboxes. Include if not already present. -->
		<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  Fancybox lightbox javascript, only needed if used, please note: it has been slightly modified for AJAX-ZOOM -->
		<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

		<!--  AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, 
		requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

		<!-- Enable fullscreen for IOS when dealing with iframes -->
		<script type="text/javascript" src="../axZm/axZm.iframe.js"></script>

		<!-- Colorbox plugin, only needed if used -->
		<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>
		<script type="text/javascript">Prism.plugins.NormalizeWhitespace.setDefaults({'remove-trailing': true, 'remove-indent': true, 'left-trim': true, 'right-trim': true, 'break-lines': 110});</script>

		<!-- These styles are all not needed! -->
		<style type="text/css" media="screen">
			h4 {
				margin-top: 25px;
			}
			h3 {
				margin-top: 35px;
			}
			@media (max-width: 991px) {
				.azOuterLayoutBack {
					height: 20px;
				}
				.azOuterLayoutBack > img{
					display: none;
				}
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
			<h1 class="page-header">AJAX-ZOOM "Lightbox" iFrame<br>examples</h1>
			<div class="row"> 
				<div class="col-md-12">
					<p>This example demonstrates how to display AJAX-ZOOM gallery which grabs and shows all images from a particular folder, 
						loads specified images from different folders or 360°/3D with some "lightboxes" (please click on the buttons above). 
						The content of the iframe in the lightboxes is simply the file example33_vario.php.
					</p>

					<p>Due to AJAX-ZOOM license issues the iFrame source should be from the same domain as source domain. 
						If you have legit reasons for crossdomain use, please contact AJAX-ZOOM support.
					</p>

					<p>Please note that not all lightboxes on internet support iframed content. 
						If you are going to use a different lightbox make sure to remove the scrollbars from the iframe.
					</p>

					<p>Press on the buttons below to open various 
						AJAX-ZOOM configurations as iframed content in a lightbox:
					</p>
				</div>

				<div class="col-md-12">
					<!-- Folders  -->
					<h3>Load all images from a directory with "zoomDir"</h3>
				</div>

				<div class="col-md-3">
					<h4>Fancybox - not responsive</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: 'example33_vario.php?zoomDir=estate&example=1&mNavi_enabled=0', type: 'iframe', autoScale: false, width: 754, height: 458, scrolling: 'no'})">Link gallery 1</a>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: 'example33_vario.php?zoomDir=animals&example=2mNavi_enabled=0', type: 'iframe', autoScale: false, width: 722, height: 530, scrolling: 'no'})">Link gallery 2</a>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: 'example33_vario.php?zoomDir=trasportation&example=3&mNavi_enabled=0', type: 'iframe', autoScale: false, width: 942, height: 458, scrolling: 'no'})">Link gallery 2</a>
				</div>
				<div class="col-md-3">
					<h4>Colorbox - not responsive</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: 'example33_vario.php?zoomDir=estate&example=1&mNavi_enabled=0', iframe: true, width: 804, height: 528, scrolling: false})">Link gallery 1</a>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: 'example33_vario.php?zoomDir=animals&example=2&mNavi_enabled=0', iframe: true, width: 772, height: 600, scrolling: false})">Link gallery 2</a>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: 'example33_vario.php?zoomDir=trasportation&example=3&mNavi_enabled=0', iframe: true, width: 992, height: 528, scrolling: false})">Link gallery 3</a>
				</div>
				<div class="col-md-3">
					<h4>Responsive Fancybox</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: 'example33_vario.php?zoomDir=estate&example=1&mNavi_enabled=0', iframe: true})">Example 1</a>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: 'example33_vario.php?zoomDir=animals&example=2&mNavi_enabled=0', iframe: true})">Example 2</a>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: 'example33_vario.php?zoomDir=trasportation&example=3&mNavi_enabled=0', iframe: true})">Example 3</a>
				</div>
				<div class="col-md-3 azOuterLayoutBack" style="max-height: 230px">
					<img src="https://www.ajax-zoom.com/pic/zoomp/zoom_shot_1.jpg" style="max-width: 100%; max-height: 100%">
				</div>

				<div class="col-md-12">
					<p>In the below code we simply write the onclick attribute inline. 
						Of course you can use <code>jQuery(selector).bind('click', function(){...})</code> in your applications. 
					</p>
					<div style="margin: 5px 0px 5px 0px;">
					<?php
					echo '<pre><code class="language-markup">';
					echo htmlspecialchars ('
<!-- Fancybox - not responsive -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: \'example33_vario.php?zoomDir=estate&example=1&mNavi_enabled=0\', type: \'iframe\', autoScale: false, width: 754, height: 458, scrolling: \'no\'})">Link gallery 1</a>

<!-- Colorbox - not responsive -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: \'example33_vario.php?zoomDir=estate&example=1&mNavi_enabled=0\', iframe: true, width: 804, height: 528, scrolling: false})">Link gallery 1</a>

<!-- Responsive Fancybox -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: \'example33_vario.php?zoomDir=estate&example=1&mNavi_enabled=0\', iframe: true})">Example 1</a>
					');
					echo '</code></pre>';
					?>
					</div>
				</div>

				<div class="col-md-12">
					<h3>Load specified images with "zoomData"</h3>
				</div>

				<!-- Specified images  -->
				<div class="col-md-3">
					<h4>Fancybox - not responsive</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: 'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg&example=1&mNavi_enabled=0', type: 'iframe', autoScale: false, width: 754, height: 458, scrolling: 'no'})">Link gallery 1</a>
				</div>
				<div class="col-md-3">
					<h4>Colorbox - not responsive</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: 'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg&example=1&mNavi_enabled=0', iframe: true, width: 804, height: 528, scrolling: false})">Link gallery 1</a>
				</div>
				<div class="col-md-3">
					<h4>Responsive Fancybox</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: 'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg', iframe: true})">Link gallery 1</a>
				</div>
				<div class="col-md-3">
				</div>

				<div class="col-md-12">
				<?php
				echo '<pre><code class="language-markup">';
				echo htmlspecialchars ('
<!-- Fancybox - not responsive -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: \'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg&example=1&mNavi_enabled=0\', type: \'iframe\', autoScale: false, width: 754, height: 458, scrolling: \'no\'})">Link gallery 1</a>

<!-- Colorbox - not responsive -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: \'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg&example=1&mNavi_enabled=0\', iframe: true, width: 804, height: 528, scrolling: false})">Link gallery 1</a>

<!-- Responsive Fancybox -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: \'example33_vario.php?zoomData=/pic/zoom/estate/house_01.jpg|/pic/zoom/animals/animals_001.jpg|/pic/zoom/furniture/furniture_002.jpg\', iframe: true})">Link gallery 1</a>
				');
				echo '</code></pre>';
				?>
				</div>

				<!-- 360 / 3D  -->
				<div class="col-md-12">
					<h3>Load 360 / 3D images with "3dDir"</h3>
				</div>

				<div class="col-md-3">
					<h4>Fancybox - not responsive</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: 'example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali&example=17&mNavi_enabled=0', type: 'iframe', autoScale: false, width: 602, height: 475, scrolling: 'no'})">360 example</a>
				</div>
				<div class="col-md-3">
					<h4>Colorbox - not responsive</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: 'example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali&example=17&mNavi_enabled=0', iframe: true, width: 644, height: 550, scrolling: false})">360 example</a>
				</div>
				<div class="col-md-3">
					<h4>Responsive Fancybox</h4>
					<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: 'example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali', iframe: true})">360 example</a>
				</div>
				<div class="col-md-3">
				</div>

				<div class="col-md-12">
					<div style="clear:both; margin: 5px 0px 5px 0px;">
						<?php
						echo '<pre><code class="language-markup">';
						echo htmlspecialchars ('
<!-- Fancybox - not responsive -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.fancybox({href: \example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali&example=17&mNavi_enabled=0\', type: \'iframe\', autoScale: false, width: 602, height: 475, scrolling: \'no\'})">360 example</a>

<!-- Colorbox - not responsive -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.colorbox({href: \'example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali&example=17&mNavi_enabled=0\', iframe: true, width: 644, height: 550, scrolling: false})">360 example</a>

<!-- Responsive Fancybox -->
<a class="btn btn-info btn-block" href="javascript:void(0)" onclick="jQuery.openAjaxZoomInFancyBox({href: \'example33_vario.php?3dDir=/pic/zoom3d/Uvex_Occhiali\', iframe: true})">360 example</a>
						');
						echo '</code></pre>';
						?>
					</div>
				</div>

				<div class="col-md-12">
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