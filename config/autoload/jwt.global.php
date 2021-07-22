<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

return [
    'jwt' => [
        'secret' => getenv('APP_SECRET'),
        'algorithm' => 'HS512'
    ]
];