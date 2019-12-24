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
require __DIR__.DIRECTORY_SEPARATOR.'constants'.DIRECTORY_SEPARATOR.'constants.php';
//check CanaryPHPTools\Canary class if exist
if (!class_exists('\\CanaryPHPTools\\Canary')) {
    exit('<b>(CanaryPHP "'.CP_VERSION.'") : </b>The class \CanaryPHPTools\Canary Required , install from github : https://github.com/canaryphp/canaryphptools');
}
$_AUTOLOADER = [
			'functions'=>[
						'pass',
						'get',
					],
];
foreach($_AUTOLOADER as $keys=>$values){
	foreach($values as $value){
		require CP_ROOT.DS.$keys.DS.$value.'.php';
	}
}
