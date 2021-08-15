<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\HTTP\RequestValidator;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class RequestValidatorException extends \LogicException
{
    /**
     * @var array
     */
    private ConstraintViolationListInterface $violations;

    /**
     * @param ConstraintViolationListInterface $violations
     */
    public function __construct(ConstraintViolationListInterface $violations)
    {
        $this->violations = $violations;
        parent::__construct('Object validation failed');
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}