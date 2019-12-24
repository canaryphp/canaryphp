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
class Element{
/**
 *
 * Element directory
 *
 * @param (string)
 *
 */
private $elementDir;
/**
 *
 * construct
 *
 */
public function __construct($elementDir = ''){
    if(empty($elementDir)){
        $elementDir = APP.DS.'template'.DS.cp_config('template').DS.'element';
    }
    $this->elementDir = $elementDir;
}
/**
 *
 * Get element template
 *
 * @param (string) : $name = element name , $content = element content
 *
 * @return (string) : the element with content
 *
 */
public function get($name,$content = ''){
    $template_content = file_get_contents($this->elementDir.DS.$name.'.php');
    return str_replace('{CONTENT}',$content,$template_content.EOL);
}
}
