<?php
namespace OpenInvoices\FrontEnd\Controller;

use OpenInvoices\FrontEnd\Form\AuthenticationForm;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthenticationController extends AbstractActionController
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;
    
    public function __construct(AuthenticationServiceInterface $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }
    
    public function indexAction()
    {
        $form = new AuthenticationForm();
        $form->prepareElements();
        
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if ($form->isValid()) {
                $data = $form->getData();
                /**
                 * @var \Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter
                 */
                $adapter = $this->authenticationService->getAdapter();
                $adapter->setIdentity($data['username']);
                $adapter->setCredential($data['password']);
                $adapter->setCredentialTreatment('MD5(?)');
                if ($this->authenticationService->authenticate()->isValid()) {
                    return $this->redirect()->toRoute( 'home');
                }
                
                // TODO: Get error messages
                //$mensagem = $this->authenticationService->authenticate()->getMessages();
                //$this->flashMessenger()->AddErrorMessage($mensagem[0]);
            }
        }
        
        $this->layout('layout/authentication');
        return new ViewModel([
            'form' => $form
        ]);
    }
    
    public function logoutAction()
    {
        $this->authenticationService->clearIdentity();
        return $this->redirect()->toRoute('authentication');
    }
}