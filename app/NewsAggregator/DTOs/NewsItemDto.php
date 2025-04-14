<?php

namespace App\NewsAggregator\DTOs;

use App\NewsAggregator\Enums\NewsProviderCategory;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Str;

class NewsItemDto extends Data
{
    public function __construct(
        public string $title,
        #[MapInputName('description')]
        public ?string $summary,
        public ?string $source,
        #[MapInputName('link')]
        public string $url,
        #[MapInputName('pubDate')]
        #[WithCast(DateTimeInterfaceCast::class, format: 'j F Y, g:i a')]
        public Carbon $published_at,
        public ?string $author,
        #[WithCast(EnumCast::class, type: NewsProviderCategory::class)]
        public NewsProviderCategory $category,
        public array $tags = [],
        public int $published = 0,
    ) {
        $cleaned = trim(strip_tags($this->summary ?? ''));

        // Normalize whitespace
        $cleaned = preg_replace('/\s+/', ' ', $cleaned);

        // Extract first sentence (up to first period)
        if (preg_match('/(.*?[.?!])\s/', $cleaned, $matches)) {
            $this->summary = trim($matches[1]);
        } else {
            // Fallback: limit to 255 chars and clean
            $this->summary = Str::limit($cleaned, 255, '...');
        }

    }
}
