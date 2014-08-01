<?php
namespace Acelaya\QrCode\Test\Exception;

use Acelaya\QrCode\Exception\InvalidExtensionException;

/**
 * Class InvalidExtensionExceptionTest
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class InvalidExtensionExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValidExtensions()
    {
        $this->assertTrue(is_array(InvalidExtensionException::getValidExtensions()));
        $this->assertCount(4, InvalidExtensionException::getValidExtensions());
    }

    public function testFromExtension()
    {
        $exception = InvalidExtensionException::fromExtension('foo');
        $this->assertTrue($exception instanceof InvalidExtensionException);
    }
}
