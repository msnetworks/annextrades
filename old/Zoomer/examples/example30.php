<!DOCTYPE html>
<html>
	<head>
		<title>30</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not really needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!--  AJAX-ZOOM javascript and CSS, adjust the path if needed. Best set absolute path -->
		<link  href="../axZm/axZm.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Javascript to style the syntax, not needed! -->
		<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
		<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

	</head>
	<body>
		<?php
		if (file_exists(dirname(__FILE__).'/navi.php')) {
			// This is only for the demo, you can remove it
			include dirname(__FILE__).'/navi.php';
		}
		?>

		<div class="container">
			<h1 class="page-header">Short example about how to open AJAX-ZOOM as fullscreen</h1>
			<p>This example describes $.fn.axZm.openFullScreen which 
				is needed to open AJAX-ZOOM as fullscreen from a link or bind 
				to click event within JS.
			</p>
			<br><br>

			<a href="javascript:void(0)" class="btn btn-block btn-info" onclick="jQuery.fn.axZm.openFullScreen('../axZm/', 'example=23&zoomData=/pic/zoom/boutique/boutique_001.jpg|/pic/zoom/boutique/boutique_002.jpg|/pic/zoom/boutique/boutique_003.jpg|/pic/zoom/boutique/boutique_004.jpg|/pic/zoom/boutique/boutique_005.jpg|/pic/zoom/boutique/boutique_006.jpg|/pic/zoom/boutique/boutique_007.jpg|/pic/zoom/boutique/boutique_008.jpg|/pic/zoom/fashion/fashion_002.jpg|/pic/zoom/fashion/fashion_005.jpg', {}, 'window', true);">
				Open <b>regular images</b> as monitor size fullscreen (not IE < 10)
			</a><br>

			<a href="javascript:void(0)" class="btn btn-block btn-info" onclick="jQuery.fn.axZm.openFullScreen('../axZm/', 'example=17&3dDir=/pic/zoom3d/Uvex_Occhiali', {onLoad: function(){jQuery.axZm.spinReverse = true;}}, 'window', true);">
				Open <b>360</b> as monitor size fullscreen (not IE < 10)
			</a><br>

			<a href="javascript:void(0)" class="btn btn-block btn-info" onclick="jQuery.fn.axZm.openFullScreen('../axZm/', 'example=23&zoomData=/pic/zoom/boutique/boutique_001.jpg|/pic/zoom/boutique/boutique_002.jpg|/pic/zoom/boutique/boutique_003.jpg|/pic/zoom/boutique/boutique_004.jpg|/pic/zoom/boutique/boutique_005.jpg|/pic/zoom/boutique/boutique_006.jpg|/pic/zoom/boutique/boutique_007.jpg|/pic/zoom/boutique/boutique_008.jpg|/pic/zoom/fashion/fashion_002.jpg|/pic/zoom/fashion/fashion_005.jpg', {}, 'window', false, false);">
				Open <b>regular images</b> as window fullscreen
			</a><br>

			<a href="javascript:void(0)" class="btn btn-block btn-info" onclick="jQuery.fn.axZm.openFullScreen('../axZm/', 'example=17&3dDir=/pic/zoom3d/Uvex_Occhiali', {onLoad: function(){jQuery.axZm.spinReverse = true;}}, 'window', false, false);">
				Open <b>360</b> as as window fullscreen
			</a><br>


			<h3>Javascript and CSS files in head section</h3>
			<?php
			// This is only syntax highlighting, not needed
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<!--  Include jQuery core into head section if not already present -->
				<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

				<!--  AJAX-ZOOM javascript and CSS, adjust the path if needed. Best set absolute path -->
				<link  href="../axZm/axZm.css" rel="stylesheet" type="text/css">
				<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
			');
			echo "</code></pre>";
			?>

			<h3>HTML</h3>
			<?php
			echo '<pre><code class="language-markup">';
			echo htmlspecialchars ('
				<a href="javascript:void(0)" onClick="jQuery.fn.axZm.openFullScreen(\'../axZm/\', \'example=23&zoomData=/pic/zoom/boutique/test_boutique1.png|/pic/zoom/boutique/test_boutique2.png|/pic/zoom/boutique/test_boutique3.png|/pic/zoom/boutique/test_boutique4.png\', {}, \'window\', true);">
				Open regular images as monitor size fullscreen
				</a>

				<a href="javascript:void(0)" onClick="jQuery.fn.axZm.openFullScreen(\'../axZm/\', \'example=17&3dDir=/pic/zoom3d/Uvex_Occhiali\', {}, \'window\', true);">
				Open 360 as monitor size fullscreen
				</a>

				<a href="javascript:void(0)" onClick="jQuery.fn.axZm.openFullScreen(\'../axZm/\', \'example=23&zoomData=/pic/zoom/boutique/test_boutique1.png|/pic/zoom/boutique/test_boutique2.png|/pic/zoom/boutique/test_boutique3.png|/pic/zoom/boutique/test_boutique4.png\', {}, \'window\', false, false);">
				Open regular images as window fullscreen
				</a>

				<a href="javascript:void(0)" onClick="jQuery.fn.axZm.openFullScreen(\'../axZm/\', \'example=17&3dDir=/pic/zoom3d/Uvex_Occhiali\', {}, \'window\', false, false);">
				Open 360 as window fullscreen
				</a>
			');
			echo "</code></pre>";
			?>

			<p>Here ist the API reference for <a href="https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen">jQuery.fn.axZm.openFullScreen</a>
			</p>
			<p>"zoomData" is not the only parameter that can be set to define which images to display in the player. 
				<a href="https://www.ajax-zoom.com/examples/example27.php">example27.php</a> can serve as tutorial for other methods.
			</p>
			<p>Please note, that by defining the query string parameter example=23 some default settings from /axZm/zoomConfig.inc.php 
				are overridden in /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 23){ 
				So if changes in /axZm/zoomConfig.inc.php have no effect look for the same options /axZm/zoomConfigCustom.inc.php;
			</p>
			<p>Thus in /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 23){ you could for example set:
			</p>
			<ul>
				<li>$zoom['config']['useHorGallery'] - enable / disable horizontal gallery.</li>
				<li>$zoom['config']['useGallery'] - enable / disable vertical gallery.</li>
				<li>$zoom['config']['displayNavi'] - enable / disable navigation bar.</li>
				<li>and many others...</li>
			</ul>

			<?php
			if (file_exists(dirname(__FILE__).'/footer.php')) {
				// This is only for the demo, you can remove it
				define('COMMENTS_BOOTSTRAP', true);
				include dirname(__FILE__).'/footer.php';
			}
			?>
		</div>
	</body>
</html>