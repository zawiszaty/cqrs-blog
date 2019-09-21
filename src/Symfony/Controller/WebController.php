<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\System;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebController extends AbstractController
{
    /**
     * @var System
     */
    protected $system;

    public function __construct(System $system)
    {
        $this->system = $system;
    }
}
