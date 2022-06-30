/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.embedResponsive.js
* Copyright: Copyright (c) 2010-2018 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 1.1
* Extension Date: 2018-01-16
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

;(function($){
	$.fn.axZmEmbedResponsive = function(opt) {

		var makeid = function() {
			var t = '';
			var p = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			var l = p.length;
			for (var i = 0; i < 32; i++) {
				t += p.charAt(Math.floor(Math.random() * l));
			}
			return t;
		};

		var convert = function(a) {
			if (typeof a !== 'string') {
				return a;
			}

			if (a == 'false') {
				return false;
			} else if (a == 'true') {
				return true;
			} else if (parseFloat(a) == a) {
				return parseFloat(a);
			} else if (a.indexOf('[') != -1 || a.indexOf('{') != -1) {
				a = a.replace(/&quot;/g, "\"");
				a = a.replace(/&#34;/g, "\"");
				return JSON.parse(a);
			} else {
				return a;
			}
		};

		var def = {
			ratio: false, // e.g. 16:9
			prc: 100, // defines padding bottom, 100 results in 1:1 proportion
			heightLimit: 90, // limit from window browser height in %
			deduct: 0, // substract pixel value from heightLimit
			minHeight: 150, // minimal height
			maxWidthArr: [/*{
				maxWidth: 768,
				orientaion: 'landscape', // portrait or landscape or false
				ratio: false,
				deduct: 0,
				minHeight: 150,
				prc: 50,
				heightLimit: 40
			}*/]
		};

		return this.each(function() {
			var _this = $(this);
			var prc;
			var heightLimit;
			var deduct;
			var minHeight;
			var ratio;
			var o = {};

			var thisId = _this.attr('data-azErMh');
			if (!thisId) {
				thisId = makeid() + (new Date()).getTime();
				_this.attr('data-azErMh', thisId);
			}

			var destroy = function() {
				$(window).unbind('resize.'+thisId+' orientationchange.'+thisId);
			};

			if (!$.isPlainObject(opt)) {
				if (opt == 'destroy') {
					destroy();
					return;
				} else {
					o = $.extend(true, {}, def);
				}
			} else {
				o = $.extend(true, {}, def, opt);
			}

			$.each(o, function(a, b) {
				var dta = _this.data(a.toLowerCase());
				if (dta !== undefined) {
					o[a] = convert(dta);
				}
			} );

			var calcPar = function() {
				var ref = o;
				if (o.maxWidthArr && o.maxWidthArr.length) {
					$.each(o.maxWidthArr, function(k, obj) {
						if (window.innerWidth <= parseInt(obj.maxWidth)) {
							var ort = obj.orintation;
							if (ort) {
								if (ort == 'landscape' && window.innerWidth > window.innerHeight) {
									ref = obj;
									return false;
								} else if (ort == 'portrait' && window.innerWidth < window.innerHeight) {
									ref = obj;
									return false;
								}
							} else {
								ref = obj;
								return false;
							}
						}
					});
				}

				ratio = ref.ratio;
				if (typeof ratio == 'string') {
					var spl = ratio.split(':');
					if (spl[0] && spl[1]) {
						prc = parseFloat(spl[1]) / parseFloat(spl[0]) * 100;
					}
				}

				if (!prc) {
					prc = parseFloat(ref.prc);
				}

				heightLimit = parseFloat(ref.heightLimit);
				if (heightLimit <= 1) {
					heightLimit *= 100;
				}

				if (prc <= 2) {
					prc *= 100;
				}

				deduct = ref.deduct;
				if (deduct !== undefined) {
					deduct = parseInt(deduct);
				} else {
					deduct = 0;
				}

				if (isNaN(deduct) || parseInt(deduct) != deduct) {
					deduct = 0;
				}

				minHeight = ref.minHeight;
				if (minHeight !== undefined) {
					minHeight = parseInt(minHeight);
				} else {
					minHeight = 0;
				}

				if (isNaN(minHeight) || parseInt(minHeight) != minHeight) {
					minHeight = def.minHeight;
				}
			};

			calcPar();

			var adjustHeight = function(e) {
				if (!_this.length) {
					destroy();
					return;
				}

				if (!e && $('#zFsO', _this).length) {
					$.fn.axZm.resizeStart(0);
				} else {
					if (o.maxWidthArr && o.maxWidthArr.length) {
						calcPar();
					}
				}

				_this.css('paddingBottom', prc+'%');

				var winH = $(window).height();
				var ww = _this.width();
				var hh = _this.children().first().height();
				var hr = (hh + deduct) / winH;
				if (hr * 100 > heightLimit) {
					var px = winH * (heightLimit / 100) - deduct;
					px = Math.max(px, minHeight);
					_this.css('paddingBottom', px + 'px');
				}
			};

			adjustHeight();

			destroy();
			$(window).bind('resize.'+thisId+' orientationchange.'+thisId, adjustHeight);
		});
	};
})(jQuery);
