<?php
/**
 * Created by PhpStorm.
 * User: danilo
 * Date: 09/05/2014
 * Time: 14:47
 */

require_once  __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\JsonResponse;



$app->get('/', function(){
    $cliente = [
        0 => ['nome' => 'Cliente Teste 00', 'email' => 'email@teste.com.br', 'CPF' => '000.000.000-00'],
        1 => ['nome' => 'Cliente Teste 01', 'email' => 'email@teste.com.br', 'CPF' => '000.000.000-00'],
        2 => ['nome' => 'Cliente Teste 02', 'email' => 'email@teste.com.br', 'CPF' => '000.000.000-00'],
    ];

    return JsonResponse::create($cliente,200,['Content-Type' =>'application/json']);

});


/**
 * Roda nossa aplicação
 */
$app->run();