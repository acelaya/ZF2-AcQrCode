<?php
namespace Acelaya\QrCode\Service;

use Acelaya\QrCode\Exception\InvalidExtensionException;
use Acelaya\QrCode\Options\QrCodeOptions;
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
     * @var QrCodeOptions
     */
    protected $options;

    /**
     * @param QrCodeOptions $options
     */
    public function __construct(QrCodeOptions $options)
    {
        $this->options = $options;
    }

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
    public function getQrCodeContent($messageOrParams, $extension = null, $size = null, $padding = null)
    {
        if ($messageOrParams instanceof Params) {
            $extension          = $messageOrParams->fromRoute('extension', $this->options->getExtension());
            $size               = $messageOrParams->fromRoute('size', $this->options->getSize());
            $padding            = $messageOrParams->fromRoute('padding', $this->options->getPadding());
            $messageOrParams    = $messageOrParams->fromRoute('message');
        } else {
            $extension  = isset($extension) ? $extension : $this->options->getExtension();
            $size       = isset($size) ? $size : $this->options->getSize();
            $padding    = isset($padding) ? $padding : $this->options->getPadding();
        }

        $qrCode = new QrCode($messageOrParams);
        $qrCode->setImageType($extension);
        $qrCode->setSize($size);
        $qrCode->setPadding($padding);
        return $qrCode->get();
    }
}
