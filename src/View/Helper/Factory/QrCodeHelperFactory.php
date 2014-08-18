<?php
namespace Acelaya\QrCode\View\Helper\Factory;

use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Acelaya\QrCode\View\Helper\QrCodeHelper;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class QrCodeHelperFactory
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeHelperFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var HelperPluginManager $serviceLocator */
        $renderer = $serviceLocator->getServiceLocator()->has('viewrenderer') ?
                    $serviceLocator->getServiceLocator()->get('viewrenderer') :
                    new PhpRenderer();
        /** @var RouteStackInterface $router */
        $router = $serviceLocator->getServiceLocator()->get('router');
        /** @var QrCodeServiceInterface $service */
        $service = $serviceLocator->getServiceLocator()->get('Acelaya\QrCode\Service\QrCodeService');
        return new QrCodeHelper($renderer, $router, $service);
    }
}
