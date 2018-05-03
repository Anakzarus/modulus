<?php 

require_once('system/start.php'); 

$url = new Url('', 'home', '404');
include 'view/' . $url->gerate_path_string();

?>