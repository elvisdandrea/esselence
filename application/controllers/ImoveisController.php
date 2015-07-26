<?php
/**
 * Created by PhpStorm.
 * User: Luiz
 * Date: 25/07/2015
 * Time: 20:55
 */

class ImoveisController extends Zend_Controller_Action{

    public function listagemAction(){
        $vista = Services::get('vista_rest');
        $params = $this->_request->getParams();

        $filtros = array(
            'Categoria' => $params['tipo'],
            'Cidade' => $params['cidade'],
            'Bairro' => $params['bairros'],
            'ValorVenda' => array($params['valor_min'], $params['valor_max']),
        );

        $vista->buscaImoveis($filtros);

        $this->view->imoveis = $vista->getResult();
    }

}