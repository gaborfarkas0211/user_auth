<?php

namespace UserAuth\App\Models;

use UserAuth\App\Traits\QueryStrings;
use UserAuth\Services\Database\QueryInterface;
use stdClass;

class Model
{
    use QueryStrings;

    protected string $table;
    private string $query;
    private array $queryParams = [];
    protected string $primaryKey = 'id';
    protected array $columns = [];
    protected array $hiddenColumns = [];
    protected stdClass $attributes;

    public function __construct(protected readonly QueryInterface $db)
    {
    }

    public function first(): static|null
    {
        $result = $this->db->select($this->query, $this->queryParams);
        if ($result) {
            $this->prepare($result);
        }

        return $this;
    }

    public function exists(): bool
    {
        return property_exists($this, $this->primaryKey);
    }

    public function getAttributes(): stdClass
    {
        $this->hideColumns();

        return $this->attributes;
    }

    protected function prepare(stdClass $result): void
    {
        foreach ($this->columns as $column) {
            $this->$column = $result->$column ?? null;
        }
        $this->attributes = $result;
    }

    private function hideColumns(): void
    {
        foreach ($this->hiddenColumns as $column) {
            if (property_exists($this->attributes, $column)) {
                unset($this->attributes->$column);
            }
        }
    }
}
