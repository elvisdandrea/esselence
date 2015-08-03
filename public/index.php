<?php

function isLocal() {
    return !filter_var(filter_input(INPUT_SERVER,'SERVER_ADDR'), FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)
    || (((ip2long(filter_input(INPUT_SERVER,'SERVER_ADDR')) & 0xff000000) == 0x7f000000) );
}

isLocal() ?
    define('BASEDIR', '/esselence/public') : define('BASEDIR', '/esselence/public');


// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();