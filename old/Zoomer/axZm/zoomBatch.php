<?php
/*!
* Plugin: jQuery AJAX-ZOOM, zoomBatch.php
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.5
* Extension Date: 2019-06-01
* Revision Date: 2019-06-01
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs


* This is the basic batch process file. 
* With this, you can process a larger amount of images from one folder or all subdolders at once and get visual feedback. 
* If you need a "draft" example php file without visual feedback which could run as cron job, please contact the support...
* $_SESSION (session cookies) must be activated in your browser.
* max_input_vars - if you have many files in one folder you should rise the value of max_input_vars PHP condiguration!!!

*******************************************************
******************** IMPORTANT! ***********************
*******************************************************
* you might need to adjust some settings below to suit your needs:

- $axZmBatchConfig['yourSecretPassWord'] - set password to access this file, 
    if it is not already integrated into backend of a module / plugin such as Magento

- $axZmBatchConfig['example'] - set depending on the example value you are using on frontend (/axZm/zoomConfigCustom.inc.php)
    Please note that the value of example parameter passed over the query string to AJAX-ZOOM 
    does not always correspond to the number of an example found in /examples folder of the download package. 
    To find out which "example" value is used, see source code of the implementation in question 
    or inspect an ajax call to "/axZm/zoomLoad.php" with e.g. Chrome Devtools. 
    If you are using one of AJAX-ZOOM modules / plugins, e.g. for Magento or Prestashop, 
    the value of "example" can be found and set in module configuration options at backend. 
**/

// Session life time
ini_set('session.gc_maxlifetime', 65535);

// Start session
if(!session_id()) {
    session_start();
}

$axZmBatchConfig = array('ver' => '2.5', 'date' => '2019-06-01');

/////////////////////////////////////////////////////////
//////////////////////// PASSWORD ! /////////////////////
/////////////////////////////////////////////////////////
// Simple (very basic) password protection for this file.
// Set the password to access this file over browser.
// You can also create a batch.config.inc.php file and place it outside of the axZm folder 
// to avoid setting it on every update that may replace the entire axZm folder with core files.

// In there, all variables of the $axZmBatchConfig array can be set as key => value of the $axzm_batch_config array, e.g.
/*
$axzm_batch_config = array(
    'yourSecretPassWord' => 'set to your password',
    'previewHeight' => 900,
    'previewWidth' => 900,
    'previewQual' => 75,
    'ipAccess' => array(),
    'example' => 'mouseOverExtension360Ver5',
);
*/

$axZmBatchConfig['yourSecretPassWord'] = '';

// Restrict access to the file by certain IPs
$axZmBatchConfig['ipAccess'] = array(
    //'255.255.255.255',
    //'222.222.222.222'
);

// Example value
$axZmBatchConfig['example'] = 'mouseOverExtension360Ver5';

// Other values, not needed to be set or they can be set over the frontend of this file
$axZmBatchConfig['cmsMode'] = false;
$axZmBatchConfig['byPassBatchPass'] = false;
$axZmBatchConfig['picBaseDir'] = '';
$axZmBatchConfig['setPicBaseDirAuto'] = true;

$axZmBatchConfig['headerFiles'] = '';
$axZmBatchConfig['headerFiles'] .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<meta http-equiv="imagetoolbar" content="no">'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<meta name="viewport" content="width=device-width, initial-scale=1">'."\r\n";

$axZmBatchConfig['headerFiles'] .= '<link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<link href="plugins/bootstrap/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<link href="axZm.css" rel="stylesheet">'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<link href="extensions/jquery.axZm.batch.css" rel="stylesheet">'."\r\n";

$axZmBatchConfig['headerFiles'] .= '<script src="plugins/jquery-1.10.2.min.js"></script>'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<script src="plugins/jquery-migrate-1.4.1.min.js"></script>'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<script src="plugins/jquery.scrollTo.min.js"></script>'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<script src="plugins/bootstrap/js/bootstrap.min.js"></script>'."\r\n";
$axZmBatchConfig['headerFiles'] .= '<script src="jquery.axZm.js"></script>'."\r\n";

if (file_exists(dirname(__FILE__).'/classes/axZmF.class.php')) {
    include_once dirname(__FILE__).'/classes/axZmF.class.php';
} else {
    die('Please update AJAX-ZOOM');
}

if (file_exists(dirname(__FILE__).'/classes/AzMouseoverSettings.php')) {
    include_once dirname(__FILE__).'/classes/AzMouseoverSettings.php';
} else {
    die('Please update AJAX-ZOOM');
}

// Configuration file for this batch tool
// Supposed to be used in AJAX-ZOOM modules / plugins
if (file_exists(dirname(dirname(__FILE__)).'/batch.config.inc.php')) {
    include_once dirname(dirname(__FILE__)).'/batch.config.inc.php';
    if (isset($axzm_batch_config) && is_array($axzm_batch_config) && !empty($axzm_batch_config)) {
        foreach ($axzm_batch_config as $k => $v) {
            $axZmBatchConfig[$k] = $v;
        }

        if (isset($_GET['batch_start']) && isset($_SESSION['axZmBtch'])) {
            unset($_SESSION['axZmBtch']);
        }
    }

    $axZmBatchConfig['cmsMode'] = true;
} else {
    $axZmBatchConfig['byPassBatchPass'] = false;
    $axZmBatchConfig['cmsMode'] = false;
}

// Check IP restrictions
axZmF::checkIpAddress($axZmBatchConfig);

// Logout if not included into a plugin / module
if (isset($_GET['logout'])) {
    axZmF::batchLogout();
}

// Check password if not included into a plugin / module
axZmF::checkBatchPassword($axZmBatchConfig);

// Unset all sessions in batch document if nothing posted, e.g. reload
// All Sessions are stored in $_SESSION['axZmBtch']
axZmF::batchUnsetSessions();

// Display login fields if not authorized
axZmF::batchLoginField($axZmBatchConfig);

// AJAX: keep logged in to maintain session
if (isset($_GET['keepLogin'])) {
    die();
}

// AJAX: stop batch process if button is pressed
if (isset($_GET['batchStop'])) {
    axZmF::batchStop();
}

// AJAX: change example value
if (isset($_GET['changeExampleValue'])) {
    $_SESSION['axZmBtch']['exampleValue'] = preg_replace('/\s+/', '', $_GET['changeExampleValue']);
    unset($_GET['changeExampleValue']);
    die($_SESSION['axZmBtch']['exampleValue']);
}

// Set $_GET['example'] for AJAX-ZOOM configuration values
if (isset($_SESSION['axZmBtch']['exampleValue'])) {
    $_GET['example'] = $_SESSION['axZmBtch']['exampleValue'];
} elseif (isset($axZmBatchConfig['example'])) {
    $_GET['example'] = $axZmBatchConfig['example'];
    $_SESSION['axZmBtch']['exampleValue'] = $axZmBatchConfig['example'];
}

// Include all needed AJAX-ZOOM classes
$noObjectsInclude = 1;
$inludeCustomConfig = 1;
require __DIR__.'/zoomInc.inc.php';

axZmF::$axZm = $axZm;
axZmF::$axZmH = $axZmH;

// Set base directory for images
if (!isset($_SESSION['axZmBtch']['startPic'])) {
    // baseDir upon a config value
    if (isset($axZmBatchConfig['picBaseDir']) && $axZmBatchConfig['picBaseDir']) {
        if (is_dir($axZmH->checkSlash($zoom['config']['fpPP'].'/'.$axZmBatchConfig['picBaseDir'], 'add'))) {
            $zoom['config']['pic'] = $axZmH->checkSlash($axZmBatchConfig['picBaseDir'], 'add');

            // Define the start (home) directory where images are located (for dropdown option list)
            $_SESSION['axZmBtch']['startPic'] = $zoom['config']['pic'];
            $axZmBatchConfig['setPicBaseDirAuto'] = false;
        } else {
            $axZmBatchConfig['setPicBaseDirAuto'] = true;
        }
    } 

    // Presume pic folder is at same location, 
    // as in download package or most AJAX-ZOOM modules / plugins for 360
    if ($axZmBatchConfig['setPicBaseDirAuto'] === true) {
        // base directory, can be just /
        $zoom['config']['pic'] = $zoom['config']['installPath'].'/pic/';
        if (!is_dir($axZmH->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add'))) {
            $zoom['config']['pic'] = __DIR__;
        }

        $_SESSION['axZmBtch']['startPic'] = $zoom['config']['pic'];
    } elseif (!isset($_SESSION['axZmBtch']['startPic'])) {
        $zoom['config']['pic'] = __DIR__;
        $_SESSION['axZmBtch']['startPic'] = $zoom['config']['pic'];
    }
} else {
    $zoom['config']['pic'] = $_SESSION['axZmBtch']['startPic'];
}

// AJAX: change base directory upon AJAX request
if (isset($_SESSION['axZmBtch']['startPic'])
    && isset($_GET['changeStartPicBatch'])
    && $_GET['changeStartPicBatch']
) {
    $_GET['changeStartPicBatch'] = axZmF::batchCleanBaseDir($_GET['changeStartPicBatch']);

    if ($_GET['changeStartPicBatch']
        && is_dir($axZmH->checkSlash($zoom['config']['fpPP'].$_GET['changeStartPicBatch'], 'add'))
    ) {
        $_SESSION['axZmBtch']['startPic'] = $axZmH->checkSlash($_GET['changeStartPicBatch'], 'add');
    }

    // reload happens over JS
    die();
}

// Override errors etc...
$zoom['config']['cTimeCompareDialog'] = false;
$zoom['config']['firstImageDialog'] = false;
$zoom['config']['galleryDialog'] = false;
$zoom['config']['pyrDialog'] = false;
$zoom['config']['gPyramidDialog'] = false;
$zoom['config']['warnings'] = false; 
$zoom['config']['errors'] = false;
$zoom['config']['visualConf'] = false;
$zoom['config']['pyrProgErrorRemove'] = true;

$zoom['config']['gPyramid'] = false; // will generate gPyramid
$zoom['config']['pyrTiles'] = true; // will generate tiles
$zoom['config']['dynamicThumbsQualRange'] = array(30, 100);

// DO NOT EDIT THE FOLLOWING CODE !
$zoom['config']['picDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['pic'], 'add');

$zoom['config']['picX'] = (int)($axZmH->getf('x',$zoom['config']['picDim']));
$zoom['config']['picY'] = (int)($axZmH->getl('x',$zoom['config']['picDim']));
$zoom['config']['galPicX'] = (int)($axZmH->getf('x',$zoom['config']['galleryPicDim']));
$zoom['config']['galPicY'] = (int)($axZmH->getl('x',$zoom['config']['galleryPicDim']));
$zoom['config']['galFullPicX'] = (int)($axZmH->getf('x',$zoom['config']['galleryFullPicDim']));
$zoom['config']['galFullPicY'] = (int)($axZmH->getl('x',$zoom['config']['galleryFullPicDim']));
$zoom['config']['galHorPicX'] = (int)($axZmH->getf('x',$zoom['config']['galleryHorPicDim']));
$zoom['config']['galHorPicY'] = (int)($axZmH->getl('x',$zoom['config']['galleryHorPicDim']));

#######################################################################################
#################################### Batch parameters #################################
#######################################################################################
$zoom['batch'] = array();

$zoom['batch']['headerFiles'] = '';
$zoom['batch']['fluid'] = false;

// PHP_SELF should be ok for iframe
// for includes /path/to/cms/zoomBatch.php
$zoom['batch']['selfFile'] = $_SERVER['PHP_SELF'];

// Preview image settings in the file list
$zoom['batch']['previewWidth'] = 600;
$zoom['batch']['previewHeight'] = 600;
$zoom['batch']['previewCache'] = false;
$zoom['batch']['previewQual'] = 80;

// Ver. 4.2.11+ create /axZm/batchLog directory to store errors there
$zoom['batch']['logErrorsPath'] = dirname(__FILE__).'/batchLog';

// Show thumbnails of the images for batch list (will be displayed to the left)
$zoom['batch']['enableBatchThumbs'] = false;
$zoom['batch']['batchThumbsDynString'] = 'width=220&height=220&thumbMode=contain';

// Pause between ajax requests
$zoom['batch']['pause'] = 250; // ms (1000ms = 1sec)

// Exclude files (strstr or preg_match)
$zoom['batch']['filesFilter'] = array(
    /*
    'cart_default',
    'home_default',
    'large_default',
    'medium_default',
    'small_default',
    'thickbox_default'
    */
);

// Exclude folders, array
$zoom['batch']['foldersFilter'] = array(
    /*
    'thumbs',
    'cache'
    */
);

// Remove "empty" folders or folders and images, 
// which have not been processed yet from folder / file structure.
// Possible values: false, 'folders', 'images'
$zoom['batch']['filterNeedCache'] = false;

// Exclude images with low resolution
$zoom['batch']['resolutionFilter'] = '';

// JS callback after a folder were proceeded
$zoom['batch']['afterBatchFolderEndJsClb'] = false;

$zoom['batch']['allowDelete'] = true; // boolean
$zoom['batch']['allowBatchDelete'] = true; // boolean
$zoom['batch']['allowDeleteInSubfolders'] = true; // boolean
$zoom['batch']['confirmDelete'] = true; // boolean
$zoom['batch']['confirmBatch'] = true; // boolean
$zoom['batch']['stopOnError'] = false; // boolean

$zoom['batch']['dynImageSizes'] = array(
    /*
    1 => array('width' => 1200, 'height' => 1200, 'qual' => 80, 'thumbMode' => false),
    2 => array('width' => 128, 'height' => 128, 'qual' => 100, 'thumbMode' => false),
    */
);

$zoom['batch']['arrayMake']['In'] = true;
$zoom['batch']['arrayMake']['Th'] = true;
$zoom['batch']['arrayMake']['tC'] = true;
$zoom['batch']['arrayMake']['Ti'] = (strtolower($zoom['config']['licenseType']) == 'simple'
    || $zoom['config']['simpleMode'] === true ? false : ($zoom['config']['pyrTiles'] ? true : false));

// Language vars
$zoom['batch']['arrayMakeName']['In'] = '<strong>(In)</strong> initial image(s)';
$zoom['batch']['arrayMakeName']['Th'] = '<strong>(Th)</strong> thumbs';
$zoom['batch']['arrayMakeName']['tC'] = '<strong>(tC)</strong> dynamic thumbs';
$zoom['batch']['arrayMakeName']['Ti'] = '<strong>(Ti)</strong> image tiles';
$zoom['batch']['laRebuild'] = 'Check this box if you want to rebuild the selected cache types. ';
$zoom['batch']['laRebuild'] .= 'All cached images of a particular source image are then deleted just before triggering the cache generating process for each of the files.';

// Icons
$zoom['batch']['iconNames']['Ok'] = 'fa fa-check-circle';
$zoom['batch']['iconNames']['Nn'] = 'fa fa-check-circle-o';
$zoom['batch']['iconNames']['Error'] = 'fa fa-ban';
$zoom['batch']['iconNames']['Trash'] = 'fa fa-trash-o';
$zoom['batch']['iconNames']['N'] = 'fa fa-question-circle';
$zoom['batch']['iconNames']['O'] = 'fa fa-circle-o';
$zoom['batch']['iconNames']['Picture'] = 'fa fa-picture-o';

$zoom['batch']['iconNames']['Smile'] = 'fa fa-thumbs-up';
$zoom['batch']['iconNames']['Warning'] = 'fa fa-exclamation-triangle';
$zoom['batch']['iconNames']['Info'] = 'fa fa-info-circle';

$zoom['batch']['iconOk'] = '<i class="'.$zoom['batch']['iconNames']['Ok'].'" aria-hidden="true"></i>';
$zoom['batch']['iconNn'] = '<i class="'.$zoom['batch']['iconNames']['Nn'].'" aria-hidden="true"></i>';
$zoom['batch']['iconError'] = '<i class="'.$zoom['batch']['iconNames']['Error'].'" aria-hidden="true"></i>';
$zoom['batch']['iconTrash'] = '<i class="'.$zoom['batch']['iconNames']['Trash'].'" aria-hidden="true"></i>';
$zoom['batch']['iconN'] = '<i class="'.$zoom['batch']['iconNames']['N'].'" aria-hidden="true"></i>';
$zoom['batch']['iconO'] = '<i class="'.$zoom['batch']['iconNames']['O'].'" aria-hidden="true"></i>';
$zoom['batch']['iconPicture'] = '<i class="'.$zoom['batch']['iconNames']['Picture'].'" aria-hidden="true"></i>';

$zoom['batch']['iconSmile'] = '<i class="'.$zoom['batch']['iconNames']['Smile'].' batchIconSmile"></i>';
$zoom['batch']['iconWarning'] = '<i class="'.$zoom['batch']['iconNames']['Warning'].' batchIconWarning"></i>';
$zoom['batch']['iconInfo'] = '<i class="'.$zoom['batch']['iconNames']['Info'].' batchiconInfo"></i>';

$zoom['batch']['dirTreeOptions'] = '';

// Interface for presets in batch.config.inc.php
$zoom['batch']['presets'] = array(
    /*
    'config' => array(
        'dropTitle' => 'Presets',
        'dropIcon' => 'fa-sliders',
        'subIcon' => 'fa-genderless'
    ),
    'bla 1' => array(
        'startPic' => '/wp-content/plugins/ajaxzoom/pic/',
    ),
    'bla 2' => array(
        'startPic' => '/wp-content/uploads/'
    )
    */
);

$zoom['batch']['vendorNote'] = array(
    'title' => '',
    'text' => array()
);

foreach ($axZmBatchConfig as $k => $v) {
    if (isset($zoom['batch'][$k])) {
        $zoom['batch'][$k] = $v;
    }
}

// End Batch parameters

// AJAX: SET settings from file
if (isset($_GET['loadBatchSettings'])) {
    axZmF::batchAjaxLoadSettingsFromFile($zoom, $axZmBatchConfig);
}

// Load settings from session values
$zoom = axZmF::getOtherSettings($zoom);

// AJAX: SET dynImageSizes
if (isset($_GET['setDynImageSizes'])) {
    axZmF::setDynImageSizes();
}

// AJAX: SET setFilters
if (isset($_GET['setFilters'])) {
    axZmF::setFilters();
}

// AJAX: SET other settings
if (isset($_GET['setOtherSettings'])) {
    axZmF::setOtherSettings($zoom);
}

// (Re)generate a dropdown list with all subdirectories as save in session
if (!isset($_SESSION['axZmBtch']['dirTreeArray']) || isset($_GET['reloadDirTree']) || isset($_GET['filterNeedCache'])) {
    $ret = axZmF::batchDirTreeDropdown($zoom, isset($_GET['filterNeedCache']) ? $_GET['filterNeedCache'] : false);

    // AJAX: replace dropdown list
    if (isset($_GET['reloadDirTree'])) {
        axZmF::batchAjaxReplaceFolderDropdown($ret);
    }
}

// Change direcory and $zoom['config']['pic'], $zoom['config']['picDir'] respectively.
if (isset($_SESSION['axZmBtch']['currentDir']) && !isset($_GET['dir'])) {
    $_GET['dir'] = $_SESSION['axZmBtch']['currentDir'];
}

// Change and save to session $zoom['config']['pic'], $zoom['config']['picDir']
if (isset($_GET['dir']) && isset($_SESSION['axZmBtch']['dirTreeArray'])) {
    if (!empty($_SESSION['axZmBtch']['dirTreeArray'])) {
        if (is_array($_SESSION['axZmBtch']['dirTreeArray'][$_GET['dir']])) {
            $zoom['config']['pic'] = $axZmH->checkSlash($_SESSION['axZmBtch']['dirTreeArray'][$_GET['dir']]['DIR_PATH'], 'remove');
            $zoom['config']['picDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'],'add');

            $_SESSION['axZmBtch']['pic'] = $zoom['config']['pic'];
            $_SESSION['axZmBtch']['picDir'] = $zoom['config']['picDir'];
            $_SESSION['axZmBtch']['currentDir'] = $_GET['dir'];
        }
    }
} elseif (isset($_GET['dir']) && !isset($_SESSION['axZmBtch']['dirTreeArray'])) {
    unset($_GET['dir']);
}

// Definine current directory in session if not present
if (!isset($_SESSION['axZmBtch']['currentDir'])) {
    $_SESSION['axZmBtch']['currentDir'] = 'HOME';
};

// AJAX: preview images when clicked on the icon in batch list are created on the fly
if (isset($_GET['previewPic'])) {
    axZmF::batchAjaxPreviewPic($zoom, $_GET['previewPic']);
}

// AJAX: reload important settings list
if (isset($_GET['getSettingsInfo'])) {
    die(axZmF::getBatchSettingsInfo($zoom));
}

// Define the $pic_list_array and $pic_list_data for current folder
// While batch job is running, the data is saved to session for performance reasons
if (!isset($_SESSION['axZmBtch']['batchJob']) || empty($_SESSION['axZmBtch']['batchJob'])) {
    extract(axZmF::getPicListArray($zoom));
}

// Set options about what to make from session, if they have been set dynamically
if (isset($_SESSION['axZmBtch']['arrayMake'])) {
    $zoom['batch']['arrayMake'] = $_SESSION['axZmBtch']['arrayMake'];
}

// AJAX: change options for what to batch
if (isset($_GET['switchBatch']) && $_GET['switchBatch']) {
    axZmF::batchAjaxSwitchBatch($zoom, $_GET['switchBatch'], $pic_list_array, $pic_list_data);
}

// AJAX: change directory
if (isset($_GET['dir']) && $_GET['dir'] && isset($_GET['dirReplace'])) {
    axZmF::batchAjaxSwitchDir($zoom, $_GET['dir'], $pic_list_array, $pic_list_data);
}

// AJAX: delete AZ cache for a single image
if ($zoom['batch']['allowDelete'] && isset($_GET['delPic'])) {
    axZmF::batchAjaxDeleteCacheFor($zoom, $_GET['delPic'], $pic_list_array, $pic_list_data);
}

// AJAX: delete AZ cache for selected image and selected folders / subfolders
if ($zoom['batch']['allowBatchDelete'] && isset($_GET['submitDelete']) && $_GET['submitDelete']) {
    axZmF::batchAjaxDeleteCacheSelected($zoom, $pic_list_array);
}

// AJAX: get naumber images in selected folders / subfolders
if (isset($_GET['getNumberImages'])) {
    axZmF::getNumberImagesInFolders(
        $zoom,
        $pic_list_array,
        isset($_GET['depth']) ? $_GET['depth'] : 1,
        isset($_GET['withPaths']) ? $_GET['withPaths'] : 0,
        isset($_GET['needToProcess']) ? $_GET['needToProcess'] : 0
    );
}

// AJAX: download settings to file
if (isset($_GET['saveBatchSettings'])) {
    axZmF::batchAjaxSaveSettingsToFile($zoom);
}

// AJAX: batch process
if ((isset($_GET['zoomID']) && !empty($_SESSION['axZmBtch']['batchJob'])) 
    || isset($_GET['submitList'])
) {
    // Submited list of images evaluation
    if (isset($_GET['submitList'])) {
        axZmF::batchAjaxProcessStart($zoom, $pic_list_array);
    }

    // Proceed an image
    if (isset($_GET['zoomID'])
        && isset($_SESSION['axZmBtch']['batchJob'])
        && !empty($_SESSION['axZmBtch']['batchJob'])
    ) {
        echo axZmF::batchAjaxProcessBatchFile(
            $zoom,
            (int)$_GET['zoomID'],
            $pic_list_array,
            $pic_list_data,
            isset($_SESSION['axZmBtch']['rebuild']) && $_SESSION['axZmBtch']['rebuild'] === true ? true : false
        );
    }

    // Proceed to next folder
    if (empty($_SESSION['axZmBtch']['batchJob'])
        && !empty($_SESSION['axZmBtch']['batchFolders'])
        && !($zoom['batch']['stopOnError'] && count($_SESSION['axZmBtch']['batchErrors']) > 0)
    ) {
        echo axZmF::batchAjaxProcessFolder($zoom);
    }

    // Show results when done
    if (isset($_SESSION['axZmBtch']['batchShowResults'])
        && $_SESSION['axZmBtch']['batchShowResults'] === true
    ) {
        axZmF::batchAjaxProcessEnd($zoom);
    }

} else {

    $batchHtml = '';
    // Batch conversion list filenames
    // This is what you see at the beginning
    $batchHtml .= "
    <!DOCTYPE html><html>
    <head>
    <title>Batch Conversion Ajax-Zoom</title>
    ";

    $batchHtml .= $zoom['batch']['headerFiles'];

    // Some Javascript
    $batchHtml .= '
    <script type="text/javascript">
        jQuery.zoomBatch = {};
        jQuery.zoomBatch.currentDir = "HOME";
        jQuery.zoomBatch.batch = {
            exampleValue: '.$axZmH->ptj($_SESSION['axZmBtch']['exampleValue']).',
            confirmDelete: '.$axZmH->ptj($zoom['batch']['confirmDelete']).',
            allowBatchDelete: '.$axZmH->ptj($zoom['batch']['allowBatchDelete']).',
            confirmBatch: '.$axZmH->ptj($zoom['batch']['confirmBatch']).',
            iconNames: {
                "Ok": "'.$zoom['batch']['iconNames']['Ok'].'",
                "Nn": "'.$zoom['batch']['iconNames']['Nn'].'",
                "Error": "'.$zoom['batch']['iconNames']['Error'].'",
                "Trash": "'.$zoom['batch']['iconNames']['Trash'].'",
                "N": "'.$zoom['batch']['iconNames']['N'].'",
                "Picture": "'.$zoom['batch']['iconNames']['Picture'].'",
                "Smile": "'.$zoom['batch']['iconNames']['Smile'].'",
                "Warning": "'.$zoom['batch']['iconNames']['Warning'].'",
                "Info": "'.$zoom['batch']['iconNames']['Info'].'"
            },
            "iconOk": "'.addslashes($zoom['batch']['iconOk']).'",
            "iconNn": "'.addslashes($zoom['batch']['iconNn']).'",
            "iconError": "'.addslashes($zoom['batch']['iconError']).'",
            "iconTrash": "'.addslashes($zoom['batch']['iconTrash']).'",
            "iconN": "'.addslashes($zoom['batch']['iconN']).'",
            "iconPicture": "'.addslashes($zoom['batch']['iconPicture']).'",
            "iconSmile": "'.addslashes($zoom['batch']['iconSmile']).'",
            "iconWarning": "'.addslashes($zoom['batch']['iconWarning']).'",
            "iconInfo": "'.addslashes($zoom['batch']['iconInfo']).'",

            "selfFile": '.$axZmH->ptj($zoom['batch']['selfFile']).',
            "previewWidth": '.$axZmH->ptj($zoom['batch']['previewWidth']).',
            "previewHeight": '.$axZmH->ptj($zoom['batch']['previewHeight']).',
            "previewCache": '.$axZmH->ptj($zoom['batch']['previewCache']).',
            "previewQual": '.$axZmH->ptj($zoom['batch']['previewQual']).',
            "config": {
                "icon": '.$axZmH->ptj($zoom['config']['icon']).'
            } 
        };
        '.$axZmH->arrayToJSObject($_SESSION['axZmBtch']['dirTreeArray'], 'jQuery.zoomBatch.dirTreeArray', false, false, false).';
        '.$axZmH->arrayToJSObject($zoom['batch']['dynImageSizes'], 'jQuery.zoomBatch.batch.dynImageSizes', false, false, false).';
        '.$axZmH->arrayToJSArray(axZmF::normBackSlashJs($zoom['batch']['filesFilter']), 'jQuery.zoomBatch.batch.filesFilter').';
        '.$axZmH->arrayToJSArray(axZmF::normBackSlashJs($zoom['batch']['foldersFilter']), 'jQuery.zoomBatch.batch.foldersFilter').';
        '.$axZmH->arrayToJSArray($zoom['batch']['resolutionFilter'], 'jQuery.zoomBatch.batch.resolutionFilter').';
        '.$axZmH->arrayToJSObject(axZmF::getMouseOverDefault(), 'jQuery.zoomBatch.mouseOverDefault', false, false, false).';
        '.$axZmH->arrayToJSObject($pic_list_array, 'jQuery.zoomBatch.pic_list_array', false, false, false).';
        '.$axZmH->arrayToJSObject(axZmF::normBackSlashJs($zoom['batch']['presets']), 'jQuery.zoomBatch.batch.presets', false, false, false).';
        </script>
        <script src="extensions/jquery.axZm.batch.js"></script>
    </head>
    <body>
    ';

    // Save it to session and make available for ajax requests
    if (isset($_SESSION['axZmBtch']['dirTreeArray'])
        && is_array($_SESSION['axZmBtch']['dirTreeArray'])
        && !empty($_SESSION['axZmBtch']['dirTreeArray'])
    ) {
        // Generate an option list with all folders
        $zoom['batch']['dirTreeOptions'] = $axZm->dirOptions($_SESSION['axZmBtch']['dirTreeArray'], false );
    }

    $batchHtml .= '<div class="breadcrumbCotainer container'.($zoom['batch']['fluid'] ? '-fluid' : '').'" id="breadcrumbCotainer">
        <div class="row">
            <div class="col-sm-12" id="bci"></div>
        </div>
    </div>';

    $batchHtml .= '<div class="batchMainFrame container'.($zoom['batch']['fluid'] ? '-fluid' : '').'" id="batchMainFrame">';
        $batchHtml .= '<div class="mainInnerFrame row">';

            ////////////////////////
            ////// Left panel //////
            ////////////////////////
            $batchHtml .= '<div class="leftFrameParent col-xs-6">';
                $batchHtml .= '<div class="panel panel-default">';

                    $batchHtml .= '<div class="panel-heading">
                        <span style="float: left">Files list</span>
                        <i id="dirLoader" class="fa fa-refresh" aria-hidden="true"></i>
                        <select class="batchSelect" id="batchSelect" name="dir" onChange="jQuery.zoomBatch.changeDir(this.value); this.blur();">
                        '.$zoom['batch']['dirTreeOptions'].'
                        </select>
                        <button class="btn btn-xs btn-default pull-right" id="btnReloadDirTree" 
                            onclick="jQuery.zoomBatch.reloadDirTree()" title="Reload directory tree and store in a session." 
                            style="margin-left: 15px">
                            <span>&#8634;</span>
                        </button>
                    </div>';

                    $filesNavbar = '
                        <nav id="filesNavbar" class="navbar navbar-default">
                          <div class="container-fluid">

                            <div class="navbar-header">
                                <a class="navbar-brand">AZ Batch Tool '.$axZmBatchConfig['ver'].'</a>
                            </div>

                            <button type="button" class="navbar-toggle collapsed" 
                                data-toggle="collapse" data-target="#filesNavbarContent" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div id="filesNavbarContent" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                ';

                                    $filesNavbar .= '
                                    <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.showInPlayer()">
                                            <i class="fa fa-youtube-play" aria-hidden="true"></i> View in player
                                        </a>
                                    </li>';

                                    $filesNavbar .= '
                                    <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.getNumberImages()">
                                            <i class="fa fa fa-bolt" aria-hidden="true"></i> Selection info
                                        </a>
                                    </li>
                                    ';

                                    if ($zoom['batch']['filterNeedCache'] != 'images') {
                                        $filesNavbar .= '
                                        <li><a href="javascript:void(0)" 
                                                onclick="jQuery.zoomBatch.toggleSettingTab(\'batchFilterNeedCache\');">
                                            <i class="fa fa-magic" aria-hidden="true"></i> Cache needed</a>
                                        </li>';
                                    }

                                    if (!empty($zoom['batch']['presets'])
                                        && is_array($zoom['batch']['presets'])
                                        && isset($zoom['batch']['presets']['config'])
                                        && count($zoom['batch']['presets'] > 1)
                                    ) {
                                        if (!isset($zoom['batch']['presets']['config']['dropIcon'])) {
                                            $zoom['batch']['presets']['config']['dropIcon'] = 'fa-sliders';
                                        }

                                        if (!isset($zoom['batch']['presets']['config']['dropTitle'])) {
                                            $zoom['batch']['presets']['config']['dropTitle'] = 'Presets';
                                        }

                                        if (!isset($zoom['batch']['presets']['config']['subIcon'])) {
                                            $zoom['batch']['presets']['config']['subIcon'] = 'fa-genderless';
                                        }

                                        $filesNavbar .= '
                                        <li class="dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle" 
                                                data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa '.$zoom['batch']['presets']['config']['dropIcon'].'" aria-hidden="true"></i> 
                                                    '.$zoom['batch']['presets']['config']['dropTitle'].' <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                        ';

                                        foreach (array_keys($zoom['batch']['presets']) as $k) {
                                            if ($k != 'config') {
                                                $filesNavbar .= '
                                                <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.loadPreset(\''.$k.'\')">
                                                        <i class="fa '.$zoom['batch']['presets']['config']['subIcon'].'" aria-hidden="true"></i> '.$k.'
                                                    </a>
                                                </li>
                                                ';
                                            }
                                        }

                                        $filesNavbar .= '
                                            </ul>
                                        </li>
                                        ';
                                    }

                                    $filesNavbar .= '
                                </ul>
                             </div>
                          </div>
                        </nav>
                    ';

                    $batchHtml .= $filesNavbar;

                    $batchHtml .= '<div class="panel-body" style="padding: 0">';
                        $batchHtml .= '<form id="passFiles" method="post" action="" onsubmit="return false;">';
                            $batchHtml .= '<div class="leftFrame" id="batchList">';
                            $batchHtml .= $axZmH->batchList($zoom, $pic_list_array, $pic_list_data);
                            $batchHtml .= '</div>';
                        $batchHtml .= '</form>';
                    $batchHtml .= '</div>';

                    // Buttons and checkboxes at the bottom
                    $batchHtml .= '<div class="panel-footer clearfix" id="leftFrameFoot">';

                        // Checkboxes to switch between what to batch
                        $batchButtons .= '<div class="footerRow footerCheckBoxes">';
                            foreach ($zoom['batch']['arrayMakeName'] as $k => $v) {
                                $batchButtons .= '<span class="text-nowrap"><input type="checkbox" id="batchSwitch'.$k.'" 
                                    value="1" onClick="jQuery.zoomBatch.switchBatch(\''.$k.'\')"';

                                if ($zoom['batch']['arrayMake'][$k]) {
                                    $batchButtons .= ' checked';
                                }

                                $batchButtons .= '> - '.$v.'</span>';

                                $batchButtons .= '&nbsp;&nbsp;';
                            }

                            $batchButtons .= '<div class="clearfix" id="leftFrameFootOpt">';
                                    $batchButtons .= '<table><tbody>';
                                        $batchButtons .= '<tr><td>';
                                            $batchButtons .= '<input type="checkbox" value="1" id="batchRebuild">';
                                        $batchButtons .= '</td><td>'.$zoom['batch']['laRebuild'].'</td></tr>';
                                    $batchButtons .= '</tbody></table>';
                            $batchButtons .= '</div>';

                        $batchButtons .= '</div>';

                        // Select buttons
                        $batchButtons .= '<div class="footerRow" style="margin-bottom: 7px">';

                            $batchButtons .= '<button class="batchButton btn btn-xs btn-default" id="buttonSelectAll"> 
                                <i class="fa fa-check-square-o" aria-hidden="true"></i> Toggle all </button>';

                            $batchButtons .= '<button class="batchButton btn btn-xs btn-default" id="buttonSelectAllFolders"> 
                                <i class="fa fa-folder" aria-hidden="true"></i> Toggle folders </button>';

                            $batchButtons .= '<button class="batchButton btn btn-xs btn-default" id="buttonSelectAllImages"> 
                                <i class="fa fa-picture-o" aria-hidden="true"></i> Toggle images </button>';

                            $batchButtons .= '<button class="batchButton btn btn-xs btn-success" id="buttonSmartSelect"> 
                                <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Smart select </button>';

                        $batchButtons .= '</div>';

                        // Process / delete butttons
                        $batchButtons .= '<div class="footerRow">';
                            $batchButtons .= '<button class="batchButton btn btn-danger" id="buttonBatchStop" style="display: none;"> 
                                <i class="fa fa-play-circle-o" aria-hidden="true"></i> Stop batch </button>';

                            if ($zoom['batch']['allowBatchDelete'] === true) {
                                $batchButtons .= '<button class="batchButton btn btn-warning" id="buttonDelete"> 
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete cache </button>';
                            }

                            $batchButtons .= '<button class="batchButton btn btn-primary" id="buttonBatch"> 
                                <i class="fa fa-play-circle-o" aria-hidden="true"></i> Batch process </button>';

                        $batchButtons .= '</div>';

                        $batchHtml .= $batchButtons;

                    $batchHtml .= '</div>';
                $batchHtml .= '</div>';
            $batchHtml .= '</div>';

            ////////////////////////
            ////// Right panel /////
            ////////////////////////
            $batchHtml .= '<div class="rightFrameParent col-xs-6">';

                $batchHtml .= '<div class="panel panel-default">';
                    $batchHtml .= '<div class="panel-heading" id="batchProcessHead">
                            <div class="batchProgressBar" id="batchProgressBar"></div>
                            <div class="batchProcessText">Batch process <span id="batchCounterDiv"></span> </div> 
                          </div>
                    ';

                    $batchNavbar = '
                        <nav id="batchNavbar" class="navbar navbar-default">
                          <div class="container-fluid">
                            <!--
                            <div class="navbar-header">
                                <a class="navbar-brand">AZ</a>
                            </div>
                            -->
                            <button type="button" class="navbar-toggle collapsed" 
                                data-toggle="collapse" data-target="#batchNavbarContent" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div id="batchNavbarContent" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                ';

                    $batchNavbar .= '<li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchAbout\')";>
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> About
                                    </a></li>';

                    $batchNavbar .= '<li><a href="javascript:void(0)" 
                                            onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettings\', jQuery.zoomBatch.getSettingsInfo);">
                                        <i class="fa fa-list-ul" aria-hidden="true"></i> Settings overview</a>
                                    </li>';

                    $batchNavbar .= '<li class="dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle" 
                                            data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cog" aria-hidden="true"></i> Settings <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu">

                                            <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingStartPic\');">
                                                <i class="fa fa-home" aria-hidden="true"></i> Change "HOME" directory</a>
                                            </li>
                                            <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingExample\');">
                                                <i class="fa fa-code" aria-hidden="true"></i> Change $_GET[\'example\'] value</a>
                                            </li>
                                            <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingFilter\');">
                                                <i class="fa fa-filter" aria-hidden="true"></i> Filter images / folders</a>
                                            </li>
                                            <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingDynImages\');">
                                                <i class="fa fa-file-image-o" aria-hidden="true"></i> Set "dynamic" image sizes</a>
                                            </li>
                                            <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingOther\');">
                                                <i class="fa fa-cogs" aria-hidden="true"></i> Other settings</a>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="javascript:void(0)" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingSave\');">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save / load your settings</a>
                                            </li>
                                            <li><a href="javascript:void(0)" onclick="window.open(\'https://www.ajax-zoom.com/index.php?cid=contact\')">
                                                <i class="fa fa-life-ring" aria-hidden="true"></i> Support</a>
                                            </li>
                                        </ul>
                                    <li>
                                    ';

                    $batchNavbar .= '
                                </ul>
                                '; // ./nav navbar-nav

                    if ($axZmBatchConfig['byPassBatchPass'] !== true) {
                        $batchNavbar .= '
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="javascript:void(0)" onclick="location.href=\'?logout=1\'">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                        </a></li>
                                    </ul>
                                    ';
                    }

                    $batchNavbar .= '
                             </div>
                          </div>
                        </nav>
                    ';

                    $batchHtml .= $batchNavbar;

                    $batchHtml .= '<div class="batchProcess panel-body" id="batchProcess">';

                        // Table header for processed images
                        $batchHtml .= axZmF::batchFilesTableHeader($zoom);

                        /////////////////////////////////
                        // Various adjustable settings //
                        /////////////////////////////////

                        // Base directory
                        $batchHtml .= '
                            <div class="batchSettings" id="batchSettingStartPic">
                                <div class="form-group">
                                    <div class="h4">Change home directory of images</div>
                                    <div>
                                        <p>The folder structure is parsed once and saved into a session. 
                                            You can refresh the folder and subfolder structure 
                                            by pressing on reload button next to the dropdown with all folders. 
                                            Avoid entering "/" as it will parse all your folders, 
                                            which might take too long and is mostly unneeded for this batch tool.
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="HOME start directory" value="'.$_SESSION['axZmBtch']['startPic'].'">
                                    </div>
                                    <button class="btn btn-default btn-info" type="button" onclick="jQuery.zoomBatch.submitStartPicBatch()">Submit</button> 
                                </div>
                            </div>
                        ';

                        // $_GET['example']
                        $batchHtml .= '
                            <div class="batchSettings" id="batchSettingExample">
                                <div class="form-group">
                                    <div class="h4">Change $_GET[\'example\'] value</div>
                                    <div>
                                        <p>Each example in the download package, as well as e-commerce modules / plugins, 
                                            use a special configuration options set, defined by the value of the  
                                            query string argument "example" ($_GET[\'example\']), 
                                            which is passed internally by AJAX-ZOOM scripts. 
                                            In modules / plugins, you can change this value directly from AJAX-ZOOM module configuration 
                                            at the backend of your system. 
                                        </p>
                                        <p>What does it do? 
                                            The default options from "/axZm/zoomConfig.inc.php" are overridden in "/axZm/zoomConfigCustom.inc.php", 
                                            which is included at the bottom of "/axZm/zoomConfig.inc.php". The default options can be also 
                                            overridden by placing them into "zoomConfigCustomAZ.inc.php" (this file is located outside of "/axZm" folder). 
                                            Options set in "zoomConfigCustomAZ.inc.php" override options from "/axZm/zoomConfig.inc.php" and 
                                            "/axZm/zoomConfigCustom.inc.php".
                                        </p>
                                        <p>For the batch tool this value is important, because
                                            depending on $_GET[\'example\'] value, some options e.g. thumbnail or preview image sizes and quality settings 
                                            may differ. So before using this batch tool, please make sure that the values match 
                                            the values you are using at frontend.
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="HOME start directory" value="'.$_SESSION['axZmBtch']['exampleValue'].'">
                                    </div>
                                    <button class="btn btn-default btn-info" type="button" onclick="jQuery.zoomBatch.submitNewExampleValue()">Submit</button> 
                                </div>
                            </div>
                        ';

                        // Dynamic image sizes
                        $batchHtml .= '
                            <div class="batchSettings" id="batchSettingDynImages">
                                <div class="form-group">
                                    <div class="h4">Set image sizes for images generated over AJAX-ZOOM "imaging server"</div>
                                    <div>
                                        <p>On default, when using AJAX-ZOOM extensions such as 
                                            <a href="https://www.ajax-zoom.com/examples/example32.php" target="_blank" rel="nofollow">mouseover extension example32</a>, 
                                            few images are generated on-the-fly using the AJAX-ZOOM built in "imaging server". 
                                            These images do not directly relate to AJAX-ZOOM player, 
                                            but to the AJAX-ZOOM extension in use (<strong>for the 360 / 3D images they are not needed</strong>).
                                            Same as all caches in AJAX-ZOOM, these dynamically generated images are also created on-the-fly. 
                                            In case you want to pre-generate them as well, you can set the sizes and quality below:
                                        </p>
                                        <p><button class="btn btn-xs" onclick="jQuery.zoomBatch.dynImageSizesSet(jQuery.zoomBatch.mouseOverDefault)">Press here</button> 
                                            if you want to set the sizes to same default values, as in the mouseover extension 
                                            (<a href="https://www.ajax-zoom.com/examples/example32.php" target="_blank" rel="nofollow">example32</a> example). 
                                            This is what is used on default in all our plugins / modules for e-commerce like Magento, Prestashop etc.
                                        </p>
                                        <p>When this batch tool will be incorporated into AJAX-ZOOM modules / plugins, 
                                            we will set the values directly from the options, which are set 
                                            in the backend of these modules.
                                        </p>
                                    </div>
                                    <div class="row form" id="batchDynImgTemplate" style="display: none; margin-top: 20px;">
                                        <div class="col-xs-2 small">Width</div>
                                        <div class="col-xs-2 small">Height</div>
                                        <div class="col-xs-2 small">Quality</div>
                                        <div class="col-xs-4 small">Mode</div>
                                        <div class="col-xs-2 small">&nbsp;</div>

                                        <div class="col-xs-2"><input name="batchDynImgWidth" class="form-control input-sm" value=""></div>
                                        <div class="col-xs-2"><input name="batchDynImgHeight" class="form-control input-sm" value=""></div>
                                        <div class="col-xs-2"><input name="batchDynImgQual" class="form-control input-sm" value=""></div>
                                        <div class="col-xs-4">
                                            <select name="batchDynImgThumbMode" class="form-control input-sm">
                                                <option value="false" selected>false</option>
                                                <option value="cover">cover</option>
                                                <option value="contain">contain</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <button class="btn btn-sm btn-danger pull-right">
                                                <i class="fa fa-minus" aria-hidden="true" title="Remove line"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Form container -->
                                    <div id="batchDynImgForm"></div>
                                    <div style="margin-top: 30px" class="clearfix">
                                        <button class="btn btn-default btn-success btn-sm pull-right" type="button" onclick="jQuery.zoomBatch.dynImageSizesAppend({})">
                                            <i class="fa fa-plus" aria-hidden="true" title="Add new line"></i>
                                        </button>
                                    </div>
                                    <div style="margin-top: 30px">
                                        <button class="btn btn-default btn-info" type="button" onclick="jQuery.zoomBatch.submitDynImagesValues()">
                                            Submit
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                        ';

                        // Filter images and folders by name, image sizes
                        $batchHtml .= '
                            <div class="batchSettings" id="batchSettingFilter">
                                <div class="form-group">
                                    <div class="h4">Set filters for image names and folder names</div>
                                    <div>
                                        <p>In some constellations, you want to exclude certain folders and certain images 
                                            from being processed by the batch tool. 
                                            This is because for example in your CMS or e-commerce solution,
                                            the lower resolution images / thumbnails, generated by your e-commerce solution 
                                            are located in the same folder as the original uploaded image. 
                                            For instance, "PrestaShop" has such an unfavorable file structure for product images. 
                                        </p>
                                        <p>AJAX-ZOOM does only need to process original images. 
                                            So, in case the files structure of your solution 
                                            does not allow you to process all images under a certain 
                                            folder and subfolders, you would need to exclude them over 
                                            a pattern. This pattern offered here is a string in file name. 
                                            You can add as many strings as you like.
                                        </p>
                                        <p>You can enter a simple string, e.g. <strong>_medium</strong>. 
                                            In this case, this string will be evaluated over the 
                                            <strong>PHP strstr</strong> function 
                                            - find the first occurrence of a string (case sensitive).
                                        </p>
                                        <p>You can also use a regular expression! In this case, 
                                            the <strong>PHP preg_match</strong> function will be applied. 
                                            The string must contain a slash - <strong>/</strong> to be 
                                            interpreted as regex.
                                        </p>
                                    </div>
                                    <div class="row form" id="batchFilterTemplate" style="display: none; margin-top: 10px;">
                                        <div class="col-xs-10"><input name="batchFilterString" class="form-control input-sm" value=""></div>
                                        <div class="col-xs-2">
                                            <button class="btn btn-sm btn-danger pull-right">
                                                <i class="fa fa-minus" aria-hidden="true" title="Remove line"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Form container -->
                                    <h4 style="margin-top: 30px;">Files</h4>
                                    <div id="batchFilterFormFiles"></div>
                                    <div style="margin-top: 30px" class="clearfix">
                                        <button class="btn btn-default btn-success btn-sm pull-right" type="button" onclick="jQuery.zoomBatch.appendFilterLine(\'Files\', null, this)">
                                            <i class="fa fa-plus" aria-hidden="true" title="Add new line"></i>
                                        </button>
                                    </div>

                                    <h4>Folders</h4>
                                    <div id="batchFilterFormFolders"></div>
                                    <div style="margin-top: 30px" class="clearfix">
                                        <button class="btn btn-default btn-success btn-sm pull-right" type="button" onclick="jQuery.zoomBatch.appendFilterLine(\'Folders\', null, this)">
                                            <i class="fa fa-plus" aria-hidden="true" title="Add new line"></i>
                                        </button>
                                    </div>

                                    <h4>Minimal image resolution</h4>
                                    <p>Set limit for image size (resolution), defined as integer width x height. 
                                        For example an 3000px x 2000px image has a resolution of 6000000 (pixels).
                                    </p>
                                    <input name="batchFilterResolution" class="form-control input-sm" value="">

                                    <div style="margin-top: 30px">
                                        <button class="btn btn-default btn-info" type="button" onclick="jQuery.zoomBatch.submitFilters()">
                                            Submit
                                        </button>
                                    </div>

                                </div>
                            </div>
                        ';

                        // Other settings
                        $batchHtml .= '
                            <div class="batchSettings" id="batchSettingOther">
                                <div class="form-group">
                                    <div class="h4">Other Settings</div>
                                    <p>Set various other settings in this batch tool.
                                    </p>
                                    <div class="row" style="margin-top: 30px">
                                        <div class="col-md-6">
                                            Pause while batch processing between each image (ms)
                                        </div>
                                        <div class="col-md-6">
                                            <input name="pause" class="form-control input-sm" 
                                                value="'.$zoom['batch']['pause'].'">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-md-6">
                                            Confirm, when deleting cache
                                        </div>
                                        <div class="col-md-6">
                                            <input name="confirmDelete" type="checkbox" value="1" 
                                                '.($zoom['batch']['confirmDelete'] ? 'checked' : '').'>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-md-6">
                                            Stop batch processing if an error occurs
                                        </div>
                                        <div class="col-md-6">
                                            <input name="stopOnError" type="checkbox" value="1" 
                                                '.($zoom['batch']['stopOnError'] ? 'checked' : '').'>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-md-6">
                                            Show small thumbnails of the images in the batch list
                                        </div>
                                        <div class="col-md-6">
                                            <input name="enableBatchThumbs" type="checkbox" value="1" 
                                                '.($zoom['batch']['enableBatchThumbs'] ? 'checked' : '').'>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-md-6">
                                            Thumbnails Image size for the batch list if activated
                                        </div>
                                        <div class="col-md-6">
                                            <input name="batchThumbsDynString" class="form-control input-sm" 
                                                value="'.$zoom['batch']['batchThumbsDynString'].'">
                                        </div>
                                    </div>

                                    <div style="margin-top: 30px">
                                        <button class="btn btn-default btn-info" type="button" onclick="jQuery.zoomBatch.setOtherSettings()">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        ';

                        // Save / Load settings
                        $batchHtml .= '
                            <div class="batchSettings" id="batchSettingSave">
                                <div class="form-group">
                                    <div class="h4">Save / load settings</div>
                                    <p>The settings, which you set 
                                        in the settings menue are valid for one session only. 
                                        If you logout or reload this batch tool, all of the custom settings you have made are reset. 
                                        Also, you might want to specify the settings separatly for 
                                        360 images and your regular product images. 
                                        Anyway, you can save the settings to your disk (download) as JSON file and load them 
                                        later from this downloaded file.
                                    </p>
                                    <div class="row" style="margin-top: 30px">
                                        <div class="col-md-6">
                                            <button class="btn btn-block btn-info" type="button" style="margin-bottom: 10px" 
                                                onclick="jQuery.zoomBatch.saveBatchSettings()">
                                                <span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span>
                                                Save settings to file
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="btn btn-block btn-primary" style="margin-bottom: 10px">
                                                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Browse (select from disk)
                                                <input type="file" accept=".json" class="hidden" onchange="jQuery.zoomBatch.loadBatchSettings(event, this)">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';

                        // Number of images selected in files table
                        $batchHtml .= '
                            <div class="batchInfo" id="batchFilesInfo" style="display: none;">
                                <div class="form-group">
                                    <div class="h4">Information about images in selected folders and subfolders</div>
                                    <p>Before processing a large amount of images in folders and subfolders, 
                                        you can see here how many images and which images are there 
                                        (filters for files and folders (except the resolution filter) are preserved if set). 
                                    </p>
                                    <p>On default, this list does not give you the information about if these 
                                        images need to be processed. If they are already processed however, 
                                        they will be not be processed again when you push the "Batch process" button. 
                                        Activate the "need processing" checkbox to get information only about images, 
                                        which need processing (will take longer).
                                    </p>
                                    <p>One more note: if you request a list of files and it is very large - 
                                        20k+ images, the browser may crash.
                                    </p>
                                    <div>
                                        <button class="btn btn-sm btn-info" 
                                            onclick="jQuery.zoomBatch.getNumberImages(1, this)" 
                                            style="margin: 10px 5px 0 0">
                                            <i class="fa fa-question-circle-o" aria-hidden="true" style="margin-right: 5px"></i>
                                            Get only number
                                        </button> 

                                        <button class="btn btn-sm btn-info" 
                                            onclick="jQuery.zoomBatch.getNumberImages(2, this)" 
                                            style="margin: 10px 5px 0 0">
                                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true" style="margin-right: 5px"></span> 
                                            Get files list
                                        </button> 

                                        <button class="btn btn-sm btn-info" 
                                            onclick="jQuery.zoomBatch.getNumberImages(3, this)" 
                                            style="margin: 10px 5px 0 0">
                                            <span class="glyphicon glyphicon-th-list" aria-hidden="true" style="margin-right: 5px"></span>
                                            Files list with full info
                                        </button> 

                                        <div>
                                            <span class="text-nowrap" style="margin: 10px 5px 0 0; display: inline-block">
                                                <input type="checkbox" id="getNumberImagesToProcess"> - need processing
                                            </span>
                                            <span class="text-nowrap" style="margin: 10px 5px 0 0; display: inline-block">
                                                <input type="checkbox" id="getNumberImagesWithPath"> - files list with paths
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="batchFilesInfoResults"></div>
                                <div id="batchFilesInfoTableResults" style="margin-top: 30px"></div>
                            </div>
                        ';

                        // View images in AJAX-ZOOM player
                        $batchHtml .= '
                            <div class="batchInfo" id="batchViewInPlayer" style="display: none;">
                                <div class="form-group">
                                    <div class="h4">View images in AJAX-ZOOM player</div>
                                    <p>You can view the images from the left files panel directly in AJAX-ZOOM player. 
                                        As single image / gallery, as 360 view or as 3D (multirow) view. 
                                        Please read the insturctions below. 
                                    </p>
                                    <p>The 
                                        <a href="javascript: void(0)" onclick="$.zoomBatch.toggleSettingTab(\'batchSettingExample\')">query string argument ($_GET[\'example\']) value</a>, 
                                        passed to AJAX-ZOOM player is 
                                        <strong id="batchViewPlayerExampleValue">'.$_SESSION['axZmBtch']['exampleValue'].'</strong>
                                    </p>
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-lg-8">
                                            Load a single image or more images as gallery. 
                                            Select images by checkboxes in the files list to the left 
                                            or select one folder with images in it. 
                                            If nothing is selected, all images in current directory will be loaded.
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="btn btn-info btn-block" style="text-align: left;" 
                                                onclick="jQuery.zoomBatch.showInPlayer(\'gallery\', this)">
                                                <i class="fa fa-picture-o" aria-hidden="true" style="margin-right: 5px"></i> 
                                                Load as gallery
                                            </button> 
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-lg-8">
                                            Load all images in current folder as 360 degree (single row) spin. 
                                            Nothing needs to be checked. Or load a single, checked folder as single row spin.
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="btn btn-info btn-block" style="text-align: left;" 
                                                onclick="jQuery.zoomBatch.showInPlayer(\'360\', this)">
                                                <i class="fa fa-cube" aria-hidden="true" style="margin-right: 5px"></i> 
                                                Load as 360 view
                                            </button> 
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-lg-8">
                                            Load all subfolders of the currect directory as 3D (multi - row). 
                                            Or select a one folder, which contains subfolders with images, representing the rows of 3D.
                                        </div>
                                        <div class="col-lg-4">
                                            <button class="btn btn-info btn-block" style="text-align: left;" 
                                                onclick="jQuery.zoomBatch.showInPlayer(\'3d\', this)">
                                                <i class="fa fa-cubes" aria-hidden="true" style="margin-right: 5px"></i> 
                                                Load as 3D view
                                            </button> 
                                        </div>
                                    </div>
                                </div>
                                <div class="embed-responsive" style="padding-bottom: 80%">
                                    <div class="embed-responsive-item" id="batchViewPlayer">
                                        <div class="batchViewPlayerIdle"></div>
                                    </div>
                                </div>
                                <div style="margin-top: 15px; display: none;" id="batchViewPlayer360Options">
                                    <button class="btn btn-sm btn-default" style="margin: 0 10px 10px 0" 
                                        onclick="jQuery.zoomBatch.spinReverseToggle(this)">spinReverse</button>

                                    <button class="btn btn-sm btn-default" style="margin: 0 10px 10px 0" 
                                        onclick="jQuery.zoomBatch.spinReverseZToggle(this)">spinReverseZ</button>
                                </div>
                                <div style="margin-top: 15px; display: none; text-align: center;" id="batchViewPlayerOptions">
                                    <button class="btn btn-sm btn-default" style="margin: 0 10px 10px 0" 
                                        onclick="jQuery.fn.axZm.zoomPrevNext(\'prev\', \'SwipeHorz\'); $(this).blur();">Prev image</button>

                                    <button class="btn btn-sm btn-default" style="margin: 0 10px 10px 0" 
                                        onclick="jQuery.fn.axZm.zoomPrevNext(\'next\', \'SwipeHorz\'); $(this).blur();">Next image</button>
                                </div>
                            </div>
                        ';

                        // Condensed information about the settings
                        $batchHtml .= '<div class="batchInfo" id="batchAbout">';
                        $batchHtml .= axZmF::getBatchAbout($zoom);
                        $batchHtml .= '</div>';

                        $batchHtml .= '<div class="batchInfo" style="display: none;" id="batchFilterNeedCache">';
                            $batchHtml .= '<h3>Smart load folders and files</h3>';
                            $batchHtml .= '
                                <div class="form-group">
                                    <p>Load directory tree in a way, 
                                        that only folders are loaded, where 
                                        (current settings and filters preserved) AJAX-ZOOM cache needs to be generated. 
                                    </p>
                                    <p>The initial load of the directory tree will take longer, 
                                        than just loading the entire folder structure. 
                                        However, when you select all folders and hit "Batch process" button, 
                                        the entire process will take much less time, than traversing throw 
                                        all folder structure while most AJAX-ZOOM cache is alredy generated. 
                                        Other words, there will be no folders and subfolders in the left panel, 
                                        if there are no images in these folders for which AJAX-ZOOM needs 
                                        to generate anything.
                                    </p>
                                </div>';
                        $batchHtml .= '<button class="btn btn-default btn-info" id="buttonFilterNeedCache" 
                                onclick="jQuery.zoomBatch.batchFilterNeedCache(\'images\')">
                                <i class="fa fa fa-magic" aria-hidden="true"></i> Reload directory tree </button>';
                        $batchHtml .= '</div>';

                        $batchHtml .= '<div class="batchInfo" style="display: none;" id="batchSettings">';
                            $batchHtml .= '<h3><button class="btn btn-sm btn-info pull-right" id="getSettingsInfoBtn"
                                onclick="jQuery.zoomBatch.getSettingsInfo()" title="Update these settings information"><span>&#8634;</span>
                                </button> 
                                Information about important settings in this batch file
                            </h3>';
                            $batchHtml .= '<p>These settings mostly depend on 
                                the settings defined in AJAX-ZOOM configuration files - 
                                "/axZm/zoomConfig.inc.php" || "/axZm/zoomConfigCustom.inc.php" || "zoomConfigCustomAZ.inc.php" 
                                (located outside of axZm folder) 
                                and partly options set within this batch file / batch configuration file 
                                (batch.config.inc.php if present). Some of them, you can change over the 
                                "Settings" navigation menu above.
                            </p>';
                            $batchHtml .= '<table id="infoSettings" cellspacing="1">';
                            $batchHtml .= axZmF::getBatchSettingsInfo($zoom);
                            $batchHtml .= '</table>';
                        $batchHtml .= "</div>";

                        $batchHtml .= '<div class="batchProcessFoot" id="batchResults"></div>';
                    $batchHtml .= '</div>';

                    $batchHtml .= '<div class="rightFrameFoot panel-footer" id="rightFrameFoot" style="display: none;">';
                    $batchHtml .= '</div>';
                $batchHtml .= '</div>';
            $batchHtml .= '</div>';
        $batchHtml .= '</div>';
    $batchHtml .= '</div>';

    $batchHtml .= '</body>
    </html>';

    //$batchHtml = preg_replace('/\s+/', ' ', $batchHtml);
    echo $batchHtml;
}
