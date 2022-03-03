<?php

namespace App\Application\UseCase\Review\ReviewList;

use App\Domain\Model\Review;
use phpDocumentor\Reflection\Types\Collection;

class ReviewListResponse
{
    /** @var Review[] */
    public $items;
}
