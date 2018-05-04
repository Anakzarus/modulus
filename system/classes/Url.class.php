<?php
	/**
	* 
	*/
	class Url {

		public $mask;
		public $index;
		public $paths;
		public $allowed;
		public $how_deep;
		public $connection_aborted;

		function __construct() {
			$this->connection_aborted = false;
			$this->how_deep = 0;
			
			$hostpath = $_SERVER['DOCUMENT_ROOT'];
			$fullpath = str_replace("\\", "/", getcwd());
			if(strpos($fullpath, $hostpath) != 0){
				echo "[0001]";
				exit();
			}
			$this->index = substr($fullpath, (strlen($hostpath) - strlen($fullpath)));
			$this->mask = substr($_SERVER['REQUEST_URI'], strlen($this->index) - strlen($_SERVER['REQUEST_URI']));
			$this->removeLimitBars();
			$this->explodeBars();

			$pages = func_get_args();
			if(count($pages) <3){
				echo "[0002]";
				exit();
			}
			$this->allow_paths($pages)->but_if_realocate($pages[0], $pages[1])->but_error_realocate($pages[2]);
		}

		public function allow_paths() {
			$this->allowed = func_get_args();
			if(count($this->allowed) == 1 && is_array($this->allowed[0])){
				$this->allowed = $this->allowed[0];
			} else {
				$this->connection_aborted = true;
			}
			if(!$this->is_allowed($this->mask)){
				$this->connection_aborted = true;
			}
			return $this;
		}

		public function but_if_realocate($wrong, $right){
			if(!$this->connection_aborted){
				if($this->mask == $wrong){
					$this->realocate($right);
				}
			}
			return $this;
		}

		public function but_error_realocate($page){
			if($this->connection_aborted){
				$this->realocate($page);
			} 
			return $this;
		}
		public function realocate($page){
			$page = $this->host . $this->index . '/' . $page;
			header('location: ' . $page);
		}

		public function removeLimitBarsGeneric ($string) {
			if($string == "/" || $string == "//"){
				return "";
			}
			if (substr($string, 0, 1) === "/") {
				$len = strlen($string);
				$string = substr($string, 1, $len - 1);
			}
			if (substr($string, -1) === "/") {
				$len = strlen($string);
				$string = substr($string, 0, $len - 1);
			}
			return $string;
		}
		public function removeLimitBars($mask = null) {
			if($mask != null && is_string($mask)){
				return $this->removeLimitBarsGeneric($mask);
			} elseif ($mask == null && is_string($this->mask)){
				$this->mask = $this->removeLimitBarsGeneric($this->mask);
			}
		}

		public function explodeBarsGeneric($string) {
			$this->removeLimitBars($string);
			return explode("/", $string);
		}

		public function explodeBars($mask = null) {
			if($mask != null && is_string($mask)){
				return $this->explodeBarsGeneric($mask);
			} elseif ($mask == null && is_string($this->mask)){
				$this->paths = $this->explodeBarsGeneric($this->mask);
			}
		}

		public function is_allowed($string){
			if (in_array($string, $this->allowed)) {
				return true;
			} return false;
		}

		public function gerate_path_string($int = null){
			if($int == null){
				$int = $this->how_deep;
			}
			$ret = "";
			foreach ($this->paths as $key => $value) {
				if($key > 0){
					if($key < $int){
						$ret .= "/";
					} else {
						$ret .= "_";
					}
				}
				$ret .= $value;
			}
			return $ret . ".php";
		}
	}
?>