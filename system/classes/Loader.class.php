<?php
	/**
	* 
	*/
	class Loader extends Url{
		private $controller;
		function __construct() {
			parent::__construct(...func_get_args());
			$controller = $this->generate_path_string(1) . CONTROLLER_SUFIX;
			$this->controller = new $controller;
		}

		public function generate_path_string($int = null){
			if($int === null){
				$int = $this->how_deep_is_ur_love;
			}
			$ret = "";
			foreach ($this->paths as $key => $value) {
				if($key > $int){
					$value = ucfirst($value);
				} elseif ($key > 0){
					$ret .= '_';
				}
				$ret .= $value;
			}
			return $ret;
		}
	}
?>