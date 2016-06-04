<?php

namespace Code\Sistema\Interfaces;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

interface IProdutoController
{
    public function update($id,Request $request,Application $app);
    public function fetchAll(Application $app);
    public function fetch($id,Application $app);
    public function novo(Request $request,Application $app);

    public function delete($id,Application $app);
}