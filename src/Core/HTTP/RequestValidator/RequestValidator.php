<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\HTTP\RequestValidator;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidator
{

    public function __construct(private ValidatorInterface $validator) {}

    /**
     * @throws RequestValidatorException
     */
    public function validate(object $object): void
    {
        $violations = $this->validator->validate($object);
        if ($violations->count() > 0) {
            throw new RequestValidatorException($this->getMessage($violations));
        }
    }

    /**
     * @param ConstraintViolationListInterface $object
     * @return array
     */
    private function getMessage(ConstraintViolationListInterface $object): array
    {
        $messages = [];

        /** @var ConstraintViolationInterface $item */
        foreach ($object as $item) {
            $messages[$item->getPropertyPath()] = $item->getMessage();
        }

        return $messages;
    }
}