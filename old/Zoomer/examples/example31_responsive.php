<!DOCTYPE html>
<html>
<head>
<title>31_responsive</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- Bootstrap is not needed!!! -->
<link rel="stylesheet" href="example_files/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="example_files/css/examples.css" type="text/css">

<!-- jQuery core (any version > 1.8) if not already present. Do not include jQuery twice if alredy loaded. -->
<script type="text/javascript" src="../axZm/plugins/jquery-1.8.3.min.js"></script>

<!-- AJAX-ZOOM main js and css file -->
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link rel="stylesheet" type="text/css" href="../axZm/axZm.css" media="all" />

<!-- AJAX-ZOOM imageSlider extension -->
<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.imageSlider.css" media="all" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageSlider.js"></script>

<!-- Helper plugin to deal with embed-responsive class -->
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.embedResponsive.js"></script>

<!-- Javascript to style the syntax, not needed!!! -->
<link name="az_editor_css_scripts" rel="stylesheet" href="../axZm/plugins/demo/prism/prism.css" type="text/css">
<script type="text/javascript" src="../axZm/plugins/demo/prism/prism.min.js"></script>

<style type="text/css">
    /* copy of bootstraps embed-responsive and embed-responsive-item CSS classes
        if bootstrap or simmilar is included you could use the native classes (without az_) */
    .az_embed-responsive {
        box-sizing: border-box;
        position: relative;
        display: block;
        height: 0;
        padding: 0;
        overflow: hidden;
    }

    .az_embed-responsive-item {
        box-sizing: border-box;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Style of the bullet container located outside of the player */
    #azBulletOutside {
        background-color: #F2D3A2;
        padding-top: 5px;
        padding-bottom: 5px;
        min-height: 30px;
    }

    /* Hard set some styling*/
    #axZm_zoomContainer {
        background-color: #000;
    }
</style>
</head>
<body>

<?php
// This include is just for the demo, you can remove it
if (file_exists(dirname(__FILE__).'/navi.php')) {
    include dirname(__FILE__).'/navi.php';
}
?>
<div style="min-height: 110px; background-color: #B9CC52">
    <h2 style="margin: 0; padding: 25px 10px 10px 10px;">
        jQuery responsive image slider with touch swipe and optional bullet navigation. 
        Confugured with copy & paste JavaScript code editor.
    </h2>
</div>

<!-- Responsive wrapper which uses embed-responsive Bootstrap CSS class -->
<div id="ajaxZoomContainerParent" class="az_embed-responsive">
    <!-- Div where AJAX-ZOOM is loaded into -->
    <div id="azParentContainer" class="az_embed-responsive-item">
        Loading, please wait...
    </div>
</div>

<!-- Container for the bullet navigation located outside of the player -->
<div id="azBulletOutside"></div>

<!-- Init AJAX-ZOOM -->
<script type="text/javascript" id="exampleJs">
    jQuery("#ajaxZoomContainerParent")
    .axZmEmbedResponsive({
        //prc: 50,
        ratio: '2:1', // ratio 2:1 is same as prc 50
        heightLimit: 80, // limit height of the container to 80vh (80% of the screen height),
        maxWidthArr: [{
            maxWidth: 767,
            prc: 60,
            heightLimit: 80
        }]
    });

    jQuery.fn.ajaxZoomSlider({
        axZmPath: 'auto', // Path to the axZm folder
        divID: 'azParentContainer',
        responsive: true,
        bulletsGravity: 'bottom',
        bulletsPos: 'outside',
        bulletsOutsideCont: '#azBulletOutside',
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

<div style="padding: 10px; background-color: #F2D3A2;">
    <h3 style="margin-top: 0">About</h3>
    <p>The main JavaScript code for image slider was generated with the 
        <a href="example31.php">AJAX-ZOOM slider editor</a>. 
        Additionally, the parent container of the player is sized with the AJAX-ZOOM 
        <code>jQuery.fn.axZmEmbedResponsive</code> plugin. 
        This plugin lets you define any proportion you need, similar to bootstrap embed-responsive css class, 
        but the height will not exceed the height of the screen or any percentage of the screen height set 
        in the jQuery.fn.axZmEmbedResponsive plugin option named "heightLimit" (see code below).
    </p>
</div>

<div style="padding: 10px;">
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

<style type="text/css">
    /* copy of bootstraps embed-responsive and embed-responsive-item CSS classes
        if bootstrap or simmilar is included you could use the native classes (without az_) */
    .az_embed-responsive {
        box-sizing: border-box;
        position: relative;
        display: block;
        height: 0;
        padding: 0;
        overflow: hidden;
    }

    .az_embed-responsive-item {
        box-sizing: border-box;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Style of the bullet container located outside of the player */
    #azBulletOutside {
        background-color: #F2D3A2;
        padding-top: 5px;
        padding-bottom: 5px;
        min-height: 30px;
    }

    /* Hard set some styling*/
    #axZm_zoomContainer {
        background-color: #000;
    }
</style>
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
<!-- Responsive wrapper which uses embed-responsive Bootstrap CSS class -->
<div id="ajaxZoomContainerParent" class="az_embed-responsive">
    <!-- Div where AJAX-ZOOM is loaded into -->
    <div id="azParentContainer" class="az_embed-responsive-item">
        Loading, please wait...
    </div>
</div>

<!-- Container for the bullet navigation located outside of the player -->
<div id="azBulletOutside"></div>
    ');
    echo '</code></pre>';
    ?>
    </div>

    <h3>Javascript</h3>
    <p>This code was setup by the editor mentioned above.
    </p>
    <div style="clear: both; margin: 5px 0px 5px 0px;">
        <pre><code class="language-js" id="exampleJsPrism"></code></pre>
        <script>
            // this is only for demo to show js code
            $('#exampleJsPrism').html($('#exampleJs').html());
        </script>
    </div>
</div>

</body>
</html>