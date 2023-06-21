<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CachedMarkdownExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('cached_markdown', [AppRuntime::class, 'parseMarkdown'], ['is_safe' => ['html']]),
        ];
    }
}
