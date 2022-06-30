/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.thumbGallery.js
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.2
* Extension Date: 2019-02-08
* URL: http://www.ajax-zoom.com
* Documentation: https://www.ajax-zoom.com/index.php?cid=docs
* Example: https://www.ajax-zoom.com/examples/example5.php
*/

;(function($) {

	$.azThumbGallery = function(opt) {

		var def = {
			// Path to /axZm directory, e.g. /test/axZm/; auto not always works
			axZmPath: "auto",

			// The look of navigation for subfolders. Only useable if "zoomDir" is defined (not with "zoomData");
			// Possible values: "select", "folders", "imgFolders" or false
			folderSelect: "select",

			// Path to subfolders with images
			zoomDir: null,

			// After page loads select from which subfolder thumbnails should be loaded first, 
			// integer (index of subfolder) or string (name of the subfolder) 
			firstFolder: null, 
			zoomData: null, 

			// Applied if folderSelect is set to "folders" 
			// Prefix of icon image located in /axZm/icons directory
			// There are three of them on default: folder_icon_close.png, folder_icon_close_over.png, folder_icon_open.png
			folderIconPrefix: "folder_icon_", 

			// Settings for small icon images when folderSelect option is set to "imgFolders"
			// In the css file you can change the appearance by editing .azImgFolder *
			imgFoldersSettings: {
				thumbNumber: 3, // amount of icons to show, max 3
				thumbWidth: 32, // width
				thumbHeight: 32, // height
				thumbRetina: true,
				thumbQual: 100,
				thumbBackColor: "#FFFFFF",
				thumbMode: "contain",
				thumbsCache: true,
				thumbOpacity: 1
			},

			folderNameFunc: function(input) {
				input = (input.charAt(0).toUpperCase() + input.slice(1)).replace('_', ' ');

				if (input.length > 15) {
					input = input.substring(0, 15)+'...';
				}
				return input;
			},

			// AJAX-ZOOM has several callbacks, 
			// Docu: http://www.ajax-zoom.com/index.php?cid=docs#onBeforeStart
			axZmCallBacks: {},

			// try to open AJAX-ZOOM at browsers fullscreen mode
			fullScreenApi: false,

			// Set location hash when users navigate between the folders
			setHash: false,

			// Type of thumbs. Possible values are 'grid' and 'fixed'
			thumbModel: "grid",

			// Aspect ratio of the thumbnails if "thumbModel" is "grid". 
			// "thumbUlClassGrid" must contain azGridThumb class
			thumbGridAspectRatio: 1.0,

			// Align image inside thumb css at top. Might be useful if description is set. 
			thumbGridTop: false,

			// Class for the UL element, when "thumbModel" option value is "grid"
			thumbUlClassGrid: "azGridThumb azGrid-10-xxl azGrid-8-xl azGrid-6-lg azGrid-6-md azGrid-4-sm azGrid-2-xs",

			// Class for the UL element, when "thumbModel" option value is "fixed"
			thumbUlClassFixed: "azFixedThumb",

			// Sizes of the thumbnails, when "thumbModel" option value is "grid"
			thumbGridSizes: [
				{"w": 100, "h": 100, "q": 90},
				{"w": 200, "h": 200, "q": 90},
				{"w": 400, "h": 400, "q": 80},
				{"w": 600, "h": 600, "q": 75}
			],

			// Cache thumbnails
			thumbsCache: true,

			// Width of the thumbnail image
			thumbWidth: 100,

			// Height of the thumbnail image
			thumbHeight: 100,

			// True will double the resolution of the thumbnails images but keep thumbWidth and thumbHeight on screen
			thumbRetina: true,

			// jpg quality of the thumbnail image
			thumbQual: 90,

			// possible values: "contain", "cover" or false
			thumbMode: false, 

			// background color of the thumb if thumbMode is set to "contain"
			thumbBackColor: "#FFFFFF",

			// Padding, margin
			thumbPadding: null,
			thumbMarginRight: null,
			thumbMarginBottom: null,

			// Inline css besides css file
			thumbCss: {},

			// Show this number of thumbnails at once
			thumbsPerPage: null,

			// Number of thumbs per page depends on screen size
			thumbsPerPageResponsive: null,

			// Object, containing key, value pairs for screen resolution breakpoints as key and number of thumbnails in a row,
			// when "thumbsPerPageResponsive" option is enabled
			thumbsPerPageNumber: {
				"xs": 4,
				"sm": 8,
				"md": 12,
				"lg": 12,
				"xl": 16,
				"xxl": 20
			},

			// Number of rows if thumbsPerPageResponsive is active
			thumbsPerPageRows: 1,

			// Breakpoints for thumbsPerPageNumber
			thumbsPerPageBreakPoints: [
				["xs", function(w, h) {
					// max-width: 575.98px,
					return w < 576;
				}],
				["sm", function(w, h) {
					// min-width: 576px) and (max-width: 767.98px
					return w >= 576 && w < 768
				}],
				["md", function(w, h) {
					// min-width: 768px) and (max-width: 991.98px
					return w >= 768 && w < 992
				}],
				["lg", function(w, h) {
					// (min-width: 992px) and (max-width: 1199.98px)
					return w >= 992 && w < 1200
				}],
				["xl", function(w, h) {
					// (min-width: 1200px)
					return w >= 1200;
				}],
				["xxl", function(w, h) {
					// (min-width: 1900px) and (min-height: 1020px)
					return w >= 1900 && h > 1020 
				}]
			],

			// Position of the pagination
			pageNavPosition: "bottom",

			// Define thumbnail descriptions, key can be filename or index starting with one
			thumbDescrObj: {},

			// array; possible array elements: fileName, thumbDescr, fullDescr;
			thumbDescr: [],

			// If thumbDescr has more than one elemets, they will be splitted by this string
			thumbDescrJoin: "<br>",

			// integer - truncate each of the descriptions or false
			thumbDescrTruncate: false,

			// Image located in /axZm/icons folder which is shown befor thumbnail is loaded
			thumbPreloadingImg: "ajax-loader-map-white.gif",

			// CSS class for preloader
			thumbPreloadingClass: "azThumbPreLoader",

			// ID of the element where thumbnails appended to
			thumbsContainer: "thumbsParentContainer",

			// ID of the element where the select with subfolders will be appended to
			selectContainer: "selectParentContainer",

			// possible values: "fullscreen", "fancyboxFullscreen", "fancybox", "colorbox", "zoomSwitch"
			// zoomSwitch is only possible when player is ebmedded
			ajaxZoomOpenMode: "fullscreen",

			// Open at fullscreen if width of the device is below or equal to this value
			openModeEnforceFullscreen: 1024,

			// configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "fullscreen"
			exampleFullscreen: "mouseOverExtension",

			// configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "fancyboxFullscreen"
			exampleFancyboxFullscreen: "mouseOverExtension",

			// configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "fancybox"
			exampleFancybox: "modal",

			// configuration set value which is passed to ajax-zoom when ajaxZoomOpenMode is "colorbox"
			exampleColorbox: "modal",

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
				boxTitleShow : false,
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
			},

			// AJAX-ZOOM is embedded into some container (embedDivID) next to gallery thumbs 
			embedMode: false,

			embedModeMinSize: 768,

			// The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into 
			embedDivID: "",

			// set this to true if embedDivID is a responsive container
			embedResponsive: true,

			// new (needs $.axZm.embedMapParent or $zoom['config']['embedMapParent'])
			embedMapInThumb: false,

			// example value passed to AJAX-ZOOM when embedMode is activated
			embedExample: 9,

			// When clicked on the thumbs the image inside AJAX-ZOOM will be switched with one of the following effects:
			// Possible values: "Center", "Top", "Right", "Bottom", "Left", "StretchVert", "StretchHorz", "SwipeHorz", "SwipeVert", "Vert", "Horz" 
			embedZoomSwitchAnm: 'SwipeHorz',

			// set speed of switching, - $.axZm.galleryFadeInSpeed, $.axZm.galleryInnerFade, $.axZm.gallerySlideSwipeSpeed
			embedZoomSwitchSpeed: 300,

			// If "thumbsPerPage" is activated and page numbers are present, then clicking on the page number will switch to the first shown image on that page.
			embedSwitchWithPage: true,

			// When gallery loads first the index (number) or file name which should be loaded first. 
			// See also "firstFolder" option in case applied.
			embedFirstImage: 1
		};

		// Helper function
		var isObject = function(x) {
			return (typeof x === 'object') && !(x instanceof Array) && (x !== null);
		};

		var supportsCssVariables = function() {
			return (window.CSS && window.CSS.supports && window.CSS.supports('--fake-var', 0));
		}

		// Helper function
		var objLength = function(a) {
			//return Object.keys(a).length;
			var i=0; $.each(a, function(k, v) {
				i++;
			});
			return i;
		};

		// Helper function
		var getParameterByName = function(name) {
			name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
			var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
			var results = regex.exec(location.search);
			return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		};

		// Local vars
		var op = $.extend(true, {}, def, opt);
		var ul;
		var firstThumbWidth = null;
		var imgGridSize = null;
		var bindResize = null;
		var bindNumThumbs = null;
		var curThumbsPerPage = null;
		var currentData = {};
		var currentPage = 1;
		var currentLoadParam = null;
		var hashChangeBlock = false;
		var folderList = {};
		var sel;
		var obj;

		// Convert zoomData option from array or object to string (CSV separated with |)
		var zoomDataCheck = function(str) {
			if (typeof str == 'string') {
				return str;
			} else if ($.isArray(str)) {
				return str.join('|');
			} else if (isObject(str)) {
				var arr = [];
				$.each(str, function(k, v) {
					if (typeof v == 'string') {
						arr.push(v);
					}
				});
				return arr.join('|');
			} else {
				return null;
			}
		};

		// Observe hash value and change folder if it changes
		var observeHash = function() {
			if (!hashChangeBlock) {
				var h = window.location.hash.replace('#', '');
				if (!h) {
					for (var prop in folderList) {
						h = prop;
						break;
					}
				}

				if (folderList[h]) {
					loadImageThumbs('zoomDir', folderList[h]);
					if (sel.length) {
						if (op.folderSelect == 'select') {
							sel.val(folderList[h]);
						} else if (op.folderSelect == 'folders') {
							$('.folder', sel)
							.attr('src', op.axZmPath+'icons/'+op.folderIconPrefix+'close.png')
							.removeClass('selected');

							$('.descr', sel).removeClass('selected');

							$('.folder[data-folderName="'+h+'"]', sel)
							.attr('src', op.axZmPath+'icons/'+op.folderIconPrefix+'open.png')
							.addClass('selected');

							$('.folder[data-folderName="'+h+'"]', sel).parent().find('.descr').addClass('selected');

						} else if (op.folderSelect == 'imgFolders') {
							$('img.icon', sel).removeClass('selected');

							$('li[data-folderName="'+h+'"] img.icon', sel).addClass('selected');

							$('div.descr', sel).removeClass('selected');
							$('li[data-folderName="'+h+'"] div.descr', sel).addClass('selected');
						}
					}
				}
			}
		};

		var trunc = function(a) {
			var len = op.thumbDescrTruncate;
			var aLen = a.length;

			if (len > 3 && aLen > len) {
				a = a.substr(0, len - 3);
				return a+'...';
			} else {
				return a;
			}
		};

		var thumbWidth = function(rclc) {
			if (!rclc && firstThumbWidth > 1) {
				return firstThumbWidth;
			} else {
				var l = $('#'+op.thumbsContainer+' li:eq(0)>.wrap').width();
				if (l > 1) {
					firstThumbWidth = l;
				} else {
					firstThumbWidth = 100;
				}

				return firstThumbWidth;
			}
		};

		var calcImgGridSize = function(rclc) {
			if (imgGridSize && !rclc) {
				return imgGridSize;
			} else {
				if (rclc) {
					thumbWidth(1);
				}

				var s = window.devicePixelRatio > 1 ? firstThumbWidth * 2 : firstThumbWidth;
				var l = op.thumbGridSizes.length;
				for (var i = 0; i < l; i++) {
					if (i == l - 1 || op.thumbGridSizes[i]['w'] >= s) {
						imgGridSize = op.thumbGridSizes[i];
						break;
					}
				}

				return imgGridSize;
			}
		};

		var imgSrc = function(v, d0) {
			var dpr = window.devicePixelRatio > 1;
			var dynThumbPath = 
			op.axZmPath+'zoomLoad.php?'
			+'previewDir='+(v.picPath || d0)
			+'&previewPic='+v.fileName
			;

			if (op.thumbModel == 'fixed') {
				dynThumbPath +=
				'&qual='+op.thumbQual
				+'&width='+(op.thumbRetina && dpr ? op.thumbWidth * 2 : op.thumbWidth)
				+'&height='+(op.thumbRetina && dpr ? op.thumbHeight * 2 : op.thumbHeight)
				;
			} else {
				thumbWidth();
				calcImgGridSize();
				dynThumbPath +=
				'&qual='+imgGridSize.q
				+'&width='+imgGridSize.w
				+'&height='+imgGridSize.h
				;
			}

			dynThumbPath +=
			'&cache='+op.thumbsCache
			+'&thumbMode='+op.thumbMode
			+'&backColor='+op.thumbBackColor.replace('#', '%23')
			;

			return dynThumbPath;
		};

		var observeSize = function() {
			var fLi = $('#'+op.thumbsContainer+' li:eq(0)');
			if (!fLi.length) {
				$(window).unbind('resize.'+op.thumbsContainer);
				$(window).unbind('orientationchange.'+op.thumbsContainer);
				bindResize = null;
				return;
			}

			var wn = imgGridSize.w;
			calcImgGridSize(1);
			if (imgGridSize.w != wn) {
				if (obj.data('reloadThumbs')) {
					obj.data('reloadThumbs')(true, true, true);
				}
			}
		};

		var getThumbPerpage = function() {
			var thumbsPerPage = parseInt(op.thumbsPerPage);
			if (thumbsPerPage < 1) {
				thumbsPerPage = null;
			}

			if (!thumbsPerPage && op.thumbsPerPageResponsive) {
				if ($.isArray(op.thumbsPerPageBreakPoints)) {
					var w = window.innerWidth;
					var h = window.innerHeight;
					var bp = $.extend(true, [], op.thumbsPerPageBreakPoints);
					var len = bp.length;
					bp.reverse();
					for (var i = 0; i < len; i++) {
						if ($.isFunction(bp[i][1])) {
							var p = bp[i][1](w, h);
							if (p === true) {
								thumbsPerPage = parseInt(op.thumbsPerPageNumber[bp[i][0]]) * parseInt(op.thumbsPerPageRows);
								break;
							}
						}
					}
				}
			}

			if (!thumbsPerPage || thumbsPerPage == 'undefined' || isNaN(thumbsPerPage)) {
				thumbsPerPage = null;
			}

			curThumbsPerPage = thumbsPerPage;
			return thumbsPerPage;
		};

		var observeThumbsPerPage = function() {
			var cT = curThumbsPerPage;
			var nT = getThumbPerpage();
			if (cT != nT) {
				if (obj && obj.data('reloadThumbs')) {
					obj.data('reloadThumbs')(true);
				}
			}
		};

		var observeAspectRatio = function() {
			var fLi = $('#'+op.thumbsContainer+' li:eq(0)');
			if (!fLi.length) {
				$(window).unbind('resize.'+op.thumbsContainer);
				$(window).unbind('orientationchange.'+op.thumbsContainer);
				return;
			}

			var w = fLi.width();
			var fLi = $('#'+op.thumbsContainer+' li').css('padding-bottom', (parseFloat(op.thumbGridAspectRatio) * w) + 'px');
		};

		var isEmbedMode = function() {
			return op.embedMode;
			/*
			if (!op.embedMode) {
				return false;
			} else if (op.embedMode && op.embedModeMinSize) {
				return window.innerWidth >= op.embedModeMinSize;
			}

			return true;
			*/
		};

		// Draw thumbs
		var displayImageThumbs = function(data, page, noAfterSwitch, resize) {
			firstThumbWidth = null;
			imgGridSize = null;

			if ($.isArray(data)) {
				if (data[0] == 'error') {
					// Some error handling
					var errText = 'Failed to load thumbs';
					if ($.isArray(data) && data[0] == 'error') {
						errText += '<br>'+data[1];
					}

					obj.html('<div style="color: red; padding: 5px;">'+errText+'</div>');
				} else {
					var dataLen = objLength(data[1]);
					var zoomDir = data[0];
					var preloadObj = {};
					var firstImage = null;

					if (!page || page < 0) {
						page = 1;
					}

					currentPage = page;

					// Thumbs per page calculation
					var noPages = false;
					var from = false;
					var to = false;
					var thumbsPerPage;

					thumbsPerPage = getThumbPerpage();

					if (thumbsPerPage && currentPage === true) {
						var ft = $('li:eq(0) img.thumb', obj);
						if (ft.length) {
							var ftIdA = ft.attr('id');
							if (ftIdA) {
								var ftIdA = ftIdA.split('_');
								var ftNo = parseInt(ftIdA[2]);
								if (!isNaN(ftNo) && ftNo >= 1) {
									currentPage = Math.ceil(ftNo/thumbsPerPage);
								} else {
									currentPage = 1;
								}
							} else {
								currentPage = 1;
							}
						} else {
							currentPage = 1;
						}
					}

					if (thumbsPerPage && thumbsPerPage < dataLen) {
						noPages = Math.ceil(dataLen/thumbsPerPage);

						if (currentPage > noPages) {
							currentPage = noPages;
						}

						from = thumbsPerPage * (currentPage - 1) + 1;
						to = from - 1 + thumbsPerPage;
					}

					var liCss = {};

					if (op.thumbModel == 'fixed') {
						liCss.width = op.thumbWidth;
						liCss.height = op.thumbHeight;

						if (op.thumbPadding > 0) {
							liCss.padding = op.thumbPadding;
						}

						if (op.thumbMarginRight > 0) {
							liCss.marginRight = op.thumbMarginRight;
						}

						if (op.thumbMarginBottom > 0) {
							liCss.marginBottom = op.thumbMarginBottom;
						}
					}

					if (op.thumbModel == 'fixed' && op.thumbUlClassFixed) {
						ul = $('<ul />');
						ul.addClass(op.thumbUlClassFixed + ' azThumbGalleryFixed');
					} else if (op.thumbModel == 'grid' && op.thumbUlClassGrid) {
						var ars = '';
						if (parseFloat(op.thumbGridAspectRatio) == op.thumbGridAspectRatio && op.thumbGridAspectRatio !== 1 && supportsCssVariables()) {
							ars = '--azAR: '+op.thumbGridAspectRatio;
						}

						ul = $('<ul style="'+ars+'"></ul>');
						ul.addClass(op.thumbUlClassGrid + ' azThumbGalleryGrid');
					}

					$.each(data[1], function(k, v) {

						// Skip thumbs which are not at the page number
						if (to > 0) {
							if (k < from || k > to) {
								return;
							}
						}

						if (!firstImage) {
							firstImage = v['fileName'];
						}

						// "Empty" li ellement
						var li = $('<li />')
						.attr('data-path', (v.picPath || data[0]))
						.attr('data-img', v.fileName)
						.css(liCss)
						.css(op.thumbCss)
						.bind('click', function() {
							var fileName = v['fileName'];
							var zoomDir = data[0];
							var zoomID = k;
							var onBoxesClose = function() {};

							var openMode = op.ajaxZoomOpenMode;
							if (!isEmbedMode() && op.openModeEnforceFullscreen && window.innerWidth <= op.openModeEnforceFullscreen) {
								openMode = 'fullscreen';
							}

							if (!isEmbedMode() && openMode == 'zoomSwitch') {
								openMode = 'fullscreen';
							}

							// Open AJAX-ZOOM as fullscreen
							if (openMode == 'fullscreen') {
								var aZcallBacks = $.extend(true, {}, op.axZmCallBacks);
								$.fn.axZm.openFullScreen(
									op.axZmPath, 
									'zoomFile='+fileName+(op.zoomData ? '&zoomData='+op.zoomData : '&zoomDir='+zoomDir)+'&example='+op.exampleFullscreen, 
									aZcallBacks, 
									'window', 
									op.fullScreenApi,
									false
								);
							}
							else if (openMode == 'fancyboxFullscreen') {
								// Open AJAX_ZOOM as modified / responsive Fancybox
								if (!$.isFunction($.openAjaxZoomInFancyBox)) {
									alert('Please include following scripts in the head section:\n\n/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css \n/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js \n/axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js \n\nImportant: it has to be adjusted Fancybox from AJAX-ZOOM package!\n');
									return false;
								}

								if (op.fancyBoxParam.boxMargin < 30) {
									op.fancyBoxParam.boxMargin = 30;
								}

								var aZcallBacks = $.extend(true, {}, op.axZmCallBacks);

								var thisParam = {
									axZmPath: op.axZmPath,
									queryString: 'example='+op.exampleFancyboxFullscreen+'&zoomFile='+fileName+(op.zoomData ? '&zoomData='+op.zoomData : '&zoomDir='+zoomDir),
									fullScreenApi: op.fullScreenApi,
									ajaxZoomCallbacks: aZcallBacks,
									boxOnClosed: onBoxesClose
								};

								$.openAjaxZoomInFancyBox($.extend(true, {}, thisParam, aZcallBacks));
							} 
							else if (openMode == 'fancybox') {
								// Open AJAX_ZOOM in regular Fancybox

								$('#axZmTempBody, #axZmWrap').axZmRemove(true);

								var axZmWrap = $('<div />')
								.css({display: 'none'})
								.attr('id', 'axZmWrap')
								.appendTo('body');

								// Trigger fancybox
								var onStart = function() {
									axZmWrap.css('display', '');

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
										title: op.fancyBoxParam.boxTitleShow ? (currentData[1][$.axZm.zoomID]['fullDescr'] || 'Image No. '+$.axZm.zoomID) : null,
										onClosed: function() {
											onBoxesClose();
											$.fn.axZm.spinStop();
											$.fn.axZm.remove();
											$('#axZmTempBody').axZmRemove(true);
											$('#axZmTempLoading').axZmRemove(true);
											$('#axZmWrap').axZmRemove(true);
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
										if ($.fancybox.init) {
											var titleDivMap = {
												'float': 'fancybox-title-float-main',
												'outside': 'fancybox-title-outside', 
												'inside': 'fancybox-title-inside', 
												'over': 'fancybox-title-over'
											}

											$('#'+titleDivMap[op.fancyBoxParam.boxTitlePosition]).html(currentData[1][$.axZm.zoomID]['fullDescr'] || ('Image No. '+$.axZm.zoomID + ' / ' + $.axZm.numGA));

											if (op.fancyBoxParam.boxTitlePosition == 'float') {
												$('#fancybox-title').css('left', $('#fancybox-wrap').outerWidth()/2 - $('#fancybox-title').outerWidth()/2);
											}
										} else {
											var ourTitleDiv = $('.fancybox-title');
											var ourTitle = currentData[1][$.axZm.zoomID]['fullDescr'] || ('Image No. '+$.axZm.zoomID + ' / ' + $.axZm.numGA);
											if (ourTitleDiv.length) {
												if (ourTitleDiv.children().first().length) {
													ourTitleDiv.children().first().html(ourTitle);
												} else {
													ourTitleDiv.html(ourTitle);
												}
											}
										}
									}
								};

								var aZcallBacks = $.fn.axZm.mergeCallBackObj({onStart: onStart, onImageChange: onImageChange}, op.axZmCallBacks);

								$.fn.axZm.load({
									opt: aZcallBacks,
									path: op.axZmPath,
									parameter: 'zoomFile='+fileName+(op.zoomData ? '&zoomData='+op.zoomData : '&zoomDir='+zoomDir)+'&example='+op.exampleFancybox,
									divID: 'axZmWrap',
									apiFullscreen: op.fullScreenApi
								});

							} 
							else if (openMode == 'colorbox') {
								// Open AJAX_ZOOM in Colorbox

								$('#axZmTempBody, #axZmWrap').axZmRemove(true);
								var axZmWrap = $('<div />')
								.css({display: 'none'})
								.attr('id', 'axZmWrap')
								.appendTo('body');

								var onStart = function() {
									axZmWrap.css('display', '');

									var thisParam = {
										opacity: 0.9,
										initialWidth: 300,
										initialHeight: 300,
										preloading: false,
										scrolling: false,
										scrollbars: false,
										title: op.colorBoxParam.title ? currentData[1][$.axZm.zoomID]['fullDescr'] : false,
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

								}

								var onImageChange = function() {
									if (op.colorBoxParam.title) {
										if (currentData[1][$.axZm.zoomID]['fullDescr']) {
											$('#cboxTitle').html(currentData[1][$.axZm.zoomID]['fullDescr']);
										} else {
											$('#cboxTitle').html('');
										}
									}
								};

								var aZcallBacks = $.fn.axZm.mergeCallBackObj({onStart: onStart, onImageChange: onImageChange}, op.axZmCallBacks);

								$.fn.axZm.load({
									opt: aZcallBacks,
									path: op.axZmPath,
									parameter: 'zoomFile='+fileName+(op.zoomData ? '&zoomData='+op.zoomData : '&zoomDir='+zoomDir)+'&example='+op.exampleColorbox,
									divID: 'axZmWrap',
									apiFullscreen: op.fullScreenApi
								});
							}

							// In case AJAX-ZOOM is embeded, just switch to the image
							else if (openMode == 'zoomSwitch') {
								$('li', obj).removeClass('selected');
								$(this).addClass('selected');
								$.fn.axZm.zoomSwitch(fileName, op.embedZoomSwitchAnm);
							}

							// Custom
							else if ($.isFunction(openMode)) {
								if (op.data.axZmCallbacks) {
									$.extend(op.data.axZmCallbacks, op.axZmCallBacks);
								} else {
									op.data.axZmCallbacks = $.extend(true, {}, op.axZmCallBacks);
								}

								op.data.zoomID = zoomID;
								openMode(op.data);
							} else {
								alert('Sorry, but at this point there are no other mods than (AJAX-ZOOM) "fullscreen", "fancyboxFullscreen", "fancybox" and "colorbox".');
							}

						});

						if (op.thumbModel == 'grid' && op.thumbGridTop) {
							li.addClass('thumb-top');
						}

						// Append "preloading" image to the li
						var img = $('<img>')
						.addClass('thumb')
						.attr('src', op.thumbModel == 'fixed' && op.thumbPreloadingImg ? op.axZmPath+'icons/'+op.thumbPreloadingImg : op.axZmPath+'icons/empty.gif')
						.attr('id', op.thumbsContainer +'_thumb_'+k)
						.attr('data-path', (v.picPath || data[0]));

						var ref = li;

						if (op.thumbModel == 'grid') {
							ref = $('<div />')
							.addClass('wrap')
							.appendTo(li);

							if (op.thumbPreloadingClass) {
								$('<div />')
								.addClass(op.thumbPreloadingClass)
								.appendTo(ref);
							}
						}

						img.appendTo(ref);

						// For vertical center...
						if (op.thumbModel == 'fixed') {
							$('<span />').text(' ').addClass('vAlign').appendTo(ref);
						}

						// Description
						var txt = [];
						if (!$.isEmptyObject(op.thumbDescrObj)) {
							if (op.thumbDescrObj[v.fileName]) {
								txt.push(op.thumbDescrObj[v.fileName]);
							} else if (op.thumbDescrObj[parseInt(k)]) {
								txt.push(op.thumbDescrObj[parseInt(k)]);
							} else if (op.thumbDescrObj[k]) {
								txt.push(op.thumbDescrObj[k]);
							}
						}

						if ($.isArray(op.thumbDescr)) {
							$.each(op.thumbDescr, function(ii, vv) {
								if (v[vv]) {
									txt.push(v[vv]);
								}
							});
						}

						if (txt.length) {
							var descr = $('<div />').addClass('descr');
							var txtt = txt.join(op.thumbDescrJoin);
							txtt = trunc(txtt);

							if (op.thumbModel == 'grid') {
								descr.html('<div>'+txtt+'</div>').appendTo(ref);
							} else {
								descr.html(txtt).appendTo(ref);
							}
						}

						// Append li to ul
						li.appendTo(ul);
					});

					var pageContainer = null;

					// Add page numbers navigation
					if (noPages > 1) {

						var pageContainer = $('<div />')
						.addClass('axPagesParent');

						for (var i = 1; i <= noPages; i++) {

							var azPages = $('<div />')
							.addClass('azPages'+(currentPage == i ? ' selected' : ''))
							.text(i)
							.data('pageNo', i)
							.bind('click', function() {
								displayImageThumbs(currentData, $(this).data('pageNo'))
							})
							.appendTo(pageContainer);
						}
					}

					obj.empty().prepend(ul);

					if (pageContainer) {
						if (op.pageNavPosition == 'top') {
							obj.prepend(pageContainer);
						} else {
							obj.append(pageContainer);
						}
					}

					// Preload thumbnails
					$.each(data[1], function(k, v) {

						// Skip thumbs which are not at the page number
						if (to > 0) {
							if (k < from || k > to) {
								return;
							}
						}

						var dynThumbPath = imgSrc(v, data[0]);

						// Preload actual thumb
						preloadObj[k] = function() {
							$('<img>').axZmLoad(function() {
								var img = $('#'+op.thumbsContainer +'_thumb_'+k);

								// Replace "preloading" image with the thumb
								img
								.attr('src', dynThumbPath)
								.attr('data-imgsize', imgGridSize ? imgGridSize.w : (op.thumbRetina && window.devicePixelRatio > 1 ? (op.thumbWidth * 2) : op.thumbWidth))
								//.removeAttr('id')
								.removeAttr('width') // IE
								.removeAttr('height'); // IE

								if (op.thumbPreloadingClass && op.thumbModel != 'fixed') {
									$('.'+op.thumbPreloadingClass, img.closest('li')).remove();
								}
							}).attr('src', dynThumbPath);
						};
					});

					// Fire AJAX-ZOOM if it is embedded
					if (isEmbedMode()) {
						var loadParam = (op.zoomData ? '&zoomData='+op.zoomData : '&zoomDir='+zoomDir)+'&example='+op.embedExample,
						embedFirstImage = '';

						if (!currentLoadParam && op.embedFirstImage) {
							embedFirstImage = '&'+(parseInt(op.embedFirstImage) == op.embedFirstImage ? 'zoomID='+op.embedFirstImage : 'zoomFile='+op.embedFirstImage);
						}

						if (currentLoadParam && $.axZm) {
							var cImg = $.axZm.zoomGA[$.axZm.zoomID].img;
							$('li', obj).removeClass('selected');
							$('li[data-img="'+cImg+'"]', obj).addClass('selected');
						}

						if (currentLoadParam != loadParam) {

							if (!currentLoadParam) {
								$.fn.axZm.spinStop();
								$.fn.axZm.remove();
								$('#axZmTempBody').axZmRemove(true);
								$('#axZmTempLoading').axZmRemove(true);
								$('#axZmWrap').axZmRemove(true);

								var currentLiThumb = function() {
									var cImg = $.axZm.zoomGA[$.axZm.zoomID].img;
									return $('li[data-img="'+cImg+'"]', obj);
								};

								var onResizeAdjustments = function() {
									var mapDiv = $('#'+$.axZm.mapParent);
									if (mapDiv.length && $.axZm && $.fn.axZm) {
										var ww = mapDiv.innerWidth();
										var hh = mapDiv.innerHeight();
										$.fn.axZm.resetMap(ww, hh, ww, hh);
									} else {
										$(window)
										.unbind('resize.'+op.thumbsContainer+' orientationchange.'+op.thumbsContainer);
									}
								};

								var appendImageMapToThumb = function(hide, setSize) {
									if (op.embedMapInThumb && $.axZm && $.axZm.mapParent) {
										var cThumb = currentLiThumb();
										if (cThumb.length) {
											if (hide) {
												$('#'+$.axZm.mapParent).css('visibility', 'hidden');
												return;
											}

											$('#'+$.axZm.mapParent)
											.appendTo(op.thumbModel == 'grid' ? cThumb.find('.wrap') : cThumb).css({
												visibility: 'visible',
												opacity: 0
											})
											.fadeTo(400, 1);
										}

										if (setSize) {
											onResizeAdjustments();
										}


									}
								};

								// Merge callbacks
								op.axZmCallBacks = $.fn.axZm.mergeCallBackObj(
									op.axZmCallBacks, // callbacks passed over plugin
									// some internal callbacks for the gallery
									{
										onBeforeStart: function() {
											if (op.embedZoomSwitchSpeed) {
												$.axZm.galleryFadeInSpeed = op.embedZoomSwitchSpeed;
												$.axZm.galleryInnerFade = op.embedZoomSwitchSpeed;
												$.axZm.gallerySlideSwipeSpeed = op.embedZoomSwitchSpeed;
											}

											if (op.embedZoomSwitchAnm) {
												$.axZm.galleryFadeInAnm = op.zoomSwitchAnm;
											}
										}, 
										onLoad: function() {
											// Heilight selected thumb
											currentLiThumb().addClass('selected')

											// 
											if ($.axZm.mapParent && $('#'+$.axZm.mapParent).length) {

												appendImageMapToThumb();

												// Adjust the size of AJAX-ZOOM "image map"
												$(window)
												.unbind('resize.'+op.thumbsContainer+' orientationchange.'+op.thumbsContainer)
												.bind('resize.'+op.thumbsContainer+' orientationchange.'+op.thumbsContainer, function(e) {
													if (e.type == 'orientationchange') {
														setTimeout(onResizeAdjustments, 1);
													} else {
														onResizeAdjustments();
													}
												});

												$('#'+$.axZm.mapParent).css('visibility', 'visible');
												onResizeAdjustments();
											}
										},
										onImageChangeEnd: function() {
											// Heilight selected thumb
											var cImg = $.axZm.zoomGA[$.axZm.zoomID].img;
											var foundThumb = $('li[data-img="'+cImg+'"]', obj);

											if (foundThumb.length > 0) {
												$('li', obj).removeClass('selected');
												$('li[data-img="'+cImg+'"]', obj).addClass('selected');
											} else if (op.embedSwitchWithPage && noPages > 1 && curThumbsPerPage) {
												// Switch pages too if image change has been inited by API
												displayImageThumbs(currentData, Math.ceil($.axZm.zoomID/curThumbsPerPage), true);
											}

											appendImageMapToThumb(false, true);
										},
										onImageChange: function() {
											appendImageMapToThumb(true);
										}
								});

								// AJAX-ZOOM parent container is responsive
								if (op.embedResponsive) {
									$.fn.axZm.openFullScreen(
										op.axZmPath, 
										loadParam+embedFirstImage,
										op.axZmCallBacks, 
										op.embedDivID, 
										op.fullScreenApi,
										true
									);
								}
								// Parent container has fixed width and height
								else{
									$.fn.axZm.load({
										opt: op.axZmCallBacks,
										path: op.axZmPath,
										parameter: loadParam+embedFirstImage,
										divID: op.embedDivID,
										apiFullscreen: op.fullScreenApi
									});
								}

								$('li', obj).removeClass('selected');

							} else {
								$.fn.axZm.loadAjaxSet(loadParam, function() {
									// Heilight selected thumb
									var cImg = $.axZm.zoomGA[$.axZm.zoomID].img;
									$('li', obj).removeClass('selected');
									$('li[data-img="'+cImg+'"]', obj).addClass('selected');
								});
							}
						}

						if (op.embedSwitchWithPage && currentLoadParam == loadParam && !noAfterSwitch) {
							$.fn.axZm.zoomSwitch(firstImage, op.embedZoomSwitchAnm);
						}

						currentLoadParam = loadParam;
					}

					// Start preloading thumbs after 
					$.each(preloadObj, function(k, v) {
						v();
					});

					if (!bindNumThumbs && op.thumbsPerPageResponsive && !op.thumbsPerPage) {
						bindNumThumbs = 1;
						$(window)
						.unbind('resize.'+op.thumbsContainer, observeThumbsPerPage)
						.unbind('orientationchange.'+op.thumbsContainer, observeThumbsPerPage)
						.bind('resize.'+op.thumbsContainer, observeThumbsPerPage)
						.bind('orientationchange.'+op.thumbsContainer, observeThumbsPerPage);
					}

					if (!bindResize && imgGridSize) {
						bindResize = 1;
						$(window)
						.unbind('resize.'+op.thumbsContainer, observeSize)
						.unbind('orientationchange.'+op.thumbsContainer, observeSize)
						.bind('resize.'+op.thumbsContainer, observeSize)
						.bind('orientationchange.'+op.thumbsContainer, observeSize);
					}

					if (parseFloat(op.thumbGridAspectRatio) == op.thumbGridAspectRatio && op.thumbGridAspectRatio !== 1 && !supportsCssVariables()) {
						$(window)
						.unbind('resize.'+op.thumbsContainer, observeAspectRatio)
						.unbind('orientationchange.'+op.thumbsContainer, observeAspectRatio)
						.bind('resize.'+op.thumbsContainer, observeAspectRatio)
						.bind('orientationchange.'+op.thumbsContainer, observeAspectRatio);

						observeAspectRatio();
					}
				}
			} else {
				// Error handling
				var errText = 'Failed to load thumbs';
				errText += '<br>Data passed to the displayImageThumbs function is not an array!';
				obj.html('<div style="color: red; padding: 5px;">'+errText+'</div>');
			}
		};

		// Get images from a folder and display thumbs on success
		var loadImageThumbs = function(prop, val) {
			hashChangeBlock = true;
			var urlLoad = op.axZmPath+'zoomLoad.php';
			var dataToPass = prop+'='+val+'&qq=images';

			$.ajax({
				url: urlLoad,
				data: dataToPass,
				cache: false,
				dataType: 'JSON',
				success: function (data) {
					// Save data
					currentData = data;

					displayImageThumbs(data);

					hashChangeBlock = false;
				},
				error: function(jqXHR, textStatus, errorThrown) {
					hashChangeBlock = false;

					// Error handling
					var errText = 'Failed to load thumbs';
					errText += '<br>Error thrown: '+jqXHR.status+' '+jqXHR.statusText;
					errText += '<br>Requested URL: '+urlLoad+'?'+dataToPass;
					obj.html('<div style="color: red; padding: 5px;">'+errText+'</div>');
				}
			});
		};

		// Folders
		var folderSelect = function(customDir) {
			var urlLoad = op.axZmPath+'zoomLoad.php';
			var setFromHash = false;
			var dataToPass = 'zoomDir='+(customDir || op.zoomDir)+'&qq='+(op.folderSelect == 'imgFolders' ? 'firstImagesFromFolders' : 'folders');

			if (op.folderSelect == 'imgFolders') {
				dataToPass += '&imgNumber='+op.imgFoldersSettings.thumbNumber;
			}

			$.fn.axZm.stopPlay();
			$.ajax({
				url: urlLoad,
				data: dataToPass,
				cache: false,
				dataType: 'JSON',
				success: function (data) {
					if ($.isArray(data)) {
						if (data[0] == 'error') {
							var errText = 'Failed to load subfolders';
							errText += '<br>'+data[1];
							obj.html('<div style="color: red; padding: 5px;">'+errText+'</div>');
						} else {
							$.fn.axZm.stopPlay();
							folderList = {};
							var firstFolderToLoad = null,
							firstFolderNo = 1,
							firstFolderName = null;

							$.each(data[1], function(k, v) {
								if (k == 1) {
									firstFolderToLoad = data[0]+v.folderName;
									firstFolderName = v.folderName;
								}
								folderList[v.folderName] = data[0]+v.folderName;

								if (op.firstFolder == v.folderName || op.firstFolder == k || parseInt(op.firstFolder) == k) {
									firstFolderToLoad = data[0]+v.folderName;
									firstFolderName = v.folderName;
								}
							});

							if (op.setHash) {
								var h = window.location.hash.replace('#', '');
								if (folderList[h]) {
									firstFolderToLoad = folderList[h];
									firstFolderName = h;
									setFromHash = firstFolderToLoad;
								}
							}

							if (op.folderSelect == 'select') {
								sel = $('<select />');
							} else if (op.folderSelect == 'folders') {
								sel = $('<ul />').addClass('azFolder');
							} else if (op.folderSelect == 'imgFolders') {
								sel = $('<ul />').addClass('azImgFolder');
							} else {
								return false;
							}

							$.each(data[1], function(k, v) {

								if (op.folderSelect == 'select') {
									var newOpt = $('<option />')
									.attr('value', data[0]+v.folderName)
									.text(op.folderNameFunc(v.folderName))
									.appendTo(sel);
								} else if (op.folderSelect == 'folders') {
									var newOpt = $('<li />')
									.data('path', data[0]+v.folderName)
									.data('folderName', v.folderName)
									.attr('data-folderName', v.folderName)
									.bind('click', function() {
										if (op.setHash) {
											hashChangeBlock = true;
											window.location.hash = $(this).data('path').split('/').reverse()[0];
										}

										$('.folder', sel)
										.attr('src', op.axZmPath+'icons/'+op.folderIconPrefix+'close.png')
										.removeClass('selected');

										$('.descr', sel).removeClass('selected');

										$('.folder',$(this))
										.attr('src', op.axZmPath+'icons/'+op.folderIconPrefix+'open.png')
										.addClass('selected');

										$('.descr', $(this)).addClass('selected');

										loadImageThumbs('zoomDir', $(this).data('path'));
									})
									.bind('mouseover touchstart', function() {
										if (!$('.folder', $(this)).hasClass('selected')) {
											$('.folder', $(this)).attr('src', op.axZmPath+'icons/'+op.folderIconPrefix+'close_over.png')
										}
									})
									.bind('mouseout touchend', function() {
										if (!$('.folder', $(this)).hasClass('selected')) {
											$('.folder', $(this)).attr('src', op.axZmPath+'icons/'+op.folderIconPrefix+'close.png')
										}
									});

									var folderIcon = $('<img>')
									.attr('data-folderName', v.folderName)
									.attr('src', op.axZmPath+'icons/'+op.folderIconPrefix + 'close.png')
									.addClass('folder')
									.appendTo(newOpt);

									$('<span />').text(' ').addClass('vAlign').appendTo(newOpt);
									$('<div />').html(op.folderNameFunc(v.folderName)).addClass('descr').appendTo(newOpt);
									newOpt.appendTo(sel);
								} else if (op.folderSelect == 'imgFolders') {
									var newOpt = $('<li />')
									.data('path', data[0]+v.folderName)
									.data('folderName', v.folderName)
									.attr('data-folderName', v.folderName)
									.bind('click', function(e) {

										if (op.setHash) {
											hashChangeBlock = true;
											window.location.hash = $(this).data('path').split('/').reverse()[0];
										}

										$('img.icon', sel).removeClass('selected')
										.trigger('mouseout')
										.trigger('touchend');

										$('img.icon', $(this)).addClass('selected');
										loadImageThumbs('zoomDir', $(this).data('path'));

										$('div.descr', sel).removeClass('selected');
										$('div.descr', $(this)).addClass('selected');
									})
									.bind('mouseover touchstart', function(e) {

										if (!$('.icon', $(this)).hasClass('selected')) {
											$('img.icon', $(this)).each(function(nn) {
												$(this).addClass('hover'+(nn+1));
											});
										}
									})
									.bind('mouseout touchend', function(e) {

										//if (!$('.icon', $(this)).hasClass('selected')) {
										$('img.icon', $(this)).each(function(nn) {
											$(this).removeClass('hover'+(nn+1));
										});
										//}
									});

									var so = op.imgFoldersSettings,
									folderIcon = $('<div />')
									.addClass('icon');

									for (var n = 0; n < op.imgFoldersSettings.thumbNumber; n++) {
										(function () {
											var iPath;

											if ($.isArray(v.images) && v.images[n]) {
												iPath = 
												op.axZmPath+'zoomLoad.php?'
												+'previewDir='+(data[0]+v.folderName)
												+'&previewPic='+v.images[n]
												+'&qual='+so.thumbQual
												+'&width='+((so.thumbRetina && window.devicePixelRatio > 1) ? so.thumbWidth*2 : so.thumbWidth)
												+'&height='+((so.thumbRetina && window.devicePixelRatio > 1) ? so.thumbHeight*2 : so.thumbHeight)
												+'&cache='+so.thumbsCache
												+'&thumbMode='+so.thumbMode
												+'&backColor='+so.thumbBackColor.replace('#', '%23')
												;
											}

											var iconImage = 
											$('<img>').attr('src', op.axZmPath+'/icons/empty.gif')
											.css('width', so.thumbWidth)
											.css('height', so.thumbHeight)
											.addClass('icon')
											.addClass('icon'+(n+1))
											.css('opacity', so.thumbOpacity)
											.appendTo(folderIcon);

											if (iPath) {
												// Preloading
												$('<img>').load(function() {
													iconImage
													.attr('src', iPath)
													.css({
														width: '', 
														height: '',
														maxWidth: so.thumbWidth,
														maxHeight: so.thumbHeight
													})
													.removeAttr('width') // IE
													.removeAttr('height') // IE
													;

												}).attr('src', iPath);
											}
										})();
									}

									folderIcon.appendTo(newOpt);

									$('<span />').text(' ').addClass('vAlign').appendTo(newOpt);
									$('<div />').html(op.folderNameFunc(v.folderName)).addClass('descr clearfix').appendTo(newOpt);
									newOpt.appendTo(sel);
								}

								// Current folder
								if (firstFolderName == v.folderName) {
									if (op.folderSelect == 'select') {
										newOpt.attr('selected', 'selected');
										if ($.fn.prop) {
											newOpt.prop('selected', true);
										} else {
											newOpt.attr('selected', 'selected');
										}

									} else if (op.folderSelect == 'folders') {
										folderIcon
										.attr('src', op.axZmPath+'icons/'+op.folderIconPrefix+'open.png')
										.addClass('selected');
										$('div.descr', newOpt).addClass('selected');

									} else if (op.folderSelect == 'imgFolders') {
										$('img.icon', folderIcon).addClass('selected');
										$('div.descr', newOpt).addClass('selected');
									}
								}
							});

							if (firstFolderToLoad) {
								loadImageThumbs('zoomDir', firstFolderToLoad);
							}

							if (op.folderSelect == 'select') {
								sel.bind('change', function() {
									if (op.setHash) {
										hashChangeBlock = true;
										window.location.hash = $(this).val().split('/').reverse()[0];
									}

									loadImageThumbs('zoomDir', $(this).val())
								});
							}

							$('#'+op.selectContainer).empty().append(sel);

							if (setFromHash) {
								if (op.folderSelect == 'select') {
									sel.val(setFromHash);
								}
							}
						}
					} else {
						// Error handling
						var errText = 'Failed to load subfolders';
						errText += '<br>Returned data is not an array, but '+(typeof data);
						$('#'+op.selectContainer).html('<div style="color: red; padding: 5px;">'+errText+'</div>');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					// Error handling
					var errText = 'Failed to load subfolders';
					errText += '<br>Error thrown: '+jqXHR.status+' '+jqXHR.statusText;
					errText += '<br>Requested URL: '+urlLoad+'?'+dataToPass;
					$('#'+op.selectContainer).html('<div style="color: red; padding: 5px;">'+errText+'</div>');
				}
			});

		};

		// Helper function
		var removeAZ = function() {
			$.fn.axZm.spinStop();
			if ($.fn.axZm.killInternalGalleries) {
				$.fn.axZm.killInternalGalleries();
			}

			$.fn.axZm.remove();
			$('#axZmTempBody').axZmRemove(true);
			$('#axZmTempLoading').axZmRemove(true);
			$('#axZmWrap').axZmRemove(true);
		};

		// Make some checks and init
		var init = function() {
			currentLoadParam = null;
			obj = $('#'+op.thumbsContainer);
			obj.data('aZiO', $.extend(true, {}, op));

			// Get /axZm/ directory
			if (!op.axZmPath || op.axZmPath == 'auto') {
				if ($.isFunction($.fn.axZm)) {
					op.axZmPath = $.fn.axZm.installPath();
				} else {
					alert('/axZm/jquery.axZm.js is not loaded');
					return;
				}
			}

			// Add slash to the /axZm path
			if (op.axZmPath.slice(-1) != '/') {
				op.axZmPath += '/';
			}

			// Test if thumbnail container exists
			if (!obj.length) {
				alert('Element with ID '+op.thumbsContainer+' (thumbsContainer) was not found');
				return;
			} else {
				obj.addClass('azThumbGalleryContainer');
			}

			// Test if container for the folders is present
			if (op.folderSelect && !$('#'+op.selectContainer).length) {
				alert('Element with ID '+op.selectContainer+' (selectContainer) was not found');
				return;
			}

			if (op.ajaxZoomOpenMode == 'zoomSwitch') {
				op.embedMode = true;
			}

			if (op.embedMode && op.embedModeMinSize && window.innerWidth < op.embedModeMinSize) {
				op.embedMode = false;
				if (op.ajaxZoomOpenMode == 'zoomSwitch') {
					op.ajaxZoomOpenMode = 'fullscreen';
				}

				$('#'+op.embedDivID).css('display', 'none');
			}

			if (op.embedMode) {
				op.ajaxZoomOpenMode = 'zoomSwitch';
				if (!op.embedDivID) {
					alert('Option embedDivID is not defined');
					return;
				}

				if (!$('#'+op.embedDivID).length) {
					alert('Element with ID '+op.embedDivID+' (embedDivID) was not found');
					return;
				}
			}

			// Remove AJAX-ZOOM if present
			if ($.axZm) {
				removeAZ();
			}

			// Optionally handle hash tags
			if (op.setHash) {
				$(window)
				.unbind('hashchange.azThumbGallery')
				.bind('hashchange.azThumbGallery', function(e) {
					observeHash();
				});
			}

			// Check if zoomDir is in query string
			var zD = getParameterByName('zoomDir');
			if (zD) {
				op.firstFolder = zD;
			}

			obj.data('aZ', op);

			if (!(op.thumbModel == 'grid' || op.thumbModel == 'fixed')) {
				op.thumbModel = 'grid';
			}

			obj.data('reloadThumbs', function(keepPageNo, noAfterSwitch, res) {
				var pn = false;
				if (keepPageNo) {
					if (keepPageNo === true) {
						pn = true;
					} else if (parseInt(keepPageNo) == keepPageNo) {
						keepPageNo = parseInt(keepPageNo);
					}
				}

				displayImageThumbs(currentData, keepPageNo, noAfterSwitch, res);
			});

			obj.data('reloadFolders', function() {
				if (sel.length) {
					sel.remove();
					folderSelect();
				}
			});

			obj.data('removeAZ', removeAZ);

			if (!op.folderSelect && op.zoomDir && op.firstFolder) {
				op.zoomDir = (op.zoomDir+'/'+op.firstFolder).replace('//', '/');
			}

			// What next?
			if (op.folderSelect && op.zoomDir) {
				op.zoomData = null;
				folderSelect();
			} else if (op.zoomDir) {
				// No folder selction
				op.zoomData = null;
				loadImageThumbs('zoomDir', op.zoomDir);
			} else if (op.zoomData) {
				op.zoomData = zoomDataCheck(op.zoomData);
				if (typeof op.zoomData == 'string') {
					loadImageThumbs('zoomData', op.zoomData);
				} else {
					// Error handling
				}
			}
		};

		// If $.azThumbGallery was inited before needed DOM is ready - wait
		if (!$('#'+op.thumbsContainer).length) {
			$(document).ready(init);
		} else {
			init();
		}

	};

	$.azThumbGallery.getParam = function(obj) {
		var ref = $('#'+obj);
		if (ref.length > 0) {
			return ref.data('aZ');
		}
		return {};
	};

})(jQuery);
