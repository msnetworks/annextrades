<?php
/*!
* Plugin: jQuery AJAX-ZOOM, axZmF.class.php
* Copyright: Copyright (c) 2010-2019 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.5
* Extension Date: 2019-06-01
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

if (!class_exists('axZmF', false)) {
    class axZmF
    {
        public static $axZm;
        public static $axZmH;
        public static $cnf;

        public static function classVer()
        {
            return array(
                'ver' => '2.5',
                'date' => '2019-06-01'
            );
        }

        public static function getIpAddress()
        {
            $ip_keys = array(
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_X_CLUSTER_CLIENT_IP',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'REMOTE_ADDR'
            );

            foreach ($ip_keys as $key) {
                if (array_key_exists($key, $_SERVER) === true) {
                    foreach (explode(',', $_SERVER[$key]) as $ip) {
                        $ip = trim($ip);
                        if (self::validateIp($ip)) {
                            return $ip;
                        }
                    }
                }
            }

            return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
        }

        public static function validateIp($ip)
        {
            if (filter_var($ip,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            ) === false) {
                return false;
            }

            return true;
        }

        public static function normBackSlashJs($a)
        {
            if (is_array($a) && !empty($a)) {
                foreach ($a as $k => $v) {
                    $a[$k] = self::normBackSlashJs($v);
                }
            } elseif (gettype($a) == 'string') {
                $a = str_replace('\\', '\\\\', $a);
            }

            return $a;
        }

        public static function sendHttpResponse($a, $b)
        {
            http_response_code($a);
            die($b);
        }

        public static function removeBatchSessions()
        {
            if (isset($_SESSION['axZmProtectBatch'])) {
                unset($_SESSION['axZmProtectBatch']);
            }

            if (isset($_SESSION['axZmBtch'])) {
                unset($_SESSION['axZmBtch']);
            }
        }

        public static function checkIpAddress($c)
        {
            if (isset($c['ipAccess'])
                && !empty($c['ipAccess'])
                && !in_array(self::getIpAddress(), $c['ipAccess'])
            ) {
                self::removeBatchSessions();
                self::sendHttpResponse(403, 'You do not have permission to access this document');
            }
        }

        public static function confPar($par, $sessName = '')
        {
            $val = '';
            if ($sessName) {
                if (isset($_SESSION[$sessName]['conf']['AJAXZOOM_' . strtoupper($par)])) {
                    $val = $_SESSION[$sessName]['conf']['AJAXZOOM_' . strtoupper($par)];
                } elseif (isset($_SESSION[$sessName]['conf']['AZ_' . strtoupper($par)])) {
                    $val = $_SESSION[$sessName]['conf']['AZ_' . strtoupper($par)];
                } elseif (isset($_SESSION[$sessName]['conf']['_' . strtoupper($par)])) {
                    $val = $_SESSION[$sessName]['conf']['_' . strtoupper($par)];
                } elseif (isset($_SESSION[$sessName]['conf'][strtoupper($par)])) {
                    $val = $_SESSION[$sessName]['conf'][strtoupper($par)];
                } elseif (isset($_SESSION[$sessName]['conf'][$par])) {
                    $val = $_SESSION[$sessName]['conf'][$par];
                } else {
                    $val = '';
                }
            } else {
                $val = isset(self::$cnf[$par]['default']) ? self::$cnf[$par]['default'] : '';
            }

            if ($val === 'false') {
                $val = false;
            } elseif ($val === 'null') {
                $val = null;
            } elseif ($val === '0') {
                $val = 0;
            }

            return $val;
        }

        public static function getMouseOverDefault($sessName = '')
        {
            if (!$sessName) {
                $c = new AzMouseoverSettings();
                self::$cnf = $c->config;
            }

            $r = array();

            $arr1 = array(
                'width' => self::confPar('thumbW', $sessName) * (self::confPar('thumbRetina', $sessName) ? 2 : 1),
                'height' => self::confPar('thumbH', $sessName) * (self::confPar('thumbRetina', $sessName) ? 2 : 1),
                'qual' => self::confPar('qualityThumb', $sessName),
                'thumbMode' => self::confPar('thumbMode', $sessName)
            );
            array_push($r, $arr1);

            $arr2 = array(
                'width' => self::confPar('thumbWfs', $sessName) * (self::confPar('thumbRetinaFs', $sessName) ? 2 : 1),
                'height' => self::confPar('thumbHfs', $sessName) * (self::confPar('thumbRetinaFs', $sessName) ? 2 : 1),
                'qual' => self::confPar('qualityThumbFs', $sessName),
                'thumbMode' => self::confPar('thumbModeFs', $sessName)
            );
            array_push($r, $arr2);

            $arr3 = array(
                'width' => self::confPar('mouseOverZoomWidth', $sessName),
                'height' => self::confPar('mouseOverZoomHeight', $sessName),
                'qual' => self::confPar('qualityZoom', $sessName),
                'thumbMode' => self::confPar('mouseOverContain', $sessName) ? 'contain' : false
            );
            array_push($r, $arr3);

            if (!self::confPar('oneSrcImg', $sessName)) {
                if (self::confPar('width', $sessName) == 'auto' || self::confPar('height', $sessName) == 'auto') {
                    $arr4 = array(
                        'width' => self::confPar('mouseOverZoomWidth', $sessName) / 2,
                        'height' => self::confPar('mouseOverZoomHeight', $sessName) / 2,
                        'qual' => self::confPar('qualityZoom', $sessName),
                        'thumbMode' => self::confPar('mouseOverContain', $sessName) ? 'contain' : false
                    );
                } else {
                    $arr4 = array(
                        'width' => self::confPar('mouseOverZoomWidth', $sessName),
                        'height' => self::confPar('mouseOverZoomHeight', $sessName),
                        'qual' => self::confPar('qualityZoom', $sessName),
                        'thumbMode' => self::confPar('mouseOverContain', $sessName) ? 'contain' : false
                    );
                }

                array_push($r, $arr4);
            }

            $r = array_map("unserialize", array_unique(array_map("serialize", $r)));
            return $r;
        }

        public static function batchLoginField($c)
        {
            if ($c['byPassBatchPass'] !== true) {
                if (!isset($_SESSION['axZmProtectBatch'])
                    || !$c['yourSecretPassWord']
                    || !isset($_SESSION['axZmProtectBatch'])
                    || md5($c['yourSecretPassWord']) != $_SESSION['axZmProtectBatch']
                ) {
                    if (!(empty($_GET) && empty($_POST))) {
                        $ret = '<!DOCTYPE html><html><head><title>Redirect</title>';
                        $ret .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
                        $ret .= '<script>self.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
                        $ret .= '</head><body></body></html>';
                        die($ret);
                    }

                    $ret = '<!DOCTYPE html><html><head><title>Login</title>';
                    $ret .= $c['headerFiles'];
                    $ret .= '</head>';
                    $ret .= '<body>';
                        $ret .= '<div class="container" style="min-height: 100%; min-height: 100vh; display: flex; align-items: center;">';
                            $ret .= '<div class="panel panel-default" style="margin: 0 auto; width: 380px;">
                                         <div class="panel-heading">
                                            <h3 class="panel-title" style="position: relative; text-align: left;">
                                                <i class="fa fa-key" aria-hidden="true" style="position: absolute; right: 0px; top: 0px;"></i>
                                                <span style="margin-right: 20px">AJAX-ZOOM batch tool</span>
                                            </h3>
                                         </div>
                                          <div class="panel-body">
                                            '.($c['yourSecretPassWord'] ? '<form accept-charset="UTF-8" role="form" method="post">' : '').'
                                                <fieldset>
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="key" name="axZmBatchLoginPass" type="password" value="">
                                                    </div>
                                                    <div class="form-group small">
                                                        There is no default password.
                                                        In order to access and use this great tool,
                                                        you will need to set a password inside this file.
                                                    </div>
                                                    <input class="btn btn-success btn-block" type="submit" value="Login">
                                                </fieldset>
                                            '.($c['yourSecretPassWord'] ? '</form>' : '').'
                                        </div>
                                    </div>';
                        $ret .= '</div>';
                    $ret .= '</body></html>';
                    die($ret);
                }
            }
        }

        public static function checkBatchPassword($c)
        {
            // Check password
            if ($c['byPassBatchPass'] !== true && $c['yourSecretPassWord']) {

                if (isset($_POST['axZmBatchLoginPass'])
                    && $_POST['axZmBatchLoginPass'] == $c['yourSecretPassWord']
                ) {
                    $_SESSION['axZmProtectBatchTry'] = 0;
                    $_SESSION['axZmProtectBatch'] = md5($_POST['axZmBatchLoginPass']);
                    if (isset($_SESSION['axZmBtch'])) {
                        unset($_SESSION['axZmBtch']);
                    }

                    header('Location: '.$_SERVER['PHP_SELF']);
                    die();

                } elseif (isset($_POST['axZmBatchLoginPass']) && $_POST['axZmBatchLoginPass']) {
                    if (!isset($_SESSION['axZmProtectBatchTry']) || !$_SESSION['axZmProtectBatchTry']) {
                        $_SESSION['axZmProtectBatchTry'] = 0;
                    }

                    $_SESSION['axZmProtectBatchTry'] += 1;
                    if ($_SESSION['axZmProtectBatchTry'] > 9) {
                        $ret = '<!DOCTYPE html><html><title>Login</title>';
                        $ret .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>';
                        $ret .= '<body style="font-family: verdana; color: red;">Failed to login</body></html>';
                        die($ret);
                    }
                }
            }
        }

        public static function batchCleanBaseDir($a)
        {
            $a = strip_tags($a);
            $a = str_replace('\\', '/', $a);
            $a = str_replace('\'', '', $a);
            $a = str_replace('"', '', $a);
            $a = preg_replace('/\s+/', '', $a);
            if (substr($a, 0, 1) != '/') {
                $a = '/'.$a;
            }

            return $a;
        }

        public static function batchLogout()
        {
            self::removeBatchSessions();
            header('Location: '.$_SERVER['PHP_SELF']);
            die();
        }

        public static function batchUnsetJobSessions()
        {
            if (isset($_SESSION['axZmBtch'])) {
                $arr = [
                    'batchJobCount',
                    'batchJob',
                    'batchJobN',
                    'batchJobNt',
                    'batchErrors',
                    'batchStartTime',
                    'batchStartTimeT',
                    'batchFolders',
                    'batchFoldersIndex',
                    'batchErrorFiles',
                    'batchErrorFilesWithPath',
                    'batchShowResults',
                    'batchStopped'
                ];

                foreach ($arr as $k) {
                    if (isset($_SESSION['axZmBtch'][$k])) {
                        unset($_SESSION['axZmBtch'][$k]);
                    }
                }
            }
        }

        public static function batchStop()
        {
            $_SESSION['axZmBtch']['batchStopped'] = true;
            die;
        }

        public static function batchAjaxSaveSettingsToFile($zoom)
        {
            $json = array();
            $arr = array(
                'startPic',
                'dynImageSizes',
                'exampleValue',
                'foldersFilter',
                'filesFilter',
                'resolutionFilter',
                'pause',
                'confirmDelete',
                'stopOnError',
                'enableBatchThumbs',
                'batchThumbsDynString'
            );

            foreach ($arr as $v) {
                if (isset($_SESSION['axZmBtch'][$v])) {
                    $json[$v] = $_SESSION['axZmBtch'][$v];
                }
            }

            header('Content-Type: text/html');
            header('Pragma: public');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . strlen($json));
            header('Content-Disposition: attachment; filename="ajax-zoom-batch-settings_'.date('Y-m-d_h-s').'.json"');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            die(json_encode($json, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT));
        }

        public static function batchAjaxLoadSettingsFromFile($zoom, $axZmBatchConfig)
        {
            if (isset($_POST['loadBtchSettings'])) {
                foreach ($_POST['loadBtchSettings'] as $k => $v) {
                    if (isset($zoom['batch'][$k]) || isset($axZmBatchConfig[$k])) {
                        $_SESSION['axZmBtch'][$k] = $v;
                    }
                }
            }

            die($_POST);
        }

        public static function setDynImageSizes()
        {
            if (isset($_POST['dynImageSizes'])) {
                $_SESSION['axZmBtch']['dynImageSizes'] = $_POST['dynImageSizes'];
            } else {
                $_SESSION['axZmBtch']['dynImageSizes'] = array();
            }

            die(json_encode($_SESSION['axZmBtch']['dynImageSizes']));
        }

        public static function setFilters()
        {
            if (isset($_POST['filterFiles']) && !empty($_POST['filterFiles'])) {
                $_SESSION['axZmBtch']['filesFilter'] = $_POST['filterFiles'];
            } else {
                $_SESSION['axZmBtch']['filesFilter'] = array();
            }

            if (isset($_POST['filterFolders']) && !empty($_POST['filterFolders'])) {
                $_SESSION['axZmBtch']['foldersFilter'] = $_POST['filterFolders'];
            } else {
                $_SESSION['axZmBtch']['foldersFilter'] = array();
            }

            if (isset($_POST['filterResolution'])) {
                $_SESSION['axZmBtch']['resolutionFilter'] = $_POST['filterResolution'];
            }

            die(json_encode(
                array(
                    'filesFilter' => $_SESSION['axZmBtch']['foldersFilter'],
                    'foldersFilter' => $_SESSION['axZmBtch']['foldersFilter']
                )
            ));
        }

        public static function batchUnsetSessions()
        {
            if ((empty($_GET) && empty($_POST)) || isset($_GET['unsetBatch'])) {
                if (isset($_SESSION['axZmBtch'])) {
                    unset($_SESSION['axZmBtch']);
                }
            }
        }

        public static function batchFilesTableHeader($zoom)
        {
            $return = '';
            $return .= '<table id="processTable" class="batchProcessTable table table-striped" style="display: none">';
                $return .= '<thead><tr>';
                    if ($zoom['batch']['enableBatchThumbs']) {
                        $return .= '<th class="batchListThumbTh">&nbsp;</th>';
                    }

                    $return .= '<th>Filename</th>';
                    $return .= '<th class="iconWidth">In</th>';
                    $return .= '<th class="iconWidth">Th</th>';
                    $return .= '<th class="iconWidth">tC</th>';
                    //$return .= '<th class="iconWidth">gP</th>';
                    $return .= '<th class="iconWidth">Ti</th>';
                    $return .= '<th width="55px; text-align: center">Time</th>';

                $return .= '</tr></thead>';
                $return .= '<tbody></tbody>';
            $return .= "</table>";

            return $return;
        }

        public static function getBatchSettingsInfo($zoom)
        {
            $return = '<tbody>';
            $return .= '<tr><td>"licenceType"</td><td><strong>'.$zoom['config']['licenceType'].'</strong></td></tr>';
            $return .= '<tr><td>"licenceKey"</td><td>'.($zoom['config']['licenceKey'] && strtolower($zoom['config']['licenceKey']) != 'demo' ? 'is set and is not demo' : 'demo').'</td></tr>';
            $return .= '<tr><td>"simpleMode"</td><td>
                <strong>
                '.($zoom['config']['simpleMode'] == false ? 'false' : (is_int($zoom['config']['simpleMode']) ? $zoom['config']['simpleMode'] : 'true')).'
                </strong><br>
                If "simpleMode" option is enabled (set to true),
                image tiles in the files list are shown as being already created.
                Also, if the value of the "simpleMode" option is an integer,
                images, which width x height is lower, than this integer,
                will show as greyed out "ok" as well. The later value (integer)
                is only possible for license type "Unlimited".
            </td></tr>';

            $return .= '<tr><td>"memory_limit"</td><td>
                <strong>'.$zoom['config']['memory_limit'].'</strong><br>
                Memory limit applied, when image operations are done by the server.
                AJAX-ZOOM sets it over ini_set if and where needed.
                The name of this option is $zoom[\'config\'][\'memory_limit\']
            </td></tr>';

            $return .= '<tr><td>ImageMagick® enabled</td><td>'
            .(($zoom['config']['im'] && $zoom['config']['pyrProg'] == 'IM') ? 'yes' : 'no, will use GD').'
            <br>On default, AJAX-ZOOM uses the GD library, which is bundled with PHP, when resizing images or making image tiles.
                You can enable imageMagick by enabling the $zoom[\'config\'][\'iMagick\'] and defining the
                $zoom[\'config\'][\'imPath\'] (path to convert or convert.exe on windows) options.
                Right now, as of creating image tiles, our imageMagick code performs up to 70% faster, than GD.
            </td></tr>';

            $return .= '<tr><td>"fileTypeArray"</td><td><strong>'.implode(', ', $zoom['config']['fileTypeArray']).'</strong>
                <br>Image types, which are not supported by GD, can be only processed with ImageMagick.
            </td></tr>';

            $return .= '<tr><td>$_GET[\'example\']</td><td>
                <strong>'.(isset($_GET['example']) ? $_GET['example'] . '</strong>' : 'not defined ').'
                <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingExample\');">Change</button>
                <br>
                Configuration options set defind in various AJAX-ZOOM configuration files.
            </td></tr>';

            $return .= '<tr><td>"picDir"</td><td>
                <span style="word-wrap: break-word; word-break: break-all; font-weight: bold;">'.$zoom['config']['picDir'].' </span>
                <br>Current directory of the source images.
                The value changes, when you select a different subfolder automatically.
            </td></tr>';

            $return .= '<tr><td>"picBaseDir"</td><td>
                <span style="word-wrap: break-word; word-break: break-all; font-weight: bold;">'.$_SESSION['axZmBtch']['startPic'].' </span>
                <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingStartPic\');">Change</button>
                <br>
                Top / start directory of the source images within this batch tool.
                You can change the value under "Settings" -> "Change home directory".
            </td></tr>';

            $return .= '<tr><td><i class="fa fa-columns" aria-hidden="true"></i> "tileSize"</td>
                <td><strong>'.$zoom['config']['tileSize'].' </strong><br>
                <strong>(Ti)</strong> column. Width / height of the square image tiles for multi-resolution viewing.
                If the <strong>(Ti)</strong> column is enabled, the image tiles will be generated over this batch tool.
            </td></tr>';

            $return .= '<tr><td><i class="fa fa-columns" aria-hidden="true"></i> "stepPicDim"</td><td>';
                if ($zoom['config']['stepPicDim'] && is_array($zoom['config']['stepPicDim']) && !empty($zoom['config']['stepPicDim'])) {
                    $return .= '<strong>(In)</strong> column.
                        These are the size values for "initial images" - smaller representation of the large image.
                        They appear depending on resolution and zoom level as "background" in the player
                        before multi-resolution image tiles load and cover this initial image.
                        If "simpleMode" option is enabled or you are using the "Simple" license,
                        these "initial images" are also needed, but instead of image tiles,
                        the original image loads whenever needed.
                        If not present, the "initial images" are created on-the-fly triggered by the AJAX-ZOOM player.
                        Note, that the "stepPicDim" also includes "picDim" value automatically.
                        The minimal requirement is one initial image.
                    ';

                    $return .= '<table class="table">';
                    $return .= '<thead><tr><th>Width</th><th>Height</th><th>Quality</th></tr></thead>';
                    $return .= '<tbody>';
                    foreach ($zoom['config']['stepPicDim'] as $k => $v) {
                        $return .= '<tr><td>'.$v['w'].'</td><td>'.$v['h'].'</td><td>'.$v['q'].'</td></tr>';
                    }

                    $return .= '</tbody></table>';

                }else{
                    $return .= 'no';
                }
            $return .= '</td></tr>';

            $return .= '<tr><td>"mapOwnImage"</td><td>
                <strong>'.$zoom['config']['mapOwnImage'].'</strong>,
                enabled: '.($zoom['config']['useMap'] ? 'yes' : 'no').' ("useMap" option)
                <br> "Image map" is a small image in the corner of the player, where the user can pan on large, zoomed image.
                Image map can use its own smaller image or it can use one of the images from "stepPicDim".
                If $zoom[\'config\'][\'mapOwnImage\'] is defined and $zoom[\'config\'][\'useMap\'] option is enabled,
                this small thumbnail will be generated along with the "stepPicDim" images.
            </td></tr>';

            $return .= '<tr><td>"galleryNoThumbs"</td><td>
                <strong>'.($zoom['config']['galleryNoThumbs'] ? 'true' : 'false').'</strong>
                <br>If enabled, gallery images are generated in a different way.
            </td></tr>';

            $arrayGalThumbs = array();

            $arrayGalThumbs['useGallery'] = array();
            $arrayGalThumbs['useGallery']['apply'] = ($zoom['config']['useGallery'] || $zoom['config']['fullScreenVertGallery'])
                && !$zoom['config']['galleryNoThumbs'] ? true : false;

            $arrayGalThumbs['useHorGallery'] = array();
            $arrayGalThumbs['useHorGallery']['apply'] = ($zoom['config']['useHorGallery'] || $zoom['config']['fullScreenHorzGallery'])
                && !$zoom['config']['galleryNoThumbs'] ? true : false;

            $arrayGalThumbs['useFullGallery'] = array();
            $arrayGalThumbs['useFullGallery']['apply'] = $zoom['config']['useFullGallery']
                && !$zoom['config']['galleryNoThumbs'] ? true : false;

            $return .= '<tr><td><i class="fa fa-columns" aria-hidden="true"></i> galleries</td><td>
                <p><strong>(Th)</strong> column.
                    AJAX-ZOOM can show various galleries (horizontal, vertical or fullsize) for image sets.
                    If enabled, the image thumbnails will be generated for all images in the gallery on-the-fly before
                    the gallery actually appears. This is a little of legacy code but still used by many customers.
                    Anyway, if the gallery contains many, many images, this procedure can last long time.
                    It is a good idea to pre-generate these thumbnails with this batch tool.
                </p>
                <p>If you enable the $zoom[\'config\'][\'galleryNoThumbs\'] option, the thumbnails will be not
                    pre-generated before AJAX-ZOOM player loads, but generated with the built in
                    "imaging server" - the "src" attribute of the image file is a link to a PHP file,
                    which will cache and return the resized image.
                </p>
                <p>If galleries are not enabled or $zoom[\'config\'][\'galleryNoThumbs\'] is enabled,
                    thumbnails (Th) column for images will show "ok" greyed out.
                </p>
            ';

            $return .= '<table class="table">';
            $return .= '<thead><tr><th>  </th><th>Verical</th><th>Horizontal</th><th>Full</th></tr></thead>';
            $return .= '<tbody>';
                $return .= '<tr><th>Enabled</th>
                    <td>'.($arrayGalThumbs['useGallery']['apply'] ? 'yes' : 'no').'</td>
                    <td>'.($arrayGalThumbs['useHorGallery']['apply'] ? 'yes' : 'no').'</td>
                    <td>'.($arrayGalThumbs['useFullGallery']['apply'] ? 'yes' : 'no').'</td>
                </tr>';

                $return .= '<tr><th>Size</th>
                    <td>'.$zoom['config']['galleryPicDim'].'</td>
                    <td>'.$zoom['config']['galleryHorPicDim'].'</td>
                    <td>'.$zoom['config']['galleryFullPicDim'].'</td>
                </tr>';

                $return .= '<tr><th>Quality</th>
                    <td>'.$zoom['config']['galleryPicQual'].'</td>
                    <td>'.$zoom['config']['galleryPicQual'].'</td>
                    <td>'.$zoom['config']['galleryPicQual'].'</td>
                </tr>';

            $return .= '</tbody></table>';
            $return .= '</td></tr>';

            if (isset($zoom['batch']['dynImageSizes'])) {
                $return .= '<tr><td><i class="fa fa-columns" aria-hidden="true"></i> dynamic image sizes</td><td>';
                    $return .= '
                        <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingDynImages\');">Change</button>
                        <p><strong>(tC)</strong> column. For more information please see
                        under "Settings" -> Set "dynamic" image sizes.</p>';

                    $return .= '<table class="table">';
                    $return .= '<thead><tr><th>Width</th><th>Height</th><th>Quality</th><th>thumbMode</th></tr></thead>';
                    $return .= '<tbody>';
                    if (!empty($zoom['batch']['dynImageSizes'])) {

                        foreach ($zoom['batch']['dynImageSizes'] as $k => $v) {
                            $return .= '<tr>';
                            $return .= '<td>'.$v['width'].'</td>';
                            $return .= '<td>'.$v['height'].'</td>';
                            $return .= '<td>'.$v['qual'].'</td>';
                            $return .= '<td>'.(!$v['thumbMode'] ? 'false' : $v['thumbMode']).'</td>';
                            $return .= '</tr>';
                        }

                    } else {
                        $return .= '<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
                    }

                    $return .= '</tbody>';
                    $return .= '</table>';

                $return .= '</td></tr>';
            }

            $return .= '<tr><td>Filters</td><td>';
                $return .= '
                    <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingFilter\');">Change</button>
                    Filters for image names and folder names in this batch tool. You can exclude certain files and folders by using
                    a string containing in the file / folder names or you can use regular expressions for filtering.
                    Also, you can define the minimal resolution of the images to be displayed and processed in this batch tool.
                ';

                $return .= '<table class="table"><tbody style="word-wrap: break-word; word-break: break-all;">';
                $return .= '<tr><th style="width: 20%;">Files</th><td>'.(empty($zoom['batch']['filesFilter']) ? '-' : implode('<br>', $zoom['batch']['filesFilter'])).'</td></tr>';
                $return .= '<tr><th>Folders</th><td>'.(empty($zoom['batch']['foldersFilter']) ? '-' : implode('<br>', $zoom['batch']['foldersFilter'])).'</td></tr>';
                $return .= '<tr><th>Resolution</th><td>'.(empty($zoom['batch']['resolutionFilter']) ? '-' : $zoom['batch']['resolutionFilter']).'</td></tr>';
                $return .= '</tbody></table>';

            $return .= '</td></tr>';

            $return .= '<tr><td>"pause"</td><td>
                <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingOther\');">Change</button>
                <strong>'.$zoom['batch']['pause'].'</strong>
                <br> Pause while batch processing between each image (ms)
            </td></tr>';

            $return .= '<tr><td>"confirmDelete"</td><td>
                <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingOther\');">Change</button>
                <strong>'.($zoom['batch']['confirmDelete'] ? 'true' : 'false').'</strong>
                <br> Confirm, when deleting cache
            </td></tr>';

            $return .= '<tr><td>"stopOnError"</td><td>
                <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingOther\');">Change</button>
                <strong>'.($zoom['batch']['stopOnError'] ? 'true' : 'false').'</strong>
                <br> Stop batch processing if an error occurs
            </td></tr>';

            $return .= '<tr><td>"enableBatchThumbs"</td><td>
                <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingOther\');">Change</button>
                <strong>'.($zoom['batch']['enableBatchThumbs'] ? 'true' : 'false').'</strong>
                <br> Show thumbnails of the images for batch list
            </td></tr>';

            $return .= '<tr><td>"batchThumbsDynString"</td><td>
                <button class="btn btn-xs btn-info pull-right" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingOther\');">Change</button>
                <strong>'.$zoom['batch']['batchThumbsDynString'].'</strong>
                <br> Thumbnails Image size for the batch list if activated
            </td></tr>';

            // End table
            $return .= '</tbody>';

            return $return;
        }

        public static function setOtherSettings($zoom)
        {
            foreach ($_POST as $k => $v) {
                if (isset($zoom['batch'][$k])) {
                    if ($v == 'false') {
                        $v = false;
                    }

                    if ($v == 'true') {
                        $v = true;
                    }

                    $_SESSION['axZmBtch'][$k] = $v;
                }
            }

            die();
        }

        public static function getOtherSettings($zoom)
        {
            foreach ($_SESSION['axZmBtch'] as $k => $v) {
                if (isset($zoom['batch'][$k])) {
                    $zoom['batch'][$k] = $v;
                }
            }

            return $zoom;
        }

        public static function getBatchAbout($zoom)
        {
            $return = '<h3>About (please read)</h3>
                <p>This is the AJAX-ZOOM batch process programm.
                    With this, you can process a large amount of images from folders
                    and subfolders recursively and get visual
                    feedback on the state of the process.
                </p>
                <p>You do not necessarily have to go this step, because
                    if image tiles and other AJAX-ZOOM caches have not been generated yet,
                    AJAX-ZOOM will generate them on-the-fly,
                    either when they are loaded into the player at "preview"
                    in the backend of your AJAX-ZOOM plugin / module
                    or latest when they appear at the frontend.
                </p>
                <p>However, if you have thousands of images,
                    it is a good idea to batch process all existing images,
                    which you plan to show over AJAX-ZOOM,
                    before launching the new website or before enabling AJAX-ZOOM at frontend.
                    With this new batch file it is possible to cover up to 100%
                    of all caches, which AJAX-ZOOM will generate on-the-fly if not present.
                </p>';

            if (isset($zoom['batch']['vendorNote'])
                && isset($zoom['batch']['vendorNote']['text'])
                && !empty($zoom['batch']['vendorNote']['text'])
            ) {
                if (isset($zoom['batch']['vendorNote']['title'])) {
                    $return .= '<h3>'.$zoom['batch']['vendorNote']['title'].'</h3>';
                }

                if (is_array($zoom['batch']['vendorNote']['text'])) {
                    foreach ($zoom['batch']['vendorNote']['text'] as $k => $v) {
                        $return .= '<p>'.$v.'</p>';
                    }
                } else {
                    $return .= $zoom['batch']['vendorNote']['text'];
                }
            }

            $return .= '
                <h3>How-to</h3>
                <ul>
                    <li>You can choose the root directory of the images under
                        <button class="btn btn-xs" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingStartPic\');">
                            "Settings" -> Change "Home" directory
                        </button>
                    </li>
                    <li>Navigate through folders by either <b>double click</b>,
                        simple click on the folder icon left to the folder name
                        or select the folder in the select form field at the header of left panel.
                    </li>
                    <li>Select type of cache, you want to batch-process by checking / unchecking
                        the checkboxes at the bottom of the left panel.
                        In the "settings overview" navigation bar item,
                        you can read the explanations of what they mean.
                    </li>
                    <li>If not all images or folders need to be processed,
                        you can set filters under
                        <button class="btn btn-xs" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingFilter\');">
                            "Settings" -> "Filter images / folders"
                        </button>
                        More information about why you would want do that is in there.
                        You can save these and other settings under
                        <button class="btn btn-xs" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchSettingSave\');">
                            "Settings" -> "Save / load your settings"
                        </button>
                        and restore them in a different session.
                    </li>
                    <li>Now, select images and or folders out of the left panel.
                    </li>
                    <li>If you select a folder, which contains subfolders, all images in these subfolders
                        as well as images in folders of subfolders (level independent) will be processed recursively!
                        You can click on "Selection info" at the left navigation bar to get the amount of images in your selection
                        before processing them. Images, which do not need to be processed, because they are already processed,
                        will be skipped.

                    </li>
                    <li>You can use
                        <button class="btn btn-xs" onclick="jQuery.zoomBatch.toggleSettingTab(\'batchFilterNeedCache\');">
                            "Cache needed"
                        </button>
                        button on the menu above to load only folders containing images,
                        for which AJAX-ZOOM needs to generate any caches (current settings preserved).
                    </li>
                    <li>Please note, that for AJAX-ZOOM, all images <strong>must have</strong> unique filenames,
                        even if they are in different folders! Mostly, if you use an e-commerce solution,
                        this requirement is preserved. Also, AJAX-ZOOM modules / plugins take care about this,
                        when you upload or import 360 / 3D images over the backend.
                    </li>
                    <li>When you are ready, press the "Batch Process" button at the bottom of the left panel.
                    </li>
                    <li>After the batch process starts, please do not close this browser window!!!
                    </li>
                    <li>Depending on the number of images, it can last hours or even days!
                        Processing a single image with 7-15 megapixels should not last much more, than 10 seconds.
                        On fast servers the processing time is not that long.
                        Anyway, please try with couple of images at first to ensure everything is working.
                    </li>
                    <li>If you select a folder and press the "Delete cache" button at the bottom of the left panel,
                        all AJAX-ZOOM cache for images under
                        the selected folder and its subfolders will be recursively deleted.
                        If you want to delete a certain cache type only, then disable the cache type
                        (columns In, Th, tC, Ti), which you do not want to delete.
                        Of course, your source images will be not deleted.
                    </li>
                ';

                if ($zoom['config']['licenceKey'] == 'demo') {
                    $return .= '<li>Also please note that with the demo license images over 3.2 megapixel
                        (not to be confused with megabyte) will not proceed.
                    </li>';
                }

            $return .= '
            </ul>';

            return $return;
        }

        public static function markDirTreeRoot($dirTreeArray, $key, $prop, $val = 1)
        {
            if (isset($dirTreeArray[$key]) && $dirTreeArray[$key]['DIR_KEY'] != 'HOME') {
                $dirTreeArray[$key][$prop] = $val;
                if (isset($dirTreeArray[$key]['DIR_PARENT']) && $dirTreeArray[$key]['DIR_PARENT'] != 'HOME') {
                    $dirTreeArray = self::markDirTreeRoot($dirTreeArray, $dirTreeArray[$key]['DIR_PARENT'], $prop, $val);
                }
            }

            return $dirTreeArray;
        }

        public static function batchDirTreeDropdown($zoom, $reduce = false)
        {
            $startTime = microtime(true);

            $arr_reduce = array('folders', 'images');
            if ($reduce && !in_array($reduce, $arr_reduce)) {
                $reduce = 'images';
            }

            if (!$reduce && isset($zoom['batch']['filterNeedCache']) && $zoom['batch']['filterNeedCache']) {
                if (in_array($zoom['batch']['filterNeedCache'], $arr_reduce)) {
                    $reduce = $zoom['batch']['filterNeedCache'];
                }
            }

            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['pyrTilesPath'],'remove'));
            $exclude[] = 'zoomtiles';
            $exclude[] = 'zoomtiles_80';
            $exclude[] = 'cropJSON';
            $exclude[] = 'hotspotJS';
            $exclude[] = 'json';
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['gPyramidPath'],'remove'));
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['thumbs'],'remove'));
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['temp'],'remove'));
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['gallery'],'remove'));
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['icon'],'remove'));
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['js'],'remove'));
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['tempCache'],'remove'));
            $exclude[] = self::$axZmH->getl('/', self::$axZmH->checkSlash($zoom['config']['mapPath'],'remove'));

            if (!empty($zoom['batch']['foldersFilter']) && is_array($zoom['batch']['foldersFilter'])) {
                foreach ($zoom['batch']['foldersFilter'] as $v) {
                    if ($v) {
                        array_push($exclude, $v);
                    }
                }
            }

            $dirTreeArray = self::$axZm->getDirTree($_SESSION['axZmBtch']['startPic'], $zoom['config']['fpPP'], $exclude);

            // Remove "empty" folders or folders and images, which have not been processed
            if ($reduce) {
                $dirTreeArrayLast = array();
                $imgesArray = array();
                foreach($dirTreeArray as $k => $v) {
                    if ($v['DIR_LEVEL'] !== 0 && isset($v['DIR_SUB']) && $v['DIR_SUB'] === 0) {
                        $dirTreeArrayLast[$k] = $v;
                    }
                }

                if (!empty($dirTreeArrayLast)) {
                    foreach($dirTreeArrayLast as $k => $v) {
                        $zoom['config']['picDir'] = self::$axZmH->checkSlash($zoom['config']['fpPP'].'/'.$v['DIR_PATH'],'add');
                        $imges = self::getPicListArray($zoom, true, $reduce == 'folders' ? true : false);

                        if (!empty($imges['pic_list_array'])) {
                            if ($reduce == 'images' && method_exists(self::$axZmH, 'batchNeedIn')) {
                                $needCache = false;
                                foreach ($imges['pic_list_array'] as $img) {
                                    self::$axZmH->axZm->getJsonFileData($zoom, $img);

                                    if (isset($zoom['batch']['arrayMake']['In']) && $zoom['batch']['arrayMake']['In']) {
                                        if (self::$axZmH->batchNeedIn($zoom, $img)) {
                                            $needCache = true;
                                            break;
                                        }
                                    }

                                    if (isset($zoom['batch']['arrayMake']['Th']) && $zoom['batch']['arrayMake']['Th']) {
                                        if (self::$axZmH->batchNeedTh($zoom, $img, true)) {
                                            $needCache = true;
                                            break;
                                        }
                                    }

                                    if (isset($zoom['batch']['arrayMake']['tC']) && $zoom['batch']['arrayMake']['tC']) {
                                        if (self::$axZmH->batchNeedTc($zoom, $img)) {
                                            $needCache = true;
                                            break;
                                        }
                                    }

                                    if (isset($zoom['batch']['arrayMake']['Ti']) && $zoom['batch']['arrayMake']['Ti']) {
                                        if (self::$axZmH->batchNeedTi($zoom, $img)) {
                                            $needCache = true;
                                            break;
                                        }
                                    }
                                }

                                if ($needCache) {
                                    $dirTreeArray = self::markDirTreeRoot($dirTreeArray, $k, 'DIR_HAS_IMG', 1);
                                }
                            } else {
                                $dirTreeArray = self::markDirTreeRoot($dirTreeArray, $k, 'DIR_HAS_IMG', 1);
                            }
                        }
                    }

                    foreach($dirTreeArray as $k => $v) {
                        if ($k != 'HOME') {
                            if (!isset($v['DIR_HAS_IMG'])) {
                                unset($dirTreeArray[$k]);
                            }
                        }
                    }
                }
            }

            $_SESSION['axZmBtch']['dirTreeArray'] = $dirTreeArray;

            $totalTime = sprintf('%.2f', (microtime(true) - $startTime));

            $ret = array(
                'time' => $totalTime,
                'numDirs' => count($dirTreeArray)
            );

            return json_encode($ret, JSON_FORCE_OBJECT);
        }

        public static function getPicListArray($zoom, $skip_data = false, $check = false)
        {
            $pic_list_array = array();
            $handle = opendir($zoom['config']['picDir']);
            while ($file = readdir($handle)) {
                if (self::$axZmH->isValidFileType($file)) {
                    $filterCheck = false;

                    if (isset($zoom['batch']['filesFilter']) && !empty($zoom['batch']['filesFilter'])) {
                        if (self::$axZm->strstrRegexArray($zoom['batch']['filesFilter'], $file)) {
                            $filterCheck = true;
                        }
                    }

                    if ($filterCheck === false && $zoom['batch']['resolutionFilter']) {
                        $imgSize  = getimagesize($zoom['config']['picDir'].$file);
                        if ($imgSize[0] * $imgSize[1] < (int)$zoom['batch']['resolutionFilter']) {
                            $filterCheck = true;
                        }
                    }

                    if ($filterCheck === false) {
                        array_push($pic_list_array, $file);
                        if ($check === true) {
                            break;
                        }
                    }
                }
            }

            closedir($handle);

            $pic_list_temp_array = array();

            if (!empty($pic_list_array)) {
                $pic_list_array = self::$axZmH->natIndex($pic_list_array, false);
                $pic_list_data = array();
                $n = 0;

                foreach ($pic_list_array as $k => $v) {
                    $n++;
                    $pic_list_temp_array[$n] = $pic_list_array[$k];

                    if ($skip_data !== true) {
                        $pic_list_data[$n]['imgSize'] = getimagesize($zoom['config']['picDir'].$pic_list_array[$k]);
                        $pic_list_data[$n]['fileSize'] = filesize($zoom['config']['picDir'].$pic_list_array[$k]);
                    }
                }
            }

            if ($skip_data === true) {
                return array(
                    'pic_list_array' => $pic_list_temp_array
                );
            }

            return array(
                'pic_list_array' => $pic_list_temp_array,
                'pic_list_data' => $pic_list_data
            );
        }

        public static function batchAjaxReplaceFolderDropdown($json = false)
        {
            $ret = '';
            self::batchUnsetJobSessions();
            $_SESSION['axZmBtch']['currentDir'] = 'HOME';
            $opt = self::$axZm->dirOptions($_SESSION['axZmBtch']['dirTreeArray'], false );

            $ret .= '
                '.self::$axZmH->arrayToJSObject($_SESSION['axZmBtch']['dirTreeArray'], 'jQuery.zoomBatch.dirTreeArray', false, false, false).';
                jQuery("#batchSelect").html(\''.$opt.'\');
            ';

            if ($json) {
                $ret .= 'jQuery.zoomBatch.reloadDirTreeReturn = '.$json.';';
            }

            die($ret);
        }

        public static function batchAjaxPreviewPic($zoom, $pic)
        {
            $zoom['config']['dynamicThumbsCtime'] = 1;
            ob_start();
            self::$axZm->rawThumb(
                $zoom,
                array(
                    'picDir' => $zoom['config']['picDir'],
                    'imgName' => $pic,
                    'prevWidth' => intval($zoom['batch']['previewWidth']),
                    'prevHeight' => intval($zoom['batch']['previewHeight']),
                    'qual' => $zoom['batch']['previewQual'],
                    'cache' => $zoom['batch']['previewCache'],
                    'download' => false
                )
            );
            ob_end_flush();
            die();
        }

        public static function batchAjaxSwitchBatch($zoom, $batch = '', $pic_list_array = array(), $pic_list_data = array())
        {
            $retScript = '';
            $a = explode('_', $batch);

            if (array_key_exists($a[0], $zoom['batch']['arrayMake'])) {

                $zoom['batch']['arrayMake'][$a[0]] = (($a[1] == 'on') ? true : false);
                $_SESSION['axZmBtch']['arrayMake'] = $zoom['batch']['arrayMake'];

                $retScript = '
                    jQuery("#batchList").html(\''.(self::$axZmH->batchList($zoom, $pic_list_array, $pic_list_data)).'\');
                    jQuery.zoomBatch.trOver();
                ';

                die($retScript);
            }

            die();
        }

        public static function batchAjaxSwitchDir($zoom, $dir = '', $pic_list_array = array(), $pic_list_data = array())
        {
            $_SESSION['axZmBtch']['currentDir'] = $dir;
            $retScript .= '
                jQuery("#batchList").html(\''.self::$axZmH->batchList($zoom, $pic_list_array, $pic_list_data).'\');
                jQuery.zoomBatch.trOver();
                jQuery.zoomBatch.currentDir = "'.$dir.'";
                '.self::$axZmH->arrayToJSObject($pic_list_array, 'jQuery.zoomBatch.pic_list_array', false, false, false).';
            ';

            die($retScript);
        }

        public static function batchAjaxDeleteCacheFor($zoom, $picName, $pic_list_array = array(), $pic_list_data = array())
        {
            if (isset($pic_list_array) && !empty($pic_list_array)) {

                if (isset($pic_list_array[(int)$picName]) && $pic_list_array[(int)$picName]) {
                    $arrDel = $zoom['batch']['arrayMake'];
                    if (isset($arrDel['In']) && $arrDel['In'] == 1) {
                        $arrDel['mO'] = true;
                    }

                    self::$axZmH->removeAxZm(
                        $zoom,
                        $pic_list_array[$picName],
                        $arrDel,
                        false
                    );

                    $retScript = $zoom['batch']['arrayMake']['In'] ? 'jQuery("#In'.$picName.'").attr("class", "'.$zoom['batch']['iconNames']['Error'].'");' : '';
                    $retScript .= $zoom['batch']['arrayMake']['Th'] ? 'jQuery("#Th'.$picName.'").attr("class", "'.$zoom['batch']['iconNames']['Error'].'");' : '';
                    $retScript .= $zoom['batch']['arrayMake']['tC'] ? 'jQuery("#tC'.$picName.'").attr("class", "'.$zoom['batch']['iconNames']['Error'].'");' : '';
                    $retScript .= $zoom['batch']['arrayMake']['Ti'] ? 'jQuery("#Ti'.$picName.'").attr("class", "'.$zoom['batch']['iconNames']['Error'].'");' : '';

                    $retScript .= 'jQuery.zoomBatch.reload();';

                    die($retScript);
                }
            }

            die();
        }

        public static function getNumberImagesInFolders($zoom, $pic_list_array = array(), $depth = 1, $withPaths = 0, $needToProcess = 0)
        {
            $startTime = microtime(true);
            $numImages = 0;
            $imgNames = array();
            $imgInfo = array();
            $imgPaths = array();

            if (!empty($pic_list_array)) {
                // Checkboxes from batch list
                foreach ($pic_list_array as $k => $v) {
                    if (isset($_POST['f'.$k])) {
                        $numImages++;
                        if ($depth != 1) {
                            $file = self::$axZmH->checkSlash($zoom['config']['picDir'].'/'.$v);
                            if ($needToProcess == 1) {
                                $needCache = false;
                                self::$axZmH->axZm->getJsonFileData($zoom, $v);

                                if (!$needCache && isset($zoom['batch']['arrayMake']['In']) && $zoom['batch']['arrayMake']['In']) {
                                    if (self::$axZmH->batchNeedIn($zoom, $v)) {
                                        $needCache = true;
                                    }
                                }

                                if (!$needCache && isset($zoom['batch']['arrayMake']['Th']) && $zoom['batch']['arrayMake']['Th']) {
                                    if (self::$axZmH->batchNeedTh($zoom, $v, true)) {
                                        $needCache = true;
                                    }
                                }

                                if (!$needCache && isset($zoom['batch']['arrayMake']['tC']) && $zoom['batch']['arrayMake']['tC']) {
                                    if (self::$axZmH->batchNeedTc($zoom, $v)) {
                                        $needCache = true;
                                    }
                                }

                                if (!$needCache && isset($zoom['batch']['arrayMake']['Ti']) && $zoom['batch']['arrayMake']['Ti']) {
                                    if (self::$axZmH->batchNeedTi($zoom, $v)) {
                                        $needCache = true;
                                    }
                                }

                                if (!$needCache) {
                                    continue;
                                }
                            }

                            array_push($imgNames, $withPaths == 1 ? $file : $v);

                            if ($depth == 3) {
                                $s = getimagesize($file);
                                $i = array(
                                    0 => $s[0] . ' x ' . $s[1],
                                    1 => self::$axZmH->zoomFileSmartSize(filesize($file), 1)
                                );

                                array_push($imgInfo, $i);
                            }
                        }
                    }
                }
            }

            // Delete all in folders
            if (isset($_POST['folders'])
                && $_POST['folders']
                && is_array($_POST['folders'])
                && !empty($_POST['folders'])
            ) {
                // Identify all subfolders
                $foldersArray = array();
                foreach($_POST['folders'] as $k => $v) {
                    $filtered = array($v);
                    foreach ($_SESSION['axZmBtch']['dirTreeArray'] as $a => $b) {
                        if (strpos($b['DIR_KEY'], $v.'_') === 0) {
                            array_push($filtered, $a);
                        }
                    }

                    $foldersArray = array_merge($foldersArray, $filtered);
                }

                // Select all images in these folders
                // We only need imge names as reference to delete cache
                foreach ($foldersArray as $k => $v) {
                    if (isset($_SESSION['axZmBtch']['dirTreeArray'][$v])) {
                        $folderInfo = $_SESSION['axZmBtch']['dirTreeArray'][$v];

                        if (isset($folderInfo['DIR_PATH']) && $folderInfo['DIR_PATH']) {
                            $folderToOpen = self::$axZmH->checkSlash($zoom['config']['fpPP'].'/'.$folderInfo['DIR_PATH'], 'add');
                            foreach (glob($folderToOpen.'*.*') as $file) { // do not use GLOB_BRACE
                                $fileName = self::$axZmH->getl('/', str_replace('\\', '/', $file));
                                if ($fileName && self::$axZmH->isValidFileType($fileName)) {
                                    if (!self::$axZm->strstrRegexArray($zoom['batch']['filesFilter'], $fileName)) {

                                        if ($needToProcess == 1) {
                                            $needCache = false;
                                            $zoom['config']['picDir'] = $folderToOpen;
                                            self::$axZmH->axZm->getJsonFileData($zoom, $fileName);

                                            if (!$needCache && isset($zoom['batch']['arrayMake']['In']) && $zoom['batch']['arrayMake']['In']) {
                                                if (self::$axZmH->batchNeedIn($zoom, $fileName)) {
                                                    $needCache = true;
                                                }
                                            }

                                            if (!$needCache && isset($zoom['batch']['arrayMake']['Th']) && $zoom['batch']['arrayMake']['Th']) {
                                                if (self::$axZmH->batchNeedTh($zoom, $fileName, true)) {
                                                    $needCache = true;
                                                }
                                            }

                                            if (!$needCache && isset($zoom['batch']['arrayMake']['tC']) && $zoom['batch']['arrayMake']['tC']) {
                                                if (self::$axZmH->batchNeedTc($zoom, $fileName)) {
                                                    $needCache = true;
                                                }
                                            }

                                            if (!$needCache && isset($zoom['batch']['arrayMake']['Ti']) && $zoom['batch']['arrayMake']['Ti']) {
                                                if (self::$axZmH->batchNeedTi($zoom, $fileName)) {
                                                    $needCache = true;
                                                }
                                            }

                                            if (!$needCache) {
                                                continue;
                                            }
                                        }

                                        $numImages++;
                                        if ($depth != 1) {
                                            array_push($imgNames, $withPaths == 1 ? $file : $fileName);
                                            if ($depth == 3) {
                                                $s = getimagesize($file);
                                                $i = array(
                                                    0 => $s[0] . ' x ' . $s[1],
                                                    1 => self::$axZmH->zoomFileSmartSize(filesize($file), 1)
                                                );

                                                array_push($imgInfo, $i);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $ret = array(
                'numImages' => $numImages,
                'imgNames' => $imgNames,
                'imgInfo' => $imgInfo,
                'time' => round(microtime(true) - $startTime, 4)
            );

            die(json_encode($ret));
        }

        public static function batchAjaxDeleteCacheSelected($zoom, $pic_list_array)
        {
            $startTime = microtime(true);
            $del_array = array();
            $toDeleteImages = array();
            $retScript = '';

            $arrDel = $zoom['batch']['arrayMake'];
            if (isset($arrDel['In']) && $arrDel['In'] == 1) {
                $arrDel['mO'] = true;
            }

            if (!empty($pic_list_array)) {
                // Checkboxes from batch list
                foreach ($pic_list_array as $k => $v) {
                    if (isset($_POST['f'.$k])) {
                        $del_array[$k] = $v;
                    }
                }

                if (!empty($del_array)) {

                    foreach ($del_array as $k => $v) {
                        self::$axZmH->removeAxZm($zoom, $v, $arrDel, false);
                        $retScript .= $zoom['batch']['arrayMake']['In'] ? "jQuery('#In".$k."').attr('class','".$zoom['batch']['iconNames']['Error']."');" : '';
                        $retScript .= $zoom['batch']['arrayMake']['Th'] ? "jQuery('#Th".$k."').attr('class','".$zoom['batch']['iconNames']['Error']."');" : '';
                        $retScript .= $zoom['batch']['arrayMake']['tC'] ? "jQuery('#tC".$k."').attr('class','".$zoom['batch']['iconNames']['Error']."');" : '';
                        $retScript .= $zoom['batch']['arrayMake']['Ti'] ? "jQuery('#Ti".$k."').attr('class','".$zoom['batch']['iconNames']['Error']."');" : '';
                    }
                }
            }

            // Delete all in folders
            if ($zoom['batch']['allowDeleteInSubfolders'] === true
                && isset($_POST['folders'])
                && $_POST['folders']
                && is_array($_POST['folders'])
                && !empty($_POST['folders'])
            ) {
                // Identify all subfolders
                $foldersArray = array();
                foreach($_POST['folders'] as $k => $v) {
                    $filtered = array($v);
                    foreach ($_SESSION['axZmBtch']['dirTreeArray'] as $a => $b) {
                        if (strpos($b['DIR_KEY'], $v.'_') === 0) {
                            array_push($filtered, $a);
                        }
                    }

                    $foldersArray = array_merge($foldersArray, $filtered);
                }

                // Select all images in these folders
                // We only need imge names as reference to delete cache
                foreach ($foldersArray as $k => $v) {
                    if (isset($_SESSION['axZmBtch']['dirTreeArray'][$v])) {
                        $folderInfo = $_SESSION['axZmBtch']['dirTreeArray'][$v];

                        if (isset($folderInfo['DIR_PATH']) && $folderInfo['DIR_PATH']) {
                            $folderToOpen = self::$axZmH->checkSlash($zoom['config']['fpPP'].'/'.$folderInfo['DIR_PATH'], 'add');
                            foreach (glob($folderToOpen.'*.*') as $file) { // do not use GLOB_BRACE
                                $fileName = self::$axZmH->getl('/', str_replace('\\', '/', $file));
                                if ($fileName && self::$axZmH->isValidFileType($fileName)) {
                                    if (!self::$axZm->strstrRegexArray($zoom['batch']['filesFilter'], $fileName)) {
                                        array_push($toDeleteImages, $fileName);
                                    }
                                }
                            }
                        }
                    }
                }

                // Trigger delete
                if (!empty($toDeleteImages)) {
                    foreach ($toDeleteImages as $k => $v) {
                        self::$axZmH->removeAxZm(
                            $zoom,
                            $v,
                            $arrDel,
                            false
                        );
                    }
                }
            }

            $numDeleted = count($del_array) + count($toDeleteImages);

            $retScript .= 'jQuery(".processMsg").remove(); jQuery(".batchInfo").css("display", "none"); ';
            $retScript .= 'jQuery("#batchProcess").append(\'<div class="processMsg alert alert-info clearfix" id="processMsgNotice">'
                .$zoom['batch']['iconInfo'].' Batch delete for '.$numDeleted.' images completed in '
                .(round((microtime(true) - $startTime), 4)).' seconds.</div>\');';

            $retScript .= 'jQuery("#passFiles input").attr({disabled: false});';
            $retScript .= 'jQuery("#leftFrameFoot input").attr({disabled: false});';

            die($retScript);
        }

        public static function batchLogErrors($zoom)
        {
            if (isset($_SESSION['axZmBtch']['batchErrors'])) {
                $_SESSION['axZmBtch']['batchErrors']++;

                if (isset($_SESSION['axZmBtch']['batchErrorFiles'])
                    && isset($zoom['config']['orgImgName'])
                    && isset($zoom['config']['picDir'])
                ) {
                    if (!in_array($zoom['config']['orgImgName'], $_SESSION['axZmBtch']['batchErrorFiles'])) {
                        array_push($_SESSION['axZmBtch']['batchErrorFiles'], $zoom['config']['orgImgName']);
                        array_push($_SESSION['axZmBtch']['batchErrorFilesWithPath'], $zoom['config']['picDir'].$zoom['config']['orgImgName']);
                    }
                }
            }
        }

        public static function batchFolderClb($zoom, $idx = 0)
        {
            if (!$zoom['batch']['afterBatchFolderEndJsClb']) {
                return '';
            }

            $ret = '';
            $batchFolder = '';
            if (isset($_SESSION['axZmBtch']['batchFolders'][$idx])) {
                $batchFolder = $_SESSION['axZmBtch']['batchFolders'][$idx];
            } elseif ($_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']]) {
                $batchFolder = $_SESSION['axZmBtch']['currentDir'];
            }

            if ($batchFolder) {
                $ret = ';if (jQuery.isFunction('.$zoom['batch']['afterBatchFolderEndJsClb'].')) {
                        '.$zoom['batch']['afterBatchFolderEndJsClb'].'({
                            "picDir": "'.$zoom['config']['picDir'].'",
                            "key": "'.$batchFolder.'",
                            "dirTreeArray": jQuery.zoomBatch.dirTreeArray
                        });
                    }
                ';
            }
            /*
            "dta": '.(isset($_SESSION['axZmBtch']['dirTreeArray'][$batchFolder])
                && is_array($_SESSION['axZmBtch']['dirTreeArray'][$batchFolder])
                ? json_encode($_SESSION['axZmBtch']['dirTreeArray'][$batchFolder], JSON_FORCE_OBJECT) : '{}').',
            */
            return $ret;
        }

        public static function batchAjaxProcessStart($zoom, $pic_list_array)
        {
            $ret = '';

            // Pressed on stop batch button
            if ($_SESSION['axZmBtch']['batchStopped']) {
                self::batchUnsetJobSessions();
                $ret .= '
                    jQuery.zoomBatch.stopBatchAfter();
                ';

                die($ret);
            }

            // Reset batch job session values
            $_SESSION['axZmBtch']['batchJobN'] = 0;
            if (!isset($_SESSION['axZmBtch']['batchJobNt'])) {
                $_SESSION['axZmBtch']['batchJobNt'] = 0;
            }

            if (!isset($_SESSION['axZmBtch']['batchShowResults'])) {
                $_SESSION['axZmBtch']['batchShowResults'] = false;
            }

            if (!isset($_SESSION['axZmBtch']['batchStartTimeT'])) {
                $_SESSION['axZmBtch']['batchStartTimeT'] = microtime(true);
            }

            if (isset($_GET['rebuild'])) {
                $_SESSION['axZmBtch']['rebuild'] = true;
            } else {
                $_SESSION['axZmBtch']['rebuild'] = false;
            }

            // Strip $pic_list_array from values, that have been not checked
            $pic_list_temp_array = $pic_list_array;
            foreach ($pic_list_array as $k => $v) {
                if (!isset($_POST['f'.$k])) {
                    unset($pic_list_temp_array[$k]);
                }
            }

            // Pic list array for farther processing!
            $pic_list_array = $pic_list_temp_array;

            // Posted folders
            if ($_POST['folders'] && is_array($_POST['folders']) && !empty($_POST['folders'])) {
                $foldersArray = array();
                foreach($_POST['folders'] as $k => $v) {
                    $filtered = array($v);
                    foreach($_SESSION['axZmBtch']['dirTreeArray'] as $a => $b) {
                        if (strpos($b['DIR_KEY'], $v.'_') === 0) {
                            array_push($filtered, $a);
                        }
                    }

                    $foldersArray = array_merge($foldersArray, $filtered);
                }

                // Save folders we need to session
                $_SESSION['axZmBtch']['batchFolders'] = $foldersArray;
                $_SESSION['axZmBtch']['batchFoldersIndex'] = -1;
            }

            // No images to process in this folder, but other folders might have not been processed yet
            if (empty($pic_list_array) && !empty($_SESSION['axZmBtch']['batchFolders'])) {

                echo self::batchFolderClb($zoom, $_SESSION['axZmBtch']['batchFoldersIndex']);

                // Increase index of folder processing
                $_SESSION['axZmBtch']['batchFoldersIndex']++;

                // Proceed to next folder if present
                if (isset($_SESSION['axZmBtch']['batchFolders'][$_SESSION['axZmBtch']['batchFoldersIndex']])) {
                    $ret .= '
                        jQuery.zoomBatch.changeDir("'.$_SESSION['axZmBtch']['batchFolders'][$_SESSION['axZmBtch']['batchFoldersIndex']].'", function() {
                            // Select all files not done
                            jQuery.zoomBatch.smartSelect(true);

                            // Submit selection
                            jQuery.zoomBatch.batchSubmit(true);
                        });
                    ';
                } else {
                    // done
                   $_SESSION['axZmBtch']['batchShowResults'] = true;
                }

            } elseif (!empty($pic_list_array)) {
                // We have images to process
                // Save $pic_list_array to session in order not read them every time
                $_SESSION['axZmBtch']['batchJob'] = $pic_list_array; // jobs in current folder
                $_SESSION['axZmBtch']['batchJobCount'] = count($pic_list_array); // nuber of images to process in that folder
                $_SESSION['axZmBtch']['batchStartTime'] = microtime(true); // start time for that folder

                reset($_SESSION['axZmBtch']['batchJob']);

                // Init first image for further processing
                $zoomID = key($_SESSION['axZmBtch']['batchJob']);

                // Trigger first file generation
                $ret .= '
                    jQuery(".processMsg").remove();
                    jQuery(".batchInfo, .batchSettings").css("display", "none");
                    jQuery.fn.axZm.removeAZ();
                    jQuery("table.batchProcessTable tbody").empty();

                    jQuery("#processTable > tbody")
                    .append(\'<tr id="rowWait_'.$zoomID.'" class="processRow"><td colspan="'
                    .(6 + ($zoom['batch']['enableBatchThumbs'] ? 0 : -1)).'">Processing <strong>'
                    .$_SESSION['axZmBtch']['batchJob'][$zoomID].'</strong>, please wait...</td><td style="position: relative;"><div class="imgLoading"></div></td></tr>\');

                    jQuery.ajax({
                        url: "'.$zoom['batch']['selfFile'].'?zoomID='.$zoomID.'",
                        timeout: 360000,
                        cache: false,
                        dataType: "script",
                        success: function (data) {

                        }
                    });
                ';
            }

            if ($ret) {
                die($ret);
            } elseif (!$_SESSION['axZmBtch']['batchShowResults']) {
                die();
            }
        }

        public static function batchAjaxProcessBatchFile($zoom, $zoomID, $pic_list_array = array(), $pic_list_data = array(), $rebuild = false)
        {
            // Iterate (with Ajax) until $_SESSION['axZmBtch']['batchJob'] is empty
            $ret = '';

            // Pressed on stop batch button
            if ($_SESSION['axZmBtch']['batchStopped']) {
                self::batchUnsetJobSessions();
                $ret .= '
                    jQuery.zoomBatch.stopBatchAfter();
                ';

                die($ret);
            }

            $zoomID = (int)$zoomID;

            // Srating time for one image
            $startTime = microtime(true);

            // Srart counter for errors
            if (!isset($_SESSION['axZmBtch']['batchErrors'])) {
                $_SESSION['axZmBtch']['batchErrors'] = 0;
            }

            if (!isset($_SESSION['axZmBtch']['batchErrorFiles'])) {
                $_SESSION['axZmBtch']['batchErrorFiles'] = array();
                $_SESSION['axZmBtch']['batchErrorFilesWithPath'] = array();
            }

            $_SESSION['axZmBtch']['batchJobN']++; // current folder
            $_SESSION['axZmBtch']['batchJobNt']++; // overall

            // Legacy image slicer, todo: test
            $imageSlicer = isset($zoom['config']['imageSlicer']) ? $zoom['config']['imageSlicer'] : array();
            if (!is_array($imageSlicer)) {
                $imageSlicer = array();
            }

            $slicerPostArr = array(
                'zoomID' => $zoomID,
                'example' => isset($_GET['example']) ? $_GET['example'] : '',
                'pic' => $zoom['config']['pic'],
                'pic_list_data' => serialize(array($zoomID => $pic_list_data[$zoomID])),
                'pic_list_array' => serialize(array($zoomID => $pic_list_array[$zoomID]))
            );

            if ($imageSlicer['enabled'] && !empty($imageSlicer['parameters'])) {
                foreach ($imageSlicer['parameters'] as $a => $b) {
                    if (isset($_GET[$b])) {
                        $slicerPostArr[$b] = $_GET[$b];
                    }
                }
            }

            // Define AJAX-ZOOM values from session
            $zoom['config']['orgImgName'] = $_SESSION['axZmBtch']['batchJob'][$zoomID];
            $zoom['config']['orgImgSize'] = self::$axZm->imageSize($zoom['config']['picDir'].$zoom['config']['orgImgName'], $zoom['config']['im'], true);
            $zoom['config']['smallImgName'] = self::$axZmH->composeFileName($_SESSION['axZmBtch']['batchJob'][$zoomID], $zoom['config']['picDim'], '_');

            // Make initial image(s)
            if ($zoom['batch']['arrayMake']['In']) {
                if ($rebuild === true) {
                    self::$axZmH->removeAxZm($zoom, $zoom['config']['orgImgName'], array('In' => true, 'mO' => true), false);
                }

                if ($imageSlicer['enabled']) {
                    $slicerPostArr['task'] = 'makeFirstImage';
                    $makeFirstImage = self::$axZmH->httpRequestQuery(
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
                    $makeFirstImage = self::$axZm->makeFirstImage($zoom);
                }
            }

            // Make thumbnails for galleries
            if ($zoom['batch']['arrayMake']['Th']) {
                if ($rebuild === true) {
                    self::$axZmH->removeAxZm($zoom, $zoom['config']['orgImgName'], array('Th' => true), false);
                }

                if ($imageSlicer['enabled']) {
                    $slicerPostThumbsArr = array(
                        'task' => 'makeThumb',
                        'zoomID' => $zoomID,
                        'example' => isset($_GET['example']) ? $_GET['example'] : '',
                        'pic' => $zoom['config']['pic'],
                        'pic_list_data' => serialize($pic_list_data), // for all? This is not inteded in batch
                        'pic_list_array' => serialize($pic_list_array) // for all? This is not inteded in batch
                    );

                    if (!empty($imageSlicer['parameters'])) {
                        foreach ($imageSlicer['parameters'] as $a => $b) {
                            if (isset($_GET[$b])) {
                                $slicerPostThumbsArr[$b] = $_GET[$b];
                            }
                        }
                    }

                    $makeThumb = self::$axZmH->httpRequestQuery(
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
                    // will return an array (0 => [(int) num images made], 1 => [(array) with errors])
                    $makeThumb = self::$axZm->makeThumb($zoom, $_SESSION['axZmBtch']['batchJob'], $zoomID);
                }
            }

            if ($zoom['batch']['arrayMake']['tC']
                && isset($zoom['batch']['dynImageSizes'])
                && is_array($zoom['batch']['dynImageSizes'])
                && !empty($zoom['batch']['dynImageSizes'])
            ) {
                if ($rebuild === true) {
                    self::$axZmH->removeAxZm($zoom, $zoom['config']['orgImgName'], array('tC' => true), false);
                }

                foreach ($zoom['batch']['dynImageSizes'] as $k => $v) {
                    $makeCache = true;
                    $makeThisCache = self::$axZm->rawThumb(
                        $zoom,
                        array(
                            'picDir' => $zoom['config']['picDir'],
                            'imgName' => $zoom['config']['orgImgName'],
                            'prevWidth' => intval($v['width']),
                            'prevHeight' => intval($v['height']),
                            'qual' => intval($v['qual']),
                            'thumbMode' => ($v['thumbMode'] ? $v['thumbMode'] : false),
                            'cache' => true,
                            'make' => true,
                            'download' => false
                        )
                    );

                    if (!$makeThisCache) {
                        $makeCache = false;
                    }
                }
            } elseif ($zoom['batch']['arrayMake']['tC']) {
                $makeCache = true;
            }

            // Make tiles
            if ($zoom['batch']['arrayMake']['Ti']) {
                if ($rebuild === true) {
                    self::$axZmH->removeAxZm($zoom, $zoom['config']['orgImgName'], array('Ti' => true), false);
                }

                if (!self::$axZmH->tileExists($zoom, $zoom['config']['orgImgName'], false)) {
                    if ($imageSlicer['enabled']) {
                        $slicerPostArr['task'] = 'makeZoomTiles';

                        $makeZoomTiles = self::$axZmH->httpRequestQuery(
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
                        $makeZoomTiles = self::$axZm->makeZoomTiles($zoom);
                    }
                } else {
                    $makeZoomTiles = true;
                }
            }

            $error = false;
            $jsIcons = '';

            // Add row to batch list
            $returnRow = '<tr id="row_'.$zoomID.'">';
                // Thumbnail
                if ($zoom['batch']['enableBatchThumbs']) {
                    $imgSrc = $zoom['config']['zoomLoadFile'].'?azImg='.$zoom['config']['pic'].'/'.$zoom['config']['orgImgName'];
                    $imgSrc .= '&'.$zoom['batch']['batchThumbsDynString'];
                    $returnRow .= '<td class="batchListThumbTd"><img src="'.$imgSrc.'" class="batchListThumb"></td>';
                }

                // Image name
                $returnRow .= '<td class="breakWords">'.$zoom['config']['orgImgName'].'</td>';

                // Icons preview images
                $returnRow .= '<td class="iconWidth" id="InMk'.$zoomID.'">'.$zoom['batch']['iconO'].'</td>';
                if (!isset($makeFirstImage)) {
                    // Not applied
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#InMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['iconN'].'");';
                } elseif ($makeFirstImage) {
                    // Done without errors
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#InMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#In'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                } else {
                    // Error
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#InMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#In'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';

                    // Log errors
                    self::batchLogErrors($zoom);

                    $error = true;
                }

                // Icon gallery thumbnails
                $returnRow .= '<td class="iconWidth" id="ThMk'.$zoomID.'">'.$zoom['batch']['iconO'].'</td>';
                if (!isset($makeThumb)) {
                    // Not applied
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#ThMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['iconN'].'");';
                } elseif (isset($makeThumb) && empty($makeThumb[1])) {
                    // Done without errors
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#ThMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#Th'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                } else {
                    // Error
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#ThMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#Th'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';

                    // Log errors
                    self::batchLogErrors($zoom);

                    $error = true;
                }

                // Dynamic images
                $returnRow .= '<td class="iconWidth" id="tCMk'.$zoomID.'">'.$zoom['batch']['iconN']."</td>";
                if (!isset($makeCache)) {
                    // Not applied
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#tCMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['iconN'].'");';
                } elseif ($makeCache) {
                    // Done without errors
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#tCMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#tC'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                } else {
                    // Error
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#tCMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#tC'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';

                    // Log errors
                    self::batchLogErrors($zoom);

                    $error = true;
                }

                // Image tiles
                $returnRow .= '<td class="iconWidth" id="TiMk'.$zoomID.'">'.$zoom['batch']['iconN']."</td>";
                if (!isset($makeZoomTiles)) {
                    // Not applied
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#TiMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['iconN'].'");';
                } elseif ($makeZoomTiles) {
                    // Done without errors
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#TiMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#Ti'.$zoomID.'", "'.$zoom['batch']['iconNames']['Ok'].'");';
                } else {
                    // Error
                    $jsIcons .= 'jQuery.zoomBatch.setCellIconDone("#TiMk'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';
                    $jsIcons .= 'jQuery.zoomBatch.setCellIcon("#Ti'.$zoomID.'", "'.$zoom['batch']['iconNames']['Error'].'");';

                    // Log errors
                    self::batchLogErrors($zoom);

                    $error = true;
                }

                // Row with time completion for one image
                $returnRow .= '<td style="width: 55px">'.sprintf('%.3f', (microtime(true) - $startTime)).'</td>';

            $returnRow .= '</tr>';

            // Message in the panel heading if the batch box
            $prozessCountString = ' file '.$_SESSION['axZmBtch']['batchJobN'].' of '.$_SESSION['axZmBtch']['batchJobCount'];

            if (isset($_SESSION['axZmBtch']['batchFolders'])) {
                $prozessCountString .= ' [folder '.($_SESSION['axZmBtch']['batchFoldersIndex']+1).' from '.count($_SESSION['axZmBtch']['batchFolders']).', ';
                $prozessCountString .= 'images processed: '.$_SESSION['axZmBtch']['batchJobNt'].']';
            }

            $ret .= '
                jQuery("#rowWait_" + '.$zoomID.').remove();
                jQuery("#processTable > tbody").append(\''.$returnRow.'\');

                jQuery.zoomBatch.updateProgressBar('.$_SESSION['axZmBtch']['batchJobN'].', '.$_SESSION['axZmBtch']['batchJobCount'].');
                '.$jsIcons.'

                jQuery("#batchProcess").scrollTo("#row_'.$zoomID.'", {duration: '.min($zoom['batch']['pause'], 100).'});
                jQuery("#batchList").scrollTo("#d'.$zoomID.'", {duration: '.min($zoom['batch']['pause'], 100).'});

                if (jQuery("#batchCounterDiv").get()) {
                    jQuery("#batchCounterDiv").html("'.$prozessCountString.'");
                }
            ';

            if ($error) {
                $ret .= '
                    jQuery("#row_'.$zoomID.'").css("backgroundColor", "#EED4D4");
                ';

                if ($zoom['batch']['stopOnError']) {
                    $_SESSION['axZmBtch']['batchJob'] = array();
                    $ret .= '
                        jQuery.stopedOnError = true;
                    ';
                }
            } else {
                $ret .= '
                    jQuery("#f'.$zoomID.'").attr({checked: false});
                ';
            }

            // Unset current made zoomID from $_SESSION['axZmBtch']['batchJob']
            if (isset($_SESSION['axZmBtch']['batchJob'][$zoomID])) {
                unset($_SESSION['axZmBtch']['batchJob'][$zoomID]);
            }

            // Triger next zoomID via AJAX, if available
            if (!empty($_SESSION['axZmBtch']['batchJob'])) {
                reset($_SESSION['axZmBtch']['batchJob']);
                $nextJobID = key($_SESSION['axZmBtch']['batchJob']);

                // Add waiting dialog
                $ret .= '
                    jQuery("#processTable > tbody")
                    .append(\'<tr id="rowWait_'.$nextJobID.'" class="processRow"><td colspan="'
                    .(6 + ($zoom['batch']['enableBatchThumbs'] ? 0 : -1)).'">Processing <strong>'
                    .$_SESSION['axZmBtch']['batchJob'][$nextJobID].'</strong>, please wait...</td><td style="position: relative;"><div class="imgLoading"></div></td></tr>\');

                    setTimeout(function() {
                        jQuery.ajax({
                            url: "'.$zoom['batch']['selfFile'].'?zoomID='.$nextJobID.'",
                            timeout: 360000,
                            cache: false,
                            dataType: "script",
                            success: function (data) {

                            }
                        });

                    }, '.$zoom['batch']['pause'].');
                ';

                die($ret);
            } else {
                echo self::batchFolderClb($zoom, 'endFolder');
                $_SESSION['axZmBtch']['batchShowResults'] = true;
            }

            return $ret;
        }

        public static function batchAjaxProcessFolder($zoom)
        {
            $ret = '';
            $_SESSION['axZmBtch']['batchFoldersIndex']++;
            if ($_SESSION['axZmBtch']['batchFolders'][$_SESSION['axZmBtch']['batchFoldersIndex']]) {

                $ret .= '
                    jQuery.zoomBatch.changeDir("'.$_SESSION['axZmBtch']['batchFolders'][$_SESSION['axZmBtch']['batchFoldersIndex']].'", function() {
                        // Select all files not done
                        jQuery.zoomBatch.smartSelect(true);

                        // Submit selection
                        jQuery.zoomBatch.batchSubmit(true);
                    });
                ';

                die($ret);
            } else {
                $_SESSION['axZmBtch']['batchShowResults'] = true;
            }

            return $ret;
        }

        public static function batchAjaxProcessEnd($zoom)
        {
            // Show overall results
            $ret = '';
            $totalTime = round(microtime(true) - $_SESSION['axZmBtch']['batchStartTimeT'], 4);
            if ($totalTime < 1) {
                $totalTime = 1;
            }

            $ret .= '
                jQuery("#passFiles input").attr({disabled: false});
                jQuery("#leftFrameFoot input, #leftFrameFoot button").attr({disabled: false});
                jQuery.zoomBatch.isRunning = false;
                jQuery(".processMsg").remove();

                var mmm = \'<div class="processMsg alert alert-info clearfix" id="processMsg">\';
                    mmm += \'<input type="button" class="btn btn-sm btn-default pull-right" value="Clear" onClick="jQuery.zoomBatch.clearBatchResults();">\';

                    mmm += \''.($_SESSION['axZmBtch']['batchErrors'] == 0 ? $zoom['batch']['iconSmile'] : $zoom['batch']['iconWarning']).'\';
                    mmm += \'Batch process completed \';
                    mmm += \''.(($_SESSION['axZmBtch']['batchErrors'] > 0) ? ' with '.$_SESSION['axZmBtch']['batchErrors'].' errors ' : '').'\';
                    mmm += \' in '.self::$axZmH->seconds2time($totalTime, 'string').'\';
                    mmm += \'<br>Processed: '.$_SESSION['axZmBtch']['batchJobNt'].' images \';
            ';

            if (count($_SESSION['axZmBtch']['batchFolders'] > 0)) {
                $ret .= 'mmm += \' in '.count($_SESSION['axZmBtch']['batchFolders']).' folders.\';';
            }

            $ret .= 'mmm += \'<br><br>\'';

            if ($zoom['batch']['stopOnError'] && count($_SESSION['axZmBtch']['batchErrorFiles']) > 0) {
                $ret .= '
                    if (jQuery.stopedOnError) {
                        jQuery.stopedOnError = false;
                        mmm += "Please note, that the batch process has been stoped because of an error processing this image: '
                        .implode(', ', $_SESSION['axZmBtch']['batchErrorFiles']).'";
                    }
                ';
            } elseif (count($_SESSION['axZmBtch']['batchErrorFiles']) > 0) {
                $ret .= '
                    mmm += " Files processed with errors: '.implode(', ', $_SESSION['axZmBtch']['batchErrorFiles']).'";
                ';
            }

            $ret .= '
                mmm += "</div>";
                jQuery("#batchProcess")
                .append(mmm)
                .scrollTo(".processMsg");

                if (jQuery("#batchCounterDiv").get()) {
                    jQuery("#batchCounterDiv").html("finished");
                    setTimeout(function() {
                        jQuery("#batchProgressBar").animate({width: 0}, {duration: 500, easing: "linear"});
                    }, 1000);
                }

                jQuery("#buttonBatchStop").fadeOut(200);
            ';

            // Log errors
            if ($zoom['batch']['logErrorsPath']
                && isset($_SESSION['axZmBtch']['batchErrorFilesWithPath'])
                && !empty($_SESSION['axZmBtch']['batchErrorFilesWithPath'])
            ) {
                if (is_dir($zoom['batch']['logErrorsPath']) && is_writable($zoom['batch']['logErrorsPath'])) {
                    $log = implode("\r\n", $_SESSION['axZmBtch']['batchErrorFilesWithPath']);
                    file_put_contents($zoom['batch']['logErrorsPath'].'/log_'.date("Y.m.d.h.i.s").'.txt', $log);
                }
            }

            // unset all sessions about jobs...
            self::batchUnsetJobSessions();

            die($ret);
        }
    }
}
