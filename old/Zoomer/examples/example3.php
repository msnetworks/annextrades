<!DOCTYPE html>
<html>
	<head>
		<title>3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Bootstrap is not needed -->
		<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

		<!-- jQuery core, needed for the lightboxes. Include if not already present. -->
		<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

		<!-- AJAX-ZOOM core, needed! -->
		<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

		<!--  Fancybox lightbox javascript, only needed if used, please note: it has been slightly modified for AJAX-ZOOM -->
		<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
		<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

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

		<script type="text/javascript" id="exampleJs">
			jQuery(document).ready(function() {

				// Bind Colorbox to all elements with class ajaxExampleColorbox
				jQuery(".ajaxExampleColorbox")
				.colorbox({
					initialWidth: 300,
					initialHeight: 300,
					scrolling: false,
					scrollbars: false,
					preloading: false,
					opacity: 0.95,
					// this option has been added by ajax-zoom to enforce loading href as url and not image
					ajax: true, 
					onClosed: function() {
						jQuery.fn.axZm.spinStop();
					},
					onComplete: function() {
						// Trigger AJAX-ZOOM after loading
						jQuery.fn.axZm();
					}
				});

				// Bind Fancybox to all elements with class ajaxExampleFancybox
				jQuery(".ajaxExampleFancybox")
				.fancybox({
					padding: 0,
					overlayShow: true,
					overlayOpacity: 0.9,
					zoomSpeedIn: 0,
					zoomSpeedOut: 100,
					easingIn: "swing",
					easingOut: "swing",
					hideOnContentClick: false,
					centerOnScroll: false,
					onComplete: function() {
						jQuery.fn.axZm(); // Important callback after loading
					},
					onClosed: function() {
						jQuery.fn.axZm.spinStop();
					},
					// fancybox ver.2.x options in case fancybox 2.x is used
					type: "ajax", // 
					afterLoad: function(a) {
						// Need to trigger delayed
						setTimeout(function() {
							jQuery.fn.axZm();
						}, 1)
					},
					beforeClose: function() {
						jQuery.fn.axZm.spinStop();
					}
				});
			});
		</script>

	</head>
	<body>
		<?php
		// This include is just for the demo, you can remove it
		if (file_exists(dirname(__FILE__).'/navi.php')) {
			include dirname(__FILE__).'/navi.php';
		}
		?>

		<div class="container">
			<h1 class="page-header">AJAX-ZOOM "Lightbox", examples with AJAX content</h1>
			<div class="row">
				<div class="col-md-12">
					<p>This example demonstrates how to open multiple zoom galleries with some lightbox clones (please click on the links above).
						The content is loaded via Ajax requests. 
						This solution does not work "cross domain". 
						Please also note, that not all lightbox clones fully support ajax content.
					</p>
					<p>When you have jpg or png in href of the link, which is the case when using zoomData and passing image paths directly without any encoding, 
						most lightboxes consider it as a direct link to the image file and do not trigger the request to the url via ajax. 
						<span style="text-decoration: underline">The here used and in the download package included lightboxes (Fancybox & Colorbox) have been slightly modified to load the url and not 
						"mistakenly" consider it to be an image...</span>
					</p>
					<p>Press on the buttons below to open various AJAX-ZOOM configurations in a lightbox as AJAX loaded content:
					</p>
				</div>

				<div class="col-md-12">
					<!-- Folders  -->
					<h3>Load all images from a directory with "zoomDir"</h3>
				</div>

				<div class="col-md-3">
					<h4>Fancybox - not responsive</h4>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=/pic/zoom/estate&example=4'>Example 1</a>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=/pic/zoom/animals&zoomID=4&example=5'>Example 2</a>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=/pic/zoom/trasportation&example=6'>Example 3</a>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=high_res&zoomID=3&example=5'>Example 4</a>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=world&zoomID=16&example=7'>Example 5</a>
				</div>
				<div class="col-md-3">
					<h4>Colorbox - not responsive</h4>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=/pic/zoom/estate&example=4'>Example 1</a>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=/pic/zoom/animals&zoomID=4&example=5'>Example 2</a>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=/pic/zoom/trasportation&example=6'>Example 3</a>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=high_res&zoomID=3&example=5'>Example 4</a>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&zoomDir=world&zoomID=16&example=7'>Example 5</a>
				</div>
				<div class="col-md-3">
					<h4>Responsive Fancybox</h4>
					<a class="btn btn-primary btn-block" href="example27.php">See example27.php</a>
				</div>
				<div class="col-md-3 azOuterLayoutBack" style="max-height: 230px">
					<img src="https://www.ajax-zoom.com/pic/zoomp/zoom_shot_1.jpg" style="max-width: 100%; max-height: 100%">
				</div>

				<div class="col-md-12">
					<!-- Specified images -->
					<h3>Load specified images with "zoomData"</h3>
				</div>
				<div class="col-md-3">
					<h4>Fancybox - not responsive</h4>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=4&zoomData=/pic/zoom/animals/animals_011.jpg|/pic/zoom/animals/animals_012.jpg|/pic/zoom/animals/animals_001.jpg'>Example 6</a>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=7&zoomData=/pic/zoom/animals/animals_011.jpg|/pic/zoom/animals/animals_012.jpg|/pic/zoom/animals/animals_001.jpg'>Example 7</a>
				</div>
				<div class="col-md-3">
					<h4>Colorbox - not responsive</h4>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=4&zoomData=/pic/zoom/animals/animals_011.jpg|/pic/zoom/animals/animals_012.jpg|/pic/zoom/animals/animals_001.jpg'>Example 6</a>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=7&zoomData=/pic/zoom/animals/animals_011.jpg|/pic/zoom/animals/animals_012.jpg|/pic/zoom/animals/animals_001.jpg'>Example 7</a>
				</div>
				<div class="col-md-3">
					<h4>Responsive Fancybox</h4>
					<a class="btn  btn-primary btn-block" href="example27.php">See example27.php</a>
				</div>
				<div class="col-md-3"></div>

				<div class="col-md-12">
					<!-- 360 / 3D  -->
					<h3>Load 360 / 3D images with "3dDir"</h3>
				</div>
				<div class="col-md-3">
					<h4>Fancybox - not responsive</h4>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=17&3dDir=/pic/zoom3d/Uvex_Occhiali'>360 Example</a>
					<a class='btn btn-info btn-block ajaxExampleFancybox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=17&3dDir=/pic/zoomVR/nike'>3D Example</a>
				</div>
				<div class="col-md-3">
					<h4>Colorbox - not responsive</h4>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=17&3dDir=/pic/zoom3d/Uvex_Occhiali'>360 Example</a>
					<a class='btn btn-info btn-block ajaxExampleColorbox' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=17&3dDir=/pic/zoomVR/nike'>3D Example</a>
				</div>
				<div class="col-md-3">
					<h4>Responsive Fancybox</h4>
					<a class="btn  btn-primary btn-block" href="example27.php">See example27.php</a>
				</div>
				<div class="col-md-3"></div>

				<div class="col-md-12">
					<h3>Load specified images with zoomData and play with descriptions</h3>
					<p>For this type of descriptions some additional JS code is passed over AJAX-ZOOM callbacks. 
						The code creates an empty div element in the "onLoad" AJAX-ZOOM callback and appends it after the player. 
						Title and descriptions are defined in a separate JS object for each image and appended to the created 
						div element over "onImageChange" AJAX-ZOOM callback which is triggered whenever the image changes. 
						All the AJAX-ZOOM callbacks are passed to AJAX-ZOOM when it is initialized with jQuery.fn.axZm(); 
						you will find the code commented in the source of this file right after the buttons below.
					</p>
					<p>For custom description handling see also <a href="example25.php">example25.php</a>
					</p>
				</div>
				<div class="col-md-3">
					<h4>Fancybox</h4>
					Todo
				</div>
				<div class="col-md-3">
					<h4>Colorbox</h4>
					<a class='btn btn-info btn-block ajaxExampleColorboxDesc' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=4&zoomData=/pic/zoom/animals/animals_001.jpg|/pic/zoom/animals/animals_002.jpg|/pic/zoom/animals/animals_003.jpg'>Example 8</a>
					<a class='btn btn-info btn-block ajaxExampleColorboxDesc' href='../axZm/zoomLoad.php?zoomLoadAjax=1&example=7&zoomData=/pic/zoom/animals/animals_001.jpg|/pic/zoom/animals/animals_002.jpg|/pic/zoom/animals/animals_003.jpg'>Example 9</a>
				</div>
				<div class="col-md-3">
					<h4>Responsive Fancybox</h4>
					Todo
				</div>
				<div class="col-md-3"></div>

				<!-- This additional JS is only needed for ajaxExampleColorboxDesc where we append descriptions to the lightbox after the player-->	
				<script type="text/javascript">
					// JS objects to store descriptions and titles
					var testTitle = {}; // Object with titles
					var testDescr = {}; // Object with longer descriptions
					var thumbTitle = {}; // Object with thumb descriptions

					testTitle["animals_001.jpg"] = "Description animals 1";
					testDescr["animals_001.jpg"] = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.";
					thumbTitle["animals_001.jpg"] = "animals 1";

					testTitle["animals_002.jpg"] = "Description animals 2";
					testDescr["animals_002.jpg"] = "At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.";
					thumbTitle["animals_002.jpg"] = "animals 2";

					testTitle["animals_003.jpg"] = "Description animals 3";
					testDescr["animals_003.jpg"] = "Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.";
					thumbTitle["animals_003.jpg"] = "animals 3";

					// Simple function to put descriptions in a div with fade effect
					var ajaxZoomAnimateDescr = function(title, descr) {
						jQuery("#testTitleDiv").fadeTo(300, 0, function() {
							jQuery(this).empty().html(title).fadeTo(300, 1);
						});

						jQuery("#testDescrDiv").fadeTo(300,0, function() {
							jQuery(this).empty().html(descr).fadeTo(300, 1);
						});

						setTimeout(function() {
							jQuery.colorbox.resize();
						}, 500);
					};

					// Callbacks to pass to jQuery.fn.axZm() function
					var ajaxZoomCallbacks = {
						onLoad: function(){
							// Container for external title and description
							var testTitleDescrContainer = jQuery('<DIV />').css({
								clear: 'both', 
								padding: '5px 10px 10px 10px',
								backgroundColor: '#1D1D1A'
							});

							// Title div
							jQuery('<DIV />').attr('id', 'testTitleDiv').css({
								minHeight: 30,
								fontSize: '16pt',
								color: '#D3D3D3'
							}).appendTo(testTitleDescrContainer);

							// Description div
							jQuery('<DIV />').attr('id', 'testDescrDiv').css({
								minHeight: 40,
								fontSize: '10pt',
								color: '#FFFFFF'
							}).appendTo(testTitleDescrContainer);

							// Margin div
							jQuery('<DIV />').css({
								minHeight: 10,
								clear: 'both'
							}).appendTo('#axZm_zoomAll');

							// Append everything above after the player, could also be inside...
							testTitleDescrContainer.insertAfter('#axZm_zoomAll');

							// Resize the colorbox
							jQuery.colorbox.resize();

							// Current image name
							var getImgName = jQuery.axZm.zoomGA[jQuery.axZm.zoomID]["img"];

							// Set descriptions and title
							ajaxZoomAnimateDescr(testTitle[getImgName], testDescr[getImgName]);

							// Titles of the thumbs
							jQuery.each(thumbTitle, function (fName, descr, download){
								jQuery.fn.axZm.setDescr(fName, testTitle[fName], descr, download);
							});
						}, 
						onImageChange: function(info){
							// Current image name
							var getImgName = jQuery.axZm.zoomGA[jQuery.axZm.zoomID]["img"];

							// Set descriptions and title
							ajaxZoomAnimateDescr(testTitle[getImgName], testDescr[getImgName]);
						}
					};

					// Colorbox example
					jQuery(".ajaxExampleColorboxDesc").colorbox({
						initialWidth: 300,
						initialHeight: 300,
						scrolling: false,
						scrollbars: false,
						preloading: false,
						opacity: 0.95,
						ajax: true, // this option has been added by ajax-zoom to enforce loading href as url and not image
						onComplete: function(){
							// Trigger AJAX-ZOOM after loading
							jQuery.fn.axZm(ajaxZoomCallbacks); 
						}
					});
				</script>

				<div class="col-md-12">
					<h3>JavaScript & CSS files in Head</h3>
					<div style="margin: 5px 0px 5px 0px;">
						<?php
						echo '<pre><code class="language-markup">';
						echo htmlspecialchars ('
<!-- jQuery core, needed for the lightboxes. Include if not already present. -->
<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core, needed! -->
<link href="../axZm/axZm.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>

<!--  Fancybox lightbox javascript, only needed if used, please note: it has been slightly modified for AJAX-ZOOM -->
<link rel="stylesheet" href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<!-- Colorbox plugin, only needed if used -->
<link rel="stylesheet" href="../axZm/plugins/demo/colorbox/example1/colorbox.css" media="screen" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/colorbox/jquery.colorbox-min.js"></script>
						');
						echo '</code></pre>'
						?>
					</div>

					<h3>JavaScript: bind either colorbox and/or fancybox to elements with certain classes</h3>
					<p>Please notice that jQuery.fn.axZm(); needs to be triggered in onComplete callbacks 
						(when AJAX request is finished)
					</p>

					<div style="margin: 5px 0px 5px 0px;">
						<pre><code class="language-js" id="exampleJsPrism"></code></pre>
						<script>
							// this is only for demo to show js code
							$('#exampleJsPrism').html($('#exampleJs').html());
						</script>
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
	</body>
</html>