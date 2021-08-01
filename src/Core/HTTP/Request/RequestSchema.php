<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\HTTP\Request;

use Psr\Http\Message\ServerRequestInterface;
use SELN\App\Core\HTTP\RequestValidator\RequestValidator;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
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
            [new ObjectNormalizer(null, null, null, new ReflectionExtractor()), new ArrayDenormalizer()],
            ['json' => new JsonEncoder()]
        );
        $this->requestValidator = $requestValidator;
    }

    public function getRequestProperty(string $schema, ServerRequestInterface $request)
    {
        $schema = $this->serializer->deserialize($request->getBody(), $schema, self::TYPE);
    }
}