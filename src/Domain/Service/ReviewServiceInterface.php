<?php

namespace App\Domain\Service;

use App\Domain\Model\Review;

interface ReviewServiceInterface
{
    /**
     * @param $user
     * @param $text
     * @param $averageRating
     * @return mixed
     */
    public function create($user, $text, $averageRating): Review;

    /**
     * @return array
     */
    public function list(): array;
}
