/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.360Gallery.js
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: https://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 3.6
* Extension Date: 2019-08-06
* URL: https://www.ajax-zoom.com
* Example: https://www.ajax-zoom.com/examples/example29.php
*/

;(function($) {
	'use strict';

	$.axZm360Gallery = function(opt){

		// Options
		var def = {
			// Path to /axZm/ directory, e.g. "/test/axZm/"
			axZmPath: "auto",

			// Path to the folder where in subfolders are images for several 360s/3D
			// So if under this path there are any other subfolders, 
			// then the first image will be loaded into the gallery
			// Do not use "gallery3dDir" and "galleryData" at the same time.
			gallery3dDir: "",

			// Path to the folder with 360 or 3D which will be loaded first
			first3dDir: "",

			// Configuration set value which is passed to ajax-zoom, e.g. 17 or "spinIpad"
			// some default settings from /axZm/zoomConfig.inc.php are overridden in 
			// /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 17){
			example3dDir: 17, 

			// While "gallery3dDir" option simply loads many 360s or 3D from a given folder, 
			// with "galleryData" option you can precisely define which 360s or 3D have to beloaded. 
			// Additionally you can also define regular 2D images and videos located at some 
			// straming platform like youtube;
			galleryData: "",

			firstToLoad: null, // name of 360, text, video or "imageZoom"

			prevNextAllData: {
				enabled: true,
				next: {file: "[buttonSet]/zoombutton_slide_vert_next", ext: "png", w: 20, h: 100},
				prev: {file: "[buttonSet]/zoombutton_slide_vert_prev", ext: "png", w: 20, h: 100},
				posNext: {right: 0, top: "50%", marginTop: -50, position: "absolute", zIndex: 1002},
				posPrev: {left: 0, top: "50%", marginTop: -50, position: "absolute", zIndex: 1002}
			},

			galleryHotspots: {},

			// Configuration set value which is passed to ajax-zoom when using "galleryData"; 
			// some default settings from /axZm/zoomConfig.inc.php are overridden in 
			// /axZm/zoomConfigCustom.inc.php after elseif ($_GET['example'] == 'spinAnd2D'){...;
			// additionally to $_GET['example'], image360 is passed over query string as a paramter 
			// when 360 or 3D are loaded, so it is available in the config file as $_GET['image360'] 
			// and the configuration set can be differed from plain images.
			exampleData: "spinAnd2D",

			noImageClass: 'azNoImage',

			// When clicked on the thumbs the image inside AJAX-ZOOM will be switched with one of the following effects, 
			// possible values: "Center", "Top", "Right", "Bottom", "Left", "StretchVert", "StretchHorz", "SwipeHorz", "SwipeVert", "Vert", "Horz" 
			zoomSwitchAnm: "SwipeHorz",

			 // Speed of switching between images in the gallery
			zoomSwitchSpeed: 300,

			// Not all but some of the AJAX-ZOOM options which are normally set in zoomConfig.inc.php and zoomConfigCustom.inc.php 
			// can be set directly as js var in onBeforeStart AJAX-ZOOM callback. 
			// The property of the object is the name of the option and value its correstponding value.
			azOptions: {
				//e.g.
				// zoomSlider: false,
				// gallerySlideNavi: true,
				// gallerySlideNaviOnlyFullScreen: true
			},

			// The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
			divID: "axZmPlayerContainer",

			// If "divID" is responsive, set this to true
			embedResponsive: false,

			// Parent container of gallery div
			spinGalleryContainerID: "spinGalleryContainer",

			// Container where thumbs gallery will be loaded into
			spinGalleryID: "spinGallery",

			// Temp container which some text which will be removed just before gallery appears.
			spinGallery_tempID: "spinGallery_temp",

			spinGalleryLoadingClass: "", /* e.g. axZm_loading*/

			// possible values: "onSpinPreloadEnd" or "onLoad"
			spinGalleryLoadCallback: "onSpinPreloadEnd",

			// Background color of the player, possible values: #hex color or "auto".  
			// If "auto" AJAX-ZOOM will try to determin the background color. 
			// Use "auto" only if you have e.g. black and white on different 360s.
			backgroundColor: "#FFFFFF",

			// Set true to check spinReverse / spinReverseZ settings upon the below options - "toReverseArr" and "toReverseArrZ"
			checkReverse: true,

			// Array with folder names where spinReverse option should be applied
			toReverseArr: [],

			// Array with folder names where spinReverseZ option should be applied
			toReverseArrZ: [],

			// Array with folder names where spinBounce option should be applied
			toBounceArr: [],

			// Try to open AJAX-ZOOM at browsers fullscreen mode if available (requestFullScreen)
			fullScreenApi: false,

			// Show 360 thumb gallery at fullscreen mode, possible values: "bottom", "top", "left", "right" or false
			thumbsAtFullscreen: false,

			// Use $.axZmThumbSlider extension for the thumbs, set false to disable
			// requires:
			// /axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css
			// axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js
			axZmThumbSlider: true,

			// Options passed to $.axZmThumbSlider
			// For more information see /axZm/extensions/axZmThumbSlider/
			axZmThumbSliderParam: {
				// e.g.
				//btn: false // disable left/right buttons
			},

			// Object with AJAX-ZOOM callbacks, http://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
			axZmCallBacks: {
				// e.g.
				//onload: function(){consoleLog("onLoad fired")},
				//onSpinPreloadEnd: function(){consoleLog("spin preloaded")}
			},

			axZmPar: "",

			thumbWidth: 70, // width of the thumbnail image
			thumbHeight: 70, // height of the thumbnail image
			thumbsCache: true, // cache thumbnails
			thumbRetina: true, // true will double the resolution of the thumbnails
			thumbQual: 90, // jpg quality of the thumbnail image
			thumbMode: false, // possible values: "contain", "cover" or false
			thumbBackColor: "#FFFFFF", // background color of the thumb if thumbMode is set to "contain"

			thumbPadding: null, // Quickly overwrite the css padding of the thumbs 
			thumbMarginRight: null ,// Quickly overwride the css margin to the right of the thumbs 
			thumbMarginBottom: null, // Quickly overwride the css margin to the bottom of the thumbs 
			thumbCss: {}, // Quickly overwride any other CSS 

			// Image located in /axZm/icons folder
			//thumbPreloadingImg: "ajax-loader-map-white.gif", 

			// Show thumb description, if true and thumbDescrObj is not defined, then for 360/3D number of frames will be shown
			thumbDescr: true,

			// Custom description of the thumbs
			thumbDescrObj: {
				// e.g.
				//"Uvex_Occhiali": "test"
			},

			// Alternativly to dynamically generated thumbs you can define a list of thumbs
			// thumbWidth and thumbHeight options still determin the css of the thumbs
			thumbImgObj: {
				//e.g.
				//"Uvex_Occhiali": "http://www.some-domain/images/thumb_123.jpg"
			},

			// Show 360, 3D or some other icon for the thumbs
			thumbIcon: true,

			// Filenames for icons located in /axZm/icons directory
			thumbIconFile: {
				"360": "360_2.png",
				"3D": "3d_2.png",
				"2D": "",
				"youtube": "youtube_icon.png",
				"vimeo": "vimeo_icon_1.png",
				"dailymotion": "video_icon.png",
				"text": "text_256x256.png"
			},

			images360Big: "media-360-1200.png",
			imagesVideoBig: "media-play-1200.png",

			// Paths for video thumbs
			// Depending on the video streaming platform images will be retieved instantly
			videoThumb: {
				youtube: {
					url: "https://i1.ytimg.com/vi/",
					img: "mqdefault" // default, hqdefault, mqdefault, sddefault, maxresdefault, 0, 1, 2, 3
				},
				vimeo: {
					// accepts http && https
					url: "https://vimeo.com/api/v2/video/",
					img: "thumbnail_medium" // thumbnail_large, thumbnail_medium, thumbnail_small
				},
				dailymotion: {
					// acceppts only https, does not work on IE <= 9 if not in https mode
					url: "https://api.dailymotion.com/video/",
					img: "thumbnail_480_url" // thumbnail_120_url, thumbnail_180_url, thumbnail_240_url, thumbnail_360_url, thumbnail_480_url, thumbnail_60_url, thumbnail_720_url
				}
			},

			// Url for the videos
			videoUrl: {
				youtube: "https://www.youtube-nocookie.com/embed/",
				vimeo: "https://player.vimeo.com/video/",
				dailymotion: "https://www.dailymotion.com/embed/video/"
			},

			// Parameters which are passed to the video players
			videoSettings: {
				// https://developers.google.com/youtube/player_parameters
				youtube: {
					autoplay: 0,
					controls: 1,
					loop: 0,
					rel: 0,
					showinfo: 0,
					theme: "light",
					html5: 1
				},
				// http://developer.vimeo.com/player/embedding
				vimeo: {
					autoplay: 0,
					byline: 0,
					portrait: 0
				},
				//http://developer.dailymotion.com/documentation#player-parameters
				dailymotion: {
					autoplay: 0,
					logo: 0,
					quality: 720,
					related: 0,
					html5: 1
				}
			}
		};

		// Some internal vars
		var obj, 
			liCss = {},
			zoomLoadFile,
			galleryData = {},
			axZmThumbSliderLoaded = false,
			galleryLoaded = false,
			currentZoomMod = null,
			onSpinPreloadEndOnce = false,
			axZmThumbSliderP = {};

		// Extend options
		var op = $.extend(true, {}, def, opt);

		// Default slider parameters
		// For more information see /axZm/extensions/axZmThumbSlider/
		// Can be changed and extended with axZmThumbSliderParam option passed to plugin!
		var axZmThumbSliderParamDefault = {
			orientation: "horizontal",
			scrollBy: 3,
			smoothMove: 6,
			quickerStop: true,
			pressScrollSnap: true,
			btn: true, // enable left / right buttons
			btnClass: "axZmThumbSlider_button_new",
			btnBwdStyle: {
				marginLeft: -7,
				marginRight: 0
			},
			btnFwdStyle: {
				marginLeft: 0,
				marginRight: -7
			},
			btnLeftText: null,
			btnRightText: null,
			btnTopText: null,
			btnBottomText: null,
			mouseWheelScrollBy: 1,
			wrapStyle: {
				borderTopWidth: 0,
				borderBottomWidth: 0
			},
			scrollbar: false,
			centerNoScroll: false,
			thumbLiSubClass: {
				first: null,
				last: null 
			},
			thumbImgStyle:{
				maxWidth: op.thumbWidth + "px",
				maxHeight: op.thumbHeight + "px"
			},
			thumbLiStyle: {
				width: op.thumbWidth,
				height: op.thumbHeight,
				lineHeight: op.thumbHeight + "px",
				marginBottom: 2,
				marginLeft: 3,
				marginRight: 4
			},
			onInit: function(){
				setTimeout(function(){
					axZmThumbSliderLoaded = true;
					axZmThumbSliderCallback();
				}, 1);
			}
		};

		// "Select" the currently loaded thumb
		var axZmThumbSliderCallback = function() {
			var loadedKey = getKey();

			if (op.axZmThumbSlider && axZmThumbSliderLoaded){
				if (loadedKey) {
					$('#' + op.spinGalleryID)
					.axZmThumbSlider('scrollTo', {
						thumb: '[data-path="' + loadedKey + '"]',
						highlight: true,
						triggerClick: false
					});
				}
			} else if (!op.axZmThumbSlider && galleryLoaded) {
				if (loadedKey) {
					$('li', '.azThumb').removeClass('selected');
					$('li[data-path="'+loadedKey+'"]', '.azThumb').addClass('selected');
				}
			}
		};

		var copy_tempID = function() {
			var aaa = $('#' + op.spinGallery_tempID);
			if (aaa.length && aaa[0]) {
				op.spinGallery_tempID_HTML = aaa[0].outerHTML;
			}
		};

		var getl = function(sep, str) {
			return str.substring(str.lastIndexOf(sep)+1);
		};

		var loadHotspots = function() {
			var name;
			if ($.axZm.spinMod){
				var str  = $.axZm.orgPath;
				if ($.axZm.numAxis > 1){
					name = str.split('/').reverse()[2];
				} else {
					name = str.split('/').reverse()[1];
				}
			} else {
				if (op.galleryHotspots['2D']) {
					name = '2D';
				} else if (op.galleryHotspots[$.axZm.zoomGA[$.axZm.zoomID]['img']]) {
					name = $.axZm.zoomGA[$.axZm.zoomID]['img'];
				}
			}

			if (op.galleryHotspots[name]) {
				$.fn.axZm.loadHotspotsFromJsFile(op.galleryHotspots[name]);
			}
		};

		// Helper function string operations
		var getIdent = function(type, val) {
			if (type == 'imageZoom' || type == 'image360') {
				if (val.substr(-1) == '/') {
					val = val.substr(0, val.length - 1);
				}

				return val.split('/').reverse()[0];
			} else {
				return null;
			}
		};

		// Helper function string operations
		var getKey = function() {
			if ($('.azVideoIframe').length) {
				return $('.azVideoIframe').data('lnk');
			} else if ($('#'+op.divID).attr('data-lnk')){
				return $('#'+op.divID).attr('data-lnk');
			} else if ($.axZm) {
				if ($.axZm.spinMod) {
					var val = $.axZm.pic;
					if (val.substr(-1) == '/') {
						val = val.substr(0, val.length - 1);
					}

					if ($.axZm.zAxis) { // 3d
						return val.split('/').reverse()[1];
					} else { // 360
						return val.split('/').reverse()[0];
					}
				} else { // 2d
					return $.axZm.zoomGA[$.axZm.zoomID]['img'];
				}
			}
		};

		// Default callbacks for this example
		// These are AJAX-ZOOM callbacks
		var defCallBacks = {
			onImageChangeEnd: function() {
				if (!op.galleryHotspots['2D']) {
					loadHotspots();
				}
				axZmThumbSliderCallback();
			},
			onSwipeEnd: function(o) {
				if (o.exit === false) {
					return;
				}

				if ($.isArray(op.galleryData) && op.galleryData.length > 1) {
					if (o.dir == 'left') {
						$('#customBtn_mCustomBtn177').trigger('touchstart').trigger('touchend');
					} else if (o.dir == 'right') {
						$('#customBtn_mCustomBtn178').trigger('touchstart').trigger('touchend');
					}
				}
			},
			onBeforeStart: function() {
				$.axZm.zoomOrder = {
					o: galleryData.o,
					i: galleryData.i
				};

				if ($.isArray(op.galleryData) && op.galleryData.length > 1) {

					$.axZm.gallerySlideNavi = false;
					var mNavi = $.axZm.mNavi;
					mNavi.enabled = true;
					op.prevNextAllData.next.file = op.prevNextAllData.next.file.replace('[buttonSet]', $.axZm.buttonSet);
					op.prevNextAllData.prev.file = op.prevNextAllData.prev.file.replace('[buttonSet]', $.axZm.buttonSet);

					var nextIndex = 177;
					var identClass = 'axZm_customPrevNext';
					var identClassPrev = 'axZm_customPrev';
					var identClassNext = 'axZm_customNext';

					mNavi.order['mCustomBtn'+nextIndex] = 0;
					mNavi.order['mCustomBtn'+(nextIndex+1)] = 0;
					mNavi.customPos['mCustomBtn'+nextIndex] = {};
					mNavi.customPos['mCustomBtn'+nextIndex]['css'] = $.extend({}, op.prevNextAllData.posNext);
					mNavi.customPos['mCustomBtn'+(nextIndex+1)] = {};
					mNavi.customPos['mCustomBtn'+(nextIndex+1)]['css'] = $.extend({}, op.prevNextAllData.posPrev);

					if (!op.prevNextAllData.enabled) {
						mNavi.customPos['mCustomBtn'+nextIndex]['class'] = 'axZm_displayNone ' + identClass + ' ' + identClassNext;
						mNavi.customPos['mCustomBtn'+(nextIndex+1)]['class'] = 'axZm_displayNone ' + identClass + ' ' + identClassPrev;
					} else {
						mNavi.customPos['mCustomBtn'+nextIndex]['class'] = identClass + ' ' + identClassNext;;
						mNavi.customPos['mCustomBtn'+(nextIndex+1)]['class'] = identClass + ' ' + identClassPrev;
					}

					$.axZm.icons['mCustomBtn'+nextIndex] = op.prevNextAllData.next;
					$.axZm.icons['mCustomBtn'+(nextIndex+1)] = op.prevNextAllData.prev;

					mNavi['mCustomBtn'+nextIndex] = function() {
						if (!$.fn.axZm.isZoomSwitching()) {
							var gal = $('#'+op.spinGalleryID);
							var cur = $('li.selected', gal);
							if (cur.next().length) {
								cur.next().trigger('click');
							} else {
								$('li:eq(0)', gal).trigger('click');
							}
						}
					};

					mNavi['mCustomBtn'+(nextIndex+1)] = function() {
						if (!$.fn.axZm.isZoomSwitching()) {
							var gal = $('#'+op.spinGalleryID);
							var cur = $('li.selected', gal);
							if (cur.prev().length) {
								cur.prev().trigger('click');
							} else {
								$('li', gal).last().trigger('click');
							}
						}
					};
				}

				if (op.checkReverse) {
					var spinDirectionCheck = checkSpinDirection($.axZm.parToPass);
					
					if ($.isArray(spinDirectionCheck)) {
						$.axZm.spinReverse = spinDirectionCheck[0];
						$.axZm.spinReverseZ = spinDirectionCheck[1];
						$.axZm.spinBounce = spinDirectionCheck[2];
					}
				}

				// Set extra space to the right at fullscreen mode for the gallery
				if (op.thumbsAtFullscreen) {
					$.axZm.fullScreenSpace = {
						top: op.thumbsAtFullscreen == 'top' ? $('#'+op.spinGalleryID).outerHeight()+3 : 0,
						right: op.thumbsAtFullscreen == 'right' ? $('#'+op.spinGalleryID).outerWidth()+3 : 0,
						bottom: op.thumbsAtFullscreen == 'bottom' ? $('#'+op.spinGalleryID).outerHeight()+3 : 0,
						left: op.thumbsAtFullscreen == 'left' ? $('#'+op.spinGalleryID).outerWidth()+3 : 0,
						layout: 1
					};
				}

				// Set background color (can be done with css too)
				if (op.backgroundColor) {
					if (op.backgroundColor == 'auto') {
						$.fn.axZm.getBackColor(true, 1)
					} else {
						$('.axZm_zoomContainer').css({
							backgroundColor: op.backgroundColor
						});
					}
				}

				if (op.zoomSwitchSpeed >= 0) {
					$.axZm.galleryFadeInSpeed = op.zoomSwitchSpeed;
					$.axZm.galleryInnerFade = op.zoomSwitchSpeed;
					$.axZm.gallerySlideSwipeSpeed = op.zoomSwitchSpeed;
				}

				if (op.zoomSwitchAnm) {
					$.axZm.galleryFadeInAnm = op.zoomSwitchAnm;
				}

				$.each(op.azOptions, function(k, v) {
					if ($.axZm[k] !== undefined) {
						$.axZm[k] = v;
					}
				})
			},
			onFullScreenSpaceAdded: function() {
				// Optionally place gallery in extra space added at fullscreen and defined with $.axZm.fullScreenSpace
				// Gallery is in zFsOTempRemove
				// Changing content 2d / 360 is instant at fullscreen!
				if (op.thumbsAtFullscreen && $.axZm.fullScreenRel == 'window') {
 					$('#'+op.spinGalleryID)
					.appendTo('#axZmFsSpace'+capitaliseFirstLetter(op.thumbsAtFullscreen));
				}
			},
			onFullScreenClose: function() {
				$.fn.axZm.tapShow();
 				// Place gallery back from extra space to regular layout parent
				if (op.thumbsAtFullscreen) {
					$('#'+op.spinGalleryID)
					.appendTo('#'+op.spinGalleryContainerID);
				}
			},
			onFullScreenCloseFromRel: function() {
				$.fn.axZm.tapShow();
 				// Place gallery back from extra space to regular layout parent
				if (op.thumbsAtFullscreen) {
					$('#'+op.spinGalleryID)
					.appendTo('#'+op.spinGalleryContainerID);
				}
				
			},
			onSpinPreloadEnd: function() {
				if (op.spinGalleryLoadCallback == 'onSpinPreloadEnd') {
					loadGalleryCallback();
				}
			},
			onLoad: function() {
				if (galleryData.firstToLoad && galleryData.firstToLoad[0] == 'imageZoom') {
					loadGalleryCallback();
				}
				loadHotspots();
				axZmThumbSliderCallback();
				if (op.spinGalleryLoadCallback == 'onLoad') {
					loadGalleryCallback();
				}
			},
			onLoadAjaxSet: function() {
				loadHotspots();
			}
		};

		// Load thumb gallery
		var loadGalleryCallback = function() {
			// Make sure the below code is executed once!
			if (onSpinPreloadEndOnce) {
				// exit if already executed
				return false;
			}

			onSpinPreloadEndOnce = true; // set state

			if (op.gallery3dDir) {
				request360gallery();
			} else if (op.galleryData) {
				requestGalleryData();
			}
		};

		// Helper function
		var capitaliseFirstLetter = function(string) {
			if (string.length) {
				return string.charAt(0).toUpperCase() + string.slice(1);
			} else {
				return '';
			}
		};

		// Helper function
		var thumbIcon = function(val) {
			return op.axZmPath + 'icons/' + op.thumbIconFile[val];
		};

		// Helper function
		var isObject = function(x) {
			return (typeof x === 'object') && !(x instanceof Array) && (x !== null);
		};

		// Helper function
		var isString = function(x) {
			return (typeof x === 'string');
		};

		//Helper function
		var isDefined = function(x) {
			return (typeof x !== 'undefined');
		};

		// Check spin direction depending on toReverseArr and toReverseArrZ options
		var checkSpinDirection = function (path) {
			if (!path) {
				return false;
			}

			var toReverse = false, 
				toReverseZ = false,
				toBounce = false;

			$.each(op.toReverseArr, function(k, v) {
				if (path.indexOf(v) != -1) {
					toReverse = true;
				}
			}); 

			$.each(op.toReverseArrZ, function(k, v) {
				if (path.indexOf(v) != -1) {
					toReverseZ = true;
				}
			});

			$.each(op.toBounceArr, function(k, v) {
				if (path.indexOf(v) != -1) {
					toBounce = 'bounce';
				}
			});

			return [toReverse, toReverseZ, toBounce];
		};

		// Shortcut function to define example value passed to AJAX-ZOOM
		var whichExample = function() {
			if (op.gallery3dDir) {
				return op.example3dDir;
			} else {
				return op.exampleData;
			}
		};

		// Function for changing the spin object - 3D/360
		var submitNew360 = function(path) {
			// All you need is to 
			if (!path) {
				return false;
			}

			// Pass example=17 setting and new 3dDir
			var data = 'example='+whichExample()+'&3dDir='+path;
				data += '&respW='+$('#'+op.divID).width();
				data += '&respH='+$('#'+op.divID).height();
				// experiment: pass a var if it is responsive

			// Documentation - http://www.ajax-zoom.com/index.php?cid=docs#api_loadAjaxSet
			$.fn.axZm.loadAjaxSet(data, null, function() {
				// Possible callback
				var spinDirectionQuery = checkSpinDirection(path);
				if ($.isArray(spinDirectionQuery)) {
					$.axZm.spinReverse = spinDirectionQuery[0];
					$.axZm.spinReverseZ = spinDirectionQuery[1];
					$.axZm.spinBounce = spinDirectionQuery[2];
				}
				axZmThumbSliderCallback();
			});
		};

		var fireCallback = function(mode, lnk) {
			$.each(op.galleryData, function(k, v) {
				if (v[0] == mode && v[1] == lnk && $.isFunction(v[2])) {
					v[2]();
				}
			});
		};

		// Function for changing 3D/360, 2D and video
		var submitNewMix = function(mode, lnk, zData) {
			//currentZoomMod
			if ($.axZm) {
				if ($.axZm.spinMod) {
					$.fn.axZm.spinStop();
					if ($.axZm.fsi && $.axZm.fullScreenRel == 'window' && $.axZm.spinPreloading) {
						return false;
					}
				}
			}

			var fsTemp = $('#zFsOTempRemove');
			if (fsTemp && fsTemp.length) {
				return false;
			}

			$('#'+op.divID)
			.removeAttr('data-lnk')
			.css('overflow', 'hidden');

			// Not AZ (Video, Iframe, AJAX)
			if (mode != 'image360' && mode != 'imageZoom') {
				/*
				if ($.axZm) {
					$.fn.axZm.remove();
					$('#axZmTempBody').axZmRemove(true);
					$('#axZmTempLoading').axZmRemove(true);
					$('#axZmWrap').axZmRemove(true);
				}*/

				if (op.videoUrl[mode]) {
					showVideo(lnk, mode, true);
				} else {
					// Other mods
					if (mode == 'ajax') {
						showAjax(lnk, mode);
					} else if (mode == 'iframe') {
						showVideo(lnk, mode, false);
					}
				}
			} else {
				var qString = 'example=' + whichExample() + '&' + ((mode == 'image360') ? '3dDir=' : 'zoomData=') + zData;

				if (mode == 'image360') {
					qString += '&image360=1';
				}

				// Add parameter for which image file should be loaded first
				if (lnk) {
					qString += '&zoomFile=' + lnk;
				}

				qString += '&respW=' + $('#'+op.divID).width();
				qString += '&respH=' + $('#'+op.divID).height();

				if (currentZoomMod == 'video') {
					loadAZ(qString);
				} else if (currentZoomMod == mode) {
					if (mode == 'image360') {
						$.fn.axZm.loadAjaxSet(qString, null, function() {
							axZmThumbSliderCallback();
						});
					} else {
						$.fn.axZm.zoomSwitch(lnk, op.zoomSwitchAnm);
					}
				} else {
					$('#' + op.divID).empty();
					loadAZ(qString);
				}

				currentZoomMod = mode;
			}
		};

		// Dynamic thumb path
		var f_dynThumbPath = function(previewDir, previewPic) {
			return zoomLoadFile+'?'
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

		// Draw 3D/360 thumbs 
		var proceedThumbs = function(data) {
			if (countObj(data) < 2) {
				// Empty gallery
				if ($('#'+op.spinGalleryID) && $('#'+op.spinGalleryID).data('axZmThumbSlider')) {
					$('#'+op.spinGalleryID).axZmThumbSlider('kill').removeData();
				} else {
					$('#'+op.spinGalleryID).empty();
				}

				return false;
			}

			// Create empty ul ellement to attach li later
			var ul = $('<ul />');

			// Eterate over returned object
			$.each(data, function(k, val) {
				var v = {};
				// Phalanger json_encode bugfix
				if ($.type(val) == 'array') {
					v[0] = val[1];
					v[1] = val[0];
				} else {
					v = val;
				}

				// object
				if (v[0] != 'error' && v[1] !== false) {
					var dynThumbPath = f_dynThumbPath(v[0], v[1]['fileName']),
						ident = getIdent('image360', v[1]['path']);

					// Empty li ellement
					var li = $('<li />')
					.addClass('axZm_loadingThumb')
					.attr('data-type', 'image360')
					.attr('data-path', getIdent('image360', v[1]['path']))
					.bind('click', function() {
						submitNew360(v[1]['path']);
					});

					// Append "preloading" image to the li
					var img = $('<img>')
					.attr('src', op.axZmPath + 'icons/empty.gif')
					.addClass(op.axZmThumbSlider ? '' : 'thumb')
					.data('spinGallery', v)
					.appendTo(li);

					if (!op.axZmThumbSlider) {
						$('<span />')
						.text(' ')
						.addClass('vAlign')
						.appendTo(li);
					}

					// This is (optional) description of the thumb
					if (op.thumbDescr) {
						var thisThumbDescr = 
						op.thumbDescrObj[ident]
						|| op.thumbDescrObj[v[1]['path']]
						|| op.thumbDescrObj[v[1]['folder']];

						if (!thisThumbDescr) {
							if (isDefined(op.thumbDescrObj[ident])
								|| isDefined(op.thumbDescrObj[v[1]['path']])
								|| isDefined(op.thumbDescrObj[v[1]['folder']])
							) {
								thisThumbDescr = '';
							} else {
								thisThumbDescr = v[1]['frames']+' frames';
							}
						}

						if (thisThumbDescr) {
							$('<div />')
							.addClass('axZmThumbSliderDescription')
							.html(thisThumbDescr)
							.appendTo(li);
						}
					}

					// Optional icon
					if (op.thumbIcon && op.thumbIconFile[v[1]['type']]) {
						$('<img>')
						.addClass('axZmThumbSliderIcon')
						.attr('src', thumbIcon(v[1]['type']))
						.appendTo(li);
					}

					if (!op.axZmThumbSlider) {
						li.css(liCss).css(op.thumbCss);
					}

					// Append li to ul
					li.appendTo(ul);

					// Preload actual thumb
					var thumbLink = op.thumbImgObj[ident] || op.thumbImgObj[v[1]['path']] || op.thumbImgObj[v[1]['folder']];
					if (thumbLink) {
						preloadThumb(img, thumbLink);
					} else {
						preloadThumb(img, dynThumbPath);
					}
				}
			});

			// Remove div with text stating that thumbs will be loaded later
			copy_tempID();

			$('#'+op.spinGallery_tempID).remove();

			// Finally append ul to the gallery container with ID "spinGallery"
			ul.appendTo('#'+op.spinGalleryID);

			// Init axZmThumbSlider
			// For more information see /axZm/extensions/axZmThumbSlider/
			if (op.axZmThumbSlider) {
				$('#'+op.spinGalleryID).axZmThumbSlider(axZmThumbSliderP);
			} else {
				ul.addClass('azThumb');
			}

			setTimeout(axZmThumbSliderCallback, 1);
		};

		var consoleLog = function(a) {
			if (typeof console != 'undefined') {
				console.log(a);
			}
		};

		var countObj = function(obj) {
			var n = 0;
			if ((obj)) {
				$.each(obj, function(i) {
					n++;
				});
			}
			return n;
		};

		// Draw 3D/360, 2D and video thumbs
		var proceedMixedThumbs = function(data) {
			if (countObj(op.galleryData) < 2) {
				// Empty gallery
				if ($('#'+op.spinGalleryID) && $('#'+op.spinGalleryID).data('axZmThumbSlider')) {
					$('#'+op.spinGalleryID).axZmThumbSlider('kill').removeData();
				} else {
					$('#'+op.spinGalleryID).empty();
				}

				return false;
			}

			var ul = $('<ul />');
			var n = 0;

			$.each(op.galleryData, function(k, v) {

				var dataType = v[0],
					dataVal = v[1],
					returnType,
					ident = getIdent(dataType, dataVal),
					key = {},
					keyTemp,
					m,
					dynThumbPath,
					dataPath,
					thumbLink = op.thumbImgObj[ident] || op.thumbImgObj[dataVal]
					;

				// Path for dynamic thumb
				if ((dataType == 'imageZoom' || dataType == 'image360') && data) {

					if (data[dataType] && data[dataType][ident]) {

						keyTemp = data[dataType][ident];

						if ($.type(keyTemp) == 'array') {
							key[0] = keyTemp[1];
							key[1] = keyTemp[0];
						} else {
							key = keyTemp;
						}

						if (dataType == 'imageZoom') {
							dynThumbPath = f_dynThumbPath(key.picPath, key.fileName);
							returnType = '2D';
						} else if (dataType == 'image360') {
							dynThumbPath = f_dynThumbPath(key[0], key[1]['fileName']);
							returnType = key[1]['type'];
						}
					} else if (data && data['error']) {
						consoleLog(ident+': '+data['error'][ident]);
					}
				} else if (op.videoUrl[dataType]) {
					dynThumbPath = 'video';
					returnType = dataType;
				} else if (dataType == 'ajax' || dataType == 'iframe') {
					returnType = dataType;
					dynThumbPath = dataType;
					if (!thumbLink) {
						thumbLink = thumbIcon('text');
					}
				}

				if (dynThumbPath) {
					n++;
					m = n;

					// Empty li ellement
					var li = $('<li />')
					.addClass('axZm_loadingThumb')
					.attr('data-type', dataType)
					.attr('data-path', ident || v[1])
					.bind('click', function() {
						submitNewMix(
							dataType, 
							(dataType == 'imageZoom' ? ident : (dataType != 'image360' ? dataVal : null)),
							(dataType == 'image360' ? key[1].path : (dataType == 'imageZoom' ? galleryData.zoomData : null))
						);
						if (!op.axZmThumbSlider) {
							$('li', '.azThumb').removeClass('selected');
							$(this).addClass('selected');
						}
					});

					// Append "preloading" image to the li
					var img = $('<img>')
					.attr('src', op.axZmPath+'icons/empty.gif')
					.addClass(op.axZmThumbSlider ? '' : 'thumb')
					.appendTo(li);

					if (!op.axZmThumbSlider) {
						$('<span />')
						.text(' ')
						.addClass('vAlign')
						.appendTo(li);
					}

					// This is (optional) description of the thumb
					if (op.thumbDescr) {
						var thisThumbDescr = op.thumbDescrObj[ident] || op.thumbDescrObj[dataVal] || op.thumbDescrObj[getl('/', dataVal)] || '';
						if (!thisThumbDescr) {
							if (isDefined(op.thumbDescrObj[ident]) || isDefined(op.thumbDescrObj[dataVal])) {
								thisThumbDescr = '';
							} else if (dataType == 'image360') {
								thisThumbDescr = key[1]['frames']+' frames';
							}
						}

						$('<div />')
						.addClass('axZmThumbSliderDescription')
						.html(thisThumbDescr)
						.appendTo(li);
					}

					// Optional icon
					if (op.thumbIcon && op.thumbIconFile[returnType]) {
						$('<img>')
						.addClass('axZmThumbSliderIcon')
						.attr('src', thumbIcon(returnType))
						.appendTo(li);
					}

					if (!op.axZmThumbSlider) {
						li.css(liCss)
						.css(op.thumbCss)
					}

					// Append li to ul
					li.appendTo(ul);

					if (thumbLink) {
						preloadThumb(img, thumbLink);
					} else {
						if (dynThumbPath == 'video') {
							preloadVideoThumb(img, dataVal, dataType);
						} else {
							preloadThumb(img, dynThumbPath);
						}
					}
				}
			});

			// Remove div with text stating that thumbs will be loaded later
			copy_tempID();

			$('#'+op.spinGallery_tempID).remove();

			var sliderObj = $('#'+op.spinGalleryID);
			var sliderData = sliderObj.data();

			// Kill slider if already inited
			if (sliderData.axZmThumbSlider) {
				sliderObj.axZmThumbSlider('kill');
			}

			// Finally append ul to the gallery container with ID "spinGallery"
			ul.appendTo(sliderObj);

			// Init axZmThumbSlider
			// For more information see /axZm/extensions/axZmThumbSlider/
			if (op.axZmThumbSlider) {
				sliderObj.axZmThumbSlider(axZmThumbSliderP);
			} else {
				ul.addClass('azThumb');
			}

			setTimeout(function() {
				axZmThumbSliderCallback();
			}, 1);
		};

		// Preload a thumb (p) and replace an image
		var preloadThumb = function(o, p) {
			$('<img>').axZmLoad(function() {
				o.closest('li').removeClass('axZm_loadingThumb');
				o.attr('src', p)
				.removeAttr('width')
				.removeAttr('height');
			}).attr('src', p);
		};

		// Get and preload thumbs for video content
		var preloadVideoThumb = function(img, dataVal, dataType) {
			if (dataType == 'vimeo') {
				$.ajax({
					url: op.videoThumb.vimeo.url+dataVal+'.json',
					crossDomain: true,
					cache: true,
					dataType: 'JSON',
					success: function (tt) {
						var imeoImg = tt[0] && tt[0][op.videoThumb.vimeo.img];
						if (imeoImg) {
							preloadThumb(img, imeoImg);
						}
					},
					error: function(tt) {
						consoleLog(op.videoThumb.vimeo.url+dataVal+'.json');
						if (typeof JSON != "undefined" && JSON.stringify) {
							consoleLog(JSON.stringify(tt));
						}
					}
				});
			} else if (dataType == 'dailymotion') {
				$.ajax({
					url: op.videoThumb.dailymotion.url+dataVal+'?fields='+op.videoThumb.dailymotion.img,
					crossDomain: true,
					cache: true,
					dataType: 'JSON',
					success: function (tt) {
						var dailymotionImg = tt[op.videoThumb.dailymotion.img];

						if (dailymotionImg) {
							if (location.protocol === 'https:') {
								dailymotionImg = dailymotionImg.replace(/^http:\/\//i, 'https://');
							}
						
							preloadThumb(img, dailymotionImg);
						}
					},
					error: function(tt) {
						consoleLog(op.videoThumb.dailymotion.url+dataVal+'?fields='+op.videoThumb.dailymotion.img);
						if (typeof JSON != "undefined" && JSON.stringify) {
							consoleLog(JSON.stringify(tt));
						}
					}
				});
			} else if (dataType == 'youtube') {
				var youtubeImg = op.videoThumb.youtube.url + dataVal + '/' + op.videoThumb.youtube.img + '.jpg';
				preloadThumb(img, youtubeImg);
			}
		};

		// Gallery will be loaded after first spin is preloaded
		var request360gallery = function() {
			// Request other 360 or 3D for the gallery
			$.ajax({
				url: zoomLoadFile,
				data: 'zoomDir='+op.gallery3dDir+'&qq=firstImageSpinFolder',
				cache: false,
				dataType: 'JSON',
				success: function (data) {
					if (isObject(data)) {
						proceedThumbs(data);
						galleryLoaded = true;
					} else {
						// Some error handling
						var errText = 'Failed to load 360 gallery';
						if ($.isArray(data) && data[0] == 'error') {
							errText += '<br>'+data[1];
						}

						$('#'+op.spinGallery_tempID)
						.removeClass(op.spinGalleryLoadingClass)
						.html('<span style="color: red">'+errText+'</span>');
					}
				}
			});
		};

		// Check data
		var requestGalleryData = function() {
			var allGalleryDataString = galleryData.str.join('|');

			$.ajax({
				url: zoomLoadFile,
				data: 'zoomMixedData='+galleryData.str.join('|')+'&qq=firstImageFromMixedData',
				cache: false,
				dataType: 'JSON',
				success: function (data) {
 					proceedMixedThumbs(data);
 					galleryLoaded = true;
				}
			});
		};

		var someIconImage = function(image) {
			if (typeof image == 'string') {
				if (image.indexOf('/') != -1) {
					return image;
				} else {
					return op.axZmPath + 'icons/' + image;
				}
			} else {
				return op.axZmPath + 'icons/empty.gif';
			}
		};

		// Check data
		var processGalleryData = function() {
			galleryData.firstToLoad = [];
			galleryData.str = [];
			galleryData.o = [];
			galleryData.i = {};
			var firstToLoadiZ = false,
				idxImg = 1,
				idx360 = 1,
				idxVid = 1;

			//images360Big: "media-360-1200.png",
			//imagesVideoBig: "media-play-1200.png",

			$.each(op.galleryData, function(k, v) {

				if (v[0] == 'imageZoom') {
					firstToLoadiZ = true;
				}

				if (v[0] == 'image360') {
					if (k == 0) {
						galleryData.firstToLoad = v;
					}
					galleryData.o[k] = '360_'+idx360++;
					galleryData.i[galleryData.o[k]] = someIconImage(op.images360Big);
				} else if (v[0] == 'imageZoom') {
					if (!galleryData.zoomDataArr) {
						galleryData.zoomDataArr = [];
					}

					galleryData.zoomDataArr.push(v[1]);
					galleryData.o[k] = ''+idxImg++;
					galleryData.i[galleryData.o[k]] = v[1];
					if (k == 0) {
						galleryData.firstToLoad = ['imageZoom'];
					}

				} else { // youtube etc.
					if (k == 0) {
						galleryData.firstToLoad = v;
					}

					galleryData.o[k] = (isVideo(v[0]) ? 'video_' : v[0]+'_')+idxVid++;
					galleryData.i[galleryData.o[k]] = someIconImage(op.imagesVideoBig);
				}

				galleryData.str.push(v[0]+'*'+v[1]);
			});

			if (op.firstToLoad == 'imageZoom' && !firstToLoadiZ) {
				op.firstToLoad = null;
			} else if (op.firstToLoad && op.firstToLoad != 'imageZoom') {
				var firstToLoadElse = false;
				// Direct
				$.each(op.galleryData, function(k, v) {
					if (v[0] != 'imageZoom' && v[1] == op.firstToLoad) {
						op.firstToLoad = v;
						firstToLoadElse = true;
						return false;
					}
				});

				if (!firstToLoadElse) {
					$.each(op.galleryData, function(k, v) {
						if (v[0] != 'imageZoom' && typeof v[1] == 'string' && v[1].indexOf(op.firstToLoad) != -1) {
							firstToLoadElse = true;
							op.firstToLoad = v;
							return false;
						}
					});
				}

				if (!firstToLoadElse) {
					op.firstToLoad = null;
				}
			}

			if (op.firstToLoad) {
				if (op.firstToLoad == 'imageZoom') {
					galleryData.firstToLoad = ['imageZoom'];
				} else {
					galleryData.firstToLoad = op.firstToLoad;
				}
			}

			if (galleryData.zoomDataArr) {
				galleryData.zoomData = galleryData.zoomDataArr.join('|');
			}
		};

		var videFrameC = function(lnk, mode, vdeo) {
			return $('<iframe />')
			.addClass('azVideoIframe')
			.data('lnk', lnk)
			.axZmLoad(function() {
				$(this).addClass('azVideoIframeNoBack')
			})
			.attr({
				src: vdeo ? (op.videoUrl[mode]+lnk+'?'+$.param(op.videoSettings[mode])) : lnk,
				width: '100%',
				height: '100%',
				frameborder: 0,
				allowfullscreen: ' '
			});
		};

		// Show iframe with video content
		var showVideo = function(lnk, mode, vdeo) {
			var axZm_zoomLayer = $('#axZm_zoomLayer');

			// AZ inited
			if (axZm_zoomLayer.length) {
				$('.azAjaxFrameAct', axZm_zoomLayer).remove();

				// Frame there
				if ($('.azVideoIframe', axZm_zoomLayer).length) {
					// Load new video into existing iframe
					$('.azVideoIframe', axZm_zoomLayer)
					.removeClass('azVideoIframeNoBack')
					.attr('src', vdeo ? (op.videoUrl[mode]+lnk+'?'+$.param(op.videoSettings[mode])) : lnk);
				} else {
					// Append frame to axZm_zoomLayer
					videFrameC(lnk, mode, vdeo)
					.css({position: 'absolute', zIndex: 1001})
					.appendTo(axZm_zoomLayer)
				}
			} else {
				$('#'+op.divID).html(videFrameC(lnk, mode, vdeo));
			}

			if (vdeo) {
				currentZoomMod = 'video';
			} else {
				currentZoomMod = 'text';
			}

			axZmThumbSliderCallback();
		};

		var showAjax = function(lnk, mode) {
			var axZm_zoomLayer = $('#axZm_zoomLayer');

			$('#'+op.divID)
			.attr('data-lnk', lnk);

			if (!axZm_zoomLayer.length) {
				$('#'+op.divID).addClass('azAjaxFrame');
			}

			$.ajax({
				url: lnk,
				type: 'GET',
				dataType: 'html',
				cache: false,
				complete: function (ret) {
					if (axZm_zoomLayer.length) {
						$('.azVideoIframe,.azAjaxFrameAct', axZm_zoomLayer).remove();
						$('<div />')
						.addClass('azAjaxFrameAct')
						.html(ret.responseText)
						.appendTo(axZm_zoomLayer);
						
					} else {
						$('#'+op.divID).css({
							overflowY: 'auto'
						})
						.removeClass('azAjaxFrame')
						.html(ret.responseText);
						
					}

					fireCallback(mode, lnk);

				}
			});

			currentZoomMod = 'text';
			axZmThumbSliderCallback();
		};

		var isVideo = function(a) {
			if (a == 'youtube' || a == 'vimeo' || a == 'dailymotion') {
				return true;
			}
			return false;
		};

		// Load first 360/3D, 2D or video
		var loadFirst = function() {
			var qString;

			// gallery from 360s
			if (op.first3dDir && op.gallery3dDir) {
				qString = 'example='+whichExample()+'&3dDir='+op.first3dDir;
			} else if (op.galleryData) {
				// Mixed gallery

				processGalleryData();
				var firstToLoadType = galleryData.firstToLoad[0];

				if (firstToLoadType == 'image360') {
					// Load a 360 or 3d at first
					qString = 'example='+whichExample()+'&3dDir='+galleryData.firstToLoad[1];
					qString += '&respW='+$('#'+op.divID).width();
					qString += '&respH='+$('#'+op.divID).height();
					currentZoomMod = firstToLoadType;
				} else if (firstToLoadType == 'imageZoom') {
					// Load 2D images
					qString = 'example='+whichExample()+'&zoomData='+galleryData.zoomData;
					qString += '&respW='+$('#'+op.divID).width();
					qString += '&respH='+$('#'+op.divID).height();
					currentZoomMod = firstToLoadType;
				} else if (isVideo(firstToLoadType)) {
					showVideo(galleryData.firstToLoad[1], firstToLoadType, true);
					loadGalleryCallback();
					return false;
				} else {
					if (mode == 'ajax') {
						showAjax(galleryData.firstToLoad[1], firstToLoadType);
						loadGalleryCallback();
						return false;
					} else if (mode == 'iframe') {
						showVideo(galleryData.firstToLoad[1], firstToLoadType, false);
						loadGalleryCallback();
						return false;
					}
				}
			}

			if (qString) {
				loadAZ(qString);
			}
		};

		// Load AJAX-ZOOM depending on the settings
		var loadAZ = function(qString) {
			if (op.axZmPar) {
				qString += '&'+op.axZmPar;
			}

			if (op.embedResponsive) {
				// $.fn.axZm.openFullScreen to load into responsive layout
				$.fn.axZm.openFullScreen(
					op.axZmPath, 
					qString,
					op.axZmCallBacks, 
					op.divID, 
					op.fullScreenApi,
					true
				);
			} else {
				// Load into layout with fixed with and height
				$.fn.axZm.load({
					path: op.axZmPath,
					parameter: qString,
					opt: op.axZmCallBacks,
					divID: op.divID,
					apiFullscreen: op.fullScreenApi
				});
			}
		};

		// Make some checks and init the process
		var init = function() {

			if (!op.axZmPath || op.axZmPath == 'auto') {
			
				if ($.isFunction($.fn.axZm)) {
					op.axZmPath = $.fn.axZm.installPath();
				} else {
					alert('/axZm/jquery.axZm.js is not loaded');
					return false;
				}

				if (!op.axZmPath) {
					alert('Please set axZmPath manually.');
					return false;
				}
			}

			if (!$('#'+op.divID).length) {
				alert('Container with ID '+op.divID+' (option divID) was not found.');
				return false;
			}

			if (!$('#'+op.spinGalleryID).length) {
				alert('Container with ID '+op.spinGalleryID+' (option spinGalleryID) was not found.');
				return false;
			}
		
			if (!$('#'+op.spinGalleryContainerID).length) {
				alert('Container with ID '+op.spinGalleryContainerID+' (option spinGalleryContainerID) was not found.');
				return false;
			}

			if (!op.gallery3dDir && !op.galleryData) {
				alert('gallery3dDir or galleryData option has to be defined!');
				return false;
			}

			if (op.gallery3dDir && op.galleryData) {
				op.galleryData = false;
			}

			if (!op.gallery3dDir && !$.isArray(op.galleryData)) {
				alert('galleryData is not an array!');
				return false;
			}

			if (op.gallery3dDir && !op.first3dDir) {
				alert('first3dDir option is not defined!');
				return false;
			}

			if (!op.gallery3dDir && $.isArray(op.galleryData) && $.isEmptyObject(op.galleryData)) {
				$('#'+op.spinGalleryID).empty();
				$('#'+op.divID).empty().append('<div class="'+op.noImageClass+'"></div>');
				return false;
			}

			if (location.protocol === 'https:') {
				op.videoThumb.vimeo.url = op.videoThumb.vimeo.url.replace(/^http:\/\//i, 'https://');
			} else {
				op.videoThumb.vimeo.url = op.videoThumb.vimeo.url.replace(/^https:\/\//i, 'http://');
			}

			if (op.axZmThumbSlider && !$.isFunction($.axZmThumbSlider)) {
				alert('jquery.axZm.thumbSlider.js is not present!');
				op.axZmThumbSlider = false;
			}

			if (op.spinGallery_tempID) {
				$('#' + op.spinGallery_tempID)
				.addClass(op.spinGalleryLoadingClass);
			}

			if (op.thumbPadding >= 0) {
				liCss.padding = op.thumbPadding;
			}

			if (op.thumbMarginRight >= 0) {
				liCss.marginRight = op.thumbMarginRight;
			}

			if (op.thumbMarginBottom >= 0) {
				liCss.marginBottom = op.thumbMarginBottom;
			}

			if ($.axZm) {
				$.fn.axZm.spinStop();
				if ($.fn.axZm.killInternalGalleries) {
					$.fn.axZm.killInternalGalleries();
				}

				$.fn.axZm.remove();
				$('#axZmTempBody').axZmRemove(true);
				$('#axZmTempLoading').axZmRemove(true);
				$('#axZmWrap').axZmRemove(true);
			}

			zoomLoadFile = op.axZmPath+'zoomLoad.php';

			obj = $('#'+op.spinGalleryContainerID);

			// Merge callbacks
			op.axZmCallBacks = $.fn.axZm.mergeCallBackObj(defCallBacks, op.axZmCallBacks);

			// Slider parameters
			axZmThumbSliderP = $.extend({}, true, axZmThumbSliderParamDefault, op.axZmThumbSliderParam );
			axZmThumbSliderP.contentMode = false;

			// Save options to access from outside
			obj.data('aZ', op);

			// Need it only for demo
			obj.data('reload', function() {
				loadFirst();
			});

			obj.data('getKey', function() {
				return getKey();
			});

			loadFirst();
		};

		// If $.axZm360Gallery was inited before needed DOM is ready
		if (!$('#'+op.divID).length) {
			$(document).ready(init);
		} else {
			init();
		}
	};

	// This is for the demo to change options
	$.axZm360Gallery_getParam = function(obj) {
		var ref = $('#'+obj);
		if (ref.length > 0) {
			return ref.data('aZ');
		}

		return {};
	};

	$.axZm360Gallery_reload = function(obj, dta) {
		var param = $.axZm360Gallery_getParam(obj);

		if (typeof param == 'object' && typeof dta == 'object') {
			param.galleryData = dta.galleryData;
			param.thumbDescrObj = dta.thumbDescrObj || {};
			param.thumbImgObj = dta.thumbImgObj || {};
			param.galleryHotspots = dta.galleryHotspots || {};

			// Empty gallery
			if ($('#'+param.spinGalleryID) && $('#'+param.spinGalleryID).data('axZmThumbSlider')) {
				$('#'+param.spinGalleryID).axZmThumbSlider('kill').removeData();
			} else {
				$('#'+param.spinGalleryID).empty();
			}

			if (param.spinGallery_tempID_HTML) {
				$('#'+param.spinGalleryID)
				.append(param.spinGallery_tempID_HTML)
				.addClass(op.spinGalleryLoadingClass);
			}

			if ($.isArray(param.galleryData) && !$.isEmptyObject(param.galleryData)) {
				$.axZm360Gallery(param);
			} else {
				$.fn.axZm.spinStop();
				$.fn.axZm.remove();
				$('#axZmTempBody').axZmRemove(true);
				$('#axZmTempLoading').axZmRemove(true);
				$('#axZmWrap').axZmRemove(true);

				$('#'+param.divID).empty().append('<div class="'+param.noImageClass+'"></div>');
			}
		}
	};

})(jQuery);

// Cross-Domain AJAX for IE8 and IE9 (for Vimeo and Dailymotion video thumbnails)

/*!
 * jQuery-ajaxTransport-XDomainRequest - v1.0.4 - 2015-03-05
 * https://github.com/MoonScript/jQuery-ajaxTransport-XDomainRequest
 * Copyright (c) 2015 Jason Moon (@JSONMOON)
 * Licensed MIT
 */
;(function(a){if(typeof define==='function'&&define.amd){define(['jquery'],a)}else if(typeof exports==='object'){module.exports=a(require('jquery'))}else{a(jQuery)}}(function($){if(!$.support){return $}if($.support.cors||!$.ajaxTransport||!window.XDomainRequest){return $}var n=/^(https?:)?\/\//i;var o=/^get|post$/i;var p=new RegExp('^(\/\/|'+location.protocol+')','i');$.ajaxTransport('* text html xml json',function(j,k,l){if(!j.crossDomain||!j.async||!o.test(j.type)||!n.test(j.url)||!p.test(j.url)){return}var m=null;return{send:function(f,g){var h='';var i=(k.dataType||'').toLowerCase();m=new XDomainRequest();if(/^\d+$/.test(k.timeout)){m.timeout=k.timeout}m.ontimeout=function(){g(500,'timeout')};m.onload=function(){var a='Content-Length: '+m.responseText.length+'\r\nContent-Type: '+m.contentType;var b={code:200,message:'success'};var c={text:m.responseText};try{if(i==='html'||/text\/html/i.test(m.contentType)){c.html=m.responseText}else if(i==='json'||(i!=='text'&&/\/json/i.test(m.contentType))){try{c.json=$.parseJSON(m.responseText)}catch(e){b.code=500;b.message='parseerror'}}else if(i==='xml'||(i!=='text'&&/\/xml/i.test(m.contentType))){var d=new ActiveXObject('Microsoft.XMLDOM');d.async=false;try{d.loadXML(m.responseText)}catch(e){d=undefined}if(!d||!d.documentElement||d.getElementsByTagName('parsererror').length){b.code=500;b.message='parseerror';throw'Invalid XML: '+m.responseText;}c.xml=d}}catch(parseMessage){throw parseMessage;}finally{g(b.code,b.message,c,a)}};m.onprogress=function(){};m.onerror=function(){g(500,'error',{text:m.responseText})};if(k.data){h=($.type(k.data)==='string')?k.data:$.param(k.data)}m.open(j.type,j.url);m.send(h)},abort:function(){if(m){m.abort()}}}});return $}));
