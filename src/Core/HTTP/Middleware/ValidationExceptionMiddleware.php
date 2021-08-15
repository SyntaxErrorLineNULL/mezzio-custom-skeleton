<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\HTTP\Middleware;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SELN\App\Core\HTTP\RequestValidator\RequestValidatorException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationExceptionMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (RequestValidatorException $exception) {
            return new JsonResponse([
                'message' => $this->getMessage($exception->getViolations())
            ], 422);
        }
    }

    /**
     * @param ConstraintViolationListInterface $object
     * @return array
     */
    private function getMessage(ConstraintViolationListInterface $object): array
    {
        $messages = [];

        /** @var ConstraintViolationInterface $item */
        foreach ($object as $item) {
            $messages[$item->getPropertyPath()] = $item->getMessage();
        }

        return $messages;
    }
}