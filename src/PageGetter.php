<?php

declare(strict_types=1);

namespace Siteminic;

use DateTimeImmutable;
use Siteminic\Criteria\Criteria;
use Siteminic\Criteria\Filter;
use Siteminic\Criteria\FilterOperator;

/**
 * Service to retrieve page or pages
 */
class PageGetter implements PageGetterInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    public function getByPath(?string $path = null): ?Page
    {
        $page = $this->repository->findOneBy(
            new Criteria(
                [
                    new Filter(
                        'path',
                        FilterOperator::EQUAL,
                        $path
                    ),
                    new Filter(
                        'draft',
                        FilterOperator::EQUAL,
                        false
                    ),
                    new Filter(
                        'published_at',
                        FilterOperator::GT,
                        new DateTimeImmutable('now')
                    )
                ]
            )
        );

        if (null === $page) {
            return null;
        }

        return $page;
    }

    public function listByCollection(string $name): array
    {
        return $this->repository->findBy(
            new Criteria(
                [
                    new Filter(
                        'collections',
                        FilterOperator::CONTAINS,
                        $name
                    ),
                    new Filter(
                        'draft',
                        FilterOperator::EQUAL,
                        false
                    ),
                    new Filter(
                        'published_at',
                        FilterOperator::GT,
                        new DateTimeImmutable('now')
                    )
                ]
            )
        );
    }
}
