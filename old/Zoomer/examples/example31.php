<!DOCTYPE html>
<html>
<head>
<title>31</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- jQuery core (any version > 1.8) if not already present. Do not include jQuery twice if alredy loaded. -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM main js and css file -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link rel="stylesheet" type="text/css" href="../axZm/axZm.css" />

<!-- AJAX-ZOOM imageSlider extension -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.imageSlider.css" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageSlider.js"></script>

<!-- Only needed for the online configurator -->
<script type="text/javascript" src="../axZm/plugins/JSON/jquery.json-2.3.min.js"></script>
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageSliderEditor.js"></script>

<!-- Javascript to style the syntax, not needed! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

</head>
<body>
<?php
// This include is just for the demo, you can remove it
if (file_exists(dirname(__FILE__).'/navi.php')) {
    include dirname(__FILE__).'/navi.php';
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                jQuery Image Slider with Touch Swipe, Image Zoom & Pan, fullscreen view, dynamic options configurator etc.
            </h1>
        </div>
        <div class="col-md-12">
            <div id="azBulletOutside"></div>
        </div>
        <div class="col-md-12">
            <div id="axZmPlayerOuter" class="embed-responsive" style="padding-bottom: 50%;">
                <!-- Placeholder for AJAX-ZOOM player -->
                <div id="axZmPlayerCont" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
                    Loading, please wait...
                </div>
            </div>

            <!-- Init AJAX-ZOOM -->    
            <script type="text/javascript">

            $.fn.ajaxZoomSlider({
                axZmPath: "../axZm/", // Path to the axZm folder
                divID: 'axZmPlayerCont',
                parameter: 'zoomDir=/pic/zoom/trasportation',
                descriptionObject: {
                    'transportation_002.jpg': {
                        descr: 'Audi TT, description can also be a link (click me)', 
                        title: 'Audi TT',
                        href: 'https://www.ajax-zoom.com'
                    },
                    'transportation_003.jpg': {
                        descr: 'Red Biplane, description can be JavaScript function (click me)', 
                        title: 'Red Biplane', 
                        href: function(){
                            alert('This image filename is '+$.axZm.zoomGA[$.axZm.zoomID]["img"]+'\nand it\'s dimensions are '+$.axZm.zoomGA[$.axZm.zoomID]["ow"]+'x'+$.axZm.zoomGA[$.axZm.zoomID]["oh"]);
                        }
                    },  
                    'transportation_004.jpg' : {descr: 'Hotroad'},
                    'transportation_005.jpg': {
                        descr: 'Mercedes-Benz 300 SL W 198 Image No 1, <span style="color: red; font-size: 12px">description can be css styled</span>',
                        title: '300 SL interior'
                    },
                    'transportation_006.jpg': {
                        descr: 'Mercedes-Benz 300 SL W 198 Image No 2, description can be positioned really anywhere, add certain css classes (e.g. this background), override defaults like maxWidth and bind JavaScript (e.g. click me to remove)', 
                        title: '300 SL front view',
                        gravity: 'center', 
                        addClass: 'axZmPlayerDescrBoxCustom',
                        maxWidth: 450,
                        hideOnZoom: true,
                        href: function(){$('#axZmPlayerDescrBox').remove();}
                    },
                    'transportation_007.jpg': {
                        descr: 'Mercedes-Benz 300 SL W 198 Image No 3, so custom description animations for each frame are possible. This one will also hide on zoom',
                        title: '300 SL rear view',
                        gravity: 'bottom',
                        maxWidth: 300,
                        vertMargin: 60,
                        addClass: 'axZmPlayerDescrBoxCustom',
                        slideInFrom: 'top',
                        animationInTime: 1500,
                        slideInEasing: 'easeOutBounce',
                        hideOnZoom: true,
                        callbackLoad: function(){}
                    },
                    'transportation_008.jpg': {
                        descr: 'Mercedes-Benz 300 SL W 198 Image No 4',
                        title: '300 SL steering wheel'
                    },
                    'transportation_009.jpg': {descr: 'Mini Cooper'}
                }
            });
            </script>

        </div>
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" onclick="jQuery('#axZmSliderDynConf').slideToggle(); $(this).blur();" 
                style="margin-top: 15px; margin-bottom: 15px;">
                Toggle options categories and generate copy & paste JavaScript
            </button>
        </div>
        <div class="col-md-12">
            <div id="axZmSliderDynConf" style="display: block">
                <h3 class="clearfix">Use the options below to configure the image slider.
                    <button class="btn btn-default btn-sm pull-right" onclick="jQuery('[id*=sliderDynConfSubDiv]').slideToggle(); jQuery(this).blur();">
                        <i class="fa fa-th-list"></i> Toggle all tabs
                    </button>
                </h3>
            </div>

            <div id="axZmSliderDynConfWrap" style="padding-top: 20px;"></div>

            <h3>Generated copy & paste JavaScript code</h3>
            <p>This code below is updated dynamically when you use the options configurator. 
                Please find the desciptions of each option in the configurator: <br>
                <a href="https://www.ajax-zoom.com/examples/example30.php" rel="nofollow">https://www.ajax-zoom.com/examples/example30.php</a>
            </p>
            <div id="axZmSliderDynConfHTML">
                <div id="axZmSliderDynConfPrint"></div>
            </div>
        </div>

        <div class="col-md-12">
            <h3>About</h3>
             <p>This jQuery image slider is a wrapper and extension of AJAX-ZOOM jQuery plugin. 
                Considering what you see above as just another image slider out of many on internet, the WOW effect is certainly 
                its ability to dynamically zoom into images of virtually any dimensions and file sizes. 
                Also the fullscreen option, as well as touch device compatibility with pinch zoom and touch swipe make it unique. 
                Please note that the original sized image never loads into cache. Only the portion of the image being zoomed.
            </p>
            <p>All elements like buttons, bullet navigation, description etc. 
                can be disabled and positioned anywhere over the image or besides just by setting an option 
                in jQuery plugin manner or with the online configurator. 
                Most CSS is defined in a separate file. The slider extension is open source, commented and can be extended as you like (no overkill js). 
                Most of the options are specific to this slider extension. Some options however are passed directly to AJAX-ZOOM and set its 
                options dynamically over this extension. In fact this is a wrapper for AJAX-ZOOM extended by more custom functionality using AJAX-ZOOM API. 
            </p>
        </div>

        <div class="col-md-12">
            <!-- Code head -->
            <h3>JavaScript & CSS files in Head</h3>
            <div style="clear:both; margin: 5px 0px 5px 0px;">
            <?php
            echo '<pre><code class="language-markup">';
            echo htmlspecialchars ('
<!-- AJAX-ZOOM main js and css file -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link rel="stylesheet" type="text/css" href="../axZm/axZm.css" />

<!-- AJAX-ZOOM imageSlider extension -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.imageSlider.css" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageSlider.js"></script>
            ');
            echo '</code></pre>';
            ?>
            </div>

            <!-- Code body -->
            <h3>HTML markup</h3>
            <div style="clear:both; margin: 5px 0px 5px 0px;">
            <?php
            echo '<pre><code class="language-markup">';
            echo htmlspecialchars ('
<div id="axZmPlayerOuter" class="embed-responsive" style="padding-bottom: 50%;">
    <!-- Placeholder for AJAX-ZOOM player -->
    <div id="axZmPlayerCont" class="embed-responsive-item" style="max-height: 94vh; max-height: calc(100vh - 50px);">
        Loading, please wait...
    </div>
</div>
            ');
            echo '</code></pre>';
            ?>
            </div>

            <h3>Javascript</h3>
            <div style="clear:both; margin: 5px 0px 5px 0px;">
                <pre><code class="language-js" id="exampleJsPrism">
/*
See generated JavaScript code above!
*/
                </code></pre>
            </div>
        </div>

        <div class="col-md-12">

        </div>
    </div>
</div>

</body>
</html>