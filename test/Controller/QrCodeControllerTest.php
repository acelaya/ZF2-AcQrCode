<?php
namespace Acelaya\QrCode\Test\Controller;

use Acelaya\QrCode\Controller\QrCodeController;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Acelaya\QrCode\Test\Service\QrCodeServiceMock;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\Controller\PluginManager as ControllerPluginManager;

/**
 * Class QrCodeControllerTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeControllerTest extends \PHPUnit_Framework_TestCase
{
    const CONTENT = 'FooBarContent';

    /**
     * @var QrCodeController
     */
    private $controller;

    public function setUp()
    {
        $this->controller = new QrCodeController($this->createQrCodeService());
    }

    public function testQrCodeServiceAwareness()
    {
        $newService = $this->createQrCodeService();
        $this->assertTrue($this->controller->getQrCodeService() instanceof QrCodeServiceInterface);
        $this->assertNotSame($newService, $this->controller->getQrCodeService());
        $this->controller->setQrCodeService($newService);
        $this->assertSame($newService, $this->controller->getQrCodeService());
    }

    public function testGenerateAction()
    {
        $this->controller->setPluginManager($this->generatePluginManager());
        /** @var HttpResponse $response */
        $response = $this->controller->generateAction();
        $this->assertTrue($response instanceof HttpResponse);
        $this->assertEquals(self::CONTENT, $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());

        $headers = $response->getHeaders()->toArray();
        $this->assertArrayHasKey('Content-Length', $headers);
        $this->assertArrayHasKey('Content-Type', $headers);
        $this->assertEquals(strlen(self::CONTENT), $headers['Content-Length']);
        $this->assertEquals($this->controller->getQrCodeService()->generateContentType(''), $headers['Content-Type']);
    }

    /**
     * @return QrCodeServiceInterface
     */
    private function createQrCodeService()
    {
        return new QrCodeServiceMock(self::CONTENT);
    }

    private function generatePluginManager()
    {
        $pluginManager = new ControllerPluginManager();
        $pluginManager->setInvokableClass('params', 'Acelaya\QrCode\Test\Controller\Plugin\ParamsMock');
        return $pluginManager;
    }
}
