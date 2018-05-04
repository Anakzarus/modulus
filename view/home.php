<?php
namespace view;
	/**
	* 
	*/
	class home extends View {
		public $data;
		function __construct() {
			$this->data = func_get_args();
			parent::__construct(array(
				'lang' => 'pt-br',
				'title' => 'Homenzinho',
				'viewport' => 'width=device-width, initial-scale=1.0',
				'stylesheets' => array('reset')
			));
		}

		public function body(){
			?>
				<form method="get">
					<input type="text" name="name">
					<input type="password" name="pass">
					<input type="submit" value="Enviar">
				</form>
			<?php
		}
	}	
?>