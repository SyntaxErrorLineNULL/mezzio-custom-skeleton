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
use Ramsey\Uuid\Uuid;
use SELN\App\Application\Domain\Entity\User;
use SELN\App\Application\Domain\Repository\UserRepository;
use SELN\App\Application\Infrastructure\Flusher;
use SELN\App\Application\Service\PasswordService;
use SELN\App\Core\HTTP\Request\RequestSchema;
use SELN\App\Core\HTTP\RequestValidator\RequestValidatorException;

class TestHandler implements RequestHandlerInterface
{

    public function __construct(
        private Flusher $flusher,
        private UserRepository $userRepository,
        private PasswordService $passwordService,
        private RequestSchema $requestSchema
    )
    {
    }

    /**
     * @throws RequestValidatorException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var TestSchema $schema */
        $schema = $this->requestSchema->getRequestProperty(TestSchema::class, $request);

        $user = new User(
            Uuid::uuid4()->toString(),
            $schema->name,
            $schema->email,
            $schema->phone,
            $this->passwordService,
            $schema->password
        );
        $this->userRepository->create($user);
        $this->flusher->flush();

        return new JsonResponse("Successful", 201);
    }
}