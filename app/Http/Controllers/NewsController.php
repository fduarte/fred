<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\News\ReadNewsAction;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ReadNewsAction $readNewsAction): Response
    {
        $newsPaginator = $readNewsAction();

        return Inertia::render('News/Index', [
            'news' => $newsPaginator->toArray()['data'],
            'links' => [
                'next' => $newsPaginator->nextCursor()?->encode(),
                'prev' => $newsPaginator->previousCursor()?->encode(),
            ],
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
    public function show(string $id): Response
    {
        return Inertia::render('News/Show', [
            'news' => NewsItem::findOrFail($id)
        ]);
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
    public function destroy(string $id)
    {
        //
    }
}
