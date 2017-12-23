<?php
namespace OpenInvoices\FrontEnd\Controller\Factory;

use Interop\Container\ContainerInterface;
use OpenInvoices\FrontEnd\Controller\AuthenticationController;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Get the authentication service from the service manager.
        $authenticationService = $container->get(AuthenticationServiceInterface::class);
        
        // Create an instance of the controller and pass the dependency
        // to controller's constructor.
        return new AuthenticationController($authenticationService);
    }
}