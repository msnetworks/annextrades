<?php
/**
* Plugin: jQuery AJAX-ZOOM, saveCropJSON.php
* Copyright: Copyright (c) 2010-2017 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 5.0.1
* Date: 2017-07-04
* Review: 2017-07-04
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

error_reporting(E_ERROR);

// Adjust the path
function checkSlash($input, $mode = false)
{
    // Replace backslashes
    $input = str_replace('\\', '/', $input);
    
    // Remove doubleslashes in $input
    $input = preg_replace('/\/+/', '/', $input);
    
    // Remove slash at the end of $input
    if ($mode == 'remove') {
        if (substr($input, -1) == '/') {
            $input = substr($input, 0, -1);
        }
    }
    
    // Add slash at the end of $input
    elseif ($mode == 'add') {
        if (substr($input, -1) != '/' and strlen($input)>0) {
            $input.='/';
        }
    }
    return $input;
}

// Get installation path
function installPath()
{
    $path = dirname(str_replace('//', '/', str_replace(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])), '/', str_replace('\\', '/', dirname(realpath(__FILE__))))));
    $path = checkSlash($path, 'remove');
    return $path;
}

///////////////////////////////
// Set password to your own! //
///////////////////////////////
// Remove $pass to allow saving without password (should be only done in otherwise protected areas)
$pass = mt_rand().rand(); // mt_rand().rand();

// General enabling of this file, can be overriden by $pass
$allowSave = false;

// Please set the Path to /pic/hotspotJS/ folder or any other where you want to save the hotspots
$pathToCropJSON = checkSlash(realpath($_SERVER['DOCUMENT_ROOT']).'/'.installPath().'/pic/cropJSON/', 'add');

// Path for backups of the old file
$pathToCropBackupJSON = checkSlash(realpath($_SERVER['DOCUMENT_ROOT']).'/'.installPath().'/pic/cropJSON/backup', 'add');

// Postfix for backup files
$backUpPostFix = date('Y.m.d_H-i-s');

// Set default for making backup to false
$makeBackUp = false;

// Set backup action depending on $_POST parameter
if (isset($_POST['backup']) && $_POST['backup'] == '1') {
    $makeBackUp = true;
}

// File path
$file = checkSlash($pathToCropJSON.$_POST['fileName'].'.json');
$fileBackUp = checkSlash($pathToCropBackupJSON.$_POST['fileName'].'_'.$backUpPostFix.'.json');

// Messages for working with this file
if (!is_dir($pathToCropJSON)) {
    echo '> Variable $pathToCropJSON - path to cropJSON directory ('.$pathToCropJSON.') is not set correctly. 
	Please open /axZm/saveCropJSON.php and set this variable manually.<br>';
    exit;
}

// Not writeable path
if (!is_writable($pathToCropJSON)) {
    echo '> '.$pathToCropJSON.' is not writeable by PHP. Please change chmod (e.g. 775 or 777).<br>';
    exit;
}

// Password check
if (isset($pass) && isset($_POST['password']) && $_POST['password'] == $pass) {
    $allowSave = true;
}

// Exit if not allowed
if ($allowSave == false) {
    echo '
	> Because of security reasons you can not create or save crop settings to JSON file.<br> 
	> Please open <span style="color: #FFF">"/axZm/saveCropJSON.php"</span> file and set $pass variable to your own password.<br>
	> You can also remove $pass provided you move this tool to an otherwise restricted access area.<br>
	';
    exit;
}

// No filename posted
if (!isset($_POST['fileName'])) {
    echo '> You should define fileName;<br>';
    exit;
}

// No code passed
if (!isset($_POST['jsonCode'])) {
    echo '> You should import/define jsonCode;<br>';
    exit;
}

// File exists but is not writeable
if (file_exists($file) && !is_writable($file)) {
    echo '> File '.$file.' already exists but it is not writeable by PHP.<br> 
	> You might have uploaded it over FTP with different Group settings so PHP can not write to it :-(<br>  
	> Maybe you should remove this file over FTP if you do not need it or change a name of the crop file.<br>
	';
    exit;
}

if ($makeBackUp && file_exists($file)) {
    if (!is_writable($pathToCropBackupJSON)) {
        echo "> Backup file could not be written to ".$pathToCropBackupJSON.' because PHP can not write to this folder.<br>';
    } else {
        copy($file, $fileBackUp);
        if (!file_exists($fileBackUp)) {
            echo "> Backup file could not be written to ".$fileBackUp.'. Who knows why :-(<br>';
        } else {
            echo "> Backup of the overwritten file has been created!<br>";
        }
    }
}

// We do need back slashes, do not use stripslashes
$_POST['jsonCode'] = str_replace(array('\\"', '\\\''), array('"','\''), $_POST['jsonCode']);

// Remove line breaks etc.
if (!(isset($_POST['keepFormat']) && $_POST['keepFormat'] == '1')) {
    $_POST['jsonCode'] = str_replace(array("\r\n", "\n", "\r", "\t"), '', $_POST['jsonCode']);
}

// Write to file (UTF8)
file_put_contents($file, "\xEF\xBB\xBF".$_POST['jsonCode']);

// Results check
if (file_exists($file)) {
    // Chmod it to be accessed over FTP with PHP as different user (uncomment if needed)
    /*
    try {
        chmod($file, 0777);
    } catch (Exception $e) {
        echo 'Exception: ',  $e->getMessage(), "\n";
    }
    */
    
    echo '> File is written! <a style="color: white" href="'.str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', $file.'?nocache='.time()).'" target="_blank">Link</a><br>';
} else {
    echo '> Some error occurred. '.$file.' has not been created :-(<br>';
}
