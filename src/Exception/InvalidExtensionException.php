<?php
namespace Acelaya\QrCode\Exception;

use Endroid\QrCode\QrCode;

/**
 * Class InvalidExtensionException
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class InvalidExtensionException extends \Exception
{
    /**
     * @var array
     */
    private static $validExtensions = array(
        'jpg',
        'jpeg',
        'png',
        'gif'
    );

    public static function getValidExtensions()
    {
        return static::$validExtensions;
    }

    public static function fromExtension($extension)
    {
        return new self(sprintf(
            "Provided extension '%s' is not valid. Expected one of '%s'",
            $extension,
            implode("', '", static::getValidExtensions())
        ));
    }
}
