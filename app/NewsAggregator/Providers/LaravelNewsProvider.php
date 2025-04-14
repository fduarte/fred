<?php

namespace App\NewsAggregator\Providers;

use App\NewsAggregator\Contracts\NewsProviderInterface;
use App\NewsAggregator\DTOs\NewsItemDto;
use App\NewsAggregator\Enums\NewsProviderCategory;
use SimplePie;

class LaravelNewsProvider implements NewsProviderInterface
{
    private $feedUrl = 'https://feed.laravel-news.com/';

    public function fetch(): array
    {
        $feed = new SimplePie();
        $feed->set_feed_url($this->feedUrl);
        $feed->enable_cache(false); // Enable and configure caching later
        $feed->init();
        $feed->handle_content_type();

        return collect($feed->get_items())
            ->map(function ($item) {
                return NewsItemDto::from(
                    [
                        'title' => $item->get_title(),
                        'description' => $item->get_description(),
                        'source' => 'Laravel News',
                        'url' => $item->get_link(),
                        'published_at' => $item->get_date(),
                        'author' => optional($item->get_author())->get_name(),
                        'category' => NewsProviderCategory::from('laravel')->value,
                        'tags' => collect($item->get_categories())->pluck('term')->toArray(),
                        'published' => 1,
                    ]
                );
            })->toArray();
    }
}
