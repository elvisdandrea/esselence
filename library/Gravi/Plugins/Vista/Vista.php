<?php

/**
 * Class Vista
 *
 * Handles the comunication with Vista RESTful API
 */
class Vista {

    /**
     * The file that contains
     */
    const ConfigFile = 'config.json';

    private $restClient;

    private $config = array();

    public function __construct() {

        $this->restClient = Services::get('restclient');
        $this->loadConfig();
    }

    /**
     * Loads the Vista API client configuration
     *
     * @throws  Zend_Exception
     */
    private function loadConfig() {

        $file = __DIR__ . '/' . self::ConfigFile;

        if (!is_file($file))
            throw new Zend_Exception('Vista configuration file missing');

        $config = file_get_contents($file);
        $config = json_decode($config, true);

        if (!$config || !isset($config['key']) || !isset($config['url']))
            throw new Zend_Exception('Vista configuration file is broken');

        $this->config = $config;

    }

    /**
     * Returns a client configuration parameter
     *
     * @param   string      $name       - The configuration name
     * @return  bool
     */
    public function getConfig($name) {

        if (!isset($this->config[$name])) return false;

        return $this->config[$name];
    }

}