<?php

namespace App\Application\UseCase\Review\ReviewList;

use App\Application\Contracts\UseCaseInterface;
use App\Domain\Service\ReviewServiceInterface;

class ReviewListUseCase implements UseCaseInterface
{

    /** @var ReviewServiceInterface */
    private $managerService;

    /**
     * @param ReviewServiceInterface $managerService
     */
    public function __construct(ReviewServiceInterface $managerService)
    {
        $this->managerService = $managerService;
    }

    /**
     * @param $request
     * @return ReviewListResponse
     */
    public function run($request): ReviewListResponse
    {
        $response = new ReviewListResponse();
        $response->items = $this->managerService->list();
        return $response;
    }
}
