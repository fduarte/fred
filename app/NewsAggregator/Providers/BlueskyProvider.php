<?php

declare(strict_types=1);

namespace App\NewsAggregator\Providers;

use App\NewsAggregator\Contracts\NewsProviderInterface;
use App\NewsAggregator\DTOs\NewsItemDto;
use App\NewsAggregator\Enums\NewsProviderCategory;
use Http;

final class BlueskyProvider implements NewsProviderInterface
{
    private string $baseUrl = 'https://public.api.bsky.app/xrpc';

    private string $listDid = 'at://did:plc:4o445dyfao2uuwsc4lx6vzox/app.bsky.graph.list/3lmcebilpqm2y';

    public function fetch(): array
    {
        $url = $this->baseUrl.'/app.bsky.feed.getListFeed';
        $response = Http::get($url, [
            'list' => $this->listDid,
        ]);

        $items = $response->json('feed') ?? [];

        return collect($items)
            ->filter(fn ($item): bool => ! isset($item['reply'])) // exclude replies
            ->map(function (array $item): NewsItemDto {
                $post = $item['post'];
                $record = $post['record'];
                $author = $post['author'];

                return NewsItemDto::from([
                    'title' => '',
                    'summary' => $record['text'],
                    'source' => 'Bluesky',
                    'link' => 'https://bsky.app/profile/'.$author['handle'].'/post/'.basename((string) $post['uri']),
                    'pubDate' => $record['createdAt'],
                    'author' => $author['displayName'] ?? $author['handle'],
                    'category' => NewsProviderCategory::from('bluesky')->value,
                    'tags' => [], // optional tagging logic
                    'published' => 1,
                ]);
            })
            ->toArray();
    }
}
