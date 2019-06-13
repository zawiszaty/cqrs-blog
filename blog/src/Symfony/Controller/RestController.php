<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\System;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class RestController extends AbstractController
{
    /**
     * @var System
     */
    protected $system;
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(System $system, SerializerInterface $serializer)
    {
        $this->system = $system;
        $this->serializer = $serializer;
    }
}
