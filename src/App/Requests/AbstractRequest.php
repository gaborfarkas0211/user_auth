<?php

namespace UserAuth\App\Requests;

use UserAuth\App\Enums\RuleEnum;
use UserAuth\Exceptions\ValidationException;

abstract class AbstractRequest
{
    protected array $params;
    protected array $errors = [];
    private string $field;
    private array $fieldRules;

    public function __construct()
    {
        $this->params = $_POST;
    }

    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        $this->prepare();
        if (!empty($this->errors)) {
            throw new ValidationException();
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    protected function prepare(): void
    {
        foreach ($this->rules() as $field => $fieldRules) {
            $this->field = $field;
            $this->fieldRules = $fieldRules;
            if ($this->isFieldExists()) {
                if (!$this->isString()) {
                    $this->errors[$field][] = RuleEnum::STRING;
                }
                continue;
            }
            $this->errors[$field][] = RuleEnum::REQUIRED;
        }
    }

    protected function isFieldExists(): bool
    {
        return !$this->shouldBe(RuleEnum::REQUIRED) || isset($this->params[$this->field]);
    }

    protected function isString(): bool
    {
        return !$this->shouldBe(RuleEnum::STRING) || is_string($this->params[$this->field]);
    }

    protected function shouldBe(RuleEnum $rule): bool
    {
        return in_array($rule->value, $this->fieldRules, true);
    }
}
