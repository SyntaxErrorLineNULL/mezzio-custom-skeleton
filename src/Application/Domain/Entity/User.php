<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Domain\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;


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
     * @param string $passwordHash
     */
    public function __construct(string $id, ?string $name, string $email, ?string $phone, string $passwordHash)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->passwordHash = $passwordHash;
        $this->createdAt = new \DateTimeImmutable();
    }


}