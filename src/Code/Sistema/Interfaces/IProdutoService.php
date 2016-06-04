<?php
/**
 * Created by PhpStorm.
 * User: danilo
 * Date: 02/06/2016
 * Time: 15:29
 */

namespace Code\Sistema\Interfaces;


interface IProdutoService
{
    public function update($id, array $data);
    public function delete($id);
    public function insert(array $data);
    public function find($id);
    public function findAll();
}