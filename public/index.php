<?php


require_once  __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Code\Sistema\Controller\ProdutoController;
use Code\Sistema\Service\ProdutoService;

// Registrando o serviço no container do Silex
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