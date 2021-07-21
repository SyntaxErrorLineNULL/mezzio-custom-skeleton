<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Api\Site\Handler;


use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TestHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse('hello');
    }
}