<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\Service;

class PasswordEncoder
{
    public function encode(string $plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
