<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\Exception;

class RoleNotFoundException extends \Exception
{
    protected $message = 'ROLE NOT FOUND';
}
