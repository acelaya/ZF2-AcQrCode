<?php
namespace Acelaya\QrCode\View\Helper;

use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Renderer\RendererInterface;

/**
 * Class QrCodeHelper
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeHelper extends AbstractHelper implements QrCodeHelperInterface
{
    const IMG_TEMPLATE          = 'acelaya/qr-code/image';
    const IMG_BASE64_TEMPLATE   = 'acelaya/qr-code/image-base64';

    /**
     * @var RendererInterface
     */
    protected $renderer;
    /**
     * @var RouteStackInterface
     */
    protected $router;
    /**
     * @var QrCodeServiceInterface
     */
    protected $qrCodeService;
    /**
     * @var array
     */
    protected $routeOptions = array();

    /**
     * @param RendererInterface $renderer
     * @param RouteStackInterface $router
     * @param QrCodeServiceInterface $qrCodeService
     */
    public function __construct(
        RendererInterface $renderer,
        RouteStackInterface $router,
        QrCodeServiceInterface $qrCodeService
    ) {
        $this->renderer         = $renderer;
        $this->router           = $router;
        $this->qrCodeService    = $qrCodeService;
    }

    /**
     * Returns this if no params are provided, and returns a URL route otherwise
     * @param null $message
     * @param null $extension
     * @param null $size
     * @param null $padding
     * @return $this|mixed
     */
    public function __invoke($message = null, $extension = null, $size = null, $padding = null)
    {
        if (
            count(func_get_args()) == 0
            || ((!isset($message) && !isset($extension) && !isset($size) && !isset($padding)))
        ) {
            return $this;
        }

        return $this->assembleRoute($message, $extension, $size, $padding);
    }

    /**
     * Renders a img tag pointing defined QR code
     * @param string $message
     * @param string|null $extension
     * @param int|null $size
     * @param null $padding
     * @param array $attribs
     * @return string
     */
    public function renderImg($message, $extension = null, $size = null, $padding = null, $attribs = array())
    {
        if (isset($extension)) {
            if (is_array($extension)) {
                $attribs = $extension;
                $extension = null;
            } elseif (isset($size)) {
                if (is_array($size)) {
                    $attribs = $size;
                    $size = null;
                } elseif (isset($padding) && is_array($padding)) {
                    $attribs = $padding;
                    $padding = null;
                }
            }
        }

        return $this->renderer->render(self::IMG_TEMPLATE, array(
            'src'       => $this->assembleRoute($message, $extension, $size, $padding),
            'attribs'   => $attribs
        ));
    }

    /**
     * Renders a img tag with a base64-encoded QR code
     * @param string $message
     * @param string|null $extension
     * @param int|null $size
     * @param null $padding
     * @param array $attribs
     * @return mixed
     */
    public function renderBase64Img($message, $extension = null, $size = null, $padding = null, $attribs = array())
    {
        if (isset($extension)) {
            if (is_array($extension)) {
                $attribs = $extension;
                $extension = null;
            } elseif (isset($size)) {
                if (is_array($size)) {
                    $attribs = $size;
                    $size = null;
                } elseif (isset($padding) && is_array($padding)) {
                    $attribs = $padding;
                    $padding = null;
                }
            }
        }

        $image          = $this->qrCodeService->getQrCodeContent($message, $extension, $size, $padding);
        $contentType    = $this->qrCodeService->generateContentType(
            isset($extension) ? $extension : QrCodeServiceInterface::DEFAULT_EXTENSION
        );

        return $this->renderer->render(self::IMG_BASE64_TEMPLATE, array(
            'base64'        => base64_encode($image),
            'contentType'   => $contentType,
            'attribs'       => $attribs
        ));
    }

    /**
     * Returns the assembled route as string
     * @param $message
     * @param null $extension
     * @param null $size
     * @param null $padding
     * @return mixed
     */
    public function assembleRoute($message, $extension = null, $size = null, $padding = null)
    {
        $params = array('message' => $message);
        if (isset($extension)) {
            $params['extension'] = $extension;
            if (isset($size)) {
                $params['size'] = $size;
                if (isset($padding)) {
                    $params['padding'] = $padding;
                }
            }
        }

        $this->routeOptions['name'] = 'acelaya-qrcode';
        return $this->router->assemble($params, $this->routeOptions);
    }

    /**
     * Allows you to set aditional options when creating the QR code route
     * @param array $routeOptions
     * @return $this
     */
    public function setRouteOptions(array $routeOptions)
    {
        $this->routeOptions = $routeOptions;
        return $this;
    }
}
