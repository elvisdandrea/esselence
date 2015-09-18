<?php

class FaleConoscoController extends Zend_Controller_Action{

    public function indexAction(){
        $form = new Application_Form_FaleConoscoForm();
        $this->view->form = $form;
        $params = $this->_request->getParams();

        if($this->_request->isPost() && $form->isValid($params)){
            try{
                $vista = Services::get('vista_rest');
                $vista->getAuthEmail();
                $smtpData = $vista->getResult();

                $config = array('auth' => 'login',
                    'username' => $smtpData['user'],
                    'password' => $smtpData['pass'],
                    'port' => $smtpData['port']
                );

                $transport = new Zend_Mail_Transport_Smtp($smtpData['smtp'], $config);
                Zend_Mail::setDefaultTransport($transport);

                $html = new Zend_View();
                $html->setScriptPath(APPLICATION_PATH . '/views/scripts/fale-conosco/');

                $html->data = $params;

                $emailBody = $html->render('email-body.phtml');

                $mail = new Zend_Mail();

                $mail->setBodyHtml($emailBody);
                $mail->setFrom('eder.luiz.correa@gmail.com', $params['nome']);
                $mail->addTo('atendimento@esselence.com.br', 'Esselence');
                $mail->setSubject("Contato pelo Site {$params['nome']}");

                $mail->send();

                $this->view->success = true;
            } catch(Exception $e){
                print_r($e->getMessage());exit;
            }
        }
    }
}