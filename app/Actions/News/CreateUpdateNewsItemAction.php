<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\NewsItem;
use Illuminate\Support\Facades\DB;

final class CreateUpdateNewsItemAction
{
    public function handle(array $newsItemDtos): void
    {

        // Save data
        DB::transaction(function () use ($newsItemDtos): void {
            foreach ($newsItemDtos as $newsItemDto) {
                NewsItem::updateOrCreate(
                    ['url' => $newsItemDto['url']],
                    $newsItemDto
                );
            }
        });

        // Broadcast new import
        // broadcast(new NewsItemCreatedUpdated($newsItemDto))->toOthers();

    }
}
