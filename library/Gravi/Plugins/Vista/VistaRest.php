<?php

/**
 * Class VistaRest
 *
 * Implementation of Vista Requests
 */
class VistaRest extends Vista {

    /**
     * Class setup
     */
    public function __construct() {
        parent::__construct();
    }

    public function getDestaques() {

        $this->setVistaMethod('imoveis', 'destaques');
        $this->addFieldParam('Categoria');
        $this->addFieldParam('Codigo');
        $this->addFieldParam('Bairro');
        $this->addFieldParam('Cidade');
        $this->addFieldParam('Dormitorios');

        $this->execute();

    }

    public function getListasBusca() {

        $this->setVistaMethod('imoveis', 'listarConteudo');
        $this->addFieldParam('Categoria');
        $this->addFieldParam('Bairro');
        $this->addFieldParam('Cidade');

        $this->execute();

    }

    public function buscaImoveis(array $filtros, array $pagination = array()) {

        $this->setVistaMethod('imoveis', 'listar');

        $this->addFieldParam('Codigo');
        $this->addFieldParam('Categoria');
        $this->addFieldParam('Bairro');
        $this->addFieldParam('Cidade');
        $this->addFieldParam('ValorVenda');
        $this->addFieldParam('Dormitorios');
        $this->addFieldParam('Empreendimento');
        $this->addFieldParam('Suites');
        $this->addFieldParam('Vagas');
        $this->addFieldParam('AreaTotal');
        $this->addFieldParam('FotoDestaque');
        $this->addFieldParam('FotoDestaquePequena');

        if (isset($pagination['pagina']) && isset($pagination['quantidade'])) {
            $this->setPaginationParam($pagination['pagina'], $pagination['quantidade']);
        }

        empty($filtros) || $this->addFilterParam($filtros);

        $this->execute();
    }

    public function getDadosImovel($imoCodigo){
        $this->setVistaMethod('imoveis', 'detalhes');

        $this->addParam('imovel', $imoCodigo);

        $this->addFieldParam('Codigo');
        $this->addFieldParam('Categoria');
        $this->addFieldParam('Bairro');
        $this->addFieldParam('Cidade');
        $this->addFieldParam('ValorVenda');
        $this->addFieldParam('Dormitorios');
        $this->addFieldParam('Empreendimento');
        $this->addFieldParam('Descricao');
        $this->addFieldParam('Suites');
        $this->addFieldParam('Vagas');
        $this->addFieldParam('AreaTotal');
        $this->addFieldParam('AreaPrivativa');
        $this->addFieldParam(array('Foto' => array('Foto', 'FotoPequena', 'Destaque')));
        $this->addFieldParam('Caracteristicas');
        $this->addFieldParam('InfraEstrutura');
        $this->addFieldParam('Latitude');
        $this->addFieldParam('Longitude');

        $this->execute();
    }

    public function getAuthEmail() {

        $this->setVistaMethod(false, 'emailauth');
        $this->setEmptyBody(true);
        $this->execute();

    }

    public function getDadosAgencias() {

        $this->setVistaMethod('agencias', 'listar');
        $this->addFieldParam('Codigo');
        $this->addFieldParam('Nome');
        $this->addFieldParam('E-mail');
        $this->addFieldParam('Fone');

        $this->execute();
    }

}