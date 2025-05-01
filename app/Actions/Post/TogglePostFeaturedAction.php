<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Models\Post;

final class TogglePostFeaturedAction
{
    public function __invoke(int $postId)
    {
        $post = Post::find($postId);
        $post->featured = (int) ! $post->featured;
        $post->save();

        return response()->json([
            'status' => 'ok',
            'featured' => $post->featured,
        ]);
    }
}
