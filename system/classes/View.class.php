<?php
	/**
	* 
	*/
	class View {
		public $pre; //predefinitions
		public $lang;
		public $title;
		public $scripts;
		public $viewport;
		public $stylesheets;
		public function header(){
			?>
				<!DOCTYPE html>
				<html>
				<head>
					<?php
						if (is_string($this->viewport) && $this->viewport !== null) {
							?>
								<meta name="viewport" content="<?= $this->viewport ?>" />
							<?php
						}
					?>
					<title><?= $this->pre['title'] ?></title>
					<?php
						$this->include_scripts();
						$this->include_styleheets();
					?>
				</head>
			<?php
		}

		function __construct($specs) {
			$this->pre = array(
				'lang' => null,
				'title' => 'Welcome',
				'scripts' => array(),
				'viewport' => 'width-device=width, initial-scale=1.0',
				'stylesheets' => array()
			);
			$this->pre = array_merge($this->pre, $specs);
			$this->store();
			$this->header();
		}

		public function store(){
			foreach ($this->pre as $attr => $value) {
				$this->$attr = $value;
			}
		}

		public function include_scripts(){
			foreach ($this->scripts as $filename) {
				$filename = SCRIPTS_PATH . $filename . SCRIPTS_EXTENTION;
				if (file_exists($filename)) {
					?>
						<script type="text/javascript" src="<?= $filename?>" ></script>
					<?php
				}
			}
		}

		public function include_styleheets(){
			foreach ($this->stylesheets as $filename) {
				$filename = STYLESHEETS_PATH . $filename . STYLESHEETS_EXTENTION;
				?>
					<link rel="stylesheet" type="text/css" href="<?= $filename ?>" />
				<?php
			}
		}
	}
?>