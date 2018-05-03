<?php 

class Modulus
{
	private $U;
	private $V;
	private $M;
	private $L;
	private $C;
	private $J;
	/*U*/
	private $index;
	private $home;
	private $allowPaths;
	/*V*/
	private $viewUse;
	/*M*/
	private $host;
	private $username;
	private $password;
	private $database;

	private function instances(){
		$this->U = new URL();
		$this->V = new VIEW();
		$this->M = new MODEL();
		$this->L = new LANGUAGE();
		$this->C = new CONTROLLER();
	}

	private function requires(){
		require_once("class/url.class.php");
		require_once("class/view.class.php");
		require_once("class/model.class.php");
		require_once("class/language.class.php");
		require_once("class/controller.class.php");
		require_once("class/javascript.class.php");
	}

	public function run(){
		echo "string";
		$this->V->start(array());
	}

	function __construct()
	{
		$this->requires();
		$this->instances();
	}

	function __set($name, $value){
		switch ($name) {

			case 'index':
			case 'home':
			case 'allowPaths':	
				$this->U->$name = $value; 
				break;

			case 'use':
				//var_dump($this->U->sendPublicAtributes('whereIam', 'path'));
				$this->V->$name = array('usage' => $value, 'url' => $this->U->sendPublicAtributes('whereIam', 'path', 'firstPage'));
				break;

			// case 'host':
			// case 'username':
			// case 'password':
			// case 'database': 
			// 	$this->M->$name = $value; 
			// 	break;
			default: break;
		}
	}

	static function error($message, $fontSize = "30px", $jsError = null){ ?>
		<div style="
		position: fixed; 
		top: 0; 
		left: 0; 
		z-index: 99999999999999999999; 
		background: salmon;
		width: 100vw;
		height: 100vh;
		line-height: 100vh;
		text-align: center;
		color: white;
		font-size: <?= $fontSize ?>;
		font-family: monospace;
		" > 
			<?= $message ?> 
		</div>
	<?php 
		if($jsError != null){
			$jsError = func_get_args();
			$jsError = array_slice($jsError, 2);
			JS::bind('error', $jsError);
		}
		exit();
	}
	static function bleh($message, $fontSize = "30px", $jsError = null){ ?>
		<div style="
		position: fixed; 
		top: 0; 
		left: 0; 
		z-index: 99999999999999999999; 
		background: lightgreen;
		width: 100vw;
		height: 100vh;
		line-height: 100vh;
		text-align: center;
		color: green;
		font-size: <?= $fontSize ?>;
		font-family: monospace;
		" > 
			<?= $message ?> 
		</div>
	<?php 
		if($jsError != null){
			$jsError = func_get_args();
			$jsError = array_slice($jsError, 2);
			JS::bind('error', $jsError);
		}
		exit();
	}
}

?>