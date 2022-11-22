<?php

namespace UserAuth\App\Models;

class User extends Model
{
    protected string $table = 'users';
    protected array $columns = [
        'id',
        'username',
        'password',
        'name',
    ];
    protected array $hiddenColumns = [
        'password',
    ];

    public function login(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
