<?php

namespace App\Twig;

use App\Service\MarkdownParser;
use Twig\Extension\RuntimeExtensionInterface;

/**
 * кэширует результат
 */
class AppRuntime implements RuntimeExtensionInterface
{
    /**
     * @var MarkdownParser
     */
    private $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    /**
     * @param $content
     * @return string
     */
    public function parseMarkdown($content): string
    {
        return $this->markdownParser->parse($content);
    }
}