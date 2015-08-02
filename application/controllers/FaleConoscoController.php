<?php

class FaleConoscoController extends Zend_Controller_Action{

    public function indexAction(){
        if($this->_request->isPost()){
            try{
                $tr = new Zend_Mail_Transport_Sendmail('eder.luiz.correa@gmail.com');
                Zend_Mail::setDefaultTransport($tr);

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