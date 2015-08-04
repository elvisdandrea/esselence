<?php

class Application_Form_FaleConoscoForm extends Zend_Form{

    protected $_errorMessages = array(
        'isEmpy' => 'Este campo é obrigatório',
        'digits' => 'Digite apenas numeros',
        'emailValidator' => 'E-mail inválido',
        'foneValidator' => 'Este campo deve possuir pelo menos 8 digitos'
    );

    public function __construct(){
        // Validators --------------------------
        $notEmpty = new Zend_Validate_NotEmpty(array(true));
        $notEmpty->setMessage($this->_errorMessages['isEmpy']);

        $digits = new Zend_Validate_Digits();
        $digits->setMessage($this->_errorMessages['digits']);

        $emailValidator = new Zend_Validate_EmailAddress();
        $emailValidator->setMessage($this->_errorMessages['emailValidator']);

        $foneValidator = new Zend_Validate_StringLength();
        $foneValidator->setMin(8);
        $foneValidator->setMessage($this->_errorMessages['foneValidator']);

        //--------------------------------------

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setAttrib('class', 'form-control');
        $nome->setRequired(true);
        $nome->addValidator($notEmpty, true);
        //--------------------------------------------------------
        $fone = new Zend_Form_Element_Text('fone');
        $fone->setAttrib('class', 'form-control');
        $fone->setRequired(true);
        $fone->addValidator($notEmpty, true);
        $fone->addValidator($digits, true);
        $fone->addValidator($foneValidator, true);
        //--------------------------------------------------------
        $email = new Zend_Form_Element_Text('email');
        $email->setAttrib('class', 'form-control');
        $email->setRequired(true);
        $email->addValidator($notEmpty, true);
        $email->addValidator($emailValidator, true);
        //--------------------------------------------------------
        $mensagem = new Zend_Form_Element_Textarea('mensagem');
        $mensagem->setAttrib('class', 'form-control');
        $mensagem->setAttrib('cols', 30);
        $mensagem->setAttrib('rows', 10);
        $mensagem->setRequired(true);
        $mensagem->addValidator($notEmpty, true);
        //--------------------------------------------------------
        $this->addElement($nome);
        $this->addElement($fone);
        $this->addElement($email);
        $this->addElement($mensagem);

        $this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
        ));
    }
}