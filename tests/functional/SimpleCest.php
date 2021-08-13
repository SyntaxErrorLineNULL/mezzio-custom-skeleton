<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Test\Functional;

use Codeception\Util\HttpCode;

class SimpleCest
{
    public function test(\FunctionalTester $I): void
    {
        $I->sendGet("/simple");
        $I->seeResponseCodeIs(HttpCode::OK);
    }
}