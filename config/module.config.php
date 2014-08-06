<?php
return array(

    'controllers' => array(
        'factories' => array(
            'Acelaya\QrCode\Controller\QrCode' => 'Acelaya\QrCode\Controller\Factory\QrCodeControllerFactory',
        )
    ),

    'router' => array(
        'routes' => array(

            'acelaya-qrcode' => array(
                'type' => 'Segment',
                'options' => array(
                    //'route' => '/qr-code/generate/:message[.:extension[/:size]]',
                    'route' => '/qr-code/generate/:message[[.][:extension][/:size]]',
                    'constraints' => array(
                        'extension' => 'jpg|jpeg|png|gif',
                        'size' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Acelaya\QrCode\Controller\QrCode',
                        'action' => 'generate',
                        'extension' => 'jpg'
                    )
                )
            )

        )
    ),

    'service_manager' => array(
        'invokables' => array(
            'Acelaya\QrCode\Service\QrCodeService' => 'Acelaya\QrCode\Service\QrCodeService'
        )
    ),

    'view_helpers' => array(
        'factories' => array(
            'qrCode' => 'Acelaya\QrCode\View\Helper\Factory\QrCodeHelperFactory',
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'acelaya/qr-code/image' => __DIR__ . '/../view/acelaya/qr-code/image.phtml'
        )
    )

);
