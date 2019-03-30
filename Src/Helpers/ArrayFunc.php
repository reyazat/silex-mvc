<?php
namespace Helper;

class ArrayFunc{
	
	// explode from multi delimiter
	public function explodeX( $delimiters, $string ){
    	return explode( chr( 1 ), str_replace( $delimiters, chr( 1 ), $string ) );
	}
	
	public function isArray($data){
		
		if (is_array($data)){
			return true;
		}else{
			return false;
		}
		
	}
	
	public function isSetKey($key , $array){
		
		return (bool) array_key_exists( $key , $array );
		
	}
	
	// usage in fetch from data base
	public function getSpeceficKey($data,$key,$method){
		$res = array();
		foreach($data as $row){
			$res[] = $row[$key];
		}

		if($method == 'array'){
			return $res;
		}
		else{
			return implode(',',$res);
		}
	}
	
	public function arrayplus( $arr1 = array(), $arr2 = array() ){
		
		$out = array();
		$arr1 = array_filter($arr1);
		$arr2 = array_filter($arr2);
		if(!empty($arr1) && !empty($arr2)) $out = array_merge($arr1, $arr2);
		else if(empty($arr1) && !empty($arr2)) $out = $arr2;
		else if(!empty($arr1) && empty($arr2)) $out = $arr1;
		$out = array_unique($out);
		return $out;
		
	}
	
	public function arrayminus($arr1 = [],$arr2 = []){
		
		$out = [];
		$arr1 = array_filter($arr1);
		$arr2 = array_filter($arr2);
		$out = array_diff($arr1, $arr2);
		$out = array_unique($out);
		
		return array_filter($out);
		
	}
	
	public function sortMultiDimensionalArr($arr,$sortField){
		
		usort($arr, function($a, $b) {
			return $a['order'] - $b['order'];
		});
		
		return $arr;
		
	}
	
	public function array_find_deep($array, $search,$keyIdentify, $keys = array()){
		
		foreach($array as $key => $value) {
			if (is_array($value)) {
				$sub = self::array_find_deep($value, $search, array_merge($keys, array($key)));
				if (count($sub)) {
					return $sub;
				}
			} elseif ($value === $search && $key == $keyIdentify) {
				return array_merge($keys, array($key));
			}
		}

		return array();
		
	}
	
}