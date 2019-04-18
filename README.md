# Silex's Micro framework  

## Prerequisites

- [PHP](http://php.net) version >= 5.4
- PHP Extensions
```
apt-get install php7.1-bcmath
or
apt-get install php5.6-bcmath
```
- [Apache2](https://httpd.apache.org/download.cgi), [Nginx](http://nginx.org/en/) web server or similar
- [Composer](https://getcomposer.org/)
- Nodejs & npm
```
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
sudo apt-get install -y nodejs
```
- Uglify Compress
```
npm install -g uglify-js
npm install -g uglifycss
```
- Images optimize 
```
sudo apt-get install optipng
sudo apt-get install libjpeg-turbo-progs
// if not found libjpeg-turbo-progs 
deb http://debian.oppserver.net/debian/ jessie main non-free contrib
deb-src http://debian.oppserver.net/debian/ jessie main non-free contrib
wget http://debian.oppserver.net/gpg-debian.oppserver.net-signing-pubkey.asc -O - | sudo apt-key add -
```
## Structure :

|   App  |               |                  |                      |        |
|--------|---------------| ---------------- | -------------------- | ------ |
|        | Config	     |	Translation		| Language name ex: en | *.yaml |
|		 | 			     |	parameters.yml  |                      |        |
|		 | App.php   	 |                  |                      |        |
|        | Bootstrap.php |                  |                      |        |
|        | Confing.php   |                  |                      |        |
|        | Routes.php    |                  |                      |        |
|        | Loger.php     |                  |                      |        |
|        | Extension.php |                  |                      |        |
|        | Globalfunc.php|                  |                      |        |
|        | Middleware.php|                  |                      |        |
|        | Register.php  |                  |                      |        |
|        | Session.php   |                  |                      |        |

------------

| Src |             |                    |                    |                    |
|-----|-------------| ------------------ | ------------------ | ------------------ |
|     |Controllers  |                    |                    |                    |
|     | View        | Component name     | Layout             |                    |
|     |             |                    | Elements           | EX controller name |
|     |             |                    | EX controller name | controller Files   |
|     |             | Layout             |                    |                    |
|     |             | Elements           | EX controller name |  Element Files     |
|     |             | EX controller name |                    |                    |
|     | Models      |                    |                    |                    |
|     | Helpers     |                    |                    |                    |
|     | Component   | Component name 	 |Controllers         |                    |
|     |             |					 | Models             |                    |
|     |             |					 | Helpers            |                    |
|	  | Providers	|                    |                    |                    |

------------

| Web |           |        |
|-----|-----------|--------|
|     |  css      |        |
|     |  js       |        |
|     |  images   |        |
|     |  lib      |        |
|     | Uploads   |        |
|     | Cache     |        |
|     | index.php |        |
|     | Component |  css   |
|     |           |  js    |
|     |           |  images|
|     |           |  lib   |
|     | .htaccess |        |

------------

| Bin    |  Command line ex: logs.sh |
|--------|---------------------------|
| Vender |  Composer                 |
|--------|---------------------------|
| Logos  |  Duplicate                |
|        |  Log files                |
|--------|---------------------------|
| Cache  |  Http                     |
|        |  Sesstions                |
|        |  Twig                     |
##### Rules:
 
- Files and Folders’ names always begin with CAPITAL letters. If a file’s name is a two-word name, therefore in each word, it needs to start in CAPITAL again. 
e.g, ( Sign In.php )

- For returning a ‘result’, use payload array. EX: payload=[ ];
- In ‘return’ there are some fix elements : 
    - payload [‘status’]  ( ` Success Or Error ` )
	- payload [‘message’] 


## Configuration

> parameters.yml >>   App/Config/parameters.yml

Values for config parameters substitution. On application code parameters are 
accessible through `Silex\Application` instance `$app['config']['parameters']`.
Example : 


```php

$this->app['config']['parameters']['timezone'];

```

## Global Value

```php
$this->app['debug']
$this->app['baseDir'] 
$this->app['baseUrl']
$this->app['config']...

```

## Global Functions 

> /App/Globalfunc.php


```php

// var_dump 
dumper(array('test'));
dump($GLOBALS);
d($GLOBALS);
~d($GLOBALS); // Text only output mode
+d($var) //will disregard depth level limits and output everything. (Careful, this can hang your browser on large objects!)
!d($var) //will expand the output automatically.
-d($var) //will attempt to ob_clean the previous output.
dd($GLOBALS);


```
## Call Functions Autoload

```php

$this->app['load']('class_dir')->function name();
// Src/Helpers
$this->app['helper']('class name')->function name();
// Src/Component
$this->app['component']('class_dir')->function name();

```

## Features

- ##### Console

Provides a Symfony\Component\Console based console for Silex 2.x.

[Documentation](https://github.com/KnpLabs/ConsoleServiceProvider).

Create your file in the Src/Console path that include a class in it as follows

```php
namespace Console;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Reminder extends Command
{
	
	protected $app;
	public function __construct($app){
		
		$this->app = $app; 
		parent::__construct();
		
	}
	
    protected function configure()
    {
        $this
            ->setName('Reminder:income')
            ->setDescription('save reminder of future task in daily,weekly and monthly')
			->addArgument(
                'mood',
                InputArgument::REQUIRED,
                'Witch mood of reminder?'
            );
    }
	
	protected function interact(InputInterface $input, OutputInterface $output){}
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
		
		$mood = $input->getArgument('mood');
		
		///Your actions
		
		exit;
	}
}

```

Then add and new your class to the console file in the ROOT path

```php

$console->add(new Console\Reminder($app));

$console->run();
```

>Usage

```php

exec('php '.$this->app['baseDir'].'/console Reminder:income '.Incoming Arguments.' > /dev/null 2>/dev/null &');

```

- ##### Monolog

It will log requests and errors and allow you to add logging to your application. This allows you to debug and monitor the behaviour, even in production.

>Usage

```php

////Monolog chanel: DEBUG ,INFO ,NOTICE ,WARNING ,ERROR ,CRITICAL ,ALERT ,EMERGENCY 

$this->app['monolog.debug']->WARNING("Log Text" , array());

$this->app['monolog.debug']->debug('My logger is now ready',array('testKey'=>'wooow'));

$getProcessID = $this->app['monolog.debug']->getProcessors()[0]->getUid();
				
///For SQL LOG
$this->app['monolog.sql']->

```

- ##### Stop Watch

The StopwatchEvent object can be retrieved from the  start(), stop(), lap() and getEvent() methods.

[Documentation](http://symfony.com/doc/current/components/stopwatch.html).


```php

// Start event named 'eventName'
$stopwatch->start('eventName');
// ... some code goes here
$event = $stopwatch->stop('eventName');

```

As you know from the real world, all stopwatches come with two buttons: one to start and stop the stopwatch, and another to measure the lap time. This is exactly what the lap() method does:


```php

$stopwatch = new Stopwatch();
// Start event named 'foo'
$stopwatch->start('foo');
// ... some code goes here
$stopwatch->lap('foo');
// ... some code goes here
$stopwatch->lap('foo');
// ... some other code goes here
$event = $stopwatch->stop('foo');

```

- ##### Cookie

>Usage



```php

use Symfony\Component\HttpFoundation\Cookie;

$dt = new \DateTime();
$dt->modify("+1 month");
  
$response = new Response(json_encode(['status'=>'logout','url'=>$this->app['baseUrl'].'system/signin']));
$lastView = new Cookie("Software_Last_View", $pathUrl,$dt);
$response->headers->setCookie($lastView);
return $response;

 ```
 
 - ##### Outgoing Request
 

Requests allows you to send HEAD, GET, POST, PUT, DELETE, and PATCH HTTP requests. You can add headers, form data, multipart files, and parameters with simple arrays, and access the response data in the same way. Requests uses cURL and fsockopen, depending on what your system has available, but abstracts all the nasty stuff out of your way, providing a consistent API.


```php
$this->app['helper']('OutgoingRequest')->postRequest( $url,$header = [],$data = [] ,$checkToken = true );
$this->app['helper']('OutgoingRequest')->getRequest( $url,$header = [],$data = [] ,$checkToken = true);
```

- ##### HTTP Cache


To help you debug caching issues, set your application debug to true.
[Documentation](https://silex.symfony.com/doc/2.0/providers/http_cache.html).

>Usage




```php

$app->get('/', function() {
    return new Response('Foo', 200, array(
        'Cache-Control' => 's-maxage=5',
    ));
});

```

- ##### Short-circuiting the Controller


```php
 return new RedirectResponse('/login');
```

- ##### Get Route


```php
$request->getPathInfo();
```

- ##### Session


```php

$this->app['session']->start();  //Starts the session - do not use session_start().
$this->app['session']->getId(); //Gets the session ID. Do not use session_id().
$this->app['session']->invalidate(); //Clears all session data and regenerates session ID. Do not use session_destroy().
$this->app['session']->setId(); //Sets the session ID. Do not use session_id().
$this->app['session']->getName(); //Gets the session name. Do not use session_name().
$this->app['session']->setName(); //Sets the session name. Do not use session_name().

$this->app['session']->set(); //Sets an attribute by key.
$this->app['session']->get(); //Gets an attribute by key.
$this->app['session']->all(); //Gets all attributes as an array of key => value.
$this->app['session']->has(); //Returns true if the attribute exists.
$this->app['session']->replace(); //Sets multiple attributes at once: takes a keyed array and sets each key => value pair.
$this->app['session']->remove(); //Deletes an attribute by key.
$this->app['session']->clear(); //Clear all attributes.

```

- ##### Redis

[Documentation](https://packagist.org/packages/predis/service-provider).


```php

$this->app['predis']['db']->set('db', 'database');
$this->app['predis']['session']->set('session', 'session');
$this->app['predis']['cache']->set('cache', 'caching');
/**************************************************/
$this->app['predis']['db']->get('db');
$this->app['predis']['session']->get('session');
$this->app['predis']['cache']->get('cache');

/*********************** expire key in redis***************************/
$this->app['predis']['cache']->set(key , value);
$this->app['predis']['cache']->expire(key , 3600);
$ttl = $this->app['predis']['cache']->ttl(key); // will be 3600 seconds

```

- ##### Twig

> Added 3 filters to twig

[Documentation](https://silex.symfony.com/doc/2.0/providers/twig.html).

>Usage



```html
<!--twig encode-->
{% set code = '1234'|encode %}
<h2>{{code}}</h2>
<!--twig decode-->
{% set encode = code|decode %}
<h2>{{encode}}</h2>
<!--twig loader  call php helpers in twig-->
{% set var = 'Helper_CryptoGraphy'|loader('md5encrypt',['1234']) %}
<h3>{{var}}</h3>

```

- ##### Html Compress Twig

Twig extension for compressing HTML and inline CSS/Javascript
Currently supported Twig features are:
[Documentation](https://packagist.org/packages/nochso/html-compress-twig).


```html
Tag
{% htmlcompress %} ... {% endhtmlcompress %}
Function
{{ htmlcompress('some html') }}
Filter
{{ content|markdown|htmlcompress }}
```

Any HTML, inline CSS and Javascript will be compressed.



- ##### Filesystem Component

The Filesystem component provides basic utilities for the filesystem.
[Documentation](https://symfony.com/doc/current/components/filesystem.html).

>Usage


The Filesystem class is the unique endpoint for filesystem operations:


```php

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

$fs = new Filesystem();

try {
    $fs->mkdir('/tmp/random/dir/'.mt_rand());
} catch (IOExceptionInterface $e) {
    echo "An error occurred while creating your directory at ".$e->getPath();
}
```

**NOTE**
    ```
    Methods mkdir(), exists(), touch(), remove(), chmod(), chown() and chgrp() can receive a string, an array or any object implementing Traversable as the target argument.
    ```


- ##### Finder Component

The Finder component finds files and directories via an intuitive fluent interface.
[Documentation](https://symfony.com/doc/current/components/finder.html).

>Usage


The Finder class finds files and/or directories:

```php
use Symfony\Component\Finder\Finder;


$finder = new Finder();
$finder->files()->in(__DIR__);
//count of file
if(iterator_count($finder)>0){

foreach ($finder as $file) {
    // Dump the absolute path
    var_dump($file->getRealPath());

    // Dump the relative path to the file, omitting the filename
    var_dump($file->getRelativePath());

    // Dump the relative path to the file
    var_dump($file->getRelativePathname());
}

}


```

 - ##### Parsedown (Markdown)


Better Markdown Parser in PHP
[Documentation](https://github.com/erusev/parsedown/wiki/Tutorial:-Get-Started).
Example: 

```php

$Parsedown = new \Parsedown();
echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p>

```
- ##### Asset


a way to manage URL generation and versioning of web assets such as CSS stylesheets, JavaScript files and image files.

[Documentation](https://symfony.com/doc/current/components/asset.html).

> Parameters

```
assets.version: Default version for assets.

assets.format_version (optional): Default format for assets.

assets.base_path: Default path to prepend to all assets without a package.

assets.named_packages (optional): Named packages. Keys are the package names and values the configuration (supported keys are version, version_format, base_urls, and base_path).
````

>Usage

The AssetServiceProvider is mostly useful with the Twig provider:

```html

{{ asset('/css/foo.png') }}
{{ asset('/css/foo.css', 'css') }}
{{ asset('/img/foo.png', 'images') }}

{{ asset_version('/css/foo.png') }}

```

- ##### Translation

This is a service for translating your application into different languages.
[Documentation](https://silex.symfony.com/doc/2.0/providers/translation.html).

you can to load translations from external YAML files from this way (/App/Config/Translation/)
`Make a folder for each language in the above path`
EX : en/*.yml 

```yaml
hello: Hello %name%
goodbye: Goodbye %name%

```

>Usage

`return in Controller`

```php
return $this->app['translator']->trans('translation_key', array('%name%' => 'ali'));
```
 `return in Twig`

```html
{{ 'translation_key'|trans }}
<br>
{{ 'translation_key'|transchoice(5,{'%name%': 'Fabien'}) }}
<br>
{% trans %}translation_key {% endtrans %}
<br>
```


- ##### Compress js/css

This is a best parser/compressor/beautifier toolkit

>Usage

`Use in Twig`
Asset address must start from Web Dir, for example if asset file path is Web/js/AjaxUrl.js ,in twig filter must write js/AjaxUrl.js
*also this filter automaticlly set version for js.css file,and on update js/css file change version and prevent from caching
```html

{% set AddOns = 'Helper_Compress'|loader('compression',['Js/Css file path','Js/Css file path']) %}
{{ AddOns|raw }}

```

- ##### Image Optimizer(png,jpeg)

Optimize image in htmls

>Usage

`Use in Twig`
Image address must start from Web Dir, for example if image file path is Web/images/test.png ,in twig filter must write images/test.png
*Image optimizer filter can optimize only one image on each usage.
```html

{% set ImgOpt = 'Helper_Compress'|loader('ImageOptimizer',['images/test.png']) %}
<img src="{{ImgOpt}}">

```

- ##### Request Limitation

This example will limit the rate of a global resource to 10 requests per second for all requests.
[Documentation](https://packagist.org/packages/bandwidth-throttle/token-bucket).

```php
use bandwidthThrottle\tokenBucket\storage\PredisStorage;
//OR
use bandwidthThrottle\tokenBucket\storage\FileStorage;

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;

use bandwidthThrottle\tokenBucket\BlockingConsumer;



$storage = new PredisStorage(unique key ,$this->app['predis']['cache']);
//OR
$storage = new FileStorage($this->app['config']['cache_dir'].'Http/');		

$rate    = new Rate(10, Rate::SECOND);
/**********************************************************************/
$bucket  = new TokenBucket(10, $rate, $storage);
$bucket->bootstrap(10);
if (!$bucket->consume(1, $seconds)) {
   return new Response(sprintf("Retry-After: %d", floor($seconds)),429);
}
/********************  OR ******************************************/
$bucket  = new TokenBucket(1, $rate, $storage);
$consumer = new BlockingConsumer($bucket);
$bucket->bootstrap(1);
// This will block until one token is available.
$consumer->consume(1);

```

		
