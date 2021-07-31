<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Infrastructure\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use SELN\App\Application\Domain\Entity\User;
use SELN\App\Application\Domain\Repository\UserRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{

    /**
     * @throws ORMException
     */
    public function create(User $user): void
    {
        $this->_em->persist($user);
    }

    /**
     * @throws ORMException
     */
    public function remove(User $user): void
    {
        $this->_em->remove($user);
    }

    /**
     * @throws \Exception
     */
    public function getById(string $id): User
    {
        /** @var User|null $user */
        $user = $this->find($id);
        if ($user === null) {
            throw new \Exception('Entity not found');
        }
        return $user;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $this->findAll();
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }
}