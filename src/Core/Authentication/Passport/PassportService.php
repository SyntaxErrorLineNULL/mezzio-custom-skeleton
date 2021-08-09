<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Authentication\Passport;

use Psr\Http\Message\ServerRequestInterface;
use SELN\App\Core\Authentication\JWTService;

class PassportService
{

    public function __construct(private JWTService $JWTService){}

    private function fetchToken(ServerRequestInterface $request): string
    {

    }

    private function decodeToken(string $header)
    {

    }
}