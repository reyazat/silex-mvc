<?php
namespace Models;
use Illuminate\Database\Capsule\Manager as Capsule;

class User extends \Illuminate\Database\Eloquent\Model{
	
	protected $table = 'user';
	
	protected $app;
	public function __construct($app){
		$this->app = $app;
    }
	
	public function existOneRow($where =[] , $select = ['*']){
		$this->app['helper']('ModelLog')->Log();
		
		$res = [];
		if($this->app['helper']('Utility')->notEmpty($where)){

			$row = User::select($select)->where($where)->first();
			
			if($this->app['helper']('Utility')->notEmpty($row)){
				$res =  $row->toArray();
			}
			
		}
		
		return $res;
		
	}
	
	public function returnRows( $where =[] , $select = ['*']){
		
		$this->app['helper']('ModelLog')->Log();
		
		$res = [];
		if($this->app['helper']('Utility')->notEmpty($where)){
			
			$rows = User::select($select)					
							->where($where)
							->get();		

		if($this->app['helper']('Utility')->notEmpty($rows)){
				$res =  $rows->toArray();
			}
			
		}else{
			$rows = User::select($select)					
							->get();		

			if($this->app['helper']('Utility')->notEmpty($rows)){
				$res =  $rows->toArray();
			}
			
		}
		return $res;
	}
	
	public function insert($details){
		
		$this->app['helper']('ModelLog')->Log();
		
		if($this->app['helper']('Utility')->notEmpty($details)){
			
			$saveId = User::insertGetId($details);

			return ['status'=>'success','saveId'=>$saveId];
		}else{
			return ['status'=>'error','message'=>"There is'nt data for insert . "];
		}
		
	}
	
	public function updateRows($update = [] , $where =[]){
		
		$this->app['helper']('ModelLog')->Log();
		
		if($this->app['helper']('Utility')->notEmpty($where) && $this->app['helper']('Utility')->notEmpty($update)){
			
			$rows = User::where($where)
							->update($update);
			return ['status'=>'success'];
		}else{
			return ['status'=>'error','message'=>"There is'nt data for update . "];
		}
		
	}
	
	public function deleteRows($where =[]){
		
		$this->app['helper']('ModelLog')->Log();
	
		return User::where($where)->delete();		
		
	}
	
}