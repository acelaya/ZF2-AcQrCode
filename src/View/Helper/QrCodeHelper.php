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
class QrCodeHelper extends AbstractHelper
{
    /**
     * @var RendererInterface
     */
    protected $renderer;
    /**
     * @var RouteStackInterface
     */
    protected $router;
    /**
     * @var array
     */
    protected $routeOptions = array();

    public function __construct(RendererInterface $renderer, RouteStackInterface $router)
    {
        $this->renderer = $renderer;
        $this->router   = $router;
    }

    public function __invoke($message = null, $extension = null, $size = null)
    {
        if (count(func_get_args()) == 0 || (!isset($message) && !isset($extension) && !isset($size))) {
            return $this;
        }

        return $this->getRoute($message, $extension, $size);
    }

    /**
     * Renders a img tag pointing defined QR code
     * @param null $message
     * @param null $extension
     * @param null $size
     * @param array $attribs
     * @return string
     */
    public function renderImg($message = null, $extension = null, $size = null, $attribs = array())
    {
        return $this->renderer->render('acelaya/qr-code/image', array(
            'src' => $this->getRoute($message, $extension, $size),
            'attribs' => $attribs
        ));
    }

    /**
     * Returns the assembled route as string
     * @param $message
     * @param null $extension
     * @param null $size
     * @return mixed
     */
    public function getRoute($message, $extension = null, $size = null)
    {
        $params = array('message' => $message);
        if (isset($extension)) {
            $params['extension'] = $extension;
            if (isset($size)) {
                $params['size'] = $size;
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
