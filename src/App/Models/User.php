<?php

namespace UserAuth\App\Models;

use UserAuth\Services\Database\DatabaseConnection;

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

    public static function query(): User
    {
        return (new self(new DatabaseConnection()));
    }

    public static function findByUsername(string $username): User
    {
        return self::query()
            ->select(compact('username'))
            ->first();
    }
}
