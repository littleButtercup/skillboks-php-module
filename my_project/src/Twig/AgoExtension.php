<?php

namespace App\Twig;

use Carbon\Carbon;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * фильтр, преобразует дату в нужный формат калбек функцией getDiff
 */
class AgoExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('ago', [$this, 'getDiff']),
        ];
    }

    /**
     * @param $value
     * @return string
     */
    public function getDiff($value): string
    {
        return Carbon::make($value)->locale('ru')->diffForHumans();
    }
}