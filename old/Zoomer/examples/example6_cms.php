<!DOCTYPE html>
<html>
	<head>
		<title>6_cms</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed! -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- jQuery core, needed if not present! -->
		<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM core, needed if openMode is not iframe! -->
		<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!-- Enable fullscreen for IOS if openMode is iframe (replace) -->
		<script type="text/javascript" src="../axZm/axZm.iframe.js"></script>

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
			.clearfix:before, .clearfix:after {content: ""; display: table;}
			.clearfix:after {clear:both;}
			.clearfix {zoom:1;}

			body {
				background: #f1f1f1 none repeat scroll 0 0;
			}

			.az_container {
				overflow: hidden;
				margin: 0 auto;
				margin-top: 30px;
				max-width: 1200px;
				min-width: 320px;
				background: #f1f1f1 none repeat scroll 0 0;
			}

			.column_right {
				float: right;
				background-color: #FFF;
				padding-bottom: 99999px;
				margin-bottom: -99999px;
				width: 66%;
			}

			.column_right_inner {
				padding: 0 20px 20px 20px;
			}

			.column_left {
				float: left;
				background-color: #FFF;
				padding-bottom: 99999px;
				margin-bottom: -99999px;
				width: 31%;
			}

			.column_left_inner {
				padding: 0px 20px 20px 40px;
			}

			.head_text {
				padding: 0 10px 0 10px; 
				background-color: #AAA;
				color: #FFF;
				margin-bottom: 20px;
			}

			.demo_table>tbody>tr>td {
				padding-bottom: 5px;
				vertical-align: top;
			}

			@media only screen and (max-width: 800px) {
				.az_container {width: 100%; margin-top: 0;}
				.column_right {width: 100%;}
				.column_right_inner {padding: 0 10px 10px 10px;}
				.column_left {width: 100%;}
				.column_left_inner {padding: 0 10px 10px 10px;}
				.head_text {background-color: transparent; color: inherit;}
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

		<div class="az_container">

			<div class="column_left">
				<div class="column_left_inner">
					<h3>About</h3>
					<p>Suppose you have some sort of two or more column responsive layout where main content width is responsive too.
						This is a typical case for modern CMS themes like WordPress. 
						The layout here is exemplary - do it better :-)
					</p>
					<p>Anyway, now you want to place 
						high resolution images between text. AJAX-ZOOM is a perfect tool to do that. 
					</p>
					<p>You can place an unlimited number of images with a nice adjustable and styleable hover effect,
						then on click show real high resolution images in a various ways - at fullscreen mode, in responsive fancybox, 
						simple static lightbox or simply replace the image with AJAX-ZOOM progressive zoom player. 
						With the <code>data-group</code> attribute images can be grouped to build a gallery which is preserved 
						in AJAX-ZOOM player.
					</p>

					<h3>Compatibility</h3>
					<p>Provided that other scripts and CSS on your page support old IE, 
						you can use this setup even on IE 7.
					</p>

					<h3>Try various AJAX-ZOOM open mods</h3>
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
							$('.azHoverThumbImgWrap').data(opt, val);
						};
					</script>

					<table cellpadding="0" cellspacing="0" class="demo_table">
						<tbody>
							<tr>
								<td width="30"><input type="radio" autocomplete="off"  name="ajaxZoomOpenMode" onclick="setOpt('ajaxZoomOpenMode')" value="fullscreen" checked></td>
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
								<td><input type="radio" autocomplete="off"  name="ajaxZoomOpenMode" onclick="setOpt('ajaxZoomOpenMode')" value="iframe"></td>
								<td><span style="color: red; font-weight: bold;">New:</span> replace image with AJAX-ZOOM player</td>
							</tr>
							<tr>
								<td colspan="2">
									Enable monitor size fullscreen: <br />
									<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="true"> - enable 
									<input type="radio" autocomplete="off"  name="fullScreenApi" onclick="setOpt('fullScreenApi')" value="false" checked> - disable
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="column_right">
				<div class="head_text clearfix">
					<h2>AJAX-ZOOM - responsive image hover zoom (gallery) effect + fullscreen progressive zoom on click</h2>
				</div>
				<div class="column_right_inner">

					<p>Below is the actual demo of the images. Click on the images to open high resolution image
						in AJAX-ZOOM player. You can switch the way AJAX-ZOOM is opened by changing the "open mods" 
						radio boxes. In your implementation you would simply statically set them over $.azHoverThumb extension 
						"ajaxZoomOpenMode" option. (Texts are taken from Wikipedia, we want to pretend some real content here...)
					</p>

					<!--googleoff: index-->
					<h3>BMW 327 Cabriolet</h3>
					<img class="azHoverThumb" data-group="cars1" data-descr="BMW 327 Cabriolet" data-img="/pic/zoom/trasportation/transportation_001.jpg" src="../axZm/zoomLoad.php?azImg=/pic/zoom/trasportation/transportation_001.jpg&qual=70&width=960&height=960" alt="" />

					<p style="margin-top: 0;">The first 327, launched in 1937, was a cabriolet. In 1938, this was joined by a fixed head coupé version. The car was shorter and lower than its sedan counterpart, 
						but shared the famous BMW grill and a streamlined form representative of the more progressive designs of the 1930s.
					</p>
					
					<p>During the 1930s, Eisenach was the centre of BMW’s automobile manufacturing. 
						In 1945, Eisenach was occupied by United States forces. 
						However, the wartime allies had already agreed that Thuringia would fall within the Soviet occupation zone. 
						BMW's automobile factory in Eisenach was not fully destroyed, and assembly of the 327 resumed. 
						Clear production figures are hard to obtain, but many of the 327s surviving with collectors into the twenty-first 
						century were post-war products. After the war, it became clear that the Soviets would not return the Eisenach factory to BMW.
					</p>
					<p>BMW-branded automobiles produced between 1946 and 1951 were therefore being produced outside the control of BMW 
						headquarters in Munich. This cause a protracted dispute concerning title to the BMW brand and other assets, 
						but in 1952 it was determined that Eisenach-produced models such as the 327s should be badged as EMW 
						(Eisenacher Motoren Werke) rather than as BMW (Bayerische Motoren Werke). 
						EMW changed their badge from BMW's blue and white roundel to a red and white roundel.
					</p>

					<h3>Jaguar MK II 340</h3>
					<img class="azHoverThumb" data-group="cars1" data-descr="Jaguar MK II 340" data-img="/pic/zoom/trasportation/transportation_002.jpg" src="../axZm/zoomLoad.php?azImg=/pic/zoom/trasportation/transportation_002.jpg&qual=70&width=960&height=960" alt="" />

					<p>The Jaguar Mark 2 is a medium-sized saloon car built from late 1959 to 1967 by Jaguar in Coventry, England. 
						Twelve months before the announcement of the XJ6 the 2.4 Litre and 3.4 Litre Mark 2 models were renamed to Jaguar 240 
						and Jaguar 340 respectively. The previous Jaguar 2.4 Litre and 3.4 Litre models made between 1955 and 1959 have 
						been identified as Mark 1 Jaguars since Jaguar produced this Mark 2 model.
						Until the XJ, Jaguar's postwar saloons were usually denoted by Roman numerals 
						(e.g. Mark VII, Mark VIII) while the Mark 2 used Arabic Numerals, denoted on the rear of the car as "MK 2".
					</p>

					<p>In September 1967 the 2.4 Litre and 3.4 Litre Mark 2 cars were rebadged as the 240 and 340 respectively. 
						The 3.8 Litre model was discontinued. The 240 and 340 were interim models intended to fill the gap until 
						the introduction of the XJ6 in September 1968. The 340 was discontinued on the introduction of the XJ6 but the 240 continued 
						as a budget priced model until April 1969; its price of £1364 was only £20 more than the first 2.4 in 1956.
					</p>
					<p>Output of the 240 engine was increased from 120 bhp (89 kW; 120 PS) @ 5,750 r.p.m. 
						to 133 bhp (99 kW; 135 PS) @ 5,500 r.p.m. and torque was increased. 
						It now had a straight-port type cylinder head and twin HS6 SU carburettors with a new inlet manifold. 
						The automatic transmission was upgraded to a Borg-Warner 35 dual drive range. 
						Power steering by Marles Varamatic was now available on the 340. 
						Servicing intervals were increased from 2,000 miles to 3,000 miles. 
						There was a slight reshaping of the rear body and slimmer bumpers and over-riders were fitted. 
						For the first time the 2.4 litre model could exceed 100 mph, resulting in a slight sales resurgence.
					</p>
					<p>
						The economies of the new 240 and 340 models came at a cost – the leather upholstery was replaced by 
						Ambla leather-like material and tufted carpet was used on the floor—though both had been introduced on the 
						Mark 2 a year earlier. Other changes included the replacement of the front fog lamps with circular vents and 
						optional fog lamps for the UK market. The sales price was reduced to compete with the Rover 2000 TC.
					</p>

					<h3>Alfa Romeo Bertone Giulia Sprint GT</h3>
					<img class="azHoverThumb" data-group="cars1" data-descr="Alfa Romeo Bertone Giulia Sprint GT" data-img="/pic/zoom/trasportation/transportation_004.jpg" src="../axZm/zoomLoad.php?azImg=/pic/zoom/trasportation/transportation_004.jpg&qual=70&width=960&height=960" alt="" />

					<p style="margin-top: 0;">The Alfa Romeo 105/115 series Coupés were a range of cars made by the Italian manufacturer 
						Alfa Romeo from 1963 until 1977. They were the successors to the celebrated Giulietta Sprint coupé 
						and used a shortened floorpan from the Giulia Berlina car.
					</p>
					<p>The Alfa Romeo Giulia Sprint GT was the first model introduced, and was manufactured from 1963 to 1966. 
						It featured the original form of the Bertone body with the scalino (stepped) or "step front" 
						(the leading edge of the hood/bonnet sat 1/4 an inch above the nose of the car). 
						It can be most easily distinguished from other models by the following features:
					</p>
					<ul>
						<li>Badging: chrome script reading "Giulia Sprint GT" on bootlid, one round Alfa Romeo badge on the grille heart, Bertone badges behind the front wheelarches.</li>
						<li> Flat, chrome grille featuring a plain rectangular mesh with no bars.</li>
						<li> Single-piece chrome bumpers</li>
						<li> Dashboard with a flat, tilted panel finished in grey crackle.</li>
					</ul>
					<p>The car was fitted with the 1570 cc displacement version of the engine 
						(78 mm bore × 82 mm stroke, 6.38 L oil sump, 7.41 L radiator). 
						Dunlop disc brakes were fitted all around. The rear brakes featured an unusual arrangement 
						with the slave cylinders mounted on the axle tubes, operating the calipers by a system of levers and cranks. 
						31,955 Sprint GTs were produced.
					</p>

					<h3>Rolls-Royce Silver Dawn </h3>
					<img class="azHoverThumb" data-group="cars1" data-descr="Rolls-Royce Silver Dawn" data-img="/pic/zoom/trasportation/transportation_005.jpg" src="../axZm/zoomLoad.php?azImg=/pic/zoom/trasportation/transportation_005.jpg&qual=70&width=960&height=960" alt="" />

					<p>The Rolls-Royce Silver Dawn is a car that was produced by Rolls-Royce at their Crewe works between 1949 and 1955. 
						It was the first Rolls-Royce car to be offered with a factory built body which it shared, along with its chassis, 
						with the Bentley Mark VI until 1952 and then the Bentley R Type until production finished in 1955. 
						The car was first introduced as an export only model. The left hand drive models had a column gear change, 
						while right hand drives had a floor change by the door. 
						Only with the R Type based model was it officially available on the home market, from October 1953.
					</p>
					<p>A mere 760 were produced between 1949 and 1955. 
						Earlier models up to circa May 1954 had a different fascia (dashboard) from the Bentley Mk.VI and 'R' Type, 
						and were fitted with a single exhaust system. Later models from the SRH chassis series had the Bentley 
						style fascia and the twin exhaust system, as fitted to the Bentley 'R' Type. 
						On the Standard Steel cars throughout the production history, all the body panels forward of the 
						bulkhead/firewall were slightly different from those fitted to the Bentley.
					</p>
					<!--googleon: index-->

					<h3>JavaScript & CSS files in Head</h3>
					<div style="clear:both; margin: 5px 0px 5px 0px;">
						<?php
						echo '<pre class="brush: html; js;"><code class="language-markup">';
						echo htmlspecialchars ('
<!-- jQuery core, needed if not already present! -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed if openMode is not iframe! -->
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!-- AJAX-ZOOM thumbGallery extension, needed! -->
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.hoverThumb.css" type="text/css">
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.hoverThumb.js"></script>

<!-- Fancybox lightbox javascript, please note: it has been slightly modified for AJAX-ZOOM, only needed if ajaxZoomOpenMode below is set to "fancyboxFullscreen" or "fancybox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.js"></script>

<!-- AJAX-ZOOM extension to load AJAX-ZOOM into maximized fancybox, requires jquery.fancybox-1.3.4.css and jquery.fancybox-1.3.4.js, optional -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js"></script>

<!-- Colorbox plugin, only needed if ajaxZoomOpenMode below is set to "colorbox", optional -->
<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>

						');
						echo '</code></pre>';
						?>
					</div>

					<h3>HTML makup in body</h3>
					<div style="clear:both; margin: 5px 0px 5px 0px;">
						<?php
						echo '<pre><code class="language-markup">';
						echo htmlspecialchars ('
<!-- Only img tag is required, data-group for grouping images into gallery, data-img is the source of the original high resolution image and data-descr is the optional description -->

<img class="azHoverThumb" data-group="cars1" data-descr="Jaguar MK II 340" data-img="/pic/zoom/trasportation/transportation_010.jpg" src="/path/to/preview/image/transportation_010_small.jpg" alt="" />

<img class="azHoverThumb" data-group="cars1" data-descr="Alfa Romeo Bertone Giulia Sprint GT" data-img="/pic/zoom/trasportation/transportation_011.jpg" src="/path/to/preview/image/transportation_011_small.jpg&height=960" alt="" />
						');
						echo '</code></pre>';
						?>
					</div>

					<h3>JavaScript</h3>
					<div style="clear:both; margin: 5px 0px 5px 0px;">
						<?php
						echo '<pre><code class="language-js">';
						echo htmlspecialchars ('
// Fire azHoverThumb on all images which have class .azHoverThumb 
$(".azHoverThumb").azHoverThumb({
	instantWrapClass: "azHoverThumbImgWrap",
	zoomRatio: 1.1,
	parentHeightRatio: "auto"
});
						');
						echo '</code></pre>';
						?>

					</div>

					<h3>$.azHoverThumb - documentation (options)</h3>
					<div>
						<?php include (dirname(__FILE__).'/extensions_doc/docu_hoverThumb.inc.html');?>
					</div>
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

		<script type="text/javascript">
			// Fire azHoverThumb on all images which have class .azHoverThumb
			$(".azHoverThumb").azHoverThumb({
				instantWrapClass: "azHoverThumbImgWrap",
				zoomRatio: 1.2,
				parentHeightRatio: "auto"
			});
		</script>

	</body>
</html>