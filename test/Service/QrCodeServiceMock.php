<?php
namespace Acelaya\QrCode\Test\Service;

use Acelaya\QrCode\Exception\InvalidExtensionException;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Zend\Mvc\Controller\Plugin\Params;

/**
 * Class QrCodeServiceMock
 * @author
 * @link
 */
class QrCodeServiceMock implements QrCodeServiceInterface
{
    private $content;

    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Generates the content-type corresponding to the provided extension
     * @param $extension
     * @return string
     * @throws InvalidExtensionException
     */
    public function generateContentType($extension)
    {
        return 'image/foo';
    }

    /**
     * Returns a QrCode content to be rendered or saved
     * If the first argument is a Params object, all the information will be tried to be fetched for it,
     * ignoring any other argument
     * @param string|Params $messageOrParams
     * @param string $extension
     * @param int $size
     * @param int $padding
     * @return mixed
     */
    public function getQrCodeContent($messageOrParams, $extension = null, $size = null, $padding = null)
    {
        return $this->content;
    }
}
