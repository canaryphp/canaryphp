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
$GLOBALS['CP_CONFIG'] = [];
require_once __DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'requires.php';
$_AUTOLOADER = [
					'class'=>[
						'Load',
						'Element',
						'Canary',
					],
];
/**
 *
 * include core
 *
**/
foreach($_AUTOLOADER as $keys=>$values){
	if ($keys === 'class') {
		foreach($values as $value){
			require CP_ROOT.DS.$value.'.php';
		}
	}else {
		foreach($values as $value){
			require CP_ROOT.DS.$keys.DS.$value.'.php';
		}
	}
}
