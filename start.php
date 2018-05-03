<?php 
	$p = 'class/modulus.class.php';
	require_once($p);
	$site = new Modulus();
	$site->index = "/modulus";
	$site->home = "/home";
	$site->allowPaths = array('/home');

	$site->use = 'paths';

	$site->run();	
	// $site->viewUse = 'achives';
	// $site->viewUse = 'deepable';

	/*
	
	$site->viewUse
	==============

	How you programmer need to use the view archive.
	(String)Values:
		* archives => 	You need a path on your rout named 'view'
						Then it will look for allowed paths and
						require they with "_" instead of "/"
		
		* paths =>		You need a path on your rout named 'view'
						Then it will look for allowed paths and
						if existis in array it will just add .php
						and require it

		* deepable => 	Its a trick one an I am developing
						I will show you with an example:
							You have to allow paths always
							using this code:
								
								$site->allowPaths = array('/home', '/home/test');
							
							Then you have to create those paths 
							in your project, like this:
								
								view
								 |__home
									 |__test

							And each one needs an code.php archive in.
						Uff! I hope you understud
	*/

?>