<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomConfigCustom.inc.php
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 5.4.0
* Date: 2019-06-01
* Review: 2019-07-21
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs


////////////////////////////////////////////////////////////////
////////////////// Configuration settings //////////////////////
////////////////////////////////////////////////////////////////

If you want to know more about how you can set configuration settings and where,
please see here:

https://www.ajax-zoom.com/index.php?cid=blog&article=options_config&lang=en
*/

if (!isset($axZmH)) {
    exit;
}

////////////////////////////////////////////////////////////////
////////// you can copy / uncomment some options here //////////
////////////////////////////////////////////////////////////////
// $zoom['config']['licenceKey'] = 'demo';
// $zoom['config']['licenceType'] = 'Basic';
// $zoom['config']['iMagick'] = true;
// $zoom['config']['imPath'] = '/usr/bin/convert';
// $zoom['config']['memory_limit'] = '8512M';

/*
$zoom['config']['licenses'] = array(
    'yourDomainName.com' => array(
        'licenceType' => 'Basic',
        'licenceKey' => 'demo'
    ),
    'otherDomainName.com' => array(
        'licenceType' => 'Basic',
        'licenceKey' => 'demo'
    )
);
*/

if ($_GET['example'] == 1) {
    // example2.php
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
    $zoom['config']['useGallery'] = true;
    $zoom['config']['fullScreenApi'] = true;
}

elseif ($_GET['example'] == 2) {
    // example2.php, example26.php
    $zoom['config']['galleryFullPicDim'] = '100x100';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['help'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
    $zoom['config']['fullScreenApi'] = true;
    $zoom['config']['gallerySlideNavi'] = false;
}

elseif ($_GET['example'] == 3) {
    // example2.php
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
    $zoom['config']['useGallery'] = true;
    $zoom['config']['fullScreenApi'] = true;
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['help'] = true;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = true;
    $zoom['config']['zoomMapAnimate'] = true;
    $zoom['config']['zoomMapVis'] = true;
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryLines'] = 3;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 4) {
    // example3.php
    $zoom['config']['themeCss'] = 'grey';
    $zoom['config']['buttonSet'] = 'default';
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = true;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
    $zoom['config']['useGallery'] = true;
}

elseif ($_GET['example'] == 5) {
    // example3.php
    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['galFullAutoStart'] = true;
    $zoom['config']['help'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
}

elseif ($_GET['example'] == 6) {
    // example3.php
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['help'] = true;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = true;
    $zoom['config']['zoomMapAnimate'] = true;
    $zoom['config']['zoomMapVis'] = true;
    $zoom['config']['galleryPicDim'] = '70x70';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryLines'] = 3;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 7) {
    // example3.php
    $zoom['config']['naviPos'] = 'top';
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['useHorGallery'] = true;
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['help'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapAnimate'] = true;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 8) {
    // example4.php
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom['config']['galleryFullPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['cornerRadius'] = 5;
    $zoom['config']['cornerRadiusNotRound'] = true;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = true;
    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['useGallery'] = true;
    $zoom['config']['fullScreenVertGallery'] = true;
    
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;

    // buttons
    $zoom['config']['zoomLogInfoDisabled'] = true;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['galleryNaviPos'] = 'bottom';
    $zoom['config']['naviPanButSwitch'] = true;
    $zoom['config']['naviCropButSwitch'] = true;
    $zoom['config']['naviZoomBut'] = true;
    $zoom['config']['naviBigZoom'] = true;
    $zoom['config']['naviPanBut'] = false;
    $zoom['config']['naviRestoreBut'] = true;
    $zoom['config']['naviHotspotsBut'] = false;
    $zoom['config']['galFullButton'] = true;
    $zoom['config']['fullScreenNaviButton'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['downloadButton'] = false;
    $zoom['config']['help'] = false;
}

elseif ($_GET['example'] == 9) {
    // example8.php, example11.php
    $zoom['config']['themeCss'] = 'white';
    $zoom['config']['buttonSet'] = 'transparent';
    $zoom['config']['help'] = false;
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviGroupSpace'] = 10;

    $zoom['config']['useGallery'] = false;
    $zoom['config']['galleryPos'] = 'left';
    $zoom['config']['galleryPicDim'] = '70x70';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryFullPicDim'] = '70x70';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['galleryNaviPos'] = 'bottom';
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['naviMinPadding'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['mapButton'] = false;
    $zoom['config']['fullScreenNaviButton'] = false;
    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
}

elseif ($_GET['example'] == 'new9') {
    // example7.php
    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['zoomSliderHorizontal'] = true;
    $zoom['config']['zoomSliderPosition'] = 'bottom';
    $zoom['config']['zoomSliderMarginV'] = 10;

    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['displayNavi'] = false;

    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['mapBorder']['top'] = 0;
    $zoom['config']['mapBorder']['right'] = 0;
    $zoom['config']['mapBorder']['bottom'] = 0;
    $zoom['config']['mapBorder']['left'] = 0;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['mapWidth'] = 50;
    $zoom['config']['mapHeight'] = 70;
    $zoom['config']['fullScreenMapFract'] = 0.2;
    $zoom['config']['mapSelSmoothDrag'] = false;

    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['galleryFadeInSize'] = 1;
    $zoom['config']['galleryFadeInSpeed'] = 300;
    $zoom['config']['galleryFadeInOpacity'] = 0.5;

    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;

    $zoom['config']['useGallery'] = false;
    $zoom['config']['galleryFullPicDim'] = '90x90';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['fullScreenVertGallery'] = true;
}

elseif ($_GET['example'] == 10) {
    // example1.php (not responsive)
    $zoom['config']['picDim'] = '600x400';
    $zoom['config']['simpleMode'] = false;
    $zoom['config']['themeCss'] = 'black';
    $zoom['config']['buttonSet'] = 'default';

    $zoom['config']['visualConf'] = true;
    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['simpleMode'] = false;

    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
    $zoom['config']['useGallery'] = true;

    $zoom['config']['cropNoObj'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    // do not load image tiles directly block
    $zoom['config']['pyrLoadTiles'] = false;
    $zoom['config']['pyrQual'] = 100;
    $zoom['config']['pyrTilesPath'] = '/pic/zoomtiles/';
    $zoom['config']['zoomDragSpeed'] = 500;
    $zoom['config']['zoomDragAjax'] = 1000;

    $zoom['config']['gallerySlideNavi'] = false;
}

elseif ($_GET['example'] == 11) {
    // example9.php
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['useGallery'] = false;

    $zoom['config']['useHorGallery'] = true;
    $zoom['config']['galHorPosition'] = 'bottom2';
    $zoom['config']['galHorOpt']['btn'] = false;
    $zoom['config']['galHorCssDescrPadding'] = 0;

    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['naviBigZoom'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['help'] = false;

    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['dragMap'] = false;

    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['zoomSliderHeight'] = 100;
    $zoom['config']['zoomSliderHandleSize'] = 11;
    $zoom['config']['zoomSliderWidth'] = 5;
    $zoom['config']['zoomSliderMarginH'] = 10;
    $zoom['config']['zoomSliderPosition'] = 'right';
    $zoom['config']['zoomSliderMouseOver'] = true;

    // Step zoom
    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 'clb') {
    // example14.php
    $zoom['config']['themeCss'] = 'black';
    $zoom['config']['buttonSet'] = 'default';
    $zoom['config']['useFullGallery'] = true;
    $zoom['config']['useGallery'] = false;

    $zoom['config']['useHorGallery'] = true;
    $zoom['config']['galHorPosition'] = 'bottom2';
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
    $zoom['config']['naviBigZoom'] = true;
    $zoom['config']['galleryNavi'] = true;
    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['help'] = false;

    $zoom['config']['zoomMapVis'] = true;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['dragMap'] = false;

    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['zoomSliderHeight'] = 100;
    $zoom['config']['zoomSliderHandleSize'] = 11;
    $zoom['config']['zoomSliderWidth'] = 5;
    $zoom['config']['zoomSliderMarginH'] = 10;
    $zoom['config']['zoomSliderPosition'] = 'right';
    $zoom['config']['zoomSliderMouseOver'] = true;

    // Step zoom
    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;

    if (isset($_GET['3dDir'])) {
        $zoom['config']['useHorGallery'] = false;
        $zoom['config']['spinSlider'] = false;
    }
}

elseif ($_GET['example'] == 12) {
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['help'] = false;
    $zoom['config']['galleryPicDim'] = '70x70';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryNavi'] = false;

    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['cornerRadius'] = 5;
    $zoom['config']['innerMargin'] = 5;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['naviBigZoom'] = false;
}

elseif ($_GET['example'] == 13) {
    $zoom['config']['galHorPosition'] = 'bottom2';
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['help'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['zoomMapContainment'] = 'body';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['naviBigZoom'] = false;
    $zoom['config']['zoomLoaderEnable'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 'testZoomTo') {
    // example10.php
    $zoom['config']['themeCss'] = 'black';
    $zoom['config']['buttonSet'] = 'default';
    $zoom['config']['galHorPosition'] = 'bottom2';
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['help'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['zoomMapContainment'] = 'body';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['naviBigZoom'] = false;
    $zoom['config']['zoomLoaderEnable'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;

    $zoom['config']['useMap'] = true;
    $zoom['config']['touchSettings']['useMap'] = true;
}

elseif ($_GET['example'] == 14) {
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['galleryPos'] = 'left';

    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryFullPicDim'] = '75x60';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['galleryNaviPos'] = 'bottom';
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 5;
    $zoom['config']['innerMargin'] = 5;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 15) {
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['mapPos'] = 'bottomRight';
    $zoom['config']['galleryPos'] = 'left';
    $zoom['config']['naviFloat'] = 'left';
    $zoom['config']['galleryLines'] = 4;
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryNavi'] = true;
    $zoom['config']['galleryNaviPos'] = 'navi';
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 5;
    $zoom['config']['innerMargin'] = 5;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 16) {
    $zoom['config']['useGallery'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['help'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = true;
    $zoom['config']['dragMap'] = false;
}

// 3D Zoom & Spin
elseif ($_GET['example'] == 17) {
    // example2.php, example3.php, example15.php, example15_clean.php, example15_fullscreen.php, example15_gallery_clean.php
    // example15_responsive.php, example15_vr9.php
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = true;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['galleryNoThumbs'] = true;
    $zoom['config']['firstMod'] = 'spin';
    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['naviPanBut'] = false;
}

elseif ($_GET['example'] == 18) {
    // example16.php
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['zoomSliderPosition'] = 'topLeft';
    $zoom['config']['zoomSliderMarginV'] = 10;
    $zoom['config']['zoomSliderMarginH'] = 10;
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['mapParent'] = 'mapContainer';
    $zoom['config']['mapParCenter'] = false;
    $zoom['config']['mapWidth'] = 160;
    $zoom['config']['mapHeight'] = 240;
    $zoom['config']['mapSelSmoothDrag'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['mapBorder']['top'] = 1;
    $zoom['config']['mapBorder']['right'] = 1;
    $zoom['config']['mapBorder']['bottom'] = 1;
    $zoom['config']['mapBorder']['left'] = 1;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['galleryFadeInSize'] = 1;
    $zoom['config']['galleryFadeInSpeed'] = 300;
    $zoom['config']['galleryFadeInOpacity'] = 0.5;
    $zoom['config']['galleryFadeInAnm'] = 'Right';
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 19) {
    // example17.php
    $zoom['config']['speedOptSet'] = true;
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['mapParent'] = 'mapContainer';
    $zoom['config']['mapFract'] = 1;
    $zoom['config']['mapSelSmoothDrag'] = false;
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['mapBorder']['top'] = 0;
    $zoom['config']['mapBorder']['right'] = 0;
    $zoom['config']['mapBorder']['bottom'] = 0;
    $zoom['config']['mapBorder']['left'] = 0;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = true;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['gallerySlideNavi'] = false;

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 20) {
    // example18.php
    $zoom['config']['themeCss'] = 'black';
    $zoom['config']['buttonSet'] = 'flat';
    $zoom['config']['displayNavi'] = true;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['useHorGallery'] = true;
    $zoom['config']['fullScreenHorzGallery'] = true;
    $zoom['config']['galleryHorPicDim'] = '50x50';
    $zoom['config']['galHorImgMargin'] = array('top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0);
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'horz');
    $zoom['config']['galleryHorPicDim'] = '100x100'; // double native resolution
    $zoom['config']['galleryHorHideMaxWidth'] = 300;
    $zoom['config']['galleryHorHideMaxHeight'] = 300;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['galleryNaviPos'] = 'bottom';
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['zoomSlider'] = true;
    $zoom['config']['zoomSliderHorizontal'] = true;
    $zoom['config']['zoomSliderPosition'] = 'bottom';
    $zoom['config']['zoomSliderMarginV'] = 20;
    $zoom['config']['gallerySlideNavi'] = true;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['touchSettings']['gallerySlideNavi'] = false;
    $zoom['config']['touchSettings']['gallerySlideNaviOnlyFullScreen'] = false;
}

// Animation
elseif ($_GET['example'] == 21) {
    // example19.php
    $zoom['config']['themeCss'] = 'black';
    $zoom['config']['buttonSet'] = 'default';
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['galleryNoThumbs'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['useHorGallery'] = true;
    $zoom['config']['galleryHorPicDim'] = '50x50';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'horz');

    $zoom['config']['galHorOpt']['btn'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['firstMod'] = 'spin';

    $zoom['config']['spinToMotion'] = 'easeOutQuad';
    $zoom['config']['spinDemoTime'] = 4000;
    $zoom['config']['naviSpinButSwitch'] = false;
    $zoom['config']['naviTopMargin'] = 0;
    $zoom['config']['cueFrames'] = false;

    $zoom['config']['galleryHorHideMaxHeight'] = false;
}

elseif ($_GET['example'] == 22) {
    $zoom['config']['mapWidth'] = 250;
    $zoom['config']['mapHeight'] = false;
    $zoom['config']['mapParent'] = 'mapContainer';
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['mapFract'] = 0.7;
    $zoom['config']['restoreSpeed'] = 1;
    $zoom['config']['zoomMapSwitchSpeed'] = 1;
    $zoom['config']['galleryInnerFade'] = false;
    $zoom['config']['galleryFadeInSpeed'] = 1;
    $zoom['config']['galleryFadeOutSpeed'] = 1;
    $zoom['config']['pZoom'] = 25;
    $zoom['config']['pZoomOut'] = 25;
    $zoom['config']['mapSelSmoothDrag'] = false;
    $zoom['config']['autoZoom']['enabled'] = true;
    $zoom['config']['autoZoom']['onlyFirst'] = false;
    $zoom['config']['autoZoom']['speed'] = 1;
    $zoom['config']['autoZoom']['motion'] = 'swing';
    $zoom['config']['autoZoom']['pZoom'] = 'max';
    $zoom['config']['galleryNoThumbs'] = false;
    $zoom['config']['galleryFullPicDim'] = '62x62';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['mapBorder']['top'] = 0;
    $zoom['config']['mapBorder']['right'] = 0;
    $zoom['config']['mapBorder']['bottom'] = 0;
    $zoom['config']['mapBorder']['left'] = 0;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    $zoom['config']['allowDynamicThumbs'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['mapMouseOver'] = true;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 25;
    $zoom['config']['scrollSpeed'] = 500;
}

elseif ($_GET['example'] == 'mouseOverTiles') {
    // example20.php
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['restoreSpeed'] = 1;
    $zoom['config']['zoomMapSwitchSpeed'] = 1;

    $zoom['config']['galleryInnerFade'] = false;
    $zoom['config']['galleryFadeInSpeed'] = 1;
    $zoom['config']['galleryFadeOutSpeed'] = 1;

    $zoom['config']['pZoom'] = 25;
    $zoom['config']['pZoomOut'] = 25;
    $zoom['config']['mapSelSmoothDrag'] = false;

    $zoom['config']['galleryNoThumbs'] = false;
    $zoom['config']['galleryFullPicDim'] = '62x62';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['useGallery'] = false;

    //$zoom['config']['fullScreenVertGallery'] = true;
    $zoom['config']['fullScreenHorzGallery'] = true;

    $zoom['config']['mapBorder']['top'] = 0;
    $zoom['config']['mapBorder']['right'] = 0;
    $zoom['config']['mapBorder']['bottom'] = 0;
    $zoom['config']['mapBorder']['left'] = 0;

    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    $zoom['config']['allowDynamicThumbs'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 23) {
    // example22.php, example22_new.php, example27.php, example30.php
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['mapSelSmoothDrag'] = false;
    $zoom['config']['galHorOpt']['btn'] = false;
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['galleryFullPicDim'] = '120x120';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['galFullAutoStart'] = true;
    $zoom['config']['galleryPicDim'] = '100x100';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['galleryFadeInSize'] = 1;
    $zoom['config']['zoomFadeIn'] = 1000;
    $zoom['config']['galleryFadeInSpeed'] = 1000;
    $zoom['config']['galleryFadeInOpacity'] = 0.0;
    $zoom['config']['galleryFadeInAnm'] = 'Center';
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['fullScreenMapFract'] = false;
    $zoom['config']['fullScreenMapWidth'] = false;
    $zoom['config']['fullScreenMapHeight'] = 120;
    $zoom['config']['galleryNavi'] = false;

    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['mNavi']['enabled'] = true;
    $zoom['config']['mNavi']['offsetVertFS'] = 10;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['order'] = array(
        'mZoomIn' => 5,
        'mZoomOut' => 0
    );
    $zoom['config']['fullScreenVertGallery'] = true;
    $zoom['config']['useGallery'] = true;
}

elseif ($_GET['example'] == 24) {
    // example23.php
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['mapSelSmoothDrag'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['help'] = false;
    $zoom['config']['fullScreenNaviButton'] = false;
    $zoom['config']['fullScreenCornerButton'] = false;
    $zoom['config']['fullScreenExitText'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;
}

elseif ($_GET['example'] == 25) {
    // example25.php
    $zoom['config']['themeCss'] = 'black';
    $zoom['config']['buttonSet'] = 'default';

    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['help'] = false;

    $zoom['config']['useGallery'] = true;
    $zoom['config']['fullScreenVertGallery'] = true;
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['galleryHideMaxWidth'] = 801;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = false;
    $zoom['config']['gallerySlideNaviMargin'] = 5;

    $zoom['config']['galleryLines'] = 2;
    $zoom['config']['galleryImgMargin'] = array('top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0);
    $zoom['config']['galleryWidthAdjust'] = 0;
    $zoom['config']['galleryNavi'] = true;
    $zoom['config']['galleryNaviPos'] = 'navi';

    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['naviBigZoom'] = true;
    $zoom['config']['galleryFadeInAnm'] = 'Right';
    $zoom['config']['galleryFadeInSize'] = 1;
    $zoom['config']['zoomSliderPosition'] = 'topLeft';
    $zoom['config']['zoomSliderMarginV'] = 150;

    $zoom['config']['useHorGallery'] = false;
    $zoom['config']['galHorPosition'] = 'bottom2';
    $zoom['config']['galHorPadding'] = array('top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0);
    $zoom['config']['fullScreenApi'] = true;

    // Quickly overwrite thumb style (e.g. width and height) without changing css file or write inline styles
    $zoom['config']['galleryOpt']['thumbLiStyle'] = array(
        'width' => ($axZmH->getf('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['left'] + $zoom['config']['galleryImgMargin']['right']).'px',
        'height' => ($axZmH->getl('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom']).'px',
        'lineHeight' => ($axZmH->getl('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom'] - 2).'px',
        'borderWidth' => 0,
        'marginTop' => 6,
        'marginBottom' => 6,
        'marginLeft' => 6,
        'marginRight' => 6
    );

    $zoom['config']['galleryOpt']['thumbImgStyle'] = array(
        'maxHeight' => ($axZmH->getf('x',$zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['left'] + $zoom['config']['galleryImgMargin']['right']).'px',
        'maxWidth' => ($axZmH->getl('x',$zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom']).'px'
    );
}

elseif ($_GET['example'] == 'spinIpad') {
    // example2.php, example13.php, example27.php, example28.php, example28_clean.php, example33_clean.php,
    // example33_fullscreen.php, example33_responsive.php, example35_adaptive.php, example35_clean.php,
    // example35_clean_horizontal.php, example35_gallery.php, example35_responsive.php
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['galleryNoThumbs'] = true;
    $zoom['config']['firstMod'] = 'spin';
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['spinSlider'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['mNavi']['enabled'] = true;
    $zoom['config']['mNavi']['ellementRows'] = 1;
    $zoom['config']['mNavi']['offsetVertFS'] = 10;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['mouseOver'] = false;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['order'] = array(
        'mPan' => 5,
        'mSpin' => 0
    );

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;

    if (isset($_GET['zoomDir']) || isset($_GET['zoomData'])) {
        $zoom['config']['useFullGallery'] = true;
        $zoom['config']['galleryNoThumbs'] = false;
        $zoom['config']['galleryFullPicDim'] = '200x200';
        $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

        $zoom['config']['zoomMapSwitchSpeed'] = 0;
        $zoom['config']['restoreSpeed'] = 300;
        $zoom['config']['pyrTilesFadeInSpeed'] = 200;
        $zoom['config']['pyrTilesFadeLoad'] = 200;
        $zoom['config']['galleryFadeOutSpeed'] = 0;
        $zoom['config']['galleryFadeInSpeed'] = 100;
        $zoom['config']['galleryInnerFade'] = 100;
        $zoom['config']['galleryInnerFadeCut'] = 100;
        $zoom['config']['galleryFadeInSize'] = 1;
        $zoom['config']['zoomFadeIn'] = 100;
        $zoom['config']['gallerySlideSwipeSpeed'] = 400;
    }
}

elseif ($_GET['example'] == 'spinAnd2D') {
    // example24.php, example29.php, example29_clean.php, example29_fullscreen.php, example29_responsive.php
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['mapBorder']['top'] = 1;
    $zoom['config']['mapBorder']['right'] = 1;
    $zoom['config']['mapBorder']['bottom'] = 1;
    $zoom['config']['mapBorder']['left'] = 1;
    $zoom['config']['mapFract'] = 0.20;
    $zoom['config']['zoomShowButtonDescr'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['galleryNoThumbs'] = true;
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['mNavi']['enabled'] = true;
    $zoom['config']['mNavi']['ellementRows'] = 1;
    $zoom['config']['mNavi']['offsetVertFS'] = 10;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['alt']['enabled'] = false;
    $zoom['config']['mNavi']['order'] = array(
        'mPan' => 5,
        'mSpin' => 0
    );

    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['spinSlider'] = false;
    $zoom['config']['gallerySlideNavi'] = false;

    // 360 settings
    if (isset($_GET['image360']) || isset($_GET['3dDir'])) {
        $zoom['config']['spinMod'] = true;
        $zoom['config']['firstMod'] = 'spin';
    } else {
        $zoom['config']['mNavi']['order'] = array();
        $zoom['config']['mNavi']['orderDefault'] = array();
    }

    $zoom['config']['spinWhilePreload'] = false;
    /*
    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
    */
}

elseif ($_GET['example'] == 'spinAnd2D_easy') {
    // example29_responsive_easy.php
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['mapBorder']['top'] = 1;
    $zoom['config']['mapBorder']['right'] = 1;
    $zoom['config']['mapBorder']['bottom'] = 1;
    $zoom['config']['mapBorder']['left'] = 1;
    $zoom['config']['mapFract'] = 0.20;
    $zoom['config']['zoomShowButtonDescr'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['galleryNoThumbs'] = true;
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['mNavi']['enabled'] = true;
    $zoom['config']['mNavi']['ellementRows'] = 1;
    $zoom['config']['mNavi']['offsetVertFS'] = 10;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['mouseOver'] = false;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['alt']['enabled'] = false;
    $zoom['config']['mNavi']['order'] = array(
        'mReset' => 0
    );

    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['spinSlider'] = false;
    $zoom['config']['gallerySlideNavi'] = false;

    // 360 settings
    if (isset($_GET['image360']) || isset($_GET['3dDir'])) {
        $zoom['config']['spinMod'] = true;
        $zoom['config']['firstMod'] = 'spin';
        $zoom['config']['icons']['mReset'] = array('file'=>'button_iPad_spin', 'ext'=>'png', 'w'=>'{mWidth}', 'h'=>'{mHeight}');
    } else {
        $zoom['config']['mNavi']['order'] = array(
            'mReset' => 0
        );
    }

    $zoom['config']['touchSettings'] = array(
        'zoomDoubleClickTap' => 350,
        'tapHideAll' => false,
        'useMap' => false,
        'zoomSlider' => false,
        'spinSlider' => false,
        'zoomOutClick' => true
    );

    $zoom['config']['scroll'] = true;
    $zoom['config']['mouseScrollEnable'] = false;

    $zoom['config']['pZoom'] = 999999;
    $zoom['config']['pZoomOut'] = 999999;
    $zoom['config']['forceToPan'] = false;
    $zoom['config']['zoomOutClick'] = true;
    $zoom['config']['zoomSpeed'] = 500;
    $zoom['config']['zoomOutSpeed'] = 500;
    $zoom['config']['restoreSpeed'] = 500;

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 'modal') {
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['useGallery'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['galleryNoThumbs'] = true;
    $zoom['config']['firstMod'] = 'spin';
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['spinSlider'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['gallerySlideNavi'] = true;
    $zoom['config']['gallerySlideNaviMargin'] = 5;
    $zoom['config']['mapButTitle']['slideNext'] = '';
    $zoom['config']['mapButTitle']['slidePrev'] = '';
    $zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
    $zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);

    $zoom['config']['fullScreenCornerButtonMouseOver'] = true;

    /*
    $zoom['config']['fullScreenCornerButtonPos'] = 'topRight';
    $zoom['config']['fullScreenCornerButtonMarginX'] = 0;
    $zoom['config']['fullScreenCornerButtonMarginY'] = 10;
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc1_init', 'ext'=>'png', 'w'=>42, 'h'=>42);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc1_restore', 'ext'=>'png', 'w'=>42, 'h'=>42);
    */

    $zoom['config']['mapButTitle']['fullScreenCornerInit'] = '';
    $zoom['config']['mapButTitle']['fullScreenCornerRestore'] = '';

    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['mNavi']['ellementRows'] = 1;
    $zoom['config']['mNavi']['offsetVertFS'] = 10;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['mouseOver'] = false;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['order'] = array();
    $zoom['config']['mNavi']['orderDefault'] = array();

    if (isset($_GET['3dDir'])) {
        $zoom['config']['dragToSpin']['enabled'] = true;

        $zoom['config']['spinSlider'] = false;

        $zoom['config']['mNavi']['enabled'] = true;
        $zoom['config']['mNavi']['order'] = array(
            'mPan' => 5,
            'mSpin' => 0
        );

        $zoom['config']['spinPreloaderSettings']['text'] = ' ';
        $zoom['config']['spinPreloaderSettings']['width'] = '100%';
        $zoom['config']['spinPreloaderSettings']['height'] = 7;
        $zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom';
        $zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0;
        $zoom['config']['spinPreloaderSettings']['borderW'] = 0;
        $zoom['config']['spinPreloaderSettings']['margin'] = 5;
        $zoom['config']['spinPreloaderSettings']['countMsg'] = false;
        $zoom['config']['spinPreloaderSettings']['statusMsg'] = false;
        $zoom['config']['spinPreloaderSettings']['barH'] = 7;
        $zoom['config']['spinPreloaderSettings']['barOpacity'] = 1;
    }

    // 4.2.1
    if (isset($_GET['disableScrollAnm']) && $_GET['disableScrollAnm'] == 'true') {
        $zoom['config']['scrollAnm'] = false;
        $zoom['config']['scrollZoom'] = 11;
        $zoom['config']['scrollAjax'] = 200;
        $zoom['config']['pyrTilesFadeInSpeed'] = 300;
        $zoom['config']['pyrTilesFadeLoad'] = 300;
    }
}

elseif ($_GET['example'] == 'imageSlider') {
    // example31.php, example31_responsive.php
    $zoom['config']['useGallery'] = false;

    $zoom['config']['mNavi']['enabled'] = false;

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['galleryFullPicDim'] = '170x100';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    if (isset($_GET['autoPlay']) && $_GET['autoPlay'] == 'true') {
        $zoom['config']['galleryAutoPlay'] = true;
    }

    if (isset($_GET['playPauseInterval']) && intval($_GET['playPauseInterval'])) {
        $zoom['config']['galleryPlayInterval'] = intval($_GET['playPauseInterval']);
    }

    $zoom['config']['fullScreenEnable'] = false;

    if (isset($_GET['fullScreen']) && $_GET['fullScreen'] != 'false') {
        $zoom['config']['fullScreenEnable'] = true;
        $zoom['config']['fullScreenCornerButton'] = true;
        $zoom['config']['fullScreenCornerButtonPos'] = $_GET['fullScreen'];
    }

    if (isset($_GET['openAsFullscreen']) && $_GET['openAsFullscreen'] == 'true') {
        $zoom['config']['fullScreenEnable'] = true;
        $zoom['config']['fullScreenExitText'] = false;
        $zoom['config']['fullScreenCornerButton'] = false;
    }

    $zoom['config']['help'] = false;
    $zoom['config']['zoomLoaderEnable'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['galleryFadeInAnm'] = 'SwipeHorz';
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    // zoomSlider
    $zoom['config']['zoomSliderContainerPadding'] = 10;
    if (isset($_GET['zoomSliderPos']) && $_GET['zoomSliderPos'] != 'false') {
        $zoom['config']['zoomSlider'] = true;
    }

    // Prev/Next arrows
    $zoom['config']['gallerySlideNavi'] = isset($_GET['prevNextArrows']) && $_GET['prevNextArrows'] == 'true' ? true : false;
    $zoom['config']['gallerySlideNaviMouseOver'] = isset($_GET['prevNextArrowsAutoHide']) && $_GET['prevNextArrowsAutoHide'] == 'true' ? true : false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = false;
    $zoom['config']['icons']['slideNext'] = array('file' => 'zoombutton_slide_vert_next', 'ext' => 'png', 'w' => 20, 'h' => 100);
    $zoom['config']['icons']['slidePrev'] = array('file' => 'zoombutton_slide_vert_prev', 'ext' => 'png', 'w' => 20, 'h' => 100);

    /*
    $zoom['config']['fullScreenCornerButtonMarginX'] = 0;
    $zoom['config']['fullScreenCornerButtonMarginY'] = 0;
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc4_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc4_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
    */
}

// example32_v3.php, example32_v4.php
elseif ($_GET['example'] == 'mouseOverExtension360') {
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    /*
    $zoom['config']['fullScreenCornerButtonPos'] = 'topRight';
    $zoom['config']['fullScreenCornerButtonMarginX'] = 5;
    $zoom['config']['fullScreenCornerButtonMarginY'] = 10;
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc1_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc1_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
    */

    $zoom['config']['useMap'] = false;
    $zoom['config']['dragMap'] = false;

    // disable all galleries
    $zoom['config']['useGallery'] = false;
    $zoom['config']['fullScreenVertGallery'] = false;
    $zoom['config']['useHorGallery'] = false;
    $zoom['config']['fullScreenHorzGallery'] = false;
    $zoom['config']['useFullGallery'] = false;

    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['speedOptSet'] = true;

    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['firstMod'] = 'spin';

    $zoom['config']['spinSlider'] = false;

    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
    $zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);

    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    $zoom['config']['dragToSpin']['enabled'] = true;

    $zoom['config']['spinPreloaderSettings']['text'] = ' ';
    $zoom['config']['spinPreloaderSettings']['width'] = '100%';
    $zoom['config']['spinPreloaderSettings']['height'] = 7;
    $zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom';
    $zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0;
    $zoom['config']['spinPreloaderSettings']['borderW'] = 0;
    $zoom['config']['spinPreloaderSettings']['margin'] = 5;
    $zoom['config']['spinPreloaderSettings']['countMsg'] = false;
    $zoom['config']['spinPreloaderSettings']['statusMsg'] = false;
    $zoom['config']['spinPreloaderSettings']['barH'] = 7;
    $zoom['config']['spinPreloaderSettings']['barOpacity'] = 1;

    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['mNavi']['offsetHorz'] = 5;
    $zoom['config']['mNavi']['offsetVert'] = 5;
    $zoom['config']['mNavi']['offsetVertFS'] = 5;
    $zoom['config']['mNavi']['offsetHorzFS'] = 5;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['onlyFullScreen'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['cssClassFS'] = '';
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['order'] = array(
        'mPan' => 5,
        'mSpin' => 5
    );

    $zoom['config']['forceToPan'] = false;
    $zoom['config']['galleryNoThumbs'] = true;

    if (isset($_GET['disableScrollAnm']) && $_GET['disableScrollAnm'] == 'true') {
        $zoom['config']['scrollAnm'] = false;
        $zoom['config']['scrollZoom'] = 11;
        $zoom['config']['scrollAjax'] = 200;
        $zoom['config']['pyrTilesFadeInSpeed'] = 300;
        $zoom['config']['pyrTilesFadeLoad'] = 300;
    }

    $zoom['config']['buttonSet'] = 'flat';

    $zoom['config']['spinCirclePreloader'] = array(
        'enabled' => true,
        'diameter' => '25%',
        'stroke' => 3,
        'rotate' => 0,
        'prc' => false,
        'prcFontSize' => 0.3,
        'img' => true,
        'imgCover' => false,
        'countMsg' => false,
        'statusMsg' => false,
        'autoStatus' => true,
        'text' => array('en' => 'Loading frames', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L1' => array('en' => 'Preloading image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L2' => array('en' => 'Making pyramid', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L3' => array('en' => 'Making tiles', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L4' => array('en' => 'Making first image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L5' => array('en' => 'and first image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => '')
    );
}

elseif ($_GET['example'] == 'mouseOverExtension') {
    // example5.php, example6.php, example6_cms.php, example21.php, example32_v3.php, example32_v4.php
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['mapSelSmoothDrag'] = false;
    $zoom['config']['galHorOpt']['btn'] = false;
    $zoom['config']['useFullGallery'] = false;

    $zoom['config']['useGallery'] = true;
    $zoom['config']['fullScreenVertGallery'] = false;
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    /*
    $zoom['config']['fullScreenCornerButtonPos'] = 'topRight';
    $zoom['config']['fullScreenCornerButtonMarginX'] = 5;
    $zoom['config']['fullScreenCornerButtonMarginY'] = 10;
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc1_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc1_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
    */

    $zoom['config']['gallerySlideNavi'] = true;
    $zoom['config']['gallerySlideNaviMargin'] = 5;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
    $zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);

    // disable vertical gallery for low screen resolutions
    if (isset($_GET['screenW']) && intval($_GET['screenW']) < 800) {
        $zoom['config']['useGallery'] = false;
        $zoom['config']['fullScreenVertGallery'] = false;
    }

    // disable vertical gallery if there is only one image
    if (isset($_GET['zoomData']) && count(explode('|', $_GET['zoomData'])) < 2) {
        $zoom['config']['useGallery'] = false;
    }

    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['galleryFadeInOpacity'] = 0.0;
    $zoom['config']['galleryFadeInAnm'] = 'Center';
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['fullScreenMapFract'] = false;
    $zoom['config']['fullScreenMapWidth'] = false;
    $zoom['config']['fullScreenMapHeight'] = 120;
    $zoom['config']['galleryNavi'] = false;

    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['speedOptSet'] = true;

    $zoom['config']['mNavi']['enabled'] = true;
    $zoom['config']['mNavi']['offsetHorz'] = 5;
    $zoom['config']['mNavi']['offsetVert'] = 5;
    $zoom['config']['mNavi']['offsetVertFS'] = 5;
    $zoom['config']['mNavi']['offsetHorzFS'] = 5;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['cssClassFS'] = '';
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['order'] = array(
        'mZoomIn' => 5,
        'mZoomOut' => 0
    );

    if (isset($_GET['3dDir'])) {
        $zoom['config']['dragToSpin']['enabled'] = true;

        $zoom['config']['useGallery'] = false;
        $zoom['config']['fullScreenVertGallery'] = false;
        $zoom['config']['useHorGallery'] = false;
        $zoom['config']['fullScreenHorzGallery'] = false;
        $zoom['config']['useFullGallery'] = false;

        $zoom['config']['spinSlider'] = false;

        $zoom['config']['mNavi']['order'] = array(
            'mPan' => 5,
            'mSpin' => 0
        );

        $zoom['config']['spinPreloaderSettings']['text'] = ' ';
        $zoom['config']['spinPreloaderSettings']['width'] = '100%';
        $zoom['config']['spinPreloaderSettings']['height'] = 7;
        $zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom';
        $zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0;
        $zoom['config']['spinPreloaderSettings']['borderW'] = 0;
        $zoom['config']['spinPreloaderSettings']['margin'] = 5;
        $zoom['config']['spinPreloaderSettings']['countMsg'] = false;
        $zoom['config']['spinPreloaderSettings']['statusMsg'] = false;
        $zoom['config']['spinPreloaderSettings']['barH'] = 7;
        $zoom['config']['spinPreloaderSettings']['barOpacity'] = 1;
    }

    if (isset($_GET['disableScrollAnm']) && $_GET['disableScrollAnm'] == 'true') {
        $zoom['config']['scrollAnm'] = false;
        $zoom['config']['scrollZoom'] = 11;
        $zoom['config']['scrollAjax'] = 200;
        $zoom['config']['pyrTilesFadeInSpeed'] = 300;
        $zoom['config']['pyrTilesFadeLoad'] = 300;
    }

    $zoom['config']['buttonSet'] = 'flat';
}

elseif ($_GET['example'] == 'mouseOverExtension360Ver5') {
    // example32.php, example32_axZmMode.php, example32_ecom.php

    $zoom['config']['zoomLoaderEnable'] = true;
    $zoom['config']['zoomLoaderFadeIn'] = 0;
    $zoom['config']['zoomLoaderFadeOut'] = 0;

    /*
    $zoom['config']['zoomLoaderClass'] = 'axZm_zoomLoader_bert';
    $zoom['config']['zoomLoaderFrames'] = 0;
    */

    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['fullScreenCornerButtonPos'] = 'topLeft';
    $zoom['config']['fullScreenCornerButtonMarginX'] = 5;
    $zoom['config']['fullScreenCornerButtonMarginY'] = 5;
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc7_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc7_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);

    /* // Changed to above default layout in ver. 5.0.18
    $zoom['config']['fullScreenCornerButtonPos'] = 'bottomRight';
    $zoom['config']['fullScreenCornerButtonMarginX'] = 0;
    $zoom['config']['fullScreenCornerButtonMarginY'] = 0;
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc2_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc2_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
    */

    $zoom['config']['useMap'] = false;
    $zoom['config']['dragMap'] = false;

    // disable all galleries
    $zoom['config']['useGallery'] = false;
    $zoom['config']['fullScreenVertGallery'] = false;
    $zoom['config']['useHorGallery'] = false;
    $zoom['config']['fullScreenHorzGallery'] = false;
    $zoom['config']['useFullGallery'] = false;

    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['speedOptSet'] = true;

    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['firstMod'] = 'spin';

    $zoom['config']['spinSlider'] = false;

    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = false;
    $zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
    $zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);

    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    $zoom['config']['dragToSpin']['enabled'] = true;

    $zoom['config']['spinPreloaderSettings']['text'] = ' ';
    $zoom['config']['spinPreloaderSettings']['width'] = '100%';
    $zoom['config']['spinPreloaderSettings']['height'] = 7;
    $zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom';
    $zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0;
    $zoom['config']['spinPreloaderSettings']['borderW'] = 0;
    $zoom['config']['spinPreloaderSettings']['margin'] = 5;
    $zoom['config']['spinPreloaderSettings']['countMsg'] = false;
    $zoom['config']['spinPreloaderSettings']['statusMsg'] = false;
    $zoom['config']['spinPreloaderSettings']['barH'] = 7;
    $zoom['config']['spinPreloaderSettings']['barOpacity'] = 1;

    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['mNavi']['offsetHorz'] = 5;
    $zoom['config']['mNavi']['offsetVert'] = 5;
    $zoom['config']['mNavi']['offsetVertFS'] = 5;
    $zoom['config']['mNavi']['offsetHorzFS'] = 5;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['onlyFullScreen'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['cssClassFS'] = '';
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';

    if (isset($_GET['3dDir'])) {
        $zoom['config']['mNavi']['order'] = array(
            'mPan' => 5,
            'mSpin' => 5
        );
    } else {
        $zoom['config']['mNavi']['order'] = array(
            'mZoomIn' => 5,
            'mZoomOut' => 5
        );
    }

    $zoom['config']['forceToPan'] = false;
    $zoom['config']['galleryNoThumbs'] = true;

    if (isset($_GET['disableScrollAnm']) && $_GET['disableScrollAnm'] == 'true') {
        $zoom['config']['scrollAnm'] = false;
        $zoom['config']['scrollZoom'] = 11;
        $zoom['config']['scrollAjax'] = 200;
        $zoom['config']['pyrTilesFadeInSpeed'] = 300;
        $zoom['config']['pyrTilesFadeLoad'] = 300;
    }

    $zoom['config']['buttonSet'] = 'flat';

    $zoom['config']['spinCirclePreloader'] = array(
        'enabled' => true,
        'diameter' => '25%',
        'stroke' => 3,
        'rotate' => 0,
        'prc' => false,
        'prcFontSize' => 0.3,
        'img' => true,
        'imgCover' => false,
        'countMsg' => false,
        'statusMsg' => false,
        'autoStatus' => true,
        'text' => array('en' => 'Loading frames', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L1' => array('en' => 'Preloading image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L2' => array('en' => 'Making pyramid', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L3' => array('en' => 'Making tiles', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L4' => array('en' => 'Making first image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
        'L5' => array('en' => 'and first image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => '')
    );

    if (isset($_GET['maxZoomMode'])) {
        $zoom['config']['pZoom'] = 999999;
        $zoom['config']['pZoomOut'] = 999999;
        $zoom['config']['forceToPan'] = false;
        $zoom['config']['zoomOutClick'] = true;
        $zoom['config']['zoomSpeed'] = 500;
        $zoom['config']['zoomOutSpeed'] = 500;
        $zoom['config']['restoreSpeed'] = 500;

        if (isset($_GET['maxZoomSetBtn'])) {
            $zoom['config']['mNavi']['enabled'] = true;
            if (isset($_GET['3dDir'])) {
                $zoom['config']['firstMod'] = 'spin';
                $zoom['config']['icons']['mCustomBtn1'] = array('file'=>'button_iPad_spin', 'ext'=>'png', 'w'=>'{mWidth}', 'h'=>'{mHeight}');
            } else {
                $zoom['config']['icons']['mCustomBtn1'] = array('file'=>'button_iPad_reset', 'ext'=>'{mExt}', 'w'=>'{mWidth}', 'h'=>'{mHeight}');
            }

            $zoom['config']['mNavi']['order'] = array(
                'mCustomBtn1' => 0
            );

            $zoom['config']['mNavi']['mCustomBtn1'] = 'function(){jQuery.fn.axZm.zoomOut({pZoom: 999999});}';
            $zoom['config']['mapButTitle']['customBtn1'] = array('en' => '', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => '');
        }
    }
}

elseif ($_GET['example'] == 'hotSpotEdit') {
    // example33.php
    $zoom['config']['picDim'] = '720x480';

    if (isset($_GET['cmsMode']) && ($_GET['cmsMode'] == 'true' || $_GET['cmsMode'] == '1')) {
        $zoom['config']['mapOwnImage'] = false;
        $zoom['config']['picDim'] = $zoom['config']['picDimDefault'];
    }

    $zoom['config']['firstImageDialog'] = true;
    $zoom['config']['galleryNoThumbs'] = true;
    $zoom['config']['themeCss'] = 'white';
    $zoom['config']['buttonSet'] = 'default';
    $zoom['config']['galFullButton'] = false;
    $zoom['config']['naviFloat'] = 'right';
    $zoom['config']['galleryPicDim'] = '80x80';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['galleryNavi'] = false;
    $zoom['config']['useGallery'] = false;

    $zoom['config']['spinDemo'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['mapFract'] = 0.1;
    $zoom['config']['fullScreenMapFract'] = 0.1;

    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['helpMargin'] = 0;
    $zoom['config']['help'] = false;
    $zoom['config']['mapButton'] = true;
    $zoom['config']['useFullGallery'] = false;
    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['galleryFadeOutSpeed'] = 50;
    $zoom['config']['galleryFadeInSpeed'] = 50;
    $zoom['config']['galleryInnerFade'] = 50;
    $zoom['config']['galleryInnerFadeCut'] = 50;
    $zoom['config']['zoomLoaderEnable'] = false;

    if (isset($_GET['3dDir'])) {
        $zoom['config']['spinMod'] = true;
        $zoom['config']['firstMod'] = 'spin';
    } else {
        $zoom['config']['useFullGallery'] = true;
        $zoom['config']['galleryFullPicDim'] = '110x110';
        $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');
    }

    $zoom['config']['galleryNoThumbs'] = true;
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['spinSlider'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['fullScreenApi'] = false;
    $zoom['config']['spinWhilePreload'] = true;
    $zoom['config']['spinAndDrag'] = true;
    $zoom['config']['disableZoom'] = false;
    $zoom['config']['disableClickZoom'] = false;

    if (isset($zoom['config']['touchSettings']['mNavi'])) {
        $zoom['config']['touchSettings']['mNavi']['enabled'] = true;
    }

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
}

// example34.php
elseif ($_GET['example'] == 'ocr') {
    // example34.php
    $zoom['config']['gallerySlideNavi'] = true;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;

    $zoom['config']['displayNavi'] = false;
    $zoom['config']['mapSelSmoothDrag'] = false;
    $zoom['config']['galHorOpt']['btn'] = false;
    $zoom['config']['useGallery'] = true;
    $zoom['config']['galleryPicDim'] = '86x120';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'vert');

    $zoom['config']['useFullGallery'] = true;
    $zoom['config']['galleryFullPicDim'] = '224x312';
    $zoom = $axZmH->autoSetGalleryThumbCss($zoom, 'full');

    $zoom['config']['galFullAutoStart'] = false;

    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = false;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['mapOpacity'] = 0.75;

    $zoom['config']['zoomMapVis'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    $zoom['config']['galleryFadeInSize'] = 1;

    $zoom['config']['galleryFadeInSpeed'] = 300;
    $zoom['config']['galleryFadeInOpacity'] = 0.0;
    $zoom['config']['galleryFadeInAnm'] = 'Center';
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['fullScreenMapFract'] = false;
    $zoom['config']['fullScreenMapWidth'] = false;
    $zoom['config']['fullScreenMapHeight'] = 120;
    $zoom['config']['fullScreenNaviBar'] = false;
    $zoom['config']['galleryNavi'] = false;

    // toolbar
    $zoom['config']['mNavi']['enabled'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['setParentWidth'] = true;
    $zoom['config']['mNavi']['setParentHeight'] = false;

    $zoom['config']['mNavi']['offsetVertFS'] = 10;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['parentID'] = 'mNaviParentContainer';
    $zoom['config']['mNavi']['alt']['enabled'] = false;
    $zoom['config']['mNavi']['buttonDescr'] = true;

    $zoom['config']['mNavi']['order'] = array(
        'mZoomIn' => 3, 
        'mZoomOut' => 10,
        'mCrop' => 3,
        'mPan' => 10,
        'mHotspots' => 3,
        'mMap' => 3,
        'mGallery' => 10,
        'mReset' => 0
    );

    $zoom['config']['gallerySlideNavi'] = true;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['gallerySlideNaviMouseOver'] = true;
    $zoom['config']['gallerySlideSwipeSpeed'] = 300;
    $zoom['config']['gallerySlideNaviAnm'] = 'SwipeHorz';

    $zoom['config']['speedOptSet'] = true;

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['zoomSpeed'] = 400;
    $zoom['config']['zoomOutSpeed'] = 400;
}

// example35.php
elseif ($_GET['example'] == 'imageCrop') {
    // example35.php
    $zoom['config']['picDim'] = '720x480';

    if (isset($_GET['cmsMode']) && ($_GET['cmsMode'] == 'true' || $_GET['cmsMode'] == '1')) {
        $zoom['config']['mapOwnImage'] = false;
        $zoom['config']['picDim'] = $zoom['config']['picDimDefault'];
    }

    $zoom['config']['useGallery'] = false;

    $zoom['config']['themeCss'] = 'white';
    $zoom['config']['buttonSet'] = 'default';

    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = false;

    $zoom['config']['mapBorder']['top'] = 1;
    $zoom['config']['mapBorder']['right'] = 1;
    $zoom['config']['mapBorder']['bottom'] = 1;
    $zoom['config']['mapBorder']['left'] = 1;
    $zoom['config']['mapFract'] = 0.2;
    $zoom['config']['fullScreenMapFract'] = 0.12;
    $zoom['config']['mapOpacity'] = 0.5;

    $zoom['config']['fullScreenMapWidth'] = 200;
    $zoom['config']['fullScreenMapHeight'] = 200;
    $zoom['config']['mapWidth'] = 100;
    $zoom['config']['mapHeight'] = 100;

    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['gallerySlideNavi'] = false;

    $zoom['config']['speedOptSet'] = true;

    // 360 settings
    if (isset($_GET['3dDir'])) {
        $zoom['config']['spinMod'] = true;
        $zoom['config']['firstMod'] = 'spin';
        $zoom['config']['spinSlider'] = true;

        $zoom['config']['useFullGallery'] = false;
    } else {
        $zoom['config']['useFullGallery'] = true;
    }

    // No scroll animation
    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 'tagging') {
    // example12.php
    $zoom['config']['themeCss'] = 'black';
    $zoom['config']['buttonSet'] = 'default';
    $zoom['config']['useGallery'] = false;
    $zoom['config']['useMap'] = false;
    $zoom['config']['zoomMapRest'] = false;
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 1;
    $zoom['config']['dragMap'] = false;
    $zoom['config']['zoomMapAnimate'] = false;
    $zoom['config']['zoomMapVis'] = true;
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['scrollAnm'] = false;
    $zoom['config']['scrollZoom'] = 11;
    $zoom['config']['scrollAjax'] = 200;
    $zoom['config']['pyrTilesFadeInSpeed'] = 300;
    $zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 'colorSwatch') {
    // example36.php, example36_widget.php
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    /*
    $zoom['config']['fullScreenCornerButtonPos'] = 'topRight';
    $zoom['config']['fullScreenCornerButtonMarginX'] = 0;
    $zoom['config']['fullScreenCornerButtonMarginY'] = 10;
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc1_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc1_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
    */

    $zoom['config']['useMap'] = false;
    $zoom['config']['dragMap'] = false;

    // disable all galleries
    $zoom['config']['useGallery'] = false;
    $zoom['config']['fullScreenVertGallery'] = false;
    $zoom['config']['useHorGallery'] = false;
    $zoom['config']['fullScreenHorzGallery'] = false;
    $zoom['config']['useFullGallery'] = false;

    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['speedOptSet'] = true;

    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['firstMod'] = 'spin';

    $zoom['config']['spinSlider'] = false;

    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
    $zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);

    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;

    $zoom['config']['dragToSpin']['enabled'] = true;

    $zoom['config']['spinPreloaderSettings']['text'] = ' ';
    $zoom['config']['spinPreloaderSettings']['width'] = '100%';
    $zoom['config']['spinPreloaderSettings']['height'] = 7;
    $zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom';
    $zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0;
    $zoom['config']['spinPreloaderSettings']['borderW'] = 0;
    $zoom['config']['spinPreloaderSettings']['margin'] = 5;
    $zoom['config']['spinPreloaderSettings']['countMsg'] = false;
    $zoom['config']['spinPreloaderSettings']['statusMsg'] = false;
    $zoom['config']['spinPreloaderSettings']['barH'] = 7;
    $zoom['config']['spinPreloaderSettings']['barOpacity'] = 1;

    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['mNavi']['offsetHorz'] = 5;
    $zoom['config']['mNavi']['offsetVert'] = 5;
    $zoom['config']['mNavi']['offsetVertFS'] = 5;
    $zoom['config']['mNavi']['offsetHorzFS'] = 5;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['onlyFullScreen'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['cssClassFS'] = '';
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['order'] = array(
        'mPan' => 5,
        'mSpin' => 5
    );

    $zoom['config']['forceToPan'] = false;
    $zoom['config']['galleryNoThumbs'] = true;

    $zoom['config']['scrollSpeed'] = 250;
    $zoom['config']['scrollZoom'] = 25;
    $zoom['config']['scrollAjax'] = $zoom['config']['scrollSpeed'] + 200;
    $zoom['config']['zoomSpeed'] = 250;
    $zoom['config']['zoomOutSpeed'] = 250;
    $zoom['config']['cropSpeed'] = 250;
    $zoom['config']['zoomSpeedGlobal'] = 250;
    $zoom['config']['restoreSpeed'] = 250;
    $zoom['config']['buttonAjax'] = 750;

    $zoom['config']['buttonSet'] = 'flat';
    $zoom['config']['spinCirclePreloader']['enabled'] = true;
}


// Do not set picDim dynamically for responsive layouts! This is wrong approach!!!
// Use jQuery.fn.axZm.openFullScreen instead!!!
// https://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
// https://www.ajax-zoom.com/index.php?cid=blog&article=container_height&lang=en
/*
if (isset($_GET['picDim'])) {
    // Wordpress plugin
    $picDim = explode('x', $_GET['picDim']);
    $picDim[0] = intval($picDim[0]);
    $picDim[1] = intval($picDim[1]);
    if ($picDim[0] > 800) {
        $picDim[0] = 800;
    }

    if ($picDim[1] > 800) {
        $picDim[1] = 800;
    }

    $zoom['config']['picDim'] = $picDim[0].'x'.$picDim[1];
    $zoom['config']['cTimeCompare'] = true;
}
*/
