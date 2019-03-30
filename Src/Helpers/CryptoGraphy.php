<?php
namespace Helper;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Hashids\Hashids;

class CryptoGraphy{
	
	public function __construct() {
       	
		if (!function_exists("openssl_encrypt")) {
			dumper("openssl function openssl_encrypt does not exist");
		}
		if (!function_exists("hash")) {
			dumper("function hash does not exist");
		}
	}
	
	public function hashEncode($q , $key='asdfghjkl' , $length=8){
		
		$hashids = new Hashids($key , $length);
		return $hashids->encode($q); 
	}
	public function hashDecode($q , $key='asdfghjkl' , $length=8){
		
		$hashids = new Hashids($key , $length);
		return $hashids->decode($q); 
	}
	public function urlsafe_b64encode($string) {
		$data = base64_encode($string);
		$data = str_replace(array('+','/','='),array('-','_',''),$data);
		return $data;
	}

	public function urlsafe_b64decode($string) {
		$data = str_replace(array('-','_'),array('+','/'),$string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}
	
	
	public function randomPassword($length = 8) {
		
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@!$-';
		$pass = array();
		$alphaLength = strlen($alphabet) - 1; 
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		//turn the array into a string and encrypt it
		return implode($pass); 
	}
	
	public function createUUID($v = 1,$name = 'php.net'){
		
		$payLoad = [];
		try {
			
			if($v == 1){
				
				// Generate a version 1 (time-based) UUID object
				$uuid1 = Uuid::uuid1();
				$payLoad = ['status'=>'success','uuid'=>$uuid1->toString()]; // i.e. e4eaaaf2-d142-11e1-b3e4-080027620cdd
				
			}else if($v == 3){
				
				// Generate a version 3 (name-based and hashed with MD5) UUID object
				$uuid3 = Uuid::uuid3(Uuid::NAMESPACE_DNS, $name);
				$payLoad = ['status'=>'success','uuid'=>$uuid3->toString()]; // i.e. 11a38b9a-b3da-360f-9353-a5a725514269
				
			}else if($v == 4){
				
				// Generate a version 4 (random) UUID object
				$uuid4 = Uuid::uuid4();
				$payLoad = ['status'=>'success','uuid'=>$uuid4->toString()]; // i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
				
			}else if($v == 5){
				
				// Generate a version 5 (name-based and hashed with SHA1) UUID object
				$uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, $name);
				$payLoad = ['status'=>'success','uuid'=>$uuid5->toString()]; // i.e. c4a760a8-dbcf-5254-a0d9-6a4474bd1b62
				
			}


		} catch (UnsatisfiedDependencyException $e) {

			// Some dependency was not met. Either the method cannot be called on a
			// 32-bit system, or it can, but it relies on Moontoast\Math to be present.
			$payLoad = ['status'=>'error','message'=>$e->getMessage()];

		}
		
		return $payLoad;
		
	}
	
}