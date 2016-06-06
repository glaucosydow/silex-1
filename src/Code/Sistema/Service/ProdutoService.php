<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Produto as ProdutoEntity;
use Code\Sistema\Interfaces\IProdutoService;
use Doctrine\ORM\EntityManager;


class ProdutoService implements IProdutoService
{

    private $em;

    /**
     * ProdutoService constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param array $data
     * @return array
     */
    public function insert(array $data)
    {
        $produtoEntity = new ProdutoEntity();
        $produtoEntity->setNome($data['nome']);
        $produtoEntity->setDescricao($data['descricao']);
        $produtoEntity->setValor($data['valor']);

        $this->em->persist($produtoEntity);
        $this->em->flush();

        return [
            'id'            => $produtoEntity->getId(),
            'nome'          => $produtoEntity->getNome(),
            'desciracao'    => $produtoEntity->getDescricao(),
            'valor'         => $produtoEntity->getValor()
        ];
    }

    /**
     * @param $id
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete($id)
    {
        $produto = $this->em->getReference("Code\Sistema\Entity\Produto", $id);
        $this->em->remove($produto);
        return [
           "success" => true
        ];
    }

    /**
     * @param $id
     * @param $data
     * @return bool|\Doctrine\Common\Proxy\Proxy|null|object
     * @throws \Doctrine\ORM\ORMException
     */
    public function update($id,array $data)
    {
        $produto = $this->em->getReference("Code\Sistema\Entity\Produto", $id);

        $produto->setNome($data['nome']);
        $produto->setDescricao($data['descricao']);
        $produto->setValor($data['valor']);

        $this->em->persist($produto);
        $this->em->flush();

        return [
            'id'    => $produto->getId(),
            'nome'  => $produto->getNome(),
            'descricao' => $produto->getDescricao(),
            'valor'     => $produto->getValor()
        ];

    }

    /**
     * @param $id
     * @return null|object
     */
    public function find($id)
    {
        $repo = $this->em->getRepository("Code\Sistema\Entity\Produto",$id);
        $produto = $repo->find($id);

        //dump($produto->getId());die;

        return [
            'id'    => $produto->getId(),
            'nome'  => $produto->getNome(),
            'descricao' => $produto->getDescricao(),
            'valor'     => $produto->getValor()
        ];
    }


    /**
     * @return array
     */
    public function findAll()
    {
        $repo = $this->em->getRepository("Code\Sistema\Entity\Produto");
        return $repo->findAll();
    }
}