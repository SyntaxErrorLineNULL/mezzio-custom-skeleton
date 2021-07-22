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
     * @param string $algorithm
     */
    public function __construct(public string $secret, public string $algorithm = 'HS512') {}

    public function encode(array $value): string
    {
        return JWT::encode($value, $this->secret, $this->algorithm);
    }

    public function decode(string $key): object
    {
        return JWT::decode($key, $this->secret, [$this->algorithm]);
    }
}