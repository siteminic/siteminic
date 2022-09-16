<?php

namespace Siteminic;

use Siteminic\Criteria\Criteria;

interface PageRepositoryInterface
{
    public function findBy(Criteria $criteria): array;

    public function findOneBy(Criteria $criteria): ?Page;
}
