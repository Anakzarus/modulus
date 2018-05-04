<?php
namespace controller;
	/**
	* 
	*/
	class Controller {
		public $query;
		function __construct() {
			# code...
		}
		public function actions($query){
			var_dump($query);
			$this->query = $query;
		}
	}
?>