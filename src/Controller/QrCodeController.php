<?php
namespace Acelaya\QrCode\Controller;

use Acelaya\QrCode\Service\QrCodeServiceAwareInterface;
use Acelaya\QrCode\Service\QrCodeServiceInterface;
use Zend\Http\Response\Stream as StreamResponse;
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
        return new StreamResponse();
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
