<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomConfig.inc.php
* Copyright: Copyright (c) 2010-2020 Vadim Jacobi
* License Agreement: https://www.ajax-zoom.com/index.php?cid=download
* Version: 5.4.4
* Date: 2020-04-25
* Review: 2020-06-01
* URL: https://www.ajax-zoom.com
* Documentation: https://www.ajax-zoom.com/index.php?cid=docs


////////////////////////////////////////////////////////////////
////////////////// Configuration settings //////////////////////
////////////////////////////////////////////////////////////////

If you want to know more about how you can set configuration settings and where,
please see here:

https://www.ajax-zoom.com/index.php?cid=blog&article=options_config&lang=en


////////////////////////////////////////////////////////////////
/////////////////////////// Skinning ///////////////////////////
////////////////////////////////////////////////////////////////

In order to change the template into your own (skin AJAX-ZOOM) simply set $zoom['config']['buttonSet'] option,
create a subfolder under /axZm/icons/{yourTemplate} and put your buttons into it (copy them from /axZm/icons/default at first).
Also create a new CSS file in /axZm/styles/{yourTemplate}/style.css;
If needed adjust the width and height of the buttons (w and h keys) by editing corresponding $zoom['config']['icons'] array,
e.g. $zoom['config']['icons']['pan'] = array('file' => 'zoombutton_pan', 'ext' => 'jpg', 'w'=>31, 'h'=>31);


////////////////////////////////////////////////////////////////
//////////////////////// 360 & 3D info /////////////////////////
////////////////////////////////////////////////////////////////

VERY IMPORTANT THINGs TO TAKE ACCOUNT OF WITH 360 OR 3D
Every image must have an unique filename!!!
This is also the case if images are prepared for completely different 360s or 3D;
If all your source images happen to have the same filenames (e.g. spin001.jpg, spin002.jpg, [...], spin036.jpg),
you could then prefix each image of a spin e.g. with the product ID or something else logical to ensure this uniqueness, e.g.
/360_source_images/123/123_spin001.jpg,
/360_source_images/123/123_spin002.jpg,
/360_source_images/123/123_spin003.jpg,
[...],
/360_source_images/123/123_spin036.jpg

3D (MULTIROW / SPHECICAL)
The only difference between regular 360 spin and multirow is that original images are placed in subfolders of the target folder.
E.g. the path along with the example parameter passed to AJAX-ZOOM is "example=spinIpad&3dDir=/pic/zoomVR/nike";
Now if it is 3D (multirow) and not 360, then images of each row are placed in subfolders of the target 3dDir parameter,
e.g. /pic/zoomVR/nike/0, /pic/zoomVR/nike/15, /pic/zoomVR/nike/30, /pic/zoomVR/nike/45, /pic/zoomVR/nike/60, /pic/zoomVR/nike/75, /pic/zoomVR/nike/90;
It is not important how these subfolders are named (e.g. it could be row1, row2 ...) and you also do not need to define these subfolder names anywhere.
AJAX-ZOOM will instantly detect them and process all the images in them. For more info and visualization of the file structure see example28.php
*/

if (!isset($axZmH)) {
    exit;
} else {
    $axZmH->start();
}

if(!session_id()) {
    session_start();
}

unset($zoom, $zoomTmp);
$zoom = array();
$zoomTmp = array();



/////////////////////////////////////////////////////////////////////////
////////////////////////  Start configuration ///////////////////////////
/////////////////////////////////////////////////////////////////////////

// Type of the licence: Evaluation, Developer, Basic, Standard, Business, Corporate, Enterprise or Unlimited, use Basic for demo
$zoom['config']['licenceType'] = 'Basic'; // string

// Type in the Licence Key or 'demo'
$zoom['config']['licenceKey'] = 'demo'; // string

// More than one license for several domains
$zoom['config']['licenses'] = array(
    /*
    'yourDomainName.com' => array(
        'licenceType' => 'Basic',
        'licenceKey' => 'demo'
    ),
    'otherDomainName.com' => array(
        'licenceType' => 'Basic',
        'licenceKey' => 'demo'
    )
    */
);

// Ver. 5.3.0+ Load original images instead of image tiles on zoom.
// Instantly activated when $zoom['config']['licenceType'] is simple
// Set to true to activate, set to false to deactivate
// Exclusive for Unlimited version: set to an integer value,
// e.g. 5000000 to instaly activate simpleMode only, if the image size is less than 5 megapixels (5 million pixels).
// Please note: if you are using an AJAX-ZOOM plugin / module for e.g. Prestashop or Magento,
// and simpleMode is activated, you should check that "deny from all" line in .htaccess file from the directory,
// where the plugin saves the 360 images, is removed from .htaccess file. Do not delete the file, only that line please.
$zoom['config']['simpleMode'] = false; // mixed

// Set memory limit to whatever you need
ini_set('memory_limit', '128M');

// Set PHP memory limit for heavy operations like image tiling
$zoom['config']['memory_limit'] = '512M';

// Version number of this config file
$zoom['config']['version'] = '5.4.0';

// Iso language, e.g. 'en'
$zoom['config']['lang'] = $axZmH->getLang();

// Compare the creation time of the original image with the creation time of images made by AJAX-ZOOM
// In case the creation time of the original image is newer, all AJAX-ZOOM images are renewed.
// Possible values: false, filectime, filemtime
$zoom['config']['cTimeCompare'] = false;

// Display dialog telling that cTimeCompare was used on a particular image
$zoom['config']['cTimeCompareDialog'] = true;

// Autorotate images depending on exif information written by the camera.
// If you want to keep exif information of the original file you will need the PEL exif library.
// Download at https://lsolesen.github.com/pel and put the files from src directory into /axZm/classes/pel/
$zoom['config']['exifAutoRotation'] = false; // boolen

// Max dimensions for initial images
// Initial images are images, that are displayed first
// [int max width]x[int max height], e.g. 420x280, 480x320, 480x360, 600x400, 480x720, 480x480, 600x600, 780x520, 800x600
// Do not set picDim dynamically for responsive layouts!
// Use jQuery.fn.axZm.openFullScreen instead!!!
$zoom['config']['picDim'] = '600x600'; // string
$zoom['config']['picDimDefault'] = $zoom['config']['picDim'];

// Array with additional inital images which are loaded depending on viewer size / resolution
$zoom['config']['stepPicDim'] = array(
    1 => array('w' => 900, 'h' => 900, 'q' => 80),
    2 => array('w' => 1200, 'h' => 1200, 'q' => 70)
);

// If $zoom['config']['stepPicDim'] is not empty, additional initial images will be predicted and preloaded.
$zoom['config']['stepPicPreload'] = true;

// If $zoom['config']['stepPicDim'] is not empty use "more suited" preview images also on zoom.
$zoom['config']['stepPicOnZoom'] = true;

// Type of folder, subdolder structure for preview images, tiles and thumbnails
// possible values:
// md5 - first 1 char from md5 hashed filename without type / second 1 char from md5 hashed filename without type (max. 16 folders with max. 16 subfolders in each = max. 256)
// md5_2 - first 2 chars from md5 hashed filename without type / second 2 char from md5 hashed filename without type
// char - first 1 char from filename without type / second 1 char from filename without type
// char_2 - first 2 chars from filename without type / second 2 chars from filename without type
// flat or false - no subfolders

// "md5", "md5_2":
// + guaranties even distribution of the files across subfolders independent of filenames
// + folders can be distributed across several drives
// - not intuitive if you access cache with FTP or simmilar

// "char", "char_2":
// + intuitive when you accessed cache with FTP or simmilar
// + folders can be distributed across several drives
// +- there could be more than 256 subfolders but also less depending on first characters of the files
// - does not guarantie even distribution of the files if filenames are not mixed

// "flat" or false: (before ver. 4.2.1)
// + intuitive when you accessed cache with FTP or simmilar
// - the number of images / subfolders (tiles) in on folder can exceed a maximum imposed by some file systems and slow down read time on older file systems.
// - opening the folders with FTP client or simmilar might fail or last very long if you have k thousands of images / subfolders in them
$zoom['config']['subfolderStructure'] = 'char';
$zoom['config']['subfolderStructureChmod'] = 0777;

// 4.4.3+ Migrate from previous structure to new if subfolderStructure is changed
$zoom['config']['subfolderStructureMigrate'] = false;

// Enlarge image if smaller than picDim
$zoom['config']['enlargeSmallImage'] = false;

// Dialog after initial images has been created
$zoom['config']['firstImageDialog'] = false;

// The viewpoint (viewport) when the user clicks on the image
$zoom['config']['gravity'] = 'viewPoint'; // string, , possible values: 'viewPoint' or 'center'

// What happens if the user clicks somewhere on max zoom (100%)
// "center" will move the clicked point to the center
// "adverse" will flip the clicked point to the other side
// "none" will not do anthing
// just change the setting to sea the difference, both make sense
// 5.1.1 changed name
$zoom['config']['traverseGravity'] = 'center'; // string, possible values: 'adverse', 'center' or 'none'

// Being at 100% zoom one more click will restore the zoom
$zoom['config']['zoomOutClick'] = false;

// Disable zoom globally
$zoom['config']['disableZoom'] = false;

// Add exceptions to disableZoom, possible values:
// zoomInClick, zoomOutClick, areaSelect, onSliderZoom, onZoomInButton, onZoomOutButton, onButtonClickMove_N,
// onButtonClickMove_E, onButtonClickMove_S, onButtonClickMove_W, onMouseWheelZoomIn, onMouseWheelZoomOut
$zoom['config']['disableZoomExcept'] = array('onSliderZoom');

// Ver. 4.3.1+ Disable zooming for click or double click
$zoom['config']['disableClickZoom'] = false; // true, false

// Ver. 4.3.1+ Zooming with pinch zoom is disabled, instead the user will be only able to drag / pan
$zoom['config']['pinchZoomOnlyDrag'] = false;

// Use ImageMagick for all image processing.
// Overrides all other options regarding the choice between GD and ImageMagick.
$zoom['config']['iMagick'] = false; // bool

// Generate PNG images, tiles etc. instead of JPG
// Ver. 4.4.1+ Possible values: false, true, 'auto'
// 'auto' will create png images only if source image is also png
$zoom['config']['pngMode'] = false;

// Keep transparent areas of the images when pngMode is enabled.
// When using GD2 the results might be not satisfactory (noice) depending on the compiled libs.
$zoom['config']['pngKeepTransp'] = false;

// Background color for transparent areas of the png image
$zoom['config']['pngBackgroundColor'] = '#FFFFFF'; // string

// 5.4.0+ When resizing an image, the PHP GDlib may produce artifacts on large white areas.
// If your monitor significatnly  changes the contrast when looking at it, e.g. from top, you may notice those artifacts clearly.
// Enabling this function prevents this, however it will substantially enlarge the amount of time
// for initial generating of the cache and consume more server resources.
// If you are worried about those quality issues and server resources,
// you should then consider to use imagemagick instead of the PHP's GDlib.
$zoom['config']['gdLibFixArtifacts'] = false;

// 5.4.0+ The resoltion limit of resized image to fix artifacts if enabled by $zoom['config']['gdLibFixArtifacts'].
// Width x Height, e.g. 1200x1200 = 1440000
$zoom['config']['gdLibFixArtifactsResLimit'] = 1440000; // int

// Use Imagemagick to crop images, make intitial images and thumbs
// If set to false, GD will be used, else ImageMagick
// If you want enable Imagemagick for all sizing and cropping operations, enable iMagick option.
// iMagick option automatically enables this option as well.
$zoom['config']['im'] = false; // bool

// Keep color and other profiles for all operations processed with ImageMagick.
$zoom['config']['imKeepProfiles'] = false; // bool

// Only for ImageMagick: limit memory and other settings
// By default they are set to a very high value and automatically adjusted to abailable system resources
// https://www.imagemagick.org/script/command-line-options.php#limit
$zoom['config']['imLimit'] = array();
$zoom['config']['imLimit']['memory'] = false; // false or integer (MB)
$zoom['config']['imLimit']['map'] = false; // false or integer (MB)
$zoom['config']['imLimit']['area'] = false; // false or integer (MB)
$zoom['config']['imLimit']['disk'] = false; // false or integer (MB)
$zoom['config']['imLimit']['thread'] = false; // false or integer (number of threads of execution)
$zoom['config']['imLimit']['time'] = false; // false or integer (maximum elapsed time in seconds)

// Server path to imagemagick convert ver. 6+, if you have one... like "/usr/bin/convert" or just "convert"
// You do not need to use imageMagick, it is optional!
$zoom['config']['imPath'] = 'which convert';

// Only for ImageMagick: remove or replace single quotes in exec string. Possible values: 'remove', 'replace' oder false.
// 'replace' will replace them to double quotes.
$zoom['config']['imQuotes'] = false;

// Output JPG quality for zoomed images, 80 is ok
// More is better quality, but bigger filesize
$zoom['config']['qual'] = 80; // int, max 100

// Output PNG quality for zoomed images.
$zoom['config']['qualPng'] = array(
    'qual' => 9, // false (default) or int from 0 (no compression) to 9
    'filtering' => 5 // only Imagemagick: false (default) or int from 0 to 5. PNG data encoding filtering (before it is comressed) type: 0 is none, 1 is "sub", 2 is "up", 3 is "average", 4 is "Paeth", and 5 is "adaptive"
);

// Alternatively you can set a quality range depending on users internet connection.
// However the speed is measured on the fly with images, that are downloaded anyway.
// So the measured speed can be regarded as rough orientation and is mostly below the actual internet connection.
// Also a slow client or webserver performance can lead to decreased measurements.
$zoom['config']['qualRange'][1] = false; // low range jpg quallity, integer, < 100, e.g. 50
$zoom['config']['qualRange'][2] = false; // upper range jpg quallity, integer, max. 100, e.g. 90
$zoom['config']['qualRange'][3] = false; // low range kbit/s, integer, e.g. 128
$zoom['config']['qualRange'][4] = false; // upper range kbit/s, integer, e.g. 768

// Output JPG quality for initial images
$zoom['config']['initPicQual'] = 90; // int, max 100

// Output PNG quality for initial images.
$zoom['config']['initPicQualPng'] = array(
    'qual' => 9, // false (default) or int from 0 (no compression) to 9
    'filtering' => 5 // only Imagemagick: false (default) or int from 0 to 5. PNG data encoding filtering (before it is comressed) type: 0 is none, 1 is "sub", 2 is "up", 3 is "average", 4 is "Paeth", and 5 is "adaptive"
);

// 5.1.0+ Interlace initial images, possible values "Plane", "Line" or false
$zoom['config']['initPicInterlace'] = false; // string, bool

// Not touch device, array with possible strings within user agent string, e.g. array('webkit viewer', 'somthing_else');
$zoom['config']['notTouchUA'] = array();

// Use POST instead of GET for all AJAX requests
// Can be overwritten by passing arguments to
// jQuery.fn.axZm, jQuery.fn.axZm.load or jQuery.fn.axZm.openFullScreen
$zoom['config']['postMode'] = false;

// Regex for checking filename
$zoom['config']['regexFilename'] = "/^[a-zA-Z\_0-9]+([a-zA-Z\_0-9\-\.\,\(\)\[\]\%\s+]+)?\.+[a-zA-Z]{3,4}$/";

// Regex for checking paths
$zoom['config']['regexPath'] = "/^[a-zA-Z\_0-9\:\/]+([a-zA-Z\_0-9\:\.\,\(\)\[\]\-\/\s+]*)$/";

// Regex for checking file types (images magick could possibly process many other file types)
$zoom['config']['fileTypeArray'] = array('jpg', 'jpeg', 'tif', 'tiff', 'gif', 'png', 'bmp', 'psd');







//////////////////////////////////////////////////////
////////// Major directories and filenames////////////
//////////////////////////////////////////////////////

// Full server path to base dir, e.g. /srv/www/htdocs/webXXX or /home/your_domain/public_html
// Usually it is $_SERVER['DOCUMENT_ROOT']; without slash at the end !!!
$zoom['config']['fpPP'] = $axZmH->checkSlash(realpath($_SERVER['DOCUMENT_ROOT']), 'remove'); // string

// Installation path, e.g /test/ajax-zoom-test (without slash at the end)
// Set this parameter to '' if you want to set the paths individually, where $zoom['config']['installPath'] used a prefix
// uncomment if using the Phalanger version and double slashes at beginning should be kept
// define('PHALANGER_DOUBLE_SLASH_FIX', true);
$zoom['config']['installPath'] = $axZmH->installPath($zoom['config']['fpPP']);

// "frontend" path which should be adjusted in some cases
$zoom['config']['urlPath'] = $axZmH->installPath($zoom['config']['fpPP']);

// Remove a part of the string (path) passed to AJAX-ZOOM from an application
// Usefull if e.g. rewriteBase in htaccess is set the way that AJAX-ZOOM gets wrong paths for images
// e.g. Bitnami Magento and XAMPP on localhost, the path in the browser is
// http://192.168.178.27/magento, then the setup for making AZ extension work would be:
// $zoom['config']['fpPP'] = 'C:/xampp/apps/magento/htdocs';
// $zoom['config']['urlPath'] = '/magento/js/axzoom';
// $zoom['config']['rewriteBase'] = '/magento';
$zoom['config']['rewriteBase'] = '';

// Folder where icons are located, absolute path
// With a slash at the end!
// This folder should not be password protected!
$zoom['config']['icon'] = '/axZm/icons/'; // string

// Folder where javascript files are located
// With a slash at the end!
// This folder should not be password protected!
$zoom['config']['js'] = '/axZm/'; // string

// Dynamic load of all necessary jquery plugins and css files
// After a check weather plugins have aleredy been loaded the js and css files are loaded instantly on start
// If true there is no need to use the php class method drawZoomStyle and drawZoomJs,
// just include:
// <link rel="stylesheet" href="/axZm/axZm.css" type="text/css">
// <script type="text/javascript" src="/axZm/jquery.axZm.js"></script>
// into the head section of your html
$zoom['config']['jsDynLoad'] = true; // bool

// If jsMin is true the minified versions of the plugins will be loaded
$zoom['config']['jsMin'] = true; // bool

// Load all jQuery UI moduls
$zoom['config']['jsUiAll'] = false;

// jQuery UI version used by AJAX-ZOOM (/axZm/plugins/jquery.ui/js)
$zoom['config']['jsUiVer'] = '1.8.24';

// Easily switch between jQuery UI themes by changing the value of this option.
// The UI theme loaded is located under /axZm/plugins/jquery.ui/themes/[jsUiTheme];
// You can create your own or import already existing.
$zoom['config']['jsUiTheme'] = 'ajax-zoom';

// Suppress loading jQuery UI JavaScript files
$zoom['config']['jsUiSuppressJS'] = false;

// Suppress loading jQuery UI CSS files
$zoom['config']['jsUiSuppressCSS'] = false;

// Fonts directory, all font have to be in the same directory
$zoom['config']['fontPath'] = '/axZm/fonts/';

// Folder where original images are located
// This folder can be in a http password protected directory!
// Please make sure, that PHP can open the files (chmod)
// With a slash at the end!
$zoom['config']['pic'] = $zoom['config']['installPath'].'/pic/zoom/'; // string

// Folder where initial images will be written
// They will be named as pictureFileName+'_'+$zoom['config']['picDim']+'.jpg'
// This folder should not be password protected!
// With a slash at the end!
$zoom['config']['thumbs'] = '/pic/zoomthumb/'; // string

// Folder where to write temporary zoomed images
// This folder should not be password protected!
// With a slash at the end!
$zoom['config']['temp'] = '/pic/temp/'; // string

// Folder where to write the thumbs for gallery images
// They will be named as pictureFileName+'_'+$zoom['config']['galleryPicDim']+'.jpg'
// or                    pictureFileName+'_'+$zoom['config']['galleryFullPicDim']+'.jpg' if they differ in size
$zoom['config']['gallery'] = '/pic/zoomgallery/'; // string

// Folder where thumbnails generated with the PHP API method $axZm->rawThumb() can be optionally cached.
// Please make sure PHP can write to this directory (chmod)!
$zoom['config']['tempCache'] = '/pic/cache/';

// Path where map images are stored when mapOwnImage is set to some size.
$zoom['config']['mapPath'] = '/pic/zoommap/';

// 5.0.9+ Path for json files, see also $zoom['config']['jsonInfo']
$zoom['config']['jsonPath'] = '/pic/json/';

// External server for all image operations
// Requires unlimited AJAX-ZOOM license
$zoom['config']['imageSlicer'] = array(
    'enabled' => false, // bool, enable / disable image operations server
    'method' => 'POST', // string, HTTP request method, possible values 'GET' or 'POST'
    'host' => $_SERVER['SERVER_NAME'], // IP or Hostname e.g. 192.168.0.5, www.some-domain.com
    'port' => 80, // int, port number
    'uri' => $zoom['config']['urlPath'].'/axZm/axZmSlicer.php', // string, target URI, e.g. /axZm/axZmSlicer.php
    'timeout' => 60, // int, socket timeout in seconds
    'headers' => array( // array, custom headers
        //'Authorization' => 'Basic '.base64_encode('username:password')
    )
);

// Sort by some file information returned from php stat(),
$zoom['config']['sortBy'] = false; // false or e.g. ctime, mtime ...

// Reverse sorting
$zoom['config']['sortReverse'] = false;

// Makes AJAX-ZOOM switch faster between images
// With this setting several other options will be overridden at the end of zoomConfig.inc.php
$zoom['config']['speedOptSet'] = false;







///////////////////////////////////////////////
//////////////////// MAP //////////////////////
///////////////////////////////////////////////

// "Image map" is a small image, where the user can navigate if the image is zoomed.
// Use image map or not, geneneral switch
$zoom['config']['useMap'] = true; // bool

// Parent DIV id of the map if you want to place it outside of AJAX-ZOOM
$zoom['config']['mapParent'] = false;

// Center within parent container
$zoom['config']['mapParCenter'] = true;

// Map draggable or not
$zoom['config']['dragMap'] = false; // bool

// Drag handle height if map $zoom['config']['dragMap'] is set to true
// css class: .axZm_zoomMapHandle
$zoom['config']['mapHolderHeight'] = 12; // integer (px)

// Text on handle
$zoom['config']['mapHolderText'] = ' '; // string (px)

// Opacity while draging
$zoom['config']['zoomMapDragOpacity'] = 0.7; // float [0.0 - 1.0]

// Opacity of the selector, css: .axZm_zoomMapSelArea for color
$zoom['config']['zoomMapSelOpacity'] = 0.25; // float [0.0 - 1.0]

// Border width of the selector.
$zoom['config']['zoomMapSelBorder'] = 2; // int

// Constrain draging image map within a certain div or element
// false or 'parent', 'window' or other div id starting with # (eg. '#axZm_zoomAll')
$zoom['config']['zoomMapContainment'] = 'window'; // string or false

// Animate map while switching
$zoom['config']['zoomMapAnimate'] = false;

// Autohide image map if image is not zoomed
// Map will appear after the user zoomes into an image
// Use false for autohide, true for map visible from the beginning
$zoom['config']['zoomMapVis'] = false; // bool

// Image map size in percentage of $zoom['config']['picDim'] width
// If you choose fraction bigger than 40% consider placing axZm_zoomMapHolder div not above the actual zooming picture
// In this case adjust layout in function drawZoomBox() of class axZmH in axZmH.class.php
// Also set in case of placing the map outside the actual zooming picture:
// 1. $zoom['config']['zoomMapVis']=true,
// 2. $zoom['config']['zoomMapAnimate']=false,
// 3. $zoom['config']['dragMap']=false
// 4. $zoom['config']['zoomMapContainment']=false

// %, 1 = 100%, 0.2=20% Dimensions for picture Map
$zoom['config']['mapFract'] = 0.25; // float [0.0 - 1.0]

// Fixed map width in pixels. Overrides mapFract.
$zoom['config']['mapWidth'] = false;

// Fixed map height in pixels. Overrides mapFract.
$zoom['config']['mapHeight'] = false;

// Fixed width of the Zoom Map in px. at fullscreen mode.
$zoom['config']['fullScreenMapWidth'] = false; // int or false

// Relative size of the Zoom Map in fullscreen mode. Float < 1.0; If false the setting defaults to that of the not fullscreen mode.
$zoom['config']['fullScreenMapFract'] = 0.2; // float or false

// Fixed width of the Zoom Map in px. at fullscreen mode.
$zoom['config']['fullScreenMapHeight'] = false; // int or false

// Show button for switching image map on and off
$zoom['config']['mapButton'] = true; // bool

// Border width, int (px)
$zoom['config']['mapBorder'] = array(
    'top' => 0,
    'right' => 1,
    'bottom' => 1,
    'left' => 0
);

// Restore speed of the image (and map) if the image is zoomed and the image is changed over gallery
$zoom['config']['zoomMapSwitchSpeed'] = 250; // int, ms

// Restore position of the map on window resize
$zoom['config']['zoomMapRest'] = true; // bool

// Position of the map, not implemented yet!
$zoom['config']['mapPos'] = 'topLeft'; // topLeft, topRight, bottomLeft, bottomRight,

// Horizontal and vertical margins from the edge of the player.
$zoom['config']['mapHorzMargin'] = 5; // int
$zoom['config']['mapVertMargin'] = 5; // int

// Smooth the flow of zoom while dragging the selector inside the map.
$zoom['config']['mapSelSmoothDrag'] = true; // bool

// Smoothness speed of map selector dragging
$zoom['config']['mapSelSmoothDragSpeed'] = 500; // integer (ms)

// Smoothness motion of map selector dragging
$zoom['config']['mapSelSmoothDragMotion'] = 'easeOutQuad'; // string

// Time, after which the image loads instantly if the user stucks at one point while dragging the map selector
$zoom['config']['mapSelZoomSpeed'] = 1250; // integer (ms) or false (switch off)

// 5.1.0+ Click on selection area inside the map to zoom out
$zoom['config']['mapSelClickZoomOut'] = false; // bool

// Move selector inside zoom map by mouseover and not by dragging the selector.
// You can see it in example20.php
// Does also work for touch devices.
$zoom['config']['mapMouseOver'] = false;

// If mapMouseOver is enabled, allow to zoom in and out using mousewheel.
$zoom['config']['mapMouseWheel'] = true;

// Opacity of the map when mouse is not over it.
$zoom['config']['mapOpacity'] = 1; // float <= 1

// On none zoomed state clicking at a point on the map will result into zoom to 100%
$zoom['config']['mapClickZoom'] = true; // bool

// Define physical image dimensions for the map image e.g. "200x200" or false;
$zoom['config']['mapOwnImage'] = '200x200'; // string or false

// Imagemagick filters for mapOwnImage
// Please note, that if you change the settings below you will need to delete the cached thumbnails under $zoom['config']['mapPath']
$zoom['config']['mapFilterIM'] = array(
    'adaptive-sharpen' => array('apply' => true, 'radius' => 0, 'sigma' => 1.0),
    'sharp' => array('apply' => false, 'radius' => 0, 'sigma' => 0.5),
    'unsharp' => array('apply' => false, 'radius' => 0, 'sigma' => 0.5, 'amount' => 1.0, 'threshold' => 0.05),
    'blur' => array('apply' => false, 'radius' => 0, 'sigma' => 1),
    'sepia-tone' => array('apply' => false, 'value' => '80'), // int <= 100
    'sketch' => array('apply' => false, 'radius' => 0, 'sigma' => 20, 'angle' => 120),
    'grayscale' => false
);

// Some PHP GD filters for mapOwnImage
// Please note, that if you change the settings below you will need to delete the cached thumbnails under $zoom['config']['mapPath']
$zoom['config']['mapFilterGD'] = array(
    'sharp' => array('apply' => true, 'matrix' => array( array(-1, -1, -1), array(-1, 22, -1), array(-1, -1, -1) ) ), // 22 -soft, 18 -medium, 14 -hard
    'sepia-tone' => array('apply' => false, 'color' => array('Red' => 90, 'Green' => 60, 'Blue' => 40) ), // This function is only available if PHP is compiled with the bundled version of the GD library.
    'grayscale' => false // This function is only available if PHP is compiled with the bundled version of the GD library.
);







///////////////////////////////////////////////
/////////// Description area //////////////////
///////////////////////////////////////////////

// Instead of using tooltips information will be shown in this description area
// css: .axZm_zoomDescr

// Enable description for navigation buttons on mouseover.
// If true the next options apply equally for buttons mouseover.
// Possible values: left, right, true or false;
$zoom['config']['zoomShowButtonDescr'] = true; // mixed

// Description area transparency
$zoom['config']['descrAreaTransp'] = 0.50; // float [0.0 - 1.0]

// Showing animation time
$zoom['config']['descrAreaShowTime'] = 200; // integer (ms)

// Hiding animation time
$zoom['config']['descrAreaHideTime'] = 200; // integer (ms)

// Time after the description hides, if mouse is not over an object any more
$zoom['config']['descrAreaHideTimeOut'] = 750; // integer (ms)

// Time after the description shows up, if mouse over an object
$zoom['config']['descrAreaShowTimeOut'] = 500;

// Description area minimal! height in px
// Settung this value to a small integer like 0, 2, or 5 will produce nice animation
// The final height depends on content length and is determined automatically.
$zoom['config']['descrAreaHeight'] = 0; // integer (px)

// Description motion
$zoom['config']['descrAreaMotion'] = 'swing'; // integer (px)







//////////////////////////////////////////////////////
//////////////////  Gallery all //////////////////////
//////////////////////////////////////////////////////

//
// There are three types of galleries you can choose from: vertical, horizontal and inline.
// Each of this three types has it's own settings. You can use all three types at the same time, if it does make sense to your application.
//

// JPG quality for gallery thumbs
$zoom['config']['galleryPicQual'] = 90; // integer, max 100

// Quality for gallery thumbs under pngMode
$zoom['config']['galleryPicQualPng'] = array(
    'qual' => 9, // false (default) or int from 0 (no compression) to 9
    'filtering' => 5 // only Imagemagick: false (default) or int from 0 to 5. PNG data encoding filtering (before it is comressed) type: 0 is none, 1 is "sub", 2 is "up", 3 is "average", 4 is "Paeth", and 5 is "adaptive"
);

// Some imagemagick filters
$zoom['config']['galleryFilterIM'] = array(
    'adaptive-sharpen' => array('apply' => true, 'radius' => 0, 'sigma' => 1.0),
    'sharp' => array('apply' => false, 'radius' => 0, 'sigma' => 0.5),
    'unsharp' => array('apply' => false, 'radius' => 0, 'sigma' => 0.5, 'amount' => 1.0, 'threshold' => 0.05),
    'blur' => array('apply' => false, 'radius' => 0, 'sigma' => 1),
    'motion-blur' => array('apply' => false, 'radius' => 0, 'sigma' => 10, 'angle' => 45),
    'channel' => array('apply' => false, 'channels' => array('Red' => true, 'Green' => false, 'Blue' => false, 'Alpha' => false, 'Cyan' => false, 'Magenta' => false, 'Yellow' => false, 'Black' => false, 'Opacity' => false, 'Index' => false, 'RGB' => false, 'RGBA' => false, 'CMYK' => false, 'CMYKA' => false)),
    'sepia-tone' => array('apply' => false, 'value' => '80'), // int <= 100
    'sketch' => array('apply' => false, 'radius' => 0, 'sigma' => 20, 'angle' => 120),
    'shade' => array('apply' => false, 'azimuth' => 30, 'elevation' => 30),
    'sigmoidal-contrast' => array('apply' => false, 'contrast' => 5, 'mid-point' => 50),
    'colorize' => array('apply' => false, 'red' => 20, 'green' => 170, 'blue' => 0),
    'grayscale' => false
);

// Some PHP GD filters
$zoom['config']['galleryFilterGD'] = array(
    'sharp' => array('apply' => true, 'matrix' => array( array(-1, -1, -1), array(-1, 22, -1), array(-1, -1, -1) ) ), // 22 -soft, 18 -medium, 14 -hard
    'sepia-tone' => array('apply' => false, 'color' => array('Red' => 90, 'Green' => 60, 'Blue' => 40) ), // This function is only available if PHP is compiled with the bundled version of the GD library.
    'grayscale' => false // This function is only available if PHP is compiled with the bundled version of the GD library.
);

// Fit gallery size with the image. Depending on ratios image is croped to fill entire area.
$zoom['config']['galleryFill'] = false;

// Display modal dialog (only once) if thumbs have been generated by PHP
$zoom['config']['galleryDialog'] = true; // bool

// Fadeout speed in ms for previous image, e.g. 300
$zoom['config']['galleryFadeOutSpeed'] = 250; // int (ms)

// Fadein speed of new image
$zoom['config']['galleryFadeInSpeed'] = 300; // int (ms)

// Fadein animation motion
$zoom['config']['galleryFadeInMotion'] = 'easeOutCirc'; // string

// Fadein starting opacity
$zoom['config']['galleryFadeInOpacity'] = 0; // float <=1

// Fadein starting size multiplier,
// e.g. 1 - no change, 0.5 - twice as small as original, 2 - twice bigger than original
// This option gives a nice zoom in or zoom out effect during switching
$zoom['config']['galleryFadeInSize'] = 1.2; // float > 0

// Fadein starting animation position, possible values: 'Center', 'Top',' Right', 'Bottom', 'Left', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert', 'Vert', 'Horz'
$zoom['config']['galleryFadeInAnm'] = 'Center'; // String

// Swipe next, prev image on mobile devices
$zoom['config']['gallerySwipe'] = 'Horz'; // Horz, Vert or false

// "Innerfade" between pictures during switching
// Overrides galleryFadeOutSpeed and galleryFadeInSpeed during switching
// $zoom['config']['galleryFadeInSpeed'] still valid for first loading image in the gallery
// Set to false to disable innerfade
$zoom['config']['galleryInnerFade'] = 350; // mixed int (ms) or false

// "Innerfade" or "Crossfade" between images looks nice,
// if images are equal in size or have the same background matching with the stage color.
// Fading a smaller image over a bigger one with different backgrounds does not look nice at all.
// Enabling this option will "crop" the previous image to the size of the fading in new image, so it looks nice :-)
// This option sets the speed in ms of the "shutter" that will be pushed from the sides or top and bottom of the image.
// For disabling this option set it to false.
$zoom['config']['galleryInnerFadeCut'] = 150; // true, false or int > 0(ms) for speed

// Motion type of the above
$zoom['config']['galleryInnerFadeMotion'] = 'swing';

// Do not make gallery thumbs before the player is loaded
$zoom['config']['galleryNoThumbs'] = false; // bool

// "galleryThumbDesc" option - create an anonymous function for thumb description in the gallery
// $k is the number of the image in the gallery. $pic_list_data is an array containing following information:
// $pic_list_data[$k]['fileName'], $pic_list_data[$k]['fileSize'], $pic_list_data[$k]['imgSize'], $pic_list_data[$k]['thisImagePath']

// example returning an information string about the image:
// return date("H:i:s", filectime($pic_list_data[$k]["thisImagePath"]));

// You can also create a named function in, e.g. zoomConfigCustomAZ.inc.php and define $zoom['config']['galleryThumbDesc'] = 'yourFunctionNameForThumbDescription';
// e.g. function yourFunctionNameForThumbDescription($pic_list_data, $k) {return $pic_list_data[$k]["imgSize"][0]; }

// Also enable $zoom['config']['galleryThumbDescr'] option to show the description within the thumbnails.
// The CSS class is .axZmThumbSlider_description
//$zoom['config']['galleryThumbDesc'] = create_function('$pic_list_data, $k', 'return $pic_list_data[$k]["imgSize"][0]." x ".$pic_list_data[$k]["imgSize"][1];');
$zoom['config']['galleryThumbDesc'] = false;

// Create an anonymous function for longer thumb description, which will be shown on mouseover the thumb in a gallery
// Same procedure is same as with "galleryThumbDesc" option
$zoom['config']['galleryThumbFullDesc'] = false;

// Apply zoomSwitchQuick for internal galleries
$zoom['config']['gallerySwitchQuick'] = false;

// Ver. 4.3.1+ Theme for axZmThumbSlider galleries located in /axZm/extensions/axZmThumbSlider/skins
$zoom['config']['thumbSliderTheme'] = 'default';







//////////////////////////////////////////////////////
///////////// Vertical Gallery ///////////////////////
//////////////////////////////////////////////////////

// Use vertical gallery general switch
// Image thums will be generated instantly on first call
// If true, image thums will be generated
$zoom['config']['useGallery'] = false; // bool

// Show vertical gallery in fullscreen mode.
$zoom['config']['fullScreenVertGallery'] = false; // bool

// Vertical gallery thumbs size
// Keep it, even if you do not use gallery ... e.g. 70x70, 100x100, 120x120, 150x150
$zoom['config']['galleryPicDim'] = '100x100'; // string

// Gallery position
$zoom['config']['galleryPos'] = 'right'; // string (left, right)

// Number of columns vertical gallery, limited by users resolution and your layout
$zoom['config']['galleryLines'] = 1; // integer

// Scroll to the loaded image thumb on the beginning
$zoom['config']['galleryScrollToCurrent'] = true;

// Ver. 4.3.1+ Width of the gallery container
$zoom['config']['galleryWidth'] = 'auto'; //integer (px) e.g. 144 or 'auto' as string

// Adjust width of the gallery if galleryWidth is auto
$zoom['config']['galleryWidthAdjust'] = 0; //integer (px)

// Ver. 4.3.1+ Margin of the li elements
$zoom['config']['galleryImgMargin'] = array('top' => 6, 'right' => 6, 'bottom' => 6, 'left' => 6);

// Ver. 4.3.1+ Show description element within thumbs
$zoom['config']['galleryThumbDescr'] = false;

// Ver. 4.3.16 Preloader image located in /axZm/icons directory
// Removed Ver. 5.0.3, replaced with .axZm_loadingThumb CSS class
// $zoom['config']['galleryPreloadImg'] = 'ajax-loader.gif';

// Ver. 4.3.6+ Below this value (player width) vertical gallery will be hidden in responsive layouts
$zoom['config']['galleryHideMaxWidth'] = 600;

// Ver. 4.3.6+ Below this value (player height) vertical gallery will be hidden in responsive layouts
$zoom['config']['galleryHideMaxHeight'] = false;

// Ver. 4.3.1+ Settings for the vertical gallery, full documentation can be found at https://www.ajax-zoom.com/axZm/extensions/axZmThumbSlider/
$zoom['config']['galleryOpt'] = array(
    'orientation' => 'vertical', // Orientation mode, horizontal or vertical.
    'smoothMove' => 4, // Smoothness of the scrolling
    'quickerStop' => false, // ???
    'pressScrollSpeed' => 6, // Max speed of movement (pixels per cycle).
    'pressScrollSnap' => true, // Snap to thumb completly visible
    'pressScrollTime' => 250, // Time ms if it is not clicked to start continuous stepless scroll
    'contentMode' => false, // Simple content scroller instead of thumbs
    'multicolumn' => $zoom['config']['galleryLines'] > 1 ? true : false,
    'circularClickMode' => false, // Pressing on next, prev buttons will result into scrolling to next el and click on it instantly, it will however not result into visual endless loop, instead the fokus will be turned to first thumb when last is reached
    'liImgAsBack' => false, // Images inside li tags (thumbs) will be removed and put as background of the li element
    'randomize' => false, // Randomize order of thumbs on load, see also API methods for randomizing
    'firstThumb' => 1, // Thumb to show at first
    'firstThumbPos' => 'middle', // Default position within the slider (if possible), possible values: first, middle, last
    'firstThumbHighlight' => true, // Highlight firstThumb if firstThumbTriggerClick is not enabled
    'posOnClick' => 'middle', // Scroll the thumb to some position within the slider, possible values: false, 'first', 'middle', 'last'
    'scrollBy' => 'auto -1', // Integer - number of slides scrolled when clicked on the backward / forward button; Can be also 'auto' or expression with auto, e.g. 'auto -1'. String e.g. '50%' or '150px'
    'mouseWheelScrollBy' => '20%', // Use moousewheel for scrolling. Integer - number thumbs. String - px or % value, e.g. '50px' or '20%'
    'debug' => true, // return errors
    'mouseFlowMode' => false, // Slider position upon mouse position on the slider
    'mouseFlowMargin' => 25, // Margin from left/right or top/bottom where mouse position for mouseFlowMode is not captured
    'thumbLiStyle' => array( // Quickly overwrite thumb style (e.g. width and height) without changing css file or write inline styles
        'width' => ($axZmH->getf('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['left'] + $zoom['config']['galleryImgMargin']['right']).'px',
        'height' => ($axZmH->getl('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom']).'px',
        'lineHeight' => ($axZmH->getl('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom'] - 2).'px',
        'borderWidth' => 1,
        'marginTop' => 5,
        'marginBottom' => 5,
        'marginLeft' => 5,
        'marginRight' => 5
    ),
    'thumbImgStyle' => array( // Can be applied when "liImgAsBack" option is disabled.
        //'position' => 'relative',
        //'verticalAlign' => 'top',
        //'top' => $zoom['config']['galFullImgMargin']['top'],

        'maxHeight' => ($axZmH->getf('x',$zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['left'] + $zoom['config']['galleryImgMargin']['right']).'px',
        'maxWidth' => ($axZmH->getl('x',$zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom']).'px'
    ),
    'thumbLiSubClass' => array( // Thumb subclasses
        'mousehover' => 'mousehover',
        'selected' => 'selected',
        'first' =>'first',
        'last' => 'last'
    ),
    'ulClass' => 'axZmThumbSlider', // Main class prefix for ul element
    'wrapClass' => 'axZmThumbSlider_wrap', // Wrap class thumbs
    'contentClass' => 'axZmThumbSlider_content', // Wrap class for contentMode
    'wrapStyle' => array( // Quickly override styles for the wraper
        'borderWidth' => 0,
        'paddingLeft' => 2
    ),
    'outerWrapPosition' =>'absolute', // If parent conainer has padding, setting this value to relative will preserve it
    'centerNoScroll' => false, // Center thumbnails in the slider when there is nothing to scroll

    // Buttons
    'btn' => false, // Enable buttons instantly
    'btnOver' => false, // Button is put over thumbs, should be invisible on disabled class
    'btnHidden' => false, // Hide button if it is disabled
    'btnClass' => 'axZmThumbSlider_button', // Main class prefix for buttons
    'btnBwdStyle' => array(
        'borderColor' => 'transparent'
    ),
    'btnFwdStyle' => array(
        'borderColor' => 'transparent'
    ),
    'btnMargin' => null, // Distance from button to scroll area; this margin can be also set in CSS
    'onInit' => null, // Callback when plugin is created

    // Scrollbar
    'scrollbar' => true, // Enable / disable scrollbar
    'scrollBarIndicator' => false, // If true no actions will be attached to track or scrollbar
    'scrollbarMinDim' => 20, // Min bar width for horizontal / height for vertical slider
    'scrollbarMaxDim' => null, // Max bar width for horizontal / height for vertical slider
    'scrollbarClass' => 'axZmThumbSlider_scrollbar', // Scrollbar class
    'scrollbarMargin' => 0, // Distance which shrinks the length of the scrollbar, can be set with css as well
    'scrollbarOffset' => 0, // Offset of the scrollbar, can be set with css as well
    'scrollbarStyle' => array(), // Quickly overwrite position of the scrollbar
    'scrollbarContainerStyle' => array(), // Quickly set the margins of slider to fit buttons
    'scrollbarBarStyle' => array(), // Quickly set bar style (color, height, margin)
    'scrollbarTrackStyle' => array( // Quickly set slidebar track style (color, height/width, margin)
        //'backgroundColor' => 'transparent'
    ),
    'scrollbarOpacity' => 0.85, // Opacity while doing something
    'scrollbarIdleOpacity' => 0.35, // Opacity in idle state
    'scrollbarIdleTimeout' => 350, // If scrollbarIdleOpacity is not set to 1, apply it after this ms value
    'scrollBarIdleFadeoutT' => 200, // Fadeout time of the scrollbar
    'scrollBarMouseShowBindTo' => 'both', // Bind mouseenter opacity handle functions to scrollbar itself or container, possible values: 'scrollBar', 'container', 'both' or false

    'accVelocity' => 45, // Acceleration velocity for touch devices
    'touchOpt' => array( // Override any options for touch devices
        'smoothMove' => 12,
        'scrollBarIndicator' => true,
        'pressScrollSpeed' => 6
    )
);







//////////////////////////////////////////////////////
///////////// Horizontal Gallery /////////////////////
//////////////////////////////////////////////////////

// Horizontal gallery general switch
$zoom['config']['useHorGallery'] = false; // bool

// Show horizonatal gallery in fullscreen mode.
$zoom['config']['fullScreenHorzGallery'] = false; // bool

// $zoom['config']['galHorPicX'], $zoom['config']['galHorPicY']
// Thumb size in horizontal gallery
$zoom['config']['galleryHorPicDim'] = '70x70'; // string

// Ver. 4.3.6+ Below this value (player width) horizontal gallery will be hidden in responsive layouts
$zoom['config']['galleryHorHideMaxWidth'] = false;

// Ver. 4.3.6+ Below this value (player height) horizontal gallery will be hidden in responsive layouts
$zoom['config']['galleryHorHideMaxHeight'] = 450;

// Position of the horizontal gallery
// top2: above the zoom image
// bottom1: before navigation and after zoom image
// bottom2: after navigation and after zoom image
// top1 - above the image, above navigation
// top2 - above the image, under navigation
// bottom1 - under the image, above navigation
// bottom2 - under the image, under navigation
$zoom['config']['galHorPosition'] = 'bottom1'; // string (top1, top2, bottom1, bottom2)

// Height of the gallery container
$zoom['config']['galHorHeight'] = 'auto'; // integer (px) e.g. 102 or 'auto' as string

// Ver. 4.3.1+ Padding of the horizontal gallery within its parent container
$zoom['config']['galHorPadding'] = array('top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0);

// Ver. 4.3.1+ Margin of the li elements
$zoom['config']['galHorImgMargin'] = array('top' => 4, 'right' => 4, 'bottom' => 4, 'left' => 4);

// Ver. 4.3.1+ Show description element within thumbs
$zoom['config']['galHorThumbDescr'] = false;

// Ver. 4.3.1 Preloader image located in /axZm/icons directory
// Removed Ver. 5.0.3, replaced with .axZm_loadingThumb CSS class
// $zoom['config']['galHorPreloadImg'] = 'ajax-loader.gif';

// Ver. 4.3.1+ Settings for the horizontal gallery, full documentation can be found at https://www.ajax-zoom.com/axZm/extensions/axZmThumbSlider/
$zoom['config']['galHorOpt'] = array(
    'orientation' => 'horizontal', // Orientation mode, horizontal or vertical.
    'smoothMove' => 12, // Smoothness of the scrolling
    'quickerStop' => false, // ???
    'pressScrollSpeed' => 6, // Max speed of movement (pixels per cycle).
    'pressScrollSnap' => true, // Snap to thumb completly visible
    'pressScrollTime' => 250, // Time ms if it is not clicked to start continuous stepless scroll
    'contentMode' => false, // Simple content scroller instead of thumbs
    'multicolumn' => false,
    'circularClickMode' => false, // Pressing on next, prev buttons will result into scrolling to next el and click on it instantly, it will however not result into visual endless loop, instead the fokus will be turned to first thumb when last is reached
    'liImgAsBack' => false, // Images inside li tags (thumbs) will be removed and put as background of the li element
    'randomize' => false, // Randomize order of thumbs on load, see also API methods for randomizing
    'firstThumb' => 1, // Thumb to show at first
    'firstThumbPos' => 'middle', // Default position within the slider (if possible), possible values: first, middle, last
    'firstThumbHighlight' => true, // Highlight firstThumb if firstThumbTriggerClick is not enabled
    'posOnClick' => 'middle', // Scroll the thumb to some position within the slider, possible values: false, 'first', 'middle', 'last'
    'scrollBy' => 'auto -1', // Integer - number of slides scrolled when clicked on the backward / forward button; Can be also 'auto' or expression with auto, e.g. 'auto -1'. String e.g. '50%' or '150px'
    'mouseWheelScrollBy' => '20%', // Use moousewheel for scrolling. Integer - number thumbs. String - px or % value, e.g. '50px' or '20%'
    'debug' => true, // return errors
    'mouseFlowMode' => false, // Slider position upon mouse position on the slider
    'mouseFlowMargin' => 25, // Margin from left/right or top/bottom where mouse position for mouseFlowMode is not captured
    'thumbLiStyle' => array( // Quickly overwrite thumb style (e.g. width and height) without changing css file or write inline styles
        'width' => ($axZmH->getf('x',$zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['left'] + $zoom['config']['galHorImgMargin']['right']).'px',
        'height' => ($axZmH->getl('x',$zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['top'] + $zoom['config']['galHorImgMargin']['bottom']).'px',
        'lineHeight' => ($axZmH->getl('x',$zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['top'] + $zoom['config']['galHorImgMargin']['bottom'] - 2).'px',
        'borderWidth' => 1,
        'marginTop' => $zoom['config']['galHorImgMargin']['top'] + 1,
        'marginBottom' => $zoom['config']['galHorImgMargin']['bottom'] + 1
    ),
    'thumbImgStyle' => array( // Can be applied when "liImgAsBack" option is disabled.
        //'position' => 'relative',
        //'verticalAlign' => 'top',
        //'top' => $zoom['config']['galHorImgMargin']['top'],

        'maxHeight' => ($axZmH->getf('x',$zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['left'] + $zoom['config']['galHorImgMargin']['right']).'px',
        'maxWidth' => ($axZmH->getl('x',$zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['top'] + $zoom['config']['galHorImgMargin']['bottom']).'px'
    ),
    'thumbLiSubClass' => array( // Thumb subclasses
        'mousehover' => 'mousehover',
        'selected' => 'selected',
        'first' =>'first',
        'last' => 'last'
    ),
    'ulClass' => 'axZmThumbSlider', // Main class prefix for ul element
    'wrapClass' => 'axZmThumbSlider_wrap', // Wrap class thumbs
    'contentClass' => 'axZmThumbSlider_content', // Wrap class for contentMode
    'wrapStyle' => array( // Quickly override styles for the wraper
        'borderWidth' => 0,
    ),
    'outerWrapPosition' =>'absolute', // If parent conainer has padding, setting this value to relative will preserve it
    'centerNoScroll' => true, // Center thumbnails in the slider when there is nothing to scroll

    // Buttons
    'btn' => true, // Enable buttons instantly
    'btnOver' => false, // Button is put over thumbs, should be invisible on disabled class
    'btnHidden' => false, // Hide button if it is disabled
    'btnClass' => 'axZmThumbSlider_button_new', // Main class prefix for buttons
    'btnBwdStyle' => array(
        'borderColor' => 'transparent',
        'marginLeft' => 0,
        'marginRight' => 5
    ),
    'btnFwdStyle' => array(
        'borderColor' => 'transparent',
        'marginLeft' => 5,
        'marginRight' => 0
    ),
    'btnMargin' => null, // Distance from button to scroll area; this margin can be also set in CSS
    'onInit' => null, // Callback when plugin is created

    // Scrollbar
    'scrollbar' => false, // Enable / disable scrollbar
    'scrollBarIndicator' => false, // If true no actions will be attached to track or scrollbar
    'scrollbarMinDim' => 20, // Min bar width for horizontal / height for vertical slider
    'scrollbarMaxDim' => null, // Max bar width for horizontal / height for vertical slider
    'scrollbarClass' => 'axZmThumbSlider_scrollbar', // Scrollbar class
    'scrollbarMargin' => null, // Distance which shrinks the length of the scrollbar, can be set with css as well
    'scrollbarOffset' => null, // Offset of the scrollbar, can be set with css as well
    'scrollbarStyle' => array(), // Quickly overwrite position of the scrollbar
    'scrollbarContainerStyle' => array(), // Quickly set the margins of slider to fit buttons
    'scrollbarBarStyle' => array(), // Quickly set bar style (color, height, margin)
    'scrollbarTrackStyle' => array(), // Quickly set slidebar track style (color, height/width, margin)
    'scrollbarOpacity' => 0.85, // Opacity while doing something
    'scrollbarIdleOpacity' => 0.35, // Opacity in idle state
    'scrollbarIdleTimeout' => 350, // If scrollbarIdleOpacity is not set to 1, apply it after this ms value
    'scrollBarIdleFadeoutT' => 200, // Fadeout time of the scrollbar
    'scrollBarMouseShowBindTo' => 'both', // Bind mouseenter opacity handle functions to scrollbar itself or container, possible values: 'scrollBar', 'container', 'both' or false
    'accVelocity' => 45, // Acceleration velocity for touch devices
    'touchOpt' => array( // Override any options for touch devices
        'smoothMove' => 12,
        'scrollBarIndicator' => true,
        'pressScrollSpeed' => 6
    )
);







//////////////////////////////////////////////////////
///////////// Inline / Full Gallery /////////////////////////
//////////////////////////////////////////////////////

// "Inline Gallery" is shown by clicking an a button in navigation
// Can also be used in combination with vertical gallery if you want
// If true, image thums will be generated
$zoom['config']['useFullGallery'] = true; // bool

// Gallery Thumbs size for "Inline Gallery",
$zoom['config']['galleryFullPicDim'] = '70x70'; // string

// Ver. 4.3.1+ Margin of the li elements
$zoom['config']['galFullImgMargin'] = array('top' => 5, 'right' => 5, 'bottom' => 5, 'left' => 5);

// "Inline Gallery" Button
$zoom['config']['galFullButton'] = true; // bool

// Autostart and autoshow "Inline Gallery" after initialization of AJAX-ZOOM.
$zoom['config']['galFullAutoStart'] = false; // bool

// Description tooltip for "Inline Gallery" general switch, CSS: .axZm_zoomFullGalleryTooltip
$zoom['config']['galFullTooltip'] = true; // bool

// Tooltip offset from the thumb in px
$zoom['config']['galFullTooltipOffset'] = 5; // integer (px)

// Tooltip fadein speed in ms OR 'fast','slow','medium'
$zoom['config']['galFullTooltipSpeed'] = 'fast'; // integer (ms) / string

// Tooltip transparency
$zoom['config']['galFullTooltipTransp'] = 0.93; // float [0.0 - 1.0]

// If set to true it will be scrolled to the current selected image
$zoom['config']['galFullScrollCurrent'] = true; // bool

// Ver. 4.3.1+ Show description element within thumbs
$zoom['config']['galFullThumbDescr'] = false;

// Ver. 4.3.1+ Preloader image located in /axZm/icons directory
// Removed Ver. 5.0.3, replaced with .axZm_loadingThumb CSS class
// $zoom['config']['galFullPreloadImg'] = 'ajax-loader.gif';

// Ver. 4.3.1+ Settings for the Inline / Full gallery, full documentation can be found at https://www.ajax-zoom.com/axZm/extensions/axZmThumbSlider/
$zoom['config']['galFullOpt'] = array(
    'orientation' => 'vertical', // Orientation mode, horizontal or vertical.
    'smoothMove' => 12, // Smoothness of the scrolling
    'quickerStop' => false, // ???
    'pressScrollSpeed' => 6, // Max speed of movement (pixels per cycle).
    'pressScrollSnap' => true, // Snap to thumb completly visible
    'pressScrollTime' => 250, // Time ms if it is not clicked to start continuous stepless scroll
    'contentMode' => false, // Simple content scroller instead of thumbs
    'multicolumn' => true,
    'circularClickMode' => false, // Pressing on next, prev buttons will result into scrolling to next el and click on it instantly, it will however not result into visual endless loop, instead the fokus will be turned to first thumb when last is reached
    'liImgAsBack' => false, // Images inside li tags (thumbs) will be removed and put as background of the li element
    'randomize' => false, // Randomize order of thumbs on load, see also API methods for randomizing
    'firstThumb' => 1, // Thumb to show at first
    'firstThumbPos' => 'middle', // Default position within the slider (if possible), possible values: first, middle, last
    'firstThumbHighlight' => true, // Highlight firstThumb if firstThumbTriggerClick is not enabled
    'posOnClick' => 'middle', // Scroll the thumb to some position within the slider, possible values: false, 'first', 'middle', 'last'
    'scrollBy' => 'auto -1', // Integer - number of slides scrolled when clicked on the backward / forward button; Can be also 'auto' or expression with auto, e.g. 'auto -1'. String e.g. '50%' or '150px'
    'mouseWheelScrollBy' => '20%', // Use moousewheel for scrolling. Integer - number thumbs. String - px or % value, e.g. '50px' or '20%'
    'debug' => true, // return errors
    'mouseFlowMode' => false, // Slider position upon mouse position on the slider
    'mouseFlowMargin' => 25, // Margin from left/right or top/bottom where mouse position for mouseFlowMode is not captured
    'thumbLiStyle' => array( // Quickly overwrite thumb style (e.g. width and height) without changing css file or write inline styles
        'width' => ($axZmH->getf('x',$zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['left'] + $zoom['config']['galFullImgMargin']['right']).'px',
        'height' => ($axZmH->getl('x',$zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['top'] + $zoom['config']['galFullImgMargin']['bottom']).'px',
        'lineHeight' => ($axZmH->getl('x',$zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['top'] + $zoom['config']['galFullImgMargin']['bottom'] - 2).'px',
        'borderWidth' => 1,
        'marginTop' => $zoom['config']['galFullImgMargin']['top'],
        'marginBottom' => $zoom['config']['galFullImgMargin']['bottom'],
        'marginLeft' => $zoom['config']['galFullImgMargin']['left']
    ),
    'thumbImgStyle' => array( // Can be applied when "liImgAsBack" option is disabled.
        //'position' => 'relative',
        //'verticalAlign' => 'top',
        //'top' => $zoom['config']['galFullImgMargin']['top'],

        'maxHeight' => ($axZmH->getf('x',$zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['left'] + $zoom['config']['galFullImgMargin']['right']).'px',
        'maxWidth' => ($axZmH->getl('x',$zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['top'] + $zoom['config']['galFullImgMargin']['bottom']).'px'
    ),
    'thumbLiSubClass' => array( // Thumb subclasses
        'mousehover' => 'mousehover',
        'selected' => 'selected',
        'first' =>'first',
        'last' => 'last'
    ),
    'ulClass' => 'axZmThumbSlider', // Main class prefix for ul element
    'wrapClass' => 'axZmThumbSlider_wrap', // Wrap class thumbs
    'contentClass' => 'axZmThumbSlider_content', // Wrap class for contentMode
    'wrapStyle' => array( // Quickly override styles for the wraper
        'borderWidth' => 0,
    ),
    'outerWrapPosition' =>'absolute', // If parent conainer has padding, setting this value to relative will preserve it
    'centerNoScroll' => false, // Center thumbnails in the slider when there is nothing to scroll

    // Buttons
    'btn' => false, // Enable buttons instantly
    'btnOver' => false, // Button is put over thumbs, should be invisible on disabled class
    'btnHidden' => false, // Hide button if it is disabled
    'btnClass' => 'axZmThumbSlider_button', // Main class prefix for buttons
    'btnBwdStyle' => array(
        'borderColor' => 'transparent'
    ),
    'btnFwdStyle' => array(
        'borderColor' => 'transparent'
    ),
    'btnMargin' => null, // Distance from button to scroll area; this margin can be also set in CSS
    'onInit' => null, // Callback when plugin is created

    // Scrollbar
    'scrollbar' => true, // Enable / disable scrollbar
    'scrollBarIndicator' => false, // If true no actions will be attached to track or scrollbar
    'scrollbarMinDim' => 20, // Min bar width for horizontal / height for vertical slider
    'scrollbarMaxDim' => null, // Max bar width for horizontal / height for vertical slider
    'scrollbarClass' => 'axZmThumbSlider_scrollbar', // Scrollbar class
    'scrollbarMargin' => 0, // Distance which shrinks the length of the scrollbar, can be set with css as well
    'scrollbarOffset' => 0, // Offset of the scrollbar, can be set with css as well
    'scrollbarStyle' => array(), // Quickly overwrite position of the scrollbar
    'scrollbarContainerStyle' => array(), // Quickly set the margins of slider to fit buttons
    'scrollbarBarStyle' => array(), // Quickly set bar style (color, height, margin)
    'scrollbarTrackStyle' => array( // Quickly set slidebar track style (color, height/width, margin)

    ),
    'scrollbarOpacity' => 0.85, // Opacity while doing something
    'scrollbarIdleOpacity' => 0.35, // Opacity in idle state
    'scrollbarIdleTimeout' => 350, // If scrollbarIdleOpacity is not set to 1, apply it after this ms value
    'scrollBarIdleFadeoutT' => 200, // Fadeout time of the scrollbar
    'scrollBarMouseShowBindTo' => 'both', // Bind mouseenter opacity handle functions to scrollbar itself or container, possible values: 'scrollBar', 'container', 'both' or false

    'accVelocity' => 45, // Acceleration velocity for touch devices
    'touchOpt' => array( // Override any options for touch devices
        'smoothMove' => 12,
        'scrollBarIndicator' => true,
        'pressScrollSpeed' => 6
    )
);







//////////////////////////////////////////////////////
///////////// Gallery Navigation /////////////////////
//////////////////////////////////////////////////////

// Prev, Next buttons for the gallery general switch
$zoom['config']['galleryNavi'] = false; // bool

// Prev, Next buttons position
// Top and bottom refere to vertical gallery
$zoom['config']['galleryNaviPos'] = 'bottom'; // string [top, bottom, navi]

// Height of the parent container if positioned not inside navigation bar (galleryNaviPos not 'navi')
$zoom['config']['galleryNaviHeight'] = 48;

// Prev, Next circular
$zoom['config']['galleryNaviCirc'] = true; // bool

// Prev, Next buttons container margin.
$zoom['config']['galleryNaviMargin'] = array(1, 25, 5, 0); // array (top, right, bottom, left) px

// Space between buttons
$zoom['config']['galleryButtonSpace'] = 5;

// Play, pause button
$zoom['config']['galleryPlayButton'] = true; // bool

// Autoplay on start
$zoom['config']['galleryAutoPlay'] = false; // bool

// Interval for diashow
$zoom['config']['galleryPlayInterval'] = 3500; // int (ms)

// Ver. 5.3.12+ Keyboard previous / next for images gallery
$zoom['config']['galleryKeyboardKeys'] = array(
    'enabled' => true,
    'keyUp' => false,
    'onlyHover' => true,
    'prev' => 37,
    'next' => 39,
    'ovrSpin' => false,
    'hideCursor' => true
);

// Enable prev / next (prevnext) buttons above the picture of the player.
// For spinMod (360) these buttnos will spin an object
$zoom['config']['gallerySlideNavi'] = true;

// Arrows for prev / next over the image appear only when mouse is over the player. Disabpled for touch devices
$zoom['config']['gallerySlideNaviMouseOver'] = true; //

// Show arrows for prev / next over the image only at fullscreen mode.
$zoom['config']['gallerySlideNaviOnlyFullScreen'] = false;

// Margin of the prev / next buttons from the edge of the player.
$zoom['config']['gallerySlideNaviMargin'] = 20;

// Transition type when clicked on the prev / next button,
// possible values: 'Center', 'Top', 'Right', 'Bottom', 'Left', 'StretchVert', 'StretchHorz', 'SwipeHorz', 'SwipeVert', 'Vert', 'Horz'
$zoom['config']['gallerySlideNaviAnm'] = 'SwipeHorz';

// Speed for gallerySlideNavi in ms if gallerySlideNaviAnm is set to SwipeHorz or SwipeVert
$zoom['config']['gallerySlideSwipeSpeed'] = 750;

// Speed for sliding if SwipeHorz is enabled and autoplay is running
$zoom['config']['gallerySlideSwipeSpeedAutoPlay'] = 750;

// Settings for touch swipe which depends on real swipe speed gesture
$zoom['config']['gallerySlideTouchSwipe'] = array(
    'basisSpeed' => 400,
    'maxSpeed' => 500,
    'minSpeed' => 300
);







//////////////////////////////////////////////////////
//////////////////// Spin & Zoom /////////////////////
//////////////////////////////////////////////////////

// Enable spin mode
// Inline Gallery (useFullGallery) must be enabled too
$zoom['config']['spinMod'] = false;

// Sensitivity to mouse movement
$zoom['config']['spinSensitivity'] = 1.4; // float

// Sensitivity to mouse movement Z axis (multirow)
$zoom['config']['spinSensitivityZ'] = 1.8; // float

// Activate reversed direction of the spin to mousemovement
$zoom['config']['spinReverse'] = false; // bool

// Reverse direction of the spin in general
$zoom['config']['spinContra'] = false; // bool

// Activate reversed direction for all kind of spin buttons
$zoom['config']['spinReverseBtn'] = false; // bool or integer != 0

// Activate reversed direction of the spin to mousemovement Z axis (multirow)
$zoom['config']['spinReverseZ'] = false; // bool

// Spin or (mouse) movements in bottom-down directions instead of left-right
$zoom['config']['spinFlip'] = false;

// First Z axis (multirow) to be displayed.
// Can be overridden by passing $_GET['firstAxis'] in query string. Possible values: auto (middle), number of subdir, name of subdir
$zoom['config']['firstAxis'] = false; // mixed

// Start spin after it first loads
$zoom['config']['spinDemo'] = true; // bool

// Time in ms for autospin which is needed to make one turn
$zoom['config']['spinDemoTime'] = 4000; // int ms

// Number rounds for demo spin
$zoom['config']['spinDemoRounds'] = 3; // int ms or false - perpetual

// 4.3.11+ Easing of the demo spin
// Possible motions types:
// 'swing', 'linear', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart',
// 'easeOutQuart','easeInOutQuart', 'easeInQuint','easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine',
// 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic',
// 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce'
$zoom['config']['spinDemoEasing'] = 'linear';

// Demo Spin when hitting the spin mod button
$zoom['config']['spinOnSwitch'] = false; // bool

// Spin while preloading
$zoom['config']['spinWhilePreload'] = true; // bool

// Stops automatic animation if mouse over the images
$zoom['config']['spinMouseOverStop'] = false; // int ms

// Enable spin blur effect
$zoom['config']['spinEffect']['enabled'] = false; // bool
$zoom['config']['spinEffect']['zoomed'] = false; // bool
$zoom['config']['spinEffect']['opacity'] = 0.5; // float
$zoom['config']['spinEffect']['time'] = 200; // integer
$zoom['config']['spinEffect']['time'] = 200; // integer or "auto" as string
$zoom['config']['spinEffect']['preventBlur'] = false; // bool

// Horizontal bar as spin preloader indicator
$zoom['config']['spinPreloaderSettings'] = array(
    'width' => '50%', // % as string or integer
    'minWidth' => 200, // int
    'height' => 40, // int
    'gravity' => 'Center', // topLeft, topRight, bottomRight, bottomLeft, bottom, top, right, left, center
    'gravityMargin' => 5, // int
    'borderW' => 0, // int
    'margin' => 5, // int
    'countMsg' => true, // bool
    'statusMsg' => true, // bool
    'barH' => 40, // int
    'barOpacity' => 0.7, // float
    // Language vars spin preloader
    'text' => array(
        'en' => 'Loading 360 frames',
        'de' => 'Laden von 360 Bildern',
        'fr' => 'Chargement de 360 images',
        'es' => 'Cargando cuadros de 360',
        'it' => 'Caricamento di 360 fotogrammi',
        'pt' => 'Carregando 360 quadros',
        'ru' => 'Загрузка 360 кадров',
        'pl' => 'Ładowanie 360 klatek',
        'nl' => '360 frames laden',
        'cn' => '加载360帧',
        'jp' => '360フレームを読み込む'
    ),
    'L1' => array(
        'en' => 'Preloading image',
        'de' => 'Bild vorladen',
        'fr' => 'Image de préchargement',
        'es' => 'Imagen de precarga',
        'it' => 'Immagine di precaricamento',
        'pt' => 'Pré-carregando imagem',
        'ru' => 'Предварительная загрузка изображения',
        'pl' => 'Wstępne ładowanie obrazu',
        'nl' => 'Preloading image',
        'cn' => '预加载图片',
        'jp' => '画像のプリロード'
    ),
    'L2' => array(
        'en' => 'Making pyramid images',
        'de' => 'Erzeugen von Pyramidenbildern',
        'fr' => 'Génération d\'images pyramidales',
        'es' => 'Generando imágenes de pirámide',
        'it' => 'Generazione di immagini piramidali',
        'pt' => 'Gerando imagens em pirâmide',
        'ru' => 'Создание пирамидных изображений',
        'pl' => 'Twórz obrazy piramidowe',
        'nl' => 'Maak pyramide-afbeeldingen',
        'cn' => '生成金字塔图像',
        'jp' => 'ピラミッド画像の生成'
    ),
    'L3' => array(
        'en' => 'Making image tiles',
        'de' => 'Bildkacheln erstellen',
        'fr' => 'Faire des carreaux d\'image',
        'es' => 'Hacer mosaicos de imágenes',
        'it' => 'Creare riquadri di immagini',
        'pt' => 'Fazendo telhas de imagem',
        'ru' => 'Создание графических плит',
        'pl' => 'Utwórz kafelki obrazu',
        'nl' => 'Maak afbeeldingstegels',
        'cn' => '制作图像拼贴',
        'jp' => '画像タイルを作る'
    ),
    'L4' => array(
        'en' => 'Generating of the first image',
        'de' => 'Generierung des ersten Bildes',
        'fr' => 'Génération de la première image',
        'es' => 'Generación de la primera imagen',
        'it' => 'Generazione della prima immagine',
        'pt' => 'Gerando a primeira imagem',
        'ru' => 'Создание первичного изображения',
        'pl' => 'Generowanie pierwszego obrazu',
        'nl' => 'Het genereren van de eerste afbeelding',
        'cn' => '生成第一个图像',
        'jp' => '最初の画像の生成'
    ),
    'L5' => array(
        'en' => 'and first image',
        'de' => 'und erstes Bild',
        'fr' => 'et première image',
        'es' => 'y primera imagen',
        'it' => 'e prima immagine',
        'pt' => 'e primeira imagem',
        'ru' => 'и первичного изображения',
        'pl' => 'i pierwsze zdjęcie',
        'nl' => 'en eerste afbeelding',
        'cn' => '和第一个图像',
        'jp' => '最初の画像'
    )
);

// Circle spin preloader indicator, IE < 9 defaults to horizontal preloader above
$zoom['config']['spinCirclePreloader'] = array(
    'enabled' => false, // if spinCirclePreloader is enabled the horizontal preloader bar indicator is instatly disabled;
    'diameter' => '30%', // diameter of the preloader, integer if you want fixed px size
    'stroke' => 3, // width of the progressive status line around the preloader, css: .axZm_circlePreloader_barCircle (color change there too)
    'rotate' => 0, // rotate progressive preloader line, e.g. 90 will start at 3 o'clock
    'prc' => false, // show percentage value over or instead img, css: .axZm_circlePreloader_prc
    'prcFontSize' => 0.3, // float: font size relative to diameter or string, e.g. 0.3 which is 30%, or just '20px' for a fixed value, css: .axZm_circlePreloader_prc
    'img' => true, // show image which is preloading inside this round preloader; instantly disables spinWhilePreload option
    'imgCover' => false, // if false it will "contain" - simmilar to css3 background-size properties contain and cover
    'countMsg' => false, // display counter message (Loading frrames m / n) under the circle
    'statusMsg' => false, // display status message, e.g. "Preloading image" or other depending on what AZ is doing
    'autoStatus' => true, // if it is not only "Preloading image" but "Making tiles" or other and statusMsg is disabled, then statusMsg is instantly enabled!
    'text' => array(
        'en' => 'Loading 360 frames',
        'de' => 'Laden von 360 Bildern',
        'fr' => 'Chargement de 360 images',
        'es' => 'Cargando cuadros de 360',
        'it' => 'Caricamento di 360 fotogrammi',
        'pt' => 'Carregando 360 quadros',
        'ru' => 'Загрузка 360 кадров',
        'pl' => 'Ładowanie 360 zdjęć',
        'nl' => '360 foto\'s laden',
        'cn' => '加载360帧',
        'jp' => '360フレームを読み込む'
    ),
    'L1' => array(
        'en' => 'Preloading image',
        'de' => 'Bild vorladen',
        'fr' => 'Image de préchargement',
        'es' => 'Imagen de precarga',
        'it' => 'Immagine di precaricamento',
        'pt' => 'Pré-carregando imagem',
        'ru' => 'Предварительная загрузка изображения',
        'pl' => 'Wstępne ładowanie obrazu',
        'nl' => 'Preloading image',
        'cn' => '预加载图片',
        'jp' => '画像のプリロード'
    ),
    'L2' => array(
        'en' => 'Making pyramid images',
        'de' => 'Erzeugen von Pyramidenbildern',
        'fr' => 'Génération d\'images pyramidales',
        'es' => 'Generando imágenes de pirámide',
        'it' => 'Generazione di immagini piramidali',
        'pt' => 'Gerando imagens em pirâmide',
        'ru' => 'Создание пирамидных изображений',
        'pl' => 'Twórz obrazy piramidowe',
        'nl' => 'Maak pyramide-afbeeldingen',
        'cn' => '生成金字塔图像',
        'jp' => 'ピラミッド画像の生成'
    ),
    'L3' => array(
        'en' => 'Making image tiles',
        'de' => 'Bildkacheln erstellen',
        'fr' => 'Faire des carreaux d\'image',
        'es' => 'Hacer mosaicos de imágenes',
        'it' => 'Creare riquadri di immagini',
        'pt' => 'Fazendo telhas de imagem',
        'ru' => 'Создание графических плит',
        'pl' => 'Utwórz kafelki obrazu',
        'nl' => 'Maak afbeeldingstegels',
        'cn' => '制作图像拼贴',
        'jp' => '画像タイルを作る'
    ),
    'L4' => array(
        'en' => 'Generating of the first image',
        'de' => 'Generierung des ersten Bildes',
        'fr' => 'Génération de la première image',
        'es' => 'Generación de la primera imagen',
        'it' => 'Generazione della prima immagine',
        'pt' => 'Gerando a primeira imagem',
        'ru' => 'Создание первичного изображения',
        'pl' => 'Generowanie pierwszego obrazu',
        'nl' => 'Het genereren van de eerste afbeelding',
        'cn' => '生成第一个图像',
        'jp' => '最初の画像の生成'
    ),
    'L5' => array(
        'en' => 'and first image',
        'de' => 'und erstes Bild',
        'fr' => 'et première image',
        'es' => 'y primera imagen',
        'it' => 'e prima immagine',
        'pt' => 'e primeira imagem',
        'ru' => 'и первичного изображения',
        'pl' => 'i pierwsze zdjęcie',
        'nl' => 'en eerste afbeelding',
        'cn' => '和第一个图像',
        'jp' => '最初の画像'
    )
);

// CSV (comma-separated values) of frames numbers, which are loaded into a gallery if it is activated.
// Clicking on a thumb will result into spinning to this particular frame.
$zoom['config']['cueFrames'] = false; // csv or false

// Motion type of the spinning to a specific frame
$zoom['config']['spinToMotion'] = 'easeOutQuad'; // string

// Disable spinning for the zoom area
$zoom['config']['spinAreaDisable'] = false; // bool

// For object without 360 images, possible values 'bounce', 'stop' or false
$zoom['config']['spinBounce'] = false; // mixed

// Numeric Key Codes for spining, set values to false to deaktivate
$zoom['config']['spinKeys'] = array(
    'enable' => true,
    'hideCursor' => true,
    'left' => 37,
    'right' => 39,
    'up' => 38,
    'down' => 40
);

// Max levels of 3D spin
$zoom['config']['spinMaxRows'] = 15; // int

// Max frames per row
$zoom['config']['spinMaxFrames'] = 360; // int

// Add image telling that the the user can drag and this way spin the 360
// CSS class .axZm_dragToSpin
$zoom['config']['dragToSpin'] = array(
    'enabled' => false, // enable / disable
    // Message as image file to display e.g. drag_to_spin_en.png
    'file' => array(
        'en' => 'drag_to_spin_en.png',
        'de' => '',
        'fr' => '',
        'es' => '',
        'it' => '',
        'pt' => '',
        'ru' => '',
        'pl' => '',
        'nl' => '',
        'cn' => '',
        'jp' => ''
    ),
    'txt' => array(
        'en' => 'Drag to spin<div style="font-size: 120%">360°</div>',
        'de' => 'Ziehen um<br><span style="font-size: 120%">360° zu</span><br>drehen',
        'fr' => 'Faites glisser pour faire <br>tourner la <div style="font-size: 120%">360°</div>',
        'es' => 'Arrastra para <br>girar el <div style="font-size: 120%">360°</div>',
        'it' => 'Trascina per <br>ruotare <div style="font-size: 120%">360°</div>',
        'pt' => 'Arraste para <br>girar o <div style="font-size: 120%">360°</div>',
        'ru' => 'Перетащите, <br>чтобы вращать <div style="font-size: 120%">360°</div>',
        'pl' => 'Przeciągnij, <br>aby obrócić <br><div style="font-size: 120%">o 360 stopni</div>',
        'nl' => 'Sleep om<br><div style="font-size: 120%">360 graden</div> te draaien',
        'cn' => '拖动以旋转360',
        'jp' => 'ドラッグして360を回す'
    ),
    'showAfter' => 4000, // ms
    'removeAfter' => 4000, // display for this ms and remove instantly
    'fadeIn' => 2000, // ms
    'fadeOut' => 400 // ms
);

// CSS classes: .axZm_spinPreloadInit, .axZm_clickToSpin
// can be also triggered with $.fn.axZm.spinPreload()
$zoom['config']['spinNoInit'] = array(
    'enabled' => false, // enable / disable
    // message as image file to display e.g. "click_to_load_en.png"
    'file' => array(
        'en' => 'click_to_load_en.png',
        'de' => '',
        'fr' => '',
        'es' => '',
        'it' => '',
        'pt' => '',
        'ru' => '',
        'pl' => '',
        'nl' => '',
        'cn' => '',
        'jp' => ''
    ),
    'txt' => array(
        'en' => 'Click to load<br><span style="font-size: 120%">360°</span><br> view',
        'de' => 'Klicken um die<br><span style="font-size: 120%">360°</span> Ansicht<br>zu laden',
        'fr' => 'Cliquez pour charger<br>la vue à <span style="font-size: 120%">360°</span>',
        'es' => 'Haga clic para cargar<br>la vista de <span style="font-size: 120%">360°</span>',
        'it' => 'Clicca per caricare<br>la vista a <span style="font-size: 120%">360°</span>',
        'pt' => 'Clique para carregar<br>a vista de <span style="font-size: 120%">360°</span>',
        'ru' => 'Нажмите, чтобы загрузить<br><span style="font-size: 120%">360°</span> изображение',
        'pl' => 'Kliknij, aby załadować <br> <span style = "font-size: 120%">widok 360°</span>',
        'nl' => 'Klik om de tekst <span style = "font-size: 120%">360°</span> te laden',
        'cn' => '单击以加载360°视图',
        'jp' => 'クリックすると360ビューが読み込まれます'
    ),
    'event' => 'click' // "click", "mouseenter" or false (trigger with $.fn.axZm.spinPreload() manually); mouseenter will also work on touch devices
);

// If activated inertia force for 360 will be emulated when the user spins an object with the mouse or finger.
$zoom['config']['spinSmoothing'] = array(
    'enabled' => true, // enable / disable this option
    'glide' => 1.5, // the more, the longer it will spin
    'speed' => 1, // internal value
    'easing' => 'easeOutQuad',
    'accMin' => 0.1, // internal value
    'accLimit' => 10 // internal value
);

// Ver. 4.3.1+ keep rotate after smoothing
$zoom['config']['spinKeepRotate'] = array(
    'enabled' => true, // enable rotation after swipe
    'swipeTime' => 750, // define swipe time
    'dbSwipeDelay' => 750 // if set keeping rotation will be triggered only on second swipe within this period
);

// Ver. 4.3.1+ Snap to specified keys after spinning with velocity
$zoom['config']['spinSnapKeys'] = array();

// Ver. 4.3.1+ Snap to nearest key specified in "spinSnapKeys" options without velocity spinning
$zoom['config']['spinSnapNextKey'] = false;

// Pan view vertically while spinning horizontally
$zoom['config']['spinAndDrag'] = true;

// Ver. 4.3.1+ Enable spinAndDrag also for touch devices
$zoom['config']['spinAndDragTouch'] = true;

// Ver. 4.3.1+ Only drag vertically without spinning, can be also enabled and disabled by changing the JS value of jQuery.axZm.spinDragOnly
$zoom['config']['spinDragOnly'] = false;

// If activated and spin tool is selected clicking on the image will result into spinning the object, otherwise it will zoom to 100%.
$zoom['config']['spinOnClick'] = false; // bool

// If in spin mode right click and drag will pan instead of spin
$zoom['config']['spinPanRightMouseBtn'] = true;

// Define which files should be not selected from a folder with 360 images.
// If a string from the array contains in the filename of a 360 image, then it will be not included into 360 images set.
// Particularly this is useful if you have e.g. low resolution images and high resolution images in the same folder.
// AJAX-ZOOM does not need low resolution images and for example if your low resolution images contain "ld" in the filename,
// then you can set $zoom['config']['spinFilesExcludeFilter'] = array('ld');
// Please note however that if you already have such a structure coming from a different 360 script,
// then your "high resolution images" might be not of the best quality and resolution available which will lead to not optimal results within AJAX-ZOOM.
$zoom['config']['spinFilesExcludeFilter'] = array();







///////////////////////////////////////////////
//////////// Spin Slider //////////////////////
///////////////////////////////////////////////

// Enable UI slider as additional control for spinning.
$zoom['config']['spinSlider'] = true; // bool

// Height or thikeness of the slider in px.
$zoom['config']['spinSliderHeight'] = 4; // int

// Height or thikeness of the slider handle in px.
$zoom['config']['spinSliderHandleSize'] = 21; // int

// Width of the slider
$zoom['config']['spinSliderWidth'] = '50%'; // mixed int or bool false

// Play / pause button left to the spin slider.
$zoom['config']['spinSliderPlayButton'] = false; // bool

// Reverse direction of the spin slider, see also spinReverse
$zoom['config']['spinSliderReverse'] = false; // bool

// Additional CSS class name for spin slider which can be added to the container with spin slider
$zoom['config']['spinSliderClass'] = 'axZm_zoomSliderSpinContainer_light'; // string

// Ver. 4.3.1+ Hide spin slider when mouse is not over the player
$zoom['config']['spinSliderMouseOver'] = false;

// Ver. 5.0.5+ Id of the parent container for spin slider if not fullscreen, e.g. axZm_spinSliderParent
// set false to disable
$zoom['config']['spinSliderParent'] = false;

// Position of the slider. Possible values: naviTop, naviBottom, top, bottom
// Ver. 5.0.5 removed
// $zoom['config']['spinSliderPosition'] = 'bottom'; // string

// Height of the parent container in px.
// Ver. 5.0.5 removed
// $zoom['config']['spinSliderContainerHeight'] = 36; // int

// Padding of the slider container in px.
// // Ver. 5.0.5 removed
// $zoom['config']['spinSliderContainerPadding'] = array('top'=>16, 'right'=>50, 'bottom'=>5, 'left' =>50); // array

// Top Margin of the spin slider in px.
// Ver. 5.0.5 removed
// $zoom['config']['spinSliderTopMargin'] = 0; // int

// Vertical offset from bottom at fullscreen mode
// $zoom['config'][''] = 5; // int

// CSS class name for spin slider when it is over the player
//$zoom['config']['spinSliderClassFS'] = 'axZm_zoomSliderSpinContainerFS'; // string







///////////////////////////////////////////////
//////////// Zoom Navigation //////////////////
///////////////////////////////////////////////

// Display navigation bar
$zoom['config']['displayNavi'] = false; // bool

// 5.1.0+ Hide navigation bar when the container width is less than this value. Set to false to disable this feature.
$zoom['config']['naviHideMaxWidth'] = 600; // int or false

// 5.1.0+ Hide navigation bar when the container height is less than this value. Set to false to disable this feature.
$zoom['config']['naviHideMaxHeight'] = 400; // int or false

// Enable navi bar at fullscreen mode.
$zoom['config']['fullScreenNaviBar'] = false; // bool

// First switched tool on load
$zoom['config']['firstMod'] = 'pan'; // crop, pan, spin

// Enable switching modes with the keyboard keys
$zoom['config']['keyPressMod'] = array(
    'enable' => true,
    'permanent' => false,
    'crop' => 67, // C key
    'pan' => 17, // strl key
    'spin' => 88 // X key
);

// Instantly switch to pan when reached 100% zoom level
$zoom['config']['forceToPan'] = true; // bool

// Disable "forceToPan", when the user chooses a different tool in case "forceToPan" is enabled.
$zoom['config']['forceToPanClickDisable'] = true; // bool

// Navi position
$zoom['config']['naviPos'] = 'bottom'; // string (bottom, top)

// Navi gravity
$zoom['config']['naviFloat'] = 'right'; // string (left, right)

// Height of navigation container in px (where buttnos are located)
// Do not configure this value it in css file!
$zoom['config']['naviHeight'] = 48; // integer (px)

// Space between buttons of one group
$zoom['config']['naviSpace'] = 5; // integer (px)

// Space between groups of buttons
$zoom['config']['naviGroupSpace'] = 15; // integer (px)

// Minimal padding left and right
$zoom['config']['naviMinPadding'] = 5; // integer (px)

// Top margin of navigation
$zoom['config']['naviTopMargin'] = 2; // integer (px)

// Big buttons for zoomIn, Out
$zoom['config']['naviBigZoom'] = true;

// Display zoom in and zoom out buttons
$zoom['config']['naviZoomBut'] = true; // bool

// Display pan button set (the left, top, right and bottom arrows)
$zoom['config']['naviPanBut'] = true; // bool

// Display restore button
$zoom['config']['naviRestoreBut'] = true; // boolean

// Display crop switch button
$zoom['config']['naviCropButSwitch'] = true; // bool

// Display pan switch button
$zoom['config']['naviPanButSwitch'] = true; // bool

// Display spin switch button
// Will only show if 3D Spin is also activated
$zoom['config']['naviSpinButSwitch'] = true; // bool

// Hotspots button
$zoom['config']['naviHotspotsBut'] = false; // boolean

// Enable a different icon, when mouse is down at a navigation button (down state)..
$zoom['config']['naviDownState'] = true;

// Enable a different icon, when mouse is over a navigation button (over state).
$zoom['config']['naviOverState'] = true;

// Completely disable zoom level
$zoom['config']['zoomLogInfoDisabled'] = false;

// Diplay the zoom level and optionally: time needed to generate the zoomed picture, traffic
// CSS: axZm_zoomLogHolder, axZm_zoomLog
$zoom['config']['zoomLogInfo'] = false; // bool

// Diplay only zoom level, if true - disable $zoom['config']['zoomLogInfo'] above
// CSS: axZm_zoomLogHolder, axZm_zoomLogJustLevel
$zoom['config']['zoomLogJustLevel'] = true; // bool

// Opacity for deaktivated bottons
$zoom['config']['deaktTransp'] = 0.5; // float [0.0 - 1.0]

// Opacity for diabled bottons if image is smaller the stage
$zoom['config']['disabledTransp'] = 0.1; // float [0.0 - 1.0]

// Language vars for the above info
$zoom['config']['zoomLogLevel'] = array(
    'en' => 'Zoom Level',
    'de' => 'Zoomstufe',
    'fr' => 'Le niveau de zoom',
    'es' => 'Nivel de zoom',
    'it' => 'Livello di zoom',
    'pt' => 'Nível de zoom',
    'ru' => 'Уровень масштабирования',
    'pl' => 'Poziom przybliżenia',
    'nl' => 'Zoomniveau',
    'cn' => '缩放级别',
    'jp' => 'ズームレベル'
);

$zoom['config']['zoomLogTime'] = array(
    'en' => 'Zoom Time',
    'de' => '',
    'fr' => '',
    'es' => '',
    'it' => '',
    'pt' => '',
    'ru' => '',
    'pl' => '',
    'nl' => '',
    'cn' => '',
    'jp' => ''
);

$zoom['config']['zoomLogTraffic'] = array(
    'en' => 'Zoom Traffic',
    'de' => '',
    'fr' => '',
    'es' => '',
    'it' => '',
    'pt' => '',
    'ru' => '',
    'pl' => '',
    'nl' => '',
    'cn' => '',
    'jp' => ''
);

$zoom['config']['zoomLogSeconds'] = array(
    'en' => 'seconds',
    'de' => 'Sekunden',
    'fr' => 'secondes',
    'es' => 'segundos',
    'it' => 'secondi',
    'pt' => 'segundos',
    'ru' => 'секунд',
    'pl' => 'sekundy',
    'nl' => 'seconden',
    'cn' => '秒',
    'jp' => '秒'
);

$zoom['config']['zoomLogLoading'] = array(
    'en' => 'Loading...',
    'de' => 'Wird geladen...',
    'fr' => 'Chargement...',
    'es' => 'Cargando...',
    'it' => 'Caricamento in corso...',
    'pt' => 'Carregando...',
    'ru' => 'Загрузка...',
    'pl' => 'Ładuję...',
    'nl' => 'Bezig met laden...',
    'cn' => '载入中...',
    'jp' => '読み込んでいます...'
);







///////////////////////////////////////////////
//////////////// Zoom Slider //////////////////
///////////////////////////////////////////////

// Enable vertical slider für zoom in and out
$zoom['config']['zoomSlider'] = false; // bool

// Default: vertical
$zoom['config']['zoomSliderHorizontal'] = false;

// Height of the vertical slider in px.
$zoom['config']['zoomSliderHeight'] = 120; // int

// Height or thikeness of the slider handle in px.
$zoom['config']['zoomSliderHandleSize'] = 15; // int

// Width or thikeness of the slider in px,
$zoom['config']['zoomSliderWidth'] = 4; // int

// Position of the slider. Possible values: topRight, topLeft, bottomRight, bottomLeft, bottom, top, left, right
$zoom['config']['zoomSliderPosition'] = 'topRight'; // string

// Vertical margin of the slider
$zoom['config']['zoomSliderMarginV'] = 70; // int

// Horizontal margin of the slider
$zoom['config']['zoomSliderMarginH'] = 18; // int

// Padding of the parent container which can be styled with css - #zoomSliderZoomContainer
$zoom['config']['zoomSliderContainerPadding'] = 0; // int

// Opacity of the slider, disabled for MSIE.
$zoom['config']['zoomSliderOpacity'] = 1; // float [0.0 - 1.0]

// Show zoom slider only when mouse is over the player. Disabled for touch devices.
$zoom['config']['zoomSliderMouseOver'] = false;

// CSS class name for zoom slider
$zoom['config']['zoomSliderClass'] = 'axZm_zoomSliderZoomContainer';







///////////////////////////////////////////////
///////// Help button and content /////////////
///////////////////////////////////////////////

// Help (Info) button general switch
$zoom['config']['help'] = true; // bool

// Opacity of Help (Info) container
$zoom['config']['helpTransp'] = 1; // float [0.0 - 1.0]

// Help (Info) container transition time
$zoom['config']['helpTime'] = 300; // integer (ms)

// Margin of help container within the stage
$zoom['config']['helpMargin'] = 20; // integer (px >= 0);

// This is a html wich is shown on clicking the info button
// Write whatever you want in it.
// Feel free to generate this var dynamically with PHP or Javascript
// Javascript: $('#axZm_zoomedHelp').html('Your content goes hier');
// PHP: $zoom['config']['helpTxt'] = $yourContentVar;
$zoom['config']['helpTxt'] = '<div style="padding: 10px;"><h2 style="margin-top: 0">About: AJAX-ZOOM</h2><a rel=nofollow href=https://www.ajax-zoom.com>AJAX-ZOOM</a> is a powerful jQuery based library for displaying high-resolution images and 360° / 3D spins.</div>'; // string

// Instead of $zoom['config']['helpTxt']
// you can load an external url into the help (iframe)
$zoom['config']['helpUrl'] = false; // string







///////////////////////////////////////////////
/////////////////// Buttons  //////////////////
///////////////////////////////////////////////

// Folder under the icons directory ($zoom['config']['icon']), where buttons are located
$zoom['config']['buttonSet'] = 'transparent'; // string

// Ver. 4.3.1+ Theme file located in /axZm/themes/, possible values (extendable) - black, grey, white
$zoom['config']['themeCss'] = 'white';

// Three state filename, filename + _over (mouseover), filename + _down (mousedown), [filename + _switched (aktive)]
$zoom['config']['icons']['width'] = 32;
$zoom['config']['icons']['height'] = 32;
$zoom['config']['icons']['smallWidth'] = 21;
$zoom['config']['icons']['smallHeight'] = 18;
$zoom['config']['icons']['ext'] = 'png';

$zoom['config']['icons']['pan'] = array('file' => 'zoombutton_pan', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}'); // also _switched
$zoom['config']['icons']['crop'] = array('file' => 'zoombutton_crop', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}'); // also _switched
$zoom['config']['icons']['spin'] = array('file' => 'zoombutton_3d', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}'); // also _switched

$zoom['config']['icons']['zoomInBig'] = array('file' => 'zoombutton_in', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['zoomOutBig'] = array('file' => 'zoombutton_out', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');

$zoom['config']['icons']['reset'] = array('file' => 'zoombutton_reset', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');

$zoom['config']['icons']['gallery'] = array('file' => 'zoombutton_gal', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['map'] = array('file' => 'zoombutton_map', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}'); // also _switched

$zoom['config']['icons']['help'] = array('file' => 'zoombutton_help', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');

$zoom['config']['icons']['next'] = array('file' => 'zoombutton_next', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['prev'] = array('file' => 'zoombutton_prev', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['play'] = array('file' => 'zoombutton_play', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['pause'] = array('file' => 'zoombutton_pause', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');

$zoom['config']['icons']['spinPlay'] = array('file' => 'zoombutton_play', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['spinPause'] = array('file' => 'zoombutton_pause', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');

$zoom['config']['icons']['fullScreen'] = array('file' => 'zoombutton_fullscreen', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['fullScreenExit'] = array('file' => 'zoombutton_fullscreen_exit', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');

$zoom['config']['icons']['download'] = array('file' => 'zoombutton_download', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');
$zoom['config']['icons']['hotspots'] = array('file' => 'zoombutton_hotspots', 'ext' => '{ext}', 'w' => '{width}', 'h' => '{height}');

$zoom['config']['icons']['zoomIn'] = array('file' => 'zoombutton_plus', 'ext' => '{ext}', 'w' => '{smallWidth}', 'h' => '{smallHeight}');
$zoom['config']['icons']['zoomOut'] = array('file' => 'zoombutton_minus', 'ext' => '{ext}', 'w' => '{smallWidth}', 'h' => '{smallHeight}');

$zoom['config']['icons']['moveTop'] = array('file' => 'zoombutton_mt', 'ext' => '{ext}', 'w' => '{smallWidth}', 'h' => '{smallHeight}');
$zoom['config']['icons']['moveRight'] = array('file' => 'zoombutton_mr', 'ext' => '{ext}', 'w' => '{smallWidth}', 'h' => '{smallHeight}');
$zoom['config']['icons']['moveBottom'] = array('file' => 'zoombutton_mb', 'ext' => '{ext}', 'w' => '{smallWidth}', 'h' => '{smallHeight}');
$zoom['config']['icons']['moveLeft'] = array('file' => 'zoombutton_ml', 'ext' => '{ext}', 'w' => '{smallWidth}', 'h' => '{smallHeight}');

// Shared
$zoom['config']['icons']['close'] = array('file' => 'zoombutton_close', 'ext' => 'png', 'w' => 13, 'h' => 10); // dragable map
$zoom['config']['icons']['slideNext'] = array('file' => 'zoombutton_slide_next', 'ext' => 'png', 'w' => 42, 'h' => 42);
$zoom['config']['icons']['slidePrev'] = array('file' => 'zoombutton_slide_prev', 'ext' => 'png', 'w' => 42, 'h' => 42);
$zoom['config']['icons']['fullScreenCornerInit'] = array('file' => 'zoombutton_fsc_init', 'ext' => 'png', 'w' => 42, 'h' => 42);
$zoom['config']['icons']['fullScreenCornerRestore'] = array('file' => 'zoombutton_fsc_restore', 'ext' => 'png', 'w' => 42, 'h' => 42);

// "iPad design" icons placed over the player
$zoom['config']['icons']['mWidth'] = 50;
$zoom['config']['icons']['mHeight'] = 50;
$zoom['config']['icons']['mExt'] = 'png';

$zoom['config']['icons']['mPan'] = array('file' => 'button_iPad_pan', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mCrop'] = array('file' => 'button_iPad_crop', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mSpin'] = array('file' => 'button_iPad_spin', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['m3D'] = array('file' => 'button_iPad_3d', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mZoomIn'] = array('file' => 'button_iPad_in', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mZoomOut'] = array('file' => 'button_iPad_out', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');

$zoom['config']['icons']['mMoveTop'] = array('file' => 'button_iPad_mt', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mMoveRight'] = array('file' => 'button_iPad_mr', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mMoveBottom'] = array('file' => 'button_iPad_mb', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mMoveLeft'] = array('file' => 'button_iPad_ml', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');

$zoom['config']['icons']['mReset'] = array('file' => 'button_iPad_reset', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mFullScreen'] = array('file' => 'button_iPad_fullscreen', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mFullScreenExit'] = array('file' => 'button_iPad_fullscreen_close', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');

$zoom['config']['icons']['mGallery'] = array('file' => 'button_iPad_gal', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mDownload'] = array('file' => 'button_iPad_download', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mPlay'] = array('file' => 'button_iPad_play', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mPause'] = array('file' => 'button_iPad_pause', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mSpinPlay'] = array('file' => 'button_iPad_play', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mSpinPause'] = array('file' => 'button_iPad_pause', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mNext'] = array('file' => 'button_iPad_next', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mPrev'] = array('file' => 'button_iPad_prev', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');

$zoom['config']['icons']['mMap'] = array('file' => 'button_iPad_map', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mHelp'] = array('file' => 'button_iPad_help', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mHotspots'] = array('file' => 'button_iPad_hotspots', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');

$zoom['config']['icons']['mEmpty1'] = array('file' => '', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mEmpty2'] = array('file' => '', 'w' => 100, 'h' => 100);

$zoom['config']['icons']['mZoomLevel'] = array('file' => '', 'w' => '{mWidth}', 'h' => '{mHeight}');

$zoom['config']['icons']['mCustomBtn1'] = array('file' => 'button_iPad_custom1', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');
$zoom['config']['icons']['mCustomBtn2'] = array('file' => 'button_iPad_custom2', 'ext' => '{mExt}', 'w' => '{mWidth}', 'h' => '{mHeight}');

// This navigation is an alternative to the regular navigation bar in version previous to 4.0;
// It is better suited for mobile devices but can be used for desktops as well.
$zoom['config']['mNavi'] = array(
    'enabled' => false, // true, false or 'auto' - only for touch devices, disables regular navigation (displayNavi, fullScreenNaviBar)
    'gravity' => 'bottom', //topLeft, topRight, bottomRight, bottomLeft, bottom, top, right, left
    'offsetHorz' => 5, // horizontal from player edge if parentID is not defined
    'offsetVert' => 5, // vertical offset from player edge if parentID is not defined
    'offsetVertFS' => 38, // vertical offset in fullscreen mode
    'offsetHorzFS' => 10, // horizontal offset in fullscreen mode
    'parentID' => false, // put mNavi in none fullscreen mode outside of the player
    'setParentWidth' => false, // sets width of the parent container same as navi container
    'setParentHeight' => false, // sets height of the parent container same as navi container
    'fullScreenShow' => true, // append mNavi to the player in fullscreen mode; you can also enable fullScreenNaviBar option instead
    'onlyFullScreen' => false, // display only at fullscreen mode (window)
    'hover' => true, // looks for button like mPan.file + '_over' on mouse over
    'down' => true, // looks for button like mPan.file + '_over' on mouse down or touch
    'dis' => true, // disabled certain buttons like zoom in and out if they can not be used
    'alignment' => 'horz', // horz, vert (if gravity is 'right' or 'left' defaults to 'vert')
    'mouseOver' => true, // hides when mouse is not over the player on not touch devices
    'firstEllMargin' => 0, // margin left for first button in orderDefault / order
    'ellementRows' => 1, // number rows of elements, if > 1 alignment defaults to 'horz'
    'rowMargin' => 5, // if ellementRows > 1 - margin between the rows
    'containerFixedWidth' => false, // If integer the container width is not calculated instantly but set to this value.
    'containerFixedHeight' => false, // If integer the container height is not calculated instantly but set to this value.
    'buttonDescr' => false, // apply button description as by the old navi
    'alt' => array (
        'enabled' => true,
        'timeout' => 100,
        'fadeIn' => 100,
        'anm' => true, // animate
        'clas' => false, // change class of the tooltip, default axZm_zoomCustomNaviTooltip
        'parentID' => false, // show tooltip at the same place - define id of the container
        'gravity' => 'bottom', // top, bottom
        'offset' => 5,
        'pos' => false, // false, topLeft, topRight, bottomRight, bottomLeft, bottom, top, right, left, center
        'posMarginX' => 10,
        'posMarginY' => 10,
        'opacity' => 1.0,
        'mouseFollow' => false
    ),
    'cssClass' => 'axZm_zoomCustomNavi', // css class for container
    'cssClassFS' => 'axZm_zoomCustomNaviFS', // css class fullscreen view
    'cssClassParentID' => 'axZm_zoomCustomNaviParentID', // css class if parentID is defined

    // buttonName: distance to next button
    'orderDefault' => array('mZoomOut' => 5, 'mZoomIn' => 15, 'mReset' => 15, 'mPan' => 5, 'mSpin' => 5, 'mCrop' => 0),
    'order' => array(),

    'customPos' => array(
        //'mReset' => array('css' => ( array('left' => 5, 'bottom' => 5, 'position' => 'absolute', 'zIndex' => 123) ), 'parentID' => '', 'mouseOver' => true, 'class' => 'abc')
    ),

    'mCustomBtn1' => 'function(){jQuery.fn.axZm.fillArea();}',
    'mCustomBtn2' => 'function(){alert(\'Hello, I am custom button two\');}'
);







///////////////////////////////////////////////
///////////// Buttons titles //////////////////
///////////////////////////////////////////////

// Write whatever you want or replace values with language varibales ;-)
// If you can improve the translations, plese send us your improvements. Thank you.
$zoom['config']['mapButTitle'] = array();

$zoom['config']['mapButTitle']['pan'] = array(
    'en' => 'Pan mode',
    'de' => 'Schwenkmodus',
    'fr' => 'Mode panoramique',
    'es' => 'Modo Pan',
    'it' => 'Modalità Pan',
    'pt' => 'Modo Pan',
    'ru' => 'Режим панорамирования',
    'pl' => 'Tryb panoramowania',
    'nl' => 'Panmodus',
    'cn' => '平移模式',
    'jp' => 'パンモード'
);

$zoom['config']['mapButTitle']['crop'] = array(
    'en' => 'Zoom rectangle tool',
    'de' => 'Zoom-Rechteck-Werkzeug',
    'fr' => 'Outil de rectangle de zoom',
    'es' => 'Herramienta de zoom de rectángulo',
    'it' => 'Zoom strumento di rettangolo',
    'pt' => 'Ferramenta de retângulo de zoom',
    'ru' => 'Инструмент масштабирования прямоугольником',
    'pl' => 'Narzędzie Powiększ prostokąt',
    'nl' => 'Zoom rechthoek gereedschap',
    'cn' => '缩放矩形工具',
    'jp' => 'ズーム矩形ツール'
);

$zoom['config']['mapButTitle']['spin'] = array(
    'en' => '360 spin tool',
    'de' => '360 Drehwerkzeug',
    'fr' => 'Outil de rotation 360',
    'es' => 'Herramienta 360 spin',
    'it' => 'Strumento di rotazione 360',
    'pt' => 'Ferramenta de rotação 360',
    'ru' => 'Инструмент 360 вращения',
    'pl' => '360 narzędzie tokarskie',
    'nl' => '360 draaigereedschap',
    'cn' => '360旋转工具',
    'jp' => '360スピンツール'
);

$zoom['config']['mapButTitle']['zoomIn'] = array(
    'en' => 'Zoom in the image',
    'de' => 'Vergrößern des Bildes',
    'fr' => 'Zoomer dans l\'image',
    'es' => 'Zoom en la imagen',
    'it' => 'Ingrandisci l\'immagine',
    'pt' => 'Amplie a imagem',
    'ru' => 'Увеличить изображение',
    'pl' => 'Powiększ obraz',
    'nl' => 'Zoom in op de afbeelding',
    'cn' => '放大图像',
    'jp' => '画像を拡大する'
);

$zoom['config']['mapButTitle']['zoomOut'] = array(
    'en' => 'Zoom out',
    'de' => 'Rauszoomen',
    'fr' => 'Dézoomer',
    'es' => 'Disminuir el zoom',
    'it' => 'Zoom indietro',
    'pt' => 'Reduzir o zoom',
    'ru' => 'Уменьшить',
    'pl' => 'Pomniejsz',
    'nl' => 'Uitzoomen',
    'cn' => '缩小',
    'jp' => 'ズームアウトする'
);

$zoom['config']['mapButTitle']['zoomInBig'] = array(
    'en' => 'Zoom in the image',
    'de' => 'Vergrößern des Bildes',
    'fr' => 'Zoomer dans l\'image',
    'es' => 'Zoom en la imagen',
    'it' => 'Ingrandisci l\'immagine',
    'pt' => 'Amplie a imagem',
    'ru' => 'Увеличить изображение',
    'pl' => 'Powiększ obraz',
    'nl' => 'Zoom in op de afbeelding',
    'cn' => '放大图像',
    'jp' => '画像を拡大する'
);

$zoom['config']['mapButTitle']['zoomOutBig'] = array(
    'en' => 'Zoom out',
    'de' => 'Rauszoomen',
    'fr' => 'Dézoomer',
    'es' => 'Disminuir el zoom',
    'it' => 'Zoom indietro',
    'pt' => 'Reduzir o zoom',
    'ru' => 'Уменьшить',
    'pl' => 'Pomniejsz',
    'nl' => 'Uitzoomen',
    'cn' => '缩小',
    'jp' => 'ズームアウトする'
);

$zoom['config']['mapButTitle']['moveTop'] = array(
    'en' => 'Pan upwards',
    'de' => 'Nach oben schwenken',
    'fr' => 'Vers le haut',
    'es' => 'Hacia arriba',
    'it' => 'Verso l\'alto',
    'pt' => 'Para cima',
    'ru' => 'Вверх',
    'pl' => 'Przesuń w górę',
    'nl' => 'Pan omhoog',
    'cn' => '向上',
    'jp' => '上向き'
);

$zoom['config']['mapButTitle']['moveRight'] = array(
    'en' => 'Pan to the right',
    'de' => 'Nach rechts schwenken',
    'fr' => 'À droite',
    'es' => 'A la derecha',
    'it' => 'A destra',
    'pt' => 'Para a direita',
    'ru' => 'Направо',
    'pl' => 'Przesuń w prawo',
    'nl' => 'Draai naar rechts',
    'cn' => '在右边',
    'jp' => '右の方へ'
);

$zoom['config']['mapButTitle']['moveBottom'] = array(
    'en' => 'Pan downwards',
    'de' => 'Nach unten schwenken',
    'fr' => 'Vers le bas',
    'es' => 'Hacia abajo',
    'it' => 'Verso il basso',
    'pt' => 'Para baixo',
    'ru' => 'Вниз',
    'pl' => 'Przesuwaj w dół',
    'nl' => 'Pan naar beneden',
    'cn' => '向下',
    'jp' => '下向き'
);

$zoom['config']['mapButTitle']['moveLeft'] = array(
    'en' => 'Pan to the left',
    'de' => 'Nach links schwenken',
    'fr' => 'À gauche',
    'es' => 'A la izquierda',
    'it' => 'A sinistra',
    'pt' => 'Para a esquerda',
    'ru' => 'Налево',
    'pl' => 'Przesuń w lewo',
    'nl' => 'Pan naar links',
    'cn' => '往左边',
    'jp' => '左に'
);

$zoom['config']['mapButTitle']['reset'] = array(
    'en' => 'Reset to initial size',
    'de' => 'Auf ursprüngliche Größe zurücksetzen',
    'fr' => 'Réinitialiser à la taille initiale',
    'es' => 'Restablecer al tamaño inicial',
    'it' => 'Ripristina le dimensioni iniziali',
    'pt' => 'Redefinir para tamanho inicial',
    'ru' => 'Возврат к исходному размеру',
    'pl' => 'Zresetuj do rozmiaru początkowego',
    'nl' => 'Resetten naar oorspronkelijke grootte',
    'cn' => '重置为初始大小',
    'jp' => '初期サイズにリセット'
);

$zoom['config']['mapButTitle']['gallery'] = array(
    'en' => 'Display gallery',
    'de' => 'Galerie anzeigen',
    'fr' => 'Afficher la galerie',
    'es' => 'Mostrar galería',
    'it' => 'Mostra la galleria',
    'pt' => 'Exibir galeria',
    'ru' => 'Показать галерею',
    'pl' => 'Wyświetl galerię',
    'nl' => 'Toon galerij',
    'cn' => '显示库',
    'jp' => '展示ギャラリー'
);

$zoom['config']['mapButTitle']['map'] = array(
    'en' => 'Toggle image map',
    'de' => 'Bildkarte umschalten',
    'fr' => 'Basculer la carte image',
    'es' => 'Alternar mapa de imagen',
    'it' => 'Attiva / disattiva mappa immagine',
    'pt' => 'Alternar mapa de imagem',
    'ru' => 'Переключить карту изображения',
    'pl' => 'Przełącz mapę obrazu',
    'nl' => 'Schakel de afbeelding in',
    'cn' => '切换图像映射',
    'jp' => 'イメージマップを切り替える'
);

$zoom['config']['mapButTitle']['close'] = array(
    'en' => 'Close image map',
    'de' => 'Bildkarte schließen',
    'fr' => 'Fermer l\'image',
    'es' => 'Cerrar mapa de imagen',
    'it' => 'Chiudi mappa immagine',
    'pt' => 'Fechar mapa de imagem',
    'ru' => 'Закрыть карту изображения',
    'pl' => 'Zamknij mapę obrazu',
    'nl' => 'Sluit de afbeelding',
    'cn' => '关闭图像映射',
    'jp' => 'イメージマップを閉じる'
);

$zoom['config']['mapButTitle']['help'] = array(
    'en' => 'Help / Information',
    'de' => 'Hilfe / Information',
    'fr' => 'Aide / Informations',
    'es' => 'Ayuda / Información',
    'it' => 'Aiuto / Informazioni',
    'pt' => 'Ajuda / Informação',
    'ru' => 'Помощь / Информация',
    'pl' => 'Pomoc / Informacje',
    'nl' => 'Hulp / informatie',
    'cn' => '帮助/信息',
    'jp' => 'ヘルプ/情報'
);

$zoom['config']['mapButTitle']['next'] = array(
    'en' => 'Next image',
    'de' => 'Nächstes Bild',
    'fr' => 'Image suivante',
    'es' => 'Imagen siguiente',
    'it' => 'Immagine successiva',
    'pt' => 'Próxima imagem',
    'ru' => 'Следующее изображение',
    'pl' => 'Następny obraz',
    'nl' => 'Volgende afbeelding',
    'cn' => '下一张图片',
    'jp' => '次の画像'
);

$zoom['config']['mapButTitle']['prev'] = array(
    'en' => 'Previous image',
    'de' => 'Vorheriges Bild',
    'fr' => 'Image précédente',
    'es' => 'Imagen anterior',
    'it' => 'Immagine precedente',
    'pt' => 'Imagem anterior',
    'ru' => 'Предыдущее изображение',
    'pl' => 'Poprzednie zdjęcie',
    'nl' => 'Vorige afbeelding',
    'cn' => '上一张图片',
    'jp' => '前の画像'
);

$zoom['config']['mapButTitle']['play'] = array(
    'en' => 'Start autoplay',
    'de' => 'Starten der automatischen Wiedergabe',
    'fr' => 'Démarrer la lecture automatique',
    'es' => 'Comience la reproducción automática',
    'it' => 'Avvia la riproduzione automatica',
    'pt' => 'Iniciar autoplay',
    'ru' => 'Начать автоматическое воспроизведение',
    'pl' => 'Rozpocznij autoodtwarzanie',
    'nl' => 'Begin met autoplay',
    'cn' => '开始自动播放',
    'jp' => '自動再生を開始する'
);

$zoom['config']['mapButTitle']['pause'] = array(
    'en' => 'Stop autoplay',
    'de' => 'Stoppen der automatischen Wiedergabe',
    'fr' => 'Arrêter la lecture automatique',
    'es' => 'Detener la reproducción automática',
    'it' => 'Interrompe la riproduzione automatica',
    'pt' => 'Parar autoplay',
    'ru' => 'Остановить автовоспроизведение',
    'pl' => 'Zatrzymaj autoodtwarzanie',
    'nl' => 'Stop met automatisch spelen',
    'cn' => '停止自动播放',
    'jp' => '自動再生を停止する'
);

$zoom['config']['mapButTitle']['spinPlay'] = array(
    'en' => 'Start spinning 360 object',
    'de' => '360 Objektdrehung starten',
    'fr' => 'Commencer à tourner l\'objet 360',
    'es' => 'Comience a girar el objeto 360',
    'it' => 'Inizia a girare 360 oggetti',
    'pt' => 'Comece a girar o objeto 360',
    'ru' => 'Начать вращение 360 объектa',
    'pl' => 'Zacznij obracać obiekt 360',
    'nl' => 'Begin met het draaien van een 360-object',
    'cn' => '开始旋转360对象',
    'jp' => '回転360オブジェクト開始'
);

$zoom['config']['mapButTitle']['spinPause'] = array(
    'en' => 'Stop spinning 360 object',
    'de' => '360 Objektdrehung beenden',
    'fr' => 'Arrêter de tourner l\'objet 360',
    'es' => 'Deja de girar el objeto 360',
    'it' => 'Interrompi la rotazione di 360 oggetti',
    'pt' => 'Pare de girar o objeto 360',
    'ru' => 'Остановить вращение 360 объектa',
    'pl' => 'Zatrzymaj wirowanie obiektu 360',
    'nl' => 'Stop met het draaien van het 360-object',
    'cn' => '停止旋转360对象',
    'jp' => '360オブジェクトの回転を止める'
);

$zoom['config']['mapButTitle']['arrowLeft'] = array(
    'en' => '',
    'de' => '',
    'fr' => '',
    'es' => '',
    'it' => '',
    'pt' => '',
    'ru' => '',
    'pl' => '',
    'nl' => '',
    'cn' => '',
    'jp' => ''
);

$zoom['config']['mapButTitle']['arrowRight'] = array(
    'en' => '',
    'de' => '',
    'fr' => '',
    'es' => '',
    'it' => '',
    'pt' => '',
    'ru' => '',
    'pl' => '',
    'nl' => '',
    'cn' => '',
    'jp' => ''
);

$zoom['config']['mapButTitle']['fullScreen'] = array(
    'en' => 'Open in fullscreen mode',
    'de' => 'Im Vollbildmodus öffnen',
    'fr' => 'Ouvrir en mode plein écran',
    'es' => 'Abrir en modo pantalla completa',
    'it' => 'Apri in modalità schermo intero',
    'pt' => 'Abrir no modo de tela cheia',
    'ru' => 'Открыть в полноэкранном режиме',
    'pl' => 'Otwórz w trybie pełnoekranowym',
    'nl' => 'Open in volledig scherm',
    'cn' => '以全屏模式打开',
    'jp' => 'フルスクリーンモードで開く'
);

$zoom['config']['mapButTitle']['fullScreenCornerInit'] = array(
    'en' => 'Open in fullscreen mode',
    'de' => 'Im Vollbildmodus öffnen',
    'fr' => 'Ouvrir en mode plein écran',
    'es' => 'Abrir en modo pantalla completa',
    'it' => 'Apri in modalità schermo intero',
    'pt' => 'Abrir no modo de tela cheia',
    'ru' => 'Открыть в полноэкранном режиме',
    'pl' => 'Otwórz w trybie pełnoekranowym',
    'nl' => 'Open in volledig scherm',
    'cn' => '以全屏模式打开',
    'jp' => 'フルスクリーンモードで開く'
);

$zoom['config']['mapButTitle']['fullScreenExit'] = array(
    'en' => 'Exit full screen',
    'de' => 'Vollbildmodus beenden',
    'fr' => 'Quitter le mode plein écran',
    'es' => 'Salir de pantalla completa',
    'it' => 'Esci dalla modalità schermo intero',
    'pt' => 'Sair da tela cheia',
    'ru' => 'Выход из полноэкранного режима',
    'pl' => 'Wyłączyć tryb pełnoekranowy',
    'nl' => 'Verlaat volledig scherm',
    'cn' => '退出全屏',
    'jp' => '全画面を終了'
);

$zoom['config']['mapButTitle']['fullScreenCornerRestore'] = array(
    'en' => 'Exit full screen',
    'de' => 'Vollbildmodus beenden',
    'fr' => 'Quitter le mode plein écran',
    'es' => 'Salir de pantalla completa',
    'it' => 'Esci dalla modalità schermo intero',
    'pt' => 'Sair da tela cheia',
    'ru' => 'Выход из полноэкранного режима',
    'pl' => 'Wyłączyć tryb pełnoekranowy',
    'nl' => 'Verlaat volledig scherm',
    'cn' => '退出全屏',
    'jp' => '全画面を終了'
);

$zoom['config']['mapButTitle']['download'] = array(
    'en' => 'Download current image in full resolution',
    'de' => 'Laden Sie das aktuelle Bild in voller Auflösung herunter',
    'fr' => 'Télécharger l\'image actuelle en pleine résolution',
    'es' => 'Descargar la imagen actual en resolución completa',
    'it' => 'Scarica l\'immagine corrente in piena risoluzione',
    'pt' => 'Baixe a imagem atual em resolução completa',
    'ru' => 'Загрузить текущее изображение в полном разрешении',
    'pl' => 'Pobierz bieżący obraz w pełnej rozdzielczości',
    'nl' => 'Download de huidige afbeelding in volledige resolutie',
    'cn' => '以全分辨率下載當前圖像',
    'jp' => '現在の画像をフル解像度でダウンロードする'
);

$zoom['config']['mapButTitle']['hotspots'] = array(
    'en' => 'Toggle hotspots',
    'de' => 'Markierungen auf dem Bild umschalten',
    'fr' => 'Basculer les marques sur l\'image',
    'es' => 'Alternar las marcas en la imagen',
    'it' => 'Attiva i contrassegni sull\'immagine',
    'pt' => 'Alternar marcações na imagem',
    'ru' => 'Переключить маркировки на картинках',
    'pl' => 'Przełącz znaczniki na obrazie',
    'nl' => 'Wissel van markering op de foto',
    'cn' => '切换图片上的标记',
    'jp' => '画像にマーキングを表示する'
);

$zoom['config']['mapButTitle']['slideNext'] = array(
    'en' => 'Next image',
    'de' => 'Nächstes Bild',
    'fr' => 'Image suivante',
    'es' => 'Imagen siguiente',
    'it' => 'Immagine successiva',
    'pt' => 'Próxima imagem',
    'ru' => 'Следующее изображение',
    'pl' => 'Następny obraz',
    'nl' => 'Volgende afbeelding',
    'cn' => '下一张图片',
    'jp' => '次の画像'
);

$zoom['config']['mapButTitle']['slidePrev'] = array(
    'en' => 'Previous image',
    'de' => 'Vorheriges Bild',
    'fr' => 'Image précédente',
    'es' => 'Imagen anterior',
    'it' => 'Immagine precedente',
    'pt' => 'Imagem anterior',
    'ru' => 'Предыдущее изображение',
    'pl' => 'Poprzednie zdjęcie',
    'nl' => 'Vorige afbeelding',
    'cn' => '上一张图片',
    'jp' => '前の画像'
);

$zoom['config']['mapButTitle']['slideNextSpin'] = array(
    'en' => 'Spin 360 right',
    'de' => '360 nach rechts drehen',
    'fr' => 'Tournez à droite 360',
    'es' => 'Gire 360 a la derecha',
    'it' => 'Girare a 360 a destra',
    'pt' => 'Vire 360 à direita',
    'ru' => 'Повернуть 360 вправо',
    'pl' => 'Obróć 360 w prawo',
    'nl' => 'Draai 360 naar rechts',
    'cn' => '向右转360度',
    'jp' => '右折360'
);

$zoom['config']['mapButTitle']['slidePrevSpin'] = array(
    'en' => 'Spin 360 left',
    'de' => '360 nach links drehen',
    'fr' => 'Tournez 360 vers la gauche',
    'es' => 'Gire 360 a la izquierda',
    'it' => 'Girare 360 a sinistra',
    'pt' => 'Rodar 360 para a esquerda',
    'ru' => 'Повернуть 360 налево',
    'pl' => 'Obróć o 360 w lewo',
    'nl' => 'Draai 360 naar links',
    'cn' => '向左转360度',
    'jp' => '360度左に回す'
);

$zoom['config']['mapButTitle']['customBtn1'] = array(
    'en' => 'Custom button 1 title',
    'de' => 'Benutzerdefinierter Titel der Schaltfläche 1',
    'fr' => 'Titre du bouton personnalisé 1',
    'es' => 'Título del botón personalizado 1',
    'it' => 'Titolo pulsante 1 personalizzato',
    'pt' => 'Botão personalizado 1 título',
    'ru' => 'Пользовательская кнопка 1 название',
    'pl' => 'Niestandardowy przycisk 1 tytuł',
    'nl' => 'Aangepaste knop 1 titel',
    'cn' => 'Custom button 1 title',
    'jp' => 'Custom button 1 title'
);

$zoom['config']['mapButTitle']['customBtn2'] = array(
    'en' => 'Custom button 2 title',
    'de' => 'Benutzerdefinierter Titel der Schaltfläche 2',
    'fr' => 'Titre du bouton personnalisé 2',
    'es' => 'Título del botón personalizado 2',
    'it' => 'Titolo pulsante 2 personalizzato',
    'pt' => 'Botão personalizado 2 título',
    'ru' => 'Пользовательская кнопка 2 название',
    'pl' => 'Niestandardowy przycisk 2 tytuł',
    'nl' => 'Aangepaste knop 2 titel',
    'cn' => 'Custom button 2 title',
    'jp' => 'Custom button 2 title'
);







//////////////////////////////////////////////////////
///////////////// Motion /////////////////////////////
//////////////////////////////////////////////////////

// Move (pan) buttons in persentage of image width or height
// on clicking on arrows in navigation
$zoom['config']['pMove']= 75; // integer (%)

// Percentage of zoomin on left mouse clicking the image or plus button in navigation
$zoom['config']['pZoom'] = 100; // integer (%)

// By clicking on the image with the left mouse button or clicking on the plus button (zoom in) in the navigation bar,
// the image will be zoomed to the next pyramid step, e.g. to 100%, 50%, 25%, 12.5% ...
$zoom['config']['stepZoom'] = false;

// Autozoom after image load
$zoom['config']['autoZoom']['enabled'] = false; // bool
$zoom['config']['autoZoom']['onlyFirst'] = false; // bool
$zoom['config']['autoZoom']['fullscreen'] = false;
$zoom['config']['autoZoom']['speed'] = 250; // integer
$zoom['config']['autoZoom']['motion'] = 'easeOutQuad'; // string
$zoom['config']['autoZoom']['pZoom'] = 'fill'; // mixed int, string: 'fill', 'max' or %, e.g. '50%'

// Percentage of zoom out on right clicking (not aktivated by default in opera browser)
// the image or minus button in navigation
$zoom['config']['pZoomOut'] = 100; // integer (%)

// Default speed for motions ms
$zoom['config']['zoomSpeedGlobal'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Motion speed by clicking on arrows in navigation
$zoom['config']['moveSpeed'] = 750; // integer (ms) or string: 'fast', 'slow', 'medium'

// Motion speed by clicking on plus in navigation or left clicking the image
$zoom['config']['zoomSpeed'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Motion speed by clicking on minus in navigation or right clicking the image
$zoom['config']['zoomOutSpeed'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Motion speed for zoom in by selecting an image area
$zoom['config']['cropSpeed'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Motion speed by clicking on restore button
$zoom['config']['restoreSpeed'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Sidewords motion speed when reached 100% zoom and left clicked on image
$zoom['config']['traverseSpeed'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Fade in time of zoomed image after loading
$zoom['config']['zoomFade'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Fade in time first picture
$zoom['config']['zoomFadeIn'] = 250; // integer (ms) or string: 'fast', 'slow', 'medium'

// Time after which the pic is starting to load when the user clicks on any button in navigation.
// Setting this to 0 will not allow to click twice on a button
$zoom['config']['buttonAjax'] = 750;

// Possible motions types:
// 'swing', 'linear', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart',
// 'easeOutQuart','easeInOutQuart', 'easeInQuint','easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine',
// 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic',
// 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce'

// Default motion type
$zoom['config']['zoomEaseGlobal'] = 'easeOutCirc'; // string

// Motion for zoomin on clicking plus or the image
$zoom['config']['zoomEaseIn'] = 'easeOutQuad'; // string

// Motion zoomout on clicking minus or right click the image
$zoom['config']['zoomEaseOut'] = 'easeOutQuad'; // string

// Motion for zoomin by selecting an image area
$zoom['config']['zoomEaseCrop'] = 'easeInQuad'; // string

// Sideward motion on clicking the arrows buttons in navigation
$zoom['config']['zoomEaseMove'] = 'easeOutQuad'; // buttons

// Motion on clicking the restore button
$zoom['config']['zoomEaseRestore'] = 'easeOutCirc'; // string

// Motion when reached 100% zoom and clicking the image
$zoom['config']['zoomEaseTraverse'] = 'easeOutCirc'; // string

// Frames per second for all animations or false
$zoom['config']['fps1'] = false; // int, false

// Frames per second for all animations at fullscreen mode or false
$zoom['config']['fps2'] = false; // int, false

// Enable gpuAccel (translateZ) for desktop browsers
$zoom['config']['gpuAccel'] = array(
    'chrome' => 10,
    'safari' => 5,
    'firefox' => 22,
    'mozilla' => 22
);







///////////////////////////////////////////////
////// Mousewheel zoomin, zoomout  ////////////
///////////////////////////////////////////////

// Mousewheel zooming general switch
// Can be switched on runtime ($.axZm.scroll = false;)
$zoom['config']['scroll'] = true;

// 4.4.3+ Separate switch for mousewheel zoom at fullscreen mode
$zoom['config']['scrollFS'] = true;

// Enabling this option will not prevent scrolling the browser window with the mousewheel
// Can be switched on runtime ($.axZm.mouseScrollEnable = true;)
$zoom['config']['mouseScrollEnable'] = false;

// 4.4.3+ Separate switch for the above at fullscreen mode
$zoom['config']['mouseScrollEnableFS'] = false;

// Ver. 5.0.11+ if mouseScrollEnable is set to true,
// show a message that zoom with mouse wheel can be performed by pressing "Alt" or "Ctrl" button on the keybord.
// CSS: .axZm_ctrlZoomTxt, .axZm_ctrlZoomTxtInner
$zoom['config']['mouseScrollMsg'] = array(
    'enable' => true, // enable message
    'txt' => array(
        'en' => 'Use «Alt» key + mouse scroll wheel to zoom in',
        'de' => 'Verwende «Alt» Taste + Scrollrad der Maus zum Zoomen',
        'fr' => 'Utilisez la touche «Alt» + la molette de défilement de la souris pour zoomer',
        'es' => 'Utilice la tecla «Alt» + la rueda de desplazamiento del ratón para acercar',
        'it' => 'Usate la freccia «Alt» + la rotellina del mouse per ingrandire',
        'pt' => 'Use a tecla «Alt» + roda de rolagem do mouse para aumentar o zoom',
        'ru' => 'Используйте клавишу «Alt» + колесо мыши для увеличения',
        'pl' => 'Użyj klawisza «Alt» + kółka myszy, aby powiększyć',
        'nl' => 'Gebruik de «Alt» -toets + het muiswieltje om in te zoomen',
        'cn' => '使用«Alt»键+鼠标滚轮放大',
        'jp' => '«Alt»キー+マウスのスクロールホイールを使って拡大する'
    ),
    'fadeIn' => 400, // fadein animation
    'fadeOut' => 400, // fadeout animation
    'remove' => 2500 // remove after ms
);

// Enables / disables animation during mousewheel zoom in and out
// If disabled the options scrollSpeed, scrollMotion, scrollPause - no effect!
$zoom['config']['scrollAnm'] = true;

// Percentage of zoom in / out on each mousewheel scroll.
// 16 is a good value, if scrollAnm is false and
// 35 if scrollAnm is true.
$zoom['config']['scrollZoom'] = 25; // integer (%) // 35

// If scrollAnm is true the duration of animation effect
$zoom['config']['scrollSpeed'] = 250; // integer (ms)

// Time after the last wheel action the ajax call is triggered
$zoom['config']['scrollAjax'] = $zoom['config']['scrollSpeed'] + 200; // integer (ms)

// If scrollAnm is true the animation motion type
$zoom['config']['scrollMotion'] = 'easeOutQuad'; // integer (ms)

// Disables scroll tick for this time period to prevent to fast scrolling
$zoom['config']['scrollPause'] = 20; // integer (ms)

// The scrollAnm works well in some browsers like mozilla firefox or safari,
// but has relative poor performance in old microsoft explorer, even on newer computers.
// If scrollAnm is set to true you can exclude some browsers from scroll animation.
// This example would exclude internet explorer prior to version 9.0 and any version of google chrom lesser than 10 and firefox lesser than 4
// Possible browser values: 'gecko','mozilla','mosaic','webkit','opera','msie','firefox','chrome','safari'
$zoom['config']['scrollBrowserExcl'] = array(
    'msie' => 9,
    'chrome' => 10,
    'firefox' => 4
); // do note delete

// Percentage of zoom in / out on each mousewheel scroll for the from animation excluded browsers
$zoom['config']['scrollBrowserExclPar']['scrollZoom'] = 16;

// Time after the last wheel action the ajax call is triggered for the from animation excluded browsers
$zoom['config']['scrollBrowserExclPar']['scrollAjax'] = 750;

// When reached max zoom level (100) scroll has the same effect as "click - pan".
// However the mousewheel is real fast, so the user will get away from the desired crop to fast.
// You can reduce the normal click distance by this factor.
// 1 - means no effect in comparison to "click - pan"
// false - means no "scroll - pan" at all
// any number > 1 will "soften" this problem, whereas a bigger number means less pan each scroll
$zoom['config']['scrollPanR'] = 4; // mixed, integer > 1 or false;

// Behaivior during zoom out with the mouse wheel. The viewport is disabled.
// Instead coordinates of the oposit part of the image are passed to the zoom out function.
$zoom['config']['scrollOutReversed'] = false;

// Behaivior during zoom out with the mouse wheel. The vieport is disabled.
// Instead coordinates of the center of the image are passed to the zoom out function.
$zoom['config']['scrollOutCenter'] = false;







///////////////////////////////////////////////
//////////////// Pan / Drag ///////////////////
///////////////////////////////////////////////

// Incorporate acceleration of the mouse while dragging resulting in a throw effect.
$zoom['config']['zoomDragPhysics'] = 0.75; // bool, float max. 1.5

// Animate dragging
$zoom['config']['zoomDragAnm'] = true; // bool

// Time im ms the image needs to fully reach the mouse position on drag.
$zoom['config']['zoomDragSpeed'] = 120; // bool

// Time im ms after the last drag action the ajax call is triggered.
$zoom['config']['zoomDragAjax'] = 1120;

// Type of drag motion
$zoom['config']['zoomDragMotion'] = 'easeOutCirc';







///////////////////////////////////////////////
///////////// Image Area Selector  ////////////
///////////////////////////////////////////////

// Selector color inside, false to disable - makes image area selector a bit faster.
$zoom['config']['zoomSelectionColor'] = false; // string (named color e.g. green or html color, e.g. #000000 for black) or false

// Selector opacity
$zoom['config']['zoomSelectionOpacity'] = 0; // float [0.0 - 1.0]

// Color outside the selector, false to disable - makes image area selector a bit faster.
$zoom['config']['zoomOuterColor'] = false; // string (named color e.g. green or html color, e.g. #000000 for black) or false

// Outside the selector opacity
$zoom['config']['zoomOuterOpacity'] = 0.4; // float [0.0 - 1.0]

// Selector border color
$zoom['config']['zoomBorderColor'] = false; // string (named color e.g. green or html color, e.g. #000000 for black) or false

// Selector border width in px
$zoom['config']['zoomBorderWidth'] = 2; // integer (px)

// Expand effect after the selection of imagearea
$zoom['config']['zoomSelectionAnm'] = false; // bool

// Div with a background in the middle of selection area, e.g. a cross
$zoom['config']['zoomSelectionCross'] = true; // bool

// Cross opacity
$zoom['config']['zoomSelectionCrossOp'] = 1.0; // float [0.0 - 1.0]

// Zoom selector mod, possible values 'min' or 'max'.
$zoom['config']['zoomSelectionMod'] = 'min'; // string

// Proportions of the selector. Possible values: false, box, float number > 0
$zoom['config']['zoomSelectionProp'] = false; // string, float or false







///////////////////////////////////////////////
//////////////// AJAX LOADER //////////////////
///////////////////////////////////////////////
// Enable ajax loader (animated icon or css3 animation) on top of the image during loading process.
$zoom['config']['zoomLoaderEnable'] = true;

// Enable only, when AJAX crop / cache operation are running
$zoom['config']['zoomLoaderOnlyAjax'] = true;

// CSS class name of the loader with an animated gif as a background, e.g. 'zoomLoader3' or or css3 animation class.
// As background icon animation, it can also be a PNG "Filmstripe".
// In this case "zoomLoaderFrames" must be set to the amount of the frames in this filmstripe.

$zoom['config']['zoomLoaderClass'] = 'axZm_zoomLoader';

// Final loader transparancy
$zoom['config']['zoomLoaderTransp'] = 1; // float [0.0 - 1.0]

// Fade in speed of the loader
$zoom['config']['zoomLoaderFadeIn'] = 50; // int (ms)

// Fade out speed of the loader
$zoom['config']['zoomLoaderFadeOut'] = 50; // int (ms)

// Position of the loader, possible values:
// 'Center', 'TopLeft', 'TopRight', 'BottomLeft', 'BottomRight'
$zoom['config']['zoomLoaderPos'] = 'Center'; // String

// Margin for loader gravity
$zoom['config']['zoomLoaderMargin'] = 0; // integer (px)

// Instead of using a gif animation you can use any png image like a film stripe.
// This option defines the number of frames, e.g. 12 when axZm_zoomLoader1
// All frames have to be equal in size and located under each other in one png image.
$zoom['config']['zoomLoaderFrames'] = 0;

// Loop time
$zoom['config']['zoomLoaderCycle'] = 1000; // int (ms)







///////////////////////////////////////////////
///////////// Mixed options //////////////////
///////////////////////////////////////////////

// System wait cursor on image load
$zoom['config']['cursorWait'] = false;

// Cursor icons located in $zoom['config']['icon'] directory
$zoom['config']['cursor'] = array(
    'grab' => array('openhand.cur', 'move'),
    'grabbing' => array('closedhand.cur', 'move'),
    'crop' => array('crop.cur', 'crosshair'),
    'spin360grabW' => array('openhand360.cur', 'w-resize'),
    'spin360grabbingW' => array('closedhand360.cur', 'w-resize'),
    'spin360grabN' => array('openhand360N.cur', 'n-resize'), // if spinFlip activated
    'spin360grabbingN' => array('closedhand360N.cur', 'n-resize'),
    'spin3Dgrab' => array('openhand3D.cur', 'move'),
    'spin3Dgrabbing' => array('closedhand3D.cur', 'move'),
    'wait' => array(null, 'wait')
);

// Disable all error and notification messages
$zoom['config']['disableAllMsg'] = false;

// expends to max size if:
// e.g. 1.1 = expand to 100% (original image size),
// if only 10% from zoomed image left...
// this prevents things like 99,2% zoom
$zoom['config']['fullZoomBorder'] = 1.05; // float (>=1)

// expends to min size if:
// e.g. 1.1 = expand to initial picture size,
// if only 10% from zoomed image left...
$zoom['config']['fullZoomOutBorder'] = 1.05; // float (>=1)

// Timeout for ajax zoom request
$zoom['config']['zoomTimeOut'] = false; // false or integer (ms)

// Use bicubic interpolation for IE Ver. prior to 8
$zoom['config']['msInterp'] = false;

// Display errors
$zoom['config']['errors'] = true; // bool (true, false);

// License errors
$zoom['config']['licenseErrors'] = true;

// Display warnings
$zoom['config']['warnings'] = true; // bool (true, false);

// Use session cookies for storing some imformation. Not necessary.
$zoom['config']['useSess'] = false; // bool (true, false);

// Use cached image files for user zooming session.
// If set to true, the script will not generate a zooming image, if it is alredy generated.
// This is only relevant if image tiles are not loaded directly or simpleMode is activated.
// It is only for /examples/example1.php
$zoom['config']['cache'] = true; // bool (true, false)

// Cache time - how long zoomed images should stay in cache folder ($zoom['config']['temp'])
// The script will instantly delete all jpg files in $zoom['config']['temp'] if they are older than this value in seconds
// Should be at least 30 seconds
$zoom['config']['cacheTime'] = 300; // integer, in seconds !!!

// Chmod created images
// Intitial images, e.g. 0644 or false
$zoom['config']['picChmod']['In'] = false; // octal or false

// Thumbs, e.g. 0644 or false
$zoom['config']['picChmod']['Th'] = false; // octal or false

// Image tiles, e.g. 0644 or false
$zoom['config']['picChmod']['Ti'] = false; // octal or false

// Image Pyramid "Imitation", e.g. 0644 or false
$zoom['config']['picChmod']['gP'] = false; // octal or false

// Preload some images defined in css from /axZm/icons directory
$zoom['config']['preloadImg'] = array(
    /*
    'tr_black_90.png',
    'tr_black_70.png',
    'tr_black_50.png',
    'tr_white_30.png'
    */
);







///////////////////////////////////////////////
///////////////// Layout //////////////////////
///////////////////////////////////////////////

// Layers Ver. 4.2.1+ changed class names!
$zoom['config']['backLayer'] = 'axZm_zoomedBackImg';
$zoom['config']['backDiv'] = 'axZm_zoomedBack';
$zoom['config']['backInnerDiv'] = 'axZm_zoomedBackImage';
$zoom['config']['picLayer'] = 'axZm_zoomedImg';
$zoom['config']['overLayer'] = 'axZm_zoomLayerImg';

// Build in rounded corners in px
// For deaktivating set this option to 0
$zoom['config']['cornerRadius'] = 0; // interger (px)

// Ver. 4.3.1+ "CornerRadius" option builds a border around the player. If this value is set to true, then the border has no rounded corners
$zoom['config']['cornerRadiusNotRound'] = false; // bool

// Margin around the picture in px. If build in rounded corners (cornerRadius) are used set it to the same value, e.g. 5
// If no build in counded corners are required, set this value to build border around the zoom picture.
$zoom['config']['innerMargin'] = 0; // interger (px)

// Append a div under navigation to display some information, mainly framerate during zoom, for testing purposes.
// Switch it off after testing!
$zoom['config']['zoomStat'] = false; // bool

// Height of the appended div
$zoom['config']['zoomStatHeight'] = 20; // integer (px)

// Keep stage dimensions as $zoom['config']['picDim']
// Note that if you use gallery or load pictures otherwise via javascript, you should set both to true!
$zoom['config']['keepBoxW'] = true; // bool; true - if you want to keep max width for the layout.
$zoom['config']['keepBoxH'] = true; // bool; true - if you want to keep max height for the layout.







//////////////////////////////////////////////////////////////////////////
///////////////// Dynamic thumbs and cropped thumbs //////////////////////
//////////////////////////////////////////////////////////////////////////

// Allow to generate image thumbs dynamically by passing the values to "/axZm/zoomLoad.php"
$zoom['config']['allowDynamicThumbs'] = true;

// Max. thumbsnail size (width and height) that can be achieved by resizing an image when allowDynamicThumbs is enabled.
$zoom['config']['allowDynamicThumbsMaxSize'] = 1200; // integer

// Sets Cache-Control: maxage header for the dynamically generated images
$zoom['config']['dynamicThumbsMaxCacheTime'] = 60*60*24; // integer (seconds)

// Cache thumbs to disk
$zoom['config']['dynamicThumbsCache'] = true;

// Allow change settings by GET parameter
$zoom['config']['dynamicThumbsCacheByGET'] = true;

// Allow cropping images
$zoom['config']['dynamicThumbsAllowCrop'] = true;

// Max output size of cropped image
$zoom['config']['dynamicThumbsCropMaxSize'] = 600;

// Return croped images only if they are already cached
// If this setting is true and cached version of the crop does not exist, crop values will be ignored
$zoom['config']['dynamicThumbsCropOnlyFromCache'] = false;

// Jpg quality range which can be passed over query string
$zoom['config']['dynamicThumbsQualRange'] = array(50, 95);

// Compare creation time of image and thumb and if image is newer, recreate the thumb
$zoom['config']['dynamicThumbsCtime'] = false;

// 5.1.0+ Interlace dynamically created thumbnails, possible values "Plane", "Line" or false
$zoom['config']['dynamicThumbsInterlace'] = false; // string, bool

// Default jpg quality
$zoom['config']['dynamicThumbsQual'] = 85;

// Png quality
$zoom['config']['dynamicThumbsQualPng'] = array(
    'qual' => 9, // false (default) or int from 0 (no compression) to 9
    'filtering' => 5 // only Imagemagick: false (default) or int from 0 to 5. PNG data encoding filtering (before it is comressed) type: 0 is none, 1 is "sub", 2 is "up", 3 is "average", 4 is "Paeth", and 5 is "adaptive"
);

// 4.4.3+ predefined sizes and quality, others would be not possible if array is not empty
$zoom['config']['dynamicThumbsSizesLimit'] = array(
    /*
    array('w' => 100, 'h' => 100, 'q' => 80),
    array('w' => 100, 'h' => 100, 'q' => 85),
    array('w' => 100, 'h' => 100, 'q' => 90),
    array('w' => 100, 'h' => 100, 'q' => 100),

    array('w' => 128, 'h' => 128, 'q' => 80),
    array('w' => 128, 'h' => 128, 'q' => 85),
    array('w' => 128, 'h' => 128, 'q' => 90),
    array('w' => 128, 'h' => 128, 'q' => 100),

    array('w' => 140, 'h' => 140, 'q' => 90),

    array('w' => 200, 'h' => 200, 'q' => 80),

    array('w' => 220, 'h' => 220, 'q' => $zoom['config']['dynamicThumbsQual']),

    array('w' => 600, 'h' => 600, 'q' => 80),
    array('w' => 600, 'h' => 600, 'q' => 90),

    array('w' => 1200, 'h' => 1200, 'q' => 80)
    */
);

// Please see "subfolderStructure" option.
$zoom['config']['dynamicThumbsStructure'] = 'char';
$zoom['config']['dynamicThumbsStructChmod'] = 0777;

// Ver. 4.2.18+ return image location if dynamicThumbsCache is activated instead of "streaming image"
$zoom['config']['dynamicThumbsRedirect'] = false;

// Enable watermarkt on images generated this way
$zoom['config']['dynamicThumbsWtrmrk'] = array(
    'enable' => false,
    'file' => 'your_logo.png', // watermark file located in /icons directory or other path, e.g. /uploads/watermark/wtr.png
    'minWidth' => 300, // if target image width is less than this value, watermark will be not applied
    'minHeight' => 300, // if target image height is less than this value, watermark will be not applied
    'gravity' => 'Center', // Possible values: NorthWest, North, NorthEast, West, Center, East, SouthWest, South, SouthEast
    'composeStyle' => false, // For Imagemagick only, possible values: 'screen','overlay','multiply','darken','lighten','linear-light','color-dodge','color-burn','hard-light','soft-light','plus','minus','subtract','difference','exclusion'
    'stretch' => true, // Ver. 4.2.18+ adjust watermark size to target size
    'fill' => false,
    'applyOnCrops' => false, // Ver. 4.2.18+
    'allowEnableByGet' => true
);

// Permission settings for querying images by the applications
$zoom['config']['allowAjaxQuery'] = array(
    'images' => true, // allow query images in a folder
    'subFolders' => true, // allow query subfolders of a folder
    'basePath' => array(
        1 => '/pic', // base path where images or subfolders can be queried, you can set it to '/'
        2 => '/pix',
        3 => '/img',
        4 => '/image',
        5 => '/media',
        6 => '360',
        7 => '/some/other/dir'
    ),
    // type of basePath check,
    // contain means that the path should be within the queried path
    // strict means that the path should be at the beginning of the queried path
    'basePathCheck' => 'contain', // possible values: 'contain' or 'strict'
    'maxImageNumber' => 3 // how many images to return from subfolders at most
);







///////////////////////////////////////////////
///////////////// WATERMARK ///////////////////
///////////////////////////////////////////////

// Watermark with an image, general switch
$zoom['config']['watermark'] = false; // bool

// Position (Gravity)
// Possible values: NorthWest, North, NorthEast, West, Center, East, SouthWest, South, SouthEast
$zoom['config']['wtrmrk']['gravity'] = 'Center'; // string

// PNG 24 Bit with transparancy
// The png file does not need to be in the icons directory
$zoom['config']['wtrmrk']['file'] = 'watermark-tiles.png'; // string

// Watermark tiles
// When tiles are loaded directly set the option to true
// All tiles on each level will be watermarked with $zoom['config']['wtrmrk']['file']
$zoom['config']['wtrmrk']['watermarkTiles'] = false;

// Watermark all over the image with $zoom['config']['wtrmrk']['file']
$zoom['config']['wtrmrk']['watermarkTilesFill'] = true;

// For Imagemagick only, overlay style
// Possible values: 'screen','overlay','multiply','darken','lighten','linear-light','color-dodge','color-burn','hard-light','soft-light','plus','minus','subtract','difference','exclusion'
// If you just want transparency, save your png watermark file with transparancy and set $zoom['config']['wtrmrk']['composeStyle'] to false
$zoom['config']['wtrmrk']['composeStyle'] = false; // bool

// Watermark all over the image with $zoom['config']['wtrmrk']['file']
// Consider also making a png image as big as $zoom['config']['picDim']
// if this settings slows down the performance or the results do not satisfy you
// $zoom['config']['wtrmrk']['fill'] = false; // bool

// Place watermark on initial picture
$zoom['config']['wtrmrk']['initPic'] = false; // bool

// PNG 24 Bit with transparancy for "initial pictures"
$zoom['config']['wtrmrk']['initPicFile'] = 'your_logo.png'; // string

// Watermark all over the preview image with $zoom['config']['wtrmrk']['file']
$zoom['config']['wtrmrk']['initPicFill'] = false; // bool

// Adjust watermark size to target size (picDim)
$zoom['config']['wtrmrk']['initPicStretch'] = true; // bool

// Virtual watermark as an layer over the image.
// Does not provide any real protection to the images!
// css class, e.g. 'axZm_zoomWtrmrk' with a background png image or false to disable
$zoom['config']['vWtrmrk'] = false; // string or false







///////////////////////////////////////////////
//////////////////// Text /////////////////////
///////////////////////////////////////////////

// This is a general switch for puting text on the zoomed image
// This setting works only if $zoom['config']['pyrLoadTiles'] is set to false which is not intended in most cases
// If you want to add protection to your hq images use $zoom['config']['watermark'] and $zoom['config']['wtrmrk']['watermarkTiles'] instead
$zoom['config']['text'] = false; // bool

// Following is only needed if above is set to true

// Font text,
// Use \n for line break
// If you pass the string as UTF-8, there should be no problems, provided ttf font file supports the language...
// $axZmH->numeric_to_utf8(#1056;&#1091;...) for example will convert all numeric encoded letters to utf8
// further usefull functions: html_entity_decode, htmlspecialchars_decode,... iconv
$zoom['config']['txt'][0]['fontText'] = $axZmH->numeric_to_utf8(("Copyright 2001-2010\n\"Your Company\"\n")); //

// $zoom['config']['txt'][int] is an array of configurations for the text
// You can specify as much texts as you like
// Define a new key like $zoom['config']['txt'][2]['string']...$zoom['config']['txt'][5]['string']

// Font ttf file
$zoom['config']['txt'][0]['fontFile'] = 'teen_light.ttf'; // string

// Font size pt
$zoom['config']['txt'][0]['fontSize'] = 12; // integer, float

// Font color array R (Red), G (Green), B (Blue)
// Look up from youe favorit image editor
$zoom['config']['txt'][0]['fontColor'] = array('R' => 255, 'G' => 255, 'B' => 255);

// Text transparancy
$zoom['config']['txt'][0]['fontTransp'] = 100; // integer (1 - 100)

// Font gravity, array for multiple positions of the same text
// Possible values: 'NorthWest','North','NorthEast','West','Center','East','SouthWest','South','SouthEast'
// e.g. $zoom['config']['txt'][0]['fontGravity'] = array('NorthWest', 'NorthEast', 'SouthWest', 'SouthEast');
// will put $zoom['config']['txt'][0]['fontText'] in all four corners of the image
$zoom['config']['txt'][0]['fontGravity'] = array('NorthEast'); // array of directions

// Font margin from the edges of the image
$zoom['config']['txt'][0]['fontMargin'] = 7; // integer, px

// Font angle deg.
$zoom['config']['txt'][0]['fontAngle'] = 0; // integer

// Background box general switch
$zoom['config']['txt'][0]['fontBox'] = true; // bool

// Background box Color
$zoom['config']['txt'][0]['fontBoxColor'] = array('R' => 0, 'G' => 0, 'B' => 0);

// Background box opacity
$zoom['config']['txt'][0]['fontBoxTransp'] = 50; // integer (1 - 100)

// Background box padding
$zoom['config']['txt'][0]['fontBoxPadding'] = 7; // integer, px

// This could be the second text....
// uncomment if needed
$zoom['config']['txt'][1]['fontText'] = ' https://www.ajax-zoom.com ';
$zoom['config']['txt'][1]['fontFile'] = 'teen.ttf';
$zoom['config']['txt'][1]['fontSize'] = 10; //pt
$zoom['config']['txt'][1]['fontColor'] = array('R' => 255,'G' => 255,'B' => 255);
$zoom['config']['txt'][1]['fontTransp'] = 100;
$zoom['config']['txt'][1]['fontMargin'] = 3; // px
$zoom['config']['txt'][1]['fontAngle'] = -90; // degree
$zoom['config']['txt'][1]['fontGravity'] = array('SouthWest');
$zoom['config']['txt'][1]['fontBox'] = true;
$zoom['config']['txt'][1]['fontBoxColor'] = array('R' => 0, 'G' => 0, 'B' => 0);
$zoom['config']['txt'][1]['fontBoxTransp'] = 100; // integer (1 - 100)
$zoom['config']['txt'][1]['fontBoxPadding'] = 3; // integer, px







////////////////////////////////////////////////////////////
////////////////// Image pyramid with tiles ////////////////
////////////////////////////////////////////////////////////

// General switch
$zoom['config']['pyrTiles'] = true; // bool

// Display info dialog after tiles have been made on the fly. Happens only once for each image.
$zoom['config']['pyrDialog'] = true; // bool

// 5.1.0+ Interlace tiles, possible values "Plane", "Line" or false
$zoom['config']['pyrInterlace'] = false; // string, bool

// JPG quality of the generated tiles
// If you have some discspace use 100 for perfect results
$zoom['config']['pyrQual'] = 80;

// PNG quality if pngMode is turned on
$zoom['config']['pyrQualPng'] = array(
    'qual' => 9, // false (default) or int from 0 (no compression) to 9
    // only Imagemagick: false (default) or int from 0 to 5. PNG data encoding filtering (before it is comressed)
    // type: 0 is none, 1 is "sub", 2 is "up", 3 is "average", 4 is "Paeth", and 5 is "adaptive"
    'filtering' => 5
);

// Tiles size
$zoom['config']['tileSize'] = 384; // int (px) min: 128, max:768, 384

// Ver. 5.1.2+ Tiles overlap value
// If you change the value after any tiles were already generated previously,
// then all tiles need to be regenerated. So delete all present tiles after the value has been changed!
$zoom['config']['tileOverlap'] = 0;

// Delete make.txt file which is generated while making the tiles and retry
$zoom['config']['tileRetryTime'] = 600; // 10 minutes

// This option should only be set to if there are different tilesizes in the image collection with zoom functionality.
// Different tilesizes arise out of changing the tileSize after some image tiles pyramids have already been generated.
// So in case tileSize values are going to be changed afterwards, consider rebuilding all tiles too and disable this option.
$zoom['config']['pyrAutoDetect'] = false; // bool

// Folder where tiles will be saved. Can be a http password protected direcotry (.htaccess, .htpasswd).
// A subfolder with the name if the pic without .jpg will be made in this folder
// Make the $zoom['config']['pyrTilesDir'] with FTP or however
// PHP should be able to write to this folder!
$zoom['config']['pyrTilesPath'] = '/pic/zoomtiles_80/'; //string

// Chmod for the new created subfolders, where the tiles will be stored separately for each image.
$zoom['config']['pyrChmod'] = 0777;

// With which imaging library make image tiles, possible values: 'GD' or 'IM'.
// GD stands for native PHP GD2 and IM for ImageMagick.
$zoom['config']['pyrProg'] = 'GD'; // string

// Only for imagemagick: limit memory and other settings for tiles making.
// https://www.imagemagick.org/script/command-line-options.php#limit
$zoom['config']['pyrProgImLimit'] = array();
$zoom['config']['pyrProgImLimit']['memory'] = false; // false or integer (MB)
$zoom['config']['pyrProgImLimit']['map'] = false; // false or integer (MB)
$zoom['config']['pyrProgImLimit']['area'] = false; // false or integer (MB)
$zoom['config']['pyrProgImLimit']['disk'] = false; // false or integer (MB)
$zoom['config']['pyrProgImLimit']['thread'] = false; // false or integer (number of threads of execution)
$zoom['config']['pyrProgImLimit']['time'] = false; // false or integer (maximum elapsed time in seconds)

// Ver. 5.1.2+ Possible values: 1 or 2
// Method 1 will cut the image "old way", which works also with older ImageMagick versions and proved to be stable
// Method 2 is an optimized way, which will spped up the process by 30-50% depending on image size
// If the image is very large and exceeds the resolution stated in $zoom['config']['pyrIMcacheLimit'],
// then method 1 will be applied instantly.
// When you have troubles with the faster method, apply method number 1
$zoom['config']['pyrImMethod'] = 2;

// In case, that ImageMagick or GD can not allocate sufficient RAM (especially on very large images),
// not all tiles for an image might be generated. If pyrProgErrorRemove is set to true the program will
// delete the tiles and the created folder for this unsuccessful attempt.
// If you use GD make sure, that memory_limit ( e.g. ini_set ('memory_limit', '512M') ) or even more is possible!
// If you have imageMagick installed please notice $zoom['config']['pyrIMcacheLimit'] and $zoom['config']['pyrProgImLimit'] options.
$zoom['config']['pyrProgErrorRemove'] = true; // bool

// With ImageMagick ($zoom['config']['pyrProg'] = 'IM') it is possible to proceed
// very large images (100 Mio Pixel e.g. 20.000px x 5.000) with relative low RAM.
// This setting will force to cache the image to disk (and not RAM) if
// image dimensions (width * height) exceed this settings value,
// e.g. imagesize: 5.200 x 3.700 = 19.24 Mio Pixel.
// However this procedure is much slower, so be patient!
// With 512mb RAM we found a limit from around 50 Mio Pixel
// (Will override any $zoom['config']['pyrProgImLimit']['memory'] and ['map'] settings)
// Set $zoom['config']['pyrDialog'] = true for testing purposes.
$zoom['config']['pyrIMcacheLimit'] = 650; // float (Mio Pixel)

// With which program stitch tiles?
// 'GD' OR 'IM'
$zoom['config']['pyrStitchProg'] = 'GD'; // string

// Only for imagemagick: limit memory and other settings, only for stitching tiles !!!
// https://www.imagemagick.org/script/command-line-options.php#limit
$zoom['config']['pyrStitchImLimit'] = array();
$zoom['config']['pyrStitchImLimit']['memory'] = 256; // false or integer (MB)
$zoom['config']['pyrStitchImLimit']['map'] = 256; // false or integer (MB)
$zoom['config']['pyrStitchImLimit']['area'] = false; // false or integer (MB)
$zoom['config']['pyrStitchImLimit']['disk'] = false; // false or integer (MB)
$zoom['config']['pyrStitchImLimit']['thread'] = false; // false or integer (number of threads of execution)
$zoom['config']['pyrStitchImLimit']['time'] = false; // false or integer (maximum elapsed time in seconds)

// Which level to select during zoom. Value equal or bigger than 1.0;
// 1.2 means that the stitched image has to be at least 20% larger or equal, than outputted cropped size.
// If not, the next bigger level will be chosen and scaled down to the needed output size.
$zoom['config']['pyrStitchSel'] = 1.0; // float >= 1

// Load tiles directly
$zoom['config']['pyrLoadTiles'] = true; // bool

// 5.3.11+ Load some tiles while panning that are not visible in viewport
// The value defines the pixel offset that should be covered by tiles outside of the viewport;
$zoom['config']['pyrTilesExtend'] = 200; // integer

// Tiles fadein speed
$zoom['config']['pyrTilesFadeInSpeed'] = 400; // integer

// Tiles fadein speed
$zoom['config']['pyrTilesFadeLoad'] = 200; // integer

// Ver. 4.3.1+ byload image tiles even if it is not needed
$zoom['config']['pyrTilesForce'] = false;



///////////////////////////////////////////////
//////////// Image Pyramid "Imitation" ////////
///////////////////////////////////////////////

// Please use $zoom['config']['pyrTiles'] OR $zoom['config']['gPyramid']
// "gPyramid" will generate full images in different sizes, which are smaller, than the original
// If $zoom['config']['gPyramidFaktor'] set to 2, and original image is 4000x2000, than following images will be generated:
// 2000x1000, 1000x500 and may be 500x250
// If $zoom['config']['gPyramidFaktor'] set to 1,5, then 2667x1333, .. and some more images
// Depending on zoom level an appropriate image will be taken for cropping from
// This will reduce the time your server needs to generate a zoomed image
// Since at full zoom still the original image will be taken, consider using the real image tile function $zoom['config']['pyrTiles']
// It takes longer to generate the tiles than full pyramid images, but once generated the tiles can be stitched
// regardless of zooming level very very quickly ;-)
// all images will be generated on the fly when you first call the image in frontend

// Set to true, if you want to use image pyramid.
$zoom['config']['gPyramid'] = false; // bool

// Following is only needed if above is set to true

// Folder, where image pyramid files will be stored
// Can be http password protected
// A subfolder with the name if the pic without .jpg will be made in this folder
// Make the $zoom['config']['gPyramidPath'] over FTP or however
// PHP should be able to write to this folder
$zoom['config']['gPyramidPath'] = '/pic/zoompyramid/';

// Display info message after pyramid has been made
$zoom['config']['gPyramidDialog'] = true; // bool

// Chmod new directory (e.g. 0775)
// Possible values: 0600, 0644 ,0755, 0750, 0777
$zoom['config']['gPyramidChmod'] = 0777;

// With which programm make pyramid files?
// Possible values: 'GD' OR 'IM'
$zoom['config']['gPyramidProg'] = 'GD'; // string, 'GD' OR 'IM';

// Only for imagemagick: limit memory and other settings
// https://www.imagemagick.org/script/command-line-options.php#limit
$zoom['config']['gPyramidImLimit'] = array();
$zoom['config']['gPyramidImLimit']['memory'] = false; // false or integer (MB)
$zoom['config']['gPyramidImLimit']['map'] = false; // false or integer (MB)
$zoom['config']['gPyramidImLimit']['area'] = false; // false or integer (MB)
$zoom['config']['gPyramidImLimit']['disk'] = false; // false or integer (MB)
$zoom['config']['gPyramidImLimit']['thread'] = false; // false or integer (number of threads of execution)
$zoom['config']['gPyramidImLimit']['time'] = false; // false or integer (maximum elapsed time in seconds)

// Force cach to disk from this size
$zoom['config']['gPyramidIMcacheLimit'] = 450; // integer (Mio Pixel)

// value between 1.3 and 2.0
// 2 is normal, leass then 2 will generate more images and require more diskspace!
$zoom['config']['gPyramidFaktor'] = 2; // float

// value equal or bigger than 1.0
// which pyramid file to select during zoom. 1.2 means have to be at least 20% larger or equal, than outputed crop size
$zoom['config']['gPyramidSel'] = 1.2; // float >= 1.0

// Output JPG quality for image pyramid;
$zoom['config']['gPyramidQual'] = 100; // integer, max 100

// PNG quality if pngMode is turned on
$zoom['config']['gPyramidQualPng'] = array(
    'qual' => 9, // false (default) or int from 0 (no compression) to 9
    'filtering' => 5 // only Imagemagick: false (default) or int from 0 to 5. PNG data encoding filtering (before it is comressed) type: 0 is none, 1 is "sub", 2 is "up", 3 is "average", 4 is "Paeth", and 5 is "adaptive"
);







///////////////////////////////////////////////
/////////////// Fullscreen Mode ///////////////
///////////////////////////////////////////////

// Enable fullscreen mode.
$zoom['config']['fullScreenEnable'] = true; // bool

// Enable fullscreen button in the navibar.
$zoom['config']['fullScreenNaviButton'] = true; // bool

// Enable fullscreen button at the top right corner.
$zoom['config']['fullScreenCornerButton'] = true; // bool

// 4.4.3+ Enable fullscreen button for touch devices
$zoom['config']['fullScreenCornerButtonTouch'] = true; // bool

// Position of the fullscreen button image
$zoom['config']['fullScreenCornerButtonPos'] = 'topRight'; // string topLeft, topRight, bottomLeft, bottomRight
//$zoom['config']['icons']['fullScreenCornerInit'] = array('file' => 'zoombutton_fsc2_init', 'ext' => 'png', 'w'=>50, 'h'=>50);
//$zoom['config']['icons']['fullScreenCornerRestore'] = array('file' => 'zoombutton_fsc2_restore', 'ext' => 'png', 'w'=>50, 'h'=>50);

// Enable mouseover state of the fullscreen button
$zoom['config']['fullScreenCornerButtonMouseOver'] = false; // bool

// Offset of the fullscreen button image
$zoom['config']['fullScreenCornerButtonMarginX'] = 5; // int
$zoom['config']['fullScreenCornerButtonMarginY'] = 5; // int

// Show text about using ESC to exit the fullscreen mode on entering. If false, disabled.
$zoom['config']['fullScreenExitText'] = array(
    'en' => 'Press <span class="axZmEsc">ESC</span> to exit full screen mode',
    'de' => 'Drücken Sie <span class="axZmEsc">ESC</span>, um den Vollbildmodus zu beenden',
    'fr' => 'Appuyez sur <span class="axZmEsc">ÉCHAP</span> pour quitter le mode plein écran',
    'es' => 'Presione <span class="axZmEsc">ESC</span> para salir del modo de pantalla completa',
    'it' => 'Premere <span class="axZmEsc">ESC</span> per uscire dalla modalità a schermo intero',
    'pt' => 'Pressione <span class="axZmEsc">ESC</span> para sair do modo de tela cheia',
    'ru' => 'Нажмите <span>ESC</span> для выхода из полноэкранного режима',
    'pl' => 'Naciśnij <span class="axZmEsc">ESC</span>, aby wyjść z trybu pełnoekranowego',
    'nl' => 'Druk op <span class="axZmEsc">ESC</span> om de modus Volledig scherm af te sluiten',
    'cn' => '按ESC退出全屏模式',
    'jp' => '<span class="axZmEsc">ESC</span>を押して全画面モードを終了する'
);

// Time in ms after which the ESC message disappears.
$zoom['config']['fullScreenExitTimeout'] = 1500; // int

// 5.3.11+ Show text message only once
$zoom['config']['fullScreenExitOnce'] = true; // bool

// The size of fullscreen with Javascript is only possible relative to the inner width and height of the current window.
// The default setting is 'window'. You can however set the ID of any other element on your page instead.
$zoom['config']['fullScreenRel'] = 'window'; // string

// Try to keep zoom level (visible part of the zoomed image) when changing to fullscreen mode, back or resizing the player / browser window size.
$zoom['config']['fullScreenKeepZoom'] = array('init' => true, 'restore' => true, 'resize' => true);

// Enable native fullscreen JavaScript API if supported by the browser.
$zoom['config']['fullScreenApi'] = false; // bool

// Adds divs for custom content around the player at fullscreen mode
// You can access the divs best over onFullScreenSpaceAdded callback
// and append your content to these divs with ID's #axZmFsSpaceTop, #axZmFsSpaceRight, #axZmFsSpaceBottom and #axZmFsSpaceLeft
$zoom['config']['fullScreenSpace'] = array(
    'top' => 0, // height of the div
    'right' => 0, // width of the div
    'bottom' => 0, // height of the div
    'left' => 0, // width of the div
    'layout' => 1, // if e.g. top and right are set, layout 1 will make right column be 100% height, if layout is set to 2, then right column be under top row
    'always' => false // 4.3.8+ show also when AJAX-ZOOM is triggered responsive (not just fullscreen)
);







/////////////////////////////////////////////////////////
////////////////////// Download  ////////////////////////
/////////////////////////////////////////////////////////

// Allow the users to download the source file as original image or in certain resolution
$zoom['config']['allowDownload'] = false; // boolen

// Download button in the navigation bar
$zoom['config']['downloadButton'] = true; // boolen

// Download resolution
// Possible values:
// false (download the original image),
// string - e.g. '1024x768' (download the image in certain resolution as jpg)
// array - e.g. array('1024x768', '1280x1024', '1600x1050') (download the image in this resolution depending on second argument 'res' passed by the API function $.fn.axZm.downloadImg(id, res))
$zoom['config']['downloadRes'] = '1024x768'; // mixed

// Output quality of the jpg image if $zoom['config']['downloadRes'] is not false
$zoom['config']['downloadQual'] = 85; // integer

// Download quality of PNG images
$zoom['config']['downloadQualPng'] = array(
    'qual' => 9, // false (default) or int from 0 (no compression) to 9
    'filtering' => 5 // only Imagemagick: false (default) or int from 0 to 5. PNG data encoding filtering (before it is comressed) type: 0 is none, 1 is "sub", 2 is "up", 3 is "average", 4 is "Paeth", and 5 is "adaptive"
);

// Cache files in $zoom['config']['downloadRes'] resolution resolution once they have been downloaded by a user.
$zoom['config']['downloadCache'] = true;








/////////////////////////////////////////////////////////
/////////////////// Other settigns  /////////////////////
/////////////////////////////////////////////////////////

// Domain (set it to false in this version)
$zoom['config']['domain'] = false; // string or false

// Hide / show all UI elements including zoom map and any other user injected elements by taping at the player.
// zoomDoubleClickTap below has to be set as well
$zoom['config']['tapHideAll'] = false; // bool

// Ver. 4.4.8+ Array with a list of CSS classes or ID's to exclude from hiding when tapHideAll is enabled.
$zoom['config']['tapHideExcl'] = array('axZm_zoomCornerFsc');

// Double ckick or double tap in order to zoom in (out, when completly zoomed in). The integer value indicates the max double click speed in ms.
$zoom['config']['zoomDoubleClickTap'] = false; // false or int

// Scoll page on vertical touch motions when pan mode is activated and the image is not zoomed
// Can be float - width of the player compared to window width
$zoom['config']['touchDragPageScroll'] = true;

// Ver. 4.3.1+ Disable page scroll for touch devices
$zoom['config']['touchPageScollDisable'] = false;

// Scroll vertically if image is zoomed and pan mode activated
$zoom['config']['touchDragPageScrollZoomed'] = false;

// Scroll page on vertical touch motions when spin mode is activated
// Can be float - width of the player compared to window width
$zoom['config']['touchSpinPageScroll'] = true;

// Instantly deactivate vertical page scroll if this value is contained in the string of parent id of AJAX-ZOOM
// You can also deaktivate vertical scroll by setting window.az_touchPageNoScroll to true
$zoom['config']['touchPageScrollExcl'] = 'box';

// Ver. 4.3.1+ Disable multitouch events (ignore not primary events), should be set conditionally with JS by changing the value of jQuery.axZm.disableMultitouch
$zoom['config']['disableMultitouch'] = false;

// Ver. 4.3.1+ Elements like mNavi or zoom slider can be configured to hide if mouse is not over the player. This option determins the delay for hiding.
$zoom['config']['autoHideEllDelay'] = 2000;

// By freely setting array elements of this option you can override any other AJAX-ZOOM option which will only be enabled for touch devices.
// For example you can disable spinSlider and zoomSlider if you think these UI elements do not make much sense on touch screens.
// $zoom['config'] will be extended for touch devices simmilar to jQuery.extend();
// Settings for touch devices
$zoom['config']['touchSettings'] = array(
    'zoomDoubleClickTap' => 350,
    'tapHideAll' => true,
    'useMap' => false,
    //'displayNavi' => false,
    //'fullScreenNaviBar' => false,
    //'mNavi' => array(
    //'enabled' => true
    //),
    'zoomSlider' => false,
    'spinSlider' => false,
    'zoomOutClick' => true
);

// Use window.requestAnimationFrame for jQuery animations;
// Requires jQuery Ver. 1.8+
$zoom['config']['polyfill'] = true; // bool

// Ver. 5.1.0+ blend out all page elements when AJAX-ZOOM is in fullscreen mode
// Disable if there are any troubles because of that
$zoom['config']['lockAll'] = false; // bool

// Instantly set background color, useful if background color is solid e.g. white or black
$zoom['config']['autoBackColor'] = false;

// Zoomify convert (only Unlimited license)
$zoom['config']['zC'] = false;

// Append visual configuration under the zoom for testing purposes.
// This option is experimental and besides demonstration it is meant to be in the backend of a larger system for dynamic configuration.
// It should be expanded in the feature versions.
// As for now it is a quick & dirty solution to demonstrate some options.
$zoom['config']['visualConf'] = false; // bool

// $zoom['config']['parToPass'] are parameters, that will be passed to zoomLoad.php
// zoomLoad.php generates the zoomed image. It needs to know, which image has to be cropped.
// Along with zoomID, which determins the desired image of the array (see zoomObjects.inc.php),
// your parameters can be important in order to generate this specific array of images for the page.
// The method zoomServerPar() will take the query string (e.g. productID=12345&catID=123&smthElse=blabla&zoomID=5)
// or an array of key/value type like $_GET,
// exclude the parameter zoomID, zoomFile, zoomLoadAjax and loadZoomAjaxSet from it (in order to not define it twice)
// and finaly append the remaining parameters to the query string, that will be passed to zoomLoad.php
// Watch inside axZmH.class.php for detailed description of the method zoomServerPar
// You do not have to use this method, as long as the image array determining parameter in zoomObjects.inc.php is passed!
// If it is just one, for example productID, then you can write,
// $zoom['config']['parToPass'] = 'productID='.(int)$_GET['productID'];
// Using the method zoomServerPar make sure to exclude zoomID, zoomFile, zoomLoadAjax and loadZoomAjaxSet to be passed (twice)
$zoom['config']['parToPass'] = $axZmH->zoomServerPar('str', array('zoomID', 'zoomFile', 'zoomLoadAjax', 'loadZoomAjaxSet'), false, $_GET);

// Each time AJAX-ZOOM requests a portion of an image, it passes (along with the parToPass - see above)
// the query string parameter zoomID to the file zoomLoad.php;
// zoomID serves as identifier to choose the desired image out of the array with images (see defining the images),
// whereas zoomID is the numeric key in this image array.

// In some cases it could be not preferable to generate the image array for each zoom request.
// Setting this option to true will skip the generation of the image array and pass the image filename and it's absolute path instead of zoomID.
// The advantage of enabling this option is a slight speed enhancement, the disadvanage is that anyone could see the location of the original image.
// (The directory with original images can however be .htpasswd protected)
$zoom['config']['cropNoObj'] = true;

// Ver. 4.4.11+ pause after a 360 / 3D image has been processed on-the-fly
$zoom['config']['imgProcessTimeOut'] = 0;

// Ver. 5.0.9+ store information about source image and (cache, tiles...) images which are generated by AJAX-ZOOM for this image
// in a json file, located under $zoom['config']['jsonPath'] / $zoom['config']['jsonDir'] in subdirectories
// All files are generated and updated dynamically even if cached images are already present before this option were enabled
// The advantage of it is that when source images and AJAX-ZOOM - generated images are stored on network or external hard drives,
// the image size and existence of AJAX-ZOOM - generated images are stored in json file and are not needed to be read from filesystem
$zoom['config']['jsonInfo'] = false;

// Ver. 5.0.15+
$zoom['config']['jsonInfoPrettyPrint'] = true;








////////////////////////////////////////////////////////////
////////// Override config options for examples  ///////////
////////////////////////////////////////////////////////////

// Some options are overridden depending on the passed parameter example, e.g. $_GET['example'] = 'magento';
// These options sets are stored in the following separate file, which is just included here
if (isset($_GET['example'])
    || isset($_GET['previewPic'])
    || isset($_GET['azImg'])
    || isset($inludeCustomConfig)
    || isset($_GET['qq'])
) {
    // Custom config options for examples
    if (isset($_GET['example']) && file_exists(dirname(__FILE__).'/zoomConfigCustom.inc.php')) {
        include_once dirname(__FILE__).'/zoomConfigCustom.inc.php';
    }

    // Dynamic settings for the Demo (used only in example1.php)
    if ($zoom['config']['visualConf'] && isset($_GET['example']) && $_GET['example'] == 10) {
        if (file_exists(dirname(__FILE__).'/zoomVisualConf.inc.php')) {
            include_once dirname(__FILE__).'/zoomVisualConf.inc.php';
        }
    }

    // File outside /axZm/ folder
    if (file_exists(dirname(dirname(__FILE__)).'/zoomConfigCustomAZ.inc.php')) {
        include_once dirname(dirname(__FILE__)).'/zoomConfigCustomAZ.inc.php';
    }
}







////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
/////////////  DO NOT EDIT THE FOLLOWING CODE //////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////

$zoom['config']['fpPP'] = $axZmH->checkSlash($zoom['config']['fpPP'],'remove');

// Base path for reading with PHP
$zoom['config']['picDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['pic'],'add');

// Paths for reading / writing with PHP
$zoom['config']['iconDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['icon'],'add');
$zoom['config']['thumbDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['thumbs'],'add');
$zoom['config']['galleryDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['gallery'],'add');
$zoom['config']['fontDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['fontPath'],'add');
$zoom['config']['gPyramidDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['gPyramidPath'],'add');
$zoom['config']['pyrTilesDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['pyrTilesPath'],'add');
$zoom['config']['mapDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['mapPath'],'add');
$zoom['config']['tempCacheDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['tempCache'],'add');
$zoom['config']['tempDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['temp'],'add');
$zoom['config']['jsonDir'] = $axZmH->checkSlash($zoom['config']['fpPP'].'/'.$zoom['config']['installPath'].'/'.$zoom['config']['jsonPath'],'add');

// Save settings
$zoom['config']['pathSave'] = array(
    'js' => $zoom['config']['js'],
    'icon' => $zoom['config']['icon'],
    'thumbs' => $zoom['config']['thumbs'],
    'temp' => $zoom['config']['temp'],
    'gallery' => $zoom['config']['gallery'],
    'gPyramidPath' => $zoom['config']['gPyramidPath'],
    'pyrTilesPath' => $zoom['config']['pyrTilesPath'],
    'mapPath' => $zoom['config']['mapPath'],
    'tempCache' => $zoom['config']['tempCache'],
    'jsonPath'=> $zoom['config']['jsonPath']
);

// Paths for reading
$zoom['config']['js'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['js'], 'add');
$zoom['config']['icon'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['icon'], 'add');

$zoom['config']['thumbs'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['thumbs'], 'add');
$zoom['config']['gallery'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['gallery'], 'add');
$zoom['config']['gPyramidPath'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['gPyramidPath'], 'add');
$zoom['config']['pyrTilesPath'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['pyrTilesPath'], 'add');
$zoom['config']['mapPath'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['mapPath'], 'add');
$zoom['config']['tempCache'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['tempCache'], 'add');

$zoom['config']['temp'] = $axZmH->checkSlash($zoom['config']['urlPath'].'/'.$zoom['config']['temp'], 'add');
$zoom['config']['zoomLoadFile'] = $axZmH->checkSlash($zoom['config']['js'].'/zoomLoad.php', 'remove');
$zoom['config']['zoomLoadSess'] = $axZmH->checkSlash($zoom['config']['js'].'/zoomSess.php', 'remove');

// File outside /axZm/ folder
if (file_exists(dirname(dirname(__FILE__)).'/zoomConfigCustomUSR.inc.php')) {
    include_once dirname(dirname(__FILE__)).'/zoomConfigCustomUSR.inc.php';
}

// Proceed
$zoom = $axZmH->checkConfig($zoom);
