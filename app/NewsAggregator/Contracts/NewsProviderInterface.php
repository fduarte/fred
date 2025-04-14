<?php

namespace App\NewsAggregator\Contracts;
use App\NewsAggregator\DTOs\NewsItemDto;

interface NewsProviderInterface
{
    /** @return NewsItemDto[] */
    public function fetch(): array;
}
