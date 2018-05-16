<?php
	require_once('system/config.php');

	spl_autoload_register(function($className){
		if(in_array($className, explode('|', HELPERS))){
			$className = 'helpers/' . $className;
		}
		require_once(auto_load_path.$className.auto_load_extention);
	});
	
	require_once('system/index.php');
?>