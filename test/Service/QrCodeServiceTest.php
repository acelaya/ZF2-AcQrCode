<?php
namespace Acelaya\QrCode\Test;

use Acelaya\QrCode\Options\QrCodeOptions;
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
    /**
     * @var QrCodeOptions
     */
    private $qrCodeOptions;

    public function setUp()
    {
        $this->qrCodeOptions = new QrCodeOptions();
        $this->qrCodeService = new QrCodeService($this->qrCodeOptions);
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
        $qrCode->setSize($this->qrCodeOptions->getSize());
        $qrCode->setPadding($this->qrCodeOptions->getPadding());
        $qrCode->setImageType($this->qrCodeOptions->getExtension());
        $this->assertEquals($qrCode->get(), $this->qrCodeService->getQrCodeContent('FooBar'));

        $qrCode = new QrCode('www.google.com');
        $qrCode->setImageType('png');
        $qrCode->setSize(500);
        $qrCode->setPadding($this->qrCodeOptions->getPadding());
        $this->assertEquals($qrCode->get(), $this->qrCodeService->getQrCodeContent('www.google.com', 'png', 500));

        $qrCode = new QrCode('http://www.alejandrocelaya.com');
        $qrCode->setImageType('png');
        $qrCode->setSize(500);
        $qrCode->setPadding(50);
        $this->assertEquals(
            $qrCode->get(),
            $this->qrCodeService->getQrCodeContent('http://www.alejandrocelaya.com', 'png', 500, 50)
        );
    }

    public function testGetQrCodeWithParams()
    {
        $params = new Params();
        $routeParams = array(
            'extension' => 'png',
            'size'      => 123,
            'message'   => 'this is a long message',
            'padding'   => 10
        );
        $params->setController(new ControllerMock($routeParams));

        $qrCode = new QrCode($routeParams['message']);
        $qrCode->setImageType($routeParams['extension']);
        $qrCode->setSize($routeParams['size']);
        $qrCode->setPadding($routeParams['padding']);
        $this->assertEquals($qrCode->get(), $this->qrCodeService->getQrCodeContent($params));
    }
}
