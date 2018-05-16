<?php

$deepability = 0;
$start = 1;
$home = "blog/home";
$route = $_SERVER['REQUEST_URI'];
$len = strlen($route);
if($len === 0){
	header("location: " . $home);
} elseif (substr($route, 0, 1) === "/") {
	$route = substr($route, 1, $len - 1);
	$len = strlen($route);
}
if($len === 0){
	header("location: " . $home);
} elseif (substr($route, -1) === "/") {
	$route = substr($route, 0, $len - 1);
}
$array = explode("/", $route);
$array = array_slice($array, $start);
if(count($array) <= 0){
	header("location: " . $home);
}
$archive = "";
foreach ($array as $key => $value) {
	if(strlen($value) <= 0){
		header("location: " . $home);
	} else {
		if($key > 0){
			if($key > $deepability){
				$archive .= "_";
			} else {
				$archive .= "/";
			}
		}
		$archive .= $value;	
	}
}
$archive .= ".php";
$data = array();
include "controller/" . $archive;
include "model/" . $archive;
include "view/" . $archive;

?>