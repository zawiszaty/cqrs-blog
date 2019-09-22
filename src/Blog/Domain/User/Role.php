<?php

declare(strict_types=1);

namespace App\Blog\Domain\User;

use MyCLabs\Enum\Enum;

/**
 * @method static Role ROLE_USER()
 */
class Role extends Enum
{
    private const ROLE_USER = 'ROLE_USER';
}
