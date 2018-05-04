<?php
	require_once('system/config.php');

	//Class auto upload depending on its names
	spl_autoload_register(function($class_name){

		$last_name = $class_name;
		
		if (strpos($class_name,'\\')!==false){
			$names = explode('\\', $class_name);
			$last_name = end($names);
			$class_name = str_replace('\\', DIRECTORY_SEPARATOR , $class_name);
			if(!verify_sufix($last_name)){
				require_once($class_name.'.php');
				return;
			}
		}


		//System classes
		require_once(SYSTEM_PATH . $last_name . SYSTEM_EXTENTION);
	});

	function verify_sufix($name){

		$sufixes = array(CONTROLLER_SUFIX, MODEL_SUFIX, VIEW_SUFIX);
		$return = false;
		foreach ($sufixes as $sufix) {
			if($name == $sufix){
				return true;
			}
		}
		return false;
	}
?>