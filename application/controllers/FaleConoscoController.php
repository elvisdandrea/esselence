<?php

class FaleConoscoController extends Zend_Controller_Action{

    public function indexAction(){
        if($this->_request->isPost()){
            try{
                $config = array('auth' => 'login',
                    'username' => 'eder.luiz.correa@gmail.com',
                    'password' => 'rqzqhxbq',
                    'port' => '587',
                    'ssl' => 'tls'
                );

                $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

                Zend_Mail::setDefaultTransport($transport);

                $mail = new Zend_Mail();

                $mail->setBodyText('PLACEHOLDER.');
                $mail->setFrom('eder.luiz.correa@gmail.com', 'Placeholder');
                $mail->addTo('eder.luiz.correa@gmail.com', 'Placeholder');

                $mail->setSubject('Placeholder Subject');

                $mail->send();

                $this->view->success = true;
            } catch(Exception $e){
                print_r($e->getMessage());exit;
            }
        }
    }
}