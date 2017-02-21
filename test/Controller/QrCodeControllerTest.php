<?php
namespace Acelaya\QrCode\Test\Controller;

use Acelaya\QrCode\Controller\QrCodeController;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Acelaya\QrCode\Test\Controller\Plugin\ParamsMock;
use Acelaya\QrCode\Test\Service\QrCodeServiceMock;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\Controller\PluginManager as ControllerPluginManager;

/**
 * Class QrCodeControllerTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeControllerTest extends TestCase
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
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('params')->willReturn(new ParamsMock());
        $pluginManager = new ControllerPluginManager($container->reveal());
        $pluginManager->setInvokableClass('params', 'Acelaya\QrCode\Test\Controller\Plugin\ParamsMock');
        return $pluginManager;
    }
}
