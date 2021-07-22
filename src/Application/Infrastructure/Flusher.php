<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Infrastructure;


use Doctrine\ORM\EntityManagerInterface;

class Flusher
{
    /**
     * Flusher constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function flush(): void
    {
        $this->entityManager->flush();
    }
}