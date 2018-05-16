<?php

define('HELPERS', 'controller|url|db');
function is_helper(){return in_array($className, explode('|', HELPERS));}
define('helper_path', 'system/helpers/');
define('helper_extention', '.class.php');

define('auto_load_path', 'includes/');
define('auto_load_extention', '.php');

define('style_path', 'resources/css/');
define('style_extention', '.css');

define('script_path', 'resources/js/');
define('script_extention', '.js');


?>