<?php
/**
 * this function get data from view
 *
 * @param = $name data name (defined Advance)
 *
**/
function get($path){
if($path) {
	$CONFIG = (isset($GLOBALS['msg'])) ? $GLOBALS['msg'] : [];
	$path_a = explode('.', $path);
		foreach($path_a as $p) {
			if(isset($CONFIG[$p])) {
				$CONFIG = $CONFIG[$p];
			}else{
				$CONFIG = "Undefined : '{$path}'";
			}
		}
	return $CONFIG;

}
	return FALSE;
}