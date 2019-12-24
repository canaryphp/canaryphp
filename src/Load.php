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
class Load{
public function __construct(){
	//CanaryPHPTools class
	self::$canary = new \CanaryPHPTools\Canary;
	//Array translate
	self::$tr = new \CanaryPHPTools\ArrayTranslate(dirname(__DIR__).DS.'locale');
}
/**
 *
 * External objects
 *
 */
private static $canary,$tr;
/**
 *
 * Load defaults
 *
 * @param $template_name (string) template name
 *
**/
public static function default_get($file_name,$template_name = null){
    try {
		//Check $template_name if null
        $template_name = ($template_name !== null)? $template_name : cp_config('template') ;
		//default path
		$default_path = win_path(APP.DS.'template'.DS.$template_name.DS.$file_name);
		//check default file
        if(file_exists($default_path)){
            return require($default_path);
        }else{
			//Exception
            throw new \CanaryPHPTools\Exception('Default template file dosn\'t exist : '.$default_path);
        }
    }catch(\CanaryPHPTools\Exception $e){
        echo '<b>Exception :</b>'.$e->msg();
    }
    return '';
}
/**
 *
 * get defaults path
 *
 * @param $template_name (string) template name
 *
**/
public static function default_get_path($file_name,$template_name = null){
	global $canaryphp;
	global $canaryphptools;
    try {
		//Check $template_name if null
        $template_name = ($template_name !== null)? $template_name : cp_config('template') ;
		//default path
		$default_path = win_path(APP.DS.'template'.DS.$template_name.DS.$file_name);
		//check default file
		if(file_exists($default_path)){
            return $default_path;
        }else{
            throw new \CanaryPHPTools\Exception('Default template file dosn\'t exist : '.$default_path);
        }
    }catch(\CanaryPHPTools\Exception $e){
		//Exception
        echo '<b>Exception :</b>'.$e->msg();
    }
    return '';
}
/**
 *
 * set or remove data global config array
 *
 * @param $name (string) , $value (string)
 *
**/
public static function add($to,$name,$value){
	$GLOBALS['CP_CONFIG'][$to][$name] = $value;
}
public static function remove($to,$name){
	unset($GLOBALS['CP_CONFIG'][$to][$name]);
}
/**
 *
 * Load view file
 *
 * @param $file (string) : load another view
 *
 */
private static function view($file = null){
global $canaryphp;
global $canaryphptools;
//Get view file path
if ($file == null){
	$file = explode('webroot',$_SERVER['PHP_SELF']);
	$file = end($file);
	$view_path = win_path(APP.DS.'template'.DS.cp_config('template').DS.'view'.$file);
}else{
	$view_path = win_path(APP.DS.'template'.DS.cp_config('template').DS.$file);
}
//view header path
	$view_header_path = win_path(self::default_get_path('pages'.DS.'header.php'));
//view footer path
    $view_footer_path = win_path(self::default_get_path('pages'.DS.'footer.php'));
//if view exist
	if(file_exists($view_path)){
		//if header exixt
		if(file_exists($view_header_path)){
			require $view_header_path;
		}
			require $view_path;
		//if footer exist
		if(file_exists($view_footer_path)){
			require $view_footer_path;
		}
	}else{
		//if view dosn't exist
		self::$tr = new \CanaryPHPTools\ArrayTranslate(dirname(__DIR__).DS.'locale');
		echo sprintf('<br><center><h1>%s : %s <br> %s : %s</h1></center<br>',self::$tr->_a('UNDEFINED_VIEW'),$file,self::$tr->_a('TRY_TO'),$view_path);
	}
	ob_end_flush();
}
private static function controller(){
	global $canaryphp;
	global $canaryphptools;
	//controller file name
	$file = explode('webroot',$_SERVER['PHP_SELF']);
	$file = end($file);
    $file = explode('.php',$file);
	$file = $file[0].'Controller.php';
	//controller path
	$controller_path = win_path(APP.DS.'controller'.$file);
	//if controller exist
    if(file_exists($controller_path)){
		require $controller_path;
	}else{
	//if controller dosnt exist
		self::$tr = new \CanaryPHPTools\ArrayTranslate(dirname(__DIR__).DS.'locale');
		echo sprintf('<br><center><h1>%s<br>%s : %s</h1></center><br>',self::$tr->_a('UNDEFINED_CONTROLLER'),self::$tr->_a('TRY_TO'),$controller_path);
	}
}
public static function content($file = ''){
	if (empty($file)) {
		self::controller();
		self::view();
	} else {
		self::view($file);
	}
}
/**
 *
 * assign($type);
 *
 * @param (string) $type : (css|cssrtl|js|jsrtl|bottomjs) ,$value (string) used only with (title|decription)
 *
**/
public static function assign($type){
	global $canaryphp;
	global $canaryphptools;
	$lang = mb_substr(self::$canary->language(),0, 2);
	switch($type){
		case 'title':
			$title = (get($type) !== "Undefined : 'title'") ? cp_config('site.name').' | '.get($type) : cp_config('site.name');
			echo EOL.'	<title>'.$title.'</title>'.EOL;
		break;
		case 'description':
			$description = (get($type) !== "Undefined : 'description'") ? get($type) : cp_config('site.description');
			echo EOL.'	<meta name="description" content="'.$description.'" />'.EOL;
		break;
		case 'css':
			if(in_array($lang,cp_config('rtl_languages'))){
				foreach(cp_config('cssrtl') as $key=>$value){
					if(file_exists(win_path(WEBROOT.CSS.DS.$value))){
						echo EOL.'<!-- '.$key.' -->'.EOL;
						echo '	<link rel="stylesheet" href="'.win_path(ROOT_HTML.CSS.DS.$value,TRUE).'">'.EOL;
					}else{
						echo EOL.'<!-- '.$key.' -->'.EOL;
						echo '	<link rel="stylesheet" href="'.$value.'">'.EOL;
					}
				}
			}else{
				foreach(cp_config('css') as $key=>$value){
					if(file_exists(win_path(WEBROOT.CSS.DS.$value))){
						echo EOL.'<!-- '.$key.' -->'.EOL;
						echo '	<link rel="stylesheet" href="'.win_path(ROOT_HTML.CSS.DS.$value,TRUE).'">'.EOL;
					}else{
						echo EOL.'<!-- '.$key.' -->'.EOL;
						echo  '	<link rel="stylesheet" href="'.$value.'">'.EOL;
					}
				}
			}
		break;
		case 'js':
			if(in_array($lang,cp_config('rtl_languages'))){
				foreach(cp_config('jsrtl') as $key=>$value){
					if(file_exists(win_path(WEBROOT.JS.DS.$value))){
						echo EOL.'<!-- '.$key.' -->'.EOL;
						echo '	<script src="'.win_path(ROOT_HTML.JS.DS.$value,TRUE).'"></script>'.EOL;
					}else{
						echo EOL.'<!-- '.$key.' -->'.EOL;
						echo '	<script src="'.$value.'"></script>'.EOL;
					}
				}
			}else{
				foreach(cp_config('js') as $key=>$value){
					if(file_exists(win_path(WEBROOT.JS.DS.$value))){
							echo EOL.'<!-- '.$key.' -->'.EOL;
							echo '	<script src="'.win_path(ROOT_HTML.JS.DS.$value,TRUE).'"></script>'.EOL;
					}else{
							echo EOL.'<!-- '.$key.' -->'.EOL;
							echo '	<script src="'.$value.'"></script>'.EOL;
					}
				}
			}
		break;
		case 'bottomjs';
			foreach(cp_config('bottomjs') as $key=>$value){
				if(file_exists(win_path(WEBROOT.JS.DS.$value))){
					echo EOL.'<!-- '.$key.' -->'.EOL;
					echo '	<script src="'.win_path(ROOT_HTML.JS.DS.$value,TRUE).'"></script>'.EOL;
				}else{
					echo EOL.'<!-- '.$key.' -->'.EOL;
					echo '	<script src="'.$value.'"></script>'.EOL;
				}
			}
		break;
		default:
			echo EOL.'<!-- '.self::$tr->_a('ERROR_FILES').' : '.$type.'-->'.EOL;
	}
}
public function __destruct(){

}
}
