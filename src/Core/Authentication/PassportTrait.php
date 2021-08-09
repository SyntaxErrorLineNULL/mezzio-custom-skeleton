<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Authentication;

use Psr\Http\Message\ServerRequestInterface;
use SELN\App\Core\Authentication\Passport\Passport;

trait PassportTrait
{
    public function authentication(ServerRequestInterface $request): Passport
    {
        return $request->getAttribute(Passport::ATTRIBUTE);
    }

    public function checkAuth(ServerRequestInterface $request): string|int
    {
        $identification = $this->authentication($request);
        return $identification->getAuthId();
    }
}