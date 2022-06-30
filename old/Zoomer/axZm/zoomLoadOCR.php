<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomLoadOCR.php
* Copyright: Copyright (c) 2010-2018 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 5.1.2
* Date: 2018-04-16
* Review: 2018-04-16
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
* Example: http://www.ajax-zoom.com/examples/example34.php
*/

header("X-Robots-Tag: noindex, nofollow", true);
error_reporting('E_ERROR');
@mb_internal_encoding("UTF-8");

// Return different type of message in case something wents wrong in the following code
$debugOCR = false;

// Filter signs
$filter = array('.', ',', '!', '?', ':', ';', '_', '%', '*', '(', ')', '{', '}', '[', ']', '"', '|', '«', '»', '•', '^', '~', '■');

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

// Sorting function
function knatsort(&$array)
{
    $array_keys = array_keys($array);
    natsort($array_keys);
    $new_natsorted_array = array();

    foreach ($array_keys as $array_keys_2) {
        $new_natsorted_array[$array_keys_2] = $array[$array_keys_2];
    }
    $array = $new_natsorted_array;
    return true;
}

// Debuging
function azError($errorArray)
{
    global $debugOCR;
    if ($debugOCR) {
        $return = array('azErr' => $errorArray);
    } else {
        $return = array('azErr' => array('Some errors occured. Please change $debugOCR value in /axZm/'.basename(__FILE__).' in order to see them'));
    }
    echo json_encode($return);
    exit;
}

// DOCUMENT_ROOT, the value of
$fpPP = checkSlash(realpath($_SERVER['DOCUMENT_ROOT']), 'remove');

// Empty array wich will be filled with word -> position representations
$arrayWords = array();

// Errors for debugging
$errorArray = array();

$fromPath = '';
$ocrFilesPath = $_POST['ocrFilesPath'];
$ocrSchema = $_POST['ocrSchema'];

// $pageNumber is not used in the default example
$pageNumber = isset($_POST['pageNumber']) ? $_POST['pageNumber'] : false;

// ALTO schema - http://schema.ccs-gmbh.com/ALTO, http://www.loc.gov/ndnp/alto_1-1-041.xsd
// hOCR schema - https://docs.google.com/document/d/1QQnIQtvdAC_8n92-LhwPcjtAUFwBlzE8EWnKAxlgVf0/preview?pli=1
// hOCR software (free) - e.g. https://code.google.com/p/tesseract-ocr/wiki/ReadMe
// Can be easily extended...
$ocrTypes = array('ALTO', 'hOCR');

// Check if OCR format passed is supported in this version
if (!in_array($ocrSchema, $ocrTypes)) {
    if ($ocrFormat) {
        array_push($errorArray, $ocrSchema.' specs are not supported by this file. You can extend loadXML.php on your own or turn to AJAX-ZOOM support for this task.');
    } else {
        array_push($errorArray, 'POST ocrSchema has not been defined. Please choose between '.implode(', ', $ocrTypes).' and update your frontend. You can extend loadXML.php to support any OCR schema on your own or turn to AJAX-ZOOM support for this task.');
    }
    azError($errorArray);
    exit;
}

// Some code for paths...
if (substr($ocrFilesPath, 0, 2) == './' || substr(strtolower($ocrFilesPath), 0, 2) == 'c:') {
    $ocrFilesPath = substr($ocrFilesPath, 2);
}

$ocrFilesPath = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', $ocrFilesPath);

if (substr($ocrFilesPath, 0, 1) != '/') {

    // Try to correct relative paths
    $fromPath = str_replace(array('http://', 'https://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift(explode('?', $_SERVER['HTTP_REFERER'])));

    if (substr($fromPath, -1) == '/' || substr($fromPath, -1) == '\\') {
        $fromPath .= 'index.html';
    }

    // Relative paths correction
    if ($fromPath && substr($ocrFilesPath, 0, 3) == '../') {
        $zoomDirInfo = pathinfo(checkSlash(dirname(dirname($fromPath)).substr($ocrFilesPath, 2), 'add'));
        if (!is_dir(checkSlash($fpPP.checkSlash(dirname(dirname($fromPath)).substr($ocrFilesPath, 2), 'add'), 'add'))) {
            unset($zoomDirInfo);
        }
    }

    // Not absolute path
    elseif ($fromPath && substr($ocrFilesPath, 0, 1) != '/') {
        $zoomDirInfo = pathinfo(checkSlash(dirname(dirname($fromPath)).'/'.$ocrFilesPath, 'add'));
        if (!is_dir(checkSlash($fpPP.checkSlash(dirname(dirname($fromPath)).'/'.$ocrFilesPath, 'add'), 'add'))) {
            unset($zoomDirInfo);
        }
    }

    if (is_array($zoomDirInfo)) {
        $ocrFilesPath =  checkSlash('/'.$zoomDirInfo['dirname'].'/'.$zoomDirInfo['basename'], 'add');
    }
}

$ocrFilesPath = checkSlash($ocrFilesPath, 'add');

if (is_dir($fpPP.$ocrFilesPath)) {
    $scandirResults = array_values(array_diff(scandir($fpPP.$ocrFilesPath), array('..', '.')));
} else {
    array_push($errorArray, $fpPP.$ocrFilesPath. ' is not a directory.');
    azError($errorArray);
    exit;
}

if ($pageNumber && $scandirResults[$pageNumber-1]) {
    $pageArray = $scandirResults[$pageNumber-1];
    $scandirResults = array();
    $scandirResults[$pageNumber-1] = $pageArray;
}

if (count($scandirResults) == 0) {
    array_push($errorArray, $fpPP.$ocrFilesPath. ' contains no files.');
    azError($errorArray);
    exit;
}

$nn = 0;

foreach ($scandirResults as $key => $file) {
    if ($ocrSchema == 'ALTO' && strtolower(end(explode('.', $file))) == 'xml') {
        // ALTO
        $reader = new XMLReader();

        $xml = $reader->open($fpPP.$ocrFilesPath.$file);
        if ($xml === true) {
            $nn++;
            while ($reader->read()) {
                if ($xml->nodeType == XMLReader::END_ELEMENT) {
                    break;
                }

                if ($reader->nodeType == XMLREADER::ELEMENT && $reader->name == 'String') {
                    $word = $reader->getAttribute('CONTENT');
                    $word = str_replace($filter, '', $word);
                    if (mb_strlen($word) > 4) {
                        $word = mb_strtolower($word); // do not differentiate upper / lower case
                        if (!is_array($arrayWords[$word])) {
                            $arrayWords[$word] = array();
                        }

                        $pos = array();
                        $pos['P'] = $nn; // page
                        $pos['x'] = intval($reader->getAttribute('HPOS')); // x1 coordinates
                        $pos['y'] = intval($reader->getAttribute('VPOS')); // y1 coordinates
                        $pos['W'] = intval($reader->getAttribute('WIDTH')); // width
                        $pos['H'] = intval($reader->getAttribute('HEIGHT')); // height
                        array_push($arrayWords[$word], $pos);
                    }
                }
            }
            $reader->close();
        } else {
            array_push($errorArray, 'Was not able to open '.$fpPP.$ocrFilesPath.$file);
        }
    } elseif ($ocrSchema == 'hOCR' && strtolower(end(explode('.', $file))) == 'html') {
        // hOCR
        $classname = 'ocrx_word';

        // Phalanger 3 (asp.net) implementation of DOMDocument is incomplete, simply use preg_match
        if (defined('PHALANGER')) {
            $page = file_get_contents($fpPP.$ocrFilesPath.$file);
            $elements = array();
            preg_match_all('/<span class=\'ocrx_word\' (.*?)>(.*?)<\/span>/s', $page, $vv);

            foreach ($vv[0] as $k=>$v) {
                preg_match('/title=\"(.*?)\"/s', $vv[1][$k], $matches);
                $elements[$k]['word'] = strip_tags($v);
                $elements[$k]['title'] = str_replace('bbox ', '', $matches[1]);
            }

            $nn++;

            foreach ($elements as $node) {
                $word = $node['word'];
                $word = str_replace($filter, '', $word);

                if (mb_strlen($word) > 4) {
                    $word = mb_strtolower($word);
                    $title =  $node['title'];
                    $coord = explode(' ', $title);

                    if (!is_array($arrayWords[$word])) {
                        $arrayWords[$word] = array();
                    }
                    $pos = array();
                    $pos['P'] = $nn; // page
                    $pos['x'] = intval($coord[0]); // x1 coordinates
                    $pos['y'] = intval($coord[1]); // y1 coordinates
                    $pos['W'] = intval($coord[2] - $coord[0]); // width
                    $pos['H'] = intval($coord[3] - $coord[1]); // height
                    array_push($arrayWords[$word], $pos);
                }
            }
        } else {
            $stream = file_get_contents($fpPP.$ocrFilesPath.$file);
            $doc = DOMDocument::loadHTML($stream);
            $xpath = new DOMXpath($doc);
            $elements = $xpath->query("//*[contains(@class, '$classname')]");

            if ($elements !== false) {
                $nn++;
                foreach ($elements as $node) {
                    $word = $node->nodeValue;
                    $word = str_replace($filter, '', $word);

                    if (mb_strlen($word) > 4) {
                        $word = mb_strtolower($word); // do not differentiate upper / lower case
                        $title = $node->getAttribute('title');
                        // Coordinates are written in the title tag of the span, e.g. "bbox 68 256 188 281"
                        $coord = explode(' ', str_replace('bbox ', '', $title));

                        if (!is_array($arrayWords[$word])) {
                            $arrayWords[$word] = array();
                        }
                        $pos = array();
                        $pos['P'] = $nn; // page
                        $pos['x'] = intval($coord[0]); // x1 coordinates
                        $pos['y'] = intval($coord[1]); // y1 coordinates
                        $pos['W'] = intval($coord[2] - $coord[0]); // width
                        $pos['H'] = intval($coord[3] - $coord[1]); // height
                        array_push($arrayWords[$word], $pos);
                    }
                }
            } else {
                array_push($errorArray, 'Was not able to open '.$fpPP.$ocrFilesPath.$file);
            }
        }
    }
}

if (!empty($errorArray)) {
    azError($errorArray);
    exit;
}

// Sort words
knatsort($arrayWords);

// Return json for autosuggest
echo json_encode($arrayWords);
