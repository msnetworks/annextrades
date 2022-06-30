/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.azExample4.js
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: https://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 1.5
* Extension Date: 2019-08-06
* URL: https://www.ajax-zoom.com
* Documentation: https://www.ajax-zoom.com/index.php?cid=docs
* Example: https://www.ajax-zoom.com/examples/example4.php
*/

;(function($) {
	'use strict';

	$.azExample4 = function(opt) {

		var def = {
			axZmPath: "auto", // Path to /axZm directory, e.g. /test/axZm/
			zoomDir: "", // Path to subfolders with images
			divID: "axZmPlayerContainer", // ID of the main container
			menuDivID: "axZmNavbarContainer", // ID of the menu container
			firstFolder: 1, // index or name of the folder to be loaded at first
			firstImage: 1, // index or name of the image to load from firstFolder
			example: 8, // configuration set value which is passed to ajax-zoom
			axZmCallBacks: {}, // AJAX-ZOOM has several callbacks, http://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
			responsive: true, // Open responsive
			fullScreenApi: false // try to open AJAX-ZOOM at browsers fullscreen mode
		};

		var op = $.extend(true, {}, def, opt);
		var tDir = '';

		var submitNewZoom = function(menuItem) {
			var folder = $(menuItem).attr('data-folder');
			if (folder) {
				var data = 'example=' + op.example+'&zoomDir=' + tDir + folder;
				$.fn.axZm.loadAjaxSet(data);
			}
		};

		var loadDirs = function() {
			var url = op.axZmPath + 'zoomLoad.php';
			var urlData = 'zoomDir=' + op.zoomDir + '&qq=folders';

			$.ajax({
				url: url,
				data: urlData,
				cache: false,
				dataType: 'JSON',
				success: function (data) {
					if ($.isArray(data) && data[0] != 'error') {
						var folderToLoad = data[0] + data[1][1]['folderName'];
						tDir = data[0];

						var ul = $('<ul />');
						$.each(data[1], function(k, v) {
							var a = $('<a />')
							.text(v.folderName)
							.css('cursor', 'pointer');

							var li = $('<li />')
							.attr('id', 'zoomSet' + k)
							.attr('data-folder', v.folderName)
							.bind('click', function() {
								$('li', $(this).parent()).removeClass('active');
								$(this).addClass('active');
								submitNewZoom('#zoomSet'+k);
							})
							.append(a);

							if ( v.folderName == op.firstFolder || parseInt(k) == parseInt(op.firstFolder) || (data[0]+v.folderName) == op.firstFolder) {
								li.addClass('active');
								folderToLoad = data[0]+v.folderName;
							}

							li.appendTo(ul);

						});

						$('#'+op.menuDivID).empty().append(ul.children());

						var parampeterToPass = 'zoomDir='+folderToLoad+'&example='+op.example;

						if (parseInt(op.firstImage) == op.firstImage) {
							parampeterToPass += '&zoomID='+op.firstImage;
						} else {
							parampeterToPass += '&zoomFile='+op.firstImage;
						}

						/*
						#axZm_zoomContainer img.axZm_blurBack {
							position: absolute;
							margin: auto;
							position: absolute;
							top: 0;
							bottom: 0;
							left: 0;
							right: 0;
							pointer-events: none;
							z-index: 0;
							max-height: 100%;
							max-width: 100%;
							filter: blur(10px) brightness(50%);
							transform: translate3d(0,0,0) scale(8) rotate(0.01deg);
							backface-visibility: hidden;
						}
						*/
						/*
						var setBg = function() {
							$('#axZm_zoomContainer .axZm_blurBack').fadeOut(300, function(){$(this).remove()});
							$('<img>')
							.attr('src', $.axZm.smallImg)
							.addClass('axZm_blurBack')
							.css('disply', 'none')
							.appendTo('#axZm_zoomContainer')
							.fadeIn(300);
						}

						var clbDef = {
							onLoadAjaxSet: function() {
								setBg();
							},
							onImageChangeEnd: function() {
								setBg();
							}
						};
						*/

						var clbDef = {};

						var aZcallBacks = $.fn.axZm.mergeCallBackObj(op.axZmCallBacks, clbDef);

						if (op.responsive) {
							$.fn.axZm.openFullScreen(
								op.axZmPath,
								parampeterToPass,
								aZcallBacks,
								op.divID,
								op.fullScreenApi,
								true
							);
						} else {
							$.fn.axZm.load({
								opt: aZcallBacks,
								path: op.axZmPath,
								parameter: parampeterToPass,
								divID: op.divID,
								apiFullscreen: op.fullScreenApi
							}); 
						}

					} else {
						// Some error handling
						var errText = 'Error: failed to load folders for gallery';
						if ($.isArray(data) && data[0] == 'error') {
							errText += '<br>'+data[1]+': '+op.zoomDir;
						}

						$('#'+op.divID)
						.html('<div style="color: red; padding: 5px; background-color: #FFF; border: 1px solid red; background-color: #EEE">'+errText+'</div>');

						$('#'+op.menuDivID)
						.html('<div style="color: red; padding: 5px;">Error</div>');
					}
				},
				error: function(jqXHR, textStatus, errorThrown ) {
					// Some error handling
					var errText = 'Error '+jqXHR.status+' ('+errorThrown+')<br>';
					errText += 'Failed to load folders for gallery with the following request: <br>';
					errText += url+'?'+urlData;

					$('#'+op.divID)
					.html('<div style="color: red; padding: 5px; background-color: #FFF; border: 1px solid red; background-color: #EEE">'+errText+'</div>');

					$('#'+op.menuDivID)
					.html('<div style="color: red; padding: 5px;">Error</div>');
				}
			});

		};

		var init = function() {

			if (!op.axZmPath || op.axZmPath == 'auto') {
				if ($.isFunction($.fn.axZm)) {
					op.axZmPath = $.fn.axZm.installPath();
				} else {
					alert('jquery.axZm.js is not loaded');
					return;
				}
			}

			if (!$('#'+op.divID).length) {
				alert('Container with ID '+op.divID+' was not found.');
				return;
			}

			if (!$('#'+op.menuDivID).length) {
				alert('Container with ID '+op.menuDivID+' was not found.');
				return;
			}

			if ($.axZm) {
				$.fn.axZm.spinStop();
				$.fn.axZm.remove();
				$('#axZmTempBody').axZmRemove(true);
				$('#axZmTempLoading').axZmRemove(true);
				$('#axZmWrap').axZmRemove(true);
			}

			loadDirs();
		};

		// If $.azExample4 was inited before needed DOM is ready
		if (!$('#'+op.divID).length) {
			$(document).ready(init);
		} else {
			init();
		}
	};

})(jQuery);