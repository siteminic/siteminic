<?php

declare(strict_types=1);

namespace Siteminic;

class Page
{
    public function __construct(
        private string $path,
        private string $content,
        private array $attributes = []
    ) {
    }

    public function path(): string
    {
        return $this->path;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function elements(string $tag): array
    {
        $doc = new \DOMDocument();
        $doc->loadHTML($this->content);

        $elements = iterator_to_array($doc->getElementsByTagName($tag)->getIterator(), true);

        return array_map(function ($element) {
            return $element->textContent;
        }, $elements);
    }

    public function element(string $tag, int $index = 0): ?string
    {
        $doc = new \DOMDocument();
        $doc->loadHTML($this->content);

        $elements = iterator_to_array($doc->getElementsByTagName($tag)->getIterator(), true);

        return utf8_decode($elements[$index]->textContent) ?? null;
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function attribute(string $key, $default = null): mixed
    {
        if ('path' === $key) {
            return $this->path();
        }

        return $this->attributes[$key] ?? $default;
    }
}
