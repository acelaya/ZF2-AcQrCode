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
    const DEFAULT_PADDING   = 10;

    /**
     * Generates the content-type corresponding to the provided extension
     * @param $extension
     * @return string
     * @throws InvalidExtensionException
     */
    public function generateContentType($extension);

    /**
     * Returns a QrCode content to be rendered or saved.
     * If the first argument is a Params object, all the information will be tried to be fetched for it,
     * ignoring any other argument
     * @param string|Params $messageOrParams
     * @param string $extension
     * @param int $size
     * @param int $padding
     * @return mixed
     */
    public function getQrCodeContent($messageOrParams, $extension = null, $size = null, $padding = null);
}
