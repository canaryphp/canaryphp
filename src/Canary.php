<?php
/**
 * CanaryPHP(tm) : Rapid Development Framework (canaryphp@gmail.com)
 * Copyright (c) Canaryphp Software Foundation, Inc. (canaryphp@gmail.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Canaryphp Software Foundation, Inc. (canaryphp@gmail.com)
 * @link      https://github.com/canaryphp/canaryphp CanaryPHP(tm) Project
 * @since     1.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace CanaryPHP;
require_once __DIR__.DIRECTORY_SEPARATOR.'requires.php';
class Canary{
public function __construct(string $path = null){
//set home path
$path = ($path === null)? win_path($_SERVER['DOCUMENT_ROOT']): $path;
ob_start();
self::$_ROOT = $path;
//Constants
/**
 *
 * DS = DIRECTORY_SEPARATOR = (/) (slash)
 *
 */
defined('DS') OR define('DS',DIRECTORY_SEPARATOR);
/**
 *
 * CHARSET the default charset
 *
 */
defined('CHARSET') OR define('CHARSET','utf-8');
/**
 *
 * PS = PATH_SEPARATOR = (:) (Two point)
 *
 */
defined('PS') OR define('PS',PATH_SEPARATOR);
/**
 *
 * EOL = PHP_EOL = ('\n') (new line)
 *s
 */
defined('EOL') OR define('EOL',PHP_EOL);
/**
 *
 * ROOT home base url
 *
 */
defined('ROOT') OR define('ROOT',self::$_ROOT);
/**
 *
 * HOST hostname (domainname)
 *
 */
defined('HOST') OR define('HOST',$_SERVER['HTTP_HOST']);
/**
 *
 * APP app base url
 *
 */
defined('APP') OR define('APP',ROOT.DS.'app');
/**
 *
 *  LOG logs base url
 *
 */
defined('LOG') OR define('LOG',ROOT.DS.'logs');
/**
 *
 * LOCALE locale base url (translation)
 *
 */
defined('LOCALE') OR define('LOCALE',ROOT.DS.'locale');
/**
 *
 *  WEBROOT webroot base url
 *
 */
defined('WEBROOT') OR define('WEBROOT',ROOT.DS.'webroot');
/**
 *
 *  CONFIG config base url
 *
 */
defined('CONFIG') OR define('CONFIG',ROOT.DS.'config');
/**
 *
 *  TMP temporary files base url
 *
 */
defined('TMP') OR define('TMP',ROOT.DS.'tmp');
/**
 *
 *  Root uploads
 *
 */
defined('ROOT_UPLOADS') OR define('ROOT_UPLOADS',WEBROOT.DS.'uploads');
/**
 *
 *  ROOT FOR html resources
 *
 */
$path = explode(win_path($_SERVER['DOCUMENT_ROOT']),ROOT);
$path = str_replace('webroot'.DS,'',end($path));
defined('ROOT_HTML') OR define('ROOT_HTML',win_path($path,TRUE));
/**
 *
 *  Uploads directory
 *
 */
defined('UPLOADS') OR define('UPLOADS','/uploads');
/**
 *
 *  CSS styles base url
 *
 */
defined('CSS') OR define('CSS','/css');
/**
 *
 *  IMG images base url
 *
 */
defined('IMG') OR define('IMG','/img');
/**
 *
 *  JS JavaScript base url
 *
 */
defined('JS') OR define('JS','/js');
/**
 *
 * set locale url
 *
 **/
cp_config_add('url',['locale'=>LOCALE,'log'=>LOG]);
}
/**
 *
 * home path
 *
 * @param (string)
 *
 */
private static $_ROOT;
/**
 *
 *Declare classes
 *
 */
 public function load(){
 	return new \CanaryPHP\Load();
 }
 public function element(){
 	return new \CanaryPHP\Element();
 }

/**
 *
 * create required folder and files
 *
 */
 public static function install(){
    //create folders
    $required_folders = [
        'app',
        'app'.DS.'controller',
            'app'.DS.'template',
                'app'.DS.'template'.DS.'default',
                    'app'.DS.'template'.DS.'default'.DS.'element',
                    'app'.DS.'template'.DS.'default'.DS.'email',
                        'app'.DS.'template'.DS.'default'.DS.'email'.DS.'html',
                        'app'.DS.'template'.DS.'default'.DS.'email'.DS.'text',
                    'app'.DS.'template'.DS.'default'.DS.'error',
                    'app'.DS.'template'.DS.'default'.DS.'pages',
                    'app'.DS.'template'.DS.'default'.DS.'view',
        'config',
        'tmp',
        'logs',
        'locale',
            'locale'.DS.'__ARRAY__',
            'locale'.DS.'__JSON__',
        'webroot',
            'webroot',
            'webroot'.DS.'js',
            'webroot'.DS.'css',
            'webroot'.DS.'font',
            'webroot'.DS.'errors',
            'webroot'.DS.'img',
            'webroot'.DS.'uploads',
];
    //create files
    $source_file = CP_ROOT.DS.'source';
    $required_files = [
        // app/controller/
            'app'.DS.'controller'.DS.'indexController.php'=>'.app.controller.indexController.txt',
        // app/template/default/element
            'app'.DS.'template'.DS.'default'.DS.'element'.DS.'error.php'=>'.app.template.default.element.error.txt',
            'app'.DS.'template'.DS.'default'.DS.'element'.DS.'success.php'=>'.app.template.default.element.success.txt',
        // app/template/default/error
            'app'.DS.'template'.DS.'default'.DS.'error'.DS.'400.php'=>'.app.template.default.error.400.txt',
            'app'.DS.'template'.DS.'default'.DS.'error'.DS.'401.php'=>'.app.template.default.error.401.txt',
            'app'.DS.'template'.DS.'default'.DS.'error'.DS.'402.php'=>'.app.template.default.error.402.txt',
            'app'.DS.'template'.DS.'default'.DS.'error'.DS.'403.php'=>'.app.template.default.error.403.txt',
            'app'.DS.'template'.DS.'default'.DS.'error'.DS.'404.php'=>'.app.template.default.error.404.txt',
            'app'.DS.'template'.DS.'default'.DS.'error'.DS.'500.php'=>'.app.template.default.error.500.txt',
        // app/template/default/pages
            'app'.DS.'template'.DS.'default'.DS.'pages'.DS.'header.php'=>'.app.template.default.pages.header.txt',
            'app'.DS.'template'.DS.'default'.DS.'pages'.DS.'footer.php'=>'.app.template.default.pages.footer.txt',
        // app/template/default/email
            'app'.DS.'template'.DS.'default'.DS.'email'.DS.'text'.DS.'default.php'=>'.app.template.default.text.default.txt',
            'app'.DS.'template'.DS.'default'.DS.'email'.DS.'html'.DS.'default.php'=>'.app.template.default.html.default.txt',
        // app/template/default/view
            'app'.DS.'template'.DS.'default'.DS.'view'.DS.'index.php'=>'.app.template.default.view.index.txt',
        // config
            'config'.DS.'app.php'=>'.config.app.txt',
        // locale
            'locale'.DS.'__ARRAY__'.DS.'default.php'=>'.locale.array.default.txt',
            'locale'.DS.'__JSON__'.DS.'default.php'=>'.locale.json.default.txt',
        // webroot/css
            'webroot'.DS.'css'.DS.'bootstrap.min.css'=>'.webroot.css.bootstrap.min.txt',
            'webroot'.DS.'css'.DS.'bootstrap.rtl.min.css'=>'.webroot.css.bootstrap.rtl.min.txt',
        // webroot/errors
            'webroot'.DS.'errors'.DS.'400.php'=>'.webroot.errors.400.txt',
            'webroot'.DS.'errors'.DS.'401.php'=>'.webroot.errors.401.txt',
            'webroot'.DS.'errors'.DS.'402.php'=>'.webroot.errors.402.txt',
            'webroot'.DS.'errors'.DS.'403.php'=>'.webroot.errors.403.txt',
            'webroot'.DS.'errors'.DS.'404.php'=>'.webroot.errors.404.txt',
            'webroot'.DS.'errors'.DS.'500.php'=>'.webroot.errors.500.txt',
        // webroot/js
            'webroot'.DS.'js'.DS.'bootstrap.min.js'=>'.webroot.js.bootstrap.min.txt',
            'webroot'.DS.'js'.DS.'cookies.js'=>'.webroot.js.cookies.txt',
            'webroot'.DS.'js'.DS.'jquery-3.4.1.min.js'=>'.webroot.js.jquery-3.4.1.min.txt',
        // webroot
            'webroot'.DS.'.htaccess'=>'.webroot.htaccess.txt',
            'webroot'.DS.'index.php'=>'.webroot.index.txt',
        // /
            '.htaccess'=>'.htaccess.txt',
            'index.php'=>'.index.txt',
];
    //create home folder
    if(!file_exists(self::$_ROOT)) {
        mkdir(self::$_ROOT,0777);
    }
    //create sub folders
    foreach ($required_folders as $value) {
        if(!file_exists(self::$_ROOT.DS.$value)) {
            mkdir(self::$_ROOT.DS.$value,0777);
        }
    }
    //create project files
    foreach ($required_files as $key=>$value) {
        if(file_exists(self::$_ROOT.DS.$key)){
            unlink(self::$_ROOT.DS.$key);
            $handle = fopen(self::$_ROOT.DS.$key,'w+');
            fwrite($handle,file_get_contents($source_file.DS.$value));
            fclose($handle);
        }else {
            $handle = fopen(self::$_ROOT.DS.$key,'w+');
            fwrite($handle,file_get_contents($source_file.DS.$value));
            fclose($handle);
        }
    }
}
}
