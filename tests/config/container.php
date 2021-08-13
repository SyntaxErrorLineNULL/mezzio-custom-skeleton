<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

use Laminas\ConfigAggregator\ArrayProvider,
    Laminas\ConfigAggregator\ConfigAggregator,
    Laminas\ServiceManager\ServiceManager;

$appConfig = require __DIR__ . '/../../config/config.php';

$configAggregator = new ConfigAggregator([
    new ArrayProvider($appConfig),
    new ArrayProvider([
        'jwt' => [
            'secret' => 'secret-jwt',
        ]
    ])
]);

$config = $configAggregator->getMergedConfig();

$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

return new ServiceManager($dependencies);