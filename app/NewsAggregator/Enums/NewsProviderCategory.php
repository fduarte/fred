<?php

namespace App\NewsAggregator\Enums;

enum NewsProviderCategory: string
{
    case UNCATEGORIZED = 'uncategorized';
    case LARAVEL = 'laravel';
    case METAL = 'metal';
    case FITNESS = 'fitness';
    case BLUESKY = 'bluesky';
    case HACKERNEWS = 'hackernews';

    public function label(): string
    {
        return match ($this) {
            self::LARAVEL => 'Laravel News Aggregator',
            self::METAL => 'Heavy Metal News Aggregator',
            self::FITNESS => 'Fitness Tips Aggregator',
            self::UNCATEGORIZED => 'Uncategorized',
            self::BLUESKY => 'Laravel Influencer Aggregator',
            self::HACKERNEWS => 'HackerNews Aggregator',
        };
    }
}
