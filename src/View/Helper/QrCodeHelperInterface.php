<?php
namespace Acelaya\QrCode\View\Helper;

/**
 * Interface QrCodeHelperInterface
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
interface QrCodeHelperInterface
{
    /**
     * Returns this if no params are provided, and returns a URL route otherwise
     * @param null $message
     * @param null $extension
     * @param null $size
     * @param null $padding
     * @return $this|mixed
     */
    public function __invoke($message = null, $extension = null, $size = null, $padding = null);

    /**
     * Renders a img tag pointing defined QR code
     * @param string $message
     * @param string|null $extension
     * @param int|null $size
     * @param null $padding
     * @param array $attribs
     * @return string
     */
    public function renderImg($message, $extension = null, $size = null, $padding = null, $attribs = array());

    /**
     * Renders a img tag with a base64-encoded QR code
     * @param string $message
     * @param string|null $extension
     * @param int|null $size
     * @param null $padding
     * @param array $attribs
     * @return mixed
     */
    public function renderBase64Img($message, $extension = null, $size = null, $padding = null, $attribs = array());

    /**
     * Returns the assembled route as string
     * @param $message
     * @param null $extension
     * @param null $size
     * @param null $padding
     * @return mixed
     */
    public function assembleRoute($message, $extension = null, $size = null, $padding = null);

    /**
     * Allows you to set aditional options when creating the QR code route
     * @param array $routeOptions
     * @return $this
     */
    public function setRouteOptions(array $routeOptions);
}
