<?php
/**
 * Created by PhpStorm.
 * User: danilo
 * Date: 09/05/2014
 * Time: 14:42
 */

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\EventManager as EventManager,
    Doctrine\ORM\Events,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\Annotations\CachedReader,
    Doctrine\ORM\Mapping\Driver\AnnotationDriver,
    Doctrine\ORM\Mapping\Driver\DriverChain,
    Doctrine\Common\ClassLoader;


/************************************** INICIO DOCTRINE  ****************************************************************/
$cache = new Cache;
$annotationReader = new AnnotationReader;

$cachedAnnotationReader = new CachedReader(
    $annotationReader, // use reader
    $cache // and a cache driver
);

$annotationDriver = new AnnotationDriver(
    $cachedAnnotationReader, // our cached annotation reader
    array(__DIR__ . DIRECTORY_SEPARATOR . 'src')
);

$driverChain = new DriverChain();
$driverChain->addDriver($annotationDriver,'Code');

$config = new Doctrine\ORM\Configuration;
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true); // this can be based on production config.
// register metadata driver
$config->setMetadataDriverImpl($driverChain);
// use our allready initialized cache driver
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

AnnotationRegistry::registerFile(__DIR__. DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

/************************************** FIM DOCTRINE  ****************************************************************/
/**
 * Gerenciador de Eventos
 */
$evm = new EventManager();

/**
 * Gerenciador de Entidades
 */
$em = EntityManager::create(
    array(
        'driver'  => 'pdo_mysql',
        'host'    => 'localhost',
        'port'    => '3306',
        'user'    => 'root',
        'password'  => '',
        'dbname'  => 'silex',
    ),
    $config,
    $evm
);

/**
 * Inicializa variavel $app como uma aplicação Silex
 */
$app = new \Silex\Application();

/**
 * Habilta o debug da aplicação em tempo de desenvolvimento
 */
$app["debug"] = true;


$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

/**
 * Habilita o Cors
 */
$app->register(new JDesrosiers\Silex\Provider\CorsServiceProvider(), array(
    "cors.allowOrigin" => "*",
    "cors.allowMethods" => "GET POST PUT DELETE",

));
