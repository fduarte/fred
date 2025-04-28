<?php

namespace App\Http\Controllers;

use App\Actions\News\ReadUserNewsFavoritesAction;
use App\Actions\News\ToggleNewsFavoritesAction;
use App\Models\NewsItem;
use Inertia\Inertia;
use Inertia\Response;
use App\Actions\News\ToggleNewsReadAction;

class NewsFavoritesController extends Controller
{
    public function toggleFavorite(NewsItem $newsItem, ToggleNewsFavoritesAction $toggleNewsFavoritesAction)
    {
        return $toggleNewsFavoritesAction($newsItem);
    }

    public function toggleRead(NewsItem $newsItem, ToggleNewsReadAction $toggleNewsReadAction)
    {
        return $toggleNewsReadAction($newsItem);
    }

    /**
     * Return user favorited news to admin favorites component
     * @param ReadUserNewsFavoritesAction $readUserNewsFavoritesAction
     * @return \Inertia\Response
     */
    public function index(ReadUserNewsFavoritesAction $readUserNewsFavoritesAction): Response
    {
        $favoritesPaginator = $readUserNewsFavoritesAction();

        return Inertia::render('News/Favorites', [
            'favorites' => $favoritesPaginator->toArray()['data'],
            'links' => [
                'next' => $favoritesPaginator->nextCursor()?->encode(),
                'prev' => $favoritesPaginator->previousCursor()?->encode(),
            ],
        ]);
    }

    public function archive(NewsItem $newsItem)
    {
        // Example: mark it archived for the user
        auth()->user()->favoriteNews()->updateExistingPivot($newsItem->id, [
            'is_archived' => 1,
        ]);

        return back();
    }


}
