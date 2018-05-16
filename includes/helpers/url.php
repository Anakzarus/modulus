<?php
class url extends controller{
	function __construct(){
		$this->allow(func_get_args());		

		$req = $this->true_path($_SERVER['CONTEXT_DOCUMENT_ROOT'] .  $_SERVER['REQUEST_URI']);
		$cwd = $this->true_path(getcwd());
		$pat = $this->uintersect($req, $cwd);
		$this->cango = $this->is_allowed($pat);
		$this->paths = $pat;
		$this->cango = $this->realy_cango();
	}
	public function allow($paths){
		$this->allweds_strings = $paths;
		foreach ($paths as $key => $path) {
			$paths[$key] = $this->true_path($path);
		}
		$this->index = $paths[0];
		$this->alloweds = $paths;
	}
	public function is_allowed($path){
		$ret = 0;
		foreach ($this->alloweds as $key => $value) {
			if($value == $path){
				$ret = 1;
				$this->path = $this->allweds_strings[$key];
			}
		}
		return $ret;
	}
	public function realy_cango(){
		if($this->cango){
			$filename = auto_load_path . $this->to_path($this->paths).auto_load_extention;
			echo $filename;
			return file_exists($filename);
		}
		return $this->cango;
	}
	public function prevent(){
		$index = 'location: ' . $this->to_path($this->index);
		$pages = func_get_args();
		foreach ($pages as $key => &$page) {
			$page = $this->true_path($page);
			if($this->paths == $page){
				header($index);
			}
		}
		return $this;
	}
	public function running($callback){
		if($this->cango){
			$callback($this->path, $this->paths);
		}
		return $this;
	}
	public function fail($callback){
		if(!$this->cango){
			$callback();
		}
		return $this;
	}
}
?>