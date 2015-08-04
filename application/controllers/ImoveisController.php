<?php
/**
 * Created by PhpStorm.
 * User: Luiz
 * Date: 25/07/2015
 * Time: 20:55
 */

class ImoveisController extends Zend_Controller_Action{

    public function listagemAction(){
        $this->view->headScript()->appendFile($this->view->serverUrl().BASEDIR.'/res/js/imoveis.js');
        $vista = Services::get('vista_rest');

        $vista->getListasBusca();

        $this->view->listas = $vista->getResult();

        $vista->reset();

        $params = $this->_request->getParams();

        $filtros = array();

        empty($params['tipo'])    || $filtros['Categoria'] = $params['tipo'];
        empty($params['cidade'])  || $filtros['Cidade']    = $params['cidade'];
        empty($params['bairros']) || $filtros['Bairro']    = $params['bairros'];
        empty($params['codigo'])  || $filtros['Codigo']    = $params['codigo'];

        empty($params['dormitorios']) || $filtros['Dormitorios'] = explode(',', $params['dormitorios']);

        (empty($params['valor_min']) && empty($params['valor_max'])) || $filtros['ValorVenda'] = array($params['valor_min'], $params['valor_max']);

        $vista->setPaginationParam(1, 9);
        $vista->buscaImoveis($filtros);

        $this->view->imoveis = $vista->getResult();
        $this->view->quantidadeImoveis = $vista->getTotalItems();
    }

    public function showMoreAction(){
        if(!$this->_request->isXmlHttpRequest())
            $this->redirect($this->view->serverUrl().BASEDIR.'/imoveis/listagem');

        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setRender('lista-imoveis');
        $params = $this->_request->getParams();

        $filtros = array();

        empty($params['tipo'])    || $filtros['Categoria'] = $params['tipo'];
        empty($params['cidade'])  || $filtros['Cidade'] = $params['cidade'];
        empty($params['bairros']) || $filtros['Bairro'] = $params['bairros'];

        (empty($params['valor_min']) && empty($params['valor_max'])) || $filtros['ValorVenda'] = array($params['valor_min'], $params['valor_max']);

        $vista = Services::get('vista_rest');

        $vista->setPaginationParam(1, 9);
        $vista->buscaImoveis($filtros);

        $this->view->imoveis = $vista->getResult();

    }

    public function detalhesAction(){
        $imoCodigo = $this->_request->getParam('codigo');

        if(empty($imoCodigo)){
            //TODO -- Criar tela de imovel não encontrado
        }

        $vista = Services::get('vista_rest');
        $vista->getDadosImovel($imoCodigo);

        $dadosImovel = $vista->getResult();

        if(empty($dadosImovel)){
            //TODO -- Criar tela de imovel não encontrado
        }

        $this->view->imovel = $dadosImovel;
    }
}