<?php

namespace Siteminic;

interface PageProcessorInterface
{
    public function handle(Page $page): Page;
}
