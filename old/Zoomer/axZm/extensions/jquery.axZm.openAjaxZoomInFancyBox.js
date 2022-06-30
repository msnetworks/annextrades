/*!
* Extension: jQuery AJAX-ZOOM, jquery.axZm.openAjaxZoomInFancyBox.js
* Copyright: Copyright (c) 2010-2018 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 1.20
* Extension Date: 2018-03-25
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
* Extension usage: http://www.ajax-zoom.com/examples/example27.php
*/

/*
$(selector).openAjaxZoomInFancyBox(
axZmPath: "../axZm/",
queryString: "example=23&zoomData=/pic/zoom/boutique/bag_0.jpg|/pic/zoom/boutique/bag_6.jpg",
fullScreenApi: false
);

or

<a href="javascript: void(0)" onclick="$.openAjaxZoomInFancyBox('example=23&zoomData=/pic/zoom/boutique/bag_0.jpg|/pic/zoom/boutique/bag_6.jpg')">
*/

;(function($) {

	$.openAjaxZoomInFancyBox = function(options) {

		// Defaults
		var defaults = {
			axZmPath: 'auto', // Path to AJAX-ZOOM, e.g. /zoomTest/axZm/
			queryString: null, // Single string which determines which images will be loaded
			loadingMsg: 'Loading, please wait...',
			fullScreenCloseBox: false, // when closing fullscreen close fancybox as well 
			fullScreenApi: false, // use browsers fullscreen api when maximizing AJAX-ZOOM
			ajaxZoomCallbacks: {}, // AJAX-ZOOM callbacks, some are set in this plugin and are merged
			iframeMode: false,
			iframe: false,
			scrolling: 'no',
			href: false,
			fromOpened: false,
			postMode: null,
			ref: false,
			escTxt: false,

			// Fancybox translated parameters
			boxMargin: 30,
			boxPadding: 10,
			boxCenterOnScroll: true,
			boxOverlayShow: true,
			boxOverlayOpacity: 0.75,
			boxOverlayColor: '#777',
			boxTransitionIn: 'fade', // 'elastic', 'fade' or 'none'
			boxTransitionOut: 'fade', // 'elastic', 'fade' or 'none'
			boxSpeedIn: 300,
			boxSpeedOut: 300,
			boxEasingIn: 'swing',
			boxEasingOut: 'swing',
			boxShowCloseButton: true, // close button
			boxEnableEscapeButton: true,
			boxOnClosed: function() {},
			boxOnComplete: function() {},
			boxOnCleanup: function() {}
		};

		if (!$.fancybox) {
			window.alert('AJAX-ZOOM: $.fancybox 1 or 2 javscript is not present');
			return;
		}

		if (typeof options == 'object') {
			var op = $.extend(true, {}, defaults, options);
		} else {
			var op = defaults;
			op.queryString = options;
		}

		// Override defaults by user setting
		var op = $.extend(true, {}, defaults, options);

		if (op.href) {
			op.queryString = op.href;
		}

		if (op.iframe) {
			op.iframeMode = true;
		}

		if (op.fromOpened) {
			op.queryString = 'fakeString';
		}

		op.queryString = op.queryString.replace(/\s+/, '%20');
		if (op.fromOpened) {
			op.fullScreenCloseBox = false;
		}

		// Some checks
		if (!op.queryString) {
			alert('Please define queryString that you want to pass to AJAX-ZOOM');
			return;
		}

		// iframe?
		var ifReg = new RegExp('(iframe:)', 'gi');
		var iframeMode = op.iframeMode || ifReg.test(op.queryString);
		var hrefIframe = op.queryString.replace(ifReg, '');
		if (iframeMode) {
			if (hrefIframe.indexOf('?') != -1) {
				hrefIframe += '&';
			} else {
				hrefIframe += '?';
			}

			hrefIframe += 'iframeID=fancybox-frame';
		}

		if (!iframeMode && !$.isFunction($.fn.axZm)) {
			alert('AJAX-ZOOM JavaScript file is not included');
			return;
		}

		// Define the path to the axZm folder, adjust the path if needed! Best of all set absolute path to axZm
		// Try to get /axZm path instantly
		if (!iframeMode && op.axZmPath == 'auto') {
			op.axZmPath = $.fn.axZm.installPath();
		}

		// Patch fancybox 2.x, 3.x
		var newFancybox = $.isFunction($.fancybox) && $.type($.fancybox.defaults) == "object";
		if ($.fancybox.version && parseInt($.fancybox.version) > 2) {
			var consoleLog = function(a) {
				if (typeof console != 'undefined') {
					console.log(a);
				}
			};

			consoleLog('Fancybox 3 is not supported. Apparently Fancybox 3 files are present at this page.');

			if (!iframeMode) {
				consoleLog('AJAX-ZOOM is opened at fullscreen');
				$.fn.axZm.openFullScreen(
					op.axZmPath,
					op.queryString,
					op.ajaxZoomCallbacks,
					'window',
					false
				);
			} else {
				consoleLog('AJAX-ZOOM is not opened');
			}

			return;
		}

		var fancyEll = {};
		if (!newFancybox) {
			fancyEll = { 
				content: '#fancybox-content',
				outer: '#fancybox-outer',
				wrap: '#fancybox-wrap'
			};
		} else {
			fancyEll = {
				content: '.fancybox-inner',
				outer: '.fancybox-outer',
				wrap: '.fancybox-wrap'
			};
		}

		// Scrollbar fix for fancybox
		var scrollBarFixFancybox = function() {
			var root = document.compatMode == 'BackCompat' ? document.body : document.documentElement;
			if (root.scrollWidth > root.clientWidth) {
				$(window).trigger('resize');
				$.fn.axZm.resizeStart(100);
			} else {
				$(window).trigger('resize');
				$.fn.axZm.resizeStart(100);
			}
		};

		if (!iframeMode) {
			op.ajaxZoomCallbacks = $.fn.axZm.mergeCallBackObj(op.ajaxZoomCallbacks, {
				onFullScreenCloseEndFromRel: function() {
					if (op.fullScreenCloseBox) {
						$.fancybox.close();
						return;
					}

					scrollBarFixFancybox();
				}
			});
		}

		if (op.ref) {
			$('#'+op.ref).data('axZmrespFancyBox', op);
		}

		// Calculations of the width and hight passed to fancybox
		var boxW = $(window).width() - op.boxPadding*2 - op.boxMargin*2;
		var boxH = (window.innerHeight ? window.innerHeight : $(window).height()) - op.boxPadding*2 - op.boxMargin*2;

		// Helper object to adjust fancybox width and height when browser window resizes
		var fanyDim = {};

		var cBoxOnWinResize = function() {
			var difW = $(window).width() - fanyDim.wW;
			var difH = (window.innerHeight ? window.innerHeight : $(window).height()) - fanyDim.wH;

			$(fancyEll.content).css({
				width: fanyDim.fCw + difW,
				height: fanyDim.fCh + difH,
				opacity: ''
			});

			$(fancyEll.wrap).css({
				width: fanyDim.fWrw + difW,
				height: fanyDim.fWrh + difH
			});
		};

		var getFancyDim = function() {
			// Save initial dimensions of the fancybox when it is opened
			// Needed to recalculate the width when window resizes with cBoxOnWinResize function
			fanyDim = {
				fCw: $(fancyEll.content).width(),
				fCh: $(fancyEll.content).height(),
				fWrw: $(fancyEll.wrap).width(),
				fWrh: $(fancyEll.wrap).height(),
				fOw: $(fancyEll.outer).width(),
				fOh: $(fancyEll.outer).height(),
				wW: $(window).width(),
				wH: (window.innerHeight ? window.innerHeight : $(window).height())
			};
		};

		var afterFancyLoad = function() {
			window.az_touchPageNoScroll = true;

			// Fancybox callback passed over openAjaxZoomInFancyBox
			op.boxOnComplete();

			if (newFancybox) {
				$(fancyEll.content).attr('id', 'fancybox-content-az');
			} else {
				getFancyDim();
				// Bind custom window resize function (cBoxOnWinResize) to enable size adjustments for the fancybox
				$(window).unbind('resize', cBoxOnWinResize).bind('resize', cBoxOnWinResize);
			}

			// Init AJAX-ZOOM
			if (!iframeMode) {

				if (op.fromOpened) {
					if ($.axZm) {
						$('#tempLoadingMassage').remove();
						$.axZm.ovrFsInitPause = true;
						$.fn.axZm.fullScreenRelChange(newFancybox ? 'fancybox-content-az' : 'fancybox-content', function() {
							$.fn.axZm.addCallback('onFullScreenCloseEndFromRel', {scrollBarFixFancybox: scrollBarFixFancybox});
						});
					}
				} else {
					if (!window.fullScreenStartSplash) {
						window.fullScreenStartSplash = {'enable': true, 'className': false, 'opacity': 0.75}; 
					}

					$.fn.axZm.openFullScreen(
						op.axZmPath, 
						op.queryString, 
						op.ajaxZoomCallbacks,
						newFancybox ? 'fancybox-content-az' : 'fancybox-content',
						op.fullScreenApi,
						op.escTxt ? false : true,
						op.postMode
					);
				}
			} else {
				if (newFancybox) {
					$(fancyEll.content).find('iframe').css({width: '100%', height: '100%'});
				}
			}
		};

		var afterFancyClose = function() {
			window.az_touchPageNoScroll = false;
			// Fancybox callback passed over openAjaxZoomInFancyBox
			op.boxOnClosed();
			$('body>.fancybox-inline-tmp').remove();
			if (!iframeMode) {
				if (op.fromOpened) {
					return;
				}

				// If 360/3D loaded into the fancybox
				$.fn.axZm.spinStop();

				// Completly remove AJAX-ZOOM from DOM
				$.fn.axZm.remove();
				$('#axZmTempBody').axZmRemove(true);
				$('#axZmTempLoading').axZmRemove(true);
			}

			if (op.ref) {
				$('#'+op.ref).removeData('axZmrespFancyBox');
			}
		};

		var beforeFancyClose = function() {
			op.boxOnCleanup();

			if (!iframeMode) {
				if (op.fromOpened && $.axZm) {
					$.fn.axZm.fullScreenRelRestore(function() {
						$.axZm.ovrFsInitPause = false;
						try {
							delete ($.axZm.userFunc.onFullScreenCloseEndFromRel.scrollBarFixFancybox);
						} catch(err) {
							return false;
						}
					});
				}
			}
		};

		// Create an html element to pretend there is something to load into fancybox
		$('#tempLoadingMassage').remove(); // if present :-)

		if (!iframeMode) {
			$('<div />').html(op.loadingMsg).attr('id', 'tempLoadingMassage').css('display', 'none').appendTo('body');
		}

		// Trigger fancybox
		$.fancybox({
			padding: op.boxPadding, // boxPadding defined at very beginning
			margin: op.boxMargin, // boxMargin defined at very beginning
			overlayShow: op.boxOverlayShow, // optional, show overlay
			overlayOpacity: op.boxOverlayOpacity, // optional, overlay opacity
			centerOnScroll: op.boxCenterOnScroll, // optional
			overlayColor : op.boxOverlayColor, // optional
			transitionIn: op.boxTransitionIn, // 'elastic', 'fade' or 'none'
			transitionOut: op.boxTransitionOut, // 'elastic', 'fade' or 'none'
			speedIn: op.boxSpeedIn,
			speedOut: op.boxSpeedOut,
			easingIn: op.boxEasingIn,
			easingOut: op.boxEasingOut,
			showCloseButton: op.boxShowCloseButton,
			enableEscapeButton: op.boxEnableEscapeButton,
			showNavArrows: false, // required, false
			enableKeyboardNav: false, // required, false
			hideOnContentClick: false, // required, do not hide when clicked inside fancybox (AJAX-ZOOM is there)
			scrolling: op.scrolling, // required, no scrolling
			width: boxW, // required, boxW is calculated at very beginning
			height: boxH, // required, boxH is calculated at very beginning
			autoScale: false, // required
			autoDimensions: false, // required
			href: iframeMode ? hrefIframe : '#tempLoadingMassage', // required, pretend there is something to load :-)
			type: iframeMode ? 'iframe' : null,
			tpl: {
				iframe: '<iframe id="fancybox-frame" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" allowtransparency="true" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
			},
			// disable auto* for fancybox 2.x
			autoSize: false,
			autoResize: false,
			autoCenter: false,
			fitToView: false,
			autoWidth: false,
			autoHeight: false,
			iframe: {
				scrolling: op.scrolling,
				preload: false
			},
			onComplete: function() { // fancybox 1.3.4
				$('body').addClass('az_fancybox');
				afterFancyLoad();
			},
			afterLoad: function() { // fancybox 2.x
				$('body').addClass('az_fancybox');
				afterFancyLoad();
			},
			onClosed: function() { // fancybox 1.3.4
				afterFancyClose();
			},
			afterClose: function() { // fancybox 2.x
				afterFancyClose();
			},
			onCleanup: function() { // fancybox 1.3.4
				$('body').removeClass('axZmLock az_fancybox');
				beforeFancyClose();
			},
			beforeClose: function() { // fancybox 2.x
				$('body').removeClass('axZmLock az_fancybox');
				beforeFancyClose();
			},
			afterShow: function() { // fancybox 2.x
				$(window).unbind('.fb');
				getFancyDim();
				$(window).unbind('resize', cBoxOnWinResize).bind('resize', cBoxOnWinResize);
				$('#tempLoadingMassage').remove();
			},
		});
	};

	$.fn.unbindAjaxZoomInFancyBox = function() {
		return this.each(function() {
			$(this).unbind('click.axZmFb');
		});
	};

	$.fn.openAjaxZoomInFancyBox = function(options) {
		return this.each(function() {
			$(this).unbindAjaxZoomInFancyBox().bind('click.axZmFb', function() {
				$.openAjaxZoomInFancyBox(options);
			});
		});
	}
})(jQuery);
