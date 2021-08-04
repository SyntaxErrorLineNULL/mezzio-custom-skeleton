<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Domain\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use SELN\App\Application\Infrastructure\Repository\DoctrineUserRepository;
use SELN\App\Application\Service\PasswordService;

#[Entity(repositoryClass: DoctrineUserRepository::class)]
#[Table(name: '`user`')]
class User
{
    #[Id]
    #[Column(type: 'guid')]
    public string $id;
    #[Column(type: 'string', length: 25, nullable: true)]
    public ?string $name;
    #[Column(type: 'string', unique: true, nullable: false)]
    public string $email;
    #[Column(type: 'string', unique: true, nullable: true)]
    public ?string $phone;
    #[Column(type: 'string')]
    public string $passwordHash;
    #[Column(type: 'datetime_immutable')]
    public \DateTimeImmutable $createdAt;

    /**
     * User constructor.
     * @param string $id
     * @param string|null $name
     * @param string $email
     * @param string|null $phone
     * @param PasswordService $passwordService
     * @param string $password
     */
    public function __construct(string $id, ?string $name, string $email, ?string $phone, PasswordService $passwordService, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->passwordHash = $passwordService->hash($password);
        $this->createdAt = new \DateTimeImmutable();
    }


}