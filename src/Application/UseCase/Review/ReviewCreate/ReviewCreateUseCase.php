<?php

namespace App\Application\UseCase\Review\ReviewCreate;

use App\Application\Contracts\UseCaseInterface;
use App\Domain\Service\ReviewServiceInterface;

class ReviewCreateUseCase implements UseCaseInterface
{
    /** @var ReviewServiceInterface */
    private $managerService;

    public function __construct(ReviewServiceInterface $managerService)
    {
        $this->managerService = $managerService;
    }

    public function run($request): ReviewCreateResponse
    {
        $response = new ReviewCreateResponse();
        $createdItem = $this->managerService->create(
            $request->user,
            $request->text,
            $request->averageRating
        );
        $response->item = $createdItem;
        return $response;
    }
}
