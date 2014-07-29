<?php
namespace Acelaya\QrCode\Controller\Factory;

use Acelaya\QrCode\Controller\QrCodeController;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class QrCodeControllerFactory
 * @author
 * @link
 */
class QrCodeControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var QrCodeServiceInterface $qrCodeService */
        $qrCodeService = $serviceLocator->get('Acelaya\QrCode\Service\QrCodeService');
        return new QrCodeController($qrCodeService);
    }
}
