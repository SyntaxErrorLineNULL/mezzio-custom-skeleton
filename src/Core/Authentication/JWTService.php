<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Authentication;


use Firebase\JWT\JWT;

class JWTService
{
    /**
     * JWTService constructor.
     * @param string $secret
     */
    public function __construct(public string $secret) {}

    public function encode(array $value): string
    {
        return JWT::encode($value, $this->secret, 'HS512');
    }

    public function decode(string $key): object
    {
        return JWT::decode($key, $this->secret, ['HS512']);
    }
}