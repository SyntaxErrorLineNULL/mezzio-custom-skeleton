<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Service;

use RuntimeException;
use Webmozart\Assert\Assert;

class PasswordService
{
    private int $value;

    /**
     * @param int $value
     */
    public function __construct(int $value = PASSWORD_ARGON2_DEFAULT_MEMORY_COST)
    {
        $this->value = $value;
    }

    public function hash(string $password): string
    {
        Assert::notEmpty($password);

        $hash = password_hash($password, PASSWORD_ARGON2ID, [
            'value' => $this->value
        ]);

        if ($hash === null) {
            throw new RuntimeException('Invalid hash algorithm');
        }

        return $hash;
    }

}