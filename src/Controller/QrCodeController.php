<?php
namespace Acelaya\QrCode\Controller;

use Acelaya\QrCode\Service\QrCodeServiceAwareInterface;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class QrCodeController
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class QrCodeController extends AbstractActionController implements QrCodeServiceAwareInterface
{
    /**
     * @var QrCodeServiceInterface
     */
    protected $qrCodeService;

    public function __construct(QrCodeServiceInterface $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Generates the QR code and returns it as stream
     */
    public function generateAction()
    {
        $message    = $this->params()->fromRoute('message');
        $extension  = $this->params()->fromRoute('extension', QrCodeServiceInterface::DEFAULT_EXTENSION);
        $size       = $this->params()->fromRoute('size', QrCodeServiceInterface::DEFAULT_SIZE);

        $content    = $this->qrCodeService->getQrCodeContent($message, $extension, $size);
        $resp       =  new HttpResponse();

        $resp->setStatusCode(200)
             ->setContent($content);
        $resp->getHeaders()->addHeaders(array(
            'Content-Length'    => strlen($content),
            'Content-Type'      => $this->qrCodeService->generateContentType($extension)
        ));
        return $resp;
    }

    /**
     * @param QrCodeServiceInterface $qrCodeService
     * @return void
     */
    public function setQrCodeService(QrCodeServiceInterface $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * @return QrCodeServiceInterface
     */
    public function getQrCodeService()
    {
        return $this->qrCodeService;
    }
}
