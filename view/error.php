<?php
namespace view;
	/**
	* esse é umcaso em particular tratado o loader
	* não espere que que haja como as outras classes
	*/
	class error extends View{
		function __construct() {
			parent::__construct(array(
				'lang' => 'pt-br',
				'title' => '404 Error',
				'viewport' => 'width=device-width, initial-scale=1.0',
				'stylesheets' => array('error')
			));
		}
		public function body(){
			?>
				<div class="text">
					<div style="font-size: 5em;">404</div>
					<div style="font-size: 1em;">[Page not found]</div>
				</div>
			<?php
		}
	}
?>