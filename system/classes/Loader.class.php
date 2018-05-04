<?php
	/**
	* 
	*/
	class Loader extends Url{
		private $controller;
		function __construct() {
			parent::__construct(...func_get_args());

			if($this->mask == $this->error){

//             _________________________________________________________
//             \                                                         \
//              \             /\\\         /\\\\\\\               /\\\    \        
//               \           /\\\\\       /\\\/////\\\           /\\\\\    \       
//                \         /\\\/\\\      /\\\    \//\\\        /\\\/\\\    \      
//                 \       /\\\/\/\\\     \/\\\     \/\\\      /\\\/\/\\\    \     
//                  \     /\\\/  \/\\\     \/\\\     \/\\\    /\\\/  \/\\\    \    
//                   \   /\\\\\\\\\\\\\\\\  \/\\\     \/\\\  /\\\\\\\\\\\\\\\\ \   
//                    \  \///////////\\\//   \//\\\    /\\\  \///////////\\\//  \  
//                     \            \/\\\      \///\\\\\\\/             \/\\\    \ 
//                      \            \///         \///////               \///     \
//                       \_________________________________________________________\

				$error = VIEW_NS . "error";
				$this->error = new $error($this->get_query());
			} else {
				$controller = $this->generate_path_string(1);
				$controller = CONTROLLER_NS . $controller;
				$this->controller = new $controller($this->get_query());
			}
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

		public function get_query(){
			return $this->query;
		}
	}
?>