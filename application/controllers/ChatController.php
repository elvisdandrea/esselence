<?php

class ChatController extends Zend_Controller_Action{
    public function indexAction(){
        $this->view->headLink()->appendStylesheet($this->view->serverUrl().BASEDIR.'/phpfreechat-2.1.1/client/themes/default/client.css');
        $this->view->headScript()->appendFile($this->view->serverUrl().BASEDIR.'/phpfreechat-2.1.1/client/lib/jquery-1.8.2.min.js');
        $this->view->headScript()->appendFile($this->view->serverUrl().BASEDIR.'/phpfreechat-2.1.1/client/client.js');
        $this->view->headScript()->appendFile($this->view->serverUrl().BASEDIR.'/res/js/chat.js');
    }
}