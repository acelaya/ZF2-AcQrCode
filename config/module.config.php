<?php
return array(

    'controllers' => array(
        'factory' => array(
            'Acelaya\QrCode\Controller\QrCode' => 'Acelaya\QrCode\Controller\Factory\QrCodeControllerFactory',
        )
    ),

    'router' => array(
        'routes' => array(

            'acelaya-qrcode' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/qrcode/generate/:message[.:extension[/:size]]',
                    'constraints' => array(
                        'extension' => 'jpg|png|gif',
                        'size' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Acelaya\QrCode\Controller\QrCode',
                        'action' => 'generate'
                    )
                )
            )

        )
    )

);
