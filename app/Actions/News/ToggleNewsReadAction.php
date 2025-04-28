<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\NewsItem;
use Illuminate\Http\JsonResponse;

final class ToggleNewsReadAction
{
    public function __invoke(NewsItem $newsItem): JsonResponse
    {
        try {
            // Unauthorized
            $user = auth()->user();
            if (!$user) {
                abort(401);
            }

            $favorite = $user->favoriteNews()
                ->where('news_item_id', $newsItem->id)
                ->firstOrFail();

            // Toggle is_read
            $favorite->pivot->is_read = !$favorite->pivot->is_read;

            $favorite->pivot->save();

            return response()->json([
                'status' => 'ok',
                'is_read' => $favorite->pivot->is_read,
            ]);

        } catch (\Exception | \Throwable $e) {
            logger()->error($e->getTraceAsString());
            return response()->json(['status' => 'error', 'message' => 'Could not toggle news-favorite as read.']);
        }
    }
}
