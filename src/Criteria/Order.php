<?php

declare(strict_types=1);

namespace Siteminic\Criteria;

class Order
{
    public function __construct(
        private OrderType $orderType,
        private ?string $orderBy
    ) {
    }

    public function orderType(): OrderType
    {
        return $this->orderType;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }
}
