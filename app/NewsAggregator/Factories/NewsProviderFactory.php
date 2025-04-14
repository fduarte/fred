<?php

namespace App\NewsAggregator\Factories;

use App\NewsAggregator\Contracts\NewsProviderInterface;
use App\NewsAggregator\Enums\NewsProviderCategory;
use App\NewsAggregator\Providers\LaravelNewsProvider;

class NewsProviderFactory
{
    public static function make(NewsProviderCategory $category): NewsProviderInterface
    {
        return match ($category) {
            NewsProviderCategory::LARAVEL => new LaravelNewsProvider(),
            NewsProviderCategory::METAL => throw new \Exception('To be implemented'),
            NewsProviderCategory::FITNESS => throw new \Exception('To be implemented'),
            NewsProviderCategory::BLUESKY => throw new \Exception('To be implemented'),
            NewsProviderCategory::HACKERNEWS => throw new \Exception('To be implemented'),
        };
    }
}
