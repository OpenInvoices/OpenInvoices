<?php
namespace OpenInvoices\FrontEnd\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PaymentsController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}