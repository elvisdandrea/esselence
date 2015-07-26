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

        $vista->getListasBusca();

        $this->view->listas = $vista->getResult();

        $vista->reset();

        $params = $this->_request->getParams();

        $filtros = array();

        empty($params['tipo']) || $filtros['Categoria'] = $params['tipo'];
        empty($params['cidade']) || $filtros['Cidade'] = $params['cidade'];
        empty($params['bairros']) || $filtros['Bairro'] = $params['bairros'];

        (empty($params['valor_min']) && empty($params['valor_max'])) || $filtros['ValorVenda'] = array($params['valor_min'], $params['valor_max']);

        $vista->buscaImoveis($filtros);

        $vista->setPaginationParam(2, 50);

        $this->view->imoveis = $vista->getResult();
        $this->view->quantidadeImoveis = $vista->getTotalItems();
    }

}