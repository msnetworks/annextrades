/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.hoverThumb.js
* Copyright: Copyright (c) 2010-2018 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 1.9
* Extension Date: 2018-03-10
* URL: http://www.ajax-zoom.com
* Demo: http://www.ajax-zoom.com/examples/example6.php
*/

;(function($) {
	/*
	* jQuery Browser Plugin v0.0.6
	* https://github.com/gabceb/jquery-browser-plugin
	* Original jquery-browser code Copyright 2005, 2013 jQuery Foundation, Inc. and other contributors
	* http://jquery.org/license
	* Modifications Copyright 2013 Gabriel Cebrian
	* https://github.com/gabceb
	* Released under the MIT license
	* Date: 2013-07-29T17:23:27-07:00
	*/

	var axZmBrowserMigrate = function() {
		var matched, 
		brsr;

		var uaMatch = function( ua ) {
			ua = ua.toLowerCase();

			var match = /(opr)[\/]([\w.]+)/.exec( ua ) ||
			/(edge)[ \/]([\w.]+)/.exec( ua ) || 
			/(chrome)[ \/]([\w.]+)/.exec( ua ) ||
			/(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) ||
			/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
			/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
			/(msie) ([\w.]+)/.exec( ua ) || 

			ua.indexOf('trident') >= 0 && /(rv)(?::| )([\w.]+)/.exec( ua ) ||
			ua.indexOf('compatible') < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
			[];

			var platform_match = /(ipad)/.exec( ua ) ||
			/(iphone)/.exec( ua ) ||
			/(android)/.exec( ua ) ||
			/(windows phone)/.exec( ua ) ||
			/(win)/.exec( ua ) ||
			/(mac)/.exec( ua ) ||
			/(linux)/.exec( ua ) ||
			/(cros)/i.exec( ua ) ||
			[];

			return {
				browser: match[3] || match[1] || '',
				version: match[2] || '0',
				platform: platform_match[0] || ''
			};
		};

		matched = uaMatch(window.navigator.userAgent);
		brsr = {};

		if (matched.browser) {
			brsr[matched.browser] = true;
			brsr.version = matched.version;
			brsr.versionNumber = parseInt(matched.version);
		}

		if (matched.platform) {
			brsr[matched.platform] = true;
		}

		// These are all considered mobile platforms, meaning they run a mobile browser
		if ( brsr.android || brsr.ipad || brsr.iphone || brsr[ "windows phone" ] ) {
			brsr.mobile = true;
		}

		// These are all considered desktop platforms, meaning they run a desktop browser
		if ( brsr.cros || brsr.mac || brsr.linux || brsr.win ) {
			brsr.desktop = true;
		}

		// Chrome, Opera 15+ and Safari are webkit based browsers
		if ( brsr.chrome || brsr.opr || brsr.safari ) {
			brsr.webkit = true;
		}

		// IE11 has a new token so we will assign it msie to avoid breaking changes
		if ( brsr.rv || brsr.edge) {
			matched.browser = 'msie';
			brsr.msie = true;
		}

		if (brsr.edge) {
			brsr.edge = true;
		}

		// Opera 15+ are identified as opr
		if ( brsr.opr ) {
			matched.browser = 'opera';
			brsr.opera = true;
		}

		// Stock Android browsers are marked as Safari on Android.
		if ( brsr.safari && brsr.android ) {
			matched.browser = 'android';
			brsr.android = true;
		}

		// Assign the name and platform variable
		brsr.name = matched.browser;
		brsr.platform = matched.platform;

		if (brsr.msie && navigator.userAgent.indexOf('Trident/5.0') != -1) {
			brsr.versionNumber = 9;
		}

		// IE 11
		if (brsr.mozilla && brsr.msie) {
			delete brsr.mozilla;
		}

		// EDGE
		if (brsr.chrome && brsr.msie) {
			delete brsr.chrome;
		}

		return brsr;
	};

	var browser = axZmBrowserMigrate();

	/*!
	* Plugin: jQuery AJAX-ZOOM, jquery.axZm.hoverThumb.js
	* Copyright: Copyright (c) Vadim Jacobi
	*/

	var supports = function(prop) {
		var div = document.createElement('div'),
		vendors = 'Webkit webkit Moz O ms'.split(' '),
		//len = vendors.length,
		found = false;

		// without prefix
		if (prop in div.style) {
			return true
		};

		prop = prop.replace(/^[a-z]/, function(val) {
			return val.toUpperCase();
		});

		$.each(vendors, function(k, v) {
			if (vendors[k] + prop in div.style ) {
				found = true;
				return;
			}
		});

		return found;
	};

	var anmFrameJquery = function() {
		if (window.axZmPolyfill || Number( jQuery.fn.jquery.split( "." )[ 0 ] ) >= 3 ) {
			return;
		}

		window.axZmPolyfill = true;
		var animating;

		function raf() {
			if ( animating ) {
				window.requestAnimationFrame( raf );
				jQuery.fx.tick();
			}
		}

		if ( window.requestAnimationFrame ) {
			jQuery.fx.timer = function( timer ) {
				if ( timer() && jQuery.timers.push( timer ) && !animating ) {
					animating = true;
					raf();
				}
			};

			jQuery.fx.stop = function() {
				animating = false;
			};
		}
	};

	var consoleLog = function(a){
		if (window.console) {
			console.log(a);
		}
	};

	var az_not_loaded = '/axZm/jquery.axZm.js is not loaded';

	$.fn.extend({

		azHoverThumb: function(settings) {

			var defaults = {
				instantWrapClass: null,
				zoomRatio: 1.5, // Degree of zoom effect
				fadeInSpeed: 250, // Speed of fade in when image first shows
				zoomEsingIn: 'swing', // Easing of zoom effect
				zoomEsingOut: 'swing', // Easing of zoom effect
				zoomInSpeed: 250, // Speed of zoom effect
				zoomOutSpeed: 100, // Speed of zoom effect
				parentHeightRatio: false, // If width is responsive you can set the aspect ratio of the height
				parentHeightLL: 0.75, // Height ratio when using lazy load for replacement image
				maxHeight: 1, // Ver. 1.3 set height also depending on window hight if parentHeightRatio is set to "auto"
				parentWidthRatio: false, // If height is responsive you can set the aspect ratio of the width

				overlay: true, // show overlay on zoom effect
				overlayColor: '#000', // color of the overlay
				overlayOpacity: 0.4, // opacity of the overlay

				axZmPath: "auto", // Path to /axZm directory, e.g. /test/axZm/
				// possible values: "fullscreen", "fancyboxFullscreen", "fancybox", "colorbox", 'iframe'
				// zoomSwitch is only possible when player is ebmedded
				ajaxZoomOpenMode: "fullscreen", 
				exampleFullscreen: "mouseOverExtension", // configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "fullscreen"
				exampleFancyboxFullscreen: "mouseOverExtension", // configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "fancyboxFullscreen"
				exampleFancybox: "modal", // configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "fancybox"
				exampleColorbox: "modal", // configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "colorbox"
				exampleIframe: "mouseOverExtension", // Ver. 1.3

				iframeLink: 'example33_vario.php', // Ver. 1.3
				iframeClose: 'Close zoom', // Button, true, false or string Ver. 1.3
				iframeParam: 'noSplash=1&stepZoom=1&mNavi=mZoomOut:5,mZoomIn:15', // ver. 1.3

				// AJAX-ZOOM has several callbacks, 
				// Docu: http://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
				axZmCallBacks: {},
				fullScreenApi: false,// try to open AJAX-ZOOM at browsers fullscreen mode
				polyfill: true, 

				// If fancybox is used in "ajaxZoomOpenMode" option, below are some fancybox options
				fancyBoxParam: {
					boxMargin: 0,
					boxPadding: 10,
					boxCenterOnScroll: true,
					boxOverlayShow: true,
					boxOverlayOpacity: 0.75,
					boxOverlayColor: "#777",
					boxTransitionIn: "fade", // "elastic", "fade" or "none"
					boxTransitionOut: "fade", // "elastic", "fade" or "none"
					boxSpeedIn: 300,
					boxSpeedOut: 300,
					boxEasingIn: "swing",
					boxEasingOut: "swing",
					boxShowCloseButton: true, // close button
					boxEnableEscapeButton: true,
					boxOnComplete: function() {},
					boxTitleShow : true,
					boxTitlePosition : "float", // "float", "outside", "inside" or "over"
					boxTitleFormat : null
				},

				// If colorbox is used in "ajaxZoomOpenMode" option, below are some Colorbox options
				colorBoxParam: {
					transition: "elastic",
					speed: 300,
					scrolling: true,
					title: true,
					opacity: 0.9,
					className: false,
					current: "image {current} of {total}",
					previous: "previous",
					next: "next",
					close: "close",
					onOpen: false,
					onLoad: false,
					onComplete: false,
					onClosed: false,
					overlayClose: true,
					escKey: true
				}
			};

			var makeid = function() {
				var t = '';
				var p = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
				var l = p.length;
				for (var i = 0; i < 32; i++) {
					t += p.charAt(Math.floor(Math.random() * l));
				}
				return t;
			};

			if (!$.fn.axZmLoad) {
				$.fn.axZmLoad = $.fn.load;
			}

			return this.each(function() {
				var _image = $(this),
					_wrap,
					_wrapIframe,
					_iframeCloseDiv,
					_parent,
					_ovrl,
					_trap,
					_descr,
					dataDescr,
					moved,
					op = $.extend(true, {}, defaults, settings),
					realW,
					realH,
					width,
					height,
					ratio,
					parH,
					parW,
					outerW,
					outerH,
					winW,
					winH,
					tttt,
					scrlTS,
					touchName = 'ontouchstart',
					userAgent = navigator.userAgent.toLowerCase(),
					testTouch = (!(userAgent.indexOf('windows') != -1) && (touchName in window || touchName in document.documentElement || userAgent.indexOf("android") > -1)),
					supportsTrans = supports('transition');

				if (op.polyfill) {
					anmFrameJquery();
				}

				if ($.isNumeric(op.zoomRatio)) {
					op.zoomRatio = Math.abs(parseFloat(op.zoomRatio));
				} else {
					op.zoomRatio = 1;
				}

				if (op.instantWrapClass) {
					_image.wrap('<div class="'+op.instantWrapClass+'"></div>');
				}

				if (!_image.parent().is('.axZmHoverThumbWrap')) {
					_image.wrap('<div class="azHoverThumbWrap"></div>');
					_wrap = _image.parent();
					_parent = _wrap.parent();
				} else {
					if (op.destroy) {
						if (_image.data('ieTimer')) {
							clearInterval(_image.data('ieTimer'));
						}
					}

					return;
				}

				// Get /axZm/ directory
				if (!op.axZmPath || op.axZmPath == 'auto') {
					if ($.isFunction($.fn.axZm)) {
						op.axZmPath = $.fn.axZm.installPath();
					} else {
						if (op.ajaxZoomOpenMode != 'iframe') {
							consoleLog(az_not_loaded);
						}
					}
				}

				// Add slash to the /axZm path
				if (op.axZmPath.slice(-1) != '/') {
					op.axZmPath += '/';
				}

				var clickAZ = function(e) {
					e.preventDefault();
					if (!tttt || (new Date).getTime() - tttt > 350 || Math.abs(scrlTS - $(window).scrollTop()) > 1) {
						return false;
					}

					var dataGroup = _image.attr('data-group'),
					dataImg = _image.attr('data-img'),
					dataDescr = _image.attr('data-descr'),
					groupArr = [],
					descrObj = {},
					openMode = _parent.data('ajaxZoomOpenMode') || op.ajaxZoomOpenMode;

					if (dataImg) {
						if (dataGroup) {
							$('img[data-group="'+dataGroup+'"]').each(function() {
								var dataGroupImg = $(this).attr('data-img');
								if (dataGroupImg) {
									groupArr.push(dataGroupImg);
									descrObj[dataGroupImg.split('/').reverse()[0]] = $(this).attr('data-descr');
								}
							})
						} else {
							groupArr.push(dataImg);
							descrObj[dataImg.split('/').reverse()[0]] = dataDescr;
						}

						openAZ(e, {
							zoomData: groupArr.join('|'),
							zoomFile: dataImg,
							zoomDescr: descrObj,
							ajaxZoomOpenMode: openMode,
							fullScreenApi: _parent.data('fullScreenApi') || op.fullScreenApi
						});

					} else {
						return false;
					}
				};

				var closeIframe = function(e) {
					_wrapIframe.remove();
					_wrapIframe = null;
					_wrap.css('display', 'block');
					if (op.iframeClose) {
						_iframeCloseDiv.remove();
						_iframeCloseDiv = null;
					}

					recalculate();
				};

				var openAZ = function(e, inp) {

					var onBoxesClose = function() {};

					if (inp.ajaxZoomOpenMode == 'iframe') {
						var iParam = '?zoomData='+inp.zoomFile;
						if (op.exampleIframe) {
							iParam += '&example='+op.exampleIframe;
						}

						if (op.iframeParam) {
							if (op.iframeParam.substring(0, 1) == '&') {
								iParam += op.iframeParam;
							} else {
								iParam += '&' + op.iframeParam;
							}
						}

						iParam += '&fullScreenApi='+(inp.fullScreenApi ? 1 : 0);

						var frameId = makeid() + (new Date()).getTime();
						iParam += '&iframeID=' + frameId;

						_wrap.css('display', 'none');
						_wrapIframe = $('<iframe src="'+op.iframeLink+iParam+'" frameborder="0" id="'+frameId+'" class="azHoverThumbWrap" allowfullscreen>')
						.on('load', function(){
							$(this).addClass('azHoverThumbWrapNb');
						})
						.appendTo(_parent);

						if (op.iframeClose) {
							_iframeCloseDiv = $('<div class="azHoverIframeClose">'+($.type(op.iframeClose) == 'string' ? op.iframeClose : '')+'</div>')
							.bind('click', closeIframe)
							.appendTo(_parent);
						}
					} else if (inp.ajaxZoomOpenMode == 'fullscreen') {
						if (!$.fn.axZm) {
							consoleLog(az_not_loaded);
							return;
						}

						var aZcallBacks = $.extend(true, {}, op.axZmCallBacks);
						$.fn.axZm.openFullScreen(
							e, 
							op.axZmPath, 
							'zoomFile='+inp.zoomFile+(inp.zoomData ? '&zoomData='+inp.zoomData : '&zoomDir='+inp.zoomDir)+'&example='+op.exampleFullscreen, 
							aZcallBacks, 
							'window', 
							inp.fullScreenApi,
							false
						);
					} else if (inp.ajaxZoomOpenMode == 'fancyboxFullscreen') {
						// Open AJAX_ZOOM as modified / responsive Fancybox
						if (!$.isFunction($.openAjaxZoomInFancyBox)) {
							alert('Please include following scripts in the head section:\n\n/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css \n/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js \n/axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js \n\nImportant: it has to be adjusted Fancybox from AJAX-ZOOM package!\n');
							return false;
						}

						if (!$.fn.axZm) {
							consoleLog(az_not_loaded);
							return;
						}

						if (op.fancyBoxParam.boxMargin < 30) {
							op.fancyBoxParam.boxMargin = 30;
						}

						var aZcallBacks = $.extend(true, {}, op.axZmCallBacks);

						var thisParam = {
							axZmPath: op.axZmPath,
							queryString: 'example='+op.exampleFancyboxFullscreen+'&zoomFile='+inp.zoomFile+(inp.zoomData ? '&zoomData='+inp.zoomData : '&zoomDir='+inp.zoomDir),
							fullScreenApi: inp.fullScreenApi,
							ajaxZoomCallbacks: aZcallBacks,
							boxOnClosed: onBoxesClose
						};

						$.openAjaxZoomInFancyBox($.extend(true, {}, thisParam, aZcallBacks));
					} else if (inp.ajaxZoomOpenMode == 'fancybox') {
						// Open AJAX_ZOOM in regular Fancybox
						if (!$.fn.axZm) {
							consoleLog(az_not_loaded);
							return;
						}

						$('#axZmTempBody, #axZmWrap').axZmRemove(true);
						var axZmWrap = $('<div />').css({display: 'none'}).attr('id', 'axZmWrap').appendTo('body');

						// Trigger fancybox
						var onStart = function() {
							axZmWrap.css('display','');

							// fancyBoxParam
							var thisParam = {
								showNavArrows: false,
								enableKeyboardNav: false,
								hideOnContentClick: false,
								scrolling: 'no',
								width: 'auto',
								height: 'auto',
								autoScale: false,
								autoDimensions: true,
								href: '#axZmWrap',
								title: inp.zoomDescr[(inp.zoomFile.split('/').reverse()[0])] || ' ',
								onClosed: function() {
									onBoxesClose();
									$.fn.axZm.spinStop();
									$.fn.axZm.remove();
									$('#axZmTempBody').axZmRemove(true);
									$('#axZmTempLoading').axZmRemove(true);
									$('#axZmWrap').axZmRemove(true);
								},
								onComplete: function(a, b, c) {
									if (c.title == ' ') {
										if (op.fancyBoxParam.boxTitlePosition == 'float' || op.fancyBoxParam.boxTitlePosition == 'over') {
											$('#fancybox-title').hide();
										}
									}
								},
								beforeClose: function() { // fancybox 2.x
									onBoxesClose();
									$.fn.axZm.spinStop();
									$.fn.axZm.remove();
									$('#axZmTempBody').axZmRemove(true);
									$('#axZmTempLoading').axZmRemove(true);
									$('#axZmWrap').axZmRemove(true);
								}
							};

							var fancyBoxParam = {};

							$.each(op.fancyBoxParam, function(k, v) {
								k = k.substr(3);
								fancyBoxParam[k.charAt(0).toLowerCase() + k.slice(1)] = v;
							});

							$.fancybox($.extend(true, {}, fancyBoxParam, thisParam));
						};

						// Change title
						var onImageChange = function() {

							if (op.fancyBoxParam.boxTitleShow) {
								var thisDescr = inp.zoomDescr[$.axZm.zoomGA[$.axZm.zoomID]['img']] || '';

								if ($.fancybox.init) {
									var titleDivMap = {
										'float': 'fancybox-title-float-main',
										'outside': 'fancybox-title-outside', 
										'inside': 'fancybox-title-inside', 
										'over': 'fancybox-title-over'
									}

									$('#'+titleDivMap[op.fancyBoxParam.boxTitlePosition]).html(thisDescr || '');

									if (thisDescr) {
										$('#fancybox-title').show();
									} else {
										if (op.fancyBoxParam.boxTitlePosition == 'float' || op.fancyBoxParam.boxTitlePosition == 'over') {
											$('#fancybox-title').hide()
										}
									}

									if (op.fancyBoxParam.boxTitlePosition == 'float') {
										$('#fancybox-title').css('left', $('#fancybox-wrap').outerWidth()/2 - $('#fancybox-title').outerWidth()/2);
									}
								} else {
									var ourTitleDiv = $('.fancybox-title');
									if (ourTitleDiv.length) {
										if (ourTitleDiv.children().first().length) {
											ourTitleDiv.children().first().html(thisDescr);
										} else {
											ourTitleDiv.html(thisDescr);
										}
									}
								}
							}
						};

						var aZcallBacks = $.fn.axZm.mergeCallBackObj({onStart: onStart, onImageChange: onImageChange}, op.axZmCallBacks);

						$.fn.axZm.load({
							opt: aZcallBacks,
							path: op.axZmPath,
							parameter: 'zoomFile='+inp.zoomFile+(inp.zoomData ? '&zoomData='+inp.zoomData : '&zoomDir='+inp.zoomDir)+'&example='+op.exampleFancybox,
							divID: 'axZmWrap',
							apiFullscreen: inp.fullScreenApi
						});

					} else if (inp.ajaxZoomOpenMode == 'colorbox') {
						// Open AJAX_ZOOM in Colorbox
						if (!$.fn.axZm) {
							consoleLog(az_not_loaded);
							return;
						}

						$('#axZmTempBody, #axZmWrap').axZmRemove(true);
						var axZmWrap = $('<div />').css({display: 'none'}).attr('id', 'axZmWrap').appendTo('body');

						var onStart = function() {
							axZmWrap.css('display','');

							var thisParam = {
								opacity: 0.9,
								initialWidth: 300,
								initialHeight: 300,
								preloading: false,
								scrolling: false,
								scrollbars: false,
								title: op.colorBoxParam.title ? (inp.zoomDescr[(inp.zoomFile.split('/').reverse()[0])] || '') : false,
								onCleanup: function() {
									onBoxesClose();
									$.fn.axZm.spinStop();
									$.fn.axZm.remove();
									$('#axZmTempBody').axZmRemove(true);
									$('#axZmTempLoading').axZmRemove(true);
									$('#axZmWrap').axZmRemove(true);
								},
								inline: true,
								href: '#axZmWrap',
								ajax: false
							};

							$.colorbox($.extend(true, {}, op.colorBoxParam, thisParam));

						};

						var onImageChange = function() {
							if (op.colorBoxParam.title) {
								if (inp.zoomDescr[$.axZm.zoomGA[$.axZm.zoomID]['img']]) {
									$('#cboxTitle').html(inp.zoomDescr[$.axZm.zoomGA[$.axZm.zoomID]['img']]);
								} else {
									$('#cboxTitle').html('');
								}
							}
						};

						var aZcallBacks = $.fn.axZm.mergeCallBackObj({onStart: onStart, onImageChange: onImageChange}, op.axZmCallBacks);	

						$.fn.axZm.load({
							opt: aZcallBacks,
							path: op.axZmPath,
							parameter: 'zoomFile='+inp.zoomFile+(inp.zoomData ? '&zoomData='+inp.zoomData : '&zoomDir='+inp.zoomDir)+'&example='+op.exampleColorbox,
							divID: 'axZmWrap',
							apiFullscreen: inp.fullScreenApi
						});
					} 
				};

				var newImage = function(url) {
					var i = new Image;
					i.src = url;
					return i;
				};

				var recalculate = function(e, ni) {
					if (!_image.length) {
						$(window).unbind('resize', recalculate);
						return;
					}

					if (_wrapIframe && _wrapIframe.is('.axZm_iframe_fullscreen')) {
						return;
					}

					var parentBoxSizing = _parent.css('boxSizing');

					var wrapRef = _wrapIframe ? _wrapIframe : _wrap;
					var phR = op.parentHeightRatio;
					var pwR = op.parentWidthRatio;

					if (phR || ni) {
						if ((ni && phR == 'auto') || (ni && pwR)) {
							phR = op.parentHeightLL;
						}

						if (phR == 'auto') {
							var hh = wrapRef.innerWidth() * realH/realW;
							if (hh > realH) {
								hh = realH;
							}
						} else {
							var hh = wrapRef.innerWidth() * phR;
						}

						if (parentBoxSizing == 'border-box') {
							var tt = parseInt(_parent.css('border-top-width')) + parseInt(_parent.css('padding-top')),
							bb = parseInt(_parent.css('border-bottom-width')) + parseInt(_parent.css('padding-bottom'));
							if (tt > 0) {
								hh += tt;
							}

							if (bb > 0) {
								hh += bb;
							}
						}

						if (op.parentHeightRatio == 'auto' && op.maxHeight > 0.5) {
							var winHeight = $(window).height();
							if (hh > winHeight * op.maxHeight) {
								hh = winHeight * op.maxHeight;
							}
						}

						_parent.css('height', hh);

					} else if (pwR) {
						if (pwR == 'auto') {
							var ww = _parent.innerHeight() * realW/realH;
						} else {
							var ww = _parent.innerHeight() * pwR;
						}

						if (parentBoxSizing == 'border-box') {
							var ll = parseInt(_parent.css('border-left-width')),
							rr = parseInt(_parent.css('border-right-width'));
							if (ll > 0) {
								ww += ll;
							}
							if (rr > 0) {
								ww += rr;
							}
						}

						_parent.css('width', ww);
					}

					_image
					.stop()
					.css({width: '', height: '', maxWidth: '100%', maxHeight: '100%'})
					;

					if (!_wrapIframe && !ni) {
						width = _image.width(); // computed
						height = _image.height(); // computed

						ratio =  width / height;
						parH = wrapRef.innerHeight();
						parW = wrapRef.innerWidth();
						outerW = _parent.innerWidth();
						outerH = _parent.innerHeight();

						_image
						.css({
							left: ((parW - width)/2),
							top: ((parH - height)/2)
						});

					};

					winW = $(window).width();
					winH = $(window).height();
				};

				// IE <= 9
				var updateTimer = function() {
					var wrapRef = _wrapIframe ? _wrapIframe : _wrap;
					if (wrapRef.length && parH && parW) {
						if (winW == $(window).width() && winH == $(window).height()) {
							if (parH != wrapRef.innerHeight() || parW != wrapRef.innerWidth()) {
								recalculate();
							}
						}
					}
				};

				var setTT = function() {
					tttt = (new Date).getTime();
					scrlTS = $(window).scrollTop();
				};

				var effectMouseOver = function() {
					if (_wrap.css('display') == 'none') {
						return;
					}

					moved = true;
					setTT();

					dataDescr = _image.attr('data-descr');
					if (dataDescr) {
						_descr.html(dataDescr).stop(true, false)
						.animate({
							opacity: 1
						}, {
							easing: op.zoomEsingIn,
							duration: op.zoomInSpeed,
							complete: function() {
								_descr.css({opacity: ''})
							}
						});
					}

					if (op.zoomRatio !== 1) {
						if (supportsTrans && testTouch) {
							_image.css({
								transform: 'scale('+op.zoomRatio+')',
								transition: 'transform '+op.zoomInSpeed/1000+'s'
							});
						} else {
							_image.stop(true, false)
							.animate({
								height: height * op.zoomRatio,
								width: height*ratio * op.zoomRatio,
								maxWidth: op.zoomRatio * 100 + '%',
								maxHeight: op.zoomRatio * 100 + '%',
								marginLeft: (height*ratio - height*ratio*op.zoomRatio)/2,
								marginTop: (height - height*op.zoomRatio)/2
							}, {
								easing: op.zoomEsingIn,
								duration: op.zoomInSpeed
							});
						}
					}

					if (op.overlay === true) {
						_ovrl.stop(true, false).animate({
							opacity: op.overlayOpacity
						}, {
							easing: op.zoomEsingIn,
							duration: op.zoomInSpeed
						});
					}
				};

				var effectMouseOut = function() {
					var blendedOut = false;
					if (_wrap.css('display') == 'none') {
						blendedOut = true;
						if (!moved) {
							return;
						}
					}

					moved = false;

					if (dataDescr) {
						_descr.html(dataDescr).stop(true, false)
						.animate({
							opacity: 0
						}, {
							easing: op.zoomEsingOut,
							duration: blendedOut ? 0 : op.zoomOutSpeed
						});
					}

					if (op.zoomRatio !== 1) {
						if (supportsTrans && testTouch) {
							_image.css({
								transform: 'scale(1)',
								transition: 'transform '+op.zoomOutSpeed/1000+'s'
							});
						} else {
							_image.stop()
							.animate({
								maxWidth: '100%',
								maxHeight: '100%',
								height: height,
								width: width,
								marginLeft: 0,
								marginTop: 0
								}, {
								easing: op.zoomEsingOut,
								duration: blendedOut ? 0 : op.zoomOutSpeed,
								complete: function() {
									_image.css({
										height: '',
										width: ''
									})
								}
							});
						}
					}

					if (op.overlay) {
						_ovrl.stop()
						.animate({
							opacity: 0
						}, { 
							easing: op.zoomEsingOut,
							duration: blendedOut ? 0 : op.zoomOutSpeed
						});
					}
				};

				var imgOnLoad = function() {
					$('<img>')
					.axZmLoad(function() {
						if (op.overlay === true) {
							_ovrl = $('<div />')
							.addClass('azHoverThumbOverlay')
							.css({
								opacity: 0,
								display: 'block',
								backgroundColor: op.overlayColor
							})
							.appendTo(_wrap); 
						}

						_descr = $('<div />')
						.addClass('azHoverThumbDescr')
						.css({display: 'block', opacity: 0})
						.appendTo(_wrap); 

						_trap = $('<div />')
						.bind('mouseup touchend', clickAZ)
						.addClass('azHoverThumbTrap')
						.css({display: 'block'})
						.appendTo(_wrap); 

						_image.css({opacity: 0.01, display: 'block'});

						realW = _image[0].naturalWidth || newImage(_image.attr('src')).width;
						realH = _image[0].naturalHeight || newImage(_image.attr('src')).height;

						recalculate();

						winW = $(window).width();
						winH = $(window).height();

						if (browser.msie && browser.versionNumber <= 9) {
							// ResizeSensor does not work on real IE9 for some reason
							_image.data('ieTimer', setInterval(updateTimer, 500));
						} else {
							new resSensor(_wrap[0], function() {
								// ResizeSensor does not always work on maximizing window with media queries
								if (winW == $(window).width() && winH == $(window).height()) {
									recalculate();
								}
							});
						}

						$(window).bind('resize', recalculate);

						_image
						.animate({
							opacity: 1
						},{
							duration: op.fadeInSpeed,
							complete: function() {
								_wrap.css('background-image', 'none');

								_trap
								.bind('mousedown', setTT)
								.bind('mouseenter touchstart', effectMouseOver)
								.bind('mouseleave touchend', effectMouseOut);

								if (document.readyState != 'complete') {
									$(document).ready(recalculate);
								}
							}
						});

					}).attr('src', _image.attr('src'));
				};

				if (_image.attr('src')) {
					imgOnLoad();
				} else {
					var dataImg = _image.attr('data-img');
					if (dataImg) {
						var fname = dataImg.replace(/^.*[\\\/]/, '').replace(/\.[^/.]+$/, '');
						recalculate(null, true);
						var waitIvl = null;
						var waitSrc = function() {
							var imgSrc = _image.attr('src');
							if (imgSrc && imgSrc.indexOf(fname) != -1) {
								clearInterval(waitIvl);
								waitIvl = null;
								imgOnLoad();
							}
						};

						waitIvl = setInterval(waitSrc, 1000);
					}
				}
			});
		}
	});

	// ResizeSensor.js
	// Copyright (c) 2013 Marc J. Schmidt
	// License: http://www.opensource.org/licenses/mit-license.php

	;(function() {

		this.resSensor = function(element, callback) {

			function EventQueue() {
				this.q = [];
				this.add = function(ev) {
					this.q.push(ev);
				};

				var i, j;
				this.call = function() {
					for (i = 0, j = this.q.length; i < j; i++) {
						this.q[i].call();
					}
				};
			}

			function getComputedStyle(element, prop) {
				if (element.currentStyle) {
					return element.currentStyle[prop];
				} else if (window.getComputedStyle) {
					return window.getComputedStyle(element, null).getPropertyValue(prop);
				} else {
					return element.style[prop];
				}
			}

			function attachResizeEvent(element, resized) {
				if (!element.resizedAttached) {
					element.resizedAttached = new EventQueue();
					element.resizedAttached.add(resized);
				} else if (element.resizedAttached) {
					element.resizedAttached.add(resized);
					return;
				}

				element.resizeSensor = document.createElement('div');
				element.resizeSensor.className = 'resize-sensor';
				var style = 'position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: scroll; z-index: -1; visibility: hidden;';
				var styleChild = 'position: absolute; left: 0; top: 0;';

				element.resizeSensor.style.cssText = style;
				element.resizeSensor.innerHTML =
				'<div class="resize-sensor-expand" style="' + style + '">' +
				'<div style="' + styleChild + '"></div>' +
				'</div>' +
				'<div class="resize-sensor-shrink" style="' + style + '">' +
				'<div style="' + styleChild + ' width: 200%; height: 200%"></div>' +
				'</div>';

				element.appendChild(element.resizeSensor);

				if (!{fixed: 1, absolute: 1}[getComputedStyle(element, 'position')]) {
					element.style.position = 'relative';
				}

				var expand = element.resizeSensor.childNodes[0];
				var expandChild = expand.childNodes[0];
				var shrink = element.resizeSensor.childNodes[1];
				var shrinkChild = shrink.childNodes[0];

				var lastWidth, lastHeight;

				var reset = function() {
					expandChild.style.width = expand.offsetWidth + 10 + 'px';
					expandChild.style.height = expand.offsetHeight + 10 + 'px';
					expand.scrollLeft = expand.scrollWidth;
					expand.scrollTop = expand.scrollHeight;
					shrink.scrollLeft = shrink.scrollWidth;
					shrink.scrollTop = shrink.scrollHeight;
					lastWidth = element.offsetWidth;
					lastHeight = element.offsetHeight;
				};

				reset();

				var changed = function() {
					element.resizedAttached.call();
				};

				var addEvent = function(el, name, cb) {
					if (el.attachEvent) {
						el.attachEvent('on' + name, cb);
					} else {
						el.addEventListener(name, cb);
					}
				};

				addEvent(expand, 'scroll', function() {
					if (element.offsetWidth > lastWidth || element.offsetHeight > lastHeight) {
						changed();
					}
					reset();
				});

				addEvent(shrink, 'scroll',function() {
					if (element.offsetWidth < lastWidth || element.offsetHeight < lastHeight) {
						changed();
					}
					reset();
				});
			}

			attachResizeEvent(element, callback);
		}

	})();
})(jQuery);