<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\HTTP\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SELN\App\Core\Authentication\JWTService;
use SELN\App\Core\Authentication\Passport\Exception\DecodeException;
use SELN\App\Core\Authentication\Passport\Passport;

class AuthenticationMiddleware implements MiddlewareInterface
{
    private const HEADER = 'Authorization';

    public function __construct(private JWTService $service) {}

    private function identity(ServerRequestInterface $request, string $token): ServerRequestInterface
    {
        try {
            $response = $this->service->decode($token);
            return $request->withAttribute(Passport::ATTRIBUTE, new Passport($response->id));
        } catch (\Throwable) {
            throw new DecodeException('Token decryption errors');
        }
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->hasHeader(self::HEADER)) {
            $token = $request->getHeaderLine(self::HEADER);
            $response = $this->identity($request, $token);
        } else {
            $response = $request->withAttribute(Passport::ATTRIBUTE, new Passport(null));
        }

        return $handler->handle($response);
    }
}