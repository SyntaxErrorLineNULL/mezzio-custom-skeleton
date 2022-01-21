<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Test\UnitTest\Core\Request;

use Codeception\Test\Unit;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Server\RequestHandlerInterface;
use SELN\App\Core\HTTP\Request\RequestSchema;
use SELN\App\Core\HTTP\RequestValidator\RequestValidator;
use SELN\App\Test\UnitTest\Core\UnitTemplate;

class RequestSchemaTest extends Unit
{
    public function testSuccess(): void
    {
        $mock = $this->createMock(RequestValidator::class);
        $requestSchema = new RequestSchema($mock);

        $request = (new ServerRequest())
            ->withHeader('Content-Type', 'application/json')
            ->withParsedBody([
                'name' => 'Alex',
                'email' => 'test@gmail.com'
            ]);

        var_dump($request->getBody()->getContents());

        $body = $requestSchema->getRequestProperty(TestSchema::class, $request);

        $this->assertEquals('Alex', $body->name);
    }
}