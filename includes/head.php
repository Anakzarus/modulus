<?php 
class head extends controller{
	function __construct(){
		$this->html(func_get_args());
	}
	public function html($args = array()){
		$default = array(
			'title' => 'title',
			'styles' => array(),
			'scripts' => array()
		);
		$data = $this->args2data($args);
		$data = $this->true_merge($default, $data);
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0" />
				<meta charset="utf-8" />
				<?php $this->SEO() ?>
				<title><?= $data['title'] ?></title>
				<?php
					foreach ($data['styles'] as $style) {
						?>
							<link rel="stylesheet" type="text/css" href="<?=style_path.$style.style_extention?>">
						<?php
					}
				?>
				<?php
					foreach ($data['scripts'] as $script) {
						?>
							<script type="text/javascript" src="<?=script_path.$script.script_extention?>"></script>
						<?php
					}
				?>
			</head>
			<body>
		<?php
	}
	public function SEO(){
		// metas SEO
	}
}
?>