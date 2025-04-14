<?php

namespace App\Models;

use App\NewsAggregator\Enums\NewsProviderCategory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
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
        'published'
    ];

    protected function casts(): array
    {
        return [
            'category' => NewsProviderCategory::class,
            'tags' => 'array',
        ];
    }
}
