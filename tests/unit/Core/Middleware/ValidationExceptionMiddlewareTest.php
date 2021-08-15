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
use SELN\App\Core\HTTP\Middleware\ValidationExceptionMiddleware;
use SELN\App\Core\HTTP\RequestValidator\RequestValidatorException;
use SELN\App\Test\UnitTest\Core\UnitTemplate;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class ValidationExceptionMiddlewareTest extends Unit implements UnitTemplate
{

    public function testSuccess(): void
    {
        $middleware = new ValidationExceptionMiddleware();
        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn($source = (new ResponseFactory())->createResponse());

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://localhost');
        $response = $middleware->process($request, $handler);

        $this->assertEquals($source, $response);
    }

    public function testException(): void
    {
        $middleware = new ValidationExceptionMiddleware();

        $violations = new ConstraintViolationList([
            new ConstraintViolation('Incorrect Email', null, [], null, 'email', 'not-email'),
            new ConstraintViolation('Empty Password', null, [], null, 'password', ''),
        ]);

        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willThrowException(new RequestValidatorException($violations));

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://localhost');
        $response = $middleware->process($request, $handler);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertJson($body = (string)$response->getBody());

        $message = json_decode($body, true);

        $this->assertEquals([
            'message' => [
                'email' => 'Incorrect Email',
                'password' => 'Empty Password'
            ]
        ], $message);
    }
}