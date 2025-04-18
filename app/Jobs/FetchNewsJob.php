<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Actions\News\CreateUpdateNewsItemAction;
use App\NewsAggregator\Enums\NewsProviderCategory;
use App\NewsAggregator\Factories\NewsProviderFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class FetchNewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public NewsProviderCategory $category) {}

    public function handle(CreateUpdateNewsItemAction $createUpdateNewsItemAction): void
    {
        logger()->info('Fetching news items');

        $provider = NewsProviderFactory::make($this->category);

        $createUpdateNewsItemAction->handle($provider->fetch());

        logger()->info('Terminated fetching news items');
    }
}
