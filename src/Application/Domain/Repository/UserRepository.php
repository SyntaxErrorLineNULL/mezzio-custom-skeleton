<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Domain\Repository;


use SELN\App\Application\Domain\Entity\User;

interface UserRepository
{
    /**
     * @param User $user
     */
    public function create(User $user): void;

    /**
     * @param User $user
     */
    public function remove(User $user): void;

    /**
     * @param string $id
     * @return User
     */
    public function getById(string $id): User;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}