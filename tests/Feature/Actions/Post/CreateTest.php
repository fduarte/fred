<?php

declare(strict_types=1);

use App\Actions\Post\CreatePost;
use App\Models\Post;

it('should create a post', function (): void {

    $action = $this->app->make(CreatePost::class);

    $post = Post::factory()->create();

    $attributes = $post->toArray();

    $action->handle($post, $attributes);

    expect($post->fresh()->title)->toEqual($post->title);
    expect($post->fresh()->body)->toEqual($attributes['body']);

});
