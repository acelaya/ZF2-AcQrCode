<?php
namespace Acelaya\QrCode\Service;

use Acelaya\QrCode\Exception\InvalidExtensionException;
use Zend\Mvc\Controller\Plugin\Params;

/**
 * Interface QrCodeServiceInterface
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
interface QrCodeServiceInterface
{
    const DEFAULT_EXTENSION = 'jpg';
    const DEFAULT_SIZE      = 200;

    /**
     * Generates the content-type corresponding to the provided extension
     * @param $extension
     * @return string
     * @throws InvalidExtensionException
     */
    public function generateContentType($extension);

    /**
     * Returns a QrCode content to be rendered or saved
     * @param string|Params $messageOrParams
     * @param string $extension
     * @param int $size
     * @return mixed
     */
    public function getQrCodeContent(
        $messageOrParams,
        $extension = self::DEFAULT_EXTENSION,
        $size = self::DEFAULT_SIZE
    );
}
