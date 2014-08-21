<?php
namespace Acelaya\QrCode\Options;

use Acelaya\QrCode\Exception\InvalidExtensionException;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Zend\Stdlib\AbstractOptions;

/**
 * Class QrCodeOptions
 * @author ALejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeOptions extends AbstractOptions
{
    /**
     * @var array
     */
    private $validExtensions = array('jpg', 'jpeg', 'png', 'gif');

    /**
     * @var string
     */
    protected $extension = QrCodeServiceInterface::DEFAULT_EXTENSION;
    /**
     * @var int
     */
    protected $size = QrCodeServiceInterface::DEFAULT_SIZE;
    /**
     * @var int
     */
    protected $padding = QrCodeServiceInterface::DEFAULT_PADDING;

    /**
     * @param string $extension
     * @return $this
     * @throws InvalidExtensionException
     */
    public function setExtension($extension)
    {
        if (!in_array($extension, $this->validExtensions)) {
            throw InvalidExtensionException::fromExtension($extension);
        }

        $this->extension = $extension;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param int $padding
     * @return $this;
     */
    public function setPadding($padding)
    {
        $this->padding = (int) $padding;
        return $this;
    }

    /**
     * @return int
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * @param int $size
     * @return $this;
     */
    public function setSize($size)
    {
        $this->size = (int) $size;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}
