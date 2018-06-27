<?php

namespace App\Builder;

use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseBuilder
 * @package App\Builder
 */
class ResponseBuilder
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * ResponseBuilder constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     * @return Response
     */
    public function build($data)
    {
        $data = $this->serializer->serialize($data, 'json');
        $response = new Response($data, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}