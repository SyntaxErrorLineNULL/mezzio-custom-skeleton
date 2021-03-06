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
use SELN\App\Core\HTTP\Middleware\DomainExceptionMiddleware;
use SELN\App\Test\UnitTest\Core\UnitTemplate;

class DomainExceptionMiddlewareTest extends Unit implements UnitTemplate
{
    public function testSuccess(): void
    {
        $middleware = new DomainExceptionMiddleware();
        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn($source = (new ResponseFactory())->createResponse());

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://localhost');
        $response = $middleware->process($request, $handler);

        $this->assertEquals($source, $response);
    }

    public function testException(): void
    {
        $middleware = new DomainExceptionMiddleware();
        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willThrowException(new \DomainException('Test Error'));

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'https://localhost');
        $response = $middleware->process($request, $handler);

        $this->assertEquals(409, $response->getStatusCode());
        $this->assertJson($body = (string)$response->getBody());

        $message = json_decode($body, true);

        $this->assertEquals([
            'message' => 'Test Error'
        ], $message);
    }
}