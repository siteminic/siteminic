<?php

namespace Siteminic;

use SimpleXMLElement;

interface SitemapGeneratorInterface
{
    /**
     * Receives all pages from site and generates the Sitemap
     *
     * @param array $pages
     * @return SimpleXMLElement
     */
    public function generate(array $pages = []): SimpleXMLElement;
}
