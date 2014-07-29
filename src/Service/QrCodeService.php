<?php
namespace Acelaya\QrCode\Service;

use Acelaya\QrCode\Exception\InvalidExtensionException;
use Endroid\QrCode\QrCode;

/**
 * Class QrCodeService
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeService implements QrCodeServiceInterface
{
    /**
     * Generates the content-type corresponding to the provided extension
     * @param $extension
     * @return string
     * @throws InvalidExtensionException
     */
    public function generateContentType($extension)
    {
        if (!in_array($extension, InvalidExtensionException::getValidExtensions())) {
            throw InvalidExtensionException::fromExtension($extension);
        }

        return sprintf('image/%s', $extension == self::DEFAULT_EXTENSION ? 'jpeg' : $extension);
    }

    /**
     * Returns a QrCode content to be rendered or saved
     * @param $message
     * @param string $extension
     * @param int $size
     * @return mixed
     */
    public function getQrCodeContent($message, $extension = self::DEFAULT_EXTENSION, $size = self::DEFAULT_SIZE)
    {
        $qrCode = new QrCode($message);
        $qrCode->setImageType($extension);
        $qrCode->setSize($size);
        return $qrCode->get();
    }
}
