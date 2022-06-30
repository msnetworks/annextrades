<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomObjects.inc.php
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: https://www.ajax-zoom.com/index.php?cid=download
* Version: 5.4.1
* Date: 2019-08-08
* Review: 2019-08-08
* URL: https://www.ajax-zoom.com
*/

if (!isset($axZmH)) {
    exit;
}

if (isset($_GET['zoomData'])) {
    $getZoomDataReturn = $axZmH->getZoomData($zoom);
    $zoom = $getZoomDataReturn[0];
    $pic_list_array = $getZoomDataReturn[1];
    $pic_list_data = $getZoomDataReturn[2];
    $zoomTmp = $getZoomDataReturn[3];
} elseif (isset($_GET['3dDir']) && strlen($_GET['3dDir'])) {
    $get3dDirReturn = $axZmH->get3dDir($zoom);
    $zoom = $get3dDirReturn[0];
    $pic_list_array = $get3dDirReturn[1];
    $pic_list_data = $get3dDirReturn[2];
    $zoomTmp = $get3dDirReturn[3];
} elseif (isset($_GET['360Data']) && strlen($_GET['360Data'])) {
    $_GET['zoomData'] = $_GET['360Data'];
    $getZoomDataReturn = $axZmH->getZoomData($zoom);
    $zoom = $getZoomDataReturn[0];
    $pic_list_array = $getZoomDataReturn[1];
    $pic_list_data = $getZoomDataReturn[2];
    $zoomTmp = $getZoomDataReturn[3];
} elseif (isset($_GET['zoomDir']) && strlen($_GET['zoomDir'])) {
    $getZoomDirReturn = $axZmH->getZoomDir($zoom, isset($axZmScanDir) ? true : false);
    $zoom = $getZoomDirReturn[0];
    $pic_list_array = $getZoomDirReturn[1];
    $pic_list_data = $getZoomDirReturn[2];
    $zoomTmp = $getZoomDirReturn[3];
}

if (isset($pic_list_array)) {
    $preProceedListReturn = $axZmH->preProceedList($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    $zoom = $preProceedListReturn[0];
    $pic_list_array = $preProceedListReturn[1];
    $pic_list_data = $preProceedListReturn[2];
    $zoomTmp = $preProceedListReturn[3];
}
