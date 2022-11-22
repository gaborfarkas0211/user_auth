<?php

namespace UserAuth\Services\Database;

use PDO;
use PDOStatement;

class DatabaseConnection extends PDOConnection implements QueryInterface
{
    protected PDO|null $instance = null;

    public function __construct()
    {
        parent::__construct($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
    }

    public function select(string $query, array $params = [])
    {
        $stmt = $this->getInstance()->prepare($query);
        $stmt = $this->bindParams($stmt, $params);

        return $this->fetch($stmt);
    }

    protected function getInstance(): PDO
    {
        if (null === $this->instance) {
            $this->createInstance();
        }

        return $this->instance;
    }

    protected function createInstance(): void
    {
        $this->connect();
        $this->instance = $this->getConnection();
    }

    protected function bindParams(PDOStatement $stmt, array $params = []): PDOStatement
    {
        foreach ($params as $column => $value) {
            $stmt->bindParam(":$column", $value);
        }

        return $stmt;
    }

    protected function fetch(PDOStatement $stmt)
    {
        if ($stmt->execute()) {
            return $stmt->fetchObject();
        }

        return false;
    }
}
