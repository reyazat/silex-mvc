<?php
namespace Helper\Permissions;
use Symfony\Component\HttpFoundation\JsonResponse;


class Permissions{
	
	protected $app;
	
	public function __construct($app) {
		
		$this->app = $app;
		
	}
	
	public function init(){
	
		$clientIp = $this->app['request_content']->getClientIp();
		$access = false;
		$route = $this->app['request_content']->getPathInfo();
		$route = $this->app['helper']('Utility')->trm($route);
		$anonymousRoute = $this->app['config']['anonymousRoute'];
		
		foreach($this->app['config']['anonymousUrlContain'] as $row){
			if (!preg_match($row, $route)){
				continue;
			}else{
				$access = true;
			}
		}
		
		if (!in_array($route, $anonymousRoute) || $access !==false){

			return $this->checkCredentials();

		}else{

			return true;
		}

	}
	
	public function checkCredentials(){
				
	}
}
