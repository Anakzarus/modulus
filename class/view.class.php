<?php 

class VIEW
{
	private $viewUse;
	private $usageDidntDefined;
	private $allowedUsages;
	private $url;
	public $usage;
	
	function __construct()
	{
		$this->usageDidntDefined = true;
		$this->allowedUsages = array(
			'paths',
			'achives',
			'deepable'
		);
		$this->url = array();
	}

	function __set($name, $value){
		switch ($name) {
			case 'viewUse':
				if($this->verifyUsage($value['usage'])){
					$this->usage = $value['usage'];
					$this->url = $value['url'];
				}
				break;
		}
	}
	private function verifyUsage($newUsage){
		foreach($this->allowedUsages : $allowedUsage){
			if($newUsage == $allowedUsage){
				return true;
			}
		}
		return false;
	}
}

?>