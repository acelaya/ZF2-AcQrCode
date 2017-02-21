<?php
namespace Acelaya\QrCode;

class ConfigProvider
{
    public function __invoke()
    {
        $moduleConfig = include __DIR__ . '/../config/module.config.php';
        return [
            'dependencies' => $moduleConfig['service_manager']
        ];
    }
}
