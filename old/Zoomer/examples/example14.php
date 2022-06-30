<!DOCTYPE html>
<html>
<head>
<title>14</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- jQuery core -->
<script src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM core file -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">

<!-- Used in this example to print text in visual console -->
<script type="text/javascript" src="../axZm/plugins/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="../axZm/plugins/JSON/jquery.json-2.3.min.js"></script>

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css" media="screen">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<!-- Some additional css for this example -->
<style type="text/css" media="screen"> 
	.consoleEntry {
		border-bottom: green 1px dotted;
		padding: 3px;
		margin-bottom: 2px;
	}
	
	#callBackConsole {
		height: 350px; 
		overflow-x: hidden;
		overflow-y: auto;
		font-size: 8pt;
		background-color: #101010;
		color: #3CC628;
		border-bottom: #000000 5px solid;
		border-left: #000000 5px solid;
		border-right: #000000 5px solid;
	}

	#zFsO #callBackConsole {
		height: 100%;
	}

	#zFsO #callBackConsoleInner {
		position: absolute;
		z-index: 123;
		opacity: 0.8;
		bottom: 40px;
		right: 10px;
		width: 40%;
		height: 30%
	}

	form {margin: 0; padding: 0;}
</style>
</head>
<body>

<?php
include ('navi.php');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">AJAX-ZOOM - callbacks (for developers)</h1>
		</div>
		<div class="col-md-7">
			<div class="embed-responsive" style="padding-bottom: 80%; border: #000 1px solid">
				<div id="test" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
					Loading, please wait...
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<!-- Console HTML -->
			<div id='callBackConsoleContainer'>
				<div id='callBackConsoleInner'>
					<div style="background-color: #000; padding: 5px; min-height: 36px"><span style="color: #FFF; font-size: 120%;">Callback console</span> 
						<input type='button' value='Clear' style='float: right;' 
							onclick="$('#callBackConsole').empty(); lastTime = null; firstTime = null; orderNo = 0;">
					</div>
					<div id='callBackConsole'></div>
				</div>
				<form id='someFormID' onsubmit="return false">
					<table cellspacing='2' cellpadding='2'>
						<tr>
							<td width='80'>Callback onSelection:</td>
							<td width='50'>x1: <input type='text' id='z_x1' style='width: 40px'></td>
							<td width='50'>y1: <input type='text' id='z_y1' style='width: 40px'></td>
							<td width='50'>x2: <input type='text' id='z_x2' style='width: 40px'></td>
							<td width='50'>y2: <input type='text' id='z_y2' style='width: 40px'></td>
						</tr>
					</table>
				</form>
			</div>
			<div style="margin-top: 20px;">
				<button class="btn btn-info" id="load360example" style="margin-right: 10px;">Load 360°</button>
				<button class="btn btn-info" id="loadGalleryExample">Load gallery</button>
			</div>
		</div>

		<div class="col-md-12">
			<h3 style="margin-top: 30px">About</h3>
			<p>AJAX-ZOOM has many callbacks which can be used to develop advanced applications. 
				See <a href='https://www.ajax-zoom.com/index.php?cid=docs#heading_7'>API documentation</a>.
				Let us know if you miss an "event" to place your hook. Normally it is quickly implemented without additional costs. 
			</p>

			<p>After the initialization of AJAX-ZOOM the callback functions are stored in the object 
				<code>jQuery.axZm.userFunc</code> e.g. <code>jQuery.axZm.userFunc.onZoomInClickStart</code> 
				so you can access them later and redefine if needed:
			</p>

			<pre><code class="language-js">
				jQuery.axZm.userFunc.onZoomInClickStart = function() {
					// Do something
					console.log('This is a test');
				};

				// access later
				$.axZm.userFunc.onZoomInClickStart = null;
			</code></pre>

			<p>With <code>$.fn.axZm.getAllCallBackNames()</code> you can get a list of all callbacks available in the current version. 
				Note than some API functions have callbacks too.
			</p>

			<p>The first argument of the callback function is often an object containing information about e.g. click coordinates, viewport and other
				information which could be very useful creating applications, e.g.
			</p>

			<pre><code class="language-js">
				jQuery.axZm.userFunc.onZoom = function(info) {
					console.log(info);
				};
			</code></pre>

			<p>In most cases the return of your callback function does not matter. However for <code>onZoomInClickStart</code> it does. 
				If <code>onZoomInClickStart</code> returns <code>false</code> the actual zoom will be aborted. You can grap the "info" object 
				passed to this callbackfunction and do something else with it, e.g. place a hotspot like it is done in <a href="example12.php">example12.php</a> 
				or whatever:
			</p>

			<pre><code class="language-js">
				var checkClickedCoordinates = function(x, y) {
					// do checks here abot x and y
					
					// return true or false
				};

				jQuery.axZm.userFunc.onZoomInClickStart = function(info) {
					// coordinates releated to original image size
					var x = info.viewport.x;
					var y = info.viewport.y;

					return checkClickedCoordinates(x, y);
				};
			</code></pre>

			<p>A specific callback can be also a js object containing more than one function. 
				This usually happens when two or more functions for the same callback name are merged with <code>$.fn.axZm.mergeCallBackObj()</code> 
				before or after AJAX-ZOOM is initialized. For many examples we have created "wrapper" plugins for special functionality 
				where AJAX-ZOOM callbacks are extensivly used but developers can also pass their own, additional callbacks for the same "event"; 
				In this case they are merged into js object by  <code>$.fn.axZm.mergeCallBackObj()</code> 
				and executed one by one.
			</p>

			<p>So when AJAX-ZOOM is already initialized you can safely add your callback function like this: </p>
			<pre><code class="language-js">
				var anOtherOnZoom = function(info) {
					console.log(info);
				};

				$.axZm.userFunc = $.fn.axZm.mergeCallBackObj($.axZm.userFunc, {
					onZoom: anOtherOnZoom
				});

				// or like this when AJAX-ZOOM is already initialized: 
				$.fn.axZm.addCallback('onZoom', anOtherOnZoom);
			</code></pre>

			<p>In most cases you would put the logic into your <code>anOtherOnZoom</code> function and would not need to change / replace this callback. 
				In case you do, add it like this: 
			</p>

			<pre><code class="language-js">
				var anOtherOnZoom = function(info) {
					console.log(info);
				};

				$.axZm.userFunc = $.fn.axZm.mergeCallBackObj($.axZm.userFunc, {
					onZoom: {myOnZoom: anOtherOnZoom}
				});

				// or like this when AJAX-ZOOM is already initialized: 
				$.fn.axZm.addCallback('onZoom', {myOnZoom: anOtherOnZoom});

				// and e.g. replace your onZoom callback named myOnZoom like this:
				$.axZm.userFunc.onZoom.myOnZoom = function(info) {
					// do something else
				}
			</code></pre>

			<script type="text/javascript">
				function strReplace(s, r, subj) {
					if (!subj) {
						return;
					}
					return subj.split(s).join(r);
				}

				// Function append to console for demonstration of callbacks
				var lastTime = null;
				var firstTime = null;
				var orderNo = 0;
				function appendToConsole(name, info) {
					if (!lastTime) {
						lastTime = Date.now(); 
						firstTime = Date.now();
					}
					timeDiff = Date.now() - lastTime;
					lastTime = Date.now();
					orderNo++;
					name = orderNo+'. AJAX-ZOOM callback "'+name+'" ('+(lastTime-firstTime)+' ms | '+timeDiff+' ms)';
					if (info) {
						var toStr = jQuery.toJSON(info);
						toStr = strReplace(',"', '," ', toStr);
						toStr = strReplace('":', '": ', toStr);
						name += ':<br>'+toStr;
					}

					$('#callBackConsole').append('<div class="consoleEntry">'+name+'</div>')
					.scrollTo('max');
				}

				// Example of a callback function defined elsewhere
				var someCallBackFunction = function(info) {
					$('#z_x1').val(Math.round(info.selector.x1));
					$('#z_y1').val(Math.round(info.selector.y1));
					$('#z_x2').val(Math.round(info.selector.x2));
					$('#z_y2').val(Math.round(info.selector.y2));
				};

				var ajaxZoom = {}; // Create empty object which will be interpreted by jquery.axZm.loader.js
				ajaxZoom.path = '../axZm/'; // Path to the axZm folder
				ajaxZoom.parameter = 'zoomDir=/pic/zoom/animals&example=clb'; // Needed parameter
				ajaxZoom.divID = 'test'; // The id of the Div where ajax-zoom has to be inserted

				ajaxZoom.opt = {}; // Callbacks passed over the options. All other options are defined in zoomConfig.inc.php

				// Assign to each AJAX-ZOOM callback "console.log" function with possibly passed parameter converted to string
				jQuery.each($.fn.axZm.getAllCallBackNames(), function(i, name) {
					ajaxZoom.opt[name] = function(info) {
						appendToConsole(name, info);
					}
				});

				// As we assign same callback to each possible callback above, redefine some to fit this example
				ajaxZoom.opt.onSelection = function(info) {
					appendToConsole('onSelection', info);
					someCallBackFunction(info);
				};

				ajaxZoom.opt.onFullScreenStartEndFromRel = function(info) {
					appendToConsole('onFullScreenReady', info);
					jQuery('#callBackConsoleInner').appendTo('#axZm_zoomLayer');
				};

				ajaxZoom.opt.onFullScreenCloseFromRel = function(info) {
					appendToConsole('onFullScreenClose', info);
					jQuery('#callBackConsoleInner').prependTo('#callBackConsoleContainer');
				};

				// fire AJAX-ZOOM
				$.fn.axZm.openFullScreen(
					ajaxZoom.path,
					ajaxZoom.parameter,
					ajaxZoom.opt,
					ajaxZoom.divID,
					false,
					true,
					false
				);

				$('#load360example').bind('click', function(e) {
					$(this).blur();
					$.fn.axZm.removeAZ();
					$.fn.axZm.openFullScreen(
						ajaxZoom.path,
						'3dDir=/pic/zoom3d/Uvex_Occhiali&example=clb',
						ajaxZoom.opt,
						ajaxZoom.divID,
						false,
						true,
						false
					);
				});
				
				$('#loadGalleryExample').bind('click', function(e) {
					$(this).blur();
					$.fn.axZm.removeAZ();
					$.fn.axZm.openFullScreen(
						ajaxZoom.path,
						ajaxZoom.parameter,
						ajaxZoom.opt,
						ajaxZoom.divID,
						false,
						true,
						false
					);
				});
			</script>

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