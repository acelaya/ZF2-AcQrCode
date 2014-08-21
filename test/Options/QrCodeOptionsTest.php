<?php
namespace Acelaya\QrCode\Test\Options;

use Acelaya\QrCode\Options\QrCodeOptions;

/**
 * Class QrCodeOptionsTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QrCodeOptions
     */
    private $options;

    public function setUp()
    {
        $this->options = new QrCodeOptions();
    }

    public function testArrayPopulation()
    {
        $data = array(
            'size' => 10,
            'padding' => 20,
            'extension' => 'png'
        );
        $this->options->setFromArray($data);

        $this->assertEquals($data['size'], $this->options->getSize());
        $this->assertEquals($data['padding'], $this->options->getPadding());
        $this->assertEquals($data['extension'], $this->options->getExtension());
    }

    /**
     * @expectedException \Acelaya\QrCode\Exception\InvalidExtensionException
     */
    public function testInvalidExtensionThrowsException()
    {
        $this->options->setExtension('foobar');
    }

    public function testIntegerCast()
    {
        $size = '10';
        $this->options->setSize($size);
        $this->assertEquals($size, $this->options->getSize());
        $this->assertNotSame($size, $this->options->getSize());
        $this->assertSame((int) $size, $this->options->getSize());

        $padding = '50';
        $this->options->setPadding($padding);
        $this->assertEquals($padding, $this->options->getPadding());
        $this->assertNotSame($padding, $this->options->getPadding());
        $this->assertSame((int) $padding, $this->options->getPadding());
    }
}
