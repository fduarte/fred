<?php

namespace App\Http\Controllers;

use App\Actions\News\ToggleNewsFavoritesAction;
use App\Models\NewsItem;

class NewsFavoriteController extends Controller
{
    public function toggleFavorite(NewsItem $newsItem, ToggleNewsFavoritesAction $toggleNewsFavoritesAction)
    {
        return $toggleNewsFavoritesAction($newsItem);
    }

}
