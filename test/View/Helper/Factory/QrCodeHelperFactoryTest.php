<?php
namespace Acelaya\QrCode\Test\View\Helper\Factory;

use Acelaya\QrCode\Test\Service\QrCodeServiceMock;
use Acelaya\QrCode\Test\Service\ServiceManagerMock;
use Acelaya\QrCode\View\Helper\Factory\QrCodeHelperFactory;
use Acelaya\QrCode\View\Helper\QrCodeHelper;
use Zend\Mvc\Router\Http\TreeRouteStack;

/**
 * Class QrCodeHelperFactoryTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeHelperFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QrCodeHelperFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new QrCodeHelperFactory();
    }

    public function testCreateService()
    {
        $helper = $this->factory->createService($this->createServiceManager());
        $this->assertTrue($helper instanceof QrCodeHelper);
    }

    private function createServiceManager()
    {
        return new ServiceManagerMock(array(
            'router' => new TreeRouteStack(),
            'Acelaya\QrCode\Service\QrCodeService' => new QrCodeServiceMock()
        ));
    }
}
