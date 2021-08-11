<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

return [
    'mailer' => [
        'host' => getenv('MAILER_HOST'),
        'port' => getenv('MAILER_PORT'),
        'user' => getenv('MAILER_USERNAME'),
        'password' => getenv('MAILER_PASSWORD'),
        'encryption' => getenv('MAILER_ENCRYPTION'),
    ]
];