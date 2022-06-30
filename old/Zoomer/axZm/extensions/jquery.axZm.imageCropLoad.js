/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.imageCropLoad.js
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.12
* Extension Date: 2019-03-09
* URL: https://www.ajax-zoom.com
* Example: https://www.ajax-zoom.com/examples/example35_clean.php
*/

;(function($) {
	var dta = {};

	var consoleLog = function(msg, err) {
		if (msg && window.console && window.console.log) {
			if (err && window.console.error) {
				window.console.error('AJAX-ZOOM :: ' + msg);
			} else {
				window.console.log('AJAX-ZOOM :: ' + msg);
			}
		}
	};

	if (!$.fn || !$.fn.jquery) {
		consoleLog('Error, jQuery core is not loaded!', 1);
		return;
	}

	// Get query string value
	var getParameterByName = function(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
		var results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	};

	var updateUrlParameter = function(url, param, value) {
		var regex = new RegExp('('+param+'=)[^\&]+');
		return url.replace( regex , '$1' + value);
	};

	$.axZmImageCropLoad = function(o) {
		// Load json file with some error handling
		var getJSONdataFromFile = function() {
			var cropJsonURL = opt.cropJsonURL;

			if (cropJsonURL) {
				if (dta[cropJsonURL]) {
					return proceedJSONdata(dta[cropJsonURL]);
				}

				//var url = cropJsonURL.replace(/[^a-zA-Z0-9-_:\/.?&=]/g, '');
				//aZcR_jsFileName
				$.ajax({
					url: cropJsonURL,
					dataType: 'json',
					cache: false,
					success: function(d) {
						dta[dta] = d;
						proceedJSONdata(d);
					},
					error: function(a) {
 						var status = a.status;
 						var txt = 'Error loading JSON file! ';
						if (status == '200') {
							consoleLog(txt + 'Loaded JSON file ('+cropJsonURL+') contains errors');
						} else {
							consoleLog(txt + 'An error '+a.status+' occurred while loading JSON from '+cropJsonURL, 1);
						}
					}
				});
			} else if (opt.cropJson) {
				proceedJSONdata(opt.cropJson);
			} else {
				consoleLog('Error, no JSON data defined for crop thumbnails');
			}
		};

		var setRemoveSelect = function() {
			if ($.axZm) {
				$.fn.axZm.addCallback('onZoomSpinPanOnce', function() {
					var sell = opt.sliderID || opt.thumbsContainerID;
					if (sell) {
						if (sell.indexOf('#') === 0 || sell.indexOf('.') === 0) {
							try {
								$('li', $(sell)).removeClass('selected');
							} catch(err) {}
						} else {
							$('li', $('#'+sell)).removeClass('selected');
						}
					}
				});
			}
		};

		// Click on thumb
		var thumbClick = function(_this) {

			if ($.axZm.spinMod && !$.axZm.spinPreloaded) {
				if (!$.axZm.spinPreloading && $.axZm.spinNoInit.enabled == true) {
					$.fn.axZm.spinPreload(function() {
						$.fn.axZm.spinStop();
						$('li', _this.parent()).removeClass('selected');
						_this.addClass('selected');
						thumbClick(_this);
					});
				}

				return;
			}

			// Read data previously attached to the image
			var azJcrop = _this.data('crop');

			// handleDescr will be executed after spinTo or zoomTo
			var handleDescr = function() {
				if ($.isFunction(opt.handleTexts)) {
					opt.handleTexts(azJcrop.title, azJcrop.descr, _this);
					setRemoveSelect();
				} else if (opt.handleTexts == 'default') {
					if (!$.isFunction($.axZmEb)) {
						if (typeof console != 'undefined') {
							consoleLog('AJAX-ZOOM: jquery.axZm.expButton.js extension is not loaded');
						}

						return;
					} else {
						if (azJcrop.title || azJcrop.descr) {
							var axZmEbOpt = {
								title: azJcrop.title,
								descr: azJcrop.descr,
								gravity: azJcrop.ebGrav || 'top', // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
								marginY: 5, // vertical margin depending on gravity
								zoomSpinPanRemove: opt.sliderID || opt.thumbsContainerID, // removes button / layer when there is some action inside AJAX-ZOOM
								autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
								removeOnClose: false // removes button when extended state is closed
							};

							$.axZmEb($.extend(true, {}, axZmEbOpt, opt.cropAxZmEbOpt));
						} else {
							setRemoveSelect();
						}
					}
				} else if ((azJcrop.title || azJcrop.descr) && typeof console != 'undefined') {
					consoleLog('AJAX-ZOOM: no function defined to handle title and desciption');
				}
			};

			//if ($('.axZmEb_Descr', $('#axZm_zoomLayer')).length) {
			$.fn.axZm.tapShow();
			//}

			// Parameters from JSON as object
			var zoomToParameters = {
				x1: azJcrop.crop[0],
				y1: azJcrop.crop[1],
				x2: azJcrop.crop[2],
				y2: azJcrop.crop[3],

				// settings for effects
				settings: {
					speedMin: false,
					zoomSpeed: azJcrop.zoom || opt.zoomToSpeed || $.axZm.zoomSpeed,
					zoomSpeedMin: azJcrop.zoomMin || opt.zoomToMinSpeed,
					effect: azJcrop.effect || 0
				}
			};

			// Callback for 2D
			var zoomToCallback = function() {
				// Trigger AJAX-ZOOM API 
				// http://www.ajax-zoom.com/index.php?cid=docs#api_zoomTo
				$.fn.axZm.zoomTo(
					// Add handleDescr as callback to the options object passed to zoomTo
					$.extend(true, {}, zoomToParameters, {callback: handleDescr})
				);
			};

			// 2D image and same image from gallery selected
			if ($.axZm.zoomGA[$.axZm.zoomID]['img'] == azJcrop.imgName && !$.axZm.spinMod) {
				/*$.extend(true, zoomToParameters, {
					speed: Math.max($.axZm.zoomSpeed, 750),
					speedZoomed: Math.max($.axZm.zoomSpeed, 750)
				});*/

				zoomToCallback();
			} else {
				// 360 / 3D mode
				if ($.axZm.spinMod) {
					$.fn.axZm.removeDragToSpinMsg();

					// Trigger AJAX-ZOOM API 
					// http://www.ajax-zoom.com/index.php?cid=docs#api_spinTo
 					$.fn.axZm.spinTo(
						azJcrop.imgName, 
						azJcrop.spin || opt.spinToSpeed || 'auto',
						opt.spinToMotion || null, // easing
						handleDescr, // callback
						zoomToParameters
					);

				} else {

					// Trigger AJAX-ZOOM API 
					// http://www.ajax-zoom.com/index.php?cid=docs#api_zoomSwitch
					$.fn.axZm.zoomSwitch(azJcrop.imgName, null, true, null, zoomToCallback);
				}
			}
		};

		var newThumb = function(src) {
			var newImg = new Image();
			newImg.error = function() {
				if (typeof console != 'undefined') {
					consoleLog('Error loading thumb: '+src);
				}
			};

			return $(newImg)
			.css('visibility', 'hidden')
			.axZmLoad(function() {
				$(this)
				.css({
					visibility: '',
					opacity: 0
				})
				.removeAttr('width')
				.removeAttr('height')
				.stop()
				.animate({
						opacity: 1
					}, {
						queue: false,
						duration: 150
					}
				);
			})
			.attr('src', src);
		};

		// Process json data after loading
		var proceedJSONdata = function(d) {
			var thumbsContainerID;
			var thumbsContainerUL;
			var sliderID;
			if (!$.isArray(d) || d.length == 0) {
				consoleLog('Error loading crops. JSON passed from url ('+opt.cropJsonURL+') or defined as cropJson is not an array or array is empty');
				return;
			}

			var arrCount = d.length; // number of crops from json
			var i = 0; // counter

			// Checks
			if (opt.thumbsContainerID) {
				thumbsContainerID = $('#'+opt.thumbsContainerID);
				if (!thumbsContainerID.length) {
					consoleLog('Error loading crops. Element with ID '+opt.thumbsContainerID+' was not found.', 1);
					return;
				}

				// Ul present?
				thumbsContainerUL = $('ul', thumbsContainerID);

				if (!thumbsContainerUL.length) {
					thumbsContainerUL = $('<ul />')
					.addClass(opt.thumbsContainerUlClass)
					.appendTo(thumbsContainerID);
				}

			} else if (opt.sliderID) {
				sliderID = $('#'+opt.sliderID);

				if (!sliderID.length) {
					consoleLog('Error loading crops. Element with ID '+opt.sliderID+' was not found.', 1);
					return;
				}

				// Slider not inited ?
				if (!sliderID.data('axZmThumbSlider')) {
					if (opt.sliderPar) {
						sliderID.axZmThumbSlider(opt.sliderPar);
					} else {
						consoleLog('Error loading crops. axZmThumbSlider is not initiated, can not add thumbs to the slider!', 1);
						return;
					}
				}
				
			}

			$(d).each(function(m, o) {
				var dataObj = {
					thumbNumber: m+1,
					crop: o.crop,
					url: o.url ? o.url : null,
					qString: o.qString ? o.qString : null,
					zoomID: o.zoomID ? o.zoomID : null,
					imgName: o.imgName,
					contentLocation: o.contentLocation ? o.contentLocation : null,
					title: o['title_'+opt.lang] || o.title || null,
					thumbTitle: o['thumbTitle_'+opt.lang] || o.thumbTitle || null,
					descr: o['descr_'+opt.lang] || o.descr || null,
					effect: o.effect ? o.effect : 0,
					ebGrav: o.ebGrav || 'top',
					spin: o.spin || '2500',
					zoom: o.zoom || 250,
					zoomMin: o.zoomMin || 600
				};

				var imgCropperPath;

				// Look where to get the croped thumb from
				if (dataObj.url) {
					imgCropperPath = dataObj.url;
					dataObj.qString = imgCropperPath.replace(opt.installPath+'zoomLoad.php?', '')
				} else if (dataObj.qString) {
					imgCropperPath = opt.installPath+'zoomLoad.php?'+dataObj.qString;
					dataObj.url = imgCropperPath;
				} else if (o.contentLocation) {
					// directly from cache 
					imgCropperPath = o.contentLocation;
				}

				if (jQuery.isPlainObject(opt.cropImgParam)) {
					$.each(opt.cropImgParam, function(kk, vv) {
						if (kk && vv) {
							imgCropperPath = updateUrlParameter(imgCropperPath, kk, vv);
						}
					});
				}

				if (!imgCropperPath) {
					i++;
					return;
				}

				dataObj.imgCropperPath = imgCropperPath;

				// append thumbs to axZmThumbSlider
				if (opt.sliderID && sliderID.length) {

					// Create li ellement
					var newLi = $('<li />')
					// Set data attr to be able to fine it later over selector
					.attr('data-cropNum', dataObj.thumbNumber)
					// Crop data
					.data('crop', dataObj)
					// Append thumb image to li
					.append(
						newThumb(imgCropperPath)
					);

					// Description
					if (opt.thumbsContainerLiDescr && dataObj.thumbTitle){
						$('<div />').addClass('label').html(dataObj.thumbTitle).appendTo(newLi);
					}

					// Use axZmThumbSlider "appendThumb" API to add the thumb to the slider
					sliderID.axZmThumbSlider(
						'appendThumb',
						newLi,
						// Click event
						function() {
							thumbClick(newLi);
						}
					);

				} else if (thumbsContainerID) {
					// Append thumbs in UL LI structure to the container

					var newLi = $('<li />')
					// Custom css
					.css(opt.thumbsContainerLiCss ? opt.thumbsContainerLiCss : {})
					// Set data attr to be able to fine it later over selector
					.attr('data-cropNum', dataObj.thumbNumber)
					// Crop data
					.data('crop', dataObj)
					// Append thumb image to li
					.append(
						$('<img>')
						.addClass('thumb')
						.attr('src', imgCropperPath)
					)
					.bind('click', function() {
						thumbClick(newLi);
						$('li', thumbsContainerID).removeClass('selected hover');
						newLi.addClass('selected');
					})
					.bind('mouseenter', function() {
						if (!newLi.hasClass('selected')) {
							newLi.addClass('hover');
						}
					})
					.bind('mouseleave', function() {
						if (!newLi.hasClass('selected')) {
							newLi.removeClass('hover');
						}
					});

					// For vertical align
					$('<span />').text(' ').addClass('vAlign').appendTo(newLi);

					// Description
					if (opt.thumbsContainerLiDescr && dataObj.thumbTitle) {
 						$('<div />').addClass('descr').html(dataObj.thumbTitle).appendTo(newLi);
 					}

					newLi.appendTo(thumbsContainerUL);
				}

			});
		};

		var getBrowserLanguage = function() {
			var nav = window.navigator,
				ret = 'en';

			if (nav) {
				if (nav.language) {
					ret = nav.language;
				} else if (nav.browserLanguage) {
					ret = nav.browserLanguage;
				} else if (nav.systemLanguage) {
					ret = nav.systemLanguage;
				} else if (nav.userLanguage) {
					ret = nav.userLanguage;
				}

				ret = ret.toLowerCase().substring(0,2);
			}

			return ret;
		};

		// Options
		var opt;

		var def = {
			installPath: 'auto', //Path to /axZm directory, e.g. /test/axZm/
			cropJsonURL: '', // url of the json with crop data
			cropJson: '', // data coming from elsewhere
			cropImgParam: {
				width: null,
				height: null,
				qual: null
			},
			sliderID: null, // ID of axZmThumbSlider
			sliderPar: null, // Parameters of the thumb slider, see https://www.ajax-zoom.com/axZm/extensions/axZmThumbSlider/
			lang: getBrowserLanguage(), // Language
			thumbsContainerID: null, // ID of some container to put thumbs into (no slider)
			thumbsContainerUlClass: 'azThumbCrop', // class which will be added to the UL element
			thumbsContainerLiCss: {}, // quickly overwrite css e.g. margin of the li (thumbs)
			thumbsContainerLiDescr: false, // add title from crop data to the thumb
			zoomToSpeed: 250, // "base speed" for zooming in and out
			zoomToMinSpeed: 600, // minimal duration of zoom in or out animation

			// Optionally pass duration of spinning when clicked on the thumb. 
			// When defined as a string, the value is interpreted as "base speed", 
			// and it is reduced depending on the difference between the current and the target frame numbers. 
			// When defined as an integer, the value preserves no matter how many frames are turning.
			spinToSpeed: '2500',

			spinToMotion: 'easeOutQuad', // optional pass easing type of the spinning animation
			handleTexts: 'default', // function after spinTo or zoomTo; if defined in JSON title and description are passed as arguments
			cropAxZmEbOpt: {} // options of the expandable button plugin, see /axZm/extensions/jquery.axZm.expButton.js
		};

		if (!o.cropJsonURL !== false && (!o.cropJsonURL || o.cropJsonURL == 'auto')) {
			o.cropJsonURL = getParameterByName('cropJsonURL');
		}

		if (!o.installPath || o.installPath == 'auto') {
			o.installPath = $.fn.axZm.installPath();
		}

		opt = $.extend(true, {}, def, o);

 		if (!opt.installPath || opt.installPath == 'auto') {
			opt.installPath = $.fn.axZm.installPath();
			if (!opt.installPath || opt.installPath == 'auto') {
				consoleLog('The value of the option installPath could not be determined. Please set it manually!', 1);
				return;
			}
		}

		// Proceed
		getJSONdataFromFile();
	};

})(window.jQuery || {});
