<?php

declare(strict_types=1);

namespace Siteminic\Criteria;

class Filter
{
    /**
     * @param string $field
     * @param FilterOperator $operator
     * @param mixed $value
     */
    public function __construct(
        private string $field,
        private FilterOperator $operator,
        private mixed $value
    ) {
    }

    public function field(): string
    {
        return $this->field;
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): mixed
    {
        return $this->value;
    }
}
