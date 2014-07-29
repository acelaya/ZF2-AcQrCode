<?php
namespace Acelaya\QrCode\View\Helper;

use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Zend\View\Helper\AbstractHelper;

/**
 * Class QrCodeHelper
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeHelper extends AbstractHelper
{
    public function __invoke(
        $message = null,
        $extension = null,
        $size = null
    ) {
        if (count(func_get_args()) == 0 || (!isset($message) && !isset($extension) && !isset($size))) {
            return $this;
        }

        return '';
    }

    /**
     * Renders a img tag pointing defined QR code
     * @param string $message
     * @param string $extension
     * @param int $size
     * @param array $attribs Aditional attributes to be set to the img tag
     */
    public function renderImg(
        $message = null,
        $extension = null,
        $size = null,
        $attribs = array()
    ) {

    }
}
