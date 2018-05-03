<?php
	spl_autoload_register(function($className){
		require_once("system/classes/" . $className . ".class.php");
	});
?>