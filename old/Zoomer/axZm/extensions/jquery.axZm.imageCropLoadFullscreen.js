/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.imageCropLoadFullscreen.js
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 1.0
* Extension Date: 2019-03-24
* URL: https://www.ajax-zoom.com
* Documentation: https://www.ajax-zoom.com/index.php?cid=docs
* Example: https://www.ajax-zoom.com/examples/example35_fromclick.php
*/

;(function(j) {

	j = j || window.jQuery || {};

	// Console log
	var consoleLog = function(msg, err) {
		if (msg && window.console && window.console.log) {
			if (err && window.console.error) {
				window.console.error('AJAX-ZOOM :: ' + msg);
			} else {
				window.console.log('AJAX-ZOOM :: ' + msg);
			}
		}
	};

	if (!j.fn || !j.fn.jquery) {
		consoleLog('Error, jQuery core is not loaded!');
		return;
	}

	var dta = {};

	// Default options
	var o = {
		// Path to the /axZm folder, e.g. /test/axZm/
		installPath: "auto",
		
		// e.g. 3dDir=/path/to/360/folder
		parameter: "",

		// The "example" parameter
		example: "spinIpad",

		// Use browsers fullscreen API
		apiFullscreen: false,

		// Use POST instead of GET
		postMode: false,

		// Language
		lang: 'en',

		// Over before AJAX-ZOOM loads
		fullScreenStartSplash: {
			enable: true,
			className: false,
			opacity: 0.75
		},

		// Append slider over the viewer instead of placing it alongside
		cropSliderOverlay: false,

		// Create a toggle button to hide the slider
		cropSliderOverlayToggle: true,

		// Character or any other HTML that represents the arrow on the toggle button
		// You can also use, e.g. "Font Awesome" and <i> (icon) HTML element
		cropSliderOverlayToggleChar: "&#10094;",

		// Define, e.g. padding of the overlay slider via options. 
		// You can also override the corresponding CSS classes: 
		// azCropSliderOverlay{Top, Right, Bottom, or Left}
		// This way, you can reduce the width or height of the slider and thus prevent that the thumbnails overlay other AJAX-ZOOM UI elements. 
		// You can use integers, px units or the so-called "viewport" units - vh or vw. 
		// The viewport units are useful here if the UI elements of the viewer such as "image map" are set to be responsive.
		// The CSS "calc" expressions work too.
		cropSliderOverlayCss: {
			top: {
				paddingTop: 0, paddingRight: '60px', paddingBottom: 0, paddingLeft: 0
			},
			right: {
				paddingTop: '60px', paddingRight: 0, paddingBottom: 0, paddingLeft: 0
			},
			bottom: {
				paddingTop: 0, paddingRight: 0, paddingBottom: 0, paddingLeft: '130px'
			},
			left: {
				paddingTop: 0, paddingRight: 0, paddingBottom: '80px', paddingLeft: 0
			},
		},

		// Calculate padding for responsive map size
		// If map size is responsive, it is nearly impossible to set the offset by using padding with CSS only
		cropSliderOverlayMapPadding: true,

		// Thumbnails slider configuration, documentation: 
		// https://www.ajax-zoom.com/index.php?cid=blog&article=axzm_thumb_slider&lang=en
		cropAxZmThumbSliderParam: {}, 
		cropSliderPosition: "auto", // left, top, right, bottom, auto
		cropSliderDimension: 86, // Width / Height of the thumbnails slider
		cropSliderMinSize: 0, // Disable thumbnails slider if width or height of the window is below this value
		cropSliderThumbAutoSize: true, // Set thumbnails size automatically
		cropSliderThumbAutoMargin: 10, // Margin between thumbnails
		cropSliderThumbDescr: true, // Show thumbnails description if present
		cropSliderThumbDescrMargin: 0,

		// Crop slider management, /extensions/jquery.axZm.imageCropLoad
		cropLoadObj: {
			cropJsonURL: "", // url of the json with crop data
			cropJson: "", // data coming from elsewhere
			// Redefine cropped thumbnails size
			cropImgParam: {
				width: null,
				height: null,
				qual: null
			},
			zoomToSpeed: 250, // The "base speed" for zooming in and out
			zoomToMinSpeed: 600, // Minimal duration of zoom in or out animation
			spinToSpeed: "2500", // Optionally pass duration of spinning when clicked on the thumb
			spinToMotion: "easeOutQuad", // Optional pass easing type of the spinning animation
			handleTexts: "default", // Function after spinTo or zoomTo; if defined in JSON title and description are passed as arguments
			// Options of the expandable button plugin
			// Below are just a few defaults, for full options list please see:
			// /axZm/extensions/jquery.axZm.expButton.js
			cropAxZmEbOpt: {
				marginX: 5, // Horizontal margin depending on gravity
				marginY: 5, // Vertical margin depending on gravity
				openSpeed: 300, // Duration of open animation in ms
				closeSpeed: 300, // Duration of close animation in ms
				fadeInSpeed: 200, // Fadein duration of the button
				arrow: true, // Show arrow inside button indicating that it is expandable
				dynText: true, // Set font size depending on screen size
				dynTextBtn: [
					{"base": 0.016, "min": 12, "max": 24, "important": true}
				],
				dynTextTitle: [
					{"base": 0.016, "min": 18, "max": 28, "important": true}
				],
				dynTextDescr: [
					["*", {"base": 0.012, "min": 12, "max": 24, "important": true}],
					["h3", {"base": 0.016, "min": 16, "max": 32, "important": true}]
				],
				onCloseEnd: null, // callback on close
				onOpenEnd: null, // callback when button openes / expands
			}
		},

		// Path to the hotspots file or AJAX-ZOOM hotspots object
		hotspots: "",

		// AJAX-ZOOM callbacks - https://www.ajax-zoom.com/examples/example14.php
		callbacks: {}
	};

	var ucfirst = function(string) {
		if (j.type(string) == 'string') {
			return string.charAt(0).toUpperCase() + string.substr(1);
		} else {
			return string;
		}
	};

	var isLandscapeMode = function() {
		return j(window).width() >= j(window).height();
	};

	var cropAxZmThumbSliderParamDef = {
		"scrollBy": 1,
		"btn": false,
		"btnClass": "axZmThumbSlider_button_new",
		"btnLeftText": null,
		"btnRightText": null,
		"btnHidden": true,
		"pressScrollSnap": true,
		"centerNoScroll": true,
		"thumbImgWrap": "azThumbImgWrapRound",
		"wrapStyle": {
			"borderWidth": 0
		}
	};

	var imageCropLoadFullscreen = function(op, e, _this, req) {
		var opt = j.extend(true, {}, o, op);
		if (_this.data('disabled')) {
			return;
		}

		// e = e || window.event || {};
		// var _this = e.target || (e.originalEvent ? e.originalEvent.target : null);
		var cropJsonURL = opt.cropLoadObj.cropJsonURL || opt.cropLoadObj.cropJson;
		var cropData;
		var sliderPos;
		var loadObj;
		var ovlCropSlider;
		var fssp = {
			layout: 1,
			always: 1,
			config: {}
		};

		var removeReqData = function(missing) {
			_this.removeData('azReqData');
			if (missing) {
				op.apiFullscreen = false;
				imageCropLoadFullscreen(op, e, _this);
			}
		};

		var getCropData = function(missing) {
			if (_this.data('cropData')) {
				removeReqData(missing);
				return;
			}

			if (j.isArray(cropJsonURL)) {
				_this.data('cropData', cropJsonURL);
				removeReqData();
				return;
			} else if (!cropJsonURL) {
				_this.data('cropData', {});
				removeReqData(missing);
				return;
			} else if (cropJsonURL && typeof cropJsonURL == 'string' && dta[cropJsonURL]) {
				_this.data('cropData', dta[cropJsonURL]);
				removeReqData(missing);
				return;
			}

			if (cropJsonURL && typeof cropJsonURL == 'string') {
				j.ajax({
					url: cropJsonURL,
					dataType: 'json',
					cache: true,
					success: function(d) {
						if (j.isArray(d)) {
							_this.data('cropData', d);
							dta[cropJsonURL] = d;
							removeReqData(missing);
						} else {
							consoleLog("Error, the JSON file seems to be invalid!");
							removeReqData();
						}
					},
					error: function(a) {
 						var status = a.status;
						if (status == '200') {
							consoleLog('Loaded JSON file ('+cropJsonURL+') contains errors!');
						} else {
							consoleLog('An error '+a.status+' occurred while loading JSON from '+cropJsonURL);
						}

						removeReqData();
					}
				});
			}
		};

		// Get crop data before click event
		if (req || !j(_this).data('cropData')) {
			if (!j(_this).data('azReqData')) {
				getCropData(!j(_this).data('cropData') && !req);
			}

			j(_this).data('azReqData', 1);

			return;
		} else {
			opt.cropLoadObj.cropJsonURL = '';
			opt.cropLoadObj.cropJson = '';
			cropData = j(_this).data('cropData');
		}

		if (!opt.installPath || opt.installPath == 'auto') {
			opt.installPath = j.fn.axZm.installPath();
			if (!opt.installPath || opt.installPath == 'auto') {
				consoleLog('The value of the option "installPath" could not be determined. Please set it manually!');
				return;
			}
		}

		_this
		.addClass('disabled')
		.data('disabled', 1)
		.blur();

		window.setTimeout(function() {
			j(_this)
			.removeClass('disabled')
			.removeData('disabled');
		}, 500);

		window.fullScreenStartSplash = opt.fullScreenStartSplash;

		var par = function() {
			return opt.parameter + (opt.example && opt.parameter.indexOf('example=') == -1 ? '&example='+opt.example : '');
		};

		var cropHasThumbDescr = function(o) {
			var a = false;
			if (j.isArray(o)) {
				j.each(o, function(k, v) {
					if (j.isPlainObject(v)) {
						var thumbTitle = v['thumbTitle_'+opt.lang] || v.thumbTitle || null;
						if (thumbTitle) {
							a = true;
							return false;
						}
					}
				});
			}

			return a;
		};

		var adjustEbGravity = function() {
			if (sliderPos == 'top' || sliderPos == 'bottom') {
				cropData = j.merge([], cropData);
				var marginY = loadObj.cropAxZmEbOpt.marginY;
				var hw = fssp[sliderPos] + (opt.cropSliderOverlay && opt.cropSliderOverlayToggle ? (30 + 10) : 10);

				j(cropData).each(function(a, b) {
					if (sliderPos == 'bottom' && b.ebGrav == 'bottom') {
						if (hw > marginY) {
							//loadObj.cropAxZmEbOpt.marginY = hw;
							cropData[a]['ebGrav'] = 'top';
						}
					} else if (sliderPos == 'top' && (b.ebGrav == 'top' || !b.ebGrav)) {
						if (hw > marginY) {
							//loadObj.cropAxZmEbOpt.marginY = hw;
							cropData[a]['ebGrav'] = 'bottom';
						}
					}
				});

				loadObj.cropJson = cropData;
			}
		};

		var makeCropSlider = function(cropThumbDescr) {
			var cropSliderOverlay = opt.cropSliderOverlay;
			var par;

			if (cropSliderOverlay) {
				par = j('#axZmOvrSpace' + ucfirst(sliderPos));
			} else {
				par = j('#axZmFsSpace' + ucfirst(sliderPos));
			}

			if (!j('ul', par).length) {
				var sliderWidth = opt.cropSliderDimension;

				if (cropSliderOverlay) {
					ovlCropSlider = j.fn.axZm.overlaySpaceAdd({
						pos: sliderPos,
						css: opt.cropSliderOverlayCss[sliderPos],
						dim: fssp[sliderPos],
						charToggle: opt.cropSliderOverlayToggleChar,
						toggleBtn: opt.cropSliderOverlayToggle,
						padMap: true
					});
				}

				j('<div id="axZm_fullScreenCropSlider' + ucfirst(sliderPos) + '" class="axZm_fullScreenCropSlider"><ul></ul></div>')
				.appendTo(cropSliderOverlay ? j('.axZm_ovrSpaceInner', ovlCropSlider) : '#axZmFsSpace' + ucfirst(sliderPos));

				var sliderParamCopy = j.extend(
					true,
					{},
					cropAxZmThumbSliderParamDef,
					(j.isPlainObject(opt.cropAxZmThumbSliderParam) ? opt.cropAxZmThumbSliderParam : {})
				);

				// Set orientation
				sliderParamCopy.orientation = (sliderPos == 'top' || sliderPos == 'bottom') ? 'horizontal' : 'vertical';

				if (opt.cropSliderThumbAutoSize) {
					if (!sliderParamCopy.thumbLiStyle) {
						sliderParamCopy.thumbLiStyle = {};
					}

					if (!sliderParamCopy.thumbImgStyle) {
						sliderParamCopy.thumbImgStyle = {};
					}

					if (!sliderParamCopy.btnBwdStyle) {
						sliderParamCopy.btnBwdStyle = {};
					}

					if (!sliderParamCopy.btnFwdStyle) {
						sliderParamCopy.btnFwdStyle = {};
					}

					var cSTAM = opt.cropSliderThumbAutoMargin;
					var cMarg = cSTAM * 2 + 2;

					sliderParamCopy.thumbImgStyle.maxHeight = sliderWidth - cMarg + 'px';
					sliderParamCopy.thumbImgStyle.maxWidth = sliderWidth - cMarg + 'px';

					var thumbLiStyle = sliderParamCopy.thumbLiStyle;
					var btnBwdStyle = sliderParamCopy.btnBwdStyle;
					var btnFwdStyle = sliderParamCopy.btnFwdStyle;

					thumbLiStyle.width = sliderWidth - cMarg;
					thumbLiStyle.height = sliderWidth - cMarg;
					thumbLiStyle.lineHeight = sliderWidth - cMarg - 2 + 'px';

					if (sliderPos == 'top' || sliderPos == 'bottom') {
						thumbLiStyle.marginTop = cSTAM;
						thumbLiStyle.marginRight = cSTAM;
						thumbLiStyle.marginBottom = 0;
						thumbLiStyle.marginLeft = 0;

						btnBwdStyle.marginLeft = 0;
						btnBwdStyle.marginRight = 0;
						btnFwdStyle.marginLeft = 0;
						btnFwdStyle.marginRight = 0;

					} else {
						thumbLiStyle.marginTop = 0;
						thumbLiStyle.marginRight = 0;
						thumbLiStyle.marginBottom = cSTAM + cropThumbDescr;
						thumbLiStyle.marginLeft = cSTAM;

						btnBwdStyle.marginTop = 0;
						btnBwdStyle.marginBottom = 0;
						btnFwdStyle.marginTop = 0;
						btnFwdStyle.marginBottom = 0;
					}
				}

				loadObj = j.extend(
					true,
					{},
					opt.cropLoadObj,
					{
						installPath: opt.installPath,
						cropJson: cropData,
						thumbsContainerLiDescr: opt.cropSliderThumbDescr,
						lang: opt.lang,
						sliderID: 'axZm_fullScreenCropSlider' + ucfirst(sliderPos),
						sliderPar: sliderParamCopy
					}
				);

				if (cropSliderOverlay) {
					adjustEbGravity();
				}

				setTimeout(function() {
					j.axZmImageCropLoad(loadObj);
				}, 0);
			}
		};

		var prepareCropSlider = function() {
			sliderPos = opt.cropSliderPosition;
			var sliderWidth = opt.cropSliderDimension;

			if (sliderPos == 'auto') {
				sliderPos = isLandscapeMode() ? 'right' : 'bottom';
			}

			var cropThumbDescr = 0;
			var cropSliderThumbDescrMargin = opt.cropSliderThumbDescrMargin || 0;

			if (opt.cropSliderThumbDescr) {
				if (parseInt(cropSliderThumbDescrMargin)) {
					cropThumbDescr = parseInt(cropSliderThumbDescrMargin);
				} else {
					cropThumbDescr = cropHasThumbDescr(cropData) ? 14 : 0;
				}
			}

			if (opt.cropSliderThumbAutoSize && opt.cropAxZmThumbSliderParam.scrollbar) {
				if (opt.cropAxZmThumbSliderParam.scrollbarMargin) {
					sliderWidth += parseInt(opt.cropAxZmThumbSliderParam.scrollbarMargin);
				} else {
					sliderWidth += 15;
				}
			}

			switch(sliderPos) {
				case 'top':
					fssp.top = sliderWidth + cropThumbDescr;
					break;
				case 'right':
					fssp.right = sliderWidth;
					break;
				case 'bottom':
					fssp.bottom = sliderWidth + cropThumbDescr;
					break;
				case 'left':
					fssp.left = sliderWidth;
					break;
			}

			fssp.config[sliderPos] = {
				min: opt.cropSliderMinSize || 0,
				clb: function() {
					makeCropSlider(cropThumbDescr);
				}
			};

			if (opt.cropSliderOverlay) {
				makeCropSlider(cropThumbDescr);
			} else {
				j.extend(true, j.axZm.fullScreenSpace, fssp);
			}
		};

		var clb = function() {
			var clbD = {
				onBeforeStart: function() {
					if (!opt.cropSliderOverlay && cropData && j.isArray(cropData)) {
						prepareCropSlider();
					}
				},
				onLoad: function() {
					if (opt.hotspots) {
						j.fn.axZm.loadHotspotsFromJsFile(opt.hotspots, false);
					}
				},
				onFullScreenReady: function() {
					if (opt.cropSliderOverlay && cropData && j.isArray(cropData)) {
						prepareCropSlider();
					}
				}
			}

			return j.fn.axZm.mergeCallBackObj(opt.callbacks, clbD);
		};

		j.fn.axZm.openFullScreen(
			e,
			opt.installPath,
			par(),
			clb(),
			'window',
			opt.apiFullscreen,
			false,
			opt.postMode
		);
	};

	j.fn.imageCropLoadFullscreen = function(op) {
		if (this instanceof jQuery) {
			return this.each(function() {
				var _this = j(this);

				if (!j.axZmImageCropLoad) {
					consoleLog('Error, /extensions/jquery.axZm.imageCropLoad.js is not loaded!');
					return;
				} else if (!j.fn.axZmThumbSlider) {
					consoleLog('Error, /extensions/axZmThumbSlider/jquery.axZm.thumbSlider.js is not loaded!');
					return;
				}

				_this
				.unbind('click.imageCropLoadFullscreen')
				.bind('click.imageCropLoadFullscreen', function(e) {
					if (!j.fn.axZm) {
						consoleLog('the AJAX-ZOOM core "jquery.axZm.js" file is not present', 1);
						return;
					}

					imageCropLoadFullscreen(op, e, _this);
				});

				// Request data
				imageCropLoadFullscreen(op, window.event, _this, true);

				return this;
			});
		}
	};

})(window.jQuery || {});
