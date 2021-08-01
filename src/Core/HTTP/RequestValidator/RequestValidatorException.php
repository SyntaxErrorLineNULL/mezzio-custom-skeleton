<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\HTTP\RequestValidator;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class RequestValidatorException extends \Exception
{
    /**
     * @var array
     */
    private array $violations;

    /**
     * @param array $violations
     */
    public function __construct(array $violations)
    {
        $this->violations = $violations;
        parent::__construct('Object validation failed');
    }

    public function getViolations(): array
    {
        return $this->violations;
    }
}