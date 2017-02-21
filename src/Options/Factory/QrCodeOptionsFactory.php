<?php
namespace Acelaya\QrCode\Options\Factory;

use Acelaya\QrCode\Options\QrCodeOptions;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class QrCodeOptionsFactory
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeOptionsFactory implements FactoryInterface
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
        $config = $container->get('Config');
        return new QrCodeOptions(isset($config['qr_code_options']) ? $config['qr_code_options'] : []);
    }
}
