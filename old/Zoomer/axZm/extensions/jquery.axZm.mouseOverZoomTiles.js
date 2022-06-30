/*!
* Extension: jQuery AJAX-ZOOM, jquery.axZm.mouseOverZoomTiles.js
* Copyright: Copyright (c) 2010-2017 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.3
* Extension Date: 2017-08-07
* URL: http://www.ajax-zoom.com
* Documentation && examples: http://www.ajax-zoom.com/examples/example20.php
*/

(function($) {
	$.mouseOverZoomTiles = function(options) {
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

		// Helper function
		var consoleLog = function(a) {
			if (op.debug && window.console && $.isFunction(window.console.log)) {
				console.log(a);
			}
		};

		// Helper function
		var getl = function(sep, str) {
			return str.substring(str.lastIndexOf(sep)+1);
		};

		// Helper function
		var getf = function(sep, str) {
			var extLen = getl(sep, str).length;
			return str.substring(0, (str.length - extLen - 1));
		};

		// Helper function
		var isInt = function(a) {
			return (typeof a==='number' && (a%1)===0);
		};

		// Helper function
		var getRelDim = function(w, h) {
			if (typeof w == 'string' && w.length > 1 && w != 'auto') {
				var tempPar = w.split('|'), relDivW = $(tempPar[0]);
				if (relDivW.length) {
					w = relDivW.outerWidth();
				}
				if (tempPar[1]) {
					w += parseInt(tempPar[1]);
				}
			}

			if (typeof h == 'string' && h.length > 1 && h != 'auto') {
				var tempPar = h.split('|'), relDivH = $(tempPar[0]);
				if (relDivH.length) {
					h = relDivH.outerHeight();
				}
				if (h && tempPar[1]) {
					h += parseInt(tempPar[1]);
				}
			}
			return [w, h];
		};

		// Helper function
		var isTouch = function() {
			var touchName = 'ontouchstart';
			var userAgent = navigator.userAgent.toLowerCase();
			return (!(userAgent.indexOf('windows') != -1) && (touchName in window || touchName in document.documentElement || userAgent.indexOf("android") > -1));
		};

		// Helper function
		var mediaQueryFullWidth = function() {
			if ((isTouch() && op.disableTouchMouseover) || op.mediaQueryFullWidth > 100 && window.innerWidth <= op.mediaQueryFullWidth) {
				return true;
			}
			return false;
		};

		var classChange = function() {
			var mediaQueryFullWidthRequest = mediaQueryFullWidth();
			if (divID && divID.length) {
				if (mediaQueryFullWidthRequest == true) {
					divID.addClass('mouseOverTilesZoomInner');
					abortHideAndShow();

					if ($.axZm) {
						$.axZm.icons.fullScreenCornerInit = btnFullscreen; 
						$.axZm.autoZoom.enabled = false;
					}
				} else {
					divID.removeClass('mouseOverTilesZoomInner');

					if ($.axZm) {
						$.axZm.autoZoom.enabled = true;
						$.axZm.icons.fullScreenCornerInit = btnEmpty;
					}
				}
			}
		};

		var flyoutTopLeft = function(get) {
			consoleLog('flyoutTopLeft');

			var mediaQueryFullWidthRequest = mediaQueryFullWidth();
			if (mediaQueryFullWidthRequest === true) {
				var l = 0;
				var t = 0;
			} else {
				var l = mapDiv.position().left + mapDiv.outerWidth() + op.adjustX;
				var t = mapDiv.position().top + op.adjustY;
			}

			if (get) {
				return {left: l, top: t}
			} else if (divID.length) {
				divID.css({left: l, top: t});
				classChange();
			}
		};

		// Set width / height
		var setZoomDim = function(get, tt) {
			consoleLog('setZoomDim');

			var targetWidth, 
			targetHeight, 
			relDim = [], 
			mediaQueryFullWidthRequest = mediaQueryFullWidth();

			if (mediaQueryFullWidthRequest) {
				targetWidth = mapDiv.width();
				targetHeight = mapDiv.height();
			} else {
				if (!isInt(op.zoomWidth) || !isInt(op.zoomHeight)) {
					relDim = getRelDim(op.zoomWidth, op.zoomHeight);
				}

				if (isInt(op.zoomWidth)) {
					targetWidth = op.zoomWidth;
				} else if (typeof op.zoomWidth == 'string') {
					if (isInt(relDim[0])) {
						targetWidth = relDim[0];
					} else {
						// auto
						targetWidth = $(window).width() - (mapDiv.offset().left - $(window).scrollLeft() + mapDiv.outerWidth() + op.adjustX + op.autoMargin)
					}
				}

				if (isInt(op.zoomHeight)) {
					targetHeight = op.zoomHeight;
				} else if (typeof op.zoomHeight == 'string') {
					var autoH = $(window).height() - (mapDiv.offset().top - $(window).scrollTop() + op.adjustY + op.autoMargin);
					if (isInt(relDim[1])) {
						targetHeight = relDim[1];
						if (targetHeight > autoH) {
							targetHeight = autoH;
						}
					} else {
						// auto
						targetHeight = autoH;
					}
				}
			}

			if (!get && (targetWidth != zoomWidth || targetHeight != zoomHeight)) {
				divID.css({
					width: targetWidth,
					height: targetHeight
				});
				//console.log('$.fn.axZm.resizeStart');
				$.fn.axZm.resizeStart(tt ? 0 : 500);
			}

			zoomWidth = targetWidth;
			zoomHeight = targetHeight;

			return {
				width: zoomWidth,
				height: zoomHeight
			}
		};

		var abortHideAndShow = function() {
			consoleLog('abortHideAndShow');
			if (divID && divID.length) {
				divID
				.stop(true, false)
				.css({
					display: 'block',
					opacity: 1
				});
			}
		};

		// Hide zoomlayer
		var triggerHide = function(t) {
			consoleLog('triggerHide');

			if (!isInt(t)) {
				t = op.fadeOutTimeout;
			}
			if (removeHoverTimeout) {
				clearTimeout(removeHoverTimeout);
			}

			var mediaQueryFullWidthRequest = mediaQueryFullWidth();

			if (!mediaQueryFullWidthRequest) {
				removeHoverTimeout = setTimeout(function() {
					$('#axZm_zoomMapSel').css('display', 'none');

					if (op.zoomLevel == 'map' && zoomLevelWrap) {
						zoomLevelWrap.css('display', 'none');
					}

					if (mouseOverTilesMsg.length) {
						mouseOverTilesMsg.css('display', 'none');
					}

					divID.stop(true, false)
					.fadeTo(t > 1 ? op.fadeOutSpeed : 0, 0, function() {
						divID.css('display', 'none');
					});
					}, t);
			}
		};

		// Show zoomlayer
		var triggerShow = function(e) {
			consoleLog('triggerShow');

			if (removeHoverTimeout) {
				clearTimeout(removeHoverTimeout);
			}

			var mediaQueryFullWidthRequest = mediaQueryFullWidth();

			if (!mediaQueryFullWidthRequest) {
				abortHideAndShow();
				$('#axZm_zoomMapSel')
				.css('display', 'block')

				if (zoomLevelWrap) {
					zoomLevelWrap.css('display', 'block');
				}

				if (mouseOverTilesMsg.length &&  e.type.indexOf('mouse') != -1) {
					mouseOverTilesMsg.css('display', 'block');
				}

			}

			/*
			$('body').unbind('click.closeMouseOverTiles')
			.bind('click.closeMouseOverTiles', function() {
			$(this).unbind('click.closeMouseOverTiles');
			triggerHide(0);
			});
			*/
		};

		// Preloaf a thumb (p) and replace an image
		var preloadThumb = function(o, p) {
			$('<img>').axZmLoad(function() {
				o.attr('src', p)
				.removeAttr('width')
				.removeAttr('height');
			}).attr('src', p);
		};

		// Dynamic thumb path
		var f_dynThumbPath = function(previewDir, previewPic) {
			return 	op.axZmPath+'zoomLoad.php'+'?'
			+'previewDir='+previewDir
			+'&previewPic='+previewPic
			+'&qual='+op.thumbQual
			+'&width='+(op.thumbRetina ? op.thumbWidth*2 : op.thumbWidth)
			+'&height='+(op.thumbRetina ? op.thumbHeight*2 : op.thumbHeight)
			+'&cache='+op.thumbsCache
			+'&thumbMode='+op.thumbMode
			+'&backColor='+op.thumbBackColor
			;
		};

		// Defaults
		var defaults = {
			debug: false,
			axZmPath: "auto", // path to /axZm directory, e.g. /test/axZm/ or "auto" (auto might not always work)
			divID: "mouseOverTilesZoom", // ID of the flyout zoom, will be created instantly
			mapDivID: "mouseOverTilesMapContainer", // ID of the container for mouseover element
			galleryDivID: 'mouseOverTilesGallery', // ID of the container where thumbnails will be inserted into
			example: "mouseOverTiles", // configuration set which is passed to ajax-zoom (see /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 'mouseOverTiles')
			images: {}, // paths to source images
			firstImageToLoad: 1, // if "images" option contains more than one image, this option defines which image should be loaded fist. Index (starts with 1) or image name
			showGallery: true, // enable / disable gallery
			galleryAxZmThumbSlider: true, // use $.axZmThumbSlider for the gallery. If false a different Ul->LI structure will be applied without scrolling capeability

			mediaQueryFullWidth: null,

			thumbWidth: 86, // width of the thumbnail image
			thumbHeight: 86, // height of the thumbnail image
			thumbsCache: true, // cache thumbnails
			thumbRetina: true, // true will double the resolution of the thumbnails
			thumbQual: 90, // jpg quality of the thumbnail image
			thumbMode: false, // possible values: "contain", "cover" or false
			thumbBackColor: "#FFFFFF", // background color of the thumb if thumbMode is set to "contain"

			thumbPadding: null, // quickly overwrite the css padding of the thumbs 
			thumbMarginRight: null ,// quickly overwride the css margin to the right of the thumbs 
			thumbMarginBottom: null, // quickly overwride the css margin to the bottom of the thumbs 
			thumbCss: {}, // Quickly overwride any other CSS 
			thumbPreloadingImg: "ajax-loader-map-white.gif", // Image located in /axZm/icons folder

			// $.axZmThumbSlider options if used - "galleryAxZmThumbSlider" option set to true
			galleryAxZmThumbSliderParam: {
				scrollBy: 3,
				smoothMove: 6,
				quickerStop: true,
				pressScrollSnap: true,
				btn: true,
				btnClass: "axZmThumbSlider_button_new",
				btnBwdStyle: {
					marginLeft: -24, 
					marginRight: 0
				},
				btnFwdStyle: {
					marginLeft: 0, 
					marginRight: -24
				},
				btnLeftText: null, 
				btnRightText: null, 
				btnTopText: null, 
				btnBottomText: null,
				mouseWheelScrollBy: null,
				wrapStyle: {
					borderTopWidth: 0, 
					borderBottomWidth: 0
				},
				scrollbar: false,
				liImgAsBack: false,
				thumbLiSubClass: {
					first: null,
					last: null 
				},
				thumbImgStyle:{
					maxWidth: "86px", 
					maxHeight: '86px'
				},
				thumbLiStyle: {
					width: 86, 
					height: 86, 
					lineHeight: "86px",
					marginBottom: 2,
					marginLeft: 3,
					marginRight: 4,
					borderRadius: 0
				}
			},

			fadeOutTimeout: 400, // time after which flyout disappears if mouse leaves mouseover zoom
			fadeOutSpeed: 300, // speed of fade out for mouse over

			zoomLevel: "map", // show zoom level value, possible option values: map, zoom

			//width: "auto", // width of the mouse image or "auto" (depends on "mapDivID" element width)
			//height: "auto", // height of the mouse image or "auto" (depends on "mapDivID" element height)

			heightRatio: '1.0|+140',
			disableTouchMouseover: true, 
			// width of the fly out window; possible values integer - fixed width, 'auto' - available space to the right minus "autoMargin",
			// selector - e.g. #descrDiv which could be the id of the element to the right of mouseover zoom.
			zoomWidth: 500, 
			zoomHeight: 500, // height if the fly out, same as zoomWidth except that when set to some selector, the height can default to "auto" which just makes sense.
			autoMargin: 10, // if zoomWidth or zoomHeight are set to "auto", the margin to the edge of the screen
			adjustX: 20, // space between mouse over zoom ("mapDivID") and flyout window to the right
			adjustY: -1, // vertical shift of the flyout window
			fullScreenApi: true, // try to open AJAX-ZOOM at browsers fullscreen mode, possible on modern browsers 
			mapSelSmoothDrag: false, // activate smooth drag
			mapSelSmoothDragSpeed: 500, // speed of the dragging
			scrollZoom: 11, // prc zoom on mouse scroll
			mapMouseWheel: true, // enable disable scroll with the mousewheel
			axZmCallBacks: {} // callbacks which can be passed to AJAX-ZOOM
		};

		var onResizeAdjustments = function() {
			adjustMapHeight();
			var ww = mapDiv.innerWidth();
			var hh = mapDiv.innerHeight();
			var mediaQueryFullWidthRequest = mediaQueryFullWidth();

			$.fn.axZm.resetMap(ww, hh, ww, hh);
			flyoutTopLeft();
			setZoomDim();

			if (mediaQueryFullWidthRequest === true) {
				abortHideAndShow();
			} else {
				divID.css('display', 'none');
			}
		};

		var adjustMapHeight = function() {
			if (op.heightRatio) {
				var w = mapDiv.width();
				var hArr = op.heightRatio.split('|');
				var h = w * parseFloat(hArr[0]);
				var hhAdj = hArr[1] ? parseFloat(hArr[1]) : 0;
				if (h + hhAdj > $(window).height()) {
					h = $(window).height() - hhAdj;
				}

				h = Math.max(h, 200); // min height 200

				mapDiv.css('height', h);
			}
		};

		// Local vars
		// Override defaults by user setting
		var op = $.extend(true, {}, defaults, options),
		removeHoverTimeout = null,
		allImages = [],
		mapDiv = $('#'+op.mapDivID),
		galleryDiv = $('#'+op.galleryDivID),
		mouseOverTilesMsg = $('.mouseOverTilesMsg'),
		zoomLevelWrap,
		zoomWidth,
		zoomHeight,
		lastScrollTop,
		ul = $('<ul />'),
		liCss = {},
		btnFullscreen = {},
		btnEmpty = {
			file: 'empty',
			ext: 'gif',
			w: 42,
			h: 42
		};

		// Default callbacks passed to AJAX-ZOOM
		var axZmCallBacksDefault = {
			onBeforeStart: function() {
				var mediaQueryFullWidthRequest = mediaQueryFullWidth();

				// We can set some (not all) options within onBeforeStart callback
				// Some options are just passed over $.mouseOverZoomTiles options
				$.axZm.useMap = true;
				$.axZm.mapParent = op.mapDivID;
				$.axZm.mapMouseOver = true;

				$.axZm.mapWidth = mapDiv.innerWidth();
				$.axZm.mapHeight = mapDiv.innerHeight();
				$.axZm.fullScreenMapWidth = mapDiv.innerWidth();
				$.axZm.fullScreenMapHeight = mapDiv.innerHeight();

				$.axZm.mapParCenter = true;
				$.axZm.zoomMapAnimate = false;
				$.axZm.zoomMapVis = false;
				$.axZm.dragMap = false;
				$.axZm.zoomMapRest = false;
				$.axZm.zoomMapContainment = false;
				$.axZm.mapSelSmoothDrag = op.mapSelSmoothDrag;
				$.axZm.mapSelSmoothDragSpeed = op.mapSelSmoothDragSpeed;

				$(window).bind('resize.mozt orientationchange.mozt', onResizeAdjustments);

				$.axZm.autoZoom = {
					enabled: true,
					onlyFirst: false,
					fullscreen: false,
					speed: 0,
					motion: 'swing',
					pZoom: 'max'
				};

				$.axZm.fullScreenKeepZoom.init = true;
				$.axZm.fullScreenKeepZoom.restore = true;
				$.axZm.fullScreenKeepZoom.resize = true;
				$.axZm.scrollZoom = parseInt(op.scrollZoom);
				$.axZm.mapMouseWheel = op.mapMouseWheel;

				// Hide open fullscreen button (vadim: new option?)

				btnFullscreen = $.extend(true, {}, $.axZm.icons.fullScreenCornerInit);
				$.axZm.icons.fullScreenCornerInit = btnEmpty;

				if (mediaQueryFullWidthRequest === true) {
					$.axZm.autoZoom.enabled = false;
					$.axZm.icons.fullScreenCornerInit = btnFullscreen;
				}

			},
			onMapMouseOverEnter: function(e) {
				var mediaQueryFullWidthRequest = mediaQueryFullWidth();
				if (mediaQueryFullWidthRequest === false) {
					flyoutTopLeft();
					triggerShow(e);
				}
			},
			onMapMouseOverLeave: function(e) {
				var mediaQueryFullWidthRequest = mediaQueryFullWidth();
				if (mediaQueryFullWidthRequest === false) {
					triggerHide();
				}
			},
			onLoad: function() {
				// trigger mouseover on laoding when mouse is over map
				if (!(browser.msie && browser.versionNumber < 9) && $('#axZm_zoomMapHolder').is(':hover')) {
					triggerShow({type: 'mouse'});
				} else {
					$('#axZm_zoomMapSel').css({display: 'none'});
				}

				// Prevent closing zoom area when mouse is over it
				divID
				.bind('mouseenter.mozt touchstart.mozt', function() {
					if (removeHoverTimeout) {
						clearTimeout(removeHoverTimeout);
					}

				})
				.bind('mouseleave.mozt touchend.mozt', function(e) {
					var mediaQueryFullWidthRequest = mediaQueryFullWidth();
					if (mediaQueryFullWidthRequest === false) {
						e.stopPropagation();
						triggerHide();
					}
				})
				.bind('mouseup.mozt', function(e) {
					if (!(browser.msie && e.type && e.type.indexOf('mouse') == 0)) {
						e.stopPropagation();
					}
				});

				if (op.zoomLevel) {
					zoomLevelWrap = $('<div />')
					.addClass('mouseOverZoomLevelWrap')
					.append($('#axZm_zoomLevel'));

					if (op.zoomLevel == 'map') {
						zoomLevelWrap.appendTo(mapDiv)
					} else if (op.zoomLevel == 'zoom') {
						zoomLevelWrap.appendTo('#axZm_zoomLayer')
					} else {
						var zoomLevelTarget = $(op.zoomLevel);
						if (zoomLevelTarget.length) {
							zoomLevelWrap.appendTo(zoomLevelTarget);
						}
					};
				}

				mapDiv.bind('mouseenter.mozt touchstart.mozt', function() {
					setZoomDim(0,1);
				});

				if (op.galleryAxZmThumbSlider == true) {
					galleryDiv.axZmThumbSlider('scrollTo', {
						thumb: $.axZm.zoomID,
						triggerClick: false,
						highlight: true
					})
				} else {
					$('li:eq('+($.axZm.zoomID-1)+')', ul).addClass('selected');
				}

				// Bind click event to zoom icon if present
				$('.mouseOverTilesEnlarge')
				.bind('click', function(e) {
					$.axZm.fullScreenKeepZoom.resize = false;
					e.stopPropagation();
					$.fn.axZm.initFullScreen();
					setTimeout(function() {
						$.axZm.fullScreenKeepZoom.resize = true;
						},1);
				});
			},
			// alternative: onMapMouseOverDbClick
			onMapMouseOverClick: function() {
				$.fn.axZm.initFullScreen();
			},
			onFullScreenCloseEndFromRel: function() {
				if (mediaQueryFullWidth() === false) {
					consoleLog('onFullScreenCloseEndFromRel');
					if (!(browser.msie && browser.versionNumber < 9) && !$('#axZm_zoomMapHolder').is(':hover')) {
						triggerHide(1);
					} else {
						triggerHide(1);
					}

					setTimeout(function() {
						$.fn.axZm.clearTiles(true);
						$.fn.axZm.zoomTo({
							speed: 0,
							speedZoomed: 0,
							ajxTo: 0,
							zoomLevel: '100%'
						});
						}, 1);
				}
			},
			onImageChange: function() {
				consoleLog('onImageChange');
				if (op.galleryAxZmThumbSlider == true) {
					galleryDiv.axZmThumbSlider('scrollTo', {
						thumb: $.axZm.zoomID,
						triggerClick: false,
						highlight: true
					});
				} else {
					$('li', ul).removeClass('selected');
					$('li:eq('+($.axZm.zoomID-1)+')', ul).addClass('selected');
				}
			},
			onResizeEnd: function() {
				consoleLog('onResizeEnd');
				$.fn.axZm.setCornerButton();
			}
		};

		// Merge default and user passed callbacks
		var axZmCallBacks = $.fn.axZm.mergeCallBackObj(axZmCallBacksDefault, op.axZmCallBacks);

		// Set thumbnail width etc. instantly only if not overriden by user
		if (!options.galleryAxZmThumbSliderParam && (options.thumbWidth || options.thumbHeight)) {
			op.galleryAxZmThumbSliderParam.thumbImgStyle.maxWidth = op.thumbWidth+'px';
			op.galleryAxZmThumbSliderParam.thumbImgStyle.maxHeight = op.thumbHeight+'px';
			op.galleryAxZmThumbSliderParam.thumbLiStyle.width = op.thumbWidth;
			op.galleryAxZmThumbSliderParam.thumbLiStyle.height = op.thumbHeight;
			op.galleryAxZmThumbSliderParam.thumbLiStyle.lineHeight = op.thumbHeight;
		}

		// Patch images is just an array (no titles etc, only source images)
		if ($.isArray(op.images)) {
			op.images = {};
			$.each(options.images, function(k, v) {
				op.images[k+1] = {img: v};
			});
		}

		// Try to get /axZm path instantly
		if (op.axZmPath == 'auto') {
			if ($.isFunction($.fn.axZm)) {
				op.axZmPath = $.fn.axZm.installPath();
			} else {
				alert('jquery.axZm.js is not loaded');
				return;
			}
		}

		// Add slash to /axZm path
		if (op.axZmPath.slice(-1) != '/') {
			op.axZmPath = op.axZmPath + '/';
		}

		// ell with mapDivID required
		if (!mapDiv.length) {
			if ($.isReady) {
				alert('div with ID '+op.mapDivID+' is not present');
				return;
			} else {
				$(document).ready(function() {
					$.mouseOverZoomTiles(options);
				});
				return;
			}
		}

		// add class to galleryDivID
		if (galleryDiv.length) {
			galleryDiv.addClass('mouseOverTilesGallery');
		}

		// Add class to mapDivID
		mapDiv.addClass('mouseOverTilesMapContainer');
		adjustMapHeight();

		// Create div where we put actual AZ into
		var divID = $('<div />')
		.addClass('mouseOverTilesZoom')
		.css(flyoutTopLeft(1))
		.css(setZoomDim(1))
		.attr('id', op.divID)
		.appendTo(mapDiv.parent());

		classChange();

		// Some inline settings if axZmThumbSlider is not used
		if (op.thumbPadding >= 0) {
			liCss.padding = op.thumbPadding;
		}
		if (op.thumbMarginRight >= 0) {
			liCss.marginRight = op.thumbMarginRight;
		}
		if (op.thumbMarginBottom >= 0) {
			liCss.marginBottom = op.thumbMarginBottom;
		}

		// Loop over passed images
		$.each(op.images, function(k, v) {
			// Gather images into array
			allImages.push(v.img);

			// Gallery
			if (v.img && op.showGallery && galleryDiv.length) {
				var li = $('<li />')
				// use $.fn.axZm.zoomSwitch API to switch between images
				.bind('click', function() {
					if (!$.axZm.zoomGA) {
						return;
					}
					var switchToImg = getl('/', v.img),
					curImage = $.axZm.zoomGA[$.axZm.zoomID]['img'];
					if (switchToImg != curImage) {
						$.fn.axZm.zoomSwitch(switchToImg);
					}
				});

				// Source of the thumb image
				var imgSrc = v.thumb || f_dynThumbPath(getf('/', v.img), getl('/', v.img));

				// Preloading image
				var img = $('<img>')
				.attr('src', op.axZmPath+'icons/'+op.thumbPreloadingImg)
				.addClass(op.galleryAxZmThumbSlider == true ? '' : 'thumb')
				.appendTo(li);

				if (op.galleryAxZmThumbSlider != true) {
					$('<span />').text(' ').addClass('vAlign').appendTo(li);
					li.css(liCss).css(op.thumbCss);
				}

				// Preload actual thumb
				preloadThumb(img, imgSrc);

				// Append li to ul
				li.appendTo(ul);
			}
		});

		// Empty taget div and append resulting UL
		galleryDiv.empty().append(ul);

		if (op.galleryAxZmThumbSlider == true) {
			// Fire axZmThumbSlider if enabled
			galleryDiv.axZmThumbSlider(op.galleryAxZmThumbSliderParam);
		} else {
			// Add some class to UL element to show LI's as thumbs 
			ul.addClass('mouseOverTilesThumb');
		}

		// Trigger AJAX-ZOOM (responsive)
		$.fn.axZm.openFullScreen(
			op.axZmPath, // path to AJAX-ZOOM directory, e.g. '/axZm/'
			'zoomData='+allImages.join('|')+'&zoomID='+op.firstImageToLoad+'&example='+op.example, // query string to determin which images to load
			axZmCallBacks, // JS object containing callback functions
			op.divID, // target
			op.fullScreenApi, // use browser fullscreen mode if available
			true, // prevent closing with Esc key
			false // use POST instead of GET 
		);

	}
})(jQuery);
