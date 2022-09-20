<?php

namespace Siteminic;

interface PageGetterInterface
{
    public function getByPath(?string $path = null): ?Page;

    public function listByCollection(string $name, ?array $orders = [], ?int $offset = null, ?int $limit = null): array;
}
