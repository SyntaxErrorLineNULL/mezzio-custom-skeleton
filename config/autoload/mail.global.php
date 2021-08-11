<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

return [
    'mailer' => [
        'host' => $_ENV['MAILER_HOST'],
        'port' => (int)$_ENV['MAILER_PORT'],
        'user' => $_ENV['MAILER_USERNAME'],
        'password' => $_ENV['MAILER_PASSWORD'],
        'encryption' => $_ENV['MAILER_ENCRYPTION']
    ]
];