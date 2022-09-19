<?php

declare(strict_types=1);

namespace Siteminic;

use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Processor\Processor;

class ShortcodesProcessor implements PageProcessorInterface
{
    private $shortcodes;

    public function __construct(ShortcodeInterface ...$shortcodes)
    {
        $this->shortcodes = $shortcodes;
    }

    public function handle(Page $page): Page
    {
        $unscappedText = preg_replace_callback(
                '/\[(.*?)\]/',
                function ($matches) {
                    $text = $matches[0];
                    $text = str_replace('&quot;', '"', $text);
                    $text = str_replace('\'', '"', $text);

                    return $text;
                },
            $page->content());

        $handlers = new HandlerContainer();

        foreach($this->shortcodes as $shortcode) {
            $callable = function (\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) use ($shortcode) {
                return $shortcode->handler($s->getParameters());
            };

            $handlers->add(
                $shortcode->key(),
                $callable
            );
        }

        $processor = new Processor(new RegularParser(), $handlers);
        $content = $processor->process($unscappedText);

        return new Page(
            $page->path(),
            $content,
            $page->attributes()
        );
    }
}
