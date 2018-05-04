<?php
namespace controller;
	/**
	* 
	*/
	class home extends Controller {
		function __construct($query = array()) {
			$this->actions($query);
			$html = new \view\home();
		}
	}
?>