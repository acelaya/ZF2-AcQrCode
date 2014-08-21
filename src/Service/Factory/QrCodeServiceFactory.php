<?php
namespace Acelaya\QrCode\Service\Factory;

use Acelaya\QrCode\Options\QrCodeOptions;
use Acelaya\QrCode\Service\QrCodeService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class QrCodeServiceFactory
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var QrCodeOptions $options */
        $options = $serviceLocator->get('Acelaya\QrCode\Options\QrCodeOptions');
        return new QrCodeService($options);
    }
}
