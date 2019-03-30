<?php
namespace Helper\Permissions;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
class AccessPage{
	
	protected $app;
	
	public function __construct($app) {
		
		$this->app = $app;
		
	}
	
	public function make_logout(){ 
		
	
	}

}