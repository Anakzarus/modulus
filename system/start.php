<?php
	require_once('system/config.php');

	spl_autoload_register(function($className){
		if(is_helper()){
			require_once(helper_path.$className.helper_extention);
		} else {
			require_once(auto_load_path.$className.auto_load_extention);
		}
	});
	
	require_once('system/index.php');
?>