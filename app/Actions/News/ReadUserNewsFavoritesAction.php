<?php

declare(strict_types=1);

namespace App\Actions\News;

use Illuminate\Pagination\CursorPaginator;

final class ReadUserNewsFavoritesAction
{

    public function __invoke(): CursorPaginator
    {
        $user = auth()->user();

        // Unauthorized
        if (!$user) {
            abort(401);
        }

        return $user->favoriteNews()
            ->where('is_archived', false)
            ->orderByDesc('news_favorites.created_at')
            ->cursorPaginate(5);
    }
}
