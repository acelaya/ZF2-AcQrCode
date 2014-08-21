<?php
namespace Acelaya\QrCode\Test\Service\Factory;

use Acelaya\QrCode\Options\QrCodeOptions;
use Acelaya\QrCode\Service\Factory\QrCodeServiceFactory;
use Acelaya\QrCode\Test\Service\ServiceManagerMock;

/**
 * Class QrCodeServiceFactoryTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QrCodeServiceFactory
     */
    private $serviceFactory;

    public function setUp()
    {
        $this->serviceFactory = new QrCodeServiceFactory();
    }

    public function testCreateService()
    {
        $service = $this->serviceFactory->createService(new ServiceManagerMock(array(
            'Acelaya\QrCode\Options\QrCodeOptions' => new QrCodeOptions()
        )));
        $this->assertInstanceOf('Acelaya\QrCode\Service\QrCodeService', $service);
    }

    /**
     * @expectedException \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function testCreateServiceWithNoOptionsThrowsException()
    {
        $this->serviceFactory->createService(new ServiceManagerMock());
    }
}
