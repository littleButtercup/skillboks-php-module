<?php

namespace App\Twig;



use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;


class CachedMarkdownExtension extends AbstractExtension
{



    public function getFilters(): array
    {
        return [

            new TwigFilter('cached_markdown', [AppRuntime::class, 'parseMarkdown'], ['is_safe' => ['html']]),
        ];
    }


}
