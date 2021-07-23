<?php

declare(strict_types=1);

use Laminas\ServiceManager\ServiceManager;

$config  = require realpath(__DIR__) . '/config.php';
$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);
