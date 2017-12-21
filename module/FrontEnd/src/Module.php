<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace OpenInvoices\FrontEnd;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use Zend\Authentication\AuthenticationService;

class Module
{
    const VERSION = '0.0.1-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    /**
     * Move to OpenInvoices\Core\Listener
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $sm = $e->getApplication()->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        //attach event here
        $eventManager->attach('route', array($this, 'checkUserAuth'), 2);
    }
    
    public function checkUserAuth(MvcEvent $e)
    {
        $router = $e->getRouter();
        $matchedRoute = $router->match($e->getRequest());
        
        //this is a whitelist for routes that are allowed without authentication
        //!!! Your authentication route must be whitelisted
        $allowedRoutesConfig = array(
            'authentication'
        );
        if (!isset($matchedRoute) || in_array($matchedRoute->getMatchedRouteName(), $allowedRoutesConfig)) {
            // no auth check required
            return;
        }
        
        $seviceManager   = $e->getApplication()->getServiceManager();
        $authenticationService = $seviceManager->get(AuthenticationService::class);
        $identity = $authenticationService->getIdentity();
        if (! $identity) {
            //redirect to login route...
            $response = $e->getResponse();
            $response->setStatusCode(302);
            //this is the login screen redirection url
            $url = $e->getRequest()->getBaseUrl() . '/auth';
            $response->getHeaders()->addHeaderLine('Location', $url);
            $app = $e->getTarget();
            //dont do anything other - just finish here
            //$app->getEventManager()->trigger(MvcEvent::EVENT_FINISH, $e);
            //$e->stopPropagation(true);
        }
    }
}
