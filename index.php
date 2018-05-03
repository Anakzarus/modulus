<?php 

include 'system/start.php'; 

$url = new Url();
$path = $url->define_index('modulus')->allow_paths('', '404', 'home')->but_if_realocate('', 'home')->but_error_realocate('404')->get_path();
include 'view/' . $path;

?>