<?php
/**
 * Created by PhpStorm.
 * User: danilo
 * Date: 09/05/2014
 * Time: 14:42
 */

require_once 'vendor/autoload.php';

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