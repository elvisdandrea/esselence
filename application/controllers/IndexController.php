<?php

/**
 * Class IndexController
 *
 * The Main Project starts here
 *
 * For everyone editing this, please check the rules:
 *
 * - Do not code PSR, it sucks
 * - Brackets are on the same line of the method
 * - If you don't sacrifice readability for brevity, you are a pussy
 * - Real code has real small methods reusing functions as much as possible
 * - This means that low level code must be on the core, not on your method
 *
 */
class IndexController extends Zend_Controller_Action
{

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {

        $vista = Services::get('vista_rest');
        $vista->getListasBusca();

        $this->view->listas = $vista->getResult();

    }

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

