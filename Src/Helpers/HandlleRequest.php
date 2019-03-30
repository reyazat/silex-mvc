<?php
namespace Helper;

use \Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;
use bandwidthThrottle\tokenBucket\BlockingConsumer;

class HandlleRequest{
	protected $app;
	
	public function __construct(Application $app){
		$this->app = $app;
		
    }
	public function returnResult($url,$method = 'GET',$data){

		$data = ($this->app['helper']('Utility')->notEmpty($data))?$data:[];
		
		$subRequest = Request::create($url,$method,$data);
		$response = $this->app->handle($subRequest, HttpKernelInterface::MASTER_REQUEST, false);
		
		return $response;

	}
	
	public function requestLimit(){

		$storage = new FileStorage($this->app['config']['cache_dir'].'/'.$this->app['session']->getId().".bucket");
		
		$rate    = new Rate(10, Rate::SECOND);
		
		$bucket  = new TokenBucket(1, $rate, $storage);
		
		$consumer = new BlockingConsumer($bucket);

		$bucket->bootstrap(1);

		// This will block until one token is available.
		$consumer->consume(1);
	}
	
}