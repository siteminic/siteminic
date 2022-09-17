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
    public function __construct(
        private PageRepositoryInterface $repository,
        private ShortcodeProcessor $processor
    ) {
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
                        'publishedAt',
                        FilterOperator::GT,
                        new DateTimeImmutable('now')
                    )
                ]
            )
        );

        if (null === $page) {
            return null;
        }

        return $this->toShortcodeProcessedPage($page);
    }

    public function listByCollection(string $name): array
    {
        $pages = $this->repository->findBy(
            new Criteria(
                [
                    new Filter(
                        'collection',
                        FilterOperator::EQUAL,
                        $name
                    )
                ]
            )
        );

        return array_map(function (Page $page) {
            return $this->toShortcodeProcessedPage($page);
        }, $pages);
    }

    private function toShortcodeProcessedPage(Page $page): Page
    {
        return new Page(
            $page->path(),
            $this->processor->process($page->content()),
            $page->attributes()
        );
    }
}
