/**
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.imageSliderEditor.js
* Copyright: Copyright (c) 2010-2018 Vadim Jacobi
* License Agreement: https://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.0
* Extension Date: 2018-10-01
* URL: https://www.ajax-zoom.com
* Documentation: https://www.ajax-zoom.com/index.php?cid=docs
*/

(function($) {
    $.fn.ajaxZoomSlider.dynOptions = function() {
        var defaults = $.fn.ajaxZoomSlider.getDefaults();

        var loadedOptions = $.fn.ajaxZoomSlider.getOptions();

        // All possible jquery + ui easing types
        var easingTypes = ['swing', 'linear', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart','easeInOutQuart', 'easeInQuint','easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic', 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce'];

        // This is a map of all possible values used for dynamic configuration in https://www.ajax-zoom.com/examples/example30.php
        var defVars = {
            parameter: {
                values: 'textarea', 
                newBlock: 'Most Important (please read)',
                descr: 'String that is passed to AJAX-ZOOM. There are basically two ways to define images to load. \
                First e.g. <span style="font-family: Courier New"><span style="color:red">zoomDir</span>=/pic/zoom/animals</span> \
                <br> (this will instantly parse and load all images from this directory). \
                Second way is to define each image path individually separating them (CSV like) with "|" e.g. \
                <span style="font-family: Courier New"><span style="color:red">zoomData</span>=/pic/zoom/animals/test_animals1.png|/pic/zoom/boutique/test_boutique3.png|/pic/zoom/objects/test_objects2.png</span> \
                <br>In both cases please avoid using relative paths. \
                Btw: here <a href="https://www.ajax-zoom.com/examples/example27.php">https://www.ajax-zoom.com/examples/example27.php</a> is a good overview of some \
                extended possibilities to define what you want to see in this image slider :-) \
                '
            },
            axZmPath: {values: 'string', newBlock: 'Necessary Options', descr: 'Path to AJAX-ZOOM - /axZm/ directory, e.g. "/apps/zoom/ajax-zoom/axZm/". Please not that "auto" may not always work if e.g. js files are merged. It is therefore advisable to set a relative or absulte path to the axZm folder.'},
            divID: {values: 'string', descr: 'ID of the container, where AJAX-ZOOM will be loaded into. Not needed if openAsFullscreen option is set to true.'}, 

            bullets: {values: [true, false], newBlock: 'Bullet Navigation', descr: 'Enable bullet navigation.'},
            bulletsNumbers: {values: [true, false], descr: 'Put image numbers inside bullets.'},
            bulletsPos: {values: ['inside', 'outside'], descr: 'Position of the bullets.'},
            bulletsOutsideCont: {values: 'string', descr: 'Selector for the parent container, if "bulletsPos" option is set to outside.'},
            bulletsGravity: {values: ['topLeft', 'top', 'topRight', 'bottomLeft', 'bottom', 'bottomRight'], descr: 'Gravity of the bullets.'},
            bulletsAutoHide: {values: [true, false], descr: 'Autohide bullets when mouse is not over the slider (disabled for touch devices).'},

            toolTip: {values: [true, false], newBlock: 'Tooltip with Preview Image', descr: 'Enable tooltip with preview image when mouse over a bullet (disabled for touch devices).'},
            toolTipGravity: {values: ['auto', 'nw', 'n', 'ne', 'w', 'e', 'sw', 's', 'se'], descr: 'Tooltip gravity.'},
            toolTipKeepInside: {values: [true, false], descr: 'If true, tolltip position will not overflow the AJAX-ZOOM slider.'},  
            toolTipOffset: {values: 'int', descr: 'Vertical offset of the tooltip'}, 
            toolTipDelayIn: {values: 'int', descr: 'Delay in ms when tooltip appears when mouse is over a bullet.'}, 
            toolTipDelayOut: {values: 'int', descr: 'Delay in ms when tooltip disappears.'}, 
            toolTipFade: {values: [true, false], descr: 'Fade tooltip when it appears.'}, 
            toolTipOpacity: {values: 'float', descr: 'Opacity of the tooltip, float value <= 1.'},

            playPauseButtonPos: {values: [false, 'topRight', 'bottomLeft', 'topLeft', 'bottomRight'], newBlock: 'Play / Pause Button', descr: 'Play / Pause button position; false for no button.'},
            playPauseAutoHide: {values: [true, false], descr: 'Instantly hide Play / Pause button when mouse is not over the slider (disabled for touch devices).'}, 
            playPauseButtonVertMargin: {values: 'int', descr: 'Vertical margin of the Play / Pause button.'},
            playPauseButtonHorzMargin: {values: 'int', descr: 'Horizontal margin of the Play / Pause button.'},
            playPauseInterval: {values: 'int', descr: 'Time in ms between image change.'},

            autoPlay: {values: [true, false], newBlock: 'Autoplay settings', descr: 'Start play when slider is loaded; disabled when inlineGalShowOnLoad is set to true; see also playPauseInterval.'}, // false or time in ms, time 
            autoPlayStopOnHover: {values: [true, false], descr: 'Stop autoplay when mouse is over the image.'}, 
            autoPlayResume: {values: [false, 'int'], descr: 'Resume autoplay after some time in ms when because of user interaction autoplay stops - autoPlayStopOnHover, hitting the play pause button, switching image manually.'},
            autoPlayResumePreventHover: {values: [true, false], descr: 'Prevent autoPlayResume when mouse is still over the image.'}, // bool, prevent resume if mouse is over the image

            inlineGalButtonPos: {values: [false, 'topRight', 'bottomLeft', 'topLeft', 'bottomRight'], newBlock: 'Gallery Button', descr: 'Define button position for a grid overview of all slides overview, false to disable.'},
            inlineGalAutoHide: {values: [true, false], descr: 'Autohide gallery button when mouse is not over the slider (disabled for touch devices).'},
            inlineGalShowOnLoad: {values: [true, false], descr: 'Instantly show gallery when slider is loaded.'},
            inlineGalButtonVertMargin: {values: 'int', descr: 'Vertical margin of the button.'}, 
            inlineGalButtonHorzMargin: {values: 'int', descr: 'Horizontal margin of the button.'}, 

            zoomLevelPos: {values: [false, 'topRight', 'bottomLeft', 'topLeft', 'bottomRight'], newBlock: 'Zoom Level Indicator', descr: 'Define "zoom level" indicator position above the slider, false to disable. The zoom level depends on the size of the original image'},
            zoomLevelAutoHide: {values: [true, false], descr: 'Autohide zoom level when mouse is not over the image slider'}, 
            zoomLevelVertMargin: {values: 'int', descr: 'Vertical margin of the zoom level indicator'},
            zoomLevelHorzMargin: {values: 'int', descr: 'Horizontal position of the zoom level indicator'},

            animationType: {values: ['Center', 'Bottom', 'Top', 'Vert', 'Right', 'Left', 'Horz', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert'], newBlock: 'Animation Types', descr: 'General animation type.'}, 
            animationTypeArrows: {values: ['Center', 'Bottom', 'Top', 'Vert', 'Right', 'Left', 'Horz', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert'], descr: 'Animation type for the arrows, can be different from above.'}, 
            animationTypeBullets: {values: ['Center', 'Bottom', 'Top', 'Vert', 'Right', 'Left', 'Horz', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert'], descr: 'Animation type by clicking on the bullet navigation, can be different from above.'}, 

            descriptionObject: {values: 'longDescription', newBlock: 'Description of each slide',
            descr: '\
This option is a "multidimensional object" {}. Each key of the first level is the image name of the slide and it\'s value is again an object, which contains different information like title, long description etc. Example: \
<pre style="font: 9pt arial; padding: 5px">descriptionObject: {\n \
    "example_image_1.jpg": {\n \
        "descr": "Here goes a longer description of your slide, can be html/css formated" \n \
    },\n \
    "example_image_2.jpg": {\n \
        "descr": "Long description of slide 2", \n \
        "href": "https://www.ajax-zoom.com"\n \
    },\n \
    "example_image_3.jpg": {\n \
        "descr": "Long description of slide 3", \n \
        "title": "Red Biplane", \n \
        "addClass": "someCssClassName", \n \
        "href": function() {\n \
            alert(123);\n \
        }, \n \
        "callbackLoad": function() {\n \
            alert("Slide loaded");\n \
        }\n \
    }  \n \
}</pre> \
<b>descr</b>: is a "string" and can contain html/css <br /><br />\
<b>href</b>: is optional. As "string" (example_image_2.jpg) it is a link to some location. \
It can also be a JavaScript function like for example_image_3.jpg slide, which will be triggered on click. <br /><br />\
<b>title</b>: is "string" and optional, used for labeling the thumbnails in the grid overview, see "Gallery Button" above.<br /><br />\
<b>addClass</b>: is "string" and optional. With addClass you can add some css styling to the description container, \
e.g. transparent png background image... Of course it has to be defined somewhere already. \
The global css class name is .axZmPlayerDescrBox (font color, size etc.) and is defined in /axZm/extensions/jquery.axZm.imageSlider.css<br /><br />\
<b>callbackLoad</b>: optional JavaScript function like for example_image_3.jpg which can be triggered after a particular slide is loaded.<br /><br />\
Finally you can override any of the globally defined description settings (see previous section) in each of the slide, example:\
<pre style="font: 9pt arial; padding: 5px">descriptionObject: {\n \
    "example_image_3.jpg": {\n \
        "descr": "Long description of slide 3",\n \
        "addClass": "axZmPlayerDescrBoxCustom",\n \
        "gravity": "bottom",\n \
        "maxWidth": 300,\n \
        "vertMargin": 60,\n \
        "slideInFrom": "top",\n \
        "animationInTime": 1500,\n \
        "slideInEasing": "easeOutBounce",\n \
        "hideOnZoom": true\n \
    }  \n \
}</pre> \
Please note, that there should be no commata after last value, as it will produce a JavaScript error on Internet Explorer. <br /><br />\
As of first version of this slider there is no comfortable configurator available. <br /><br />\
            '},

            descriptionOpacity: {values: 'float', newBlock: 'Description settings', descr: 'Opacity of the description box.'},
            descriptionGravity: {values: ['topRight', 'topLeft', 'bottomRight', 'bottomLeft', 'bottom', 'top', 'left', 'right', 'center'], descr: 'Gravity (position) of the description box.'}, 
            descriptionHorzMargin: {values: 'int', descr: 'Horizontal (left, right) margin.'},
            descriptionVertMargin: {values: 'int', descr: 'Vertical (top, bottom) margin.'},
            descriptionHideOnZoom: {values: [true, false], descr: 'Hide description when image is zoomed.'},
            descriptionOutside: {values: [false, 'bottom', 'top'], descr: 'Show desciption outside of the slider, either above (top) or below (bottom).'},
            descriptionSlideInFrom: {values: [false, 'left', 'right', 'bottom', 'top'], descr: 'When description is shown slide it from some direction.'},
            descriptionSlideOutTo: {values: [false, 'left', 'right', 'bottom', 'top'], descr: 'When description is hidden (image change) slide it away in some direction.'},
            descriptionSlideDelayIn: {values: 'int', descr: 'Delay appearance of the description in ms.'},
            descriptionAnimationInTime: {values: 'int', descr: 'Duration time of the animation when description shows.'},
            descriptionAnimationOutTime: {values: 'int', descr: 'Duration time of the animation when description hides.'},
            descriptionSlideInEasing: {values: easingTypes, descr: 'Transition type when description shows.'},
            descriptionSlideOutEasing: {values: easingTypes, descr: 'Transition type when description hides.'},
            descriptionFadeInOpacity: {values: 'float', descr: 'Initial opacity when transition starts; the end opacity is "descriptionOpacity", see above.'},
            descriptionFadeOutOpacity: {values: 'float', descr: 'Target opacity when description hides.'},
            descriptionMaxWidth: {values: 'int', descr: 'Max width of the description box. The text inside will brake if it is too long.'},
            descriptionPadding: {values: 'int', descr: 'Padding (inner margin) of the description box. Useful if description box has background, border etc.'},

            zoomSliderPos: {values: [false, 'topRight', 'topLeft', 'bottomRight', 'bottomLeft', 'bottom', 'top'], newBlock: 'Zoom Slider', descr: 'Sets position of AJAX-ZOOM zoom slider, false disables it.'}, 
            zoomSliderHandleSize: {values: 'int', descr: 'Handle size of the zoom slider.'},
            zoomSliderThickness: {values: 'int', descr: 'Zoom slider bar thickness.'},
            zoomSliderWidth: {values: 'int', descr: 'Zoom slider bar length.'},
            zoomSliderMarginV: {values: 'int', descr: 'Zoom slider vertical margin (top and bottom).'},
            zoomSliderMarginH: {values: 'int', descr: 'Zoom slider horizontal margin (left and right).'},
            zoomSliderHorz: {values: [true, false], descr: 'Sets the zoom slider orientation to horizontal.'},
            zoomSliderAutoHide: {values: [true, false], descr: 'Instantly hide zoom slider if mouse is not over the image (disabled for touch devices).'},
            zoomSliderContainerPadding: {values: 'int', descr: 'Zoom slider container padding.'},
            zoomSliderOpacity: {values: 'float', descr: 'Opacity of the slider.'},

            prevNextArrows: {values: [true, false], newBlock: 'Prev / Next Arrows', descr: 'Enable prev / next arrows.'},
            prevNextArrowsMargin: {values: 'int', descr: 'Margin of the prev / next arrows'},
            prevNextArrowsAutoHide: {values: [true, false], descr: 'Instantly hide prev / next arrows when mouse is not over the slider (disabled for touch devices).'},
            prevNextArrowsOnlyFullScreen: {values: [true, false], descr: 'Show prev / next arrows only in fullscreen mode.'},

            fullScreen: {values: [false, 'topRight', 'topLeft', 'bottomRight', 'bottomLeft'], newBlock: 'Fullscreen and Fluid Design Settings', descr: 'Enable fullscreen button and set it\'s position.'}, 
            openAsFullscreen: {values: [true, false], descr: 'Initialize AJAX-ZOOM slider as fullscreen. In this case it is not possible to return to regular size.'},
            responsive: {values: [true, false], descr: 'Use this option when the size of divID - the container, where AJAX-ZOOM is placed into, can vary depending on users screen resolution. Do not activate it if divID has fixed with and height.'},
            fullScreenApi: {values: [true, false], descr: 'Use browser fullscreen API when fullscreen button is clicked.'},

            preloadAllInitialPic: {values: [true, false], newBlock: 'Mix', descr: 'Preload all initial images (not the original, they are never loaded into cache). If set to false only next / previois images will be preloaded.'},

            imageMapPos: {values: [false, 'topRight', 'topLeft', 'bottomRight', 'bottomLeft'], newBlock: 'Image Map', descr: 'Set position of the image map, false to disable.'},
            imageMapOpacity: {values: 'int', descr: 'Opacity of the image map.'},
            imageMapWithoutZoom: {values: [true, false], descr: 'Show image map even if image is not zoomed.'},
            imageMapFract: {values: 'float', descr: 'Size of the image map as fraction of the whole slider.'},
            imageMapFullScreenFract: {values: 'float', descr: 'Size of the image map as fraction of the whole slider in fullscreen mode.'},
            imageMapWidth: {values: 'int', descr: 'Instead of the fraction you can also define width and height of the image map in pixels.'},
            imageMapHeight: {values: 'int', descr: 'Instead of the fraction you can also define width and height of the image map in pixels.'},
            imageMapFullScreenWidth: {values: 'int', descr: 'Instead of the fraction you can also define width and height of the image map in fullscreen mode in pixels.'},
            imageMapFullScreenHeight: {values: 'int', descr: 'Instead of the fraction you can also define width and height of the image map in fullscreen mode in pixels.'},
            imageMapHorzMargin: {values: 'int', descr: 'Horizontal (left, right) margin of the image map.'},
            imageMapVertMargin: {values: 'int', descr: 'Vertical (top, bottom) margin of the image map.'},
            imageMapDraggable: {values: [true, false], descr: 'Set image map to be draggable.'},
            imageMapSelOpacity: {values: 'float', descr: 'Opacity of the selector inside image map which indicates the zoomed portion of the image.'},
            imageMapSelSmoothDrag: {values: [true, false], descr: 'Dragging the selector results in smooth shift of the main image.'},
            imageMapBorderTop: {values: 'int', descr: 'Top border width of the image map.'},
            imageMapBorderRight: {values: 'int', descr: 'Right border width of the image map.'},
            imageMapBorderBottom: {values: 'int', descr: 'Bottom border width of the image map.'},
            imageMapBorderLeft: {values: 'int', descr: 'Left border width of the image map.'}
        };

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

        function isFloat(n) {
            n = parseFloat(n);
            return n===+n && n!==(n|0);
        }

        function string(val, colorize) {
            if (val === false) {
                if (colorize) {
                    return '<span style="color: green; font-weight: bold;">false</span>';
                }

                return 'false';
            } else if (val === true) {
                if (colorize) {
                    return '<span style="color: green; font-weight: bold;">true</span>';
                }

                return 'true';
            } else if (isInt(val) || isFloat(val)) {
                if (colorize) {
                    return '<span style="color: red; font-weight: bold;">'+val+'</span>';
                } 
                return val;
            } else {
                return "<span style=\"font-weight: bold;\">\""+val+"\"</span>";
            }
        }

        function parseJsonString(json) {
            return json.replace(/\n/,'').replace(/\t/,'').replace(/ +(?= )/g,'').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        function colorizeString(json) {
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'color: red';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) { // key
                        cls = 'color: black';
                    } else { // string
                        cls = 'color: black; font-weight: bold';
                    }
                } else if (/true|false/.test(match)) { // boolean
                    cls = 'color: green';
                } else if (/null/.test(match)) { // null
                    cls = 'null';
                }

                return '<span style="' + cls + '">' + match + '</span>';
            });
        }

        function strReplace(s, r, subj) {
            if (!subj) {
                return;
            }

            return subj.split(s).join(r);
        }

        function colorizeObj(json) {
            json = strReplace('":', '\"<span style="color: blue;">:</span>', json);
            json = strReplace('},', '<span style="color: blue;">}</span>,', json);
            json = strReplace('{\n', '<span style="color: blue;">{</span>\n', json);
            json = strReplace('}\n', '<span style="color: blue;">}</span>\n', json);
            return json;
        }

        function removeAZ() {
            $.fn.axZm.spinStop();
            if ($.fn.axZm.killInternalGalleries) {
                $.fn.axZm.killInternalGalleries();
            }

            $.fn.axZm.remove();
            $('#axZmTempBody').axZmRemove(true);
            $('#axZmTempLoading').axZmRemove(true);
            $('#zFsO').axZmRemove(true);
        }

        function printOptions() {
            var customOpt = {};
            var numCustomOpt = 0;
            $.each(defaults, function(opt, val) {
                if (defVars[opt]) {
                    var custom = $('#'+opt).val();
                    if (custom == 'false') {
                        custom = false;
                    } else if (custom == 'true') {
                        custom = true;
                    } else if (isInt(custom)) {
                        custom = parseInt(custom);
                    } else if (custom && custom.indexOf('{') == 0) {
                        try {
                            var obj1 = $.parseJSON(parseJsonString(custom));
                            var obj2 = $.parseJSON(parseJsonString($.toJSON(val)));

                            if (compareObjects(obj1, obj2) === true) {
                                custom = undefined;
                            }else if (isObject(obj1)) {
                                custom = obj1;
                            }else{
                                custom = undefined;
                            }
                        } catch(err) {
                            custom = undefined;
                            alert('Error in descriptionObject you have just edited.');
                        }
                    }

                    if (custom != val && custom !== undefined) {
                        numCustomOpt++;
                        customOpt[opt] = custom;
                    }
                }
            });

            var customOptString = '';

            var n = 0;
            $.each(customOpt, function (k, v) {
                n++;
                if (!isObject(v)) {
                    customOptString += '    '+'\"'+k+'\"'+'<span style="color: blue">:</span> '+string(v, true);
                } else {
                    var stringfObj = addTabs($.toJSON(v, null, '    '));
                    customOptString += '    '+'\"'+k+'\"'+'<span style="color: blue">:</span> '+colorizeObj(colorizeString(stringfObj));
                }

                if (numCustomOpt != n) {
                    customOptString += ',\n'
                }
            });

            $('#axZmSliderDynConfPrint')
            .html('<pre>jQuery.fn.ajaxZoomSlider<span style="color: blue">({</span>\n'+customOptString+'\n<span style="color: blue">})</span>;</pre>');
        }

        function addTabs(str) {
            var strLines = str.split('\n');
            var newStr = '';
            $.each(strLines, function(k, v) {
                newStr += '    '+v+'\n';
            });

            return newStr;
        }

        function createSelect(name, arr, selected) {
            var r = $('<select />').attr({
                id: name,
                name: name
            })
            .css({width: '100%'})
            .addClass('form-control')
            .bind('change', printOptions);

            if (arr[0] === false && arr[1] === 'int') {
                return createTextField(name, selected, 70);
            }

            $.each(arr, function(val, text) {
                r.append(new Option(text, text));
            });

            if (isInt(selected)) {
                r.val('int');
            }else {
                if (selected === false) {selected = 'false';}
                if (selected === true) {selected = 'true';}
                
                r.val(selected);
            }

            return r;
        }

        function createTextField(name, value, width) {
            var r = $('<input>').attr({
                type: 'text',
                value: value,
                name: name,
                id: name
            })
            .addClass('form-control')
            .css({width: width})
            .bind('change', printOptions);

            return r;
        }

        function createTextArea(name, value, width, height) {
            var r = $('<textarea />').attr({
                value: (isObject(value) ? $.toJSON(value, null, '    ') : value),
                name: name,
                id: name
            })
            .addClass('form-control')
            .css({width: width, height: height})
            .bind('change', printOptions);

            return r;
        }

        function compareObjects(obj1, obj2) {
            if (isObject(obj1) || isObject(obj2)) {
                return false;
            }

            var eq = $.toJSON(obj1) == $.toJSON(obj2);
            //JSON.parse
            return eq;
        }

        function submitOptionsForm(event) {
            if (event) {
                event.stopPropagation();
            }

            var r = {};
            $('#axZmSliderDynConf :input')
            .each(function() {

                var f = $(this); 
                var name = f.attr('id'); 
                var val = f.val();

                var brk = false;
                if (val == 'false') {
                    val = false;
                } else if (val == 'true') {
                    val = true;
                } else if (isInt(val)) {
                    val = parseInt(val);
                } else if (val.indexOf('{') == 0) {
                    try {
                        var obj = $.parseJSON(val.replace(/\n/,'').replace(/\t/,'').replace(/ +(?= )/g,''));
                        if (isObject(obj)) {
                            val = obj;
                        } else {
                            brk = true;
                        }
                    } catch(err) {
                        brk = true;
                    }
                }

                if (!brk) {
                    r[name] = val;
                }
            });

            var loadedOptions = $.fn.ajaxZoomSlider.getOptions();
            $.extend(loadedOptions, r);
            $('#axZmSliderDynConf').slideToggle();

            $('#'+loadedOptions.divID)
            .empty()
            .html('<div style="margin: 10px; font-size: 150%">Reloading with new options, please wait</div>');

            //$('#zFsO').remove();
            removeAZ();

            setTimeout(function() {
                $.fn.ajaxZoomSlider(loadedOptions);
            }, 500);

            window.scrollTo(0,0);
        };

        var backgroundColor = '#FDFDFD';
        var color = '#000000';
        var colW = {1: 3, 2: 3, 3: 2, 4: 4};
        var colClass = {1: 'col-sm-', 2: 'col-sm-', 3: 'col-sm-', 4: 'col-sm-'};

        // Heading
        var newDivContHead = $('<div />')
        .addClass('row')
        .css({fontSize: '125%', backgroundColor: '#999', color: '#fff', marginBottom: 5});

        $('<div />').addClass(colClass[1] + colW[1]).html('Option').appendTo(newDivContHead);
        $('<div />').addClass(colClass[2] + colW[2]).html('Value').appendTo(newDivContHead);
        $('<div />').addClass(colClass[3] + colW[3]).html('Default').appendTo(newDivContHead);
        $('<div />').addClass(colClass[4] + colW[4]).html('Description').appendTo(newDivContHead);

        var mn = 0;
        $.each(defaults, function(opt, val) {
            if (isObject(defVars[opt])) {
                var valDef = val;
                //newBlock
                if (defVars[opt]['newBlock']) {
                    mn++;

                    // Subheading
                    $('<div />')
                    .css({marginTop: 5, color: '#fff', cursor: 'pointer', padding: 3, paddingLeft: 10, width: '100%', backgroundColor: '#555'})
                    .addClass('clearfix')
                    .html('<span style="font-size: 120%">'+defVars[opt]['newBlock']+'</span>')
                    //.append(button)
                    .bind('click', function() {
                        $(this).next().slideToggle();
                    })
                    .appendTo('#axZmSliderDynConf');

                    // Subcontainer
                    var subDiv = $('<div />')
                    .attr('id', 'sliderDynConfSubDiv' + mn)
                    .css({width: '100%', height: 'auto', display: 'none'})
                    .appendTo('#axZmSliderDynConf');

                    if (defVars[opt]['subBlock']) {
                        $('<div />')
                        .css({marginTop: 5, marginBottom: 5, color: '#000000', padding: 3, height: 'auto', width: '100%'})
                        .html(defVars[opt]['subBlock'])
                        .appendTo(subDiv);
                    }

                    backgroundColor == '#FDFDFD';
                }

                if (backgroundColor == '#FDFDFD') {
                    backgroundColor = '#DBDBDB'
                    color = '#000000';
                } else {
                    backgroundColor = '#FDFDFD'
                    color = '#000000';
                }

                var newDivCont = $('<div />')
                .css({padding: 10, width: '100%', backgroundColor: backgroundColor, color: color})
                .addClass('clearfix');

                if (defVars[opt]['newBlock'] && defVars[opt]['values'] != 'longDescription') {
                    newDivCont.css('paddingTop', 0).append(newDivContHead.clone());
                }

                var lineWrap = $('<div />').addClass('row');
                var optNameDiv = $('<div />')
                .css({wordBreak: 'break-all'})
                .addClass(colClass[1] + colW[1]).appendTo(lineWrap);

                var optSelDiv = $('<div />');
                var optDefault = $('<div />').css({wordBreak: 'break-all'});
                var optDescDiv = $('<div />');

                if (defVars[opt]['values'] == 'textarea') {
                    optSelDiv.addClass(colClass[2] + (colW[2] + colW[3])).appendTo(lineWrap);
                    optDescDiv.addClass(colClass[4] + colW[4]).appendTo(lineWrap);
                } else if (defVars[opt]['values'] == 'longDescription') {
                    optDescDiv.addClass(colClass[4] + (colW[2] + colW[3] + colW[4])).appendTo(lineWrap);
                } else {
                    optSelDiv.addClass(colClass[2] + colW[2]).appendTo(lineWrap);
                    optDefault.addClass(colClass[3] + colW[3]).appendTo(lineWrap);
                    optDescDiv.addClass(colClass[4] + colW[4]).appendTo(lineWrap);
                }

                //var noDefault = false;
                //if (val !== false && val != '0' && !val) {
                    //noDefault = true;
                    val = loadedOptions[opt];

                //}

                var sel = '';
                if ($.isArray(defVars[opt]['values'])) {
                    sel = createSelect(opt, defVars[opt]['values'], val);
                } else if (defVars[opt]['values'] == 'int' || defVars[opt]['values'] == 'float') {
                    sel = createTextField(opt, val, '100%');
                } else if (defVars[opt]['values'] == 'string') {
                    sel = createTextField(opt, val, '100%');
                } else if (defVars[opt]['values'] == 'textarea') {
                    sel = createTextArea(opt, val, '100%', 240);
                }

                optNameDiv.append(opt);
                optSelDiv.append(sel);

                //if (defVars[opt]['values'] != 'textarea' && !noDefault) {
                if (defVars[opt]['values'] != 'textarea') {
                    optDefault.append(string(valDef, true));
                }

                optDescDiv.append(defVars[opt]['descr']);
                lineWrap.appendTo(newDivCont);
                newDivCont.appendTo('#sliderDynConfSubDiv'+mn);

                // Description object
                if (opt == 'descriptionObject') {
                    var descrArea = createTextArea('descriptionObjectTest', loadedOptions['descriptionObject'], '100%', 400);
                    descrArea.css({fontSize: '9pt', '-moz-tab-size': 4, 'tab-size': 4});

                    var enableCheckbox = $('<input>')
                    .attr({type: 'checkbox'})
                    .bind('click', function() {
                        if ($(this).is(':checked')) {
                            $("textarea[name='descriptionObjectTest']").attr('id', 'descriptionObject');
                        }else{
                            $("textarea[name='descriptionObjectTest']").attr('id', 'descriptionObjectTest');
                        }

                        printOptions();
                    })
                    .appendTo(optDescDiv);

                    var checkBoxText = $('<span />')
                    .html(' -Enable this checkbox in order to submit the below description object along with other options configurable in other sections. Please note, that href as js function and callbackLoad (also js function) will not be passed.')
                    .appendTo(optDescDiv);

                    optDescDiv.append(descrArea);
                    //$('#descriptionObject').unbind('change');
                }

            } 
        });

        // Add submit button
        $('div[id^="sliderDynConfSubDiv"').each(function() {
            var button = $('<button />')
            .css({marginTop: 10, marginBottom: 20})
            .addClass('btn btn-info btn-block')
            .html('SUBMIT NEW OPTIONS')
            .bind('click', submitOptionsForm);

            var wrap = $('<div />')
            .addClass('row');

            $('<div />')
            .addClass(colClass[1] + colW[1])
            .appendTo(wrap);

            $('<div />')
            .addClass(colClass[2] + (colW[2] + colW[3]))
            .append(button)
            .appendTo(wrap);

            $('<div />')
            .addClass(colClass[4] + colW[4])
            .appendTo(wrap);

            $(this).append(wrap);
        });

        printOptions();
    };

    $(document).ready(function() {
        $.fn.ajaxZoomSlider.dynOptions();
        /*
        setTimeout(function() {
            $('#axZmSliderDynConf').toggle()
        }, 1000);
        */
    });

})(jQuery);