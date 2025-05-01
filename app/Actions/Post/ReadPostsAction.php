<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Pagination\CursorPaginator;

final class ReadPostsAction
{
    public function __invoke(): CursorPaginator
    {
        $user = auth()->user();

        // Unauthorized
        if (!$user) {
            abort(401);
        }

        return Post::orderByDesc('id')
            ->cursorPaginate(10);
    }
}
