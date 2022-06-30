<?php
/**
* Plugin: jQuery AJAX-ZOOM, axZmH.class.php
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: https://www.ajax-zoom.com/index.php?cid=download
* Version: 5.4.4
* Date: 2020-04-25
* Review: 2020-07-26
* URL: https://www.ajax-zoom.com
* Documentation: https://www.ajax-zoom.com/index.php?cid=docs
*/


class axZmH
{
    public $axZm;
    public $regexFilename;
    public $regexPath;
    public $fileTypeArray;
    public $jsonData = array();
    private $returnMakeFirstImage;
    private $returnMakeZoomTiles;
    private $returnMakeAllThumbs;
    private $returnCTimeCompare;
    private $fileErrorDialog;
    private $readTime = array();
    private $msgNoteInstr = 'Note: please refer to instruction on how to switch off this dialog. (All popups can be disabled by setting disableAllMsg option to true in zoomConfig.inc.php)';
    private $doctype = array(
        1 => array ('XHTML 1.0 Transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'),
        array ('XHTML 1.0 Strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'),
        array ('XHTML Basic 1.0' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd"><html>'),
        array ('XHTML 1.1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"><html>'),
        array ('XHTML Basic 1.1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd"><html>'),
        array ('HTML 4.01 Transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>'),
        array ('HTML 4.01 Strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html>'),
        array ('HTML 3.2' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Final//EN"><html>'),
        array ('HTML 2.0' => '<!DOCTYPE html PUBLIC "-//IETF//DTD HTML//EN"><html>'),
        array ('None' => '<html>')
    );
    function __construct($axZm)
    {
        $this->axZm = $axZm;
    }
    public function classVer()
    {
        return array(
            'ver' => '5.4.4',
            'date' => '2020-04-25',
            'review' => '2020-07-26'
        );
    }
    public function isValidFilename($filename)
    {
        $regDef = "/^[a-zA-Z\_0-9ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç]+[a-zA-Z\_0-9\-\.\,\(\)\[\]\%ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç\s+]+\.+[a-zA-Z]{3,4}$/";
        if ($this->regexFilename) {
            $regDef = $this->regexFilename;
        }
        if (preg_match($regDef, $filename)) {
            return true;
        } else {
            return false;
        }
    }
    public function isValidPath($path)
    {
        $regDef = "/^[a-zA-Z\_0-9\:\/ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç]+([a-zA-Z\_0-9\:\.\,\(\)\[\]\ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç\-\/\s+]*)$/";
        if ($this->regexPath) {
            $regDef = $this->regexPath;
        }
        if (preg_match($regDef, $path)) {
            return true;
        } else {
            return false;
        }
    }
    public function isValidFileType($filename)
    {
        $fileTypes = array('jpg', 'jpeg', 'tif', 'tiff', 'gif', 'png', 'bmp', 'psd');
        if (is_array($this->fileTypeArray) && !empty($this->fileTypeArray)) {
            $fileTypes = $this->fileTypeArray;
        }
        $ext = $this->getl('.',$filename);
        if (in_array(strtolower($ext), $fileTypes)) {
            return true;
        } else {
            return false;
        }
    }
    final function setRegex($reg, $type)
    {
        if ($type == 'filename') {
            $this->regexFilename = $reg;
            $this->axZm->setRegex($reg, $type);
        } elseif ($type == 'path') {
            $this->regexPath = $reg;
            $this->axZm->setRegex($reg, $type);
        }
    }
    final function start()
    {
        if (defined('PHALANGER') || !defined('AJAXZOOM_CONTROLLER') || (defined('AJAXZOOM_CONTROLLER') && AJAXZOOM_CONTROLLER === 0)) {
            return;
        }
        foreach($_GET as $k => $v) {
            $_GET[$k] = preg_replace('/<[^>]*>[^<]*<[^>]*>/', '', $_GET[$k]);
            $_GET[$k] = filter_var($_GET[$k], FILTER_SANITIZE_STRING);
            if (strstr($_GET[$k], ';>') || stristr($_GET[$k], 'base64_encode') || strstr($_GET[$k], 'GLOBALS') || strstr($_GET[$k], '_REQUEST') || strstr($_GET[$k], '\.')) {
                unset($_GET[$k]);
            }
        }
        foreach($_POST as $k => $v) {
            $_POST[$k] = preg_replace('/<[^>]*>[^<]*<[^>]*>/', '', $_POST[$k]);
            $_POST[$k] = filter_var($_POST[$k], FILTER_SANITIZE_STRING);
            if (strstr($_POST[$k], ';>') || stristr($_POST[$k], 'base64_encode') || strstr($_POST[$k], 'GLOBALS') || strstr($_GET[$k], '_REQUEST') || strstr($_POST[$k], '\.')) {
                unset($_POST[$k]);
            }
        }
    }
    final function sanitizeUrl($url)
    {
        $url = preg_replace('/<[^>]*>[^<]*<[^>]*>/', '', $url);
        $url = filter_var($url, FILTER_SANITIZE_STRING);
        if (strstr($url, ';>') || stristr($url, 'base64_encode') || strstr($url, 'GLOBALS') || strstr($url, '_REQUEST') || strstr($url, '\.')) {
            $url = '';
        }
        return $url;
    }
    final function setFileTypeArray($arr)
    {
        $this->fileTypeArray = $arr;
        $this->axZm->setFileTypeArray($arr);
    }
    public function pngMod($zoom, $file = '', $ext = '')
    {
        return $this->axZm->pngMod($zoom, $file, $ext);
    }
    public function autoSetGalleryThumbCss($zoom, $type)
    {
        if ($type == 'vertical' || $type == 'vert') {
            if (isset($zoom['config']['galleryOpt'])) {
                $zoom['config']['galleryOpt']['thumbLiStyle']['width'] = ($this->getf('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['left'] + $zoom['config']['galleryImgMargin']['right']).'px';
                $zoom['config']['galleryOpt']['thumbLiStyle']['height'] = ($this->getl('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom']).'px';
                $zoom['config']['galleryOpt']['thumbLiStyle']['lineHeight'] = ($this->getl('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom'] - 2).'px';
                $zoom['config']['galleryOpt']['thumbImgStyle']['maxWidth'] = ($this->getf('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['left'] + $zoom['config']['galleryImgMargin']['right']).'px';
                $zoom['config']['galleryOpt']['thumbImgStyle']['maxHeight'] = ($this->getl('x', $zoom['config']['galleryPicDim']) + $zoom['config']['galleryImgMargin']['top'] + $zoom['config']['galleryImgMargin']['bottom']).'px';
            }
        } elseif ($type == 'horizontal' || $type == 'horz') {
            if (isset($zoom['config']['galHorOpt'])) {
                $zoom['config']['galHorOpt']['thumbLiStyle']['width'] = ($this->getf('x', $zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['left'] + $zoom['config']['galHorImgMargin']['right']).'px';
                $zoom['config']['galHorOpt']['thumbLiStyle']['height'] = ($this->getl('x', $zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['top'] + $zoom['config']['galHorImgMargin']['bottom']).'px';
                $zoom['config']['galHorOpt']['thumbLiStyle']['lineHeight'] = ($this->getl('x', $zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['top'] + $zoom['config']['galHorImgMargin']['bottom'] - 2).'px';
                $zoom['config']['galHorOpt']['thumbImgStyle']['maxWidth'] = ($this->getf('x', $zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['left'] + $zoom['config']['galHorImgMargin']['right']).'px';
                $zoom['config']['galHorOpt']['thumbImgStyle']['maxHeight'] = ($this->getl('x', $zoom['config']['galleryHorPicDim']) + $zoom['config']['galHorImgMargin']['top'] + $zoom['config']['galHorImgMargin']['bottom']).'px';
            }
        } elseif ($type == 'inline' || $type == 'full') {
            if (isset($zoom['config']['galFullOpt'])) {
                $zoom['config']['galFullOpt']['thumbLiStyle']['width'] = ($this->getf('x', $zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['left'] + $zoom['config']['galFullImgMargin']['right']).'px';
                $zoom['config']['galFullOpt']['thumbLiStyle']['height'] = ($this->getl('x', $zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['top'] + $zoom['config']['galFullImgMargin']['bottom']).'px';
                $zoom['config']['galFullOpt']['thumbLiStyle']['lineHeight'] = ($this->getl('x', $zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['top'] + $zoom['config']['galFullImgMargin']['bottom'] - 2).'px';
                $zoom['config']['galFullOpt']['thumbImgStyle']['maxWidth'] = ($this->getf('x', $zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['left'] + $zoom['config']['galFullImgMargin']['right']).'px';
                $zoom['config']['galFullOpt']['thumbImgStyle']['maxHeight'] = ($this->getl('x', $zoom['config']['galleryFullPicDim']) + $zoom['config']['galFullImgMargin']['top'] + $zoom['config']['galFullImgMargin']['bottom']).'px';
            }
        }
        return $zoom;
    }
    public function deepExtend($arrDefault, $arrExtend)
    {
        $returnArray = array();
        foreach ($arrDefault as $k => $v) {
            if (isset($arrExtend[$k]) && is_array($arrExtend[$k]) && is_array($v)) {
                $returnArray[$k] = $this->deepExtend($v, $arrExtend[$k]);
            } elseif (isset($arrExtend[$k])) {
                $returnArray[$k] = $arrExtend[$k];
            } else {
                $returnArray[$k] = $v;
            }
        }
        return $returnArray;
    }
    public function getLang()
    {
        $acl = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'en');
        $lang = substr($acl, 0, 2);
        if (strlen($lang) == 2) {
            return strtolower($lang);
        } else {
            return 'en';
        }
    }
    public function langVarFromArray($arr, $lang = 'en')
    {
        if (is_array($arr)) {
            if ($arr[$lang] || is_bool($arr[$lang]) || is_int($arr[$lang])) {
                return $arr[$lang];
            } elseif ($arr['en'] || is_bool($arr['en']) || is_int($arr['en'])) {
                return $arr['en'];
            } else {
                return '';
            }
        } else {
            return $arr;
        }
    }
    public function endTimeDiff($time)
    {
        if (!$time) {
            return 'undefined';
        }
        return sprintf('%.4f', (microtime(true) - $time));
    }
    public function stepPicDim($zoom)
    {
        if (isset($zoom['config']['stepPicDim'])
            && !empty($zoom['config']['stepPicDim'])
            && isset($_GET['respW'])
            && isset($_GET['respH'])
        ) {
            $pW = (int)$_GET['respW'];
            $pH = (int)$_GET['respH'];
            $setW = explode('x', $zoom['config']['picDim']);
            if ($pW > 0 && $pH > 0 && ($pW > (int)$setW[0] || $pH > (int)$setW[0])) {
                $numOp = count($zoom['config']['stepPicDim']);
                $n = 0;
                foreach($zoom['config']['stepPicDim'] as $k => $v) {
                    $n++;
                    if ($n == $numOp || $v['w'] >= $pW || $v['h'] >= $pH) {
                        $zoom['config']['picDim'] = $v['w'].'x'.$v['h'];
                        if ($v['q'] > 30) {
                            $zoom['config']['initPicQual'] = $v['q'];
                        }
                        break;
                    }
                }
            }
        }
        return $zoom;
    }
    public function downloadImage($zoom, $zoomID)
    {
        if (!$zoom['config']['allowDownload']) {
            echo 'Download is not allowed.';
            exit;
        }
        $fileName = '';
        if ($zoom['config']['pic_list_array'][$zoomID]) {
            $fileName = $zoom['config']['pic_list_array'][$zoomID];
        } else {
            $flipedArray = array_flip($zoom['config']['pic_list_array']);
            if ($flipedArray[$zoomID]) {
                $fileName = $zoomID;
            }
        }
        if (!$fileName) {
            echo 'File not found.';
            exit;
        }
        $filePath = $this->checkSlash($zoom['config']['picDir'].'/'.$fileName, 'remove');
        $ext = strtolower($this->getl('.', $filePath));
        $extAllow = array('jpg', 'jpeg', 'jpe', 'tif', 'tiff', 'bmp', 'gif', 'png', 'psd');
        if ($zoom['config']['fileTypeArray']) {
            $extAllow = $zoom['config']['fileTypeArray'];
        }
        if ($this->axZm->fileExists($zoom, $filePath) && in_array($ext, $extAllow)) {
            if (ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'Off');
            }
            if (function_exists('header_remove')) {
                header_remove();
            }
            if ($zoom['config']['downloadRes']) {
                if (isset($_GET['downloadRes']) && is_array($zoom['config']['downloadRes'])) {
                    if (in_array($_GET['downloadRes'], $zoom['config']['downloadRes'])) {
                        $zoom['config']['downloadRes'] = $_GET['downloadRes'];
                    }
                }
                if (!isset($_GET['downloadRes']) && is_array($zoom['config']['downloadRes'])) {
                    $zoom['config']['downloadRes'] = $zoom['config']['downloadRes'][0];
                }
                $dim = explode('x', $zoom['config']['downloadRes']);
                $this->axZm->rawThumb(
                    $zoom,
                    array(
                        'picDir' => dirname($filePath),
                        'imgName' => basename($filePath),
                        'prevWidth' => $dim[0],
                        'prevHeight' => $dim[1],
                        'qual' => ($this->pngMod($zoom, basename($filePath)) == 'png' ? $zoom['config']['downloadQualPng'] : $zoom['config']['downloadQual']),
                        'cache' => $zoom['config']['downloadCache'],
                        'download' => true,
                        'backColor' => $zoom['config']['pngBackgroundColor'],
                        'thumbMode' => false,
                        'enlarge' => false,
                        'pngMode' => null,
                        'pngKeepTransp' => $zoom['config']['pngKeepTransp'],
                        'imKeepProfiles' => $zoom['config']['imKeepProfiles']
                    )
                );
            } else {
                if (!defined('PHALANGER') && $zoom['config']['memory_limit']) {
                    ini_set('memory_limit', $zoom['config']['memory_limit']);
                }
                $len = filesize($filePath);
                $outname = $this->getl('/', $filePath);
                header('Content-Description: File Transfer');
                header('Content-Type: image/'.$ext);
                header('Content-Disposition: attachment; filename="'.$outname.'"');
                header('Content-Transfer-Encoding: binary');
                header('Cache-Control: must-revalidate');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Last-Modified: '.gmdate("D, d M Y H:i:s").' GMT');
                header('Pragma: public');
                header('Content-Length: '.$len);
                readfile($filePath);
            }
        }
    }
    public function allowAjaxQueryCheck($zoom)
    {
        if (!isset($zoom['config']['allowAjaxQuery']) || !isset($zoom['config']['allowAjaxQuery']['basePath'])) {
            return false;
        }
        if ($zoom['config']['allowAjaxQuery']['basePathCheck'] == 'strict') {
            foreach ($zoom['config']['allowAjaxQuery']['basePath'] as $k => $v) {
                if (substr($zoom['config']['pic'], 0, strlen($v)) == $v) {
                    return true;
                }
            }
            return false;
        } else {
            foreach ($zoom['config']['allowAjaxQuery']['basePath'] as $k => $v) {
                if (stristr($zoom['config']['pic'], $v)) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
    public function getFirstImageFromMixedData($zoom, $JSONencode = true)
    {
        $zoomSave = $zoom;
        $return = array();
        $return['image360'] = array();
        $return['imageZoom'] = array();
        $image360array = array();
        if (isset($_GET['zoomMixedData'])) {
            $zoomMixedDataArr = explode('|', $_GET['zoomMixedData']);
            foreach($zoomMixedDataArr as $k => $v) {
                unset($_GET['zoomData'], $_GET['zoomDir']);
                $zoom = $zoomSave;
                $vData = explode('*', $v);
                if ($vData[0] == 'image360') {
                    $_GET['zoomDir'] = $vData[1];
                    $saveZoomDir = $vData[1];
                    unset($_GET['zoomData']);
                    $q = $this->getZoomDir($zoom);
                    $q1 = $this->preProceedList($q[0], $q[1], $q[2], $q[3]);
                    $r = $this->getFirstImageSpin($q1[0], false);
                    if ($r[0] != 'error' && $r[1] && $r[1]['folder']) {
                        $return['image360'][$r[1]['folder']] = $r;
                    } else {
                        $return['error'][$this->getl('/', $saveZoomDir)] = ($r[1] && $r[1] != true) ? $r[1] : '360 spin folder not found';
                    }
                } elseif ($vData[0] == 'imageZoom') {
                    array_push($image360array, $vData[1]);
                }
            }
            if (!empty($image360array)) {
                $zoom = $zoomSave;
                $_GET['zoomData'] = implode('|', $image360array);
                $q = $this->getZoomData($zoom);
                $q1 = $this->preProceedList($q[0], $q[1], $q[2], $q[3]);
                $r = $this->getDataImages($q1[0], false);
                if ($r[0] != 'error') {
                    foreach($r[1] as $k => $v) {
                        $return['imageZoom'][$v['fileName']] = $v;
                    }
                }
            }
            return json_encode($return);
        }
    }
    public function getImages($zoom, $JSONencode = true)
    {
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['images']) {
            if (!empty($zoom['config']['pic_list_data']) && $this->allowAjaxQueryCheck($zoom)) {
                $return = array();
                $returnData = array();
                foreach($zoom['config']['pic_list_data'] as $k => $v) {
                    $returnData[$k]['fileName'] = $v['fileName'];
                    $returnData[$k]['thumbDescr'] = $v['thumbDescr'];
                    $returnData[$k]['fullDescr'] = $v['fullDescr'];
                }
                $return[0] = $zoom['config']['pic'];
                $return[1] = $returnData;
                return $JSONencode ? json_encode($return) : $return;
            } else {
                $returnError = array();
                $returnError[0] = 'error';
                if (empty($zoom['config']['pic_list_data'])) {
                    $returnError[1] = 'There are no images in '.$zoom['config']['pic'];
                } else {
                    $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query images in this folder!';
                }
                return $JSONencode ? json_encode($returnError) : $returnError;
            }
        } else {
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query images this way!';
            return $JSONencode ? json_encode($returnError) : $returnError;
        }
    }
    public function getDataImages($zoom, $JSONencode = true)
    {
        $return = array();
        $returnData = array();
        $n = 0;
        foreach($zoom['config']['pic_list_data'] as $k => $v) {
            $n++;
            $returnData[$n]['picPath'] = $v['picPath'];
            $returnData[$n]['fileName'] = $v['fileName'];
            $returnData[$n]['thumbDescr'] = $v['thumbDescr'];
            $returnData[$n]['fullDescr'] = $v['fullDescr'];
        }
        if (!empty($returnData)) {
            $return[0] = 'ok';
            $return[1] = $returnData;
            return $JSONencode ? json_encode($return) : $return;
        } else {
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'No images found for zoomData parameter passed: '.$zoom['config']['zoomDataPassed'];
            return $JSONencode ? json_encode($returnError) : $returnError;
        }
    }
    public function getFolders($zoom, $JSONencode = true)
    {
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['subFolders']) {
            if ($this->allowAjaxQueryCheck($zoom) && !empty($zoom['config']['subFolderArray'])) {
                $return = array();
                $returnData = array();
                foreach($zoom['config']['subFolderArray'] as $k => $v) {
                    $returnData[$k]['folderName'] = $v;
                }
                $return[0] = $zoom['config']['pic'];
                $return[1] = $returnData;
                return $JSONencode ? json_encode($return) : $return;
            } else {
                $returnError = array();
                $returnError[0] = 'error';
                if (empty($zoom['config']['subFolderArray'])) {
                    $returnError[1] = 'There are no subfolders in: '.$zoom['config']['pic'];
                } else {
                    $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subfolders in this folder!';
                }
                return $JSONencode ? json_encode($returnError) : $returnError;
            }
        } else {
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subdolders this way!';
            return $JSONencode ? json_encode($returnError) : $returnError;
        }
    }
    public function getFirstImagesFromFolders($zoom, $number = 3, $shuffle = false, $JSONencode = true)
    {
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['subFolders']) {
            if ( $zoom['config']['allowAjaxQuery']['maxImageNumber'] && $number > $zoom['config']['allowAjaxQuery']['maxImageNumber']) {
                $number = $zoom['config']['allowAjaxQuery']['maxImageNumber'];
            }
            if ($number == 0) {
                $number = 1;
            }
            if ($this->allowAjaxQueryCheck($zoom) && !empty($zoom['config']['subFolderArray'])) {
                $return = array();
                $returnData = array();
                foreach($zoom['config']['subFolderArray'] as $k => $v) {
                    $qSub = glob($zoom['config']['picDir'].$v.'/*');
                    if (count($qSub > 0)) {
                        $returnData[$k]['folderName'] = $v;
                        $returnData[$k]['images'] = array();
                        $n = 0;
                        if ($shuffle) {
                            shuffle($qSub);
                        }
                        foreach ($qSub as $file) {
                            $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                            if ($this->isValidFileType($thisFile)) {
                                $n++;
                                if ($n > $number) {
                                    break;
                                }
                                array_push($returnData[$k]['images'], $thisFile);
                            }
                        }
                    }
                }
                $return[0] = $zoom['config']['pic'];
                $return[1] = $returnData;
                return $JSONencode ? json_encode($return) : $return;
            } else {
                $returnError = array();
                $returnError[0] = 'error';
                if (empty($zoom['config']['subFolderArray'])) {
                    $returnError[1] = 'There are no subfolders in: '.$zoom['config']['pic'];
                } else {
                    $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subfolders in this folder!';
                }
                return $JSONencode ? json_encode($returnError) : $returnError;
            }
        } else {
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subdolders this way!';
            return $JSONencode ? json_encode($returnError) : $returnError;
        }
    }
    public function returnFirstImageSpin($zoom, $dir)
    {
        $_GET['zoomDir'] = $dir;
        $_GET['qq'] = 1;
        $getZoomDirReturn = $this->getZoomDir($zoom);
        $zoom = $getZoomDirReturn[0];
        $pic_list_array = $getZoomDirReturn[1];
        $pic_list_data = $getZoomDirReturn[2];
        $zoomTmp = $getZoomDirReturn[3];
        $preProceedListReturn = $this->preProceedList($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
        $zoom = $preProceedListReturn[0];
        $pic_list_array = $preProceedListReturn[1];
        $pic_list_data = $preProceedListReturn[2];
        $zoomTmp = $preProceedListReturn[3];
        $data = $this->getFirstImageSpin($zoom, false);
        if (is_array($data) && is_array($data[1]) && !empty($data[1])) {
            $_GET['previewPic'] = $data[1]['fileName'];
        } else {
            $_GET['previewPic'] = 'missingImage.jpg';
        }
        $_GET['previewDir'] = $data[0];
        $this->rawThumbLoad($zoom);
    }
    public function getFirstImageSpin($zoom, $JSONencode = true)
    {
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['images']) {
            if ($this->allowAjaxQueryCheck($zoom)) {
                $return = array();
                $return[1] = array();
                if (isset($_GET['frame'])) {
                    $_GET['frame'] = (int)$_GET['frame'];
                }
                if (empty($zoom['config']['subFolderArray'])) {
                    $return[0] = $zoom['config']['pic'];
                    if (isset($zoom['config']['pic_list_data'][1])) {
                        $return[1]['frames'] = count($zoom['config']['pic_list_data']);
                        $return[1]['path'] = $zoom['config']['pic'];
                        $return[1]['folder'] = $this->getl('/', $this->checkSlash($zoom['config']['pic'], 'remove'));
                        $return[1]['type'] = '360';
                        if (isset($_GET['randFrame'])) {
                            $return[1]['fileName'] = $zoom['config']['pic_list_data'][rand(1, $return[1]['frames'])]['fileName'];
                        } elseif (isset($_GET['frame']) && $zoom['config']['pic_list_data'][$_GET['frame']]) {
                            $return[1]['fileName'] = $zoom['config']['pic_list_data'][$_GET['frame']]['fileName'];
                        } else {
                            $return[1]['fileName'] = $zoom['config']['pic_list_data'][1]['fileName'];
                        }
                    }
                } else {
                    $midFolder = ceil(count($zoom['config']['subFolderArray'])/2);
                    $return[0] = $zoom['config']['pic'].$zoom['config']['subFolderArray'][$midFolder];
                    $qSub = glob($zoom['config']['picDir'].$zoom['config']['subFolderArray'][$midFolder].'/*');
                    $subImg = array();
                    foreach ($qSub as $file) {
                        $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                        if ($this->isValidFileType($thisFile)) {
                            array_push($subImg, $thisFile);
                        }
                    }
                    $countSubImg = count($subImg);
                    $return[1]['rows'] = count($zoom['config']['subFolderArray']);
                    $return[1]['frames'] = $countSubImg * $return[1]['rows'];
                    $return[1]['framesRow'] = $countSubImg;
                    $return[1]['path'] = $zoom['config']['pic'];
                    $return[1]['folder'] = $this->getl('/', $this->checkSlash($zoom['config']['pic'], 'remove'));
                    $return[1]['type'] = '3D';
                    if ($countSubImg != 0) {
                        if (isset($_GET['randFrame'])) {
                            $return[1]['fileName'] = $subImg[rand(0, $countSubImg - 1)];
                        } elseif (isset($_GET['frame']) && $subImg[(int)$_GET['frame'] - 1]) {
                            $return[1]['fileName'] = $subImg[(int)$_GET['frame'] - 1];
                        } else {
                            $return[1]['fileName'] = $subImg[0];
                        }
                    }
                }
                if (!isset($return[1]['fileName']) || !$return[1]['fileName']) {
                    $return[1] = false;
                }
                return $JSONencode ? json_encode($return) : $return;
            } else {
                $returnError = array();
                $returnError[0] = 'error';
                $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query first image of the spin!';
                return $JSONencode ? json_encode($returnError) : $returnError;
            }
        } else {
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query first image of the spin this way!';
            return $JSONencode ? json_encode($returnError) : $returnError;
        }
    }
    public function getFirstImageSpinFolder($zoom, $JSONencode = true)
    {
        $subFolders = $this->getFolders($zoom, false);
        if ($subFolders[0] != 'error') {
            $pic = $zoom['config']['pic'];
            $picDir = $zoom['config']['picDir'];
            $return = array();
            $m = 0;
            foreach ($subFolders[1] as $k => $v) {
                $zoom['config']['pic'] = $pic.$v['folderName'].'/';
                $zoom['config']['picDir'] = $picDir.$v['folderName'].'/';
                $n = 0;
                $zoom['config']['pic_list_data'] = array();
                $zoom['config']['subFolderArray'] = array();
                foreach (glob($this->checkSlash($zoom['config']['picDir'], 'add').'*', GLOB_ONLYDIR) as $folder) {
                    $n++;
                    $zoom['config']['subFolderArray'][$n] = $this->getl('/', $folder);
                }
                $n = 0;
                foreach (glob($this->checkSlash($zoom['config']['picDir'], 'add').'*') as $file) {
                    $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                    if ($this->isValidFileType($thisFile)) {
                        $n++;
                        $zoom['config']['pic_list_data'][$n]['fileName'] = $thisFile;
                    }
                }
                $m++;
                $return[$m] = $this->getFirstImageSpin($zoom, false);
            }
            return $JSONencode ? json_encode($return) : $return;
        } else {
            return $JSONencode ? json_encode($subFolders) : $subFolders;
        }
    }
    public function testCSV($string, $sep, $type)
    {
        $array = explode($sep, $string);
        $output = array();
        if ($type == 'int') {
            foreach ($array as $k => $v) {
                $output[$k] = (int)$v;
            }
        }
        if (!empty($output)) {
            return implode($sep, $output);
        } else {
            return false;
        }
    }
    public function removeScriptTags($string)
    {
        return strip_tags($string, '<ul><ol><li><br><div><span><table><tr><td><th><h1><h2><h3><h4><img>');
    }
    public function installPath($fpPP = '')
    {
        if (!$fpPP) {
            $fpPP = realpath($_SERVER['DOCUMENT_ROOT']);
        }
        $path = dirname(str_replace('//', '/', str_replace(str_replace('\\', '/', $fpPP), '/', str_replace('\\', '/', dirname(realpath(__FILE__))))));
        $path = $this->checkSlash($path, 'remove');
        return $path;
    }
    public function uncompress($zoom, $data, $noArray = false)
    {
        $r = @unserialize(@gzuncompress(stripslashes(base64_decode(strtr($data, '-_,', '+/=')))));
        if ($data && !$noArray && (!is_array($r) || empty($r))) {
            $r = array();
            $arr = explode('|', $data);
            if (is_array($arr) && !empty($arr)) {
                foreach($arr as $k => $v) {
                    if ($v) {
                        $b = parse_url($v);
                        if (isset($b['path']) && $b['path']) {
                            $i = pathinfo($b['path']);
                            if (isset($i['dirname']) && $i['dirname']) {
                                $r[$k + 1]['p'] = $this->rewriteBase($zoom, $this->checkSlash($i['dirname'], 'add'));
                                if (isset($i['basename'])) {
                                    $r[$k + 1]['f'] = $i['basename'];
                                } else {
                                    $r[$k + 1]['f'] = '';
                                }
                            }
                        }
                    }
                }
            }
        } elseif ($data && !$noArray && is_array($r) && !is_array(array_shift(array_values($r)))) {
            $newArr = array();
            if (!empty($r)) {
                foreach($r as $k => $v) {
                    if ($v) {
                        $b = parse_url($v);
                        if (isset($b['path']) && $b['path']) {
                            $i = pathinfo($b['path']);
                            if (isset($i['dirname']) && $i['dirname']) {
                                $newArr[$k]['p'] = $this->rewriteBase($zoom, $this->checkSlash($i['dirname'], 'add'));
                                if (isset($i['basename'])) {
                                    $newArr[$k]['f'] = $i['basename'];
                                } else {
                                    $newArr[$k]['f'] = '';
                                }
                            }
                        }
                    }
                }
            }
            return $newArr;
        }
        return $r;
    }
    public function compress($data)
    {
        return strtr(base64_encode(addslashes(gzcompress(serialize($data),9))), '+/=', '-_,');
    }
    public function setDoctype($key = false)
    {
        if (array_key_exists($key, $this->doctype)) {
            $doc = array_values($this->doctype[$key]);
        } else {
            $doc = array_values($this->doctype[7]);
        }
        $docc = explode('<html',$doc[0]);
        $doc[0] = $docc[0]."\r\n".'<html'.$docc[1];
        return $doc[0];
    }
    public function tileExists($zoom, $fileName, $r = false)
    {
        return $this->axZm->tileExists($zoom, $fileName, $r);
    }
    public function getTileSize($zoom, $fileName)
    {
        $tilePath = $zoom['config']['pyrTilesDir']
        .$this->md5path($fileName, $zoom['config']['subfolderStructure'])
        .$this->getf('.', $fileName).'/0-0-0.'.$this->pngMod($zoom, $fileName);
        if ($this->axZm->fileExists($zoom, $tilePath)) {
            $thisTileSize = $this->axZm->imageSize($tilePath, $zoom['config']['im'], false);
            if (is_array($thisTileSize)) {
                $a = (int)(max($thisTileSize[0], $thisTileSize[1]));
                $o = isset($zoom['config']['tileOverlap']) ? $zoom['config']['tileOverlap']: 0;
                if ($o) {
                    return $a - $o;
                } else {
                    return $a;
                }
            }
        }
        return $zoom['config']['tileSize'];
    }
    public function checkConfig($zoom)
    {
        $zoom['config']['picX'] = (int)$this->getf('x', $zoom['config']['picDim']);
        $zoom['config']['picY'] = (int)$this->getl('x', $zoom['config']['picDim']);
        $zoom['config']['galPicX'] = (int)$this->getf('x', $zoom['config']['galleryPicDim']);
        $zoom['config']['galPicY'] = (int)$this->getl('x', $zoom['config']['galleryPicDim']);
        $zoom['config']['galFullPicX'] = (int)$this->getf('x', $zoom['config']['galleryFullPicDim']);
        $zoom['config']['galFullPicY'] = (int)$this->getl('x', $zoom['config']['galleryFullPicDim']);
        $zoom['config']['galHorPicX'] = (int)$this->getf('x', $zoom['config']['galleryHorPicDim']);
        $zoom['config']['galHorPicY'] = (int)$this->getl('x', $zoom['config']['galleryHorPicDim']);
        if (isset($_GET['buttonSet'])) {
            $zoom['config']['buttonSet'] = $_GET['buttonSet'];
        }
        foreach ($zoom['config']['icons'] as $k => $v) {
            if (is_array($zoom['config']['icons'][$k]) && isset($zoom['config']['icons'][$k]['file'])) {
                $zoom['config']['icons'][$k]['file'] = $zoom['config']['buttonSet'].'/'.$v['file'];
                $widthValue = $zoom['config']['icons'][$k]['w'];
                $heightValue = $zoom['config']['icons'][$k]['h'];
                if (isset($zoom['config']['icons'][$k]['ext'])) {
                    $extValue = $zoom['config']['icons'][$k]['ext'];
                } else {
                    $extValue = false;
                }
                if (is_string($widthValue) && strpos($widthValue, '}')) {
                    $widthValue = str_replace(array('{', '}'), '', $widthValue);
                    if (isset($zoom['config']['icons'][$widthValue])) {
                        $zoom['config']['icons'][$k]['w'] = $zoom['config']['icons'][$widthValue];
                    }
                }
                if (is_string($heightValue) && strpos($heightValue, '}')) {
                    $heightValue = str_replace(array('{', '}'), '', $heightValue);
                    if (isset($zoom['config']['icons'][$heightValue])) {
                        $zoom['config']['icons'][$k]['h'] = $zoom['config']['icons'][$heightValue];
                    }
                }
                if (is_string($extValue) && strpos($extValue, '}')) {
                    $extValue = str_replace(array('{', '}'), '', $extValue);
                    if (isset($zoom['config']['icons'][$extValue])) {
                        $zoom['config']['icons'][$k]['ext'] = $zoom['config']['icons'][$extValue];
                    }
                }
            }
        }
        if (!isset($zoom['config']['subfolderStructureMigrate'])) {
            $zoom['config']['subfolderStructureMigrate'] = false;
        }
        if ($zoom['config']['useGallery'] && $zoom['config']['useHorGallery']) {
            $zoom['config']['useHorGallery'] = false;
        }
        if ($zoom['config']['fullScreenVertGallery'] && $zoom['config']['fullScreenHorzGallery']) {
            $zoom['config']['fullScreenHorzGallery'] = false;
        }
        if ($zoom['config']['spinMod'] && !(isset($_GET['3dDir']) || isset($_GET['360Data']))) {
            $zoom['config']['spinMod'] = false;
        } elseif ((isset($_GET['3dDir']) || isset($_GET['360Data']))
            && (strlen($_GET['3dDir']) || strlen($_GET['360Data']))
            && !$zoom['config']['spinMod']
        ) {
            $zoom['config']['spinMod'] = true;
            $zoom['config']['galleryNoThumbs'] = true;
            $zoom['config']['galFullButton'] = false;
            $zoom['config']['firstMod'] = 'spin';
        }
        if (!empty($zoom['config']['touchSettings'])
            && preg_match('/(android|blackberry|iphone|ipad|ipaq|ipod|smartphone|symbian|iemobile)/i', $_SERVER['HTTP_USER_AGENT'])
        ) {
            $zoom['config'] = $this->deepExtend($zoom['config'], $zoom['config']['touchSettings']);
        }
        if ($zoom['config']['useGallery']
            || $zoom['config']['useHorGallery']
            || $zoom['config']['fullScreenVertGallery']
            || $zoom['config']['fullScreenHorzGallery']
        ) {
            $zoom['config']['keepBoxW'] = true;
            $zoom['config']['keepBoxH'] = true;
        }
        if ($zoom['config']['speedOptSet'] || isset($_GET['speedOptSet'])) {
            $zoom['config']['zoomMapSwitchSpeed'] = 0;
            $zoom['config']['restoreSpeed'] = 0;
            $zoom['config']['pyrTilesFadeInSpeed'] = min(200, (int)$zoom['config']['pyrTilesFadeInSpeed']);
            $zoom['config']['pyrTilesFadeLoad'] = min(200, (int)$zoom['config']['pyrTilesFadeLoad']);
            $zoom['config']['galleryFadeOutSpeed'] = 0;
            $zoom['config']['galleryFadeInSpeed'] = 100;
            $zoom['config']['galleryInnerFade'] = 100;
            $zoom['config']['galleryInnerFadeCut'] = 100;
            $zoom['config']['galleryFadeInSize'] = 1;
            $zoom['config']['zoomFadeIn'] = 100;
            $zoom['config']['gallerySlideSwipeSpeed'] = 400;
        } elseif ((isset($zoom['config']['speedOptSetExc'])&& $zoom['config']['speedOptSetExc'])
            || isset($_GET['speedOptSetExc'])
        ) {
            $zoom['config']['zoomMapSwitchSpeed'] = 0;
            $zoom['config']['pyrTilesFadeInSpeed'] = min(200, (int)$zoom['config']['pyrTilesFadeInSpeed']);
            $zoom['config']['pyrTilesFadeLoad'] = min(200, (int)$zoom['config']['pyrTilesFadeLoad']);
            $zoom['config']['galleryFadeOutSpeed'] = 0;
            $zoom['config']['galleryFadeInSpeed'] = 100;
            $zoom['config']['galleryInnerFade'] = 100;
            $zoom['config']['galleryInnerFadeCut'] = 100;
            $zoom['config']['galleryFadeInSize'] = 1;
            $zoom['config']['zoomFadeIn'] = 100;
            $zoom['config']['gallerySlideSwipeSpeed'] = 400;
        }
        $this->setRegex($zoom['config']['regexFilename'], 'filename');
        $this->setRegex($zoom['config']['regexPath'], 'path');
        $this->setFileTypeArray($zoom['config']['fileTypeArray']);
        $startLic = microtime(true);
        $licFile = $this->checkSlash(dirname(dirname(__FILE__)).'/lic.php', 'remove');
        if ($this->axZm->fileExists($zoom, $licFile)) {
            include_once $licFile;
            error_reporting(0);
        }
        $this->readTime['lic'] = $this->endTimeDiff($startLic);
        foreach ($zoom['config']['mapButTitle'] as $k => $v) {
            $zoom['config']['mapButTitle'][$k] = $this->langVarFromArray($v, $zoom['config']['lang']);
        }
        $arrSpinPreloaderVar = array('text', 'L1', 'L2', 'L3', 'L4', 'L5');
        foreach ($arrSpinPreloaderVar as $v) {
            $zoom['config']['spinPreloaderSettings'][$v] = $this->langVarFromArray($zoom['config']['spinPreloaderSettings'][$v], $zoom['config']['lang']);
            $zoom['config']['spinCirclePreloader'][$v] = $this->langVarFromArray($zoom['config']['spinCirclePreloader'][$v], $zoom['config']['lang']);
        }
        if (isset($zoom['config']['mouseScrollMsg']) && isset($zoom['config']['mouseScrollMsg']['txt'])) {
            $zoom['config']['mouseScrollMsg']['txt'] = $this->langVarFromArray($zoom['config']['mouseScrollMsg']['txt'], $zoom['config']['lang']);
        }
        $arrFirstLevelVars = array('zoomLogLevel', 'zoomLogTime', 'zoomLogTraffic', 'zoomLogSeconds', 'zoomLogLoading', 'fullScreenExitText');
        foreach ($arrFirstLevelVars as $v) {
            if (isset($zoom['config'][$v])) {
                $zoom['config'][$v] = $this->langVarFromArray($zoom['config'][$v], $zoom['config']['lang']);
            }
        }
        $zoom['config']['dragToSpin']['file'] = $this->langVarFromArray($zoom['config']['dragToSpin']['file'], $zoom['config']['lang']);
        if (isset($zoom['config']['dragToSpin']['txt'])) {
            $zoom['config']['dragToSpin']['txt'] = $this->langVarFromArray($zoom['config']['dragToSpin']['txt'], $zoom['config']['lang']);
        }
        $zoom['config']['spinNoInit']['file'] = $this->langVarFromArray($zoom['config']['spinNoInit']['file'], $zoom['config']['lang']);
        if (isset($zoom['config']['spinNoInit']['txt'])) {
            $zoom['config']['spinNoInit']['txt'] = $this->langVarFromArray($zoom['config']['spinNoInit']['txt'], $zoom['config']['lang']);
        }
        if ($zoom['config']['useGallery'] || $zoom['config']['fullScreenVertGallery']) {
            if (isset($zoom['config']['galleryLines']) && $zoom['config']['galleryLines'] > 1 && isset($zoom['config']['galleryOpt'])) {
                $zoom['config']['galleryOpt']['multicolumn'] = true;
            }
        }
        if ($zoom['config']['galHorHeight'] == 'auto') {
            $marginSet = intval($zoom['config']['galHorOpt']['thumbLiStyle']['marginTop'] + $zoom['config']['galHorOpt']['thumbLiStyle']['marginBottom']);
            $borderWidth = intval($zoom['config']['galHorOpt']['thumbLiStyle']['borderWidth']) * 2;
            $zoom['config']['galHorHeight'] =
            + $zoom['config']['galHorPadding']['top']
            + $zoom['config']['galHorPadding']['bottom']
            + $zoom['config']['galHorOpt']['thumbLiStyle']['height']
            + (($marginSet > 0) ? ($marginSet + $borderWidth) : 10)             ;
        }
        if ($zoom['config']['galleryWidth'] == 'auto') {
            $zoom['config']['galleryWidth'] = intval($zoom['config']['galleryOpt']['thumbLiStyle']['width']);
            $zoom['config']['galleryWidth'] += intval($zoom['config']['galleryOpt']['thumbLiStyle']['marginLeft']) * 2;
            $zoom['config']['galleryWidth'] += intval($zoom['config']['galleryOpt']['thumbLiStyle']['borderWidth']) * 2;
            $zoom['config']['galleryWidth'] = $zoom['config']['galleryWidth'] * $zoom['config']['galleryLines'];
            $zoom['config']['galleryWidth'] += intval($zoom['config']['galleryOpt']['wrapStyle']['paddingLeft']);
            if ($zoom['config']['galleryOpt']['scrollbar']) {
                $zoom['config']['galleryWidth'] += 18;
            }
            if (isset($zoom['config']['galleryWidthAdjust'])) {
                $zoom['config']['galleryWidth'] += intval($zoom['config']['galleryWidthAdjust']);
            }
        }
        if (isset($_GET['pngMode'])) {
            if ($_GET['pngMode'] == 'true' || $_GET['pngMode'] == '1' || $_GET['pngMode'] == 'yes') {
                $zoom['config']['pngMode'] = true;
                $zoom['config']['pngKeepTransp'] = true;
            } elseif ($_GET['pngMode'] == 'auto') {
                $zoom['config']['pngMode'] = 'auto';
                $zoom['config']['pngKeepTransp'] = true;
            } elseif ($_GET['pngMode'] == 'false' || $_GET['pngMode'] == '0' || $_GET['pngMode'] == 'no') {
                $zoom['config']['pngMode'] = false;
            }
        }
        if (isset($_GET['themeCss']) && $_GET['themeCss'] && $_GET['themeCss'] != 'false' && $_GET['themeCss'] != 'null' && $_GET['themeCss'] != '0') {
            $zoom['config']['themeCss'] = $_GET['themeCss'];
        } elseif (isset($_GET['themeCss'])) {
            $zoom['config']['themeCss'] = '';
        }
        if ($zoom['config']['visualConf']) {
            $zoom['config']['jsonInfo'] = false;
        }
        return $this->axZm->checkConfig($zoom);
    }
    public function cTimeCompare($zoom)
    {
        $startTime = microtime(true);
        $this->readTime['cTimeFiles'] = array();
        foreach ($zoom['config']['pic_list_data'] as $num => $v) {
            $smallImg = $zoom['config']['thumbDir'].$this->md5path($zoom['config']['pic_list_array'][$num], $zoom['config']['subfolderStructure']).$this->composeFileName($zoom['config']['pic_list_array'][$num], $zoom['config']['picDim'], '_', $this->pngMod($zoom, $zoom['config']['pic_list_array'][$num]));
            $tileImg = $zoom['config']['pyrTilesDir'].$this->md5path($zoom['config']['pic_list_array'][$num], $zoom['config']['subfolderStructure']).$this->getf('.',$zoom['config']['pic_list_array'][$num]).'/0-0-0.'.$this->pngMod($zoom, $zoom['config']['pic_list_array'][$num]);
            if (isset($v['path'])) {
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$v['path'], 'add'), 'add');
            }
            if ($this->axZm->fileExists($zoom, $smallImg) && $this->axZm->fileExists($zoom, $zoom['config']['picDir'].$zoom['config']['pic_list_array'][$num])) {
                if ($zoom['config']['cTimeCompare'] == 'filemtime') {
                    $smallImgTime = filemtime($smallImg);
                    $tileImgTime = filemtime($tileImg);
                    $orgImageTime = filemtime($zoom['config']['picDir'].$zoom['config']['pic_list_array'][$num]);
                } else {
                    $smallImgTime = filectime($smallImg);
                    $tileImgTime = filectime($tileImg);
                    $orgImageTime = filectime($zoom['config']['picDir'].$zoom['config']['pic_list_array'][$num]);
                }
                if ($orgImageTime > $smallImgTime || ($this->axZm->fileExists($zoom, $tileImg) && $orgImageTime > $tileImgTime)) {
                    if (!$this->returnCTimeCompare) {
                        $this->returnCTimeCompare = array();
                    }
                    array_push($this->returnCTimeCompare, $zoom['config']['pic_list_array'][$num]);
                    array_push($this->readTime['cTimeFiles'], $zoom['config']['pic_list_array'][$num]);
                    $this->removeAxZm($zoom, $zoom['config']['pic_list_array'][$num], array('In' => true, 'Th' => true, 'tC' => true, 'mO' => true, 'Ti' => true, 'gP' => true), false);
                }
            }
        }
        $this->readTime['cTimeCompare'] = $this->endTimeDiff($startTime);
    }
    public function rotateImage($filename, $angle)
    {
        $fType = strtolower($this->getl('.', $filename));
        if (!($fType == 'jpg' || $fType == 'jpeg')) {
            return readfile($filename);
        }
        $src_img = imagecreatefromjpeg($filename);
        if (function_exists('imagerotate')) {
            return imagerotate($src_img, $angle, 0);
        } else {
            $src_x = imagesx($src_img);
            $src_y = imagesy($src_img);
            if ($angle == 180) {
                $dest_x = $src_x;
                $dest_y = $src_y;
            } elseif ($src_x <= $src_y) {
                $dest_x = $src_y;
                $dest_y = $src_x;
            } elseif ($src_x >= $src_y) {
                $dest_x = $src_y;
                $dest_y = $src_x;
            }
            $rotate = imagecreatetruecolor($dest_x, $dest_y);
            imagealphablending($rotate, false);
            switch ($angle) {
                case 270:
                    for ($y = 0; $y < ($src_y); $y++) {
                        for ($x = 0; $x < ($src_x); $x++) {
                            $color = imagecolorat($src_img, $x, $y);
                            imagesetpixel($rotate, $dest_x - $y - 1, $x, $color);
                        }
                    }
                    break;
                case 90:
                    for ($y = 0; $y < ($src_y); $y++) {
                        for ($x = 0; $x < ($src_x); $x++) {
                            $color = imagecolorat($src_img, $x, $y);
                            imagesetpixel($rotate, $y, $dest_y - $x - 1, $color);
                        }
                    }
                    break;
                case 180:
                    for ($y = 0; $y < ($src_y); $y++) {
                        for ($x = 0; $x < ($src_x); $x++) {
                            $color = imagecolorat($src_img, $x, $y);
                            imagesetpixel($rotate, $dest_x - $x - 1, $dest_y - $y - 1, $color);
                        }
                    }
                    break;
                default: $rotate = $src_img;
            }
            return $rotate;
        }
    }
    public function exifOrientation($input_file, $output_file)
    {
        $data = new PelDataWindow(file_get_contents($input_file));
        if (PelJpeg::isValid($data)) {
            $jpeg = new PelJpeg();
            $jpeg->load($data);
            if ($jpeg != null) {
                $exif = $jpeg->getExif();
                if ($exif != null) {
                    $tiff = $exif->getTiff();
                    if ($tiff != null) {
                        $ifd0 = $tiff->getIfd();
                        if ($ifd0 != null) {
                            $orientation = $ifd0->getEntry(PelTag::ORIENTATION);
                            $orientation->setValue(0);
                            $sEXIF_description = 'Picture rotated automatically.';
                            $description = $ifd0->getEntry(PelTag::IMAGE_DESCRIPTION);
                            if ($description == null) {
                                $description = new PelEntryAscii(PelTag::IMAGE_DESCRIPTION, $sEXIF_description);
                                $ifd0->addEntry($description);
                            } else {
                                $sEXIF_description_old = $description->getValue();
                                $description->setValue($sEXIF_description);
                            }
                            file_put_contents($output_file, $jpeg->getBytes());
                        }
                    }
                }
            }
        }
    }
    public function rawThumbLoad($zoom)
    {
        $startTime = microtime(true);
        $zoomTmp = array();
        if (!isset($zoom['config']['allowDynamicThumbsMaxSize'])) {
            $zoom['config']['allowDynamicThumbsMaxSize'] = 120;
        }
        if (isset($_GET['azImg']) && !isset($_GET['previewPic']) && !isset($_GET['previewDir'])) {
            $_GET['previewPic'] = $this->getl('/', $_GET['azImg']);
            $_GET['previewDir'] = $this->rewriteBase($zoom, $this->getf('/', $_GET['azImg']));
        }
        if (!isset($_GET['width'])) {
            $_GET['width'] = 100;
        }
        if (!isset($_GET['height'])) {
            $_GET['height'] = 100;
        }
        if ($_GET['width'] > $zoom['config']['allowDynamicThumbsMaxSize']) {
            $_GET['width'] = $zoom['config']['allowDynamicThumbsMaxSize'];
        }
        if ($_GET['height'] > $zoom['config']['allowDynamicThumbsMaxSize']) {
            $_GET['height'] = $zoom['config']['allowDynamicThumbsMaxSize'];
        }
        if (!isset($zoom['config']['dynamicThumbsQualRange'])) {
            $zoom['config']['dynamicThumbsQualRange'] = array(50, 85);
        }
        if (!isset($zoom['config']['dynamicThumbsQual'])) {
            $zoom['config']['dynamicThumbsQual'] = 85;
        }
        if (!isset($_GET['qual'])) {
            $_GET['qual'] = $zoom['config']['dynamicThumbsQual'];
        } else {
            $_GET['qual'] = (int)$_GET['qual'];
        }
        if ($_GET['qual'] < $zoom['config']['dynamicThumbsQualRange'][0]) {
            $_GET['qual'] = $zoom['config']['dynamicThumbsQualRange'][0];
        }
        if ($_GET['qual'] > $zoom['config']['dynamicThumbsQualRange'][1]) {
            $_GET['qual'] = $zoom['config']['dynamicThumbsQualRange'][1];
        }
        if (isset($zoom['config']['dynamicThumbsSizesLimit']) && !empty($zoom['config']['dynamicThumbsSizesLimit'])) {
            $tmpArr = array('w' => $_GET['width'], 'h' => $_GET['height'], 'q' => $_GET['qual']);
            $tmpMatch = false;
            foreach ($zoom['config']['dynamicThumbsSizesLimit'] as $k => $v) {
                if ($v == $tmpArr) {
                    $tmpMatch = true;
                    $zoom['config']['dynamicThumbsQualRange'] = array($v['q'], $v['q']);
                    break;
                }
            }
            if (!$tmpMatch) {
                foreach ($zoom['config']['dynamicThumbsSizesLimit'] as $k => $v) {
                    if ($v['w'] == $tmpArr['w'] && $v['h'] == $tmpArr['h']) {
                        $_GET['qual'] = $v['q'];
                        $zoom['config']['dynamicThumbsQualRange'] = array($v['q'], $v['q']);
                        $tmpMatch = true;
                        break;
                    }
                }
            }
            if (!$tmpMatch) {
                $tmpArr = $zoom['config']['dynamicThumbsSizesLimit'][0];
                $zoom['config']['dynamicThumbsQualRange'] = array($v['q'], $v['q']);
                $_GET['width'] = $tmpArr['w'];
                $_GET['height'] = $tmpArr['h'];
                $_GET['qual'] = $tmpArr['q'];
            }
        }
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {
            $httpRef = explode('?', $_SERVER['HTTP_REFERER']);
            $zoomTmp['fromPath'] = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift($httpRef));
            if ($zoomTmp['fromPath'] && substr($_GET['previewDir'], 0, 3) == '../') {
                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['previewDir'], 2), 'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['previewDir'], 2), 'add'), 'add'))) {
                    unset($zoomTmp['zoomDirInfo']);
                }
            }
            if (isset($zoomTmp['zoomDirInfo']) && $zoomTmp['zoomDirInfo']) {
                $_GET['previewDir'] = $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add');
            }
        }
        $_GET['previewDir'] = str_replace('\\', '/', $_GET['previewDir']);
        $_GET['previewDir'] = $this->checkFpPPdata($_GET['previewDir'], $zoom['config']['fpPP']);
        $_GET['previewDir'] = $this->rewriteBase($zoom, $_GET['previewDir']);
        $path = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['installPath'].'/'.$_GET['previewDir'], 'add');
        if (!is_dir($path)) {
            $path = $this->checkSlash($zoom['config']['fpPP'].'/'.$_GET['previewDir'], 'add');
        }
        $enlarge = false;
        if (
            isset($_GET['enlarge'])
            && $_GET['enlarge'] != 'false'
            && $_GET['enlarge'] != 'no'
            && $_GET['enlarge'] != 'undefined'
        ) {
            $enlarge = true;
        }
        $crop = false;
        if ($zoom['config']['dynamicThumbsAllowCrop']
            && isset($_GET['x1'])
            && isset($_GET['y1'])
            && isset($_GET['x2'])
            && isset($_GET['y2'])
        ) {
            $crop = array(
                'x1' => $_GET['x1'],
                'y1' => $_GET['y1'],
                'x2' => $_GET['x2'],
                'y2' => $_GET['y2']
            );
            if (!isset($zoom['config']['dynamicThumbsCropMaxSize'])) {
                $zoom['config']['dynamicThumbsCropMaxSize'] = 120;
            }
            if ($_GET['width'] > $zoom['config']['dynamicThumbsCropMaxSize']) {
                $_GET['width'] = $zoom['config']['dynamicThumbsCropMaxSize'];
            }
            if ($_GET['height'] > $zoom['config']['dynamicThumbsCropMaxSize']) {
                $_GET['height'] = $zoom['config']['dynamicThumbsCropMaxSize'];
            }
        }
        $cache = $zoom['config']['dynamicThumbsCache'];
        if ($zoom['config']['dynamicThumbsCacheByGET'] && isset($_GET['cache'])) {
            if ($_GET['cache'] == 'false' || $_GET['cache'] == 'no' || $_GET['cache'] == 'undefined') {
                $cache = false;
            } else {
                $cache = true;
            }
        }
        $pngMode = null;
        if (isset($_GET['pngMode'])) {
            if ($_GET['pngMode'] == 'true' || $_GET['pngMode'] == '1' || $_GET['pngMode'] == 'yes') {
                $pngMode = true;
            } elseif ($_GET['pngMode'] == 'auto') {
                $pngMode = 'auto';
            } elseif ($_GET['pngMode'] == 'false' || $_GET['pngMode'] == '0' || $_GET['pngMode'] == 'no') {
                $pngMode = false;
            }
        }
        $pngKeepTransp = null;
        if (isset($_GET['pngKeepTransp'])) {
            if ($_GET['pngKeepTransp'] == 'true' || $_GET['pngKeepTransp'] == '1' || $_GET['pngKeepTransp'] == 'yes') {
                $pngKeepTransp = true;
            } elseif ($_GET['pngKeepTransp'] == 'false' || $_GET['pngKeepTransp'] == '0' || $_GET['pngKeepTransp'] == 'no') {
                $pngKeepTransp = false;
            }
        }
        $imKeepProfiles = null;
        if (isset($_GET['imKeepProfiles'])) {
            if ($_GET['imKeepProfiles'] == 'true' || $_GET['imKeepProfiles'] == '1' || $_GET['imKeepProfiles'] == 'yes') {
                $imKeepProfiles = true;
            } elseif ($_GET['imKeepProfiles'] == 'false' || $_GET['imKeepProfiles'] == '0' || $_GET['imKeepProfiles'] == 'no') {
                $imKeepProfiles = false;
            }
        }
        $enableWtr = false;
        if (isset($_GET['enableWtr']) && is_array($zoom['config']['dynamicThumbsWtrmrk']) && $zoom['config']['dynamicThumbsWtrmrk']['allowEnableByGet']) {
            $enableWtr = true;
        }
        ob_start();
        if ($this->isValidPath($path) && $this->isValidFilename($_GET['previewPic']) && $this->axZm->fileExists($zoom, $path.$_GET['previewPic'])) {
            $this->axZm->rawThumb(
                $zoom,
                array(
                    'picDir' => $path,
                    'imgName' => $_GET['previewPic'],
                    'prevWidth' => (int)$_GET['width'],
                    'prevHeight' => (int)$_GET['height'],
                    'qual' => (int)($_GET['qual']),
                    'cache' => $cache,
                    'download' => false,
                    'backColor' => (isset($_GET['backColor']) && $_GET['backColor']) ? $_GET['backColor'] : $zoom['config']['pngBackgroundColor'],
                    'thumbMode' => isset($_GET['thumbMode']) ? $_GET['thumbMode'] : false,
                    'enlarge' => $enlarge,
                    'crop' => $crop,
                    'pngMode' => $pngMode,
                    'pngKeepTransp' => $pngKeepTransp,
                    'imKeepProfiles' => $imKeepProfiles,
                    'enableWtr' => $enableWtr,
                    'startTime' => $startTime,
                    'interlace' => isset($zoom['config']['dynamicThumbsInterlace']) && $zoom['config']['dynamicThumbsInterlace'] ? $zoom['config']['dynamicThumbsInterlace'] : false
                )
            );
        } elseif ($this->isValidPath($path) && $this->isValidFilename($_GET['previewPic']) && !$this->axZm->fileExists($zoom, $path.$_GET['previewPic'])) {
            session_write_close();
            if (isset($_GET['textError'])) {
                echo 'Image does not exist!
                Name: '.$_GET['previewPic'].'
                Path: '.$path.$_GET['previewPic'];
            } else {
                $im = imagecreatetruecolor((int)$_GET['width'], (int)$_GET['height']);
                $background_color = imagecolorallocate($im, 210, 210, 210);
                imagefill($im, 0, 0, $background_color);
                $text_color = imagecolorallocate($im, 171, 0, 0);
                imagestring($im, 2, 5, 5, 'Image does not exist!', $text_color);
                imagestring($im, 1, 5, 25, 'Name: '.$_GET['previewPic'], $text_color);
                imagestring($im, 1, 5, 35, 'Path: '.$path.$_GET['previewPic'], $text_color);
                header('Content-Type: image/jpeg');
                header("Pragma: public");
                header("Cache-Control: maxage=1");
                header('Expires: ' . gmdate('D, d M Y H:i:s', time()+1) . ' GMT');
                imagejpeg($im, NULL, 100);
                imagedestroy($im);
            }
        }
        ob_end_flush();
    }
    final function md5path($str, $type)
    {
        return $this->axZm->md5path($str, $type);
    }
    public function httpRequestQuery(
        $verb = 'GET', $ip = '',
        $port = 80,
        $uri = '/',
        $timeout = 10,
        $getdata = array(),
        $postdata = array(),
        $custom_headers = array(),
        $req_hdr = false,
        $res_hdr = false
    )
    {
        $ret = '';
        $verb = strtoupper($verb);
        $getdata_str = count($getdata) ? '?' : '';
        $postdata_str = '';
        foreach ($getdata as $k => $v) {
            $getdata_str .= urlencode($k) .'='. urlencode($v) . '&';
        }
        foreach ($postdata as $k => $v) {
            $postdata_str .= urlencode($k) .'='. urlencode($v) .'&';
        }
        $crlf = "\r\n";
        $req = $verb .' '. $uri . $getdata_str .' HTTP/1.1' . $crlf;
        $req .= 'Host: '. $ip . $crlf;
        $req .= 'User-Agent: Mozilla/5.0 Firefox/3.6.12' . $crlf;
        $req .= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' . $crlf;
        $req .= 'Accept-Language: en-us,en;q=0.5' . $crlf;
        $req .= 'Accept-Encoding: deflate' . $crlf;
        $req .= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7' . $crlf;
        $req .= 'Pragma: no-cache' . $crlf;
        foreach ($custom_headers as $k => $v) {
            $req .= $k .': '. $v . $crlf;
        }
        if ($verb == 'POST' && !empty($postdata_str)) {
            $postdata_str = substr($postdata_str, 0, -1);
            $req .= 'Content-Type: application/x-www-form-urlencoded' . $crlf;
            $req .= 'Content-Length: '. strlen($postdata_str) . $crlf;
            $req .= 'Connection: close'. $crlf . $crlf;
            $req .= $postdata_str;
        } else {
            $req .= 'Connection: close'. $crlf . $crlf;
        }
        if ($req_hdr) {
            $ret .= $req;
        }
        if (($fp = @fsockopen($ip, $port, $errno, $errstr, $timeout)) == false) {
            return "Error $errno: $errstr\n";
        }
        fputs($fp, $req);
        while ($line = fgets($fp)) {
            $ret .= $line;
        }
        fclose($fp);
        $responseHeader = substr($ret, 0, strpos($ret, "\r\n\r\n") + 2);
        if (!$res_hdr) {
            $ret = substr($ret, strpos($ret, "\r\n\r\n") + 4);
        }
        if (!strstr($responseHeader, '200')) {
            $text = 'Host: '.$ip.' <br>';
            $text .= 'Port: '.$port.' <br>';
            $text .= 'Uri: '.$uri.' <br><br>';
            $text .= '<span style="font-weight: bold;">Response Header</span><br>';
            $ret .= '<script type="text/javascript">jQuery.fn.axZm.zoomAlert(\''.str_replace($crlf, '<br>', $text.$responseHeader).'\', \'Request Failed\', \'Please check imageSlicer option in zoomConfig.inc.php\', true); </script>';
        } elseif ($ret == '') {
            $ret .= '<script type="text/javascript">jQuery(\'.axZmAlertBox\').remove(); </script>';
        }
        return $ret;
    }
    public function rewriteBase($zoom, $string)
    {
        if (isset($zoom['config']['rewriteBase']) && $zoom['config']['rewriteBase'] && is_string($zoom['config']['rewriteBase']) && is_string($string)) {
            return preg_replace('/^\\'.$zoom['config']['rewriteBase'].'/', '', $string);
        } else {
            return $string;
        }
    }
    public function getZoomData($zoom)
    {
        $zoom['config']['zoomDataPassed'] = $_GET['zoomData'];
        if (isset($_GET['zoomFile'])) {
            if (!strstr($_GET['zoomFile'], '.')) {
                $_GET['zoomFile'] = $this->uncompress($zoom, $_GET['zoomFile'], true);
            }
            $_GET['zoomDir'] = $this->rewriteBase($zoom, $this->checkSlash(dirname($_GET['zoomFile']), 'add'));
            $_GET['zoomFile'] = basename($_GET['zoomFile']);
            if (!$this->isValidFilename($_GET['zoomFile'])) {
                unset($_GET['zoomFile']);
            }
        }
        $_GET['zoomData'] = $this->uncompress($zoom, $_GET['zoomData'], false);
        $pic_list_array = array();
        $pic_list_data = array();
        $zoomTmp = array();
        if (is_array($_GET['zoomData'])) {
            if (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW']) || isset($_GET['qq'])) {
                if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {
                    $httpRef = explode('?', $_SERVER['HTTP_REFERER']);
                    $zoomTmp['fromPath'] = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift($httpRef));
                } else {
                    $zoomTmp['fromPath'] .= 'index.html';
                }
            } else {
                $zoomTmp['fromPath'] = $_SERVER['REQUEST_URI'];
            }
            if (substr($zoomTmp['fromPath'], -1) == '/' || substr($zoomTmp['fromPath'], -1) == '\\') {
                $zoomTmp['fromPath'] .= 'index.html';
            }
            foreach($_GET['zoomData'] as $k => $v) {
                if ( (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW'])) && !(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) && substr($v['p'],0, 3) == '../') {
                    echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                    <div style='font-size: 200%'>Error</div>
                    When images or folders are defined as relative paths (../) it may lead to not showing them under certain conditions.
                    A simple workaround is to always use absolute paths. Please address this message to the website administrator. Thank you.
                    </div>
                    <script>window.aZrelPathError = true;</script>
                    ";
                    exit;
                }
                if ($zoomTmp['fromPath'] && substr($v['p'], 0, 3) == '../') {
                    $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($v['p'],2), 'add'));
                    if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($v['p'],2),'add'), 'add'))) {
                        unset($zoomTmp['zoomDirInfo']);
                    }
                }
                if (isset($zoomTmp['zoomDirInfo']) && $zoomTmp['zoomDirInfo']) {
                    $v['p'] = $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add');
                }
                $v['p'] = $this->checkFpPPdata($v['p'], $zoom['config']['fpPP']);
                if (!$this->isValidFilename($v['f']) || !$this->isValidPath($v['p'])) {
                    unset($_GET['zoomData'][$k]);
                } else {
                    $pic_list_array[$k] = $v['f'];
                    $pic_list_data[$k]['path'] = $v['p'];
                    if (!isset($zoomTmp['zoomDirFound']) && isset($_GET['zoomDir'])) {
                        if ($_GET['zoomDir'] == $v['p']) {
                            $zoomTmp['zoomDirFound'] = true;
                        }
                    }
                }
                $zoomTmp['zoomDirInfo'] = false;
            }
            if ((!isset($zoomTmp['zoomDirFound']) || !$zoomTmp['zoomDirFound']) && isset($_GET['zoomDir'])) {
                unset($_GET['zoomDir']);
            }
            if (!isset($_GET['zoomDir']) && is_array($_GET['zoomData'])) {
                reset($_GET['zoomData']);
                $_GET['zoomDir'] = $_GET['zoomData'][key($_GET['zoomData'])]['p'];
            }
        } else {
            unset($_GET['zoomData']);
        }
        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }
    public function get3dDir($zoom)
    {
        $pic_list_array = array();
        $pic_list_data = array();
        $zoomTmp = array();
        if (substr($_GET['3dDir'],0, 2) == './' || substr(strtolower($_GET['3dDir']),0, 2) == 'c:') {
            $_GET['3dDir'] = substr($_GET['3dDir'], 2);
        }
        $_GET['3dDir'] = $this->checkFpPPdata($_GET['3dDir'], $zoom['config']['fpPP']);
        $_GET['3dDir'] = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', $_GET['3dDir']);
        $_GET['3dDir'] = $this->rewriteBase($zoom, $_GET['3dDir']);
        $zoom['config']['pic'] = $this->checkSlash($zoom['config']['pic'].'/'.$_GET['3dDir'], 'add');
        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');
        if (!is_dir($zoom['config']['picDir'])) {
            $zoom['config']['pic'] = $this->checkSlash('/'.$_GET['3dDir'], 'add');
            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');
        }
        if (!is_dir($zoom['config']['picDir'])) {
            if (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW'])) {
                if (!(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) && stristr($_GET['3dDir'], '../')) {
                    echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                    <div style='font-size: 200%'>Error</div>
                    When images or folders are defined as relative paths (../) it may lead to not showing them under certain conditions.
                    A simple workaround is to always use absolute paths. Please address this message to the website administrator. Thank you.
                    </div>
                    <script>window.aZrelPathError = true;</script>
                    ";
                    exit;
                } elseif (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {
                    $httpRef = explode('?', $_SERVER['HTTP_REFERER']);
                    $zoomTmp['fromPath'] = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift($httpRef));
                } else {
                    $zoomTmp['fromPath'] = 'index.html';
                }
            } else {
                $zoomTmp['fromPath'] = $_SERVER['REQUEST_URI'];
            }
            if (substr($zoomTmp['fromPath'], -1) == '/' || substr($zoomTmp['fromPath'], -1) == '\\') {
                $zoomTmp['fromPath'] .= 'index.html';
            }
            if ($zoomTmp['fromPath'] && substr($_GET['3dDir'],0, 3) == '../') {
                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['3dDir'],2), 'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['3dDir'],2),'add'), 'add'))) {
                    unset($zoomTmp['zoomDirInfo']);
                }
            } elseif ($zoomTmp['fromPath'] && substr($_GET['3dDir'],0, 1) != '/') {
                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['3dDir'],'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['3dDir'], 'add'), 'add'))) {
                    unset($zoomTmp['zoomDirInfo']);
                }
            } elseif ($zoom['config']['installPath'] && substr($_GET['3dDir'],0, 1) == '/') {
                $zoom['config']['pic'] = $this->checkSlash($zoom['config']['installPath'].'/'.$_GET['3dDir'],'add');
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'],'add');
            }
            if (isset($zoomTmp['zoomDirInfo']) && $zoomTmp['zoomDirInfo']) {
                $_GET['3dDir'] = $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add');
                $zoom['config']['pic'] = $_GET['3dDir'];
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$_GET['3dDir'], 'add');
            }
        }
        if (!$this->isValidPath($_GET['3dDir'])) {
            unset ($_GET['3dDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }
        if (isset($zoom['config']['picDir']) && (
            $zoom['config']['picDir'] == $zoom['config']['thumbDir']
            || $zoom['config']['picDir'] == $zoom['config']['galleryDir']
            || strstr($zoom['config']['picDir'], $zoom['config']['pyrTilesDir'])
            || strstr($zoom['config']['picDir'], $zoom['config']['gPyramidDir'])
            || $zoom['config']['picDir'] == $zoom['config']['mapDir']
            || $zoom['config']['picDir'] == $zoom['config']['tempCacheDir']
            )
        ) {
            unset ($_GET['3dDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }
        if (isset($_GET['zoomCueFrames'])) {
            $zoom['config']['cueFrames'] = $this->testCSV($_GET['zoomCueFrames'], ',', 'int');
        }
        if (isset($zoom['config']['picDir']) && is_dir($zoom['config']['picDir'])) {
            $n = 0;
            $z = 0;
            $nn = 0;
            $cutFrames = 1;
            if (isset($_GET['cutFrames']) && (int)$_GET['cutFrames'] > 0) {
                $cutFrames = (int)$_GET['cutFrames'];
            }
            $exclFilter = isset($zoom['config']['spinFilesExcludeFilter']) ? $zoom['config']['spinFilesExcludeFilter'] : array();
            $globFiles = glob($zoom['config']['picDir'].'*');
            natcasesort($globFiles);
            foreach ($globFiles as $file) {
                $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                if (is_dir($file)) {
                    if (!is_array($zoom['config']['zAxis'])) {
                        $zoom['config']['zAxis'] = array();
                        $zoom['config']['zFolder'] = array();
                        $thisNumberFiles = array();
                    }
                    $z++;
                    if ($z > ($zoom['config']['spinMaxRows'] || 15)) {
                        break;
                    }
                    $zoom['config']['zFolder'][$z] = $thisFile;
                    $zoomTmp['subFiles'] = array();
                    $tt = 0;
                    foreach (glob($this->checkSlash($file, 'add').'*') as $subFile) {
                        $thisSubFile = $this->getl('/', $this->checkSlash($subFile, 'remove'));
                        if ($this->isValidFileType($thisSubFile)) {
                            $filterCheck = false;
                            if (!empty($exclFilter)) {
                                if ($this->axZm->strstrArray($exclFilter, $thisFile)) {
                                    $filterCheck = true;
                                }
                            }
                            if ($filterCheck === false) {
                                $zoomTmp['subFiles'][] = $thisSubFile;
                                $tt++;
                            }
                        }
                        if ($tt > ($zoom['config']['spinMaxFrames'] || 360)) {
                            echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                            <div style='font-size: 200%'>Error</div>
                            The number of images in one row of your spherical 3D exceeded the limit to ".($zoom['config']['spinMaxFrames'] || 360)." images.
                            AJAX-ZOOM broke up with the request.
                            </div>
                            <script>window.aZ3dError = true;</script>
                            ";
                            exit;
                        }
                    }
                    $thisNumberFiles[$z] = $tt;
                    if ($z > 1 && $thisNumberFiles[$z-1] != $tt) {
                        echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                        <div style='font-size: 200%'>Error</div>
                        The number of images in subfolders (".$_GET['3dDir'].") for your spherical 3D is not equal.
                        While in one folder there are ".$thisNumberFiles[$z-1]." images, an other contains ".$tt." images.
                        As of current version this is not possible. AJAX-ZOOM broke up with the request.
                        If you are not sure why is that, please contact the support.
                        </div>
                        <script>window.aZ3dError = true;</script>
                        ";
                        exit;
                    }
                    $zoomTmp['subFiles'] = $this->natIndex($zoomTmp['subFiles'], false);
                    if (!empty($zoomTmp['subFiles'])) {
                        $nn = 0;
                        foreach ($zoomTmp['subFiles'] as $k => $thisSubFile) {
                            $nn++;
                            if ($nn % $cutFrames == 0) {
                                $n++;
                                $pic_list_array[$n] = $thisSubFile;
                                $pic_list_data[$n]['path'] = $zoom['config']['pic'].$thisFile;
                                $zoom['config']['zAxis'][$z][$n] = $thisSubFile;
                            }
                        }
                    }
                } elseif (!isset($zoom['config']['zAxis'])) {
                    if ($this->isValidFileType($thisFile)) {
                        $filterCheck = false;
                        if (!empty($exclFilter)) {
                            if ($this->axZm->strstrArray($exclFilter, $thisFile)) {
                                $filterCheck = true;
                            }
                        }
                        if ($filterCheck === false) {
                            $nn++;
                            if ($nn % $cutFrames == 0) {
                                $n++;
                                $pic_list_array[$n] = $thisFile;
                            }
                        }
                    }
                }
            }
            if (!isset($zoom['config']['zAxis']) && !empty($pic_list_array)) {
                $pic_list_array = $this->natIndex($pic_list_array, false);
            }
        }
        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }
    public function getZoomDir($zoom, $axZmScanDir = false)
    {
        $pic_list_array = array();
        $pic_list_data = array();
        $zoomTmp = array();
        $zoomTmp['folderArray'] = array();
        if ($axZmScanDir) {
            $n = 0;
            foreach (glob($this->checkSlash($zoom['config']['picDir'], 'add').'*', GLOB_ONLYDIR) as $folder) {
                $n++;
                $zoomTmp['folderArray'][$n] = $this->getl('/',$folder);
            }
            $zoom['config']['folderArray'] = $zoomTmp['folderArray'];
        }
        $_GET['zoomDir'] = $this->checkFpPPdata($_GET['zoomDir'], $zoom['config']['fpPP']);
        $_GET['zoomDir'] = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', $_GET['zoomDir']);
        $_GET['zoomDir'] = $this->rewriteBase($zoom, $_GET['zoomDir']);
        $zoom['config']['pic'] = $this->checkSlash($zoom['config']['pic'].'/'.$_GET['zoomDir'], 'add');
        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');
        if (!is_dir($zoom['config']['picDir'])) {
            $zoom['config']['pic'] = $this->checkSlash('/'.$_GET['zoomDir'], 'add');
            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');
        }
        if (!is_dir($zoom['config']['picDir'])) {
            if (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW']) || isset($_GET['qq'])) {
                if (!isset($_GET['qq']) && !(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) && stristr($_GET['zoomDir'], '../')) {
                    echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                    <div style='font-size: 200%'>Error</div>
                    When images or folders are defined as relative paths (../) it may lead to not showing them under certain conditions.
                    A simple workaround is to always use absolute paths. Please address this message to the website administrator. Thank you.
                    </div>
                    <script>window.aZrelPathError = true;</script>
                    ";
                    exit;
                } elseif (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {
                    $httpRef = explode('?', $_SERVER['HTTP_REFERER']);
                    $zoomTmp['fromPath'] = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift($httpRef));
                } else {
                    $zoomTmp['fromPath'] = index.html;
                }
            } else {
                $zoomTmp['fromPath'] = $_SERVER['REQUEST_URI'];
            }
            if (substr($zoomTmp['fromPath'], -1) == '/' || substr($zoomTmp['fromPath'], -1) == '\\') {
                $zoomTmp['fromPath'] .= 'index.html';
            }
            if ($zoomTmp['fromPath'] && substr($_GET['zoomDir'],0, 3) == '../') {
                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['zoomDir'],2), 'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['zoomDir'],2), 'add'), 'add'))) {
                    unset($zoomTmp['zoomDirInfo']);
                }
            } elseif ($zoomTmp['fromPath'] && substr($_GET['zoomDir'],0, 1) != '/') {
                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['zoomDir'], 'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['zoomDir'], 'add'), 'add'))) {
                    unset($zoomTmp['zoomDirInfo']);
                }
            } elseif ($zoom['config']['installPath'] && substr($_GET['zoomDir'],0, 1) == '/') {
                $zoom['config']['pic'] = $this->checkSlash($zoom['config']['installPath'].'/'.$_GET['zoomDir'], 'add');
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');
            }
            if (isset($zoomTmp['zoomDirInfo']) && $zoomTmp['zoomDirInfo']) {
                $_GET['zoomDir'] = $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add');
                $zoom['config']['pic'] = $_GET['zoomDir'];
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$_GET['zoomDir'], 'add');
            }
        }
        if (!$this->isValidPath($_GET['zoomDir'])) {
            unset ($_GET['zoomDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }
        if ($zoom['config']['picDir'] == $zoom['config']['thumbDir']
            || $zoom['config']['picDir'] == $zoom['config']['galleryDir']
            || strstr($zoom['config']['picDir'], $zoom['config']['pyrTilesDir'])
            || strstr($zoom['config']['picDir'], $zoom['config']['gPyramidDir'])
            || $zoom['config']['picDir'] == $zoom['config']['tempCacheDir']
            || $zoom['config']['picDir'] == $zoom['config']['mapDir']
        ) {
            unset ($_GET['zoomDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }
        if ($zoom['config']['picDir']) {
            if (substr($_GET['zoomDir'],0, 2) == './' || substr(strtolower($_GET['zoomDir']),0, 2) == 'c:') {
                $_GET['zoomDir'] = substr($_GET['zoomDir'], 2);
            }
            if (isset($_GET['qq'])) {
                $n = 0;
                $zoom['config']['subFolderArray'] = array();
                foreach (glob($this->checkSlash($zoom['config']['picDir'], 'add').'*', GLOB_ONLYDIR) as $folder) {
                    $n++;
                    $zoom['config']['subFolderArray'][$n] = $this->getl('/', str_replace('\\', '/', $folder));
                }
            }
            $n = 0;
            $pic_list_info = array();
            $pic_list_all_info = array();
            foreach (glob($zoom['config']['picDir'].'*') as $file) {
                $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                if ( $this->isValidFileType($thisFile)) {
                    $n++;
                    $pic_list_array[$n] = $thisFile;
                    if ($zoom['config']['sortBy']) {
                        $thisFileStat = stat($file);
                        if ($thisFileStat[$zoom['config']['sortBy']]) {
                            $pic_list_info[$n] = $thisFileStat[$zoom['config']['sortBy']];
                        }
                        $pic_list_all_info[$n] = $thisFileStat;
                    }
                }
            }
            if ($zoom['config']['sortBy'] && !empty($pic_list_info)) {
                if ($zoom['config']['sortReverse']) {
                    arsort($pic_list_info);
                } else {
                    asort($pic_list_info);
                }
                $n = 0;
                $pic_list_array_tmp = $pic_list_array;
                foreach ($pic_list_info as $k => $v) {
                    $n++;
                    if (!$pic_list_data[$n]) {
                        $pic_list_data[$n] = array();
                    }
                    $pic_list_array[$n] = $pic_list_array_tmp[$k];
                    $pic_list_data[$n][$zoom['config']['sortBy']] = $v;
                    $pic_list_data[$n]['stat'] = $pic_list_all_info[$k];
                }
            } else {
                $pic_list_array = $this->natIndex($pic_list_array, $zoom['config']['sortReverse'] ? true : false);
            }
        }
        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }
    public function preProceedList($zoom, $pic_list_array, $pic_list_data, $zoomTmp)
    {
        if (is_array($pic_list_array) && !empty($pic_list_array)) {
            $firstImageSize = null;
            $startTime = microtime(true);
            if (!$zoom['config']['imgFileOpt']) {
                $zoom['config']['imgFileOpt'] = array();
            }
            foreach ($pic_list_array as $k => $v) {
                $pic_list_data[$k]['fileName'] = $v;
                if (isset($pic_list_data[$k]['path'])) {
                    $picPath = $this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$k]['path'], 'add');
                    $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$picPath, 'add');
                    $thisPicPath = $this->checkSlash($pic_list_data[$k]['path'], 'add');
                    if (!is_dir($zoom['config']['picDir'])) {
                        $picPath = $this->checkSlash('/'.$pic_list_data[$k]['path'], 'add');
                        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$picPath, 'add');
                        if (!is_dir($zoom['config']['picDir'])) {
                            $picPath = $this->checkSlash($zoom['config']['installPath'].'/'.$pic_list_data[$k]['path'], 'add');
                            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$picPath, 'add');
                        }
                    }
                    $pic_list_data[$k]['picPath'] = $picPath;
                }
                $pic_list_data[$k]['thisImagePath'] = $this->checkSlash($zoom['config']['picDir'].'/'.$v, 'remove');
                $this->axZm->getJsonFileData($zoom, $v);
                if (!isset($_GET['str'])) {
                    if ($firstImageSize && ($zoom['config']['spinMod'] || $zoom['config']['imgFileOpt']['sameSize'])) {
                        $pic_list_data[$k]['imgSize'] = $firstImageSize;
                    } else {
                        if (isset($this->jsonData[$v]['imgSize'])) {
                             $pic_list_data[$k]['imgSize'] = $this->jsonData[$v]['imgSize'];
                        } else {
                            $pic_list_data[$k]['imgSize'] = $this->axZm->imageSize($zoom['config']['picDir'].$pic_list_array[$k], $zoom['config']['im'], false);
                            $this->jsonData[$v]['imgSize'] = $pic_list_data[$k]['imgSize'];
                            $this->axZm->writeJsonFileData($zoom, $v);
                        }
                    }
                    if (!$firstImageSize) {
                        $firstImageSize = $pic_list_data[$k]['imgSize'];
                    }
                    if ($zoom['config']['imgFileOpt']['getFileSize']) {
                        if (isset($this->jsonData[$v]['fileSize'])) {
                            $pic_list_data[$k]['fileSize'] = $this->jsonData[$v]['fileSize'];
                        } else {
                            $pic_list_data[$k]['fileSize'] = filesize($zoom['config']['picDir'].$pic_list_array[$k]);
                            $this->jsonData[$v]['fileSize'] = $pic_list_data[$k]['fileSize'];
                            $this->axZm->writeJsonFileData($zoom, $v);
                        }
                    }
                    if (function_exists($zoom['config']['galleryThumbDesc'])) {
                        $pic_list_data[$k]['thumbDescr'] = $zoom['config']['galleryThumbDesc']($pic_list_data, $k);
                    }
                    if (function_exists($zoom['config']['galleryThumbFullDesc'])) {
                        $pic_list_data[$k]['fullDescr'] = $zoom['config']['galleryThumbFullDesc']($pic_list_data, $k);
                    }
                }
            }
            $zoom['config']['pic_list_array'] = $pic_list_array;
            $zoom['config']['pic_list_data'] = $pic_list_data;
            $this->readTime['preProceedList'] = $this->endTimeDiff($startTime);
            $startTimeProceedList = microtime(true);
            $proceed = $this->proceedList($zoom, $zoomTmp);
            $this->readTime['proceedList'] = $this->endTimeDiff($startTimeProceedList);
            $zoom = $proceed[0];
            $zoomTmp = $proceed[1];
            $pic_list_array = $zoom['config']['pic_list_array'];
            $pic_list_data = $zoom['config']['pic_list_data'];
            $this->readTime['total'] = $this->endTimeDiff($startTime);
        }
        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }
    public function proceedList($zoom, $zoomTmp)
    {
        $pic_list_array = $zoom['config']['pic_list_array'];
        $pic_list_data = $zoom['config']['pic_list_data'];
        $picSave = $zoom['config']['pic'];
        if (!$zoom['config']['imgFileOpt']) {
            $zoom['config']['imgFileOpt'] = array();
        }
        if (!empty($pic_list_array) && !empty($pic_list_data)) {
            settype($_GET['zoomID'], 'int');
            reset($pic_list_array);
            if (isset($_GET['zoomFile'])) {
                if (in_array($_GET['zoomFile'], $pic_list_array)) {
                    $flipedArray = array_flip($pic_list_array);
                    $_GET['zoomID'] = $flipedArray[$_GET['zoomFile']];
                }
            }
            if (!$_GET['zoomID'] OR !array_key_exists($_GET['zoomID'], $pic_list_array)) {
                $_GET['zoomID'] = key($pic_list_array);
                $zoom['config']['pZoomID'] = false;
            } else {
                $zoom['config']['pZoomID'] = $_GET['zoomID'];
            }
            if (isset($pic_list_data[$_GET['zoomID']]['path'])) {
                $startTime = microtime(true);
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$_GET['zoomID']]['path'], 'add'), 'add');
                if (!is_dir($zoom['config']['picDir'])) {
                    $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash('/'.$pic_list_data[$_GET['zoomID']]['path'], 'add'), 'add');
                    if (is_dir($zoom['config']['picDir'])) {
                        $zoom['config']['pic'] = '';
                    } else {
                        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['installPath'].'/'.$pic_list_data[$_GET['zoomID']]['path'], 'add'), 'add');
                        if (is_dir($zoom['config']['picDir'])) {
                            $zoom['config']['pic'] = $zoom['config']['installPath'];
                        }
                    }
                }
                $this->readTime['findPathFirstImage1'] = $this->endTimeDiff($startTime);
            }
            if (!isset($_GET['zoomData']) && !$this->axZm->fileExists($zoom, $zoom['config']['picDir'].$pic_list_array[$_GET['zoomID']])) {
                unset ($_GET['zoomID']);
                $pic_list_temp_array = $pic_list_array;
                $zoomTmp['errorImages'] = array();
                $startTime = microtime(true);
                foreach ($pic_list_array as $k => $v) {
                    if (isset($pic_list_data[$k]['path'])) {
                        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$k]['path'], 'add'), 'add');
                    }
                    if ($this->axZm->fileExists($zoom, $zoom['config']['picDir'].$pic_list_array[$k])) {
                        if (!$zoomTmp['picFound']) {
                            $_GET['zoomID'] = $k;
                            $zoomTmp['picFound'] = $k;
                        }
                    } else {
                        $zoomTmp['errorImages'][$k] = $zoom['config']['picDir'].$pic_list_array[$k];
                        unset($pic_list_temp_array[$k]);
                        unset($pic_list_data[$k]);
                    }
                }
                $this->readTime['findPathFirstImage2'] = $this->endTimeDiff($startTime);
                if ($zoom['config']['errors'] && !empty($zoomTmp['errorImages'])) {
                    $zoomTmp['fileErrorTitle']="Error images missing";
                    foreach ($zoomTmp['errorImages'] as $k => $v) {
                        $zoomTmp['fileErrorText'].="<li>$v</li> ";
                    }
                    $zoomTmp['fileErrorText']="<ul>".$zoomTmp['fileErrorText']."</ul>";
                    $this->fileErrorDialog="<script type=\"text/javascript\">jQuery.fn.axZm.zoomAlert('".$zoomTmp['fileErrorText']."','".$zoomTmp['fileErrorTitle']."',false);</script>";
                }
                $pic_list_array = $pic_list_temp_array;
            }
            $zoom['config']['pic_list_array'] = $pic_list_array;
            $zoom['config']['pic_list_data'] = $pic_list_data;
            if (
                $zoom['config']['exifAutoRotation']
                && !isset($_GET['str'])
                && !isset($_GET['qq'])
                && !isset($_GET['setHW'])
                && !defined('PHALANGER')
            ) {
                $pelLib = false;
                if ($this->axZm->fileExists($zoom, dirname(__FILE__).'/classes/pel/PelJpeg.php', true)) {
                    $pelLib = true;
                    if (!class_exists('PelDataWindow', false)) {
                        require_once dirname(__FILE__).'/classes/pel/PelDataWindow.php';
                    }
                    if (!class_exists('PelJpeg', false)) {
                        require_once dirname(__FILE__).'/classes/pel/PelJpeg.php';
                    }
                    if (!class_exists('PelTiff', false)) {
                        require_once dirname(__FILE__).'/classes/pel/PelTiff.php';
                    }
                }
                $startTime = microtime(true);
                foreach ($pic_list_array as $k => $v) {
                    if (strtolower($this->getl('.', $v)) == 'jpg' || strtolower($this->getl('.', $v)) == 'jpeg') {
                         $this->getJsonFileData($zoom, $v);
                        if (isset($this->jsonData[$v]['exifChecked'])) {
                             continue;
                        } else {
                            $this->axZm->updateJsonFileData($zoom, array(
                                'fileName' => $v,
                                'key' => 'exifChecked',
                                'value' => 1,
                                'isArr' => false,
                                'save' => true
                            ));
                        }
                        if (isset($pic_list_data[$k]['path'])) {
                            $tempPicDir = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$k]['path'], 'add'), 'add');
                        } else {
                            $tempPicDir = $zoom['config']['picDir'];
                        }
                        $aryEXIF = array();
                        $aryEXIF = exif_read_data($tempPicDir.$v);
                        if (isset($aryEXIF["Orientation"]) && ($aryEXIF["Orientation"] == 6 || $aryEXIF["Orientation"] == 8 || $aryEXIF["Orientation"] == 3)) {
                            $angle = 0;
                            if ($aryEXIF["Orientation"] == 6) {
                                $angle = 270;
                            } elseif ($aryEXIF["Orientation"] == 8) {
                                $angle = 90;
                            } elseif ($aryEXIF["Orientation"] == 3) {
                                $angle = 180;
                            }
                            if ($angle != 0) {
                                if (is_writable($tempPicDir.$v)) {
                                    $this->removeAxZm($zoom, $v, array('In' => true, 'Th' => true, 'tC' => true, 'mO' => true, 'Ti' => true, 'gP' => true), false);
                                    if ($pelLib) {
                                        $sourceExifFile = new PelJpeg($tempPicDir.$v);
                                        $sourceExifInfo = $sourceExifFile->getExif();
                                    }
                                    if ($zoom['config']['im']) {
                                        $arrAngle = array('270' => '90', '90' => '-90', '180' => '180');
                                        $convertString = $this->whichConvert($zoom['config']['imPath'])." '".$tempPicDir.$v."' -rotate '".$arrAngle[$angle]."' '".$tempPicDir.$v."'";
                                        $convertString = $this->imQuotes($zoom, $convertString);
                                        exec($convertString);
                                    } else {
                                        $rotatedImage = $this->rotateImage($tempPicDir.$v, $angle);
                                        imagejpeg($rotatedImage, $tempPicDir.$v, 100);
                                    }
                                    if ($pelLib) {
                                        $outputExifFile = new PelJpeg($tempPicDir.$v);
                                        if ($sourceExifInfo != null) {
                                            $outputExifFile->setExif($sourceExifInfo);
                                            file_put_contents($tempPicDir.$v, $outputExifFile->getBytes());
                                        }
                                        $this->exifOrientation($tempPicDir.$v, $tempPicDir.$v);
                                    }
                                    $pic_list_data[$k]['imgSize'] = $this->axZm->imageSize($tempPicDir.$v, $zoom['config']['im'], false);
                                    $this->axZm->updateJsonFileData($zoom, array(
                                        'fileName' => $v,
                                        'key' => 'imgSize',
                                        'value' => $pic_list_data[$k]['imgSize'],
                                        'isArr' => true,
                                        'save' => true
                                    ));
                                } else {
                                    if ($zoom['config']['errors']) {
                                        echo 'alert("'.$tempPicDir.$v.' is not writable by PHP.");';
                                    }
                                }
                            }
                        }
                    }
                    $zoom['config']['pic_list_data'] = $pic_list_data;
                }
                $this->readTime['exifAutoRotation'] = $this->endTimeDiff($startTime);
            }
            if ($zoom['config']['cTimeCompare'] && !isset($_GET['setHW']) && !isset($_GET['str']) && !isset($_GET['qq'])) {
                $this->cTimeCompare($zoom);
            }
            if (isset($_GET['zoomID']) && !isset($_GET['qq']))
            {
                if (isset($pic_list_data[$_GET['zoomID']]['path'])) {
                    $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$_GET['zoomID']]['path'], 'add'), 'add');
                }
                $zoom['config']['orgImgName'] = $pic_list_array[$_GET['zoomID']];
                if (isset($pic_list_data[$_GET['zoomID']]['imgSize'])) {
                    $zoom['config']['orgImgSize'] = $pic_list_data[$_GET['zoomID']]['imgSize'];
                } else {
                    if (isset($this->jsonData[$zoom['config']['orgImgName']]['imgSize'])) {
                        $zoom['config']['orgImgSize'] = $this->jsonData[$zoom['config']['orgImgName']]['imgSize'];
                    } else {
                        $zoom['config']['orgImgSize'] = $this->axZm->imageSize($zoom['config']['picDir'].$zoom['config']['orgImgName'], $zoom['config']['im'], false);
                        $this->axZm->updateJsonFileData($zoom, array(
                            'fileName' => $zoom['config']['orgImgName'],
                            'key' => 'imgSize',
                            'value' => $zoom['config']['orgImgSize'],
                            'isArr' => false,
                            'save' => true
                        ));
                    }
                }
                $zoom['config']['smallImgName'] = $this->composeFileName($pic_list_array[$_GET['zoomID']], $zoom['config']['picDim'], '_', $this->pngMod($zoom, $pic_list_array[$_GET['zoomID']]));
                $imageSlicer = $zoom['config']['imageSlicer'];
                if (!is_array($imageSlicer)) {
                    $imageSlicer = array();
                }
                $slicerPostArr = array(
                    'zoomID' => $_GET['zoomID'],
                    'example' => $_GET['example'],
                    'pic' => $zoom['config']['pic'],
                    'pic_list_data' => serialize(array($_GET['zoomID'] => $pic_list_data[$_GET['zoomID']])),
                    'pic_list_array' => serialize(array($_GET['zoomID'] => $pic_list_array[$_GET['zoomID']]))
                );
                if ($imageSlicer['enabled'] && !empty($imageSlicer['parameters'])) {
                    foreach ($imageSlicer['parameters'] as $a => $b) {
                        if (isset($_GET[$b])) {
                            $slicerPostArr[$b] = $_GET[$b];
                        }
                    }
                }
                $checkInitialImage = true;
                if (!$zoom['config']['imgFileOpt']['noMakeFirstImage']) {
                    if (isset($zoom['config']['stepPicDim'])
                        && is_array($zoom['config']['stepPicDim'])
                        && !empty($zoom['config']['stepPicDim'])
                    ) {
                        foreach($zoom['config']['stepPicDim'] as $k => $v) {
                            if ((int)$v['w'] && (int)$v['h']) {
                                $thumbJson = $this->axZm->inArrayJsonFileData($zoom['config']['orgImgName'], 'thumb', (int)$v['w'].'x'.(int)$v['h']);
                                $thumbHd = false;
                                if (!$thumbJson) {
                                    $ffn = $zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).'/'.$this->composeFileName($zoom['config']['orgImgName'], (int)$v['w'].'x'.(int)$v['h'], '_', $this->pngMod($zoom, $zoom['config']['orgImgName']));
                                    $thumbHd = $this->axZm->fileExists($zoom, $ffn);
                                    if ($thumbHd) {
                                        $this->axZm->updateJsonFileData($zoom, array(
                                            'fileName' => $zoom['config']['orgImgName'],
                                            'key' => 'thumb',
                                            'value' => (int)$v['w'].'x'.(int)$v['h'],
                                            'isArr' => true,
                                            'unset' => false,
                                            'save' => true
                                        ));
                                    }
                                }
                                if (!$thumbJson && !$thumbHd) {
                                    $checkInitialImage = false;
                                    break;
                                }
                            }
                        }
                    } else {
                        if ($this->axZm->inArrayJsonFileData($zoom['config']['orgImgName'], 'thumb', $zoom['config']['picDim'])) {
                            $checkInitialImage = true;
                        } else {
                            $ffn = $zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).'/'.$this->composeFileName($zoom['config']['orgImgName'], $zoom['config']['picDim'], '_', $this->pngMod($zoom, $zoom['config']['orgImgName']));
                            $checkInitialImage = $this->axZm->fileExists($zoom, $ffn);
                            if ($checkInitialImage) {
                                $this->axZm->updateJsonFileData($zoom, array(
                                    'fileName' => $zoom['config']['orgImgName'],
                                    'key' => 'thumb',
                                    'value' => $zoom['config']['picDim'],
                                    'isArr' => true,
                                    'unset' => false,
                                    'save' => true
                                ));
                            }
                        }
                    }
                }
                if (!$checkInitialImage) {
                    if ($imageSlicer['enabled']) {
                        $slicerPostArr['task'] = 'makeFirstImage';
                        $this->returnMakeFirstImage = $this->httpRequestQuery(
                            $imageSlicer['method'],
                            $imageSlicer['host'],
                            $imageSlicer['port'],
                            $imageSlicer['uri'],
                            $imageSlicer['timeout'],
                            ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                            ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                            $imageSlicer['headers']
                        );
                    } else {
                        $startTime = microtime(true);
                        $this->returnMakeFirstImage = $this->axZm->makeFirstImage($zoom, false);
                        $this->readTime['makeFirstImage1'] = $this->endTimeDiff($startTime);
                    }
                } elseif ($zoom['config']['useMap'] && $zoom['config']['mapOwnImage'] && !$zoom['config']['imgFileOpt']['noMakeMapImage']) {
                    if (!isset($zoom['config']['mapDir'])) {
                        $zoom['config']['mapDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['mapPath'], 'add');
                    }
                    if (!$this->axZm->inArrayJsonFileData($zoom['config']['orgImgName'], 'map', $zoom['config']['mapOwnImage'])) {
                        $ffn = $zoom['config']['mapDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).'/'.$this->composeFileName($zoom['config']['orgImgName'], $zoom['config']['mapOwnImage'], '_', $this->pngMod($zoom, $zoom['config']['orgImgName']));
                        if (!$this->axZm->fileExists($zoom, $ffn)) {
                            if ($imageSlicer['enabled']) {
                                $slicerPostArr['task'] = 'makeMapImage';
                                $this->returnMakeFirstImage = $this->httpRequestQuery(
                                    $imageSlicer['method'],
                                    $imageSlicer['host'],
                                    $imageSlicer['port'],
                                    $imageSlicer['uri'],
                                    $imageSlicer['timeout'],
                                    ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                                    ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                                    $imageSlicer['headers']
                                );
                            } else {
                                $startTime = microtime(true);
                                $this->returnMakeFirstImage = $this->axZm->makeFirstImage($zoom, true);
                                $this->readTime['makeFirstImage2'] = $this->endTimeDiff($startTime);
                            }
                        } else {
                            $this->axZm->updateJsonFileData($zoom, array(
                                'fileName' => $zoom['config']['orgImgName'],
                                'key' => 'map',
                                'value' => $zoom['config']['mapOwnImage'],
                                'isArr' => true,
                                'unset' => false,
                                'save' => true
                            ));
                        }
                    }
                }
                $startTime = microtime(true);
                if (
                    $this->axZm->inArrayJsonFileData($zoom['config']['orgImgName'], 'thumb', $zoom['config']['picDim'])
                    || $zoom['config']['imgFileOpt']['noMakeFirstImage']
                ) {
                    $zoom['config']['smallImgSize'] = $this->virtualResize($pic_list_data[$_GET['zoomID']]['imgSize'], array($zoom['config']['picX'], $zoom['config']['picY']));
                } else {
                    $zoom['config']['smallImgSize'] = $this->axZm->imageSize($zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName'], $zoom['config']['im'], false);
                }
                $this->readTime['smallImgSizeDim'] = $this->endTimeDiff($startTime);
                if ($zoom['config']['imgFileOpt']['getFileSize']) {
                    $startTime = microtime(true);
                    if (isset($this->jsonData[$zoom['config']['orgImgName']]['fileSize'])) {
                        $zoom['config']['smallFileSize'] = $this->jsonData[$zoom['config']['orgImgName']]['fileSize'];
                    } else {
                        $zoom['config']['smallFileSize'] = filesize($zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName']);
                        if ($zoom['config']['jsonInfo']) {
                            $this->axZm->updateJsonFileData($zoom, array(
                                'fileName' => $zoom['config']['orgImgName'],
                                'key' => 'fileSize',
                                'value' => $zoom['config']['smallFileSize'],
                                'isArr' => false,
                                'save' => true
                            ));
                        }
                    }
                    $this->readTime['smallImgFileSize'] = $this->endTimeDiff($startTime);
                }
                if (isset($_GET['setHW'])) {
                    echo '<script type="text/javascript">';
                    if (isset($zoom['config']['smallImgSize'][0]) && isset($zoom['config']['smallImgSize'][1])) {
                    echo '
jQuery.axZm.iw='.$this->ptj($zoom['config']['smallImgSize'][0]).';
jQuery.axZm.ih='.$this->ptj($zoom['config']['smallImgSize'][1]).';
';
                    } else {
                    echo '
jQuery.axZm.iw="";
jQuery.axZm.ih="";
';
                    }
                    echo '</script>
                    ';
                    if (!is_bool($this->returnMakeFirstImage)) {
                        echo $this->returnMakeFirstImage;
                    }
                }
                if (!isset($_GET['str'])) {
                    if (!isset($_GET['setHW'])) {
                        $startTime = microtime(true);
                        $firstThumbSize = null;
                        $numStepPicDim = 0;
                        if (isset($zoom['config']['stepPicDim']) && is_array($zoom['config']['stepPicDim']) && !empty($zoom['config']['stepPicDim'])) {
                            foreach($zoom['config']['stepPicDim'] as $kk => $vv) {
                                if ((int)$vv['w'] && (int)$vv['h']) {
                                    $numStepPicDim++;
                                }
                            }
                        }
                        foreach ($pic_list_array as $k => $v) {
                            if (isset($zoom['config']['stepPicDim']) && is_array($zoom['config']['stepPicDim']) && !empty($zoom['config']['stepPicDim'])) {
                                $hasAllImages = true;
                                $nnn = 0;
                                foreach($zoom['config']['stepPicDim'] as $kk => $vv) {
                                    if ((int)$vv['w'] && (int)$vv['h']) {
                                        if ($zoom['config']['imgFileOpt']['noMakeFirstImage']) {
                                            $pic_list_data[$k]['thumbSize'] = $this->virtualResize($pic_list_data[$k]['imgSize'], array($zoom['config']['picX'], $zoom['config']['picY']));
                                            break;
                                        } else {
                                            $nnn++;
                                            $picDim = (int)$vv['w'].'x'.(int)$vv['h'];
                                            $thumbFileExistsJson = $this->axZm->inArrayJsonFileData($v, 'thumb', $picDim);
                                            if ($thumbFileExistsJson) {
                                                if ($nnn === 1) {
                                                    $pic_list_data[$k]['thumbSize'] = $this->virtualResize($pic_list_data[$k]['imgSize'], array((int)$vv['w'], (int)$vv['h']));
                                                }
                                            } else {
                                                $smallImgNameTemp = $this->composeFileName($v, $picDim, '_', $this->pngMod($zoom, $v));
                                                $thumbFileExistsHd = $this->axZm->fileExists($zoom, $zoom['config']['thumbDir'].$this->md5path($v, $zoom['config']['subfolderStructure']).$smallImgNameTemp);
                                                if ($thumbFileExistsHd) {
                                                    $this->axZm->updateJsonFileData($zoom, array(
                                                        'fileName' => $v,
                                                        'key' => 'thumb',
                                                        'value' => $picDim,
                                                        'isArr' => true,
                                                        'save' => true
                                                    ));
                                                } else {
                                                    $hasAllImages = false;
                                                }
                                                if (
                                                    $firstThumbSize
                                                    && (
                                                        $zoom['config']['imgFileOpt']['sameAspectRatio']
                                                        || $zoom['config']['imgFileOpt']['sameSize']
                                                        || $zoom['config']['spinMod']
                                                    )
                                                ) {
                                                    $pic_list_data[$k]['thumbSize'] = $firstThumbSize;
                                                } elseif ($nnn == 1) {
                                                    $pic_list_data[$k]['thumbSize'] = $this->virtualResize($pic_list_data[$k]['imgSize'], array( (int)$vv['w'], (int)$vv['h']));
                                                }
                                                if (!$firstThumbSize && $nnn == 1) {
                                                    $firstThumbSize = $pic_list_data[$k]['thumbSize'];
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($hasAllImages == false) {
                                    $pic_list_data[$k]['thumbSize'] = false;
                                }
                            } else {
                                if ($zoom['config']['imgFileOpt']['noMakeFirstImage']) {
                                    $pic_list_data[$k]['thumbSize'] = $this->virtualResize($pic_list_data[$k]['imgSize'], array($zoom['config']['picX'], $zoom['config']['picY']));
                                } else {
                                    $smallImgNameTemp = $this->composeFileName($v, $zoom['config']['picDim'], '_', $this->pngMod($zoom, $v));
                                    $thumbFileExistsJson = $this->axZm->inArrayJsonFileData($v, 'thumb', $zoom['config']['picDim']);
                                    $thumbFileExistsHd = false;
                                    if (!$thumbFileExistsJson) {
                                        $thumbFileExistsHd = $this->axZm->fileExists($zoom, $zoom['config']['thumbDir'].$this->md5path($v, $zoom['config']['subfolderStructure']).$smallImgNameTemp);
                                    }
                                    if ($thumbFileExistsJson || $thumbFileExistsHd) {
                                        if ($thumbFileExistsHd) {
                                            $this->axZm->updateJsonFileData($zoom, array(
                                                'fileName' => $v,
                                                'key' => 'thumb',
                                                'value' => $zoom['config']['picDim'],
                                                'isArr' => true,
                                                'save' => true
                                            ));
                                        }
                                        if (
                                            $firstThumbSize
                                            && (
                                                $zoom['config']['imgFileOpt']['sameAspectRatio']
                                                || $zoom['config']['imgFileOpt']['sameSize']
                                                || $zoom['config']['spinMod']
                                            )
                                        ) {
                                            $pic_list_data[$k]['thumbSize'] = $firstThumbSize;
                                        } else {
                                            $pic_list_data[$k]['thumbSize'] = $this->virtualResize($pic_list_data[$k]['imgSize'], array($zoom['config']['picX'], $zoom['config']['picY']));
                                        }
                                        if (!$firstThumbSize) {
                                            $firstThumbSize = $pic_list_data[$k]['thumbSize'];
                                        }
                                    } else {
                                        $pic_list_data[$k]['thumbSize'] = false;
                                    }
                                }
                            }
                        }
                        $this->readTime['smallImgSizeDimAll'] = $this->endTimeDiff($startTime);
                        $zoom['config']['pic_list_data'] = $pic_list_data;
                        if ((!isset($zoom['config']['galleryNoThumbs']) || $zoom['config']['galleryNoThumbs'] === false)
                            && !$zoom['config']['imgFileOpt']['noMakeAllThumbs']
                        ) {
                            if ($imageSlicer['enabled']) {
                                $slicerPostThumbsArr = array(
                                    'task' => 'makeAllThumbs',
                                    'zoomID' => $_GET['zoomID'],
                                    'example' => $_GET['example'],
                                    'pic' => $zoom['config']['pic'],
                                    'pic_list_data' => serialize($pic_list_data),
                                    'pic_list_array' => serialize($pic_list_array)
                                );
                                if (!empty($imageSlicer['parameters'])) {
                                    foreach ($imageSlicer['parameters'] as $a => $b) {
                                        if (isset($_GET[$b])) {
                                            $slicerPostThumbsArr[$b] = $_GET[$b];
                                        }
                                    }
                                }
                                $this->returnMakeAllThumbs = $this->httpRequestQuery(
                                    $imageSlicer['method'],
                                    $imageSlicer['host'],
                                    $imageSlicer['port'],
                                    $imageSlicer['uri'],
                                    $imageSlicer['timeout'],
                                    ($imageSlicer['method'] == 'GET' ? $slicerPostThumbsArr : array()),
                                    ($imageSlicer['method'] == 'POST' ? $slicerPostThumbsArr : array()),
                                    $imageSlicer['headers']
                                );
                            } else {
                                $startTime = microtime(true);
                                $this->returnMakeAllThumbs = $this->axZm->makeAllThumbs($zoom);
                                $this->readTime['makeAllThumbs'] = $this->endTimeDiff($startTime);
                            }
                        } else {
                            $this->returnMakeAllThumbs = false;
                        }
                    }
                    if ($zoom['config']['gPyramid'] && $zoom['config']['gPyramidDir']) {
                        $startTime = microtime(true);
                        if (!$zoom['config']['imgFileOpt']['noMakeGpyramid']) {
                            $zoomTmp['gPyramidPicDir'] = $zoom['config']['gPyramidDir'].$this->md5path( $zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).$this->getf('.',$zoom['config']['orgImgName']);
                            $zoomTmp['gPyramidPicDirExists'] = is_dir($zoomTmp['gPyramidPicDir']);
                            if (!$zoomTmp['gPyramidPicDirExists']) {
                                if ($imageSlicer['enabled']) {
                                    $slicerPostArr['task'] = 'gPyramid';
                                    $this->returnMakeZoomTiles = $this->httpRequestQuery(
                                        $imageSlicer['method'],
                                        $imageSlicer['host'],
                                        $imageSlicer['port'],
                                        $imageSlicer['uri'],
                                        $imageSlicer['timeout'],
                                        ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                                        ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                                        $imageSlicer['headers']
                                    );
                                } else {
                                    $this->returnMakeZoomTiles = $this->axZm->gPyramid($zoom);
                                }
                                if (isset($_GET['setHW']) && !is_bool($this->returnMakeZoomTiles)) {
                                    echo $this->returnMakeZoomTiles;
                                }
                            }
                        }
                        $this->readTime['gPyramid'] = $this->endTimeDiff($startTime);
                    }
                    if ($zoom['config']['pyrTiles'] && $zoom['config']['pyrTilesDir']) {
                        $startTime = microtime(true);
                        if (!$zoom['config']['imgFileOpt']['noMakeZoomTiles']
                            && (
                                $zoom['config']['orgImgSize'][0] >= $zoom['config']['tileSize']
                                || $zoom['config']['orgImgSize'][1] >= $zoom['config']['tileSize']
                            )
                        ) {
                            $this->returnMakeZoomTiles = $this->axZm->zC($zoom, false);
                            if (!$zoom['config']['imgFileOpt']['noMakeZoomTiles']
                                && !$this->tileExists($zoom, $zoom['config']['orgImgName'])
                            ) {
                                if ($imageSlicer['enabled']) {
                                    $slicerPostArr['task'] = 'makeZoomTiles';
                                    $this->returnMakeZoomTiles = $this->httpRequestQuery(
                                        $imageSlicer['method'],
                                        $imageSlicer['host'],
                                        $imageSlicer['port'],
                                        $imageSlicer['uri'],
                                        $imageSlicer['timeout'],
                                        ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                                        ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                                        $imageSlicer['headers']
                                    );
                                } else {
                                    $this->returnMakeZoomTiles = $this->axZm->makeZoomTiles($zoom);
                                }
                            }
                            if (isset($_GET['setHW']) && !is_bool($this->returnMakeZoomTiles) && $this->returnMakeZoomTiles) {
                                echo $this->returnMakeZoomTiles;
                            }
                        }
                        $this->readTime['makeZoomTiles'] = $this->endTimeDiff($startTime);
                    }
                    if (!isset($_GET['setHW']))
                    {
                        $startTime = microtime(true);
                        foreach ($pic_list_data as $k => $v) {
                            $zoom['config']['galArray'][$k]['img'] = $v['fileName'];
                            $zoom['config']['galArray'][$k]['ow'] = $v['imgSize'][0];
                            $zoom['config']['galArray'][$k]['oh'] = $v['imgSize'][1];
                            $zoom['config']['galArray'][$k]['iw'] = $v['thumbSize'][0];
                            $zoom['config']['galArray'][$k]['ih'] = $v['thumbSize'][1];
                            $zoom['config']['galArray'][$k]['tD'] = $v['thumbDescr'];
                            $zoom['config']['galArray'][$k]['fD'] = $v['fullDescr'];
                            $zoom['config']['galArray'][$k]['mf'] = false;
                            $zoom['config']['galArray'][$k]['mk'] = false;
                            if (
                                $zoom['config']['useMap']
                                && !$zoom['config']['imgFileOpt']['noMakeMapImage']
                                && $zoom['config']['mapOwnImage']
                                && $zoom['config']['mapDir']
                            ) {
                                $mapOwnImageJson = $this->axZm->inArrayJsonFileData($v['fileName'], 'map', $zoom['config']['mapOwnImage']);
                                if (!$mapOwnImageJson) {
                                    $ownImageSize = explode('x', $zoom['config']['mapOwnImage']);
                                    $ownImageName = $this->composeFileName($v['fileName'], $ownImageSize[0].'x'.$ownImageSize[1], '_', $this->pngMod($zoom, $v['fileName']));
                                    $mapOwnImageHd = $this->axZm->fileExists($zoom, $zoom['config']['mapDir'].$this->md5path($v['fileName'], $zoom['config']['subfolderStructure']).$ownImageName);
                                    if ($mapOwnImageHd) {
                                        $this->axZm->updateJsonFileData($zoom, array(
                                            'fileName' => $v['fileName'],
                                            'key' => 'map',
                                            'value' => $zoom['config']['mapOwnImage'],
                                            'isArr' => true,
                                            'unset' => false,
                                            'save' => true
                                        ));
                                    } else {
                                        $zoom['config']['galArray'][$k]['mf'] = true;
                                    }
                                }
                            }
                            if ($zoom['config']['stepPicDim']
                                && !$zoom['config']['imgFileOpt']['noMakeFirstImage']
                                && is_array($zoom['config']['stepPicDim'])
                                && !empty($zoom['config']['stepPicDim'])
                            ) {
                                foreach($zoom['config']['stepPicDim'] as $a => $b) {
                                    if ((int)$b['w'] && (int)$b['h']
                                    && !$this->axZm->fileExists($zoom, $zoom['config']['thumbDir'].$this->md5path($v['fileName'], $zoom['config']['subfolderStructure']).$this->composeFileName($v['fileName'], (int)$b['w'].'x'.(int)$b['h'], '_', $this->pngMod($zoom, $v['fileName'])))) {
                                        $zoom['config']['galArray'][$k]['mf'] = true;
                                        break;
                                    }
                                }
                            }
                            if (isset($v['path'])) {
                                $zoom['config']['galArray'][$k]['ph'] = $this->checkSlash($v['picPath'], 'add');
                            }
                            if ($zoom['config']['gPyramid'] && !$zoom['config']['imgFileOpt']['noMakeGpyramid']) {
                                if (is_dir($zoom['config']['gPyramidDir'].$this->md5path($v['fileName'], $zoom['config']['subfolderStructure']).$this->getf('.',$v['fileName']))) {
                                    $zoom['config']['galArray'][$k]['mk'] = false;
                                } else {
                                    $zoom['config']['galArray'][$k]['mk']='gP';
                                }
                            } elseif ($zoom['config']['pyrTiles'] && !$zoom['config']['imgFileOpt']['noMakeZoomTiles']) {
                                if (($v['imgSize'][0] < $zoom['config']['tileSize'] && $v['imgSize'][1] < $zoom['config']['tileSize'])
                                    || $this->tileExists($zoom, $v['fileName'])
                                ) {
                                    $zoom['config']['galArray'][$k]['mk'] = false;
                                    if ($zoom['config']['pyrAutoDetect']) {
                                        $zoom['config']['galArray'][$k]['ts'] = $this->getTileSize($zoom, $v['fileName']);
                                    }
                                } else {
                                    $zoom['config']['galArray'][$k]['mk'] = 'tL';
                                }
                            }
                        }
                        $this->readTime['galleryData'] = $this->endTimeDiff($startTime);
                    }
                }
                if (isset($pic_list_data[$_GET['zoomID']]['path'])) {
                    $zoom['config']['pic'] = $this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$_GET['zoomID']]['path'], 'add');
                }
            }
        } else {
            unset ($_GET['zoomID']);
        }
        $this->readTime['pyrAutoDetect'] = $zoom['config']['pyrAutoDetect'];
        $this->readTime['imgFileOpt'] = $zoom['config']['imgFileOpt'];
        return array($zoom, $zoomTmp);
    }
    public function seconds2time($time, $ret = 'string')
    {
        if (is_numeric($time)) {
            $value = array('years' => 0, 'days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
            if ($time >= 31556926) {
                $value['years'] = floor($time/31556926);
                $time = ($time%31556926);
            }
            if ($time >= 86400) {
                $value['days'] = floor($time/86400);
                $time = ($time%86400);
            }
            if ($time >= 3600) {
                $value['hours'] = floor($time/3600);
                $time = ($time%3600);
            }
            if ($time >= 60) {
                $value['minutes'] = floor($time/60);
                $time = ($time%60);
            }
            $value['seconds'] = floor($time);
            if ($ret == 'string') {
                $string = '';
                foreach ($value as $k => $v) {
                    if ($v > 0) {
                        $string .= $v.' '.$k.', ';
                    }
                }
                $string = substr($string, 0, -2);
                return $string;
            } else {
                return $value;
            }
        } else {
            return false;
        }
    }
    public function batchParent($el) {
        return (isset($el['DIR_PARENT'])
            && isset($_SESSION['axZmBtch']['currentDir'])
            && $el['DIR_PARENT'] === $_SESSION['axZmBtch']['currentDir']
        );
    }
    public function batchList($zoom, $pic_list_array, $pic_list_data)
    {
        $return = '';
        $thead = '<div class="leftFrameInnerHead">';
        $thead .= '<table class="leftFrameTable table">';
        $thead .= '<thead><tr>';
        $thead .= '<th class="iconWidth">';
            $thead .= '<i class="fa fa-check-square-o" aria-hidden="true" id="buttonSelectAllImagesClone"></i>';
        $thead .= '</th>';
        $thead .= '<th>Filename</th>';
        if ($zoom['batch']['arrayMake']['In']) {
            $thead .= '<th class="iconWidth">In</th>';
        }
        if ($zoom['batch']['arrayMake']['Th']) {
            $thead .= '<th class="iconWidth">Th</th>';
        }
        if ($zoom['batch']['arrayMake']['tC']) {
            $thead .= '<th class="iconWidth">tC</th>';
        }
        if ($zoom['batch']['arrayMake']['Ti']) {
            $thead .= '<th class="iconWidth">Ti</th>';
        }
        if ($zoom['batch']['allowDelete']) {
            $thead .= '<th class="iconWidth"> </th>';
        }
        $thead .= '<th style="width: 80px;">Image size</th>';
        $thead .= '<th style="width: 55px;">Filesize</th>';
        $thead .= '<th class="iconWidth">';
            $thead .= '<span onclick="jQuery.zoomBatch.reload()" class="batchReload" title="Reload images in this folder">↺</span>';
        $thead .= '</th>';
        $thead .= '</tr></thead></table>';
        $thead .= '</div>';
        $return .= '<div class="leftFrameInnerBody">';
        if (isset($_SESSION['axZmBtch']['dirTreeArray'])
            && isset($_SESSION['axZmBtch']['currentDir'])
            && isset($_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']])
            && $_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']]['DIR_SUB'] > 0
        ) {
            $return .= '<table class="leftFrameFolder table" id="leftFrameFolder"><tbody>';
            $filtered = array_filter($_SESSION['axZmBtch']['dirTreeArray'], array($this, 'batchParent'));
            if ($_SESSION['axZmBtch']['currentDir'] != 'HOME') {
                $backFolderArr = explode('_', $_SESSION['axZmBtch']['currentDir']);
                unset($backFolderArr[(count($backFolderArr) - 1)]);
                $backFolder = implode('_', $backFolderArr);
                if (count(explode('_', $backFolder)) == 1) {
                    $backFolder = 'HOME';
                }
                $return .= '<tr class="folderUpLine">';
                    $return .= '<td class="iconWidth"><i class="fa fa-level-up" aria-hidden="true" title="Level up"></i></td>';
                    $return .= '<td data-folder="'.$backFolder.'">..</td>';
                    $return .= '<td class="iconWidth">';
                        $return .= '<i class="fa fa-check-square-o" aria-hidden="true" id="buttonSelectAllFoldersClone"></i>';
                    $return .= '</td>';
                $return .= '</tr>';
            } else {
                $return .= '<tr class="folderHomeLine">';
                    $return .= '<td class="iconWidth"><i class="fa fa-home" aria-hidden="true"></i></td>';
                    $return .= '<td> <button class="btn btn-xs  pull-left" id="buttonChangeHomeDir">';
                    $return .= $_SESSION['axZmBtch']['dirTreeArray']['HOME']['DIR_PATH'].'</button></td>';
                    $return .= '<td class="iconWidth">';
                        $return .= '<i class="fa fa-check-square-o" aria-hidden="true" id="buttonSelectAllFoldersClone"></i>';
                    $return .= '</td>';
                $return .= '</tr>';
            }
            foreach ($filtered as $k => $v) {
                $return .= '<tr id="dtr'.$k.'">';
                    $return .= '<td class="iconWidth"><i class="fa fa-folder folderIcon" aria-hidden="true"></i></td>';
                    $return .= '<td data-folder="'.$k.'" style="">'.$v['DIR_NAME'].'</td>';
                    $return .= '<td class="iconWidth"><input type="checkbox" name="folders[]" id="dir'.$k.'" value="'.$k.'" class="checkBoxFolder"></td>';
                $return .= '</tr>';
            }
            $return .= '</tbody></table>';
        } elseif (isset($_SESSION['axZmBtch']['dirTreeArray'])
            && isset($_SESSION['axZmBtch']['currentDir'])
            && isset($_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']])
            && $_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']]['DIR_SUB'] == 0
        ) {
            $return .= '<table class="leftFrameFolder" id="leftFrameFolder" cellspacing="0" cellpadding="1"><tbody>';
            $backFolderArr = explode('_', $_SESSION['axZmBtch']['currentDir']);
            unset($backFolderArr[(count($backFolderArr)-1)]);
            $backFolder = implode('_', $backFolderArr);
            if (count(explode('_', $backFolder)) == 1) {
                $backFolder = 'HOME';
            }
            $return .= '<tr class="folderUpLine">';
                $return .= '<td class="iconWidth"><i class="fa fa-level-up" aria-hidden="true" title="Level up"></i></td>';
                $return .= '<td data-folder="'.$backFolder.'">..</td>';
                $return .= '<td class="iconWidth"> </td>';
            $return .= '</tr>';
            $return .= '</tbody></table>';
        }
        if (count($pic_list_array)) {
            $return .= $thead;
        }
        $return .= '<table class="leftFrameTable table" id="leftFrameTable"><tbody>';
        foreach ($pic_list_array as $k => $v) {
            $this->axZm->getJsonFileData($zoom, $v);
            $zoom['config']['orgImgSize'] = array();
            if (isset($pic_list_data[$k]['imgSize'][0])) {
                $zoom['config']['orgImgSize'][0] = $pic_list_data[$k]['imgSize'][0];
            }
            if (isset($pic_list_data[$k]['imgSize'][1])) {
                $zoom['config']['orgImgSize'][1] = $pic_list_data[$k]['imgSize'][1];
            }
            $md5path = $this->md5path($v, $zoom['config']['subfolderStructure']);
            $return .= '<tr id="d'.$k.'">';
            $return .= '<td class="iconWidth"><input type="checkbox" name="f'.$k.'" id="f'.$k.'" value="1"></td>';
            $return .= '<td id="fname'.$k.'" class="breakWords">'.$v.'</td>';
            if (isset($zoom['batch']['arrayMake']['In']) && $zoom['batch']['arrayMake']['In']) {
                $errInitPic = $this->batchNeedIn($zoom, $v);
                $return .= '<td class="iconWidth">'.((!$errInitPic) ? str_replace('<i', '<i id="In'.$k.'"', $zoom['batch']['iconOk']) : str_replace('<i', '<i id="In'.$k.'"', $zoom['batch']['iconError'])).'</td>';
            }
            if (isset($zoom['batch']['arrayMake']['Th']) && $zoom['batch']['arrayMake']['Th']) {
                $errThCheck = $this->batchNeedTh($zoom, $v);
                $errThumb = $errThCheck['errThumb'];
                $errThumbNn = $errThCheck['errThumbNn'];
                if ($errThumbNn === true) {
                    $iconThumb = $zoom['batch']['iconNn'];
                } else {
                    $iconThumb = $errThumb ? $zoom['batch']['iconError'] : $zoom['batch']['iconOk'];
                }
                $iconThumb = str_replace('<i', '<i id="Th'.$k.'"', $iconThumb);
                $return .= '<td class="iconWidth">'.$iconThumb.'</td>';
            }
            if (isset($zoom['batch']['arrayMake']['tC']) && $zoom['batch']['arrayMake']['tC']) {
                $iconThumb = $zoom['batch']['iconNn'];
                $errCache = $this->batchNeedTc($zoom, $v);
                if (isset($zoom['batch']['dynImageSizes'])
                    && is_array($zoom['batch']['dynImageSizes'])
                    && count($zoom['batch']['dynImageSizes'])
                ) {
                    $iconThumb = $errCache ? $zoom['batch']['iconError'] : $zoom['batch']['iconOk'];
                }
                $iconThumb = str_replace('<i', '<i id="tC'.$k.'"', $iconThumb);
                $return .= '<td class="iconWidth">'.$iconThumb.'</td>';
            }
            if (isset($zoom['batch']['arrayMake']['Ti']) && $zoom['batch']['arrayMake']['Ti']) {
                if ($this->axZm->doByPass($zoom)) {
                    $return .= '<td class="iconWidth">'.str_replace('<i', '<i id="Ti'.$k.'"', $zoom['batch']['iconNn']).'</td>';
                } else {
                    $return .= '<td class="iconWidth">'.($this->tileExists($zoom, $v, false) ? str_replace('<i', '<i id="Ti'.$k.'"', $zoom['batch']['iconOk']) : str_replace('<i', '<i id="Ti'.$k.'"', $zoom['batch']['iconError'])).'</td>';
                }
            }
            if (isset($zoom['batch']['allowDelete']) && $zoom['batch']['allowDelete']) {
                $return .= '<td class="iconWidth">'.str_replace('<i', '<i onclick="jQuery.zoomBatch.deleteZoom('.$k.')" title="Delete AZ cache"', $zoom['batch']['iconTrash']).'</td>';
            }
            $return .= '<td style="width: 80px;">'.$pic_list_data[$k]['imgSize'][0]." x ".$pic_list_data[$k]['imgSize'][1].'</td>';
            $return .= '<td style="width: 55px;">'.$this->zoomFileSmartSize($pic_list_data[$k]['fileSize'],1).'</td>';
            $return .= '<td class="iconWidth">'.str_replace('<i', '<i id="prev'.$k.'" data-img="'.$v.'" onclick="jQuery.zoomBatch.previewPic('.$k.',null,'.$pic_list_data[$k]['imgSize'][0].','.$pic_list_data[$k]['imgSize'][1].')" title="Preview"', $zoom['batch']['iconPicture']).'</td>';
            $return .= '</tr>';
        }
        $return .= '</tbody></table>';
        $return .= '</div>';
        return $return;
    }
    public function batchNeedIn($zoom, $v)
    {
        $md5path = $this->md5path($v, $zoom['config']['subfolderStructure']);
        $errInitPic = false;
        if (!empty($zoom['config']['stepPicDim'])) {
            foreach($zoom['config']['stepPicDim'] as $a => $b) {
                if ((int)$b['w'] && (int)$b['h']) {
                    $thumbJson = $this->axZm->inArrayJsonFileData($v, 'thumb', (int)$b['w'].'x'.(int)$b['h']);
                    if (!$thumbJson) {
                        $ffn = $zoom['config']['thumbDir'].$md5path.'/'.$this->composeFileName($v, (int)$b['w'].'x'.(int)$b['h'], '_', $this->pngMod($zoom, $v));
                        if (!$this->axZm->fileExists($zoom, $ffn)) {
                            $errInitPic = true;
                            break;
                        }
                    }
                }
            }
        } else {
            if (!$this->axZm->inArrayJsonFileData($v, 'thumb', $zoom['config']['picDim'])) {
                $ffn = $zoom['config']['thumbDir'].$md5path.$this->composeFileName($v, $zoom['config']['picDim'], '_', $this->pngMod($zoom, $v));
                if (!$this->axZm->fileExists($zoom, $ffn)) {
                    $errInitPic = true;
                };
            }
        }
        if ($zoom['config']['useMap'] && $zoom['config']['mapOwnImage']) {
            if (!$this->axZm->inArrayJsonFileData($v, 'map', $zoom['config']['mapOwnImage'])) {
                $ffn = $zoom['config']['mapDir'].$md5path.'/'.$this->composeFileName($v, $zoom['config']['mapOwnImage'], '_', $this->pngMod($zoom, $v));
                if (!$this->axZm->fileExists($zoom, $ffn)) {
                    $errInitPic = true;
                }
            }
        }
        return $errInitPic;
    }
    public function batchNeedTh($zoom, $v, $one = false)
    {
        $md5path = $this->md5path($v, $zoom['config']['subfolderStructure']);
        $errThumb = false;
        $errThumbNn = true;
        if (!$zoom['config']['galleryNoThumbs']) {
            if (!$this->axZm->inArrayJsonFileData($v, 'gallery', $zoom['config']['galleryPicDim'])) {
                if (!$errThumb && ($zoom['config']['useGallery'] || $zoom['config']['fullScreenVertGallery'])) {
                    $errThumbNn = false;
                    $thumbVertExists = $this->axZm->fileExists(
                        $zoom,
                        $zoom['config']['galleryDir'].$md5path.$this->composeFileName($v, $zoom['config']['galleryPicDim'],
                        '_',
                        $this->pngMod($zoom, $v))
                    ) ? true : false;
                    if (!$thumbVertExists) {
                        $errThumb = true;
                    }
                }
            }
            if (!$this->axZm->inArrayJsonFileData($v, 'gallery', $zoom['config']['galleryHorPicDim'])) {
                if (!$errThumb && ($zoom['config']['useHorGallery'] || $zoom['config']['fullScreenHorzGallery'])) {
                    $errThumbNn = false;
                    $thumbHorExists = $this->axZm->fileExists(
                        $zoom, $zoom['config']['galleryDir'].$md5path.$this->composeFileName($v, $zoom['config']['galleryHorPicDim'],
                        '_',
                        $this->pngMod($zoom, $v))
                    ) ? true : false;
                    if (!$thumbHorExists) {
                        $errThumb = true;
                    }
                }
            }
            if (!$this->axZm->inArrayJsonFileData($v, 'gallery', $zoom['config']['galleryFullPicDim'])) {
                if (!$errThumb && $zoom['config']['useFullGallery']) {
                    $errThumbNn = false;
                    $thumbFullExists = $this->axZm->fileExists(
                        $zoom,
                        $zoom['config']['galleryDir'].$md5path.$this->composeFileName($v, $zoom['config']['galleryFullPicDim'],
                        '_',
                        $this->pngMod($zoom, $v))
                    ) ? true : false;
                    if (!$thumbFullExists) {
                        $errThumb = true;
                    }
                }
            }
        }
        if ($one === true) {
            return $errThumb;
        }
        return array(
            'errThumb' => $errThumb,
            'errThumbNn' => $errThumbNn
        );
    }
    public function batchNeedTc($zoom, $v)
    {
        $md5path = $this->md5path($v, $zoom['config']['subfolderStructure']);
        $errCache = false;
        if (isset($zoom['batch']['dynImageSizes'])
            && is_array($zoom['batch']['dynImageSizes'])
            && count($zoom['batch']['dynImageSizes'])
        ) {
            $wtrM = isset($zoom['config']['dynamicThumbsWtrmrk']) ? $zoom['config']['dynamicThumbsWtrmrk'] : array();
            if (isset($wtrM['file']) && $wtrM['file'] && isset($wtrM['enable']) && $wtrM['enable']) {
                $wtrM['enable'] = true;
            } else {
                $wtrM['enable'] = false;
            }
            foreach ($zoom['batch']['dynImageSizes'] as $kn => $val) {
                if (isset($val['width']) && $val['width']
                    && isset($val['width']) && $val['width']
                    && isset($val['qual']) && $val['qual']
                ) {
                    if ($wtrM['enable'] && ($val['width'] < $wtrM['minWidth'] || $val['height'] < $wtrM['minHeight'])) {
                        $wtrEnable = false;
                    } elseif ($wtrM['enable']) {
                        $wtrEnable = true;
                    } else {
                        $wtrEnable = false;
                    }
                    $fNameDemo = '';
                    if (strtolower($zoom['config']['licenceType']) == 'basic'
                        && strtolower($zoom['config']['licenceKey']) == 'demo'
                    ) {
                        if ($val['width'] >= 600 || $val['height'] >= 600) {
                            $fNameDemo = '-ajaxzoom-demo-ver';
                        }
                    }
                    $cacheFileName = $this->composeFileName(
                        $v,
                        $val['width'].'-'.$val['height'].'-'.$val['qual']
                            .((isset($val['thumbMode']) && $val['thumbMode'] && $val['thumbMode'] != 'false') ? ('-' . $val['thumbMode']) : '')
                            .($wtrEnable ? '-wtrmrk' : '')
                            .$fNameDemo,
                        '_',
                        $this->pngMod($zoom, $v)
                    );
                    if (!$this->axZm->inArrayJsonFileData($v, 'cache', $cacheFileName)) {
                        $cacheFileExists = $this->axZm->fileExists(
                            $zoom,
                            $zoom['config']['tempCacheDir'].$md5path.$cacheFileName
                        ) ? true : false;
                        if (!$cacheFileExists) {
                            $errCache = true;
                        }
                    }
                }
            }
        }
        return $errCache;
    }
    public function batchNeedTi($zoom, $v)
    {
        return !$this->axZm->doByPass($zoom) && !$this->tileExists($zoom, $v, false);
    }
    public function sOptions($arr = array(), $sel = false, $opr = false, $add = false)
    {
        $return = array();
        $oneD = false;
        $n = 0;
        foreach ($arr as $k => $v) {
            if ($n == 0) {
                $oneD = ($k === 0) ? true : false;
            }
            $n++;
            if ($oneD === true) {
                $k = $v;
            }
            $return .= '<option value="'.$k.'"';
            if ($k == $sel || $v == $sel) {
                $return .= ' selected';
            }
            $return .= '>';
            if (is_callable($opr) && function_exists($opr)) {
                $return .= $opr($v);
            } else {
                $return .= $v;
            }
            if ($add) {
                $return .= ' '.$add;
            }
            $return .= '</option>';
        }
        return $return;
    }
    public function removeAxZm($zoom, $pic, $arrDel = array(), $self = false)
    {
        $pic = str_replace('\\', '/', $pic);
        if (strstr($pic, '/')) {
            $pic = $this->getl('/', $pic);
        }
        $picName = $this->getf('.', $pic);
        $subPath = $this->md5path($pic, $zoom['config']['subfolderStructure']);
        $delAllAz = isset($arrDel['All']) && $arrDel['All'] == true;
        $this->axZm->getJsonFileData($zoom, $pic);
        if ($delAllAz || (isset($arrDel['In']) && $arrDel['In'] == true)) {
            if (is_dir($zoom['config']['thumbDir'])) {
                $globResult = glob($this->checkSlash($zoom['config']['thumbDir'], 'add').$subPath.$picName.'_*.*');
                if (!empty($globResult)) {
                    foreach ($globResult as $file) {
                        $fileName = $this->getf('_', $this->getf('.', $this->getl('/',$file)));
                        if ($fileName == $picName) {
                            unlink($file);
                        }
                    }
                    if (isset($this->jsonData[$pic]['thumb'])) {
                        unset($this->jsonData[$pic]['thumb']);
                    }
                }
            }
        }
        if ($delAllAz || (isset($arrDel['Th']) && $arrDel['Th'] == true)) {
            $zoom['config']['galleryDir'] = $this->checkSlash($zoom['config']['galleryDir'], 'add');
            if (is_dir($zoom['config']['galleryDir'])) {
                $globResult = glob($this->checkSlash($zoom['config']['galleryDir'], 'add').$subPath.$picName.'_*.*');
                if (!empty($globResult)) {
                    foreach ($globResult as $file) {
                        $fileName = $this->getf('_',$this->getf('.', $this->getl('/',$file)));
                        if ($fileName == $picName) {
                            unlink($file);
                        }
                    }
                }
                if (isset($this->jsonData[$pic]['gallery'])) {
                    unset($this->jsonData[$pic]['gallery']);
                }
            }
        }
        if ($delAllAz || (isset($arrDel['tC']) && $arrDel['tC'] == true)) {
            $subPathDynThumb = $this->md5path($pic, $zoom['config']['dynamicThumbsStructure']);
            $zoom['config']['tempCacheDir'] = $this->checkSlash($zoom['config']['tempCacheDir'], 'add');
            if (is_dir($zoom['config']['tempCacheDir'])) {
                $globResult = glob($this->checkSlash($zoom['config']['tempCacheDir'], 'add').$subPathDynThumb.$picName.'_*.*');
                if (!empty($globResult)) {
                    foreach ($globResult as $file) {
                        $fileName = $this->getf('_',$this->getf('.',$this->getl('/',$file)));
                        if ($fileName == $picName) {
                            unlink($file);
                        }
                    }
                }
                if (isset($this->jsonData[$pic]['cache'])) {
                    unset($this->jsonData[$pic]['cache']);
                }
            }
        }
        if ($delAllAz || (isset($arrDel['mO']) && $arrDel['mO'] == true)) {
            $zoom['config']['mapDir'] = $this->checkSlash($zoom['config']['mapDir'], 'add');
            if (is_dir($zoom['config']['mapDir'])) {
                $globResult = glob($this->checkSlash($zoom['config']['mapDir'], 'add').$subPath.$picName.'_*.*');
                if (!empty($globResult)) {
                    foreach ($globResult as $file) {
                        $fileName = $this->getf('_',$this->getf('.',$this->getl('/',$file)));
                        if ($fileName == $picName) {
                            unlink($file);
                        }
                    }
                }
                if (isset($this->jsonData[$pic]['map'])) {
                    unset($this->jsonData[$pic]['map']);
                }
            }
        }
        if ($delAllAz || (isset($arrDel['gP']) && $arrDel['gP'] == true)) {
            $zoom['config']['gPyramidDir'] = $this->checkSlash($zoom['config']['gPyramidDir'], 'add');
            if (is_dir($zoom['config']['gPyramidDir'])) {
                if (is_dir($zoom['config']['gPyramidDir'].$subPath.$picName)) {
                    $handle = opendir($zoom['config']['gPyramidDir'].$subPath.$picName);
                    if (is_resource($handle)) {
                        while (false !== ($file = readdir($handle))) {
                            if (is_file($zoom['config']['gPyramidDir'].$subPath.$picName.'/'.$file)) {
                                unlink($zoom['config']['gPyramidDir'].$subPath.$picName.'/'.$file);
                            }
                        }
                    }
                    closedir($handle);
                    rmdir($zoom['config']['gPyramidDir'].$subPath.$picName);
                    if (isset($this->jsonData[$pic]['gPyr'])) {
                        unset($this->jsonData[$pic]['gPyr']);
                    }
                }
            }
        }
        if ($delAllAz || (isset($arrDel['Ti']) && $arrDel['Ti'] == true)) {
            $zoom['config']['pyrTilesDir'] = $this->checkSlash($zoom['config']['pyrTilesDir'], 'add');
            if (is_dir($zoom['config']['pyrTilesDir'])) {
                if (is_dir($zoom['config']['pyrTilesDir'].$subPath.$picName)) {
                    $handle = opendir($zoom['config']['pyrTilesDir'].$subPath.$picName);
                    if (is_resource($handle)) {
                        while (false !== ($file = readdir($handle))) {
                            if (is_file($zoom['config']['pyrTilesDir'].$subPath.$picName.'/'.$file)) {
                                unlink($zoom['config']['pyrTilesDir'].$subPath.$picName.'/'.$file);
                            }
                        }
                    }
                    closedir($handle);
                    rmdir($zoom['config']['pyrTilesDir'].$subPath.$picName);
                    if (isset($this->jsonData[$pic]['tiles'])) {
                        unset($this->jsonData[$pic]['tiles']);
                    }
                }
            }
        }
        if ($self === true) {
            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['picDir'], 'add');
            if ($this->axZm->fileExists($zoom, $zoom['config']['picDir'].$pic)) {
                unlink($zoom['config']['picDir'].$pic);
            }
            $this->axZm->deleteJsonFileData($zoom, $pic);
        } else {
            if (isset($arrDel['json']) && $arrDel['json'] == true) {
                $this->axZm->deleteJsonFileData($zoom, $pic);
            } else {
                $this->axZm->writeJsonFileData($zoom, $pic);
            }
        }
        return;
    }
    public function delteZoomCache($cacheDir, $maxTime)
    {
        if ($maxTime < 300) {
            $maxTim = 300;
        }
        $dateNow = strtotime('now');
        foreach (glob($cacheDir.'*.{jpg,png}', GLOB_BRACE) as $fname) {
            if (strpos($fname, 'zoom_') == true) {
                if (($dateNow - filemtime($fname)) > $maxTime) {
                    unlink($fname);
                }
            }
        }
    }
    public function deleteCropThumbsCache($zoom, $file)
    {
    }
    public function checkFpPPdata($string, $fpPP)
    {
        if ($fpPP && is_string($fpPP) && $string && is_string($string)) {
            $fpPPLen = strlen($fpPP);
            if ($fpPPLen > 1 && substr($string, 0, $fpPPLen) == $fpPP) {
                $string = substr($string, $fpPPLen);
            }
        }
        return $string;
    }
    public function checkSlash($input, $mode = false)
    {
        $input = str_replace('\\', '/', $input);
        $doubleSlashBegin = (substr($input, 0 ,2) == '//');
        $input = preg_replace('/\/+/', '/', $input);
        if ($doubleSlashBegin && defined('PHALANGER') && defined('PHALANGER_DOUBLE_SLASH_FIX')) {
            $input = '/'.$input;
        }
        if ($mode == 'remove') {
            if (substr($input, -1) == '/') {
                $input = substr($input, 0, -1);
            }
        } elseif ($mode == 'add') {
            if (substr($input, -1) != '/' && strlen($input) > 0) {
                $input .= '/';
            }
        }
        return $input;
    }
    public function ptj($a)
    {
        if ($a === true) {
            return 'true';
        } elseif ($a === false) {
            return 'false';
        } elseif (is_int($a) || is_float($a) || stristr($a, '}')) {
            return $a;
        } elseif ($a) {
            $a = str_replace("\n", '', $a);
            $a = preg_replace('/\s+/', ' ', $a);
            return "'".$a."'";
        } else {
            return "''";
        }
    }
    public function zoomFileSmartSize($integer = 0, $digits = 2)
    {
        if (!$integer) {
            $integer = 0;
        }
        settype($integer, 'int');
        settype($digits, 'int');
        if ($integer >= 1048576) {
            $integer = round(($integer/1024000), $digits) . ' MB';
        } elseif ($integer >= 1024) {
            $integer = round(($integer/1024), 0) . ' KB';
        } elseif ($integer >= 0) {
            $integer = $integer . ' BYTES';
        } else {
            $integer = '0 BYTES';
        }
        return $integer;
    }
    public function getl($char, $str)
    {
        $pos = strrpos($str, $char);
        $ext = substr($str, $pos+1);
        return $ext;
    }
    public function getf($char, $str)
    {
        $pos = strrpos($str, $char);
        $ext = substr($str, 0, $pos);
        return $ext;
    }
    public function composeFileName($file, $ext, $sep, $fType = 'jpg')
    {
        $return = $this->getf('.',$file);
        $return .= $sep;
        $return .= $ext;
        $return .= '.';
        $return .= $fType;
        return $return;
    }
    public function natIndex($array, $reverse = false)
    {
        $i = 1;
        $nArray = array();
        natcasesort($array);
        if ($reverse) {
            $array = array_reverse($array);
        }
        foreach ($array as $k => $v) {
            $nArray[$i] = $v;
            $i++;
        }
        return $nArray;
    }
    public function rndNum($len)
    {
        $return = '';
        $passwordChars = '0123456789'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'abcdefghijklmnopqrstuvwxyz';
        for ($index = 1; $index <= $len; $index++) {
            $randomNumber = rand(1, strlen($passwordChars));
            $return .= substr($passwordChars, $randomNumber - 1, 1);
        }
        return $return;
    }
    public function chmodAllDir($path, $mode)
    {
        $chmodArray = array(0600, 0644, 0755, 0750, 0777);
        if (in_array($mode,$chmodArray)) {
            foreach (glob($path.'*', GLOB_ONLYDIR) as $dirName) {
                chmod($dirName, $mode);
            }
        }
    }
    public function numeric_to_utf8($t)
    {
        if (function_exists('mb_decode_numericentity')) {
            $convmap = array(0x0, 0x2FFFF, 0, 0xFFFF);
            return mb_decode_numericentity($t, $convmap, 'UTF-8');
        } else {
            return $t;
        }
    }
    public function arrayToJSArray($phpArray, $jsArrayName, &$html = '')
    {
        $html .= $jsArrayName . '=new Array();';
        if (is_array($phpArray) && !empty($phpArray)) {
            foreach ($phpArray as $key => $value) {
                $outKey = (is_int($key)) ? '[' . $key . ']' : "['" . $key . "']";
                if (is_array($value)) {
                    $this->arrayToJSArray($value, $jsArrayName . $outKey, $html);
                    continue;
                }
                $html .= $jsArrayName . $outKey . '=';
                if (is_string($value)) {
                    $html .= "'" . $value . "';";
                } elseif ($value === false) {
                    $html .= 'false;';
                } elseif ($value === null) {
                    $html .= 'null;';
                } elseif ($value === true) {
                    $html .= 'true;';
                } else {
                    $html .= "'".$value . "';";
                }
            }
        }
        return $html;
    }
    public function arrayToJSObject($array, $varname, $sub = false, $rn = false, $string = false)
    {
        $rnStr='';
        if ($rn) {
            $rnStr = "\n";
        }
        if (!$sub && !is_array($array)) {
            return $varname . ' = ' . $this->ptj($array);
        }
        $jsarray = $sub ? $varname . "{" : $varname . " = {".$rnStr;
        $varname = "\t$varname";
        if (is_array($array)) {
            reset ($array);
        }
        $temp = array();
        while (list($key, $value) = @each($array)) {
            $jskey = "'" . $key . "': ";
            if (is_array($value)) {
                $temp[] = $this->arrayToJSObject($value, $jskey, true, $rn, $string);
            } else {
                if (is_numeric($value) && !$string) {
                    $jskey .= $value;
                } elseif (is_bool($value) && !$string) {
                    $jskey .= ($value ? 'true' : 'false') . '';
                } elseif ($value === NULL) {
                    $jskey .= 'null';
                } else {
                    static $pattern = array("\\", "'", "\r", "\n");
                    static $replace = array('\\', '\\\'', '\r', '\n');
                    $jskey .= "'" . str_replace($pattern, $replace, $value) . "'";
                }
                $temp[] = $jskey;
            }
        }
        $jsarray .= implode(', ', $temp);
        $jsarray .= '}'.$rnStr;
        return $jsarray;
    }
    public function virtualResize($oSize = array(), $rSize = array())
    {
        $w = $rSize[0];
        $h = $rSize[1];
        $sw = $oSize[0];
        $sh = $oSize[1];
        if ($sw == 0 || $sh == 0) {
            return array(900, 900);
        }
        if (($w / $sw) > ($h / $sh)) {
            $prc = $h / $sh;
        } else {
            $prc = $w/$sw;
        }
        $w = round($sw * $prc);
        $h = round($sh * $prc);
        return array($w, $h);
    }
    public function zoomServerPar($ret, $parExcl = false, $parExclPreg = false, $queryString = false)
    {
        $return=array();
        if (!$parExcl && !is_array($parExcl) && !$parExclPreg && is_string($queryString)) {
            return $queryString;
        }
        $parExclDefault = array('zoomID', 'zoomFile', 'zoomLoadAjax', 'loadZoomAjaxSet', 'load360AjaxSet', '_');
        if (is_array($parExcl)) {
            $parExcl = array_merge($parExcl, $parExclDefault);
        }
        if (!$queryString) {
            $queryString = $_SERVER['QUERY_STRING'];
        }
        if ($queryString) {
            if (is_array($queryString)) {
                $parArr = $queryString;
            } else {
                $parArr = explode('&', $queryString);
            }
            foreach ($parArr as $key => $par) {
                if (is_array($queryString)) {
                    $k = $key;
                    $v = $par;
                } else {
                    $kv = explode('=', $par);
                    $k = $kv[0];
                    $v = $kv[1];
                }
                if ($k) {
                    $v = str_replace('\\', '\\\\', $v);
                    if (is_array($parExcl)) {
                        if (!in_array($k, $parExcl)) {
                            $returnArray[$k] = $v;
                        }
                    } elseif (is_string($parExcl)) {
                        if ($parExcl != $k) {
                            $returnArray[$k] = $v;
                        }
                    }
                }
            }
            if (is_array($parExclPreg) && !empty($returnArray)) {
                $returnArrayTemp = $returnArray;
                foreach ($parExclPreg as $k) {
                    foreach ($returnArrayTemp as $kk => $vv) {
                        if (stristr($kk, $k)) {
                            unset($returnArray[$kk]);
                        }
                    }
                }
            }
            if (!empty($returnArray)) {
                if ($ret == 'arr') {
                    return $returnArray;
                } elseif ($ret == 'str') {
                    $strArray = array();
                    foreach ($returnArray as $k => $v) {
                        array_push($strArray, $k.'='.$v);
                    }
                    return implode('&', $strArray);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    final function isAvailable($func)
    {
        if (ini_get('safe_mode')) {
            return false;
        }
        $disabled = ini_get('disable_functions');
        if ($disabled) {
            $disabled = explode(',', $disabled);
            $disabled = array_map('trim', $disabled);
            return !in_array($func, $disabled);
        }
        return true;
    }
    final function whichConvert($path)
    {
        if ($path == 'which convert' && $this->isAvailable('exec')) {
            exec("type convert", $ret);
            if ($ret[0] && stristr($ret[0], 'convert')) {
                $newArr = explode(' ', $ret[0]);
                if ($newArr[2]) {
                    return $newArr[2];
                } else {
                    return 'convert';
                }
            } else {
                exec("which convert", $ret);
                if ($ret[0] && stristr($ret[0], 'convert')) {
                    return $ret[0];
                } else {
                    return 'convert';
                }
            }
        } else {
            return $path;
        }
    }
    private function imQuotes($zoom, $command)
    {
        if (stristr(PHP_OS, 'win') && !$zoom['config']['imQuotes']) {
            $zoom['config']['imQuotes'] = 'replace';
        }
        if ($zoom['config']['imQuotes'] == 'remove') {
            $command = str_replace('\'', '', $command);
        } elseif ($zoom['config']['imQuotes'] == 'replace') {
            $command = str_replace('\'', '"', $command);
        }
        return $command;
    }
    public function drawZoomStyle($zoom)
    {
        $return = '';
        $jsPath = $zoom['config']['js'];
        $cssLink = array();
        array_push($cssLink, 'axZm.css');
        if (!isset($zoom['config']['jsUiSuppressCSS'])) {
            $zoom['config']['jsUiSuppressCSS'] = false;
        }
        if (!$zoom['config']['jsUiSuppressCSS']) {
            if ($zoom['config']['jsUiAll']) {
                array_push($cssLink, 'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery-ui.css');
            } else {
                array_push($cssLink, 'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery.ui.core.css');
                array_push($cssLink, 'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery.ui.theme.css');
                array_push($cssLink, 'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery.ui.slider.css');
            }
        }
        if ($zoom['config']['visualConf']) {
            array_push($cssLink, 'plugins/demo/axZm.demo.css');
            array_push($cssLink, 'plugins/demo/colorpicker/css/colorpicker.css');
        }
        foreach ($cssLink as $k => $v) {
            $return .= "\n<link rel=\"stylesheet\" href=\"".$jsPath.$v."\" media=\"screen\" type=\"text/css\">";
        }
        $return .= "\n";
        return $return;
    }
    public function drawZoomJs($zoom, $exclude = array())
    {
        $return = '';
        $jsPath = $zoom['config']['js'];
        $min = $zoom['config']['jsMin'];
        $js = array();
        if (!in_array('jquery',$exclude)) {
            array_push($js, 'plugins/jquery-1.8.3.js');
        }
        if (!isset($zoom['config']['jsUiSuppressJS'])) {
            $zoom['config']['jsUiSuppressJS'] = false;
        }
        if (!$zoom['config']['jsUiSuppressJS']) {
            if ($zoom['config']['jsUiAll']) {
                array_push($js, 'plugins/jquery.ui/js/jquery-ui-'.$zoom['config']['jsUiVer'].'.custom.js');
            } else {
                array_push($js, 'plugins/jquery.ui/js/jquery-ui-'.$zoom['config']['jsUiVer'].'.axZm.js');
            }
        }
                if (!in_array('mousewheel',$exclude)) {
            array_push($js, 'plugins/jquery.mousewheel.js');
        }
        if (!in_array('axZm',$exclude)) {
            array_push($js, 'jquery.axZm.js?azVer='.$zoom['config']['version']);
        }
        if ($zoom['config']['visualConf']) {
            if (!in_array('scrollTo',$exclude)) {
                array_push($js, 'plugins/jquery.scrollTo.js');
            }
            if (!in_array('colorpicker', $exclude)) {
                array_push($js, 'plugins/demo/colorpicker/js/colorpicker.js');
            }
            if (!in_array('form', $exclude)) {
                array_push($js, 'plugins/demo/jquery.form.js');
            }
            if (!in_array('axZmDemo', $exclude)) {
                array_push($js, 'plugins/demo/jquery.axZm.demo.js');
            }
        }
        foreach ($js as $k => $v) {
            if ($min && !stristr($v, 'axZm')) {
                $v = $this->getf('.', $v).'.min.js';
            }
            $return .= "\n<script type=\"text/javascript\" src=\"$jsPath$v\"></script>";
        }
        $return .= "\n";
        if ($zoom['config']['visualConf']) {
            $return .= "
<script type=\"text/javascript\">
jQuery.optSubmit = function(){
jQuery.ajaxSubmitCustom('demoOptions', 'zoomOpr', '".$zoom['config']['installPath']."/axZm/zoomVisualConf.inc.php');
};
</script>
            ";
        }
        return $return;
    }
    public function drawZoomJsLoad($zoom, $pack = false, $windowLoad = true, $jsObject = '{}')
    {
        $js='';
        if (!$jsObject) {
            $jsObject = '{}';
        }
        if ($windowLoad) {
            $js = 'jQuery(window).load(function() {
jQuery.fn.axZm('.$jsObject.');
            ';
        } else {
            $js='
jQuery.fn.axZm('.$jsObject.');
            ';
        }
        if ($zoom['config']['visualConf']) {
            $js .= '
jQuery(\'#demoOptions\').ajaxForm();
jQuery.colPick(\'demoColorStage\',\'demoColorStage\');
jQuery.colPick(\'demoBodyColor\',\'demoBodyColor\');
jQuery.colPick(\'demoColorArea\',\'demoColorArea\');
jQuery.colPick(\'demoColorOuter\',\'demoColorOuter\');
jQuery.colPick(\'demoColorBorder\',\'demoColorBorder\');
jQuery.demoAnm = true;
jQuery(\'#zoomAjaxDemoButton\').click(function () {
    jQuery(\'#zoomAjaxDemo\').slideToggle(300);
});
jQuery(\'#zoomAjaxDemoButton\').mouseover(function () {
jQuery(this).css(\'color\',\'#F4E10A\');
}).mouseout(function () {
    jQuery(this).css(\'color\',\'#FFFFFF\');
});
            ';
        }
        if ($windowLoad) {
            $js .= '
});';
        }
        if ($pack) {
            $myPacker = new JavaScriptPacker($js, 'Normal', true, false);
            $js = $myPacker->pack();
        }
        return '<script type="text/javascript">'.$js.'</script>';
    }
    public function drawZoomJsConf($zoom, $rn = false, $pack = true)
    {
        $startTime = microtime(true);
        $rnStr = '';
        if ($rn) {
            $rnStr = "\n";
        }
        $js = 'if (jQuery.axZm){delete jQuery.axZm;} jQuery.axZm = {}; ';
        $js .= 'jQuery.axZm.lang = '.$this->ptj($zoom['config']['lang']).'; ';
        $js .= 'jQuery.axZm.zoomID = '.$this->ptj(isset($_GET['zoomID']) ? $_GET['zoomID'] : 0).'; ';
        $js .= 'jQuery.axZm.pZoomID = '.$this->ptj(isset($zoom['config']['pZoomID']) ? $zoom['config']['pZoomID'] : 0).'; ';
        $js .= 'jQuery.axZm.randNum = '.$this->ptj($this->rndNum(24)).'; ';
        $js .= 'jQuery.axZm.icon = '.$this->ptj($zoom['config']['icon']).'; ';
        $js .= 'jQuery.axZm.iconDir = '.$this->ptj($zoom['config']['icon']).'; ';
        $js .= 'jQuery.axZm.js = '.$this->ptj($zoom['config']['js']).'; ';
        $js .= 'jQuery.axZm.jsDir = '.$this->ptj($zoom['config']['js']).'; ';
        $js .= 'jQuery.axZm.jsDynLoad = '.$this->ptj($zoom['config']['jsDynLoad']).'; ';
        $js .= 'jQuery.axZm.jsMin = '.$this->ptj($zoom['config']['jsMin']).'; ';
        $js .= 'jQuery.axZm.jsUiAll = '.$this->ptj($zoom['config']['jsUiAll']).'; ';
        $js .= 'jQuery.axZm.jsUiVer = '.$this->ptj($zoom['config']['jsUiVer']).'; ';
        $js .= 'jQuery.axZm.jsUiTheme = '.$this->ptj($zoom['config']['jsUiTheme']).'; ';
        $js .= 'jQuery.axZm.jsUiSuppressJS = '.$this->ptj($zoom['config']['jsUiSuppressJS']).'; ';
        $js .= 'jQuery.axZm.jsUiSuppressCSS = '.$this->ptj($zoom['config']['jsUiSuppressCSS']).'; ';
        $js .= 'jQuery.axZm.thumbs = '.$this->ptj($zoom['config']['thumbs']).'; ';
        $js .= 'jQuery.axZm.smallImgPath = '.$this->ptj($zoom['config']['thumbs']).'; ';
        if (isset($zoom['config']['thumbs']) && isset($zoom['config']['smallImgName'])) {
            $js .= 'jQuery.axZm.smallImg = '.$this->ptj($zoom['config']['thumbs'].$this->md5path($zoom['config']['smallImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName']).'; ';
        } else {
            $js .= 'jQuery.axZm.smallImg = '.$this->ptj('undefined').'; ';
        }
        if ($zoom['config']['cropNoObj'] && isset($zoom['config']['pic'])) {
            $js .= 'jQuery.axZm.pic = '.$this->ptj($zoom['config']['pic']).'; ';
            $js .= 'jQuery.axZm.orgPath = '.$this->ptj($zoom['config']['pic']).'; ';
        }
        $js .= 'jQuery.axZm.imgProcessTimeOut = '.$this->ptj($zoom['config']['imgProcessTimeOut']).'; ';
        if (isset($zoom['config']['smallImgSize']) && isset($zoom['config']['smallImgSize'][0]) && isset($zoom['config']['smallImgSize'][1])) {
            $js .= 'jQuery.axZm.iw = '.$this->ptj($zoom['config']['smallImgSize'][0]).'; ';
            $js .= 'jQuery.axZm.ih = '.$this->ptj($zoom['config']['smallImgSize'][1]).'; ';
        } else {
            $js .= 'jQuery.axZm.iw = 400; ';
            $js .= 'jQuery.axZm.ih = 400; ';
        }
        if (isset($zoom['config']['orgImgSize']) && isset($zoom['config']['orgImgSize'][0]) && isset($zoom['config']['orgImgSize'][1])) {
            $js .= 'jQuery.axZm.ow = '.$this->ptj($zoom['config']['orgImgSize'][0]).'; ';
            $js .= 'jQuery.axZm.oh = '.$this->ptj($zoom['config']['orgImgSize'][1]).'; ';
        } else {
            $js .= 'jQuery.axZm.ow = 400; ';
            $js .= 'jQuery.axZm.oh = 400; ';
        }
        if (isset($zoom['config']['smallFileSize'])) {
            $js .= 'jQuery.axZm.smallFileSize = '.$this->ptj($zoom['config']['smallFileSize']).'; ';
        }
        $js .= 'jQuery.axZm.parToPass = '.$this->ptj($zoom['config']['parToPass']).'; ';
        $js .= 'jQuery.axZm.domain = '.$this->ptj($zoom['config']['domain']).'; ';
        $js .= 'jQuery.axZm.visualConf = '.$this->ptj($zoom['config']['visualConf']).'; ';
        $js .= 'jQuery.axZm.errors = '.$this->ptj($zoom['config']['errors']).'; ';
        $js .= 'jQuery.axZm.keepBoxW = '.$this->ptj($zoom['config']['keepBoxW']).'; ';
        $js .= 'jQuery.axZm.keepBoxH = '.$this->ptj($zoom['config']['keepBoxH']).'; ';
        $js .= 'jQuery.axZm.boxW = '.$this->ptj($zoom['config']['picX']).'; ';
        $js .= 'jQuery.axZm.boxH = '.$this->ptj($zoom['config']['picY']).'; ';
        $js .= 'jQuery.axZm.picDim = '.$this->ptj($zoom['config']['picDim']).'; ';
        $js .= 'jQuery.axZm.gravity = '.$this->ptj($zoom['config']['gravity']).'; ';
        $js .= 'jQuery.axZm.traverseGravity = '.$this->ptj($zoom['config']['traverseGravity']).'; ';
        $js .= 'jQuery.axZm.disableZoom = '.$this->ptj($zoom['config']['disableZoom']).'; ';
        $js .= $this->arrayToJSArray($zoom['config']['disableZoomExcept'], 'jQuery.axZm.disableZoomExcept').'; ';
        $js .= 'jQuery.axZm.disableClickZoom = '.$this->ptj($zoom['config']['disableClickZoom']).'; ';
        $js .= 'jQuery.axZm.pinchZoomOnlyDrag = '.$this->ptj($zoom['config']['pinchZoomOnlyDrag']).'; ';
        $js .= 'jQuery.axZm.touchPageScollDisable = '.$this->ptj($zoom['config']['touchPageScollDisable']).'; ';
        $js .= 'jQuery.axZm.pngMode = '.$this->ptj($zoom['config']['pngMode']).'; ';
        $js .= 'jQuery.axZm.pngKeepTransp = '.$this->ptj($zoom['config']['pngKeepTransp']).'; ';
        $js .= 'jQuery.axZm.forceToPan = '.$this->ptj($zoom['config']['forceToPan']).'; ';
        $js .= 'jQuery.axZm.forceToPanClickDisable = '.$this->ptj($zoom['config']['forceToPanClickDisable']).'; ';
        $js .= 'jQuery.axZm.pyrByPass = '.$this->ptj($zoom['config']['pyrByPass']).'; ';
        $js .= 'jQuery.axZm.tileSize = '.$this->ptj($zoom['config']['tileSize']).'; ';
        $js .= 'jQuery.axZm.tileOverlap = '.$this->ptj($zoom['config']['tileOverlap']).'; ';
        if ($zoom['config']['pyrTiles']) {
            if ($zoom['config']['pyrAutoDetect']) {
                $zoom['config']['tileSize'] = $this->getTileSize($zoom, $zoom['config']['orgImgName']);
            }
        }
        $js .= 'jQuery.axZm.pyrLoadTiles = '.$this->ptj($zoom['config']['pyrLoadTiles']).'; ';
        if ($zoom['config']['pyrLoadTiles']) {
            $js .= 'jQuery.axZm.pyrTilesExtend = '.$this->ptj($zoom['config']['pyrTilesExtend']).'; ';
            $js .= 'jQuery.axZm.pyrTilesPath = '.$this->ptj($zoom['config']['pyrTilesPath']).'; ';
            $js .= 'jQuery.axZm.pyrTilesFadeInSpeed = '.$this->ptj($zoom['config']['pyrTilesFadeInSpeed']).'; ';
            $js .= 'jQuery.axZm.pyrTilesFadeLoad = '.$this->ptj($zoom['config']['pyrTilesFadeLoad']).'; ';
            $js .= 'jQuery.axZm.pyrTilesForce = '.$this->ptj($zoom['config']['pyrTilesForce']).'; ';
        }
        $js .= 'jQuery.axZm.useMap = '.$this->ptj($zoom['config']['useMap']).'; ';
        $js .= 'jQuery.axZm.mapPath = '.$this->ptj($zoom['config']['mapPath']).'; ';
        $js .= 'jQuery.axZm.mapOwnImage = '.$this->ptj($zoom['config']['mapOwnImage']).'; ';
        $js .= 'jQuery.axZm.mapFract = '.$this->ptj($zoom['config']['mapFract']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['mapBorder'], 'jQuery.axZm.mapBorder', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.zoomMapVis = '.$this->ptj($zoom['config']['zoomMapVis']).'; ';
        $js .= 'jQuery.axZm.dragMap = '.$this->ptj($zoom['config']['dragMap']).'; ';
        $js .= 'jQuery.axZm.mapHolderHeight = '.$this->ptj($zoom['config']['mapHolderHeight']).'; ';
        $js .= 'jQuery.axZm.mapHolderText = '.$this->ptj($zoom['config']['mapHolderText']).'; ';
        $js .= 'jQuery.axZm.zoomMapDragOpacity = '.$this->ptj($zoom['config']['zoomMapDragOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomMapSelOpacity = '.$this->ptj($zoom['config']['zoomMapSelOpacity'] ).'; ';
        $js .= 'jQuery.axZm.zoomMapSelBorder = '.$this->ptj($zoom['config']['zoomMapSelBorder'] ).'; ';
        $js .= 'jQuery.axZm.zoomMapContainment = '.$this->ptj($zoom['config']['zoomMapContainment']).'; ';
        $js .= 'jQuery.axZm.mapButton = '.$this->ptj($zoom['config']['mapButton']).'; ';
        $js .= 'jQuery.axZm.mapPos = '.$this->ptj($zoom['config']['mapPos']).'; ';
        $js .= 'jQuery.axZm.zoomMapRest = '.$this->ptj($zoom['config']['zoomMapRest'] ).'; ';
        $js .= 'jQuery.axZm.zoomMapAnimate = '.$this->ptj($zoom['config']['zoomMapAnimate'] ).'; ';
        $js .= 'jQuery.axZm.zoomMapSwitchSpeed = '.$this->ptj($zoom['config']['zoomMapSwitchSpeed'] ).'; ';
        $js .= 'jQuery.axZm.mapSelSmoothDrag = '.$this->ptj($zoom['config']['mapSelSmoothDrag'] ).'; ';
        $js .= 'jQuery.axZm.mapSelSmoothDragSpeed = '.$this->ptj($zoom['config']['mapSelSmoothDragSpeed'] ).'; ';
        $js .= 'jQuery.axZm.mapSelSmoothDragMotion = '.$this->ptj($zoom['config']['mapSelSmoothDragMotion'] ).'; ';
        $js .= 'jQuery.axZm.mapSelZoomSpeed = '.$this->ptj($zoom['config']['mapSelZoomSpeed'] ).'; ';
        $js .= 'jQuery.axZm.mapSelClickZoomOut = '.$this->ptj($zoom['config']['mapSelClickZoomOut']).'; ';
        $js .= 'jQuery.axZm.mapParent = '.$this->ptj($zoom['config']['mapParent']).'; ';
        $js .= 'jQuery.axZm.mapParCenter = '.$this->ptj($zoom['config']['mapParCenter']).'; ';
        $js .= 'jQuery.axZm.mapWidth = '.$this->ptj($zoom['config']['mapWidth']).'; ';
        $js .= 'jQuery.axZm.mapHeight = '.$this->ptj($zoom['config']['mapHeight']).'; ';
        $js .= 'jQuery.axZm.mapMouseOver = '.$this->ptj($zoom['config']['mapMouseOver']).'; ';
        $js .= 'jQuery.axZm.mapMouseWheel = '.$this->ptj($zoom['config']['mapMouseWheel']).'; ';
        $js .= 'jQuery.axZm.mapHorzMargin = '.$this->ptj($zoom['config']['mapHorzMargin']).'; ';
        $js .= 'jQuery.axZm.mapVertMargin = '.$this->ptj($zoom['config']['mapVertMargin']).'; ';
        $js .= 'jQuery.axZm.mapOpacity = '.$this->ptj($zoom['config']['mapOpacity']).'; ';
        $js .= 'jQuery.axZm.mapClickZoom = '.$this->ptj($zoom['config']['mapClickZoom']).'; ';
        $js .= 'jQuery.axZm.galleryPicQual = '.$this->ptj($zoom['config']['galleryPicQual']).'; ';
        $js .= 'jQuery.axZm.gallery = '.$this->ptj($zoom['config']['gallery']).'; ';
        $js .= 'jQuery.axZm.zoomGalDir = '.$this->ptj($zoom['config']['gallery']).'; ';
        $js .= 'jQuery.axZm.galleryNoThumbs = '.$this->ptj($zoom['config']['galleryNoThumbs']).'; ';
        $js .= 'jQuery.axZm.galleryNavi = '.$this->ptj($zoom['config']['galleryNavi']).'; ';
        $js .= 'jQuery.axZm.galleryNaviCirc = '.$this->ptj($zoom['config']['galleryNaviCirc']).'; ';
        $js .= 'jQuery.axZm.galleryPlayButton = '.$this->ptj($zoom['config']['galleryPlayButton']).'; ';
        $js .= 'jQuery.axZm.galleryButtonSpace = '.$this->ptj($zoom['config']['galleryButtonSpace']).'; ';
        $js .= 'jQuery.axZm.galleryNaviPos = '.$this->ptj($zoom['config']['galleryNaviPos']).'; ';
        $js .= 'jQuery.axZm.galleryNaviHeight = '.$this->ptj($zoom['config']['galleryNaviHeight']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['galleryNaviMargin'], 'jQuery.axZm.galleryNaviMargin', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.galleryPlayInterval = '.$this->ptj($zoom['config']['galleryPlayInterval']).'; ';
        $js .= 'jQuery.axZm.galleryAutoPlay = '.$this->ptj($zoom['config']['galleryAutoPlay']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['galleryKeyboardKeys'], 'jQuery.axZm.galleryKeyboardKeys', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.gallerySlideNavi = '.$this->ptj($zoom['config']['gallerySlideNavi']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviMouseOver = '.$this->ptj($zoom['config']['gallerySlideNaviMouseOver']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviOnlyFullScreen = '.$this->ptj($zoom['config']['gallerySlideNaviOnlyFullScreen']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviMargin = '.$this->ptj($zoom['config']['gallerySlideNaviMargin']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviAnm = '.$this->ptj($zoom['config']['gallerySlideNaviAnm']).'; ';
        $js .= 'jQuery.axZm.gallerySlideSwipeSpeed = '.$this->ptj($zoom['config']['gallerySlideSwipeSpeed']).'; ';
        $js .= 'jQuery.axZm.gallerySlideSwipeSpeedAutoPlay = '.$this->ptj($zoom['config']['gallerySlideSwipeSpeedAutoPlay']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['gallerySlideTouchSwipe'], 'jQuery.axZm.gallerySlideTouchSwipe', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.galleryFadeOutSpeed = '.$this->ptj($zoom['config']['galleryFadeOutSpeed']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInSpeed = '.$this->ptj($zoom['config']['galleryFadeInSpeed']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInMotion = '.$this->ptj($zoom['config']['galleryFadeInMotion']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInOpacity = '.$this->ptj($zoom['config']['galleryFadeInOpacity']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInSize = '.$this->ptj($zoom['config']['galleryFadeInSize']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInAnm = '.$this->ptj($zoom['config']['galleryFadeInAnm']).'; ';
        $js .= 'jQuery.axZm.gallerySwipe = '.$this->ptj($zoom['config']['gallerySwipe']).'; ';
        $js .= 'jQuery.axZm.galleryInnerFade = '.$this->ptj($zoom['config']['galleryInnerFade']).'; ';
        $js .= 'jQuery.axZm.galleryInnerFadeCut = '.$this->ptj($zoom['config']['galleryInnerFadeCut']).'; ';
        $js .= 'jQuery.axZm.galleryInnerFadeMotion = '.$this->ptj($zoom['config']['galleryInnerFadeMotion']).'; ';
        $js .= 'jQuery.axZm.galleryHorPicDim = '.$this->ptj($zoom['config']['galleryHorPicDim']).'; ';
        $js .= 'jQuery.axZm.galleryHorHideMaxWidth = '.$this->ptj($zoom['config']['galleryHorHideMaxWidth']).'; ';
        $js .= 'jQuery.axZm.galleryHorHideMaxHeight = '.$this->ptj($zoom['config']['galleryHorHideMaxHeight']).'; ';
        $js .= 'jQuery.axZm.galHorPicX = '.$this->ptj($zoom['config']['galHorPicX']).'; ';
        $js .= 'jQuery.axZm.galHorPicY = '.$this->ptj($zoom['config']['galHorPicY']).'; ';
        $js .= 'jQuery.axZm.useHorGallery = '.$this->ptj($zoom['config']['useHorGallery']).'; ';
        $js .= 'jQuery.axZm.fullScreenHorzGallery = '.$this->ptj($zoom['config']['fullScreenHorzGallery']).'; ';
        $js .= 'jQuery.axZm.galHorHeight = '.$this->ptj($zoom['config']['galHorHeight']).'; ';
        $js .= 'jQuery.axZm.galHorThumbDescr = '.$this->ptj($zoom['config']['galHorThumbDescr']).'; ';
        $js .= 'jQuery.axZm.galHorPosition = '.$this->ptj($zoom['config']['galHorPosition']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['galHorPadding'], 'jQuery.axZm.galHorPadding', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['galHorOpt'], 'jQuery.axZm.galHorOpt', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.useGallery = '.$this->ptj($zoom['config']['useGallery']).'; ';
        $js .= 'jQuery.axZm.fullScreenVertGallery = '.$this->ptj($zoom['config']['fullScreenVertGallery']).'; ';
        $js .= 'jQuery.axZm.galleryLines = '.$this->ptj($zoom['config']['galleryLines']).'; ';
        $js .= 'jQuery.axZm.galleryPicDim = '.$this->ptj($zoom['config']['galleryPicDim']).'; ';
        $js .= 'jQuery.axZm.galPicX = '.$this->ptj($zoom['config']['galPicX']).'; ';
        $js .= 'jQuery.axZm.galPicY = '.$this->ptj($zoom['config']['galPicY']).'; ';
        $js .= 'jQuery.axZm.galleryPos = '.$this->ptj($zoom['config']['galleryPos']).'; ';
        $js .= 'jQuery.axZm.galleryScrollToCurrent = '.$this->ptj($zoom['config']['galleryScrollToCurrent']).'; ';
        $js .= 'jQuery.axZm.galleryWidth = '.$this->ptj($zoom['config']['galleryWidth']).'; ';
        $js .= 'jQuery.axZm.galleryThumbDescr = '.$this->ptj($zoom['config']['galleryThumbDescr']).'; ';
        $js .= 'jQuery.axZm.galleryHideMaxWidth = '.$this->ptj($zoom['config']['galleryHideMaxWidth']).'; ';
        $js .= 'jQuery.axZm.galleryHideMaxHeight = '.$this->ptj($zoom['config']['galleryHideMaxHeight']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['galleryImgMargin'], 'jQuery.axZm.galleryImgMargin', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['galleryOpt'], 'jQuery.axZm.galleryOpt', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.useFullGallery = '.$this->ptj($zoom['config']['useFullGallery']).'; ';
        if ($zoom['config']['useFullGallery']) {
            $js .= 'jQuery.axZm.galFullScrollCurrent = '.$this->ptj($zoom['config']['galFullScrollCurrent']).'; ';
            $js .= 'jQuery.axZm.galFullAutoStart = '.$this->ptj($zoom['config']['galFullAutoStart']).'; ';
            $js .= 'jQuery.axZm.galFullButton = '.$this->ptj($zoom['config']['galFullButton']).'; ';
            $js .= 'jQuery.axZm.galFullThumbDescr = '.$this->ptj($zoom['config']['galFullThumbDescr']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['galFullImgMargin'], 'jQuery.axZm.galFullImgMargin', false, $rn, false).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['galFullOpt'], 'jQuery.axZm.galFullOpt', false, $rn, false).'; ';
            $js .= 'jQuery.axZm.galFullTooltip = '.$this->ptj($zoom['config']['galFullTooltip']).'; ';
            if ($zoom['config']['galFullTooltip']) {
                $js .= 'jQuery.axZm.galFullTooltipOffset = '.$this->ptj($zoom['config']['galFullTooltipOffset']).'; ';
                $js .= 'jQuery.axZm.galFullTooltipSpeed = '.$this->ptj($zoom['config']['galFullTooltipSpeed']).'; ';
                $js .= 'jQuery.axZm.galFullTooltipTransp = '.$this->ptj($zoom['config']['galFullTooltipTransp']).'; ';
            }
            $js .= 'jQuery.axZm.galleryFullPicDim = '.$this->ptj($zoom['config']['galleryFullPicDim']).'; ';
            $js .= 'jQuery.axZm.galFullPicX = '.$this->ptj($zoom['config']['galFullPicX']).'; ';
            $js .= 'jQuery.axZm.galFullPicY = '.$this->ptj($zoom['config']['galFullPicY']).'; ';
        }
        $js .= $this->arrayToJSObject($zoom['config']['touchSettings'], 'jQuery.axZm.touchSettings', false, $rn, false).'; ';
        $arrayMods = array('crop', 'spin', 'pan');
        if (!in_array($zoom['config']['firstMod'], $arrayMods)) {
            $zoom['config']['firstMod'] = 'pan';
        }
        if (!$zoom['config']['spinMod'] && $zoom['config']['firstMod'] == 'spin') {
            $zoom['config']['firstMod'] = 'pan';
        }
        $js .= 'jQuery.axZm.firstMod = '.$this->ptj($zoom['config']['firstMod']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['keyPressMod'], 'jQuery.axZm.keyPressMod', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.spinMod = '.$this->ptj($zoom['config']['spinMod']).'; ';
        if ($zoom['config']['spinMod']) {
            $js .= $this->arrayToJSObject($zoom['config']['spinPreloaderSettings'], 'jQuery.axZm.spinPreloaderSettings', false, $rn, false).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinCirclePreloader'], 'jQuery.axZm.spinCirclePreloader', false, $rn, false).'; ';
            $js .= 'jQuery.axZm.spinSensitivity = '.$this->ptj($zoom['config']['spinSensitivity']).'; ';
            $js .= 'jQuery.axZm.spinReverse = '.$this->ptj($zoom['config']['spinReverse']).'; ';
            $js .= 'jQuery.axZm.spinContra = '.$this->ptj($zoom['config']['spinContra']).'; ';
            $js .= 'jQuery.axZm.spinReverseBtn = '.$this->ptj($zoom['config']['spinReverseBtn']).'; ';
            $js .= 'jQuery.axZm.spinDemo = '.$this->ptj($zoom['config']['spinDemo']).'; ';
            $js .= 'jQuery.axZm.spinDemoTime = '.$this->ptj($zoom['config']['spinDemoTime']).'; ';
            $js .= 'jQuery.axZm.spinDemoRounds = '.$this->ptj($zoom['config']['spinDemoRounds']).'; ';
            $js .= 'jQuery.axZm.spinDemoEasing = '.$this->ptj($zoom['config']['spinDemoEasing']).'; ';
            $js .= 'jQuery.axZm.spinOnSwitch = '.$this->ptj($zoom['config']['spinOnSwitch']).'; ';
            $js .= 'jQuery.axZm.spinWhilePreload = '.$this->ptj($zoom['config']['spinWhilePreload']).'; ';
            $js .= 'jQuery.axZm.spinMouseOverStop = '.$this->ptj($zoom['config']['spinMouseOverStop']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinEffect'], 'jQuery.axZm.spinEffect', false, $rn, false).'; ';
            $js .= 'jQuery.axZm.spinSlider = '.$this->ptj($zoom['config']['spinSlider']).'; ';
            $js .= 'jQuery.axZm.spinSliderHeight = '.$this->ptj($zoom['config']['spinSliderHeight']).'; ';
            $js .= 'jQuery.axZm.spinSliderWidth = '.$this->ptj($zoom['config']['spinSliderWidth']).'; ';
            $js .= 'jQuery.axZm.spinSliderHandleSize = '.$this->ptj($zoom['config']['spinSliderHandleSize']).'; ';
            $js .= 'jQuery.axZm.spinSliderClass = '.$this->ptj($zoom['config']['spinSliderClass']).'; ';
            $js .= 'jQuery.axZm.spinSliderReverse = '.$this->ptj($zoom['config']['spinSliderReverse']).'; ';
            $js .= 'jQuery.axZm.spinSliderMouseOver = '.$this->ptj($zoom['config']['spinSliderMouseOver']).'; ';
            $js .= 'jQuery.axZm.spinSliderParent = '.$this->ptj($zoom['config']['spinSliderParent']).'; ';
            $js .= 'jQuery.axZm.spinSliderPlayButton = '.$this->ptj($zoom['config']['spinSliderPlayButton']).'; ';
            $js .= 'jQuery.axZm.spinBounce = '.$this->ptj($zoom['config']['spinBounce']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinNoInit'], 'jQuery.axZm.spinNoInit', false, $rn, false).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['dragToSpin'], 'jQuery.axZm.dragToSpin', false, $rn, false).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinKeys'], 'jQuery.axZm.spinKeys', false, $rn, false).'; ';
            if ($zoom['config']['cueFrames']) {
                $js .= 'jQuery.axZm.cueFrames = '.$this->ptj($zoom['config']['cueFrames']).'; ';
            }
            $js .= 'jQuery.axZm.spinAreaDisable = '.$this->ptj($zoom['config']['spinAreaDisable']).'; ';
            $js .= 'jQuery.axZm.spinToMotion = '.$this->ptj($zoom['config']['spinToMotion']).'; ';
            $js .= 'jQuery.axZm.spinOnClick = '.$this->ptj($zoom['config']['spinOnClick']).'; ';
            $js .= 'jQuery.axZm.spinFlip = '.$this->ptj($zoom['config']['spinFlip']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinSmoothing'], 'jQuery.axZm.spinSmoothing', false, $rn, false).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinKeepRotate'], 'jQuery.axZm.spinKeepRotate', false, $rn, false).'; ';
            $js .= $this->arrayToJSArray($zoom['config']['spinSnapKeys'], 'jQuery.axZm.spinSnapKeys').'; ';
            $js .= 'jQuery.axZm.spinSnapNextKey = '.$this->ptj($zoom['config']['spinSnapNextKey']).'; ';
            $js .= 'jQuery.axZm.spinAndDrag = '.$this->ptj($zoom['config']['spinAndDrag']).'; ';
            $js .= 'jQuery.axZm.spinAndDragTouch = '.$this->ptj($zoom['config']['spinAndDragTouch']).'; ';
            $js .= 'jQuery.axZm.spinDragOnly = '.$this->ptj($zoom['config']['spinDragOnly']).'; ';
            $js .= 'jQuery.axZm.spinPanRightMouseBtn = '.$this->ptj($zoom['config']['spinPanRightMouseBtn']).'; ';
            if (isset($zoom['config']['zAxis'])) {
                $js .= $this->arrayToJSObject($zoom['config']['zAxis'], 'jQuery.axZm.zAxis', false, $rn, false).'; ';
                $js .= $this->arrayToJSObject($zoom['config']['zFolder'], 'jQuery.axZm.zFolder', false, $rn, true).'; ';
                $js .= 'jQuery.axZm.spinReverseZ = '.$this->ptj($zoom['config']['spinReverseZ']).'; ';
                $js .= 'jQuery.axZm.spinSensitivityZ = '.$this->ptj($zoom['config']['spinSensitivityZ']).'; ';
            }
            if (isset($_GET['firstAxis'])) {
                $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($_GET['firstAxis']).'; ';
            } elseif (isset($zoom['config']['firstAxis'])) {
                $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($zoom['config']['firstAxis']).'; ';
            } else {
                $js .= 'jQuery.axZm.firstAxis = false; ';
            }
        } else {
            $js .= 'jQuery.axZm.zAxis = false; ';
            $js .= 'jQuery.axZm.zFolder = false; ';
            $js .= 'jQuery.axZm.firstAxis = false; ';
        }
        $js .= 'jQuery.axZm.zoomSlider = '.$this->ptj($zoom['config']['zoomSlider']).'; ';
        $js .= 'jQuery.axZm.zoomSliderHeight = '.$this->ptj($zoom['config']['zoomSliderHeight']).'; ';
        $js .= 'jQuery.axZm.zoomSliderWidth = '.$this->ptj($zoom['config']['zoomSliderWidth']).'; ';
        $js .= 'jQuery.axZm.zoomSliderHandleSize = '.$this->ptj($zoom['config']['zoomSliderHandleSize']).'; ';
        $js .= 'jQuery.axZm.zoomSliderPosition = '.$this->ptj($zoom['config']['zoomSliderPosition']).'; ';
        $js .= 'jQuery.axZm.zoomSliderMarginV = '.$this->ptj($zoom['config']['zoomSliderMarginV']).'; ';
        $js .= 'jQuery.axZm.zoomSliderMarginH = '.$this->ptj($zoom['config']['zoomSliderMarginH']).'; ';
        $js .= 'jQuery.axZm.zoomSliderOpacity = '.$this->ptj($zoom['config']['zoomSliderOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomSliderHorizontal = '.$this->ptj($zoom['config']['zoomSliderHorizontal']).'; ';
        $js .= 'jQuery.axZm.zoomSliderMouseOver = '.$this->ptj($zoom['config']['zoomSliderMouseOver']).'; ';
        $js .= 'jQuery.axZm.zoomSliderContainerPadding = '.$this->ptj($zoom['config']['zoomSliderContainerPadding']).'; ';
        $js .= 'jQuery.axZm.zoomSliderClass = '.$this->ptj($zoom['config']['zoomSliderClass']).'; ';
        $js .= 'jQuery.axZm.pMove= '.$this->ptj($zoom['config']['pMove']).'; ';
        $js .= 'jQuery.axZm.pZoom = '.$this->ptj($zoom['config']['pZoom']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['autoZoom'], 'jQuery.axZm.autoZoom', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.pZoomOut = '.$this->ptj($zoom['config']['pZoomOut']).'; ';
        $js .= 'jQuery.axZm.stepZoom = '.$this->ptj($zoom['config']['stepZoom']).'; ';
        $js .= 'jQuery.axZm.zoomOutClick = '.$this->ptj($zoom['config']['zoomOutClick']).'; ';
        $js .= 'jQuery.axZm.zoomSpeedGlobal = '.$this->ptj($zoom['config']['zoomSpeedGlobal']).'; ';
        $js .= 'jQuery.axZm.moveSpeed = '.$this->ptj($zoom['config']['moveSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomSpeed = '.$this->ptj($zoom['config']['zoomSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomOutSpeed = '.$this->ptj($zoom['config']['zoomOutSpeed']).'; ';
        $js .= 'jQuery.axZm.cropSpeed = '.$this->ptj($zoom['config']['cropSpeed']).'; ';
        $js .= 'jQuery.axZm.restoreSpeed = '.$this->ptj($zoom['config']['restoreSpeed']).'; ';
        $js .= 'jQuery.axZm.traverseSpeed = '.$this->ptj($zoom['config']['traverseSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomFade = '.$this->ptj($zoom['config']['zoomFade']).'; ';
        $js .= 'jQuery.axZm.zoomFadeIn = '.$this->ptj($zoom['config']['zoomFadeIn']).'; ';
        $js .= 'jQuery.axZm.buttonAjax = '.$this->ptj($zoom['config']['buttonAjax']).'; ';
        $js .= 'jQuery.axZm.zoomEaseGlobal = '.$this->ptj($zoom['config']['zoomEaseGlobal']).'; ';
        $js .= 'jQuery.axZm.zoomEaseIn = '.$this->ptj($zoom['config']['zoomEaseIn']).'; ';
        $js .= 'jQuery.axZm.zoomEaseCrop = '.$this->ptj($zoom['config']['zoomEaseCrop']).'; ';
        $js .= 'jQuery.axZm.zoomEaseOut = '.$this->ptj($zoom['config']['zoomEaseOut']).'; ';
        $js .= 'jQuery.axZm.zoomEaseMove = '.$this->ptj($zoom['config']['zoomEaseMove']).'; ';
        $js .= 'jQuery.axZm.zoomEaseRestore = '.$this->ptj($zoom['config']['zoomEaseRestore']).'; ';
        $js .= 'jQuery.axZm.zoomEaseTraverse = '.$this->ptj($zoom['config']['zoomEaseTraverse']).'; ';
        $js .= 'jQuery.axZm.fps1 = '.$this->ptj($zoom['config']['fps1']).'; ';
        $js .= 'jQuery.axZm.fps2 = '.$this->ptj($zoom['config']['fps2']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['gpuAccel'], 'jQuery.axZm.gpuAccel', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.zoomLoaderEnable = '.$this->ptj($zoom['config']['zoomLoaderEnable']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderOnlyAjax = '.$this->ptj($zoom['config']['zoomLoaderOnlyAjax']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderClass = '.$this->ptj($zoom['config']['zoomLoaderClass']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderTransp = '.$this->ptj($zoom['config']['zoomLoaderTransp']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderFadeIn = '.$this->ptj($zoom['config']['zoomLoaderFadeIn']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderFadeOut = '.$this->ptj($zoom['config']['zoomLoaderFadeOut']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderPos = '.$this->ptj($zoom['config']['zoomLoaderPos']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderMargin = '.$this->ptj($zoom['config']['zoomLoaderMargin']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderFrames = '.$this->ptj($zoom['config']['zoomLoaderFrames']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderCycle = '.$this->ptj($zoom['config']['zoomLoaderCycle']).'; ';
        $js .= 'jQuery.axZm.displayNavi = '.$this->ptj($zoom['config']['displayNavi']).'; ';
        $js .= 'jQuery.axZm.naviHideMaxWidth = '.$this->ptj($zoom['config']['naviHideMaxWidth']).'; ';
        $js .= 'jQuery.axZm.naviHideMaxHeight = '.$this->ptj($zoom['config']['naviHideMaxHeight']).'; ';
        $js .= 'jQuery.axZm.naviZoomBut = '.$this->ptj($zoom['config']['naviZoomBut']).'; ';
        $js .= 'jQuery.axZm.naviPanBut = '.$this->ptj($zoom['config']['naviPanBut']).'; ';
        $js .= 'jQuery.axZm.naviRestoreBut = '.$this->ptj($zoom['config']['naviRestoreBut']).'; ';
        $js .= 'jQuery.axZm.naviHotspotsBut = '.$this->ptj($zoom['config']['naviHotspotsBut']).'; ';
        $js .= 'jQuery.axZm.downloadButton = '.$this->ptj($zoom['config']['downloadButton']).'; ';
        $js .= 'jQuery.axZm.naviCropButSwitch = '.$this->ptj($zoom['config']['naviCropButSwitch']).'; ';
        $js .= 'jQuery.axZm.naviPanButSwitch = '.$this->ptj($zoom['config']['naviPanButSwitch']).'; ';
        $js .= 'jQuery.axZm.naviSpinButSwitch = '.$this->ptj($zoom['config']['naviSpinButSwitch']).'; ';
        $js .= 'jQuery.axZm.deaktTransp = '.$this->ptj($zoom['config']['deaktTransp']).'; ';
        $js .= 'jQuery.axZm.disabledTransp = '.$this->ptj($zoom['config']['disabledTransp']).'; ';
        $js .= 'jQuery.axZm.naviPos = '.$this->ptj($zoom['config']['naviPos']).'; ';
        $js .= 'jQuery.axZm.naviFloat = '.$this->ptj($zoom['config']['naviFloat']).'; ';
        $js .= 'jQuery.axZm.naviHeight = '.$this->ptj($zoom['config']['naviHeight']).'; ';
        $js .= 'jQuery.axZm.naviSpace = '.$this->ptj($zoom['config']['naviSpace']).'; ';
        $js .= 'jQuery.axZm.naviGroupSpace = '.$this->ptj($zoom['config']['naviGroupSpace']).'; ';
        $js .= 'jQuery.axZm.naviMinPadding = '.$this->ptj($zoom['config']['naviMinPadding']).'; ';
        $js .= 'jQuery.axZm.naviTopMargin = '.$this->ptj($zoom['config']['naviTopMargin']).'; ';
        $js .= 'jQuery.axZm.naviBigZoom = '.$this->ptj($zoom['config']['naviBigZoom']).'; ';
        $js .= 'jQuery.axZm.naviDownState = '.$this->ptj($zoom['config']['naviDownState']).'; ';
        $js .= 'jQuery.axZm.naviOverState = '.$this->ptj($zoom['config']['naviOverState']).'; ';
        $js .= 'jQuery.axZm.scroll = '.$this->ptj($zoom['config']['scroll']).'; ';
        $js .= 'jQuery.axZm.scrollFS = '.$this->ptj($zoom['config']['scrollFS']).'; ';
        $js .= 'jQuery.axZm.mouseScrollEnable = '.$this->ptj($zoom['config']['mouseScrollEnable']).'; ';
        $js .= 'jQuery.axZm.mouseScrollEnableFS = '.$this->ptj($zoom['config']['mouseScrollEnableFS']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['mouseScrollMsg'], 'jQuery.axZm.mouseScrollMsg', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['scrollBrowserExcl'], 'jQuery.axZm.scrollBrowserExcl', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['scrollBrowserExclPar'], 'jQuery.axZm.scrollBrowserExclPar', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.scrollAnm = '.$this->ptj($zoom['config']['scrollAnm']).'; ';
        $js .= 'jQuery.axZm.scrollSpeed = '.$this->ptj($zoom['config']['scrollSpeed']).'; ';
        $js .= 'jQuery.axZm.scrollZoom = '.$this->ptj($zoom['config']['scrollZoom']).'; ';
        $js .= 'jQuery.axZm.scrollMotion = '.$this->ptj($zoom['config']['scrollMotion']).'; ';
        $js .= 'jQuery.axZm.scrollPanR = '.$this->ptj($zoom['config']['scrollPanR']).'; ';
        $js .= 'jQuery.axZm.scrollAjax = '.$this->ptj($zoom['config']['scrollAjax']).'; ';
        $js .= 'jQuery.axZm.scrollPause = '.$this->ptj($zoom['config']['scrollPause']).'; ';
        $js .= 'jQuery.axZm.scrollOutReversed = '.$this->ptj($zoom['config']['scrollOutReversed']).'; ';
        $js .= 'jQuery.axZm.scrollOutCenter = '.$this->ptj($zoom['config']['scrollOutCenter']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionColor = '.$this->ptj($zoom['config']['zoomSelectionColor']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionOpacity = '.$this->ptj($zoom['config']['zoomSelectionOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomOuterColor = '.$this->ptj($zoom['config']['zoomOuterColor']).'; ';
        $js .= 'jQuery.axZm.zoomOuterOpacity = '.$this->ptj($zoom['config']['zoomOuterOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomBorderColor = '.$this->ptj($zoom['config']['zoomBorderColor']).'; ';
        $js .= 'jQuery.axZm.zoomBorderWidth = '.$this->ptj($zoom['config']['zoomBorderWidth']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionAnm = '.$this->ptj($zoom['config']['zoomSelectionAnm']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionCross = '.$this->ptj($zoom['config']['zoomSelectionCross']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionCrossOp = '.$this->ptj($zoom['config']['zoomSelectionCrossOp']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionMod = '.$this->ptj($zoom['config']['zoomSelectionMod']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionProp = '.$this->ptj($zoom['config']['zoomSelectionProp']).'; ';
        $js .= 'jQuery.axZm.zoomShowButtonDescr = '.$this->ptj($zoom['config']['zoomShowButtonDescr']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['mapButTitle'], 'jQuery.axZm.mapButTitle', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.descrAreaTransp = '.$this->ptj($zoom['config']['descrAreaTransp']).'; ';
        $js .= 'jQuery.axZm.descrAreaHideTimeOut = '.$this->ptj($zoom['config']['descrAreaHideTimeOut']).'; ';
        $js .= 'jQuery.axZm.descrAreaShowTimeOut = '.$this->ptj($zoom['config']['descrAreaShowTimeOut']).'; ';
        $js .= 'jQuery.axZm.descrAreaHideTime = '.$this->ptj($zoom['config']['descrAreaHideTime']).'; ';
        $js .= 'jQuery.axZm.descrAreaShowTime = '.$this->ptj($zoom['config']['descrAreaShowTime']).'; ';
        $js .= 'jQuery.axZm.descrAreaHeight = '.$this->ptj($zoom['config']['descrAreaHeight']).'; ';
        $js .= 'jQuery.axZm.descrAreaMotion = '.$this->ptj($zoom['config']['descrAreaMotion']).'; ';
        $js .= 'jQuery.axZm.zoomDragPhysics = '.$this->ptj($zoom['config']['zoomDragPhysics']).'; ';
        $js .= 'jQuery.axZm.zoomDragAnm = '.$this->ptj($zoom['config']['zoomDragAnm']).'; ';
        $js .= 'jQuery.axZm.zoomDragSpeed = '.$this->ptj($zoom['config']['zoomDragSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomDragAjax = '.$this->ptj($zoom['config']['zoomDragAjax']).'; ';
        $js .= 'jQuery.axZm.zoomDragMotion = '.$this->ptj($zoom['config']['zoomDragMotion']).'; ';
        $js .= 'jQuery.axZm.gallerySwitchQuick = '.$this->ptj($zoom['config']['gallerySwitchQuick']).'; ';
        $js .= 'jQuery.axZm.thumbSliderTheme = '.$this->ptj($zoom['config']['thumbSliderTheme']).'; ';
        $js .= 'jQuery.axZm.pyrDialog = '.$this->ptj($zoom['config']['pyrDialog']).'; ';
        $js .= 'jQuery.axZm.gPyramidDialog = '.$this->ptj($zoom['config']['gPyramidDialog']).'; ';
        $js .= 'jQuery.axZm.zoomStat = '.$this->ptj($zoom['config']['zoomStat']).'; ';
        $js .= 'jQuery.axZm.zoomStatHeight = '.$this->ptj($zoom['config']['zoomStatHeight']).'; ';
        $js .= 'jQuery.axZm.useSess = '.$this->ptj($zoom['config']['useSess']).'; ';
        $js .= 'jQuery.axZm.cursorWait = '.$this->ptj($zoom['config']['cursorWait']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['cursor'], 'jQuery.axZm.cursor', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['preloadImg'], 'jQuery.axZm.preloadImg', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.fullZoomBorder = '.$this->ptj($zoom['config']['fullZoomBorder']).'; ';
        $js .= 'jQuery.axZm.fullZoomOutBorder = '.$this->ptj($zoom['config']['fullZoomOutBorder']).'; ';
        $js .= 'jQuery.axZm.zoomTimeOut = '.$this->ptj($zoom['config']['zoomTimeOut']).'; ';
        $js .= 'jQuery.axZm.help = '.$this->ptj($zoom['config']['help']).'; ';
        $js .= 'jQuery.axZm.helpTransp = '.$this->ptj($zoom['config']['helpTransp']).'; ';
        $js .= 'jQuery.axZm.helpTime = '.$this->ptj($zoom['config']['helpTime']).'; ';
        $js .= 'jQuery.axZm.zoomLoadFile = '.$this->ptj($zoom['config']['zoomLoadFile']).'; ';
        $js .= 'jQuery.axZm.zoomLoadSess = '.$this->ptj($zoom['config']['zoomLoadSess']).'; ';
        $js .= 'jQuery.axZm.innerMargin = '.$this->ptj($zoom['config']['innerMargin']).'; ';
        $js .= 'jQuery.axZm.cornerRadius = '.$this->ptj($zoom['config']['cornerRadius']).'; ';
        $js .= 'jQuery.axZm.vWtrmrk = '.$this->ptj($zoom['config']['vWtrmrk']).'; ';
        $js .= 'jQuery.axZm.dwh = \''.$this->axZm->wtrHtml($zoom).'\'; ';
        if (is_array($zoom['config']['notTouchUA']) && !empty($zoom['config']['notTouchUA'])) {
            $js .= $this->arrayToJSObject($zoom['config']['notTouchUA'], 'jQuery.axZm.notTouchUA', false, $rn, false).'; ';
        }
        $js .= 'jQuery.axZm.backLayer = '.$this->ptj($zoom['config']['backLayer']).'; ';
        $js .= 'jQuery.axZm.backDiv = '.$this->ptj($zoom['config']['backDiv']).'; ';
        $js .= 'jQuery.axZm.backInnerDiv = '.$this->ptj($zoom['config']['backInnerDiv']).'; ';
        $js .= 'jQuery.axZm.picLayer = '.$this->ptj($zoom['config']['picLayer']).'; ';
        $js .= 'jQuery.axZm.overLayer = '.$this->ptj($zoom['config']['overLayer']).'; ';
        $js .= 'jQuery.axZm.zoomLogInfo = '.$this->ptj($zoom['config']['zoomLogInfo']).'; ';
        $js .= 'jQuery.axZm.zoomLogJustLevel = '.$this->ptj($zoom['config']['zoomLogJustLevel']).'; ';
        $js .= 'jQuery.axZm.zoomLogLevel = '.$this->ptj($zoom['config']['zoomLogLevel']).'; ';
        $js .= 'jQuery.axZm.zoomLogTime = '.$this->ptj($zoom['config']['zoomLogTime']).'; ';
        $js .= 'jQuery.axZm.zoomLogTraffic = '.$this->ptj($zoom['config']['zoomLogTraffic']).'; ';
        $js .= 'jQuery.axZm.zoomLogSeconds = '.$this->ptj($zoom['config']['zoomLogSeconds']).'; ';
        $js .= 'jQuery.axZm.zoomLogLoading = '.$this->ptj($zoom['config']['zoomLogLoading']).'; ';
        $js .= 'jQuery.axZm.helpTxt = '.$this->ptj(str_replace('[icon]', $zoom['config']['icon'], $zoom['config']['helpTxt'])).'; ';
        $js .= 'jQuery.axZm.tapHideAll = '.$this->ptj($zoom['config']['tapHideAll']).'; ';
        $js .= $this->arrayToJSArray($zoom['config']['tapHideExcl'], 'jQuery.axZm.tapHideExcl').'; ';
        $js .= 'jQuery.axZm.zoomDoubleClickTap = '.$this->ptj($zoom['config']['zoomDoubleClickTap']).'; ';
        $js .= 'jQuery.axZm.polyfill = '.$this->ptj($zoom['config']['polyfill']).'; ';
        $js .= 'jQuery.axZm.lockAll = '.$this->ptj($zoom['config']['lockAll']).'; ';
        $js .= 'jQuery.axZm.touchDragPageScroll = '.$this->ptj($zoom['config']['touchDragPageScroll']).'; ';
        $js .= 'jQuery.axZm.touchDragPageScrollZoomed = '.$this->ptj($zoom['config']['touchDragPageScrollZoomed']).'; ';
        $js .= 'jQuery.axZm.touchSpinPageScroll = '.$this->ptj($zoom['config']['touchSpinPageScroll']).'; ';
        $js .= 'jQuery.axZm.touchPageScrollExcl = '.$this->ptj($zoom['config']['touchPageScrollExcl']).'; ';
        $js .= 'jQuery.axZm.disableMultitouch = '.$this->ptj($zoom['config']['disableMultitouch']).'; ';
        $js .= 'jQuery.axZm.autoHideEllDelay = '.$this->ptj($zoom['config']['autoHideEllDelay']).'; ';
        if ($zoom['config']['naviBigZoom']) {
            $zoom['config']['icons']['zoomIn'] = $zoom['config']['icons']['zoomInBig'];
            $zoom['config']['icons']['zoomOut'] = $zoom['config']['icons']['zoomOutBig'];
        }
        $js .= 'jQuery.axZm.buttonSet = '.$this->ptj($zoom['config']['buttonSet']).'; ';
        $js .= 'jQuery.axZm.themeCss = '.$this->ptj($zoom['config']['themeCss']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['icons'], 'jQuery.axZm.icons', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['mNavi'], 'jQuery.axZm.mNavi', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.fullScreenEnable = '.$this->ptj($zoom['config']['fullScreenEnable']).'; ';
        if ($zoom['config']['fullScreenEnable']) {
            $js .= 'jQuery.axZm.fullScreenNaviBar = '.$this->ptj($zoom['config']['fullScreenNaviBar']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButton = '.$this->ptj($zoom['config']['fullScreenCornerButton']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonTouch = '.$this->ptj($zoom['config']['fullScreenCornerButtonTouch']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonPos = '.$this->ptj($zoom['config']['fullScreenCornerButtonPos']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonMarginX = '.$this->ptj($zoom['config']['fullScreenCornerButtonMarginX']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonMarginY = '.$this->ptj($zoom['config']['fullScreenCornerButtonMarginY']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonMouseOver = '.$this->ptj($zoom['config']['fullScreenCornerButtonMouseOver']).'; ';
            $js .= 'jQuery.axZm.fullScreenNaviButton = '.$this->ptj($zoom['config']['fullScreenNaviButton']).'; ';
            $js .= 'jQuery.axZm.fullScreenExitText = '.$this->ptj($zoom['config']['fullScreenExitText']).'; ';
            $js .= 'jQuery.axZm.fullScreenExitTimeout = '.$this->ptj($zoom['config']['fullScreenExitTimeout']).'; ';
            $js .= 'jQuery.axZm.fullScreenExitOnce = '.$this->ptj($zoom['config']['fullScreenExitOnce']).'; ';
            $js .= 'jQuery.axZm.fullScreenRel = '.$this->ptj($zoom['config']['fullScreenRel']).'; ';
            $js .= 'jQuery.axZm.fullScreenMapFract = '.$this->ptj($zoom['config']['fullScreenMapFract']).'; ';
            $js .= 'jQuery.axZm.fullScreenMapWidth = '.$this->ptj($zoom['config']['fullScreenMapWidth']).'; ';
            $js .= 'jQuery.axZm.fullScreenMapHeight = '.$this->ptj($zoom['config']['fullScreenMapHeight']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['fullScreenKeepZoom'], 'jQuery.axZm.fullScreenKeepZoom', false, $rn, false).'; ';
            $js .= 'jQuery.axZm.fullScreenApi = '.$this->ptj($zoom['config']['fullScreenApi']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['fullScreenSpace'], 'jQuery.axZm.fullScreenSpace', false, $rn, false).'; ';
        }
        $js .= 'jQuery.axZm.autoBackColor = '.$this->ptj($zoom['config']['autoBackColor']).'; ';
        if (isset($zoom['config']['iff']) && $zoom['config']['iff']) {
            $js .= 'jQuery.axZm.iff = '.$this->ptj($zoom['config']['iff']).'; ';
        } elseif (isset($zoom['config']['ift']) && $zoom['config']['ift']) {
            $js .= 'jQuery.axZm.ift = '.$this->ptj($zoom['config']['ift']).'; ';
        } elseif (isset($zoom['config']['iftw']) && $zoom['config']['iftw']) {
            $js .= 'jQuery.axZm.iftw = '.$this->ptj($zoom['config']['iftw']).'; ';
        } elseif (isset($zoom['config']['ifft']) && $zoom['config']['ifft']) {
            $js .= 'jQuery.axZm.ifft = '.$this->ptj($zoom['config']['ifft']).'; ';
        }
        $js .= $this->arrayToJSObject($zoom['config']['stepPicDim'], 'jQuery.axZm.stepPicDim', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.stepPicPreload = '.$this->ptj($zoom['config']['stepPicPreload']).'; ';
        $js .= 'jQuery.axZm.stepPicOnZoom = '.$this->ptj($zoom['config']['stepPicOnZoom']).'; ';
        $js .= 'jQuery.axZm.subfolderStructure = '.$this->ptj($zoom['config']['subfolderStructure']).'; ';
        $js .= 'jQuery.axZm.lT = '.$this->ptj($zoom['config']['licenceType']).'; ';
        $js .= 'jQuery.axZm.lK = '.$this->ptj(($zoom['config']['licenceKey'] == 'demo' ? 'demo' : true)).'; ';
        if (isset($zoom['config']['galArray'])) {
            $js .= $this->arrayToJSObject($zoom['config']['galArray'], 'jQuery.axZm.zoomGA', false, $rn, false).'; ';
        }
        if (!isset($zoom['config']['galArray']) || !$zoom['config']['galArray']) {
            $js .= 'jQuery.axZm.noImages = true; ';
        }
        if (isset($zoom['config']['folderArray']) && !empty($zoom['config']['folderArray'])) {
            $js .= $this->arrayToJSObject($zoom['config']['folderArray'], 'jQuery.axZm.folderArray', false, $rn, false).'; ';
        }
        if (!empty($this->readTime)) {
            $this->readTime['js'] = $this->endTimeDiff($startTime);
            $js .= $this->arrayToJSObject($this->readTime, 'jQuery.axZm.readTime', false, $rn, false).'; ';
        }
        if ($zoom['config']['themeCss']) {
            $js .= 'jQuery.fn.axZm.loadTheme(); ';
        }
        if ($pack) {
            $myPacker = new JavaScriptPacker($js, 'Normal', true, false);
            $js = $myPacker->pack();
        } elseif ($rn) {
            $js = str_replace('; ',";".$rnStr,$js);
        }
        $js = "\n<script type=\"text/javascript\">$rnStr$js$rnStr</script>$rnStr";
        return $js;
    }
    public function draw360JsVariationSet($zoom)
    {
        $js = array();
        if (!isset($zoom['config']['galArray']) || !$zoom['config']['galArray']) {
            $js['noImages'] = true;
            return json_encode($js);
        }
        $js['ow'] = $zoom['config']['orgImgSize'][0];
        $js['oh'] = $zoom['config']['orgImgSize'][1];
        $js['thumbs'] = $zoom['config']['thumbs'];
        $js['smallImgPath'] = $zoom['config']['thumbs'];
        $js['smallImg'] = $zoom['config']['thumbs'].$this->md5path($zoom['config']['smallImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName'];
        if (isset($zoom['config']['zAxis'])) {
            $js['zAxis'] = $zoom['config']['zAxis'];
            $js['zFolder'] = $zoom['config']['zFolder'];
        }
        $js['parToPass'] = $zoom['config']['parToPass'];
        if ($zoom['config']['cropNoObj'] && isset($zoom['config']['pic'])) {
            $js['pic'] = $zoom['config']['pic'];
            $js['orgPath'] = $zoom['config']['pic'];
        }
        $js['zoomGA'] = $zoom['config']['galArray'];
        return json_encode($js);
    }
    public function drawZoomJsGallerySet($zoom, $rn = false, $pack = true)
    {
        $rnStr = '';
        if ($rn) {
            $rnStr = "\n";
        }
        $js = '';
        $js .= 'jQuery.axZm.picDim = '.$this->ptj($zoom['config']['picDim']).'; ';
        $js .= 'jQuery.axZm.zoomID = '.$this->ptj(isset($_GET['zoomID']) ? $_GET['zoomID'] : 0).'; ';
        $js .= 'jQuery.axZm.pZoomID = '.$this->ptj(isset($zoom['config']['pZoomID']) ? $zoom['config']['pZoomID'] : 0).'; ';
        $js .= 'jQuery.axZm.randNum = '.$this->ptj($this->rndNum(24)).'; ';
        $js .= 'jQuery.axZm.icon = '.$this->ptj($zoom['config']['icon']).'; ';
        $js .= 'jQuery.axZm.iconDir = '.$this->ptj($zoom['config']['icon']).'; ';
        $js .= 'jQuery.axZm.thumbs = '.$this->ptj($zoom['config']['thumbs']).'; ';
        $js .= 'jQuery.axZm.smallImgPath = '.$this->ptj($zoom['config']['thumbs']).'; ';
        if (isset($zoom['config']['thumbs']) && isset($zoom['config']['smallImgName'])) {
            $js .= 'jQuery.axZm.smallImg = '.$this->ptj($zoom['config']['thumbs'].$this->md5path($zoom['config']['smallImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName']).'; ';
        } else {
            $js .= 'jQuery.axZm.smallImg = '.$this->ptj('undefined').'; ';
        }
        if (isset($zoom['config']['smallImgSize']) && isset($zoom['config']['smallImgSize'][0]) && isset($zoom['config']['smallImgSize'][1])) {
            $js .= 'jQuery.axZm.iw = '.$this->ptj($zoom['config']['smallImgSize'][0]).'; ';
            $js .= 'jQuery.axZm.ih = '.$this->ptj($zoom['config']['smallImgSize'][1]).'; ';
        } else {
            $js .= 'jQuery.axZm.iw = 400; ';
            $js .= 'jQuery.axZm.ih = 400; ';
        }
        if (isset($zoom['config']['orgImgSize']) && isset($zoom['config']['orgImgSize'][0]) && isset($zoom['config']['orgImgSize'][1])) {
            $js .= 'jQuery.axZm.ow = '.$this->ptj($zoom['config']['orgImgSize'][0]).'; ';
            $js .= 'jQuery.axZm.oh = '.$this->ptj($zoom['config']['orgImgSize'][1]).'; ';
        } else {
            $js .= 'jQuery.axZm.ow = 400; ';
            $js .= 'jQuery.axZm.oh = 400; ';
        }
        if (isset($zoom['config']['smallFileSize'])) {
            $js .= 'jQuery.axZm.smallFileSize = '.$this->ptj($zoom['config']['smallFileSize']).'; ';
        }
        $js .= 'jQuery.axZm.parToPass = '.$this->ptj($zoom['config']['parToPass']).'; ';
        if ($zoom['config']['cropNoObj']) {
            $js .= 'jQuery.axZm.pic = '.$this->ptj($zoom['config']['pic']).'; ';
            $js .= 'jQuery.axZm.orgPath = '.$this->ptj($zoom['config']['pic']).'; ';
        }
        if (isset($zoom['config']['galArray'])) {
            $js .= $this->arrayToJSObject($zoom['config']['galArray'], 'jQuery.axZm.zoomGA', false, $rn, false).'; ';
        }
        if (!isset($zoom['config']['galArray']) || !$zoom['config']['galArray']) {
            $js .= 'jQuery.axZm.noImages = true; ';
        }
        if ($zoom['config']['spinMod']) {
            if (isset($zoom['config']['zAxis'])) {
                $js .= $this->arrayToJSObject($zoom['config']['zAxis'], 'jQuery.axZm.zAxis', false, $rn, false).'; ';
                $js .= $this->arrayToJSObject($zoom['config']['zFolder'], 'jQuery.axZm.zFolder', false, $rn, true).'; ';
                $js .= 'jQuery.axZm.spinReverseZ = '.$this->ptj($zoom['config']['spinReverseZ']).'; ';
                $js .= 'jQuery.axZm.spinSensitivityZ = '.$this->ptj($zoom['config']['spinSensitivityZ']).'; ';
                if (isset($_GET['firstAxis'])) {
                    $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($_GET['firstAxis']).'; ';
                } elseif (isset($zoom['config']['firstAxis'])) {
                    $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($zoom['config']['firstAxis']).'; ';
                } else {
                    $js .= 'jQuery.axZm.firstAxis = false; ';
                }
            } else {
                $js .= 'jQuery.axZm.zAxis = false; ';
                $js .= 'jQuery.axZm.zFolder = false; ';
                $js .= 'jQuery.axZm.firstAxis = false; ';
            }
        }
        $js .= $this->arrayToJSObject($zoom['config']['stepPicDim'], 'jQuery.axZm.stepPicDim', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.stepPicPreload = '.$this->ptj($zoom['config']['stepPicPreload']).'; ';
        $js .= 'jQuery.axZm.dwh = \''.$this->axZm->wtrHtml($zoom).'\'; ';
        if (!empty($this->readTime)) {
            $js .= $this->arrayToJSObject($this->readTime, 'jQuery.axZm.readTime', false, $rn, false).'; ';
        }
        if ($zoom['config']['cTimeCompareDialog'] == true && is_array($this->returnCTimeCompare)) {
            $js .= 'setTimeout(function() {jQuery.fn.axZm.zoomAlert(\'Option cTimeCompare considered to regenerate tiles and all other dynamically generated images: ';
            $js .= '<br><br>'.implode(', ', $this->returnCTimeCompare).';<br><br>If you did not change the source images or AJAX-ZOOM mistakenly regenerates these images, ';
            $js .= 'then please disable cTimeCompare in zoomConfig.inc.php and zoomConfigCustom.inc.php<br><br>\',\'Old tiles deleted! Why that?\', \''.$this->msgNoteInstr.'\'); },1000);';
        }
        if (isset($this->returnMakeFirstImage)) {
            if (!is_bool($this->returnMakeFirstImage)) {
                $js .= $this->removeScriptTags($this->returnMakeFirstImage);
            }
        }
        if (isset($this->returnMakeZoomTiles)) {
            if (!is_bool($this->returnMakeZoomTiles)) {
                $js .= $this->removeScriptTags($this->returnMakeZoomTiles);
            }
        }
        if (isset($this->returnMakeAllThumbs)) {
            if (!is_bool($this->returnMakeAllThumbs)) {
                $js .= $this->removeScriptTags($this->returnMakeAllThumbs);
            }
        }
        if (isset($this->fileErrorDialog)) {
            if (!is_bool($this->fileErrorDialog)) {
                $js .= $this->removeScriptTags($this->fileErrorDialog);
            }
        }
        if ($pack) {
            $myPacker = new JavaScriptPacker($js, 'Normal', true, false);
            $js = $myPacker->pack();
        } elseif ($rn) {
            $js = str_replace('; ',";".$rnStr,$js);
        }
        return $js;
    }
    public function getBrowserInfo()
    {
        $SUPERCLASS_NAMES = 'gecko,mozilla,mosaic,webkit';
        $SUPERCLASSES_REGX = "(?:".str_replace(",", ")|(?:", $SUPERCLASS_NAMES).")";
        $SUBCLASS_NAMES = 'opera,msie,firefox,chrome,safari';
        $SUBCLASSES_REGX = "(?:".str_replace(",", ")|(?:", $SUBCLASS_NAMES).")";
        $browser = 'unsupported';
        $majorVersion = '0';
        $minorVersion = '0';
        $fullVersion = '0.0';
        $os = 'unsupported';
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $found = preg_match("/(?P<browser>".$SUBCLASSES_REGX.")(?:\D*)(?P<majorVersion>\d*)(?P<minorVersion>(?:\.\d*)*)/i",$userAgent, $matches);
        if (!$found) {
            $found = preg_match("/(?P<browser>".$SUPERCLASSES_REGX.")(?:\D*)(?P<majorVersion>\d*)(?P<minorVersion>(?:\.\d*)*)/i",$userAgent, $matches);
        }
        if ($found) {
            $browser = $matches['browser'];
            $majorVersion = $matches['majorVersion'];
            $minorVersion = $matches['minorVersion'];
            $fullVersion = $matches['majorVersion'].$matches['minorVersion'];
            if ($browser != 'safari') {
                if (preg_match("/version\/(?P<majorVersion>\d*)(?P<minorVersion>(?:\.\d*)*)/i",$userAgent, $matches)) {
                    $majorVersion = $matches['majorVersion'];
                    $minorVersion = $matches['minorVersion'];
                    $fullVersion = $majorVersion.'.'.$minorVersion;
                }
            }
            if ($browser == 'msie') {
                if (stristr($userAgent, 'Trident/5.0')) {
                    $majorVersion = 9;
                    $minorVersion = 0;
                    $fullVersion = $majorVersion.'.'.$minorVersion;
                }
            }
        }
        if (strpos($userAgent, 'linux')) {
            $os = 'linux';
        } elseif (strpos($userAgent, 'macintosh') || strpos($userAgent, 'mac os x')) {
            $os = 'mac';
        } elseif (strpos($userAgent, 'windows') || strpos($userAgent, 'win32')) {
            $os = 'windows';
        }
        return array(
            'browser' => $browser,
            'majorVersion' => $majorVersion,
            'minorVersion' => $minorVersion,
            'fullVersion' => $fullVersion,
            'os' => $os
        );
    }
    public function icon($zoom, $name, $ins = '', $css = '')
    {
        $exclArr1 = array('prev', 'next', 'play');
        $exclArr2 = array('arrowLeft', 'arrowRight');
        if ($zoom['config']['displayNavi']
            || $zoom['config']['fullScreenNaviBar']
            || ($zoom['config']['galleryNavi'] && $zoom['config']['galleryNaviPos'] && in_array($name, $exclArr1))
            || (($zoom['config']['useHorGallery'] || $zoom['config']['fullScreenHorzGallery']) && in_array($name, $exclArr2))
        ) {
            $iconSrc = $zoom['config']['icon'].$zoom['config']['icons'][$name]['file'].$ins.'.'.$zoom['config']['icons'][$name]['ext'];
        } else {
            $iconSrc = $zoom['config']['icon'].'empty.gif';
        }
        $title = $zoom['config']['mapButTitle'][$name];
        $w = $zoom['config']['icons'][$name]['w'];
        $h = $zoom['config']['icons'][$name]['h'];
        $ws = (int)$w == $w ? $w.'px' : $w;
        $wh = (int)$h == $h ? $h.'px' : $h;
        $style = $css;
        if ($w && $ws) {
            $style .= 'width: '.$ws.'; ';
        }
        if ($h && $wh) {
            $style .= 'height: '.$wh.'; ';
        }
        return 'src="'.$iconSrc.'" width="'.$w.'" height="'.$h.'" style="'.$style.'" alt="'.$title.'" unselectable="on" title=""';
    }
    public function naviDeviderTd($zoom, $id = '') {
        $a = '<td id="'.$id.'" style="width: '.$zoom['config']['naviGroupSpace'].'px">';
            $a .= '<img src="'.$zoom['config']['icon'].'empty.gif" style="width: '.round($zoom['config']['naviGroupSpace']/2).'px; height: 10px;" alt="" title="">';
        $a .= '</td>';
        return $a;
    }
    public function drawZoomBox($zoom, $zoomTmp)
    {
        $startTime = microtime(true);
        if (!isset($zoom['config']['smallImgSize']) || !isset($zoom['config']['smallImgSize'][0])) {
            $zoom['config']['smallImgSize'] = array(0, 0);
        }
        $browser = $this->getBrowserInfo();
        $return = '';
        if (isset($zoom['config']['smallImgSize']) && isset($zoom['config']['smallImgSize'][0]) && isset($zoom['config']['smallImgSize'][1])) {
            $zoomW = $zoom['config']['smallImgSize'][0];
            $zoomH = $zoom['config']['smallImgSize'][1];
        } else {
            $zoomW = 0;
            $zoomH = 0;
        }
        if ($zoom['config']['keepBoxW']) {
            $zoomW = $zoom['config']['picX'];
        }
        if ($zoom['config']['keepBoxH']) {
            $zoomH = $zoom['config']['picY'];
        }
        $extPix = intval($zoom['config']['innerMargin']*2);
        $extPixBoth = 0;
        $extPixGal = 0;
        $zoomGalWidth = 0;
        if ($zoom['config']['useGallery']) {
            $gallerySpace = $zoom['config']['galleryWidth'];
            $extPixGal = $gallerySpace + $extPix;
            $zoomGalWidth = $gallerySpace;
        } else {
            $extPixGal = $extPix;
        }
        $zoomGalHeight = $zoomH + $extPix;
        if ($zoom['config']['displayNavi']) {
            $zoomGalHeight += $zoom['config']['naviHeight'];
        }
        if ($zoom['config']['zoomStat'] && $zoom['config']['zoomStatHeight']) {
            $zoomGalHeight += (int)$zoom['config']['zoomStatHeight'];
        }
        if ($zoom['config']['useHorGallery']) {
            $zoomGalHeight += (int)$zoom['config']['galHorHeight'];
        }
        $deviderTD = '<td style="width: '.($zoom['config']['naviGroupSpace']).'px">';
            $deviderTD .= '<img src="'.$zoom['config']['icon'].'empty.gif" style="width: '.round($zoom['config']['naviGroupSpace']/2).'px; height: 10px;" alt="" title="">';
        $deviderTD .= '</td>';
        $galleryNavi = '';
        if ($zoom['config']['galleryNavi']) {
            $galleryNavi = '<table cellspacing="0" cellpadding="0" style="height: '.$zoom['config']['galleryNaviHeight'].'px;"><tbody><tr>';
            $galleryNavi .= '<td style="width: '.($zoom['config']['galleryButtonSpace'] + $zoom['config']['icons']['prev']['w']).'px; text-align: left; vertical-align: middle;">';
            $galleryNavi .= '<img id="axZm_zoomNaviPrev" '.$this->icon($zoom, 'prev').'>';
            $galleryNavi .= '</td>';
            if ($zoom['config']['galleryPlayButton']) {
                $galleryNavi .= '<td style="width: '.($zoom['config']['galleryButtonSpace'] + $zoom['config']['icons']['play']['w']).'px; text-align: left; vertical-align: middle;">';
                $galleryNavi .= '<img id="axZm_zoomNaviPlayPause" '.$this->icon($zoom, 'play').'>';
                $galleryNavi .= '</td>';
            }
            $galleryNavi .= '<td style="width: '.($zoom['config']['icons']['next']['w']).'px; text-align: left; vertical-align: middle;">';
            $galleryNavi .= '<img id="axZm_zoomNaviNext" '.$this->icon($zoom, 'next').'>';
            $galleryNavi .= '</td>';
            $galleryNavi .= '</tr></tbody></table>';
            $galleryNavi = '<div id="axZm_zoomGalleryNaviButtons" style="float: right">'.$galleryNavi.'</div>';
        }
        $horGallery = '';
        if ($zoom['config']['useHorGallery']) {
            $hrzW = $zoomW + $extPix - $zoom['config']['galHorPadding']['left'] - $zoom['config']['galHorPadding']['right'];
            $hrzH = $zoom['config']['galHorHeight'] - $zoom['config']['galHorPadding']['top'] - $zoom['config']['galHorPadding']['bottom'];
            $horGallery .= '<div id="axZm_zoomGalHorCont" class="axZm_zoomGalleryHorizontalContainer" style="padding: '.$zoom['config']['galHorPadding']['top'].'px '.$zoom['config']['galHorPadding']['right'].'px '.$zoom['config']['galHorPadding']['bottom'].'px '.$zoom['config']['galHorPadding']['left'].'px; width:'.$hrzW.'px; height: '.$hrzH.'px">';
            $horGallery .= '<div id="axZm_zoomGalHor" class="axZm_zoomGalleryHorizontal"></div>';
            $horGallery .= '</div>';
        }
        $zoomNavi = '';
        $zoomNavi .= '<div id="axZm_zoomNavigation" class="axZm_zoomNavigation" style="width:'.($zoomW + $extPix).'px; height:'.$zoom['config']['naviHeight'].'px; display: '.( $zoom['config']['displayNavi'] ? 'block' : 'none' ).'">';
        $navFloat = 'left';
        if ($zoom['config']['useGallery'] && $zoom['config']['galleryPos'] == 'left') {
            $navFloat = 'right';
        }
        $navMargin = 'margin: '.$zoom['config']['naviTopMargin'].'px '.$zoom['config']['innerMargin'].'px 0px '.$zoom['config']['innerMargin'].'px;';
        $navWidth = $zoomW;
        if ($zoom['config']['innerMargin'] < $zoom['config']['naviMinPadding']) {
            $dMargin = $zoom['config']['naviMinPadding'] - $zoom['config']['innerMargin'];
            if ($zoom['config']['useGallery']) {
                $navWidth = $navWidth - $dMargin;
                if ($zoom['config']['galleryPos'] == 'left') {
                    $navMargin = 'margin: '.$zoom['config']['naviTopMargin'].'px '.($dMargin+$zoom['config']['innerMargin']).'px 0px 0px;';
                } elseif ($zoom['config']['galleryPos'] == 'right') {
                    $navMargin = 'margin: '.$zoom['config']['naviTopMargin'].'px 0px 0px '.($dMargin+$zoom['config']['innerMargin']).'px;';
                }
            } else {
                $navWidth = $navWidth - ($dMargin * 2);
                $navMargin = 'margin: '.$zoom['config']['naviTopMargin'].'px '.($dMargin + $zoom['config']['innerMargin']).'px 0px '.($dMargin + $zoom['config']['innerMargin']).'px;';
            }
        }
        $zoomNavi .= '<div id="axZm_zoomNaviInner" style="display: inline; float: '.$navFloat.'; text-align: left; padding: 0px; width: '.$navWidth.'px; '.$navMargin.'">';
        $zoomNavi .= '<table id="axZm_zoomNaviTableOuter" cellspacing="0" cellpadding="0" style="padding: 0px; margin: 0px; width:'.($navWidth).'px; height: '.($zoom['config']['naviHeight'] - $zoom['config']['naviTopMargin']).'px"><tbody><tr>';
        $naviInfo = '';
        $naviInfoAlign = ($zoom['config']['naviFloat'] == 'right') ? 'left' : 'right';
        if (!$zoom['config']['zoomLogInfoDisabled']) {
            if ($zoom['config']['zoomLogInfo']) {
                $naviInfo .= '<td id="axZm_zoomLogHolderTd">';
                    $naviInfo .= '<div id="axZm_zoomLogHolder" class="axZm_zoomLogHolder" style="float: '.$naviInfoAlign.'; text-align: '.$naviInfoAlign.';">';
                        $naviInfo .= '<div id="axZm_zoomTime" class="axZm_zoomLog"></div>';
                        $naviInfo .= '<div id="axZm_zoomLevel" class="axZm_zoomLog"></div>';
                        $naviInfo .= '<div id="axZm_zoomTraffic" class="axZm_zoomLog"></div>';
                    $naviInfo .= '</div>';
                $naviInfo .= '</td>';
            } elseif ($zoom['config']['zoomLogJustLevel']) {
                $naviInfo .= '<td id="axZm_zoomLogHolderTd" style="vertical-align: top;">';
                    $naviInfo .= '<div id="axZm_zoomLogHolder" class="axZm_zoomLogHolder" style="float: '.$naviInfoAlign.'; text-align: '.$naviInfoAlign.';">';
                    $naviInfo .= '<div id="axZm_zoomLevel" class="axZm_zoomLogJustLevel"></div>';
                    $naviInfo .= '</div>';
                $naviInfo .= '</td>';
            }
        }
        $naviButtons = '<td style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle;">';
        $naviButtons .= '<table id="axZm_zoomNaviTable" class="axZm_zoomNaviTable" cellspacing="0" cellpadding="0" style="float: '.$zoom['config']['naviFloat'].'"><tbody><tr>';
        $toolsSpacer = false;
        if ($zoom['config']['naviPanButSwitch']) {
            $naviButtons .= '<td id="axZm_zoomNaviPanTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['pan']['w'] + $zoom['config']['naviSpace']).'px">';
                $naviButtons .= '<img id="axZm_zoomNaviPan" '.$this->icon($zoom, 'pan').'>';
            $naviButtons .= '</td>';
            $toolsSpacer = true;
        }
        if ($zoom['config']['spinMod'] && $zoom['config']['naviSpinButSwitch']) {
            $naviButtons .= '<td id="axZm_zoomNaviSpinTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['spin']['w'] + $zoom['config']['naviSpace']).'px">';
            $naviButtons .= '<img id="axZm_zoomNaviSpin" '.$this->icon($zoom, 'spin').'>';
            $naviButtons .= '</td>';
            $toolsSpacer = true;
        }
        if ($zoom['config']['naviCropButSwitch']) {
            $naviButtons .= '<td id="axZm_zoomNaviCropTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['crop']['w'] + $zoom['config']['naviSpace']).'px">';
            $naviButtons .= '<img id="axZm_zoomNaviCrop" '.$this->icon($zoom, 'crop').'>';
            $naviButtons .= '</td>';
            $toolsSpacer = true;
        }
        if ($toolsSpacer) {
            $naviButtons .= $this->naviDeviderTd($zoom, 'axZm_zoomNaviToolsDevider');
        }
        if ($zoom['config']['naviZoomBut']) {
            if ($zoom['config']['naviBigZoom']) {
                $naviButtons .= '<td id="axZm_zoomNaviTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['zoomOutBig']['w'] + $zoom['config']['naviSpace']).'px">';
                    $naviButtons .= '<img id="axZm_zoomNaviOut" '.$this->icon($zoom, 'zoomOutBig').'>';
                $naviButtons .= '</td>';
                $naviButtons .= '<td id="axZm_zoomNaviInTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['zoomInBig']['w'] + $zoom['config']['naviSpace']).'px">';
                    $naviButtons .= '<img id="axZm_zoomNaviIn" '.$this->icon($zoom, 'zoomInBig').'>';
                $naviButtons .= '</td>';
            } else {
                $naviButtons .= '<td id="axZm_zoomNaviInOutTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['zoomIn']['w'] + $zoom['config']['naviSpace']).'px">';
                    $naviButtons .= '<table cellspacing="0" cellpadding="0"><tbody>';
                        $naviButtons .= '<tr><td style="width: '.($zoom['config']['icons']['zoomIn']['w']).'px;"><img id="axZm_zoomNaviIn" '.$this->icon($zoom, 'zoomIn', '', 'vertical-align: bottom; margin-bottom: 3px;').'></td></tr>';
                        $naviButtons .= '<tr><td style="width: '.($zoom['config']['icons']['zoomOut']['w']).'px; vertical-align: top;"><img id="axZm_zoomNaviOut" '.$this->icon($zoom, 'zoomOut').'></td></tr>';
                    $naviButtons .= '</tbody></table>';
                $naviButtons .= '</td>';
            }
            $naviButtons .= $this->naviDeviderTd($zoom, 'axZm_zoomNaviInOutDevider');
        }
        if ($zoom['config']['naviPanBut']) {
            $navPanWidth = ($zoom['config']['icons']['moveLeft']['w'] + 4 + $zoom['config']['icons']['moveTop']['w'] + $zoom['config']['icons']['moveRight']['w'] + 2);
            $naviButtons .= '<td id="axZm_zoomNaviPanButTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.$navPanWidth.'px">';
                $naviButtons .= '<table cellspacing="0" cellpadding="0"><tbody><tr>';
                    $naviButtons .= '<td style="width: '.($zoom['config']['icons']['moveLeft']['w'] + 2).'px; vertical-align: middle;"><img id="axZm_zoomNaviML" '.$this->icon($zoom, 'moveLeft', '', 'margin-right: 2px;').'></td>';
                    $naviButtons .= '<td style="width: '.($zoom['config']['icons']['moveTop']['w']).'px; vertical-align: middle;">';
                    $naviButtons .= '<img id="axZm_zoomNaviMT" '.$this->icon($zoom, 'moveTop', '', 'vertical-align: bottom; margin-bottom: 2px;').'>';
                    $naviButtons .= '<img id="axZm_zoomNaviMB" '.$this->icon($zoom, 'moveBottom', '', 'vertical-align: top;').'>';
                    $naviButtons .= '</td>';
                    $naviButtons .= '<td style="width: '.($zoom['config']['icons']['moveRight']['w'] + 2).'px; vertical-align: middle;"><img id="axZm_zoomNaviMR" '.$this->icon($zoom, 'moveRight', '', 'margin-left: 2px;').'></td>';
                $naviButtons .= '</tr></tbody></table>';
            $naviButtons .= '</td>';
            $naviButtons .= $this->naviDeviderTd($zoom, 'axZm_zoomNaviPanButDevider');
        }
        if ($zoom['config']['naviRestoreBut']) {
            $naviButtons .= '<td id="axZm_zoomNavi100Td" style="text-align: left; vertical-align: middle; width: '.($zoom['config']['icons']['reset']['w'] + $zoom['config']['naviSpace']).'px">';
                $naviButtons .= '<img id="axZm_zoomNavi100" '.$this->icon($zoom, 'reset').'>';
            $naviButtons .= '</td>';
        }
        $naviButtons .= '</tr></tbody></table>';
        $naviButtons .= '</td>';
        if (
            ($zoom['config']['useFullGallery'] && $zoom['config']['galFullButton']) ||
            ($zoom['config']['mapButton'] && $zoom['config']['useMap']) ||
            $zoom['config']['help'] ||
            $zoom['config']['naviHotspotsBut'] ||
            ($zoom['config']['fullScreenNaviButton'] && $zoom['config']['fullScreenEnable']) ||
            ($zoom['config']['downloadButton'] && $zoom['config']['allowDownload']) ||
            ($zoom['config']['fullScreenEnable'] && $zoom['config']['fullScreenNaviButton'])
        ) {
            $zoomNaviControls = '<table id="axZm_zoomNaviControls" class="axZm_zoomNaviControls" cellspacing="0" cellpadding="0" style="float: '.$zoom['config']['naviFloat'].'"><tbody><tr>';
            $zoomNaviControlsWidth = 0;
            if ($zoom['config']['useFullGallery'] && $zoom['config']['galFullButton']) {
                $zoomNaviControlsWidth += ($zoom['config']['icons']['gallery']['w'] + $zoom['config']['naviSpace']);
                $zoomNaviControls .= '<td id="axZm_zoomGalButtonTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['gallery']['w'] + $zoom['config']['naviSpace']).'px">';
                    $zoomNaviControls .= '<img id="axZm_zoomGalButton" '.$this->icon($zoom, 'gallery').'>';
                $zoomNaviControls .= '</td>';
            }
            if ($zoom['config']['mapButton'] && $zoom['config']['useMap']) {
                $zoomNaviControlsWidth += ($zoom['config']['icons']['map']['w'] + $zoom['config']['naviSpace']);
                $zoomNaviControls .= '<td id="axZm_zoomMapButtonTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['map']['w'] + $zoom['config']['naviSpace']).'px">';
                    $zoomNaviControls .= '<img id="axZm_zoomMapButton" '.$this->icon($zoom, 'map', '_switched').'>';
                $zoomNaviControls .= '</td>';
            }
            if ($zoom['config']['help']) {
                $zoomNaviControlsWidth += ($zoom['config']['icons']['help']['w'] + $zoom['config']['naviSpace']);
                $zoomNaviControls .= '<td id="axZm_zoomHelpTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['help']['w'] + $zoom['config']['naviSpace']).'px">';
                    $zoomNaviControls .= '<img id="axZm_zoomHelp" '.$this->icon($zoom, 'help').'>';
                $zoomNaviControls .= '</td>';
            }
            if ($zoom['config']['downloadButton'] && $zoom['config']['allowDownload']) {
                $zoomNaviControlsWidth += ($zoom['config']['icons']['download']['w'] + $zoom['config']['naviSpace']);
                $zoomNaviControls .= '<td id="axZm_zoomDownloadTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['download']['w'] + $zoom['config']['naviSpace']).'px">';
                    $zoomNaviControls .= '<img id="axZm_zoomDownload" '.$this->icon($zoom, 'download').'>';
                $zoomNaviControls .= '</td>';
            }
            if ($zoom['config']['naviHotspotsBut']) {
                $zoomNaviControlsWidth += ($zoom['config']['icons']['hotspots']['w'] + $zoom['config']['naviSpace']);
                $zoomNaviControls .= '<td id="axZm_zoomHotspotsTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['hotspots']['w'] + $zoom['config']['naviSpace']).'px">';
                    $zoomNaviControls .= '<img id="axZm_zoomHotspots" '.$this->icon($zoom, 'hotspots').'>';
                $zoomNaviControls .= '</td>';
            }
            if ($zoom['config']['fullScreenEnable'] && $zoom['config']['fullScreenNaviButton']) {
                $zoomNaviControlsWidth += ($zoom['config']['icons']['fullScreen']['w'] + $zoom['config']['naviSpace']);
                $zoomNaviControls .= '<td id="axZm_zoomFullScreenButtonTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.($zoom['config']['icons']['fullScreen']['w'] + $zoom['config']['naviSpace']).'px">';
                    $zoomNaviControls .= '<img id="axZm_zoomFullScreenButton" '.$this->icon($zoom, 'fullScreen').'>';
                $zoomNaviControls .= '</td>';
            }
            $zoomNaviControls .= '</tr></tbody></table>';
            $naviButtons .= '<td id="axZm_zoomNaviControlsTd" style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle;">';
                $naviButtons .= $zoomNaviControls;
            $naviButtons .= '</td>';
        }
        if ($zoom['config']['galleryNavi'] && $zoom['config']['galleryNaviPos'] == 'navi') {
            $galleryNaviWidth = $zoom['config']['icons']['prev']['w'] + $zoom['config']['icons']['next']['w'] + $zoom['config']['galleryButtonSpace'];
            if ($zoom['config']['galleryPlayButton']) {
                $galleryNaviWidth += $zoom['config']['galleryButtonSpace'] + $zoom['config']['icons']['play']['w'];
            }
            $galleryNaviWidth += $zoom['config']['naviGroupSpace'];
            $naviButtons .= '<td style="text-align: '.$zoom['config']['naviFloat'].'; vertical-align: middle; width: '.$galleryNaviWidth.'px">';
                $naviButtons .= $galleryNavi;
            $naviButtons .= '</td>';
        }
        if ($zoom['config']['naviFloat'] == 'right') {
            $zoomNavi .= $naviInfo.$naviButtons;
        } else {
            $zoomNavi .= $naviButtons.$naviInfo;
        }
        $zoomNavi .= '</tr></tbody></table>';
        $zoomNavi .= '</div>';
        $zoomNavi .= '</div>';
        $vertGallery = '';
        if ($zoom['config']['useGallery']) {
            $vertGallery = '<div id="axZm_zoomGalleryVerticalContainer" class="axZm_zoomGalleryVerticalContainer" style="float: '.$zoom['config']['galleryPos'].'; width: '.($extPixGal - $extPix).'px; height:'.($zoomGalHeight - $extPixBoth).'px;">';
            if ($zoom['config']['galleryNavi'] && in_array($zoom['config']['galleryNaviPos'], array('top', 'bottom'))) {
                $galleryNaviVert = '<div class="axZm_zoomGalleryVerticalNavi" id="axZm_zoomGalleryNavi" style="text-align: left; padding: 0px; width: '.$zoomGalWidth.'px; height: '.$zoom['config']['galleryNaviHeight'].'px;">';
                foreach ($zoom['config']['galleryNaviMargin'] as $k => $v) {
                    $galleryNaviMargin .= $v.'px ';
                }
                $galleryNaviVert .= '<div style="display: inline; margin: '.$galleryNaviMargin.'; float: right; padding: 0px;">';
                $galleryNaviVert .= $galleryNavi;
                $galleryNaviVert .= '</div>';
                $galleryNaviVert .= '</div>';
            }
            if ($zoom['config']['galleryNavi'] && $zoom['config']['galleryNaviPos'] == 'top') {
                $vertGallery .= $galleryNaviVert;
            }
            $galHeightReduce = 0;
            if ($zoom['config']['galleryNavi'] && in_array($zoom['config']['galleryNaviPos'], array('top', 'bottom'))) {
                $galHeightReduce = $zoom['config']['galleryNaviHeight'];
            }
            $vertGallery .= '<div id="axZm_zoomGallery" class="axZm_zoomGalleryVertical" style="width: '.$zoomGalWidth.'px; height:'.($zoomGalHeight - $extPixBoth - $galHeightReduce).'px;"></div>';
            if ($zoom['config']['galleryNavi'] && $zoom['config']['galleryNaviPos'] == 'bottom') {
                $vertGallery .= $galleryNaviVert;
            }
            $vertGallery .= '</div>';
        }
        $return .= '<div id="axZm_zoomAll" class="axZm_zoomAll" style="margin: 0; width: '.($zoomW + $extPixGal).'px; overflow-x: hidden;">';
        if ($zoom['config']['useGallery']) {
            $return .= $vertGallery;
        }
        if ($zoom['config']['useHorGallery'] && $zoom['config']['galHorPosition'] == 'top1') {
            $return .= $horGallery;
        }
        if ($zoom['config']['naviPos'] == 'top') {
            $return .= $zoomNavi;
        }
        if ($zoom['config']['useHorGallery'] && $zoom['config']['galHorPosition'] == 'top2') {
            $return .= $horGallery;
        }
        $return .= '<div id="axZm_zoomBorder" class="axZm_zoomBorder" style="width:'.($zoomW + $extPix).'px; height:'.($zoomH + $extPix - $extPixBoth).'px;">';
        $zoomContainerFloat = 'float: left;';
        if ($zoom['config']['useGallery'] && $zoom['config']['galleryPos'] == 'left') {
            $zoomContainerFloat = 'float: right;';
        }
        $return .= '<div id="axZm_zoomContainer" class="axZm_zoomContainer axZm_loading" style="width:'.$zoomW.'px; height:'.$zoomH.'px; text-align: left; margin: '.$zoom['config']['innerMargin'].'px; '.$zoomContainerFloat.'">';
        $return .= '<div id="axZm_zoomLoaderHolder" class="axZm_zoomLoaderHolder">';
        $return .= '<div id="axZm_zoomLoader" class="'.$zoom['config']['zoomLoaderClass'].'"></div>';
        $return .= '</div>';
        $return .= '<div id="axZm_zoomWarning" class="axZm_zoomWarning"></div>';
        $return .= '<div id="'.$zoom['config']['backDiv'].'" class="axZm_zoomedBack" style="width: '.$zoomW.'px; height: '.$zoomH.'px;">';
        $return .= '<div id="'.$zoom['config']['backInnerDiv'].'" class="axZm_zoomedBackImage" style="width: '.$zoomW.'px; height: '.$zoomH.'px;"><img src="'.$zoom['config']['icon'].'empty.gif" id="'.$zoom['config']['backLayer'].'" style="position: static; width:'.$zoom['config']['smallImgSize'][0].'px; height:'.$zoom['config']['smallImgSize'][1].'px;" unselectable="on"></div>';
        $return .= '</div>';
        $return .= '<div id="axZm_zoomedImageContainer" class="axZm_zoomedImageContainer" style="width: '.$zoomW.'px; height: '.$zoomH.'px;">';
        $return .= '<div id="axZm_zoomedImage" class="axZm_zoomedImage" style="width:'.$zoomW.'px; height: '.$zoomH.'px;"><img src="'.$zoom['config']['icon'].'empty.gif" id="'.$zoom['config']['picLayer'].'" style="position: static; width:'.($zoom['config']['smallImgSize'][0]).'px; height:'.($zoom['config']['smallImgSize'][1]).'px;" unselectable="on"></div>';
        $return .= '</div>';
        $return .= '<div id="axZm_zoomLayer" class="axZm_zoomLayer" style="width: '.$zoomW.'px; height: '.$zoomH.'px;">';
        if ($zoom['config']['vWtrmrk']) {
            $return .= '<div id="axZm_zoomWtrmrk" class="'.$zoom['config']['vWtrmrk'].'" style="width: '.$zoomW.'px; height: '.$zoomH.'px;"></div>';
        }
        if ($browser['browser'] == 'msie') {
            $return .= '<img id="'.$zoom['config']['overLayer'].'" class="axZm_zoomLayerImg" src="'.$zoom['config']['icon'].'empty.gif" style="width: '.$zoomW.'px; height: '.$zoomH.'px; z-index: 1;" alt="" unselectable="on">';
        } else {
            $return .= '<div id="'.$zoom['config']['overLayer'].'" class="axZm_zoomLayerImg" style="width: '.$zoomW.'px; height: '.$zoomH.'px; z-index: 1; background-image: url('.$zoom['config']['icon'].'empty.gif);" unselectable="on"></div>';
        }
        $return .= $this->axZm->wtrHtml($zoom);
        $return .= '</div>';
        if ($zoom['config']['useFullGallery'] && !$zoom['config']['spinMod']) {
            $return .= '<div id="axZm_zoomFullGalleryHolder" class="axZm_zoomFullGalleryHolder" style="width: '.$zoomW.'px; height: '.$zoomH.'px;">';
            $return .= '<div id="axZm_zoomFullGallery" class="axZm_zoomFullGallery" style="width: '.$zoomW.'px; height: '.$zoomH.'px;">';
            $return .= '</div>';
            $return .= '</div>';
        }
        if ($zoom['config']['help']) {
            $return .= '<div id="axZm_zoomedHelpHolder" class="axZm_zoomedHelpHolder" style="width: '.$zoomW.'px; height: '.$zoomH.'px;">';
            $return .= '<div id="axZm_zoomedHelp" class="axZm_zoomedHelp" style="left: '.$zoom['config']['helpMargin'].'px; top: '.$zoom['config']['helpMargin'].'px; width: '.($zoomW - ($zoom['config']['helpMargin'] * 2)).'px; height: '.($zoomH - ($zoom['config']['helpMargin'] * 2)).'px;">';
            if ($zoom['config']['helpUrl']) {
                $return .= '<iframe SRC="'.$zoom['config']['helpUrl'].'" WIDTH="100%" HEIGHT="100%" FRAMEBORDER="0" style="width: 100%; height: 100%" allowfullscreen></iframe>';
            } else {
                $return .= str_replace('[icon]', $zoom['config']['icon'], $zoom['config']['helpTxt']);
            }
            $return .= '</div>';
            $return .= '</div>';
        }
        $return .= '<div id="axZm_zoomDescrHolder" class="axZm_zoomDescrHolder" style="width: 100%; height: 100%">';
        $return .= '<div id="axZm_zoomDescr" class="axZm_zoomDescr" style="width: 100%; height: '.$zoom['config']['descrAreaHeight'].'px; top: '.($zoomH - $zoom['config']['descrAreaHeight']).'px;"></div>';
        $return .= '</div>';
        $return .= '</div>';
        $return .= '</div>';
        if ($zoom['config']['useHorGallery'] && $zoom['config']['galHorPosition'] == 'bottom1') {
            $return .= $horGallery;
        }
        if ($zoom['config']['naviPos'] == 'bottom') {
            $return .= $zoomNavi;
        }
        if ($zoom['config']['useHorGallery'] && $zoom['config']['galHorPosition'] == 'bottom2') {
            $return .= $horGallery;
        }
        if ($zoom['config']['zoomStat']) {
            $return .= '<div id="axZm_zoomAdmin" class="axZm_zoomAdmin" style="width: '.($zoomW + $extPix).'px; height: '.$zoom['config']['zoomStatHeight'].'px;"><div id="axZm_zoomAdminHtml" style="padding: 0 5px"></div></div>';
        }
        $return .= '<div id="axZm_zoomOpr" style="height: 0px; visibility: hidden; display: none; overflow: hidden;"></div>';
        if ($zoom['config']['visualConf']) {
            $return .= $this->visualConf($zoom, $zoomTmp, $zoomW, $extPixGal);
        }
        $return .= '</div>';
        if ($zoom['config']['cornerRadius'] > 0) {
            $return = '<div id="axZm_zoomCornerRadius" class="axZm_zoomCornerRadius'.($zoom['config']['cornerRadiusNotRound'] ? ' axZm_noBorderRadius' : '').'" style="display: block; width: '.($zoomW + $extPixGal).'px; padding: '.$zoom['config']['cornerRadius'].'px;">'.$return.'</div>';
        }
        if ($zoom['config']['cTimeCompareDialog'] == true && is_array($this->returnCTimeCompare)) {
            $return .= '<script type="text/javascript">setTimeout(function(){jQuery.fn.axZm.zoomAlert(\'Option cTimeCompare considered to regenerate tiles and all other dynamically generated images: ';
            $return .= '<br><br>'.implode(', ', $this->returnCTimeCompare).';<br><br>If you did not change the source images or AJAX-ZOOM mistakenly regenerates these images, ';
            $return .= 'then please disable cTimeCompare in zoomConfig.inc.php and zoomConfigCustom.inc.php<br><br>\',\'Old tiles deleted! Why that?\', \''.$this->msgNoteInstr.'\'); },1000);</script>';
        }
        if (isset($this->returnMakeFirstImage)) {
            if (!is_bool($this->returnMakeFirstImage)) {
                $return .= $this->returnMakeFirstImage;
            }
        }
        if (isset($this->returnMakeZoomTiles)) {
            if (!is_bool($this->returnMakeZoomTiles)) {
                $return .= $this->returnMakeZoomTiles;
            }
        }
        if (isset($this->returnMakeAllThumbs)) {
            if (!is_bool($this->returnMakeAllThumbs)) {
                $return .= $this->returnMakeAllThumbs;
            }
        }
        if (isset($this->fileErrorDialog)) {
            if (!is_bool($this->fileErrorDialog)) {
                $return .= $this->fileErrorDialog;
            }
        }
        $this->readTime['box'] = $this->endTimeDiff($startTime);
        return $return;
    }
    function visualConf($zoom,$zoomTmp,$zoomW,$extPixGal)
    {
        $autoSubmit = false;
        $return = '';
        $return .= '<div style="clear: both; float: left; height:15px; line-height:1px;"> </div>';
        $return .= '<div id="zoomDemoContainer" style="float: left;">';
        $return .= '<div id="zoomAjaxDemoButton" class="zoomAjaxDemoButton" style="width:'.($zoomW+$extPixGal).'px;"><div style="padding: 0px 5px;"><p style="margin-top:11px">>> VISUAL CONFIGURATION FOR SOME PARAMETERS</p></div></div>';
        $return .= '<div id="zoomAjaxDemo" style="float: left; display: none; width:'.($zoomW+$extPixGal).'px; background-color:#000000;">';
        $arrayMotion=array(
            'swing',
            'jswing',
            'linear',
            'easeInQuad',
            'easeOutQuad',
            'easeInOutQuad',
            'easeInCubic',
            'easeOutCubic',
            'easeInOutCubic',
            'easeInQuart',
            'easeOutQuart',
            'easeInOutQuart',
            'easeInQuint',
            'easeOutQuint',
            'easeInOutQuint',
            'easeInSine',
            'easeOutSine',
            'easeInOutSine',
            'easeInExpo',
            'easeOutExpo',
            'easeInOutExpo',
            'easeInCirc',
            'easeOutCirc',
            'easeInOutCirc',
            'easeInElastic',
            'easeOutElastic',
            'easeInOutElastic',
            'easeInBack',
            'easeOutBack',
            'easeInOutBack',
            'easeInBounce',
            'easeOutBounce',
            'easeInOutBounce'
        );
        $arrayJpgQual=array(10,20,30,40,50,60,65,70,75,80,85,90,95,97,100);
        $arrayDigits=array(0,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95,100);
        $arrayZoomBy=array(20,25,30,35,40,45,50,60,65,70,75,100,125,150,175,200,250,300,400,500,750,1000,1500,2000);
        $arrayZoomClick=array(50,100,200,300,400,500,750,1000,1250,1500,2000,2500,3000,4000,5000);
        $arrayMoveBy=array(20,25,30,35,40,45,50,60,65,70,75,100,125,150,175,200,250);
        $arrayZoomMove=array(50,100,200,300,400,500,750,1000,1250,1500,2000,2500,3000);
        $arrayOpacity=array(0,0.5,1,1.5,2,2.5,3,4,5,6,7,8,9,9.5,10);
        $arrayBorderWidth=array(1,2,3,4,5);
        $arrayLoaderPos=array('Center', 'TopLeft', 'TopRight', 'BottomLeft', 'BottomRight');
        $arrayMapFract=array(10,15,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,70,80,90,100);
        $arrayBg=array('wallpaper1.jpg', 'wallpaper2.jpg');
        $return .= '<table cellspacing="0" cellpadding="0" style="margin: 10px 5px 5px 5px; display: block;"><tbody><tr><td style="width:49%" valign="top">';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; color: #F4E10A">MOTION SETTINGS</div>';
        $return .= '<form id="aniForm" action="" onsubmit="return false;">';
        $return .= '<div class="axZm_zoomText">';
        $return .= '<input type="checkbox" id="motionSwitch" value="1" onclick="demoShowSwitch(); this.blur();" checked> - Preview motion settings. Note: the preview will not perform serverside resizing';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoClickRatio(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomBy, $zoom['config']['pZoom'], $opr = false, $add = '%');
        $return .= '</select> - Click ZOOM IN</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoClickOutRatio(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomBy, $zoom['config']['pZoomOut'], $opr = false, $add = '%');
        $return .= '</select> - Click ZOOM OUT</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMoveRatio(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayMoveBy, $zoom['config']['pMove'], $opr = false, $add='%');
        $return .= '</select> - Move buttons by</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoClickSpeed(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomClick, $zoom['config']['zoomSpeed'], $opr = false, $add = 'ms');
        $return .= '</select> - Click/Plus ZOOM IN Speed</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoClickZoomOut(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomClick, $zoom['config']['zoomOutSpeed'], $opr = false, $add = 'ms');
        $return .= '</select> - Right Click / Minus ZOOM OUT Speed</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMoveSpeed(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['moveSpeed'], $opr = false, $add = 'ms');
        $return .= '</select> - Sidewards (buttons) speed</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoRestoreSpeed(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['restoreSpeed'], $opr = false, $add = 'ms');
        $return .= '</select> - Restore speed</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoTraverseSpeed(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['traverseSpeed'], $opr = false, $add = 'ms');
        $return .= '</select> - Traverse speed</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMotionIn(this.value);this.blur();" style="width:120px">';
        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseIn'], $opr = 'ucfirst', $add = false);
        $return .= '</select> - ZOOM IN Motion</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMotionOut(this.value);this.blur();" style="width:120px">';
        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseOut'], $opr = 'ucfirst', $add = false);
        $return .= '</select> - ZOOM OUT Motion</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMotionMove(this.value);this.blur();" style="width:120px">';
        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseMove'], $opr = 'ucfirst', $add = false);
        $return .= '</select> - Sidewards Motion</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMotionRestore(this.value);this.blur();" style="width:120px">';
        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseRestore'], $opr = 'ucfirst', $add = false);
        $return .= '</select> - Restore Motion</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMotionTraverse(this.value);this.blur();" style="width:120px">';
        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseTraverse'], $opr = 'ucfirst', $add = false);
        $return .= '</select> - Traverse Motion</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">IMAGE LOADER</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoLoaderPos(this.value);this.blur();" style="width:120px">';
        $return .= $this->sOptions($arrayLoaderPos, $zoom['config']['zoomLoaderPos'], $opr = false, $add = false);
        $return .= '</select> - Loader Position</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoLoaderTransp(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayDigits, ($zoom['config']['zoomLoaderTransp'] * 100), $opr = false, $add = '%');
        $return .= '</select> - Loader Transparency</div>';
        $return .= '</form>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">IMAGE QUALITY AND PHP</div>';
        $return .= '<form id="demoOptions" action="" onsubmit="return false;">';
        $return .= '<div style="display: none"><input type="hidden" name="submitO" value="1"></div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<select name="demoQ" onchange="jQuery.optSubmit(); this.blur();" style="width: 80px">';
        $return .= $this->sOptions($arrayJpgQual, $zoom['config']['qual'], $opr = false, $add = false);
        $return .= '</select> - JPG Quality';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoO" value="gd" onclick="jQuery.optSubmit();this.blur();"';
        if (!$zoom['config']['im']) {
            $return .= ' checked';
        }
        $return .= '> - GD  ';
        $return .= '<input type="radio" name="demoO" onclick="jQuery.optSubmit();this.blur();" value="im"';
        if ($zoom['config']['im']) {
            $return .= ' checked';
        }
        $return .= '> - ImageMagick';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">CROPPING METHOD</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<div>';
        $return .= '<input type="radio" name="demoP" value="1" onclick="jQuery.optSubmit(); this.blur();"';
        if (!$zoom['config']['gPyramid'] && !$zoom['config']['pyrTiles']) {
            $return .= ' checked';
        }
        $return .= '> - Crop from Original (slow) OK < 5-7 MP';
        $return .= '</div>';
        $return .= '<div>';
        $return .= '<input type="radio" name="demoP" value="2" onclick="jQuery.optSubmit(); this.blur();"';
        if ($zoom['config']['gPyramid']) {
            $return .= ' checked';
        }
        $return .= '> - Image Pyramid (faster) OK < 11-15 MP';
        $return .= '</div>';
        $return .= '<div>';
        $return .= '<input type="radio" name="demoP" value="3" onclick="jQuery.optSubmit(); this.blur();"';
        if ($zoom['config']['pyrTiles']) {
            $return .= ' checked';
        }
        $return .= '> - Image Pyramid with Tiles (very fast) ';
        $return .= '</div>';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">WATERMARK</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="checkbox" name="demoW" value="1" onclick="jQuery.optSubmit(); this.blur();"';
        if ($zoom['config']['watermark']) {
            $return .= ' checked';
        }
        $return .= '> - Watermark PNG Image Demo';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText">';
        $return .= '<input type="checkbox" name="demoT" value="1" onclick="jQuery.optSubmit(); this.blur();"';
        if ($zoom['config']['text']) {
            $return .= ' checked';
        }
        $return .= '> - Watermark Text Demo';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<span class="zoomTextS">You can set a bunch of other settings for watermarking</span>';
        $return .= '</div>';
        $return .= '</form>';
        $return .= '</td><td style="width:49%" valign="top">';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; color: #F4E10A">SELECTOR SPECIFIC SETTINGS</div>';
        $return .= '<form id="selForm" action="" onsubmit="return false;">';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="008000" id="demoColorArea">';
        $return .= ' - Selector color</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoSelOpacity(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayOpacity, ($zoom['config']['zoomSelectionOpacity']*10), $opr=create_function('$a','return ($a*10);'), $add='%');
        $return .= '</select> - Selector opacity</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="000000" id="demoColorOuter">';
        $return .= ' - Outer color</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoOuterOpacity(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayOpacity, ($zoom['config']['zoomOuterOpacity']*10), $opr=create_function('$a','return ($a*10);'), $add='%');
        $return .= '</select> - Outer opacity</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="ff0000" id="demoColorBorder">';
        $return .= ' - Selector border color</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoBorder(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayBorderWidth, $zoom['config']['zoomBorderWidth'], $opr=false, $add='px');
        $return .= '</select> - Selector border thickness</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoCropSpeed(this.value); this.blur();" style="width:80px">';
        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['cropSpeed'], $opr=false, $add='ms');
        $return .= '</select> - Selector ZOOM IN speed</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoMotionCrop(this.value); this.blur();" style="width:120px">';
        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseCrop'], $opr='ucfirst', $add=false);
        $return .= '</select> - S. ZOOM IN Motion</div>';
        $return .= '</form>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">LAYOUT</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="3E3E3E" id="demoColorStage">';
        $return .= ' - Stage color</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="FFFFFF" id="demoBodyColor">';
        $return .= ' - Body color</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onchange="demoBodyBack(this.value); this.blur();" style="width:80px">';
        $return .= '<option value="">None</option>';
        $return .= $this->sOptions($arrayBg, false, $opr='ucfirst', $add=false);
        $return .= '</select> - Body background</div>';
        $return .= '<form id="demoMix" action="'.$this->sanitizeUrl($_SERVER['PHP_SELF']).'" style="background-color: #1A1A1A; padding: 5px; border: #FFFFFF 1px solid;">';
        $return .= '<div style="display:none"><input type="hidden" name="zoomID" value="'.$_GET['zoomID'].'"></div>';
        $return .= '<div style="display:none"><input type="hidden" name="demoMix" value="1"></div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 5px; color: #F4E10A;">[The following settings will reload page]</div>';
        $return .= '<div class="axZm_zoomText"><select name="demoRes" onchange="'.$autoSubmit.'" style="width:80px">';
        $return .= $this->sOptions($zoom['config']['posRes'], $zoom['config']['picDim'], $opr = false, $add = 'px');
        $return .= '</select> - Demo Resolutions</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<span class="zoomTextS">You can configure whatever resolution you want</span>';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">VERTICAL GALLERY</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoGal" value="yes" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoVertGal\').css(\'display\',\'block\');"';
        if ($zoom['config']['useGallery']) {
            $return .= ' checked';
        }
        $return .= '> - Yes ';
        $return .= '<input type="radio" name="demoGal" value="no" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoVertGal\').css(\'display\',\'none\');"';
        if (!$zoom['config']['useGallery']) {
            $return .= ' checked';
        }
        $return .= '> - No veritval Gallery';
        $return .= '</div>';
        $return .= '<div id="zoomDemoVertGal" style="background-color: #3C3C3C; padding: 5px; display: '.($zoom['config']['useGallery'] ? 'block' : 'none').'">';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalCol" onchange="'.$autoSubmit.'" style="width:80px">';
        $return .= $this->sOptions($zoom['config']['posColumns'], $zoom['config']['galleryLines'], $opr = false, $add = false);
        $return .= '</select> - Vertical Gallery Columns</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalRes" onchange="'.$autoSubmit.'" style="width:80px">';
        $return .= $this->sOptions($zoom['config']['galRes'], $zoom['config']['galleryPicDim'], $opr = false, $add = 'px');
        $return .= '</select> - Vertical Gallery Resolution</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalPos" onchange="'.$autoSubmit.'" style="width:80px">';
        $return .= $this->sOptions(array('left', 'right'), $zoom['config']['galleryPos'], $opr='ucfirst', $add = false);
        $return .= '</select> - Vertical Gallery Position</div>';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">INLINE GALLERY</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoFullGal" value="yes" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoInlineGal\').css(\'display\',\'block\');"';
        if ($zoom['config']['useFullGallery']) {
            $return .= ' checked';
        }
        $return .= '> - Yes ';
        $return .= '<input type="radio" name="demoFullGal" value="no" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoInlineGal\').css(\'display\',\'block\');"';
        if (!$zoom['config']['useFullGallery']) {
            $return .= ' checked';
        }
        $return .= '> - No Inline Gallery';
        $return .= '</div>';
        $return .= '<div id="zoomDemoInlineGal" style="background-color: #3C3C3C; padding: 5px; display: '.($zoom['config']['useFullGallery'] ? 'block' : 'none').'">';
        $return .= '<div class="axZm_zoomText"><select name="demoFullGalRes" onchange="'.$autoSubmit.'" style="width:80px">';
        $return .= $this->sOptions($zoom['config']['galRes'], $zoom['config']['galleryFullPicDim'], $opr = false, $add = 'px');
        $return .= '</select> - Inline Gallery Resolution</div>';
        $return .= '<div class="axZm_zoomText" style="margin-top: 3px;">';
        $return .= '<input type="radio" name="demoFullGalAuto" value="yes" onclick="'.$autoSubmit.'"';
        if ($zoom['config']['galFullAutoStart']) {
            $return .= ' checked';
        }
        $return .= '> - Yes ';
        $return .= '<input type="radio" name="demoFullGalAuto" value="no" onclick="'.$autoSubmit.'"';
        if (!$zoom['config']['galFullAutoStart']) {
            $return .= ' checked';
        }
        $return .= '> - No Inline Gallery Autostart';
        $return .= '</div>';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">HORIZONTAL GALLERY</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoHorGal" value="yes" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoHorGal\').css(\'display\',\'block\');"';
        if ($zoom['config']['useHorGallery']) {
            $return .= ' checked';
        }
        $return .= '> - Yes ';
        $return .= '<input type="radio" name="demoHorGal" value="no" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoHorGal\').css(\'display\',\'block\');"';
        if (!$zoom['config']['useHorGallery']) {
            $return .= ' checked';
        }
        $return .= '> - No Horizontal Gallery';
        $return .= '</div>';
        $return .= '<div id="zoomDemoHorGal" style="background-color: #3C3C3C; padding: 5px; display: '.($zoom['config']['useHorGallery'] ? 'block' : 'none').'">';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalHorPos" onchange="'.$autoSubmit.'" style="width:80px">';
        $return .= $this->sOptions(array('top1'=>'Top 1', 'top2'=>'Top 2', 'bottom1'=>'Bottom 1', 'bottom2'=>'Bottom 2'), $zoom['config']['galHorPosition'], $opr = false, $add = false);
        $return .= '</select> - Horizontal Gallery Position</div>';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">GALLERY NAVI</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoGalNavi" value="yes" onclick="'.$autoSubmit.'"';
        if ($zoom['config']['galleryNavi']) {
            $return .= ' checked';
        }
        $return .= '> - Yes ';
        $return .= '<input type="radio" name="demoGalNavi" value="no" onclick="'.$autoSubmit.'"';
        if (!$zoom['config']['galleryNavi']) {
            $return .= ' checked';
        }
        $return .= '> - No Prev / Next buttons';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">ZOOM MAP</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoMap" value="no" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoMapProp\').css(\'display\',\'block\');"';
        if (!$zoom['config']['useMap']) {
            $return .= ' checked';
        }
        $return .= '> - Hide ';
        $return .= '<input type="radio" name="demoMap" value="yes" onclick="'.$autoSubmit.' jQuery(\'#zoomDemoMapProp\').css(\'display\',\'block\');"';
        if ($zoom['config']['useMap']) {
            $return .= ' checked';
        }
        $return .= '> - Show map';
        $return .= '</div>';
        $return .= '<div id="zoomDemoMapProp" style="background-color: #3C3C3C; padding: 5px; display: '.($zoom['config']['useMap'] ? 'block' : 'none').'">';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoMapDrag" value="no" onclick="'.$autoSubmit.'"';
        if (!$zoom['config']['dragMap']) {
            $return .= ' checked';
        }
        $return .= '> - No ';
        $return .= '<input type="radio" name="demoMapDrag" value="yes" onclick="'.$autoSubmit.'"';
        if ($zoom['config']['dragMap']) {
            $return .= ' checked';
        }
        $return .= '> - Map draggable';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoMapVis" value="no" onclick="'.$autoSubmit.'"';
        if (!$zoom['config']['zoomMapVis']) {
            $return .= ' checked';
        }
        $return .= '> - No ';
        $return .= '<input type="radio" name="demoMapVis" value="yes" onclick="'.$autoSubmit.'"';
        if ($zoom['config']['zoomMapVis']) {
            $return .= ' checked';
        }
        $return .= '> - Map visible on start';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="radio" name="demoMapAnim" value="no" onclick="'.$autoSubmit.'"';
        if (!$zoom['config']['zoomMapAnimate']) {
            $return .= ' checked';
        }
        $return .= '> - No ';
        $return .= '<input type="radio" name="demoMapAnim" value="yes" onclick="'.$autoSubmit.'"';
        if ($zoom['config']['zoomMapAnimate']) {
            $return .= ' checked';
        }
        $return .= '> - Animate Map';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoMapSize" onchange="'.$autoSubmit.'" style="width:80px">';
        foreach ($arrayMapFract as $k) {
            $return .= '<option value="'.$k.'"';
            if ($k/100 == $zoom['config']['mapFract']) {
                $return .= ' selected';
            }
            $return .= '>'.($k).' %</option>';
        }
        $return .= '</select> - Map size</div>';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoNavPos" onchange="'.$autoSubmit.'" style="width:80px">';
        $return .= $this->sOptions(array('top', 'bottom'), $zoom['config']['naviPos'], $opr = 'ucfirst', $add = false);
        $return .= '</select> - Navigation Position</div>';
        if (!$autoSubmit) {
            $return .= '<div class="axZm_zoomText" style="margin-bottom:3px; text-align: right;">';
            $return .= '<input type="button" onclick="this.form.submit()" value="Submit">';
            $return .= '</div>';
        }
        $return .= '</form>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">OTHER</div>';
        $return .= '<form id="demoOther" action="" onsubmit="return false;">';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="checkbox" name="msInterp" value="1" onclick="demoIeInterp(this.checked); this.blur();" '.($zoom['config']['msInterp'] ? ' checked' : '').'> - Bicubic interpolation (IE < 8)';
        $return .= '</div>';
        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
        $return .= '<input type="checkbox" name="demoPhysics" value="1" onclick="demoPhys(this.checked); this.blur();" '.($zoom['config']['zoomDragPhysics'] ? ' checked' : '').'> - Smooth dragging';
        $return .= '</div>';
        $return .= '</form>';
        $return .= '<form id="demoDoctype" action="">';
        $serverPar = $this->zoomServerPar('arr', 'demoDoctype', false, $_SERVER['QUERY_STRING']);
        if (is_array($serverPar)) {
            foreach ($serverPar as $k => $v) {
                $return .= '<div><input type="hidden" name="'.$k.'" value="'.$v.'"></div>';
            }
        }
        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoDoctype" onchange="this.form.submit()" style="width:160px">';
        foreach ($this->doctype as $k => $v) {
            $doc = array_keys($v);
            $return .= '<option value="'.$k.'"';
            if ($k == $zoom['config']['doctype']) {
                $return .= ' selected';
            }
            $return .= '>'.$doc[0].'</option>';
        }
        $return .= '</select> - Doctype</div>';
        $return .= '</form>';
        $return .= '</td></tr></tbody></table>';
        $return .= '</div>';
        $return .= '<div style="clear: both; float: left; height:10px; line-height:1px;"> </div>';
        $zoomTmp['folderSelect'] = '<form style="margin:0px; padding:0px" method="GET" action="'.$this->sanitizeUrl($_SERVER['PHP_SELF']).'">';
        $zoomTmp['zoomServerPar'] = $this->zoomServerPar('arr', array('zoomID', 'zoomDir'), false, $_SERVER['QUERY_STRING']);
        if (!empty($zoomTmp['zoomServerPar'])) {
            foreach ($zoomTmp['zoomServerPar'] as $k => $v) {
                $zoomTmp['folderSelect'] .= '<div style="display: none"><input type="hidden" name="'.$k.'" value="'.$v.'"></div>';
            }
        }
        $zoomTmp['folderSelect'] .= '<div><select name="zoomDir" onchange="this.form.submit()" style="">';
        foreach ($zoomTmp['folderArray'] as $k => $v) {
            $zoomTmp['folderSelect'] .= '<option value="'.$v.'"';
            if ($k == $_GET['zoomDir'] || $v == $_GET['zoomDir']) {
                $zoomTmp['folderSelect'] .= ' selected';
            }
            $zoomTmp['folderSelect'] .= '>'.$k.'. '.ucfirst($v).'</option>';
        }
        $zoomTmp['folderSelect'] .= '</select></div>';
        $zoomTmp['folderSelect'] .= '</form>';
        $zoomTmp['dropSelect'] = '<form style="margin:0px; padding:0px" method="GET" action="'.$this->sanitizeUrl($_SERVER['PHP_SELF']).'">';
        $zoomTmp['zoomServerPar'] = $this->zoomServerPar('arr', array('zoomID'), false, $_SERVER['QUERY_STRING']);
        if (!empty($zoomTmp['zoomServerPar'])) {
            foreach ($zoomTmp['zoomServerPar'] as $k => $v) {
                $zoomTmp['dropSelect'] .= '<div style="display: none"><input type="hidden" name="'.$k.'" value="'.$v.'"></div>';
            }
        }
        $zoomTmp['dropSelect'] .= '<div><select name="zoomID" onchange="this.form.submit()" style="" id="axZmComboExample">';
        if (isset($zoom['config']['pic_list_array']) && is_array($zoom['config']['pic_list_array'])) {
            foreach ($zoom['config']['pic_list_array'] as $k => $v) {
                $zoomTmp['dropSelect'] .= '<option value="'.$k.'"';
                if ($k == $_GET['zoomID']) {
                    $zoomTmp['dropSelect'] .= ' selected';
                }
                $v = $k.'. '.str_replace('_', ' ', ucfirst($this->getf('.',$v))).' → ';
                $v .= $zoom['config']['pic_list_data'][$k]['imgSize'][0].'x'.$zoom['config']['pic_list_data'][$k]['imgSize'][1].' PX → ';
                $v .= round((($zoom['config']['pic_list_data'][$k]['imgSize'][0]*$zoom['config']['pic_list_data'][$k]['imgSize'][1])/1000000), 1).' MP';
                if ($zoom['config']['pic_list_data'][$k]['fileSize']) {
                    $v .= ' → '.$this->zoomFileSmartSize($zoom['config']['pic_list_data'][$k]['fileSize'], 1);
                }
                $zoomTmp['dropSelect'] .= '>'.$v.'</option>';
            }
        }
        $zoomTmp['dropSelect'] .= '</select></div>';
        $zoomTmp['dropSelect'] .= '</form>';
        $return.= '<div id="zoomPicSelect" class="zoomAjaxDemoButton" style="width:'.($zoomW + $extPixGal).'px;">';
        $return.= '<div style="clear: both; margin: 10px 5px; text-align: right;">';
        $return.= isset($zoomTmp['dropSelect']) ? '<div style="float: right">'.$zoomTmp['dropSelect'].'</div>' : '';
        $return.= isset($zoomTmp['folderSelect']) ? '<div style="float: left">'.$zoomTmp['folderSelect'].'</div>' : '';
        $return.= '</div>';
        $return.= '</div>';
        $return .= '</div>';
        return $return;
    }
}
