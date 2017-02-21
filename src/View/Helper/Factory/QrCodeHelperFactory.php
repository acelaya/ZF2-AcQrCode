<?php
namespace Acelaya\QrCode\View\Helper\Factory;

use Acelaya\QrCode\Service\QrCodeService;
use Acelaya\QrCode\View\Helper\QrCodeHelper;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Router\RouteStackInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class QrCodeHelperFactory
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeHelperFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $renderer = $container->has('viewrenderer') ? $container->get('viewrenderer') : new PhpRenderer();
        /** @var RouteStackInterface $router */
        $router = $container->get('router');
        $service = $container->get(QrCodeService::class);
        return new QrCodeHelper($renderer, $router, $service);
    }
}
