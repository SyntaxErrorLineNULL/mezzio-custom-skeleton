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

class DomainExceptionMiddlewareTest extends Unit
{
    public function testSuccess(): void
    {
        $middleware = new DomainExceptionMiddleware();
        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn($source = (new ResponseFactory())->createResponse());

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'https://test');
        $response = $middleware->process($request, $handler);

        $this->assertEquals($source, $response);
    }
}