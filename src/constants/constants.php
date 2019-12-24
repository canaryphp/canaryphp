<?php
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
defined('CP_ROOT') OR define('CP_ROOT',dirname(__DIR__));
/**
 *
 * HOST hostname (domainname)
 *
 */
defined('HOST') OR define('HOST',$_SERVER['HTTP_HOST']);
/**
 *
 *  LOG logs base url
 *
 */
defined('CP_LOG') OR define('CP_LOG',dirname(CP_ROOT).DS.'logs');
/**
 *
 * LOCALE locale base url (translation)
 *
 */
defined('CP_LOCALE') OR define('CP_LOCALE',dirname(CP_ROOT).DS.'locale');
/**
 *
 *  Default time zone
 *
 */
defined('CP_DEFAULT_TIME_ZONE') OR define('CP_DEFAULT_TIME_ZONE','Africa/Algiers');
/**
 *
 * local script version
 *
 */
defined('CP_VERSION') OR define('CP_VERSION',file_get_contents(dirname(CP_ROOT).DS.'VERSION'));