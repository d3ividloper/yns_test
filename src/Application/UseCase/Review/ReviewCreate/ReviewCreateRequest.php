<?php

namespace App\Application\UseCase\Review\ReviewCreate;

class ReviewCreateRequest
{
    /** @var string */
    public $user;
    /** @var string */
    public $text;
    /** @var float */
    public $averageRating;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->user = $data['user'];
        $this->text = $data['text'];
        $this->averageRating = $this->setAverageRating($data['ratings']);
    }

    private function setAverageRating(array $values): float {
        $total = 0.00;

        if(empty($values)) return $total;

        foreach ($values as $rating) {
            if (!is_numeric($rating)) $rating = 0;
            if ($rating > 5) $rating = 5;
            $total += $rating;
        }
        return $total/4;
    }
}
