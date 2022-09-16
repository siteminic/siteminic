<?php

declare(strict_types=1);

namespace Siteminic\Criteria;

class Criteria
{
    public function __construct(
        private ?array $filters,
        private ?array $orders = [],
        private ?int $offset = null,
        private ?int $limit = null
    ) {
    }

    public function filters(): ?array
    {
        return $this->filters;
    }

    public function orders(): ?array
    {
        return $this->orders;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}
