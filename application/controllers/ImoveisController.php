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

        $filtros = array();

        empty($params['tipo']) || $filtros['Categoria'] = $params['tipo'];
        empty($params['cidade']) || $filtros['Cidade'] = $params['cidade'];
        empty($params['bairros']) || $filtros['Bairro'] = $params['bairros'];

        (empty($params['valor_min']) && empty($params['valor_max'])) || $filtros['ValorVenda'] = array($params['valor_min'], $params['valor_max']);

        $vista->buscaImoveis($filtros);

        $listaImoveis = $vista->getResult();
        $this->view->imoveis = $listaImoveis;
        $this->view->quantidadeImoveis = count($listaImoveis);
    }

}