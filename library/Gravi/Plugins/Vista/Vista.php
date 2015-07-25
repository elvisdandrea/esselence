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

    /**
     * The Rest Client Object
     *
     * @var     RestClient
     */
    private $restClient;

    /***
     * The client configuration
     *
     * @var     array
     */
    private $config = array();

    /**
     * The Vista Rest Method
     *
     * @var     string
     */
    private $vistaMethod;

    /**
     * ( GET | POST | PUT | DELETE )
     *
     * @var
     */
    private $requestMethod = 'get';

    /**
     * Parameter "pesquisa" or "cadastro" of Vista API
     *
     * @var     array
     */
    private $params = array();

    /**
     * Contains the method response
     *
     * @var array
     */
    private $result = array();

    /**
     * Contains the method pagination
     *
     * @var array
     */
    private $pagination = array();

    /**
     * Constructor
     *
     * Sets up the client
     */
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

    /**
     * Sets the method
     *
     * @param   string      $module     - ( imoveis | clientes | usuarios | agencias )
     * @param   string      $method     - ( listar | detalhes | buscaAvancada )
     */
    public function setVistaMethod($module, $method) {

        $this->vistaMethod = $module . '/' . $method;
    }

    /**
     * Sets the request Method
     *
     * @param   string      $method     - ( get | post | put | delete )
     * @throws  Zend_Exception
     */
    public function setMethod($method) {

        if(!in_array($method, array('get', 'post', 'put', 'delete')))
            throw new Zend_Exception('Method ' . $method . ' is invalid. Must be "get", "post", "put" or "delete"');

        $this->requestMethod = $method;
    }

    /**
     * Sets the whole set of params
     *
     * @param   $params      - The parameters array
     */
    public function setParams(array $params) {

        $this->params = $params;
    }

    /**
     * Adds a field or set of fields
     *
     * Ex:  array( 'Foto' => array( 'Foto', 'Descricao' ) )
     * Ex2: 'Bairro'
     *
     * @param   string|array    $field      - A field or sets of field
     */
    public function addFieldParam($field) {

        $this->params['fields'][] = $field;
    }

    /**
     * Adds a filter
     *
     * Ex: array( 'Bairro' => array('Centro', 'Moema'), 'Codigo' => 10 )
     *
     * @param   array       $filter     - The filter set
     */
    public function addFilterParam(array $filter) {

        $this->params['filter'][] = $filter;
    }

    /**
     * Adds an order
     *
     * @param   string  $field          - The field to sort by
     * @param   string  $direction      - ( asc | desc )
     */
    public function addOrderParam($field, $direction) {

        $this->params['order'][$field] = $direction;
    }

    /**
     * Sets the Pagination
     *
     * @param int   $page       - Current page
     * @param int   $ammount    - Results per page
     */
    public function setPaginationParam($page = 1, $ammount = 10) {

        $this->params['paginacao'] = array(
            'pagina'        => $page,
            'quantidade'    => $ammount
        );
    }

    public function execute() {

        $this->restClient->addHeader('Accept', 'application/json');
        $this->restClient->setUrl($this->getConfig('url'));
        $this->restClient->setUri($this->vistaMethod);
        $this->restClient->setMethod($this->requestMethod);

        !$this->requestMethod == 'get' ||
            $this->restClient->addParam('showTotal', 1);

        $requestParam = $this->requestMethod == 'get' ? 'pesquisa' : 'cadastro';

        $this->restClient->addParam($requestParam, $this->params);
        $this->restClient->execute();

        print_r($this->restClient->getResponse());
        exit;

    }



}