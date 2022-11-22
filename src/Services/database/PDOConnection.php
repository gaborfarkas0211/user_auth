<?php

namespace UserAuth\Services\Database;

use PDO;
use PDOException;

class PDOConnection implements DatabaseInterface
{
    protected PDO $connection;

    public function __construct(
        private readonly string $host,
        private readonly string $username,
        private readonly string $password,
        private readonly string $database
    )
    {
    }

    public function connect(): void
    {
        try {
            $this->connection = new PDO($this->getDsn(), $this->username, $this->password);
        } catch (PDOException $e) {
            print_r([$this->host, $this->username]);
            throw new PDOException($e->getMessage());
        }
    }

    private function getDsn(): string
    {
        return "mysql:host=$this->host;dbname=$this->database";
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
