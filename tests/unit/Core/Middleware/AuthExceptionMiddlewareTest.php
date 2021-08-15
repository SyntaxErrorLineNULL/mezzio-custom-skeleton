<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Test\UnitTest\Core\Middleware;

use Codeception\Test\Unit;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Server\RequestHandlerInterface;
use SELN\App\Core\Authentication\Passport\Exception\DecodeException;
use SELN\App\Core\HTTP\Middleware\AuthExceptionMiddleware;
use SELN\App\Test\UnitTest\Core\UnitTemplate;

class AuthExceptionMiddlewareTest extends Unit implements UnitTemplate
{
    public function testSuccess(): void
    {
        $middleware = new AuthExceptionMiddleware();
        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn($source = (new ResponseFactory())->createResponse());

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://localhost');
        $response = $middleware->process($request, $handler);

        $this->assertEquals($source, $response);
    }

    public function testException(): void
    {
        $middleware = new AuthExceptionMiddleware();
        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willThrowException(new DecodeException('Token decryption errors'));

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://localhost');
        $response = $middleware->process($request, $handler);

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertJson($body = (string)$response->getBody());

        $message = json_decode($body, true);

        $this->assertEquals([
            'message' => 'Token decryption errors'
        ], $message);
    }
}