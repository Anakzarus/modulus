<?php 
$GLOBALS['JS::bding'] = false;
class JS
{
	static function log(){
		$params = func_get_args();
		echo "<!-- JS::log -->";
		echo "<script>console.log(";
		foreach ($params as $key => $value) {
			if($key > 0){
				echo ",";
			}
			echo "JSON.stringify(";
			if (!$GLOBALS['JS::bding']){
				echo json_encode($value);
			} else {
				echo $value;
			}
			echo ")";
		}
		echo ")</script>";
	}
	static function error(){
		$params = func_get_args();
		echo "<!-- JS::error -->";
		echo "<script>console.error(";
		foreach ($params as $key => $value) {
			if($key > 0){
				echo ",";
			}
			echo "JSON.stringify";
			echo "(";
			if (!$GLOBALS['JS::bding']){
				echo json_encode($value);
			} else {
				echo $value;
			}
			echo ")";
		}
		echo ");</script>";
	}
	static function bind($meth, $arr){
		$func  = "JS::" . $meth . "(";
		foreach($arr as $key => $val){
			if($key > 0){
				$func .= ", ";
			}
			$func .= "\"";
			$func .= json_encode($val);
			$func .= "\"";
		}
		$func .= ");";
		$GLOBALS['JS::bding'] = true;
		eval($func);
		$GLOBALS['JS::bding'] = false;
	}
}
?>