<?php

declare(strict_types=1);

namespace App\NewsAggregator\Contracts;

use App\NewsAggregator\DTOs\NewsItemDto;

interface NewsProviderInterface
{
    /** @return NewsItemDto[] */
    public function fetch(): array;
}
