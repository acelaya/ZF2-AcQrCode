<?php
namespace Acelaya\QrCode\Test;

use Acelaya\QrCode\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class ModuleTest extends TestCase
{
    /**
     * @var Module
     */
    private $module;

    public function setUp()
    {
        $this->module = new Module();
    }

    public function testGetConfig()
    {
        $config = $this->module->getConfig();
        $this->assertTrue(is_array($config));
        $this->assertArrayHasKey('controllers', $config);
        $this->assertArrayHasKey('router', $config);
        $this->assertArrayHasKey('service_manager', $config);
        $this->assertArrayHasKey('view_helpers', $config);
        $this->assertArrayHasKey('view_manager', $config);
        $this->assertEquals(include __DIR__ . '/../config/module.config.php', $config);
    }
}
