<?php
namespace Acelaya\QrCode\Service;

use Acelaya\QrCode\Exception\InvalidExtensionException;
use Endroid\QrCode\QrCode;
use Zend\Mvc\Controller\Plugin\Params;

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
     * If the first argument is a Params object, all the information will be tried to be fetched for it,
     * ignoring any other argument
     * @param string|Params $messageOrParams
     * @param string $extension
     * @param int $size
     * @param int $padding
     * @return mixed
     */
    public function getQrCodeContent(
        $messageOrParams,
        $extension = self::DEFAULT_EXTENSION,
        $size = self::DEFAULT_SIZE,
        $padding = self::DEFAULT_PADDING
    ) {
        if ($messageOrParams instanceof Params) {
            $extension          = $messageOrParams->fromRoute('extension', QrCodeServiceInterface::DEFAULT_EXTENSION);
            $size               = $messageOrParams->fromRoute('size', QrCodeServiceInterface::DEFAULT_SIZE);
            $messageOrParams    = $messageOrParams->fromRoute('message');
        }

        $qrCode = new QrCode($messageOrParams);
        $qrCode->setImageType(isset($extension) ? $extension : self::DEFAULT_EXTENSION);
        $qrCode->setSize(isset($size) ? $size : self::DEFAULT_SIZE);
        return $qrCode->get();
    }
}
