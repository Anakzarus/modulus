<?php 

class VIEW
{
	private $use;
	private $usageDidntDefined;
	private $allowedUsages;
	private $url;
	public $usage;
	
	function __construct()
	{
		$this->usageDidntDefined = true;
		$this->allowedUsages = array(
			'paths',
			'achives'
		);
		$this->url = array();
	}

	function __set($name, $value){
		switch ($name) {
			case 'use':
				if($this->verifyUsage($value['usage'])){
					$this->usage = $value['usage'];
					$this->url = $value['url'];
					$this->usageDidntDefined = false;
				}
				break;
		}
	}
	private function verifyUsage($newUsage){
		foreach($this->allowedUsages as $allowedUsage){
			if($newUsage == $allowedUsage){
				return true;
			}
		}
		return false;
	}
	public function start($data){
		if($this->usageDidntDefined) return;
		switch ($this->usage) {
			case 'paths':
				$page = $this->url['firstPage'] . '/view' . $this->url['whereIam'] . '.php';
				echo $page;
				include $page ;
				break;
			case 'archives':
				$page = $this->url['zero'];
				foreach ($this->url as $url) {
					$page .= "_" . $url;
				}
				$page .= ".php";
				include_once $page;
				break;
			default:
				Modulus::error("404");
				break;
		}
	}
}

?>