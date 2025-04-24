<?php

declare(strict_types=1);

namespace App\Models;

use App\NewsAggregator\DTOs\NewsItemDto;
use App\NewsAggregator\Enums\NewsProviderCategory;
use Illuminate\Database\Eloquent\Model;

final class NewsItem extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'source',
        'url',
        'published_at',
        'author',
        'category',
        'tags',
        'published',
    ];

    protected function casts(): array
    {
        return [
            'category' => NewsProviderCategory::class,
            'tags' => 'array',
            'published_at' => 'datetime:Y-m-d H:i',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function toDto(): NewsItemDto
    {
        return NewsItemDto::from($this->toArray());
    }

}
