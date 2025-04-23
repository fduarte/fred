<?php

declare(strict_types=1);

namespace App\Actions\News;

use App\Models\NewsItem;
use Illuminate\Support\Facades\DB;
use Throwable;

final class CreateUpdateNewsItemAction
{
    /**
     * @param array $newsItemDtos
     * @return void
     * @throws Throwable
     */
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

        // @todo - Broadcast new import
        // broadcast(new NewsItemCreatedUpdated($newsItemDto))->toOthers();

    }
}
