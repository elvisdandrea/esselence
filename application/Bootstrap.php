<?php

/**
 * Class Bootstrap
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    const GraviDir = '../library/Gravi';

    /**
     * Initializes the dependency injector
     */
    protected function _initDependencyInjection() {

        require_once self::GraviDir . '/DependencyInjection/DependencyInjection.php';
        require_once self::GraviDir . '/DependencyInjection/Services.php';
        Services::init();
    }

}

