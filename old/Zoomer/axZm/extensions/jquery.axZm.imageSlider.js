/*!
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.imageSlider.js
* Copyright: Copyright (c) 2010-2018 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.0
* Extension Date: 2018-10-01
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

(function($) {

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

    $.fn.ajaxZoomSlider = function(options) {

        // AJAX-ZOOM js file should be loaded
        if (!$.isFunction(jQuery.fn.axZm)) {
            alert('/axZm/jquery.axZm.js is not loaded.');
            return;
        }

        // Defaults
        var defaults = {
            parameter: '', // string - see AJAX-ZOOM docu how to define images
            axZmPath: 'auto', // string - path to the /axZm directory e.g. '/zoom/axZm/'
            divID: '', // string - ID of the container, where AJAX-ZOOM will be loaded into

            bullets: true, // bool
            bulletsNumbers: true, // bool
            bulletsPos: 'inside', // string: 'inside', 'outside'
            bulletsOutsideCont: '#azBulletOutside',
            bulletsGravity: 'topRight', // string: 'topLeft', 'top', 'topRight', 'bottomLeft', 'bottom', 'bottomRight'
            bulletsAutoHide: false, // bool

            toolTip: true, // bool
            toolTipGravity: 'auto', // string: 'auto', 'nw', 'n', 'ne', 'w', 'e', 'sw', 's', 'se'
            toolTipKeepInside: true, // true or false
            toolTipOffset: 10, // int
            toolTipDelayIn: 0, // int
            toolTipDelayOut: 0, // int
            toolTipFade: false, // bool
            toolTipOpacity: 1, // float <= 1

            playPauseButtonPos: 'topLeft', // false or 'topRight', 'bottomLeft', 'topLeft', 'bottomRight'
            playPauseAutoHide: false, // bool
            playPauseButtonVertMargin: 5, // int
            playPauseButtonHorzMargin: 5, // int
            playPauseInterval: 4000, // int, time in ms

            autoPlay: true, // bool
            autoPlayStopOnHover: true, // bool, stop autoplay if the user hovers the slider
            autoPlayResume: 7500, // false or time in ms, resume autoplay if it has beenstoped after x ms
            autoPlayResumePreventHover: true, // bool, prevent resume if mouse is over the image            

            inlineGalButtonPos: 'topLeft', // false or 'topRight', 'bottomLeft', 'topLeft', 'bottomRight'
            inlineGalAutoHide: false, // bool
            inlineGalShowOnLoad: false, // bool
            inlineGalButtonVertMargin: 5, // int
            inlineGalButtonHorzMargin: 34, // int

            zoomLevelPos: 'bottomRight', // false or 'topRight', 'bottomLeft', 'topLeft', 'bottomRight'
            zoomLevelAutoHide: false, // bool
            zoomLevelVertMargin: 5, // int
            zoomLevelHorzMargin: 7, // int    

            animationType: 'SwipeHorz', // string: 'Center', 'Bottom', 'Top', 'Vert', 'Right', 'Left', 'Horz', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert'
            animationTypeArrows: 'SwipeHorz', // string: 'Center', 'Bottom', 'Top', 'Vert', 'Right', 'Left', 'Horz', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert'
            animationTypeBullets: 'SwipeHorz', // string: 'Center', 'Bottom', 'Top', 'Vert', 'Right', 'Left', 'Horz', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert'

            // Possible easing types: 
            // 'swing', 'linear', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 
            // 'easeOutQuart','easeInOutQuart', 'easeInQuint','easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine', 
            // 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic',
            // 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce'
            descriptionSlideInEasing: 'swing', // string
            descriptionSlideOutEasing: 'swing', // string
            descriptionFadeInOpacity: 0, // float
            descriptionFadeOutOpacity: 0, // float
            descriptionMaxWidth: 300, // int
            descriptionPadding: 10, // int

            zoomSliderPos: 'bottom', // false or string: 'topRight', 'topLeft', 'bottomRight', 'bottomLeft', 'bottom', 'top'
            zoomSliderHandleSize: 16, // int
            zoomSliderThickness: 8, // int
            zoomSliderWidth: 100, // int
            zoomSliderMarginV: 10, // int
            zoomSliderMarginH: 10, // int
            zoomSliderHorz: true, // bool
            zoomSliderAutoHide: true, // bool
            zoomSliderContainerPadding: 10, // int
            zoomSliderOpacity: 1, // float

            prevNextArrows: true, // bool
            prevNextArrowsMargin: 0, // int
            prevNextArrowsAutoHide: true, // bool
            prevNextArrowsOnlyFullScreen: false,

            fullScreen: 'topRight', // false or topLeft, topRight, bottomLeft, bottomRight
            openAsFullscreen: false, // open immediately as fullscreen (close fullscreen is not possible)
            responsive: true,
            fullScreenApi: false, // use fullscreen API when fullscreen button is clicked.

            preloadAllInitialPic: false, // true or false

            imageMapPos: 'bottomRight', // false or string: 'topRight', 'topLeft', 'bottomRight', 'bottomLeft'
            imageMapOpacity: 0.7, // float
            imageMapFract: 0.2, // float
            imageMapFullScreenFract: 0.16, // float
            imageMapWidth: false, // false ot int
            imageMapHeight: false, // false ot int
            imageMapFullScreenWidth: false,  // false ot int
            imageMapFullScreenHeight: false, // false ot int
            imageMapHorzMargin: 5, // int 
            imageMapVertMargin: 5, // int 
            imageMapDraggable: false, // bool
            imageMapSelOpacity: 0.25, // float
            imageMapSelSmoothDrag: false, // bool
            imageMapWithoutZoom: false, // bool
            imageMapBorderTop: 1, // int 
            imageMapBorderRight: 1, // int 
            imageMapBorderBottom: 1, // int 
            imageMapBorderLeft: 1, // int 

            callBackOnLoad: function() {}, // function
            callBackOnImageChange: function() {}, // function

            descriptionOpacity: 1, // float <=1
            descriptionGravity: 'bottomLeft', //  css object or 'topRight', 'topLeft', 'bottomRight', 'bottomLeft', 'bottom', 'top', 'left', 'right', 'center'
            descriptionHorzMargin: 0, // int
            descriptionVertMargin: 0, // int
            descriptionHideOnZoom: false, // bool
            descriptionOutside: false, // false or 'bottom', 'top'
            descriptionSlideInFrom: 'left', // false or 'left', 'right', 'bottom', 'top'
            descriptionSlideOutTo: 'left', // false or 'left', 'right', 'bottom', 'top'
            descriptionSlideDelayIn: 0, // int
            descriptionAnimationInTime: 300, // int
            descriptionAnimationOutTime: 300, // int
            descriptionObject: {} // object
        };

        // Get defaults method
        $.fn.ajaxZoomSlider.getDefaults = function() {
            return defaults;
        };

        // Get current loaded options method
        $.fn.ajaxZoomSlider.getOptions = function() {
            return op;
        };

        // Override defaults by user setting
        var op = $.extend(true, {}, defaults, options);

        // Try to get /axZm path instantly
        if (op.axZmPath == 'auto') {
            op.axZmPath = $.fn.axZm.installPath();
        }

        // Check options (hardset options if they do not match)
        if (op.openAsFullscreen) {
            op.bulletsPos = 'inside';
            op.descriptionOutside = false;
        }

        // Create empty jQuery object
        var ajaxZoom = {};

        // Path to the axZm folder
        ajaxZoom.path = op.axZmPath; 

        // "parameter" option is needed to define images to load
        if (!op.parameter) {
            alert('The "parameter" option is not defined! Please check the documentation.');
            return;
        }

        // "parameter" string which is passed to AJAX-ZOOM... 
        // Append &example=imageSlider to override default AJAX-ZOOM options (zoomConfig.inc.php) 
        // in zoomConfigCustom.inc.php (custom options)
        // after elseif ($_GET['example'] == 'imageSlider') {
        ajaxZoom.parameter = op.parameter+'&example=imageSlider';

        ajaxZoom.parameter += '&zoomSliderPos='+op.zoomSliderPos
        +'&fullScreen='+op.fullScreen
        +'&autoPlay='+op.autoPlay
        +'&playPauseInterval='+op.playPauseInterval
        +'&openAsFullscreen='+op.openAsFullscreen
        ;

        // The ID of the element where ajax-zoom has to be inserted into
        ajaxZoom.divID = op.divID; 

        // Touch device?
        var testTouch = ('ontouchstart' in window) ? true : false;

        // State of description box
        var desciptionHidden = false;

        // Timer
        var timer = null;

        // Too much php background :-)
        function stripTags(str) {
            if (str) {
                return str.replace(/<\/?(?!\!)[^>]*>/gi, '');
            } 

            return '';
        }

        // Test var is an object
        function isObject(x) {
            return (typeof x === 'object') && !(x instanceof Array) && (x !== null);
        }

        function isInt(x) {
            var y = parseInt(x);
            if (isNaN(y)) {
                return false
            };

            return x == y && x.toString() == y.toString();
        } 

        function isDefined(x) {
            return (x === undefined ? false : true)
        }

        function setValue(a, b) {
            if (isDefined(a)) {
                return a;
            } else {
                return b;
            }
        }

        function setPauseButton() {
            $('#axZmPlayerPlayPause')
            .removeClass('axZmPlayerPlayPausePlay')
            .addClass('axZmPlayerPlayPausePause');
        }

        function setTimer() {
            timer = new Date().getTime();

            $('#axZm_zoomLayer')
            .unbind('mouseleave', setTimer);
        }

        function setAutoPlayInterval() {
            // Resume outoplay if certain coditions met
            if (op.autoPlay && op.autoPlayResume) {
                $.axZm.autoPlayResume = setInterval(function() {
                    if (!isDefined($.axZm) || !$.axZm || $.axZm == null) {
                        return;
                    }

                    if (!op.autoPlay) {
                        $.fn.axZm.stopPlay();
                        clearInterval($.axZm.autoPlayResume);
                    }

                    if ($.axZm.autoPlayStatus === true) {
                        timer = null;
                    }

                    if (!isDefined($.axZm.autoPlayStatus)
                        || timer === null
                        || $.axZm.autoPlayStatus === true
                        || $.axZm.zoomWIDTH
                        || $.axZm.zoomGalVisible
                    ) {
                        return; 
                    }

                    if (op.autoPlayResumePreventHover && $.fn.axZm.isMouseOver()) {
                        $('#axZm_zoomLayer')
                        .unbind('mouseleave', setTimer)
                        .bind('mouseleave', setTimer);

                        timer = null;
                        return;
                    }

                    var now = new Date().getTime();
                    if ((now - timer) > op.autoPlayResume) {
                        timer = null;
                        $.fn.axZm.startPlay();
                        console.log('autoPlayResume startPlay');
                    }
                }, 1000);

            }
        }

        // AJAX-ZOOM callbacks which actually make the slider plugin
        // There are many other callbacks to customize AJAX-ZOOM
        ajaxZoom.opt = {
            // Before everything starts rendering
            onBeforeStart: function() {

                // Set AJAX-ZOOM options via JavaSscript
                // Most, but not all options can be set this way
                if (op.zoomSliderPos) {
                    $.axZm.zoomSliderHorizontal = op.zoomSliderHorz;
                    $.axZm.zoomSliderPosition = op.zoomSliderPos;
                    $.axZm.zoomSliderWidth = op.zoomSliderThickness;
                    $.axZm.zoomSliderHeight = op.zoomSliderWidth;
                    $.axZm.zoomSliderMarginV = op.zoomSliderMarginV;
                    $.axZm.zoomSliderMarginH = op.zoomSliderMarginH;
                    $.axZm.zoomSliderHandleSize = op.zoomSliderHandleSize;
                    $.axZm.zoomSliderMouseOver = op.zoomSliderAutoHide;
                    $.axZm.zoomSliderContainerPadding = op.zoomSliderContainerPadding;
                    $.axZm.zoomSliderOpacity = op.zoomSliderOpacity;
                }

                $.axZm.gallerySlideNavi = op.prevNextArrows;
                $.axZm.gallerySlideNaviMouseOver = op.prevNextArrowsAutoHide;
                $.axZm.gallerySlideNaviMargin = op.prevNextArrowsMargin;
                $.axZm.gallerySlideNaviOnlyFullScreen = op.prevNextArrowsOnlyFullScreen;

                if (op.imageMapPos) {
                    $.axZm.useMap = true;
                    $.axZm.mapPos = op.imageMapPos;
                    $.axZm.mapFract = op.imageMapFract;
                    $.axZm.mapOpacity = op.imageMapOpacity;
                    $.axZm.fullScreenMapFract = op.imageMapFullScreenFract;
                    $.axZm.mapWidth = op.imageMapWidth;
                    $.axZm.mapHeight = op.imageMapHeight;
                    $.axZm.fullScreenMapWidth = op.imageMapFullScreenWidth; 
                    $.axZm.fullScreenMapHeight  = op.imageMapFullScreenHeight;
                    $.axZm.dragMap = op.imageMapDraggable;
                    $.axZm.zoomMapSelOpacity = op.imageMapSelOpacity;
                    $.axZm.mapSelSmoothDrag = op.imageMapSelSmoothDrag;
                    $.axZm.mapBorder = {top: op.imageMapBorderTop, right: op.imageMapBorderRight, bottom: op.imageMapBorderBottom, left: op.imageMapBorderLeft};
                    $.axZm.zoomMapVis = op.imageMapWithoutZoom;
                    $.axZm.mapHorzMargin = op.imageMapHorzMargin;
                    $.axZm.mapVertMargin = op.imageMapVertMargin;
                } else {
                    $.axZm.useMap = false;
                }
            },
            // On Start
            onStart: function() {

                // Show grid gallery at the beginning
                if (op.inlineGalShowOnLoad) {
                    $.fn.axZm.fullGalShow();
                    $.axZm.galleryAutoPlay = false;
                }

                if (!op.autoPlay) {
                    $.fn.axZm.stopPlay();
                    if ($.axZm.autoPlayResume) {
                        clearInterval($.axZm.autoPlayResume);
                    }
                }

                // Autoplay and hover
                if (isDefined($.axZm) && $.axZm.autoPlayResume) {
                    clearInterval($.axZm.autoPlayResume);
                }

                // Resume outoplay if certain coditions met
                setAutoPlayInterval();

                // Autoplay stop when mouse is hover
                if (op.autoPlay && op.autoPlayStopOnHover) {
                    $('#axZm_zoomLayer').bind('mouseenter', function() {
                        $.fn.axZm.stopPlay();
                    });

                    if ($.fn.axZm.isMouseOver()) {
                        setTimeout(function() {
                            $.fn.axZm.stopPlay();
                        }, 100);
                    }
                }

                // jQuery.fn.axZm.setDescr
                $.each($.axZm.zoomGA, function(imgNum, val) {
                    var thisTitle, thisDescr, thisObj;
                    if (isObject(op.descriptionObject[imgNum])) {
                        thisObj = op.descriptionObject[imgNum]; // by image number
                    } else if (isObject(op.descriptionObject[val.img])) {
                        thisObj = op.descriptionObject[val.img]; // by image filename
                    }

                    if (isObject(thisObj)) {
                        thisTitle = stripTags(thisObj.title);
                        thisDescr = stripTags(thisObj.descr);
                        if (thisTitle) {
                            $.fn.axZm.setDescr(imgNum, 'unset', thisTitle);
                        } else if (thisDescr) {
                            $.fn.axZm.setDescr(imgNum, 'unset', thisDescr);
                        } else {
                            $.fn.axZm.setDescr(imgNum, 'unset', 'unset');
                        }
                    } else {
                        $.fn.axZm.setDescr(imgNum, 'unset', 'unset');
                    }
                });

                // Override AJAX-ZOOM var
                $.axZm.galleryFadeInAnm = op.animationType;

                // This is setting for touch devices depending on animation type choosen
                if (op.animationType == 'Vert' || op.animationType == 'Top' || op.animationType == 'Bottom' || op.animationType == 'SwipeVert') {
                    $.axZm.gallerySwipe = 'Vert';
                }

                // This AJAX-ZOOM setting can be also set via JavaScript
                // No need to pass it over ajaxZoom.parameter, but possible of course
                $.axZm.gallerySlideNaviAnm = op.animationTypeArrows;

                // Bullet navigation
                if (op.bullets) {
                    // op.bulletsGravity
                    // op.bulletsPos - insude / outside
                    var gravTop = (op.bulletsGravity == 'topLeft' || op.bulletsGravity == 'top' || op.bulletsGravity == 'topRight') ? true : false;

                    // Generate container for bullet navigation
                    var axZmPlayerSubNavi = $('<div />')
                    .attr('id', 'axZmPlayerSubNavi')
                    .addClass('axZmPlayerSubNavi')
                    .css({
                        width: '100%',
                        zIndex: 5,
                        position: 'relative',
                        'pointerEvents': 'none'
                    });

                    if (op.bulletsPos == 'outside') {
                        axZmPlayerSubNavi.addClass('axZmPlayerSubNaviOutside');
                    }

                    if (op.bulletsGravity == 'top' || op.bulletsGravity == 'bottom') {
                        axZmPlayerSubNavi.css('text-align', 'center');
                    }

                    // Position the container for bullet navigation
                    if (op.bulletsPos == 'outside') {
                        try {
                            axZmPlayerSubNavi.appendTo($(op.bulletsOutsideCont));
                        } catch (err){
                            console.log(op.bulletsOutsideCont + ' is a wrong selector');
                        }
                    } else {
                        axZmPlayerSubNavi.appendTo('#axZm_zoomLayer');
                    }

                    var bulletCss = {
                        'pointerEvents': 'auto',
                        'float': 'left'
                    };

                    var bulletAppendFunc = 'appendTo';

                    if (op.bulletsGravity == 'top' || op.bulletsGravity == 'bottom') {
                        bulletCss['float'] = '';
                        bulletCss['display'] = 'inline-block';
                    } else if (op.bulletsGravity.indexOf('Right')) {
                        bulletCss['float'] = 'right';
                        bulletAppendFunc = 'prependTo';
                    }

                    // Generate bullets
                    $.each($.axZm.zoomGA, function(imgNum, val) {
                        var bullet = $('<div />')
                        .attr('id', 'axZmPlayerSubNaviControl_'+imgNum)
                        .attr('onselectstart', 'return false')
                        .addClass('axZmPlayerSubControl')
                        .css(bulletCss)
                        .bind('click', function() {
                            // $.fn.axZm.zoomSwitch is API function of AJAX-ZOOM
                            $.fn.axZm.zoomSwitch(imgNum, op.animationTypeBullets);
                            // Stop play (in case it is on) with $.fn.axZm.stopPlay AJAX-ZOOM API function
                            $.fn.axZm.stopPlay();
                            //$(this).trigger('mouseout');
                        })
                        .bind('mouseover', function() {
                            $(this).addClass('axZmPlayerSubControlOver');
                        })
                        .bind('mouseout', function() {
                            $(this).removeClass('axZmPlayerSubControlOver');
                        })[bulletAppendFunc](axZmPlayerSubNavi);

                        // Optionally add numbers in bullets
                        if (op.bulletsNumbers) {
                            bullet.html(imgNum);
                        }

                        // Optionally add tooltip with image previews
                        // The size can be changed in in zoomConfigCustom.inc.php after elseif ($_GET['example'] == 30) {
                        // e.g. $zoom['config']['galleryFullPicDim'] = '200x100';
                        if (!testTouch && op.toolTip) {

                            // AJAX-ZOOM API $.fn.axZm.getImagePath returns physical path of a particular image of the gallery
                            var imgSrcTpsy = $.fn.axZm.getImagePath(imgNum, 'full');

                            $.fn.axZm.preloadImg(imgSrcTpsy, false, function() {
                                bullet
                                .attr('data-position', op.bulletsPos)
                                .attr('title', '<img src='+imgSrcTpsy+' border=0 class=axZmPlayerSubControlPicPopup>')
                                .aZtipsy({
                                    gravity: op.toolTipGravity == 'auto' ? (gravTop ? 'n' : 's') : op.toolTipGravity, // nw | n | ne | w | e | sw | s | se
                                    delayIn: op.toolTipDelayIn, 
                                    delayOut: op.toolTipDelayOut,
                                    opacity: op.toolTipOpacity,
                                    offset: op.toolTipOffset,
                                    fade: op.toolTipFade ? true : false,
                                    html: true,
                                    openCallback: function(obj) {
                                        // openCallback has been added to tipsy plugin (MIT) by AJAX-ZOOM
                                        if (op.toolTipKeepInside) {
                                            var azPos = $('#axZm_zoomLayer').offset();
                                            var popUpPos = obj.offset();

                                            var axZmRight = azPos.left + $('#axZm_zoomLayer').width();
                                            var objRight = popUpPos.left + obj.outerWidth();
                                            var objWidth = obj.outerWidth();

                                            var overflowLeft = popUpPos.left < azPos.left ? true : false;
                                            var overflowRight = objRight > axZmRight ? true : false;

                                            if (overflowLeft || overflowRight) {
                                                var bullet = $('#axZmPlayerSubNaviControl_'+imgNum);

                                                if (overflowLeft) {
                                                    obj.css('left', azPos.left);
                                                } else {
                                                    obj.css('left', axZmRight - objWidth);
                                                }

                                                // Adjust arrow position
                                                var bulletPos = bullet.offset();
                                                $('.aZtipsy-arrow').css('left', bulletPos.left - parseInt(obj.css('left')) + bullet.outerWidth()/2);
                                            }
                                        }
                                    }
                                });
                            });
                        }
                    });

                    // Highlight first selected bullet
                    $('#axZmPlayerSubNaviControl_'+jQuery.axZm.zoomID).addClass('axZmPlayerSubControlSelected');

                    // Autohide bullets
                    if (!testTouch && op.bullets && op.bulletsAutoHide && op.bulletsPos == 'inside') {
                        axZmPlayerSubNavi.css('opacity', 0);
                        var showSubNavi = function() {
                            axZmPlayerSubNavi.stop().animate({opacity: 1},{queue: false, duration: 300});
                        };

                        var hideSubnavi = function() {
                            axZmPlayerSubNavi.stop().animate({opacity: 0},{queue: false, duration: 300});
                        };

                        $('#axZm_zoomLayer').bind('mouseenter', showSubNavi)
                        .bind('mouseleave', hideSubnavi)
                        .one('mousemove', showSubNavi);
                    }

                }

                // Preload all initial pictures
                if (op.preloadAllInitialPic) {
                    $.fn.axZm.preloadAllInitialPic();
                } else {
                    $.fn.axZm.preloadPrevNextImg();
                }

                // Play/Pause button
                if (op.playPauseButtonPos) {
                    var playPause = $('<div />')
                    .attr('id', 'axZmPlayerPlayPause')
                    .addClass('axZmPlayerPlayPause')
                    .addClass(op.autoPlay ? 'axZmPlayerPlayPausePause' : 'axZmPlayerPlayPausePlay');

                    // axZmPlayerPlayPauseContainer
                    var playPauseContainer = $('<div />')
                    .attr('id', 'axZmPlayerPlayPauseContainer')
                    .addClass('axZmPlayerPlayPauseContainer')
                    .append(playPause);

                    var playPauseCss = {};
                    if (op.playPauseButtonPos == 'topRight') {
                        playPauseCss.top = op.playPauseButtonVertMargin;
                        playPauseCss.right = op.playPauseButtonHorzMargin;
                    } else if (op.playPauseButtonPos == 'bottomRight') {
                        playPauseCss.bottom = op.playPauseButtonVertMargin;
                        playPauseCss.right = op.playPauseButtonHorzMargin;
                    } else if (op.playPauseButtonPos == 'bottomLeft') {
                        playPauseCss.bottom = op.playPauseButtonVertMargin;
                        playPauseCss.left = op.playPauseButtonHorzMargin;
                    } else if (op.playPauseButtonPos == 'topLeft') {
                        playPauseCss.top = op.playPauseButtonVertMargin;
                        playPauseCss.left = op.playPauseButtonHorzMargin;
                    }

                    playPauseContainer.css({
                        position: 'absolute',
                        zIndex: 10,
                        cursor: 'pointer'
                    })
                    .css(playPauseCss)
                    .appendTo('#axZm_zoomLayer');

                    if (!testTouch && op.playPauseAutoHide) {
                        playPauseContainer.css('opacity', 0);
                        var showPlayPause = function() {
                            playPauseContainer.stop().animate({opacity: 1},{queue: false, duration: 300});
                        };

                        var hidePlayPause = function() {
                            playPauseContainer.stop().animate({opacity: 0},{queue: false, duration: 300});
                        };

                        $('#axZm_zoomLayer')
                        .bind('mouseenter', showPlayPause)
                        .bind('mouseleave', hidePlayPause)
                        .one('mousemove', showPlayPause);
                    }
 
                    playPause.bind('click', togglePlayPause);
                    /*
                    if (!testTouch) {
                        playPause.bind('mouseover', function() {
                            playPause.addClass('axZmPlayerPlayPauseHover')
                        }).bind('mouseout', function() {
                            playPause.removeClass('axZmPlayerPlayPauseHover')
                        });
                    }
                    */
                }
                
                                
                // Inline gallery
                if (op.inlineGalButtonPos) {
                    var galButton = $('<div />')
                    .attr('id', 'axZmPlayerInlineGal')
                    .addClass('axZmPlayerInlineGal');

                    var galButtonContainer = $('<div />')
                    .attr('id', 'axZmPlayerInlineGalContainer')
                    .addClass('axZmPlayerInlineGalContainer')
                    .append(galButton);

                    var galButtonCss = {};
                    if (op.inlineGalButtonPos == 'topRight') {
                        galButtonCss.top = op.inlineGalButtonVertMargin;
                        galButtonCss.right = op.inlineGalButtonHorzMargin;
                    } else if (op.inlineGalButtonPos == 'bottomRight') {
                        galButtonCss.bottom = op.inlineGalButtonVertMargin;
                        galButtonCss.right = op.inlineGalButtonHorzMargin;
                    } else if (op.inlineGalButtonPos == 'bottomLeft') {
                        galButtonCss.bottom = op.inlineGalButtonVertMargin;
                        galButtonCss.left = op.inlineGalButtonHorzMargin;
                    } else if (op.inlineGalButtonPos == 'topLeft') {
                        galButtonCss.top = op.inlineGalButtonVertMargin;
                        galButtonCss.left = op.inlineGalButtonHorzMargin;
                    }

                    galButtonContainer.css({
                        position: 'absolute',
                        zIndex: 10,
                        cursor: 'pointer'
                    })
                    .css(galButtonCss)
                    .appendTo('#axZm_zoomLayer');

                    if (!testTouch && op.inlineGalAutoHide) {
                        galButtonContainer.css('opacity', 0);
                        var showGalButton = function() {
                            galButtonContainer.stop().animate({opacity: 1},{queue: false, duration: 300});
                        };

                        var hideGalButton = function() {
                            galButtonContainer.stop().animate({opacity: 0},{queue: false, duration: 300});
                        };

                        $('#axZm_zoomLayer').bind('mouseenter', showGalButton)
                        .bind('mouseleave', hideGalButton)
                        .one('mousemove', showGalButton);
                    }

                    galButton.bind('click', $.fn.axZm.fullGalToggle);

                    if (!testTouch) {
                        galButton.bind('mouseover', function() {
                            galButton.addClass('axZmPlayerInlineGalHover')
                        }).bind('mouseout', function() {
                            galButton.removeClass('axZmPlayerInlineGalHover')
                        });
                    }
                }

                // Zoom level
                if (op.zoomLevelPos) {
                    var axZmPlayerZoomLevelParent = $('<div />')
                    .attr('id', 'axZmPlayerZoomLevelParent')
                    .css({
                         position: 'absolute',
                         'pointerEvents': 'none',
                         zIndex: 9999
                    });

                    var zoomLevel = $('#axZm_zoomLevel').css({
                        'pointerEvents': 'none'
                    }).addClass('axZmPlayerZoomLevel');

                    var zoomLevelCss = {};
                    if (op.zoomLevelPos == 'topRight') {
                        zoomLevelCss.top = op.zoomLevelVertMargin;
                        zoomLevelCss.right = op.zoomLevelHorzMargin;
                        zoomLevelCss.textAlign = 'right';
                    } else if (op.zoomLevelPos == 'bottomRight') {
                        zoomLevelCss.bottom = op.zoomLevelVertMargin;
                        zoomLevelCss.right = op.zoomLevelHorzMargin;
                        zoomLevelCss.textAlign = 'right';
                    } else if (op.zoomLevelPos == 'bottomLeft') {
                        zoomLevelCss.bottom = op.zoomLevelVertMargin;
                        zoomLevelCss.left = op.zoomLevelHorzMargin;
                    } else if (op.zoomLevelPos == 'topLeft') {
                        zoomLevelCss.top = op.zoomLevelVertMargin;
                        zoomLevelCss.left = op.zoomLevelHorzMargin;
                    }
 
                    axZmPlayerZoomLevelParent
                    .append(zoomLevel)
                    .css(zoomLevelCss)
                    .appendTo('#axZm_zoomLayer');

                    if (!testTouch && op.zoomLevelAutoHide) {
                        axZmPlayerZoomLevelParent.css('opacity', 0);
                        var showZoomLevel = function() {
                            axZmPlayerZoomLevelParent.stop().animate({opacity: 1},{queue: false, duration: 300});
                        };

                        var hideZoomLevel = function() {
                            axZmPlayerZoomLevelParent.stop().animate({opacity: 0},{queue: false, duration: 300});
                        };

                        $('#axZm_zoomLayer').bind('mouseenter', showZoomLevel)
                        .bind('mouseleave', hideZoomLevel)
                        .one('mousemove', showZoomLevel);
                    }
                }
            },
            onLoad: function() {
                if (!op.openAsFullscreen) {
                    toggleDescr();
                }

                op.callBackOnLoad();
            },
            onImageChange: function() {
                timer = new Date().getTime();
                desciptionHidden = false;
                if (op.bullets) {
                    $('#axZmPlayerSubNaviControl_'+$.axZm.zoomPrevID).removeClass('axZmPlayerSubControlSelected');
                    $('#axZmPlayerSubNaviControl_'+$.axZm.zoomID).addClass('axZmPlayerSubControlSelected');
                }

                toggleDescr();
                op.callBackOnImageChange();
            },
            onFullScreenReady: function() {
                if (op.openAsFullscreen) {
                    toggleDescr();
                }

                adjustDescPosition();
            },
            onFullScreenCloseEnd: function() {
                setTimeout(adjustDescPosition, 50);
            },
            onFullScreenResizeEnd: function() {
                adjustDescPosition();
            },
            onStopPlay: function() {
                setPlayButton();
                timer = new Date().getTime();
            },
            onStartPlay: function() {
                setPauseButton();
                timer = null;
            },
            onZoom: function() {
                timer = null;
                if (!isObject(op.descriptionObject[$.axZm.zoomID])) {
                    return;
                }

                var thisHideOnZoom = setValue(op.descriptionObject[$.axZm.zoomID]['hideOnZoom'], op.descriptionHideOnZoom);
                if (thisHideOnZoom && desciptionHidden === false) {
                    desciptionHidden = true;
                    $('#axZmPlayerDescrBox').animate({opacity: 0}, {queue: false, duration: 300, complete: function() {
                        $(this).css('display', 'none');
                    }});
                }
            },
            onRestoreEnd: function() {
                timer = new Date().getTime();
                if (!isObject(op.descriptionObject[$.axZm.zoomID])) {
                    return;
                }

                var thisHideOnZoom = setValue(op.descriptionObject[$.axZm.zoomID]['hideOnZoom'], op.descriptionHideOnZoom);
                if (thisHideOnZoom && desciptionHidden === true) {
                    desciptionHidden = false;
                    $('#axZmPlayerDescrBox').css('display', 'block').animate({opacity: 1},{queue: false, duration: 300});
                }
            }
        };


        function setPlayButton() {
            $('#axZmPlayerPlayPause')
            .removeClass('axZmPlayerPlayPausePause')
            .addClass('axZmPlayerPlayPausePlay');
        }

        function togglePlayPause() {
            if ($.axZm.autoPlayResume) {
                clearInterval($.axZm.autoPlayResume);
            }

            if ($.axZm.autoPlayStatus === true) {
                $.fn.axZm.stopPlay();
                setPlayButton();
            } else {
                $.fn.axZm.startPlay();
                setPauseButton();
                setAutoPlayInterval();
            }
        }

        // Adjust coordinates of the description box
        function adjustDescPosition() {
            if (op.descriptionOutside == 'top' || op.descriptionOutside == 'bottom') {
                return;
            }
 
            var targetCss = getDescrCoordinates();
            if (isObject(targetCss)) {
                $('#axZmPlayerDescrBox').css(targetCss);
            }
        }

        // Claculate coordinates of the description box
        function getDescrCoordinates() {
            var descrBox = $('#axZmPlayerDescrBox');
            if (descrBox.length > 0) {
                var descrW = descrBox.outerWidth();
                var descrH = descrBox.outerHeight();

                if (!isObject(op.descriptionObject[$.axZm.zoomID])) {
                    return {};
                }

                var thisGravity = setValue(op.descriptionObject[$.axZm.zoomID]['gravity'], op.descriptionGravity);
                var thisVertMargin = setValue(op.descriptionObject[$.axZm.zoomID]['vertMargin'], op.descriptionVertMargin);
                var thisHorzMargin = setValue(op.descriptionObject[$.axZm.zoomID]['horzMargin'], op.descriptionHorzMargin);

                var targetCss = {};

                var topTop = $.axZm.boxH - descrH - thisVertMargin;
                var leftBottom = $.axZm.boxW - descrW - thisHorzMargin;

                if (thisGravity == 'bottomLeft') {
                    targetCss.left = thisHorzMargin;
                    targetCss.top = topTop;
                } else if (thisGravity == 'left') {
                    targetCss.left = thisHorzMargin;
                    targetCss.top = ($.axZm.boxH - descrH)/2;
                } else if (thisGravity == 'topLeft') {
                    targetCss.left = thisHorzMargin;
                    targetCss.top = thisVertMargin;
                } else if (thisGravity == 'top') {
                    targetCss.left = ($.axZm.boxW - descrW)/2;
                    targetCss.top = thisVertMargin;
                } else if (thisGravity == 'topRight') {
                    targetCss.left = leftBottom;
                    targetCss.top = thisVertMargin;
                } else if (thisGravity == 'right') {
                    targetCss.left = leftBottom;
                    targetCss.top = ($.axZm.boxH - descrH)/2;
                } else if (thisGravity == 'bottomRight') {
                    targetCss.left = leftBottom;
                    targetCss.top = topTop;
                } else if (thisGravity == 'bottom') {
                    targetCss.left = ($.axZm.boxW - descrW)/2;
                    targetCss.top = topTop;
                } else if (thisGravity == 'center') {
                    targetCss.left = ($.axZm.boxW - descrW)/2;
                    targetCss.top = ($.axZm.boxH - descrH)/2;
                } else if (isObject(thisGravity)) {
                    // position and get top/left coordinates
                    descrBox.css({left: '', top: '', bottom: '', right: ''}).css(op.descriptionGravity);
                    var descrBoxPos = descrBox.position();
                    descrBox.css({right: '', bottom: ''});
                    targetCss.left = descrBoxPos.left;
                    targetCss.top = descrBoxPos.top;
                }

                return targetCss;

            } else {
                return false;
            }
        }

        function toggleDescr() {

            var zoomID = $.axZm.zoomID;
            var zoomPrevID = $.axZm.zoomPrevID;
            var onlyHide = false;

            // try to find zoomID over image name
            if (!isObject(op.descriptionObject[zoomID])) {
                $.each($.axZm.zoomGA, function(k, v) {  
                    if (isObject(op.descriptionObject[v.img]) && k == $.axZm.zoomID) {
                        zoomID = k;
                        op.descriptionObject[k] = op.descriptionObject[v.img];
                    }
                });
            }

            // try to find previous loaded image indormation
            if (!isObject(op.descriptionObject[zoomPrevID])) {
                $.each($.axZm.zoomGA, function(k, v) {
                    if (isObject(op.descriptionObject[v.img]) && k == $.axZm.zoomPrevID) {
                        zoomPrevID = k;
                        op.descriptionObject[k] = op.descriptionObject[v.img];
                    }
                });
            }

            if (!isObject(op.descriptionObject[zoomID])) {
                 if (isObject(op.descriptionObject[zoomPrevID])) {
                    onlyHide = true;
                    zoomID = zoomPrevID;
                } else {
                    return;
                }
            }

            var thisDescr = op.descriptionObject[zoomID]['descr'];
            var thisHref = op.descriptionObject[zoomID]['href'];

            // Override set default from individual description settings
            var thisSlideOutTo = setValue(op.descriptionObject[zoomID]['slideOutTo'], op.descriptionSlideOutTo);
            var thisSlideInFrom = setValue(op.descriptionObject[zoomID]['slideInFrom'], op.descriptionSlideInFrom);
            var thisAnimationOutTime = setValue(op.descriptionObject[zoomID]['animationOutTime'], op.descriptionAnimationOutTime);
            var thisAnimationInTime = setValue(op.descriptionObject[zoomID]['animationInTime'], op.descriptionAnimationInTime);
            var thisSlideOutEasing = setValue(op.descriptionObject[zoomID]['slideOutEasing'], op.descriptionSlideOutEasing);
            var thisSlideInEasing = setValue(op.descriptionObject[zoomID]['slideInEasing'], op.descriptionSlideInEasing);
            var thisSlideDelayIn = setValue(op.descriptionObject[zoomID]['slideDelayIn'], op.descriptionSlideDelayIn);
            var thisFadeInOpacity = setValue(op.descriptionObject[zoomID]['fadeInOpacity'], op.descriptionFadeInOpacity);
            var thisFadeOutOpacity = setValue(op.descriptionObject[zoomID]['fadeOutOpacity'], op.descriptionFadeOutOpacity);
            var thisFadeOpacity = setValue(op.descriptionObject[zoomID]['fadeOpacity'], op.descriptionOpacity);
            var thisPadding = setValue(op.descriptionObject[zoomID]['padding'], op.descriptionPadding);
            var thisCallbackLoad = op.descriptionObject[zoomID]['callbackLoad'];
 
            if (onlyHide) {
                hideDescr();
                return;
            } else if (thisDescr) {
                hideDescr(function() {
                    showDescr(thisDescr)
                });
            }

            // Hide description function
            function hideDescr(callback) {
                var descrBox = $('#axZmPlayerDescrBox');

                if (descrBox.length > 0) {
                    if (op.descriptionOutside == 'top' || op.descriptionOutside == 'bottom') {
                        $('#axZmPlayerDescrBoxInner').animate({
                            opacity: 0
                        },{
                            queue: false, 
                            duration: thisAnimationOutTime,
                            easing: thisSlideOutEasing,
                            complete: function() {
                                if ($.isFunction(callback)) {
                                    callback();
                                }
                            }
                        });
                    } else {
                        var anmCss = {};
                        if (thisSlideOutTo == 'left') {
                            anmCss.left = -descrBox.outerWidth() - 5;
                        } else if (thisSlideOutTo == 'right') {
                            anmCss.left = $.axZm.boxW + 5;
                        } else if (thisSlideOutTo == 'top') {
                            anmCss.top = -descrBox.outerHeight() - 5;
                        } else if (thisSlideOutTo == 'bottom') {
                            anmCss.top = $.axZm.boxH + 5;
                        }

                        anmCss.opacity = thisFadeOutOpacity;

                        descrBox.unbind('click').animate(anmCss,{
                            queue: false, 
                            duration: thisAnimationOutTime,
                            easing: thisSlideOutEasing,
                            complete: function() {
                                descrBox.css('display', 'none');
                                if ($.isFunction(callback)) {
                                    callback();
                                }
                            }
                        });
                    }
                } else if ($.isFunction(callback)) {
                    callback();
                }
            }

            // Show description function
            function showDescr(thisDescr) {
                if (op.descriptionOutside == 'top' || op.descriptionOutside == 'bottom') {
                    var descrBox = $('#axZmPlayerDescrBox');
                    if (!(descrBox.length > 0)) {

                        var descrBoxInner = $('<div />')
                        .attr('id', 'axZmPlayerDescrBoxInner')
                        .css({opacity: 0})
                        .html(thisDescr);

                        var descrBox = $('<div />')
                        .attr('id', 'axZmPlayerDescrBox')
                        .css({
                             height: 'auto',
                             padding: thisPadding,
                             width: $('#'+op.divID).width()-thisPadding*2,
                             position: 'static',
                             cursor: thisHref ? 'pointer' : 'default',
                             clear: 'both'
                        })
                        .addClass('axZmPlayerDescrBox')
                        .append(descrBoxInner);

                        if (op.descriptionOutside == 'top') {
                            descrBox.insertBefore('#'+op.divID);
                        } else {
                            descrBox.insertAfter('#'+op.divID);
                        }

                        setTimeout(function() {
                            descrBoxInner.animate({opacity: 1}, {
                                queue: false, 
                                easing: thisSlideInEasing,
                                duration: thisAnimationInTime
                            });

                            if ($.isFunction(thisCallbackLoad)) {
                                setTimeout(thisCallbackLoad, thisAnimationInTime + 10);
                            }

                        }, thisSlideDelayIn);

                    } else {
                        descrBox.unbind('click').css({
                            'pointerEvents': thisHref ? 'auto' : 'none',
                            cursor: thisHref ? 'pointer' : 'default'
                        });

                        var descrBoxInner = $('#axZmPlayerDescrBoxInner');

                        setTimeout(function() {
                            descrBoxInner.html(thisDescr).animate({
                                opacity: 1
                            }, {
                                queue: false, 
                                easing: thisSlideInEasing,
                                duration: thisAnimationInTime
                            });

                            if ($.isFunction(thisCallbackLoad)) {
                                setTimeout(thisCallbackLoad, thisAnimationInTime + 10);
                            }

                        },thisSlideDelayIn);
                    }
                } else {

                    $('#axZmPlayerDescrBox').axZmRemove();

                    var descrBox = $('<div />')
                    .attr('id', 'axZmPlayerDescrBox')
                    .addClass('axZmPlayerDescrBox')
                    .css({
                        'pointerEvents': thisHref ? 'auto' : 'none',
                        cursor: thisHref ? 'pointer' : 'default',
                        padding: thisPadding,
                        opacity: 0,
                        left: -99999,
                        maxWidth: op.descriptionMaxWidth
                    })
                    .html(thisDescr)
                    .appendTo('#axZm_zoomLayer');

                    if (op.descriptionObject[zoomID]['addClass']) {
                        descrBox.addClass(op.descriptionObject[zoomID]['addClass']);
                    }

                    if (op.descriptionObject[zoomID]['maxWidth']) {
                        descrBox.css({maxWidth: op.descriptionObject[zoomID]['maxWidth']});
                    }

                    var descrW = descrBox.outerWidth();
                    var descrH = descrBox.outerHeight();

                    var targetCss = getDescrCoordinates();

                    var startCss = {};

                    if (thisSlideInFrom == 'left') {
                        startCss.left = - descrW - 5;
                        startCss.top = targetCss.top;
                    } else if (thisSlideInFrom == 'right') {
                        startCss.left = $.axZm.boxW + 5;
                        startCss.top = targetCss.top;
                    } else if (thisSlideInFrom == 'bottom') {
                        startCss.left = targetCss.left;
                        startCss.top = $.axZm.boxH + 5;
                    } else if (thisSlideInFrom == 'top') {
                        startCss.left = targetCss.left;
                        startCss.top = -descrH - 5;
                    } else {
                        startCss.left = targetCss.left;
                        startCss.top = targetCss.top;
                    }

                    startCss.width = descrBox.width() + 5;
                    startCss.height = descrBox.height() + 5;
                    startCss.opacity = thisFadeInOpacity;
                    targetCss.opacity = thisFadeOpacity;

                    setTimeout(function() {
                        descrBox.css(startCss)
                        .animate(targetCss,{
                            queue: false, 
                            easing: thisSlideInEasing,
                            duration: thisAnimationInTime
                        });

                        if ($.isFunction(thisCallbackLoad)) {
                            setTimeout(thisCallbackLoad, thisAnimationInTime + 10);
                        }

                    }, thisSlideDelayIn);
                }

                if ($.isFunction(thisHref)) {
                    descrBox.bind('click', function() {
                        thisHref();
                    });
                } else if (thisHref) {
                    descrBox.bind('click', function() {
                        window.location.href = thisHref;
                    });
                }
            }
        }

        if (op.openAsFullscreen && !$.fn.ajaxZoomSlider.dynOptions) {
            $('body').css({
                height: $(window).height()
            });

            jQuery.fn.axZm.openFullScreen(
                ajaxZoom.path,
                ajaxZoom.parameter,
                ajaxZoom.opt,
                'window',
                false,
                true
            );
        } else if ($.fn.ajaxZoomSlider.dynOptions || op.fluidDesign || op.responsive) {
            jQuery.fn.axZm.openFullScreen(
                ajaxZoom.path,
                ajaxZoom.parameter,
                ajaxZoom.opt,
                op.divID,
                op.fullScreenApi && !$.fn.ajaxZoomSlider.dynOptions ? true : false,
                true,
                false
            );
        } else {
            jQuery.fn.axZm.load({
                opt: ajaxZoom.opt,
                path: ajaxZoom.path,
                parameter: ajaxZoom.parameter,
                divID: ajaxZoom.divID
            });
        }
    };

})(jQuery);


// tipsy, facebook style tooltips for jquery
// version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// releated under the MIT license
// extended by AJAX-ZOOM, this is not original code

(function($) {
    function fixTitle($ele) {
        if ($ele.attr('title') || typeof($ele.attr('original-title')) != 'string') {
            $ele.attr('original-title', $ele.attr('title') || '').removeAttr('title');
        }
    }

    function aZTipsy(element, options) {
        this.$element = $(element);
        this.options = options;
        this.enabled = true;
        fixTitle(this.$element);
    }

    aZTipsy.prototype = {
        show: function() {
            var title = this.getTitle();
            if (title && this.enabled) {
                var $tip = this.tip();
                var dtaPos = $tip.attr('data-position');
                $tip.find('.aZtipsy-inner')[this.options.html ? 'html' : 'text'](title);
                $tip[0].className = 'aZtipsy'; // reset classname in case of dynamic gravity

                var apTo = ($.axZm.fsi && $.axZm.fullScreenRel == 'window') ? '#axZm_zoomLayer' : 'body';

                $tip
                .remove()
                .css({top: 0, left: 0, display: 'block', visibility: 'hidden'}) // 
                .appendTo(apTo); // document.body

                var pos = $.extend({}, this.$element.offset(), {
                    width: this.$element[0].offsetWidth,
                    height: this.$element[0].offsetHeight
                });

                var _this = this;

                var actualWidth = $tip[0].offsetWidth;
                var actualHeight = $tip[0].offsetHeight;

                var gravity = (typeof _this.options.gravity == 'function')
                    ? _this.options.gravity.call(_this.$element[0])
                    : _this.options.gravity;

                var tp;

                switch (gravity.charAt(0)) {
                    case 'n':
                        tp = {top: pos.top + pos.height + _this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2};
                        break;
                    case 's':
                        tp = {top: pos.top - actualHeight - _this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2};
                        break;
                    case 'e':
                        tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth - _this.options.offset};
                        break;
                    case 'w':
                        tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width + _this.options.offset};
                        break;
                }

                if (gravity.length == 2) {
                    if (gravity.charAt(1) == 'w') {
                        tp.left = pos.left + pos.width / 2 - 15;
                    } else {
                        tp.left = pos.left + pos.width / 2 - actualWidth + 15;
                    }
                }

                $tip.css(tp).addClass('aZtipsy-' + gravity);

                if (_this.options.fade) {
                    $tip.stop().css({opacity: 0, display: 'block', visibility: 'visible'}).animate({opacity: _this.options.opacity});
                } else {
                    $tip.css({visibility: 'visible', opacity: _this.options.opacity});
                }

                // Added by AJAX-ZOOM
                _this.options.openCallback($tip);
            }
        },

        hide: function() {
            var $tip = this.tip();
            if (this.options.fade) {
                $tip.stop().fadeOut(function() {
                    $(this).axZmRemove();
                });
            } else {
                $tip.axZmRemove();
            }

            // Added by AJAX-ZOOM
            this.options.closeCallback($tip);
        },

        getTitle: function() {
            var title, $e = this.$element, o = this.options;
            fixTitle($e);
            var title;
            var o = this.options;
            if (typeof o.title == 'string') {
                title = $e.attr(o.title == 'title' ? 'original-title' : o.title);
            } else if (typeof o.title == 'function') {
                title = o.title.call($e[0]);
            }

            title = ('' + title).replace(/(^\s*|\s*$)/, "");
            return title || o.fallback;
        },

        tip: function() {
            if (!this.$tip) {
                this.$tip = $('<div class="aZtipsy"></div>')
                .html('<div class="aZtipsy-arrow"></div><div class="aZtipsy-inner"/></div>');
            }

            return this.$tip;
        },

        validate: function() {
            if (!this.$element[0].parentNode) {
                this.hide();
                this.$element = null;
                this.options = null;
            }
        },

        enable: function() {
            this.enabled = true;
        },
        disable: function() {
            this.enabled = false;
        },
        toggleEnabled: function() {
            this.enabled = !this.enabled;
        }
    };

    $.fn.aZtipsy = function(options) {
        if (options === true) {
            return this.data('aZtipsy');
        } else if (typeof options == 'string') {
            return this.data('aZtipsy')[options]();
        }

        options = $.extend({}, $.fn.aZtipsy.defaults, options);

        function get(ele) {
            var aZtipsy = $.data(ele, 'aZtipsy');
            if (!aZtipsy) {
                aZtipsy = new aZTipsy(ele, $.fn.aZtipsy.elementOptions(ele, options));
                $.data(ele, 'aZtipsy', aZtipsy);
            }

            return aZtipsy;
        }

        function enter() {
            var aZtipsy = get(this);
            aZtipsy.hoverState = 'in';
            if (options.delayIn == 0) {
                aZtipsy.show();
            } else {
                setTimeout(function() {
                    if (aZtipsy.hoverState == 'in') {
                        aZtipsy.show();
                    }
                }, options.delayIn);
            }
        };

        function leave() {
            var aZtipsy = get(this);
            aZtipsy.hoverState = 'out';
            if (options.delayOut == 0) {
                aZtipsy.hide();
            } else {
                setTimeout(function() {
                    if (tipsy.hoverState == 'out') {
                        aZtipsy.hide();
                    }
                }, options.delayOut);
            }
        };

        if (!options.live) {
            this.each(function() {
                get(this);
            });
        };

        if (options.trigger != 'manual') {
            var binder   = options.live ? 'live' : 'bind';
            var eventIn  = options.trigger == 'hover' ? 'mouseenter' : 'focus';
            var eventOut = options.trigger == 'hover' ? 'mouseleave' : 'blur';
            this[binder](eventIn, enter)[binder](eventOut, leave);
        }

        return this;
    };

    $.fn.aZtipsy.defaults = {
        delayIn: 0,
        delayOut: 0,
        fade: false,
        fallback: '',
        gravity: 'n',
        html: false,
        live: false,
        offset: 0,
        opacity: 0.8,
        title: 'title',
        trigger: 'hover',
        openCallback: function(obj) {}, // Added by AJAX-ZOOM
        closeCallback: function(obj) {} // Added by AJAX-ZOOM
    };

    // Overwrite this method to provide options on a per-element basis.
    // For example, you could store the gravity in a 'tipsy-gravity' attribute:
    // return $.extend({}, options, {gravity: $(ele).attr('tipsy-gravity') || 'n' });
    // (remember - do not modify 'options' in place!)
    $.fn.aZtipsy.elementOptions = function(ele, options) {
        return $.metadata ? $.extend({}, options, $(ele).metadata()) : options;
    };

    $.fn.aZtipsy.autoNS = function() {
        return $(this).offset().top > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
    };

    $.fn.aZtipsy.autoWE = function() {
        return $(this).offset().left > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
    };

})(jQuery);