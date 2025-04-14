<?php

namespace App\Jobs;

use App\Actions\NewsItem\CreateUpdateNewsItemAction;
use App\NewsAggregator\Enums\NewsProviderCategory;
use App\NewsAggregator\Factories\NewsProviderFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchNewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public NewsProviderCategory $category) {}

    public function handle(CreateUpdateNewsItemAction $createUpdateNewsItemAction): void
    {
        logger()->info("Fetching news items");

        $provider = NewsProviderFactory::make($this->category);

        $createUpdateNewsItemAction->handle($provider->fetch());

        logger()->info("Terminated fetching news items");
    }
}
