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

        $vista->reset();

        $filtroBanner = array(
            'SuperDestaqueWeb' => 'Sim'
        );

        $pagination = array(
            'pagina'     => 1,
            'quantidade' => 5
        );

        $vista->buscaImoveis($filtroBanner, $pagination);
        $this->view->banners = $vista->getResult();

        $vista->reset();

        $filtroWidget1 = array(
            'EmDestaque'     => 'Sim',
        );

        $vista->buscaImoveis($filtroWidget1);
        $this->view->widget1      = $vista->getResult();
        $this->view->widget1Title = 'Destaques';

//        $vista->reset();
//
//        $filtroWidget2 = array(
//            'Categoria'     => 'Casa'
//        );
//
//        $vista->buscaImoveis($filtroWidget2);
//        $this->view->widget2 = $vista->getResult();

    }

}

