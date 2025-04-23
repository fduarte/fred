<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\NewsItem;
use App\NewsAggregator\DTOs\NewsItemDto;
use Illuminate\Support\LazyCollection;

final class ReadNewsAction
{
    public function __invoke(): LazyCollection
    {
        $items = NewsItem::published()->latest()->lazy();

        return NewsItemDto::collect($items->map->only([
            'title',
            'summary',
            'source',
            'url',
            'published_at',
            'author',
            'category',
            'tags',
            'published',
            'created_at',
            'updated_at',
        ]));
    }
}
