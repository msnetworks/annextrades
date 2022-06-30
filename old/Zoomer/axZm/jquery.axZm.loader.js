/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.loader.js
* Copyright: Copyright (c) 2010-2017 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 5.0
* Date: 2017-08-04
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

/** Usage of "ajaxZoomLoad" function
ajaxZoomLoad expects "ajaxZoom" to be an object and globally defined (window.ajaxZoom)
ajaxZoom.path - string, defines the path to "/axZm/" folder (crossdomain is not possible)
ajaxZoom.divID - string, ID of the ellement where AJAX-ZOOM will be loaded into, e.g. "azParentContainer"
ajaxZoom.parameter - string, parameter to be passed to AJAX-ZOOM; see also http://www.ajax-zoom.com/index.php?cid=docs#heading_4
ajaxZoom.postMode - bool, setting this parameter to true will result in using POST method instead of GET
ajaxZoom.responsive - bool, open AJAX-ZOOM responsive
ajaxZoom.fullScreenAPI - bool, use browsers fullscreen API if available
ajaxZoom.opt - object, optional callbacks to be passed to AJAX-ZOOM
ajaxZoom.trigger - bool, if true AJAX-ZOOM will be triggered not on window load but immideatly after this code is executed
ajaxZoom.readyToTrigger - bool, if true AJAX-ZOOM will be not triggered instantly. You can call ajaxZoomLoad() whenever then with some other js function

// Example
<script type="text/javascript">
var ajaxZoom = {};
ajaxZoom.path = '../axZm/'; 
ajaxZoom.parameter = 'zoomDir=/pic/furniture&example=11'; 
ajaxZoom.divID = 'azParentContainer';
</script>
<script type="text/javascript" src="../axZm/jquery.axZm.loader.js"></script>
*/

function ajaxZoomLoad() {
	var waitJquery,
		varType = typeof ajaxZoom;

	// window.ajaxZoom needs to be defined somewhere to use this loader
	if (varType == 'undefined') {
		alert('var ajaxZoom is not defined!');
		return;
	} else if (varType != 'object') {
		alert('var ajaxZoom is not object!');
		return;
	}

	// Prevent doble trigger
	if (ajaxZoom.triggered === true && !ajaxZoom.triggerAgain) {
		if (typeof console == "object") {
			console.log('Warning: jquery.axZm.loader.js is included at least twice');
		}
		return;
	}

	ajaxZoom.triggered = true;

	// Add slash at the end if needed
	if (ajaxZoom.path && ajaxZoom.path.slice(-1) != '/') {
		ajaxZoom.path += '/';
	} else if (!ajaxZoom.path) {
		alert('ajaxZoom.path is not defined!');
		return;
	}

	// Parameter check
	if (!ajaxZoom.parameter) {
		alert('ajaxZoom.parameter is not defined!');
		return;
	}

	if (typeof ajaxZoom.opt != 'object') {
		ajaxZoom.opt = {};
	}

	// Inject AJAX-ZOOM stylesheet - axZm.css
	var css = document.createElement('link');
	css.setAttribute('type', 'text/css');
	css.setAttribute('rel', 'stylesheet');
	css.setAttribute('href', ajaxZoom.path+'axZm.css');
	document.getElementsByTagName("head")[0].appendChild(css);

	// Inject a js file
	function loadJS(jsFile) {
		var js = document.createElement('script');
		js.setAttribute("type","text/javascript");
		js.setAttribute('src', ajaxZoom.path+jsFile);
		document.getElementsByTagName("head")[0].appendChild(js);			
	}

	//  Check, if jquery core is loaded
	if (typeof jQuery == 'undefined') {
		// Load jQuery core
		loadJS('plugins/jquery-1.8.3.min.js');
	}

	function wait() {
		if (waitJquery != 'undefined') {
			clearTimeout(waitJquery);
		}

		// jQuery core should be loaded
		if (typeof jQuery != 'undefined') {

			ajaxZoom.parameter = 'zoomLoadAjax=1&'+ajaxZoom.parameter;

			var axZmFileLoadSuccess = function() {
				if (ajaxZoom.responsive) {
					jQuery.fn.axZm.openResponsive(
						ajaxZoom.path,
						ajaxZoom.parameter,
						ajaxZoom.opt,
						ajaxZoom.divID,
						ajaxZoom.fullScreenAPI ? true : undefined, 
						true,
						ajaxZoom.postMode ? true : false
					);
				} else {
					jQuery.ajax({
						url: ajaxZoom.path + 'zoomLoad.php',
						type: (ajaxZoom.postMode || ajaxZoom.opt.postMode) ? 'POST' : 'GET',
						data: ajaxZoom.parameter,
						dataType: 'html',
						cache: false,
						success: function(data) {
							if (jQuery.isFunction(jQuery.fn.axZm) && data) {
								jQuery('#'+ajaxZoom.divID).html(data);
								if (ajaxZoom.postMode) {
									ajaxZoom.opt.postMode = true;
								}
								setTimeout(function() {
									jQuery.fn.axZm(ajaxZoom.opt);
								}, 1);
							}
						},
						error: function(a) {
							var status = a.status,
								statusText = a.statusText,
								returnStr = 'An error '+status+' ('+statusText+') was returned from the server! ';

							if (status == 403 || status == 500) {
								returnStr += 'This means that the file /axZm/zoomLoad.php encountered an error while processing. \
								Possible reasons are: \
								<ul>\
								';
								if (ajaxZoom.parameter.indexOf('./') != -1) {
									returnStr += '<li>.htaccess rule does not allow to pass relative paths ('+ajaxZoom.parameter+') over query string, try with absolute path.</li>';
								}
								returnStr += '<li>Ioncube loader is not installed properly or is not running.</li>';
								returnStr += '<li>You have chmod /axZm directory and/or php files in it to some high value, so they are not executed because of server security settings.</li>';
								if (status == 500) {
									returnStr += '<li>You have made an error while editing the PHP files.</li>';
									returnStr += '<li>Your server does not have enough RAM to generate the image tiles.</li>';
								}
								returnStr += '</ul>';
								returnStr += 'Found a different reason? Please report it to AJAX-ZOOM support. If nothing else helps please contact the support as well.';
							} else if (status == 404) {
								returnStr += 'Please make sure that ajaxZoom.path ('+ajaxZoom.path+') - the path to "/axZm" directory is set properly! ';
							} else {
								returnStr += 'Please contact AJAX-ZOOM support!';
							}
	
							var errDiv = '<div style="min-width: 300px; padding: 10px; font-size: 14px; background-color: #FFFFFF; color: #000000">'+returnStr+'</div>';

							if (jQuery('#axZmTempLoading').length) {
								jQuery('#axZmTempLoading').append(errDiv);
							} else {
								jQuery('#'+ajaxZoom.divID).html(errDiv);
							}
						}
					});
				}
			};

			if (jQuery.isFunction(jQuery.fn.axZm)) {
				axZmFileLoadSuccess();
			} else {
				jQuery.ajax({
					url: ajaxZoom.path + 'jquery.axZm.js',
					dataType: 'script',
					cache: true,
					success: function() {
						axZmFileLoadSuccess();
					},
					error: function(a) {
						var status = a.status,
							statusText = a.statusText,
							returnStr = 'An error '+status+' ('+statusText+') was returned while attempted to load this file: '+ajaxZoom.path + 'jquery.axZm.js';
							returnStr += '<br>'+'Please make sure that ajaxZoom.path ('+ajaxZoom.path+') points to the existing directory.';

						var errDiv = '<div style="min-width: 300px; padding: 10px; font-size: 14px; background-color: #FFFFFF; color: #000000">'+returnStr+'</div>';

						if (jQuery('#axZmTempLoading').length) {
							jQuery('#axZmTempLoading').append(errDiv);
						}else{
							jQuery('#'+ajaxZoom.divID).html(errDiv);
						}
					}
				});
			}

		} else {
			waitJquery = setTimeout(function() {
				wait();
			}, 50);
		}
	}
	wait();
}

function ajaxZoomLoadEvent(obj, evType, fn) { 
	if (obj.addEventListener) { 
		obj.addEventListener(evType, fn, false); 
		return true; 
	} else if (obj.attachEvent) { 
		var r = obj.attachEvent("on"+evType, fn); 
		return r; 
	} else { 
		return false; 
	} 
}

if (typeof ajaxZoom != 'undefined') {
	// Do not do anything, trigger loading AJAX-ZOOM manually
	if (!ajaxZoom.readyToTrigger) {
		// Trigger immediately
		if (ajaxZoom.trigger) {
			ajaxZoomLoad();
		} else {
			ajaxZoomLoadEvent(window, 'load', ajaxZoomLoad);
		}
	}
} else {
	// Some people inclide this file in head
	ajaxZoomLoadEvent(window, 'load', ajaxZoomLoad);
}
