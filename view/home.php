<?php
	/**
	* 
	*/
	class homeView extends View {
		function __construct() {
			parent::__construct(array(
				'lang' => 'pt-br',
				'title' => 'Homenzinho',
				'viewport' => 'width=device-width, initial-scale=1.0',
				'stylesheets' => array('reset')
			));
		}
	}	
?>