<?php

namespace Siteminic;

interface ShortcodeInterface
{
    public function key(): string;

    public function handler(array $parameters = []): string;
}
