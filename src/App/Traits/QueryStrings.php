<?php

namespace UserAuth\App\Traits;

trait QueryStrings
{
    public function select(array $attributes = []): static
    {
        $this->setQueryParams($attributes);
        $this->query = 'SELECT * FROM ' . $this->table;

        if (empty($attributes)) {
            return $this;
        }

        $this->setQueryFilter(array_keys($attributes));

        return $this;
    }

    protected function setQueryParams(array $queryParams): void
    {
        $this->queryParams = $queryParams;
    }

    protected function setQueryFilter(array $columns): void
    {
        $query = ' WHERE';
        $index = 0;
        $length = count($columns);
        foreach ($columns as $column) {
            if ($this->isColumnExists($column)) {
                $query .= ' ' . $column . ' = :' . $column;
            }

            if ($index !== $length - 1) {
                $query .= ' AND';
            }
            $index++;
        }

        $this->query .= $query;
    }

    protected function isColumnExists(string $column): bool
    {
        return in_array($column, $this->columns, true);
    }
}
