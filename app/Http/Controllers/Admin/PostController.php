<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Post\ReadPostsAction;
use App\Actions\Post\TogglePostFeaturedAction;
use App\Actions\Post\TogglePostPublishedAction;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ReadPostsAction $readPostsAction): Response
    {
       $postsPaginator = $readPostsAction();

       return Inertia::render('Admin/Posts/Index', [
            'posts' => $postsPaginator->toArray()['data'],
            'links' => [
                'next' => $postsPaginator->nextCursor()?->encode(),
                'prev' => $postsPaginator->previousCursor()?->encode(),
            ]
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ReadPostsAction $readPostsAction)
    {
        \Log::error('Destroying post: ' . $id);
        Post::destroy($id);
    }

    public function togglePublished(int $id, TogglePostPublishedAction $togglePostPublishedAction)
    {
        return $togglePostPublishedAction($id);
    }

    public function toggleFeatured(int $id, TogglePostFeaturedAction $togglePostFeaturedAction)
    {
        return $togglePostFeaturedAction($id);
    }
}
