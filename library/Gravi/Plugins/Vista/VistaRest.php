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

}