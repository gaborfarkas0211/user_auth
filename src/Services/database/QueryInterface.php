<?php

namespace UserAuth\Services\Database;

interface QueryInterface
{
    public function select(string $query, array $params = []);
}
