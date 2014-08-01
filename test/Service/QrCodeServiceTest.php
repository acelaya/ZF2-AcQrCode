<?php
namespace Acelaya\QrCode\Test;

use Acelaya\QrCode\Service\QrCodeService;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Acelaya\QrCode\Test\Controller\ControllerMock;
use Endroid\QrCode\QrCode;
use Zend\Mvc\Controller\Plugin\Params;

/**
 * Class QrCodeServiceTest
 * @author
 * @link
 */
class QrCodeServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QrCodeService
     */
    private $qrCodeService;

    public function setUp()
    {
        $this->qrCodeService = new QrCodeService();
    }

    public function testContentTypes()
    {
        $this->assertEquals('image/png', $this->qrCodeService->generateContentType('png'));
        $this->assertEquals('image/gif', $this->qrCodeService->generateContentType('gif'));
        $this->assertEquals('image/jpeg', $this->qrCodeService->generateContentType('jpeg'));
        $this->assertEquals('image/jpeg', $this->qrCodeService->generateContentType('jpg'));
    }

    /**
     * @expectedException \Acelaya\QrCode\Exception\InvalidExtensionException
     */
    public function testInvalidExtension()
    {
        $this->qrCodeService->generateContentType('foobar');
    }

    public function testGetQrCodeContent()
    {
        $qrCode = new QrCode('FooBar');
        $qrCode->setImageType(QrCodeServiceInterface::DEFAULT_EXTENSION);
        $qrCode->setSize(QrCodeServiceInterface::DEFAULT_SIZE);
        $this->assertEquals($qrCode->get(), $this->qrCodeService->getQrCodeContent('FooBar'));

        $qrCode = new QrCode('www.google.com');
        $qrCode->setImageType('png');
        $qrCode->setSize(500);
        $this->assertEquals($qrCode->get(), $this->qrCodeService->getQrCodeContent('www.google.com', 'png', 500));
    }

    public function testGetQrCodeWithParams()
    {
        $params = new Params();
        $routeParams = array(
            'extension' => 'png',
            'size'      => 123,
            'message'   => 'this is a long message'
        );
        $params->setController(new ControllerMock($routeParams));

        $qrCode = new QrCode($routeParams['message']);
        $qrCode->setImageType($routeParams['extension']);
        $qrCode->setSize($routeParams['size']);
        $this->assertEquals($qrCode->get(), $this->qrCodeService->getQrCodeContent($params));
    }
}
