<?php
	require_once('system/config.php');

	//Class auto upload depending on its names
	spl_autoload_register(function($class_name){
		$call_system = true;
		
		$sufixes = array(
			CONTROLLER_PATH => CONTROLLER_SUFIX, 
			MODEL_PATH	 	=> MODEL_SUFIX, 
			VIEW_PATH 		=> VIEW_SUFIX
		);

		/*Dinamical classes
		 *It test the sufix of the class name 
		 */
		foreach ($sufixes as $path => $sufix) {
			
			if(verify_sufix($class_name, $sufix)){
				
				$class_path = $path . morph($class_name, $sufix) . EXTENTION;
				prepare_file($class_path);
				
				$call_system = false;
			} 
		}




		//System classes
		if ($call_system) {
			prepare_file(SYSTEM_PATH . $class_name . SYSTEM_EXTENTION);
		}
	});

	function verify_sufix($name, $sufix){
		return (strpos($name, $sufix) !== false && strlen($name) > strlen($sufix));
	}
	function morph($name, $sufix){
		//removing sufix
		$string = substr($name, 0, -strlen($sufix));
		//trasnforming underline to bar
		$string = str_replace("_", "/", $string);
		return $string;
	}
	function prepare_file($filename){
		if (file_exists($filename)) {
			require_once($filename);
		}
	}
?>