<?php

declare(strict_types=1);

namespace App\NewsAggregator\DTOs;

use App\NewsAggregator\Enums\NewsProviderCategory;
use DateTimeImmutable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Str;

final class NewsItemDto extends Data
{
    public function __construct(
        public string $title,
        #[MapInputName('description')]
        public ?string $summary,
        public ?string $source,
        #[MapInputName('link')]
        public string $url,
        #[MapInputName('pubDate')]
        //        #[WithCast(DateTimeInterfaceCast::class, format: 'j F Y, g:i a')]
        #[WithCast(DateTimeInterfaceCast::class)]
        #[WithTransformer(DateTimeInterfaceTransformer::class)]
        public DateTimeImmutable $published_at,
        public ?string $author,
        #[WithCast(EnumCast::class, type: NewsProviderCategory::class)]
        public NewsProviderCategory $category,
        public array $tags = [],
        public int $published = 0,
    ) {

        // If the source is Bluesky, it won't have a title, so grab a big portion of the text
        if ($this->source === 'Bluesky') {
            $this->summary = Str::limit($this->summary, 250, '...');

            return;
        }

        // Clean HTML and normalize whitespace
        $cleaned = mb_trim(strip_tags($this->summary ?? ''));
        $cleaned = preg_replace('/\s+/', ' ', $cleaned);

        // Extract first sentence (up to first period)
        if (preg_match('/(.*?[.?!])\s/', (string) $cleaned, $matches)) {
            $this->summary = mb_trim($matches[1]);
        } else {
            // Fallback: limit to 255 chars and clean
            $this->summary = Str::limit($cleaned, 255, '...');
        }

    }
}
