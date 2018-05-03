<?php
	/**
	* 
	*/
	class Url {

		public $https;
		public $host;
		public $real;
		public $mask;
		public $index;
		public $paths;
		public $allowed;
		public $how_deep;
		public $connection_aborted;

		function __construct() {
			$this->https = isset($_SERVER['HTTPS']);
			$this->host = (isset($_SERVER['HTTPS']) ? "https" : "http"). "://" . $_SERVER['HTTP_HOST'];
			$this->real = $this->host . $_SERVER['PHP_SELF'];
			$this->mask = $_SERVER['REQUEST_URI'];

			$this->removeLimitBars();
			$this->index = "";

			
			$this->allowed = array();
			$this->paths = array();
			$this->how_deep = 0;
			$this->connection_aborted = false;
		}

		public function define_index($string){
			if(strpos($this->mask, $string) == 0){
				$this->mask = str_replace($string, "", $this->mask);
				$this->removeLimitBars();
				$this->explodeBars();
				$this->index = $string;
			} else {
				return null;
			}
			return $this;
		}

		public function allow_paths() {
			$this->allowed = func_get_args();
			if(!$this->is_allowed($this->mask)){
				$this->connection_aborted = true;
			}
			return $this;
		}

		public function but_if_realocate($wrong, $right){
			if(!$this->connection_aborted){
				if($this->mask == $wrong){
					header('location: ' . $right);
				}
			}
			return $this;
		}

		public function but_error_realocate($page){
			if($this->connection_aborted){
				echo $this->mask;
				$page = $this->host . '/' . $this->index . '/' . $page;
				header('location: ' . $page);
			} 
			return $this;
		}

		public function removeLimitBarsGeneric ($string) {
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

		public function get_path($int = null){
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