<?php
/**
 * this function pass data to view
 *
 * @param = $name data name , $value the value
 *
**/
function pass($name,$value = ''){
	$GLOBALS['msg'][$name] = $value;
}