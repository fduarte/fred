<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;

final class TogglePostPublishedAction
{
    public function __invoke(int $postId)
    {
        $post = Post::find($postId);
        $post->published = (int) ! $post->published;
        $post->save();

        logger()->info('Post ' . $postId . ' published toggle: ' . $post->published);

        return response()->json([
            'status' => 'ok',
            'published' => $post->published,
        ]);
    }
}
