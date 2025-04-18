<?php

declare(strict_types=1);

namespace App\NewsAggregator\Factories;

use App\NewsAggregator\Contracts\NewsProviderInterface;
use App\NewsAggregator\Enums\NewsProviderCategory;
use App\NewsAggregator\Providers\BlueskyProvider;
use App\NewsAggregator\Providers\LaravelNewsProvider;
use Exception;

final class NewsProviderFactory
{
    public static function make(NewsProviderCategory $category): NewsProviderInterface
    {
        return match ($category) {
            NewsProviderCategory::UNCATEGORIZED => throw new Exception('To be implemented'),
            NewsProviderCategory::LARAVEL => new LaravelNewsProvider(),
            NewsProviderCategory::METAL => throw new Exception('To be implemented'),
            NewsProviderCategory::FITNESS => throw new Exception('To be implemented'),
            NewsProviderCategory::BLUESKY => new BlueskyProvider(),
            NewsProviderCategory::HACKERNEWS => throw new Exception('To be implemented'),
        };
    }
}
