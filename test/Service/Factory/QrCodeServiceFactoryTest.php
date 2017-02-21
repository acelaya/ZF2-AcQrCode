<?php
namespace Acelaya\QrCode\Test\Service\Factory;

use Acelaya\QrCode\Options\QrCodeOptions;
use Acelaya\QrCode\Service\Factory\QrCodeServiceFactory;
use Acelaya\QrCode\Service\QrCodeService;
use Acelaya\QrCode\Test\Service\ServiceManagerMock;
use PHPUnit\Framework\TestCase;

/**
 * Class QrCodeServiceFactoryTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeServiceFactoryTest extends TestCase
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
        $service = $this->serviceFactory->__invoke(new ServiceManagerMock([
            QrCodeOptions::class => new QrCodeOptions()
        ]), '');
        $this->assertInstanceOf(QrCodeService::class, $service);
    }

    /**
     * @expectedException \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function testCreateServiceWithNoOptionsThrowsException()
    {
        $this->serviceFactory->__invoke(new ServiceManagerMock(), '');
    }
}
