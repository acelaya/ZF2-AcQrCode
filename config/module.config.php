<?php
return [

    'controllers' => [
        'factories' => [
            'Acelaya\QrCode\Controller\QrCode' => 'Acelaya\QrCode\Controller\Factory\QrCodeControllerFactory',
        ],
    ],

    'router' => [
        'routes' => [

            'acelaya-qrcode' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/qr-code/generate/:message[/:extension][/:size][/:padding]',
                    'constraints' => [
                        'extension' => 'jpeg|png|gif',
                        'size' => '[0-9]+',
                        'padding' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Acelaya\QrCode\Controller\QrCode',
                        'action' => 'generate',
                        'extension' => 'jpeg',
                    ],
                ],
            ],

        ],
    ],

    'service_manager' => [
        'factories' => [
            'Acelaya\QrCode\Service\QrCodeService' => 'Acelaya\QrCode\Service\Factory\QrCodeServiceFactory',
            'Acelaya\QrCode\Options\QrCodeOptions' => 'Acelaya\QrCode\Options\Factory\QrCodeOptionsFactory',
        ],
    ],

    'view_helpers' => [
        'factories' => [
            'qrCode' => 'Acelaya\QrCode\View\Helper\Factory\QrCodeHelperFactory',
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'acelaya/qr-code/image'         => __DIR__ . '/../view/acelaya/qr-code/image.phtml',
            'acelaya/qr-code/image-base64'  => __DIR__ . '/../view/acelaya/qr-code/image-base64.phtml',
        ],
    ],

];
