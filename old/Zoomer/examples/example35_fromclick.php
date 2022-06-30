<!DOCTYPE html>
<html>
	<head>
		<title>35_fromclick</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- Include jQuery core into head section if not already present -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM core files, needed -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Include axZm.thumbSlider plugin, needed -->
		<link rel="stylesheet" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" type="text/css" />
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>

		<!-- Include jquery.axZm.imageCropLoad.js, needed -->
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>

		<!-- A small function to add title button which will expend to full description, depends -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.expButton.css" type="text/css" />
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>

		<!-- Extension to open the product tour at fullscreen -->
		<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.imageCropLoadFullscreen.css" type="text/css" />
		<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoadFullscreen.js"></script>

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
			<h1 class="page-header">Open the AJAX-ZOOM 2D or 360-images product tour as fullscreen from click</h1>
			<p>Use the <a href="/examples/example35.php">product tour editor</a> to create the tours. 
				This example needs the output code of what you have created in the <a href="/examples/example35.php">editor</a>. 
				The cropLoadObj.cropJsonURL can be URL to the JSON file, or it can be the JSON itself.
			</p>

<a id="link1" href="javascript:void(0)" class="btn btn-block btn-info" style="margin-bottom: 15px;">
	1. Open 360 product tour as full screen from a link using <code>imageCropLoadFullscreen</code> plugin
</a>

			<script type="text/javascript" id="exampleJs1">
				jQuery('#link1')
				.imageCropLoadFullscreen({
					installPath: '../axZm/',
					parameter: '3dDir=../pic/zoom3d/Uvex_Occhiali',
					example: 'spinIpad',
					apiFullscreen: false,
					cropLoadObj: {
						cropJsonURL: '../pic/cropJSON/eos_1100d_demo.json'
					}
				});
			</script>

			<div style="margin-bottom: 50px">
				<pre><code class="language-html" id="link1HTML"></code></pre>
				<pre><code class="language-js" id="link1Code"></code></pre>
				<script type="text/javascript">jQuery('#link1HTML').text(jQuery('#link1')[0].outerHTML);</script>
				<script type="text/javascript">jQuery('#link1Code').text(jQuery('#exampleJs1').html());</script>
			</div>

<a id="link2" href="javascript:void(0)" class="btn btn-block btn-info" style="margin-bottom: 15px;">
	2. Open 360 product tour as full screen and additionally init hotspots
</a>

			<script type="text/javascript" id="exampleJs2">
				jQuery('#link2')
				.imageCropLoadFullscreen({
					installPath: '../axZm/',
					parameter: '3dDir=../pic/zoom3d/Uvex_Occhiali',
					example: 'spinIpad',
					apiFullscreen: false,
					hotspots: '../pic/hotspotJS/eos_1100D.js',
					cropLoadObj: {
						cropJsonURL: '../pic/cropJSON/eos_1100d_demo.json'
					}
				});
			</script>

			<div style="margin-bottom: 50px">
				<pre><code class="language-html" id="link2HTML"></code></pre>
				<pre><code class="language-js" id="link2Code"></code></pre>
				<script type="text/javascript">jQuery('#link2HTML').text(jQuery('#link2')[0].outerHTML);</script>
				<script type="text/javascript">jQuery('#link2Code').text(jQuery('#exampleJs2').html());</script>
			</div>

<a id="link3" href="javascript:void(0)" class="btn btn-block btn-info" style="margin-bottom: 15px;">
	3. Open 360 product tour in "overlay slider"
</a>

			<script type="text/javascript" id="exampleJs3">
				jQuery('#link3')
				.imageCropLoadFullscreen({
					installPath: '../axZm/',
					parameter: '3dDir=../pic/zoom3d/Uvex_Occhiali',
					example: 'spinIpad',
					apiFullscreen: false,
					cropSliderOverlay: true,
					cropSliderPosition: 'left',
					cropSliderOverlayToggle: true,
					cropSliderDimension: 86,
					cropLoadObj: {
						cropJsonURL: '../pic/cropJSON/eos_1100d_demo.json'
					}
				});
			</script>

			<div style="margin-bottom: 50px">
				<pre><code class="language-html" id="link3HTML"></code></pre>
				<pre><code class="language-js" id="link3Code"></code></pre>
				<script type="text/javascript">jQuery('#link3HTML').text(jQuery('#link3')[0].outerHTML);</script>
				<script type="text/javascript">jQuery('#link3Code').text(jQuery('#exampleJs3').html());</script>
			</div>

<a id="link4" href="javascript:void(0)" class="btn btn-block btn-info" style="margin-bottom: 15px;">
	4. apiFullscreen test
</a>

			<script type="text/javascript" id="exampleJs4">
				jQuery('#link4')
				.imageCropLoadFullscreen({
					installPath: '../axZm/',
					parameter: '3dDir=../pic/zoom3d/Uvex_Occhiali',
					example: 'spinIpad',
					apiFullscreen: true,
					cropLoadObj: {
						cropJsonURL: '../pic/cropJSON/eos_1100d_demo.json'
					}
				});
			</script>

			<div style="margin-bottom: 50px">
				<pre><code class="language-html" id="link4HTML"></code></pre>
				<pre><code class="language-js" id="link4Code"></code></pre>
				<script type="text/javascript">jQuery('#link4HTML').text(jQuery('#link4')[0].outerHTML);</script>
				<script type="text/javascript">jQuery('#link4Code').text(jQuery('#exampleJs4').html());</script>
			</div>

			<div>
				<?php
				if (file_exists(dirname(__FILE__).'/footer.php')) {
					// This is only for the demo, you can remove it
					define('COMMENTS_BOOTSTRAP', true);
					include dirname(__FILE__).'/footer.php';
				}
				?>
			</div>

		</div>
	</body>
</html>