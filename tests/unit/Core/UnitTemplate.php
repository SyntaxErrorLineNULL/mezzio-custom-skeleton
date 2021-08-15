<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Test\UnitTest\Core;

interface UnitTemplate
{
    public function testSuccess(): void;

    public function testException(): void;
}