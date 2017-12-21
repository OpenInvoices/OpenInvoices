<?php
namespace OpenInvoices\FrontEnd\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\InputFilter\InputFilter;
use Zend\Form\Element\Password;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Submit;

class AuthenticationForm extends Form
{
    public function prepareElements()
    {
        parent::__construct('auth', array());
        $this->setAttribute('method', 'POST');
        
        $username = new Text('username');
        $username->setLabel('User name');
        $username->setAttributes([
            'class' => 'validate[required,custom[email]] form-control',
            'placeholder'=>'Enter your user name',
            'required' => 'required'
        ]);
        //$email->setAttribs(array('class'=>'validate[required,custom[email]] form-control','placeholder'=>'Enter your email address'));
        //$email->setRequired(true);
        $this->add($username);
        
        $password = new Password('password');
        $password->setLabel('Password');
        $password->setAttributes([
            'class' => 'form-control',
            'placeholder'=>'Enter your password',
            'required' => 'required'
        ]);
        $this->add($password);
        
        $csrf = new Csrf('token');
        $this->add($csrf);
        
        $submit = new Submit('send');
        $submit->setValue('Sign in');
        $submit->setAttributes([
            'class' => 'btn btn-primary'
        ]);
        $this->add($submit);
    }
    
    // This method creates input filter (used for form filtering/validation).
    private function addInputFilter()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);
        
        $inputFilter->add([
            'name'     => 'username',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 100
                    ],
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name'     => 'password',
            'required' => true,
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1
                    ],
                ],
            ],
        ]);
    }
}