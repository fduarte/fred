<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\NewsItem;
use Illuminate\Pagination\CursorPaginator;

final class ReadNewsAction
{
    public function __invoke(): CursorPaginator
    {
        return NewsItem::published()
            ->orderByDesc('published_at')
            ->cursorPaginate(5);
    }
}
