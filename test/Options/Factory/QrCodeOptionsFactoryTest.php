<?php
namespace Acelaya\QrCode\Test\Options\Factory;

use Acelaya\QrCode\Options\Factory\QrCodeOptionsFactory;
use Acelaya\QrCode\Test\Service\ServiceManagerMock;

/**
 * Class QrCodeOptionsFactoryTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QrCodeOptionsFactory
     */
    private $optionsFactory;

    public function setUp()
    {
        $this->optionsFactory = new QrCodeOptionsFactory();
    }

    public function testCreateService()
    {
        $sm = new ServiceManagerMock(array(
            'Config' => array()
        ));
        $options = $this->optionsFactory->createService($sm);
        $this->assertInstanceOf('Acelaya\QrCode\Options\QrCodeOptions', $options);
    }
}
