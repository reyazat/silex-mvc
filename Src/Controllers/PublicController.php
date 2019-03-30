<?php
namespace Controllers;

use \Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Api\ControllerProviderInterface;

class PublicController implements ControllerProviderInterface 
	
{	/**
     * Application
     * 
     * @var Silex\Application 
     */
    protected $app;
	
	public function connect(Application $app){
		$this->app = $app;
				
		$index = $app['controllers_factory'];
		$index->get("/readme",[$this,'readme'])->bind('readme');
		$index->get("/index",[$this,'home']);
		$index->get("/home",[$this,'home']);
				
		return $index;
	}
	
	
	public function home(Request $request){
		$template = $this->app['twig']->render('PublicController/Home.phtml');
		
		return $this->app['helper']('ThemeRender')->render($template);
		
		
	}
	public function readme(Request $request){
		
		$finder = new \Symfony\Component\Finder\Finder();
		$finder->name('README.md')->depth('== 0');
		$finder->files()->in($this->app['baseDir']);
		foreach ($finder as $file) {
			$contents = $file->getContents();
		}
		$Parsedown = new \Parsedown();
		$contents = $Parsedown->setBreaksEnabled(true)->setMarkupEscaped(true)->setUrlsLinked(true)->text($contents , true); 					
		return $this->app['twig']->render('PublicController/Readme.twig', array(
			'content' => $contents,
		));

    }
	
	
	
}
