<?php
namespace Acelaya\QrCode\Test\Controller\Factory;

use Acelaya\QrCode\Controller\Factory\QrCodeControllerFactory;
use Acelaya\QrCode\Controller\QrCodeController;
use Acelaya\QrCode\Test\Service\QrCodeServiceMock;
use Acelaya\QrCode\Test\Service\ServiceManagerMock;

/**
 * Class QrCodeControllerFactoryTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QrCodeControllerFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new QrCodeControllerFactory();
    }

    public function testCreateService()
    {
        $service = $this->factory->createService($this->createServiceManager());
        $this->assertTrue($service instanceof QrCodeController);
        $this->assertTrue($service->getQrCodeService() instanceof QrCodeServiceMock);
    }

    private function createServiceManager()
    {
        return new ServiceManagerMock(array(
            'Acelaya\QrCode\Service\QrCodeService' => new QrCodeServiceMock('foobar')
        ));
    }
}
