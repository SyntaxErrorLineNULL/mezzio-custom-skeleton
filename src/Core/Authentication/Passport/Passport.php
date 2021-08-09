<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Authentication\Passport;

class Passport
{
    const ATTRIBUTE = 'identification';

    private ?string $authId;

    public function __construct(?string $authId) {
        $this->authId = $authId;
    }

    public function getAuthId(): string
    {
        return $this->authId;
    }
}