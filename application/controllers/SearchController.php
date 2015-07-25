<?php
/**
 * Created by PhpStorm.
 * User: Luiz
 * Date: 25/07/2015
 * Time: 20:55
 */

class SearchController extends Zend_Controller_Action{

    public function searchAction(){
        $vista = Services::get('vista_rest');
        $params = $this->_request->getParams();

        $filtros = array(
            'tipo' => $params['tipo'],
            'cidade' => $params['cidade'],
            'bairros' => $params['bairros'],
            'valor_min' => $params['valor_min'],
            'valor_max' => $params['valor_max'],
        );

        $vista->buscaImoveis($filtros);
        print_r($vista->getResult());exit;
        $this->view->imoveis = $vista->getResult();
    }

}