<?php
	(new url(
		'home',
		'home\teste',
		'home\teste\asda'
	))->prevent(
		'',
		'index',
		'index.php',
		'index.html'
	)->running(function($path, $paths){
		new head(
			'title>'.end($paths),
			'styles>reset'
		);
		new $path();
		new foot();
	})->fail(function(){
		new err();
	});
?>