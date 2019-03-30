<?php
$this->app->register(new \Knp\Provider\ConsoleServiceProvider());
//$this->app->register(new Silex\Provider\RoutingServiceProvider()); // rout controller
$this->app->register(new Silex\Provider\LocaleServiceProvider());  // Locale

//register illuminate database
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($this->app['config']['parameters']['mysql_params']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$this->app['schema'] = function()use($capsule){
    return $capsule::schema();
};
//end
//register Twig Service Provider
$this->app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => $this->app['config']['twig_path']));
//Translation
$this->app->register(new Silex\Provider\LocaleServiceProvider());
$this->app->register(new Silex\Provider\TranslationServiceProvider(), $this->app['config']['translation']);


$this->app->register(new Silex\Provider\AssetServiceProvider(), $this->app['config']['assets']);

$this->app->register(new Silex\Provider\CsrfServiceProvider());

