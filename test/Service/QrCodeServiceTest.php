<?php
namespace Acelaya\QrCode\Test;

use Acelaya\QrCode\Service\QrCodeService;

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
}
