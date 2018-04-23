<?php 

class URL
{
	public $path;
	public $zero;
	public $isHttps;
	public $whereIam;
	public $firstPage;
	private $real;
	private $mask;
	private $home;
	private $host;
	private $index;
	private $allowPaths;
	private $didntSetIndex;
	protected $permissions;

	function __construct()
	{
		$this->isHttps = isset($_SERVER['HTTPS']);
		$this->host = (isset($_SERVER['HTTPS']) ? "https" : "http"). "://" . $_SERVER['HTTP_HOST'];
		$this->real = $this->host . $_SERVER['PHP_SELF'];
		$this->mask = $_SERVER['REQUEST_URI'];
		$this->zero = "/";
		$this->path = array();
		$this->firstPage = $this->host . $this->zero;
		$this->didntSetIndex = true;
		$this->getPermissions();
	}

	function __set($name, $value){
		switch ($name) {
			case 'index':
				if(strrpos($this->mask, $value) == 0 && strrpos($this->mask, $value, -1) == 0){
					$this->whereIam = explode($value, $this->mask)[1];
					$this->zero = $value;
					$this->didntSetIndex = false;
					$this->path = explode("/", $this->whereIam);
					array_shift($this->path);
				}
				break;
			case 'home':
				if(!empty($value)){
					$oldPage = $this->firstPage;
					$this->firstPage = $this->host . $this->zero . $value;
					if($this->didntSetIndex){
						Modulus::error('Undefined Index');
					}
					if(count($this->path) == 1 && empty($this->path[0])){
						$this->goHome();
					}
				}
				break;
			case 'allowPaths':
				if(is_array($value)){
					if(!in_array($this->whereIam, $value)){
						Modulus::error(404, '200px');
					}
					// $this->bleh($this->whereIam, "200px");
				} else {
					Modulus::error('Pass an array through allowPaths');
				}
				break;
		}
	}

	public function goHome(){
		header('location: ' . $this->firstPage);
	}
	public function sendPublicAtributes($array){
		$ret = array();
		if (is_string($array)){
			$array = func_get_args();
		} elseif (!is_array($array)) {
			Modulus::error("sendPublicAtributes args: just array or strings");
		}
		foreach ($array as $key => $name) {
			if($this->permissions[$name]){
				$ret[$name] = $this->$name;
			}
		}
		return $ret;
	}

	protected function getPermissions(){
		$reflect = new ReflectionClass($this);
		$props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
		$permissions = array();
		foreach ($props as $key => $value) {
			$this->permissions[$value->name] = true;
		}
	}
}

?>