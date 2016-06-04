<?php
/**
 * Created by PhpStorm.
 * User: danilo
 * Date: 02/06/2016
 * Time: 16:20
 */

namespace Code\Sistema\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\ControllerProviderInterface;

class ProdutoController implements controllerProviderInterface
{
    /**
     * @var Application
     */
    private $app;

    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];
        //home
        $factory->get('/',function() use($app){
            $retorno = self::fetchAll($app);
            return $app->json($retorno);
           // return JsonResponse::create($retorno,200,['Content-Type' =>'application/json']);
        });

        //atualizar
        $factory->put('/produto/update/{id}', function($id, Request $request) use($app){
            $id = (int) $id;

            $retorno = self::update($id,$request, $app);
            return $app->json($retorno);
        });

        //Buscar Unico Produto
        $factory->get('/produto/{id}', function($id) use($app){
            return $app->json(self::fetch($id, $app));
        });

        //Cadastrar Novo Produto
        $factory->post('/produto/novo', function(Request $request) use($app){
            return $app->json(self::novo($request, $app));
        });


        return $factory;
    }

    /**
     * Mostra os dados de produto
     * @param Application $app
     * @return array|string
     */
    public function fetchAll(Application $app)
    {
        $result = $app['produtoService']->findAll();
        //dump($result);die;
        $produto = '';

        foreach($result as $product) {
            $produto[]['id']        = $product->getId();
            $produto[]['nome']      = $product->getNome();
            $produto[]['descricao'] = $product->getDescricao();
            $produto[]['valor']     = $product->getValor();
        }
        return $produto;
    }


    /**
     * Atualiza os dados de Produto
     * @param $id
     * @param Request $request
     * @param Application $app
     * @return mixed
     */

    public function update($id,Request $request,Application $app)
    {
        $data['nome']       = $request->get('nome');
        $data['descricao']  = $request->get('descricao');
        $data['valor']      = (float) $request->get('valor');

        //dump($request);die;
        //dump($data);die;

        return $app['produtoService']->update($id,$data);
    }

    /**
     * @param $id
     * @param Application $app
     * @return mixed
     */
    public function fetch($id,Application $app)
    {
        $id = (int) $id;
        return $app['produtoService']->find($id);
    }


    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function novo(Request $request, Application $app)
    {
        $dados['nome']      = $request->get('nome');
        $dados['descricao'] = $request->get('descricao');
        $dados['valor']     = $request->get('valor');

        return $app['produtoService']->insert($dados);
    }

}