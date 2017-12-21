<?php
/**
 * TODO: This should be moved into a OpenInvoice\Core\Authentication
 */
namespace OpenInvoices\FrontEnd\Service;

use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * Create and return a request instance.
     *
     * @param  ContainerInterface $container
     * @param  string $name
     * @param  null|array $options
     * @return HttpRequest
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $adapter = $container->get(\Zend\Db\Adapter\Adapter::class);
        $dbAuthAdapter = new CredentialTreatmentAdapter($adapter, 'users', 'user_name', 'user_password');
        
        $authenticationService = new AuthenticationService();
        $authenticationService->setAdapter($dbAuthAdapter);
        return $authenticationService;
    }
}