<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\HTTP\Request;

use SELN\App\Core\HTTP\RequestValidator\RequestValidator;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
    use Symfony\Component\Serializer\Serializer;

class RequestSchema
{
    const TYPE = 'json';

    private Serializer $serializer;
    private RequestValidator $requestValidator;

    /**
     * @param RequestValidator $requestValidator
     */
    public function __construct(RequestValidator $requestValidator)
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            ['json' => new JsonEncoder()]
        );
        $this->requestValidator = $requestValidator;
    }
}