<?php

namespace App\Console\Commands;

use App\Jobs\FetchNewsJob;
use App\NewsAggregator\Enums\NewsProviderCategory;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class FetchNewsCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news {category=laravel}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news from various sources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $category = $this->argument('category');
        $newsCategoryEnum = NewsProviderCategory::tryFrom($category);

        if (! $newsCategoryEnum) {
            $this->error('Invalid category: {$category}');

            return;
        }

        dispatch(new FetchNewsJob($newsCategoryEnum));
    }
}
