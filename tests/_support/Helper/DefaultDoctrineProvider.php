<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace Helper;

use Codeception\Lib\Interfaces\DoctrineProvider;
use Codeception\Module;
use Doctrine\ORM\EntityManagerInterface;

class DefaultDoctrineProvider extends Module implements DoctrineProvider
{

    public function _getEntityManager()
    {
        /** @var Module\Mezzio $module */
        $module = $this->getModule('Mezzio');
        return $module->container->get(EntityManagerInterface::class);
    }
}