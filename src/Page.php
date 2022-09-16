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

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function attribute(string $key, $default = null): mixed
    {
        return $this->attributes[$key] ?? $default;
    }
}
