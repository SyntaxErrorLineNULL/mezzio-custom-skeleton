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
use SELN\App\Core\Authentication\JWTService;
use SELN\App\Core\Authentication\Passport\Passport;
use SELN\App\Core\HTTP\Middleware\AuthenticationMiddleware;
use SELN\App\Test\UnitTest\Core\UnitTemplate;

class AuthenticationMiddlewareTest extends Unit implements UnitTemplate
{
    private const TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpZCI6ImQ1YmI0NmI0LTU0MDgtNGE0NC1hNTNjLWVlZWVmMmEzMTA2OSIsImNyZWF0ZWRBdCI6eyJkYXRlIjoiMjAyMS0wOC0xMCAwOToyODoxMS40MjUyNTEiLCJ0aW1lem9uZV90eXBlIjozLCJ0aW1lem9uZSI6IlVUQyJ9fQ.AAxYREfAxllBSPCpbk6c8TeVf7cTquS8k9jn9grC1fCflMmjQADMmF8vC1WnJkbhoGl5RlwAbJ8W1lyfexkqJA';
    private const ID = 'd5bb46b4-5408-4a44-a53c-eeeef2a31069';

    public function testSuccess(): void
    {
        $jwt = new JWTService('h7P41RolcpHIS8v6D5gjfVLyVsy0xl4D');
        $middleware = new AuthenticationMiddleware($jwt);

        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')
            ->willReturn($source = (new ResponseFactory())->createResponse());

        $request = (new ServerRequestFactory())
            ->createServerRequest('POST', 'http://localhost')
            ->withHeader('Authorization', self::TOKEN);

        $response = $middleware->process($request, $handler);

        $decode = $jwt->decode($request->getHeaderLine('Authorization'));
        $this->assertIsBool($response->hasHeader('Authorization'));
        $this->assertIsObject($request->withAttribute(Passport::ATTRIBUTE, new Passport($decode->id)));
        $this->assertEquals(self::ID, $decode->id);
        $this->assertEquals($source, $response);
    }

    public function testException(): void
    {

    }
}