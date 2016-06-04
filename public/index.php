<?php
/**
 * Created by PhpStorm.
 * User: danilo
 * Date: 09/05/2014
 * Time: 14:47
 */

require_once  __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Code\Sistema\Controller\ProdutoController;
use Code\Sistema\Service\ProdutoService;

$app['produtoService'] = function() use($em){
    $ps = new ProdutoService($em);
    return $ps;
};


/**
 * Controller
 */
$app->mount('/', new ProdutoController());

/**
 * Roda nossa aplicação
 */
$app->run();