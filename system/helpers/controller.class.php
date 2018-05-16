<?php
class controller{
	public function args2data($args = array()){
		$data = array();
		foreach ($args as $arg) {
			$val = explode('>', $arg);
			$len = count($val);
			if($len == 2){
				$key = $val[0];
				$arr = explode(",", $val[1]);
				$len = count($arr);
				if($len == 1){
					$data[$key] = $val[1];
				} else {
					$data[$key] = $arr;
				}
			} elseif($len) {
				$data[] = $val[0];
			}
		}
		return $data;
	}
	public function true_merge(){
		$arrays = func_get_args();
		$return = array_shift($arrays);
		foreach ($arrays as $array) {
			foreach ($return as $key => $value) {
				if(is_array($value) && 
					(
						!in_array($key, array_keys(array_intersect_key($return, $array))) || 
						!is_array($array[$key]
					)
				)){
					$array[$key] = array();
				}
			}
			$return = array_merge($return, $array);
		}
		return  $return;
	}
	public function uintersect(){
		$arrays = func_get_args();
		$lens = array();
		foreach ($arrays as $array) {
			$lens[] = count($array);
		}
		$min = 0;
		$max = 0;
		for($key = $min + 1; $key < count($lens); $key++) {
			if($lens[$min] > $lens[$key]){
				$min = $key;
			}
			if($lens[$max] < $lens[$key]){
				$max = $key;
			}
		}
		$ret = $arrays[$max];
		foreach ($arrays[$min] as $key => $value) {
			$vamve = true;
			foreach ($arrays as $array) {
				if($array[$key] !== $value){
					$vamve = false;
				}
			}
			if($vamve === true){
				array_shift($ret);
			} else {
				return $ret;
			}
		}
		return $ret;
	}
	public function true_path($string){
		return preg_split("/\\\|\//", $string);
	}
	public function to_path($array){
		return implode("/", $array);
	}
}
?>