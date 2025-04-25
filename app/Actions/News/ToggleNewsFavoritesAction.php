<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\NewsItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

final class ToggleNewsFavoritesAction
{
    public function __invoke(NewsItem $newsItem): JsonResponse
    {
        try {
            $newsItemDto = $newsItem->toDto();
            $user = auth()->user();
            DB::transaction(function () use ($user, $newsItemDto): void {
                $user->favoriteNews()->toggle($newsItemDto->id);
            });
            return response()->json(['status' => 'ok']);
        } catch (\Exception | \Throwable $e) {
            logger()->error($e->getTraceAsString());
            return response()->json(['status' => 'error', 'message' => 'Could not favorite news item.']);
        }
    }
}
