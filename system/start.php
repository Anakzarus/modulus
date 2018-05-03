<?php
	spl_autoload_register(function($className){
		include "system/classes/" . $className . ".class.php";
	});
?>