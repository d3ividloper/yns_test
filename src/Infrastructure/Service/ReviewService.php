<?php

namespace App\Infrastructure\Service;

use App\Domain\Model\Review;
use App\Domain\Model\ReviewRepositoryInterface;
use App\Domain\Service\ReviewServiceInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ReviewService implements ReviewServiceInterface {
    /** @var ReviewRepositoryInterface */
    private $repository;

    public function __construct(ReviewRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function list(): array
    {
        try {
            return $this->repository->list();
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @param $user
     * @param $text
     * @param $averageRating
     * @return Review
     */
    public function create($user, $text, $averageRating): Review
    {
        // TODO: check input data
        $item = new Review();
        $item->setUser($user);
        $item->setText($text);
        $item->setAverageRating($averageRating);
        try {
            $this->repository->save($item);
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        return $item;
    }
}
