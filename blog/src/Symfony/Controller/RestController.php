<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\System;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestController extends AbstractController
{
    /**
     * @var System
     */
    private $system;

    public function __construct(System $system)
    {
        $this->system = $system;
    }
}
