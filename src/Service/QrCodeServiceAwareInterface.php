<?php
namespace Acelaya\QrCode\Service;

/**
 * Interface QrCodeServiceAwareInterface
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
interface QrCodeServiceAwareInterface
{
    /**
     * @param QrCodeServiceInterface $qrCodeService
     * @return void
     */
    public function setQrCodeService(QrCodeServiceInterface $qrCodeService);

    /**
     * @return QrCodeServiceInterface
     */
    public function getQrCodeService();
}
