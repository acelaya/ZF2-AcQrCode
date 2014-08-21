<?php
namespace Acelaya\QrCode\Options\Factory;

use Acelaya\QrCode\Options\QrCodeOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class QrCodeOptionsFactory
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeOptionsFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return new QrCodeOptions(isset($config['qr_code_options']) ? $config['qr_code_options'] : array());
    }
}
