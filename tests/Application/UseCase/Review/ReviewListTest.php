<?php


namespace App\Tests\Application\UseCase\Review;

use App\Application\UseCase\Review\ReviewList\ReviewListRequest;
use App\Application\UseCase\Review\ReviewList\ReviewListResponse;
use App\Application\UseCase\Review\ReviewList\ReviewListUseCase;
use App\Infrastructure\Persistence\Doctrine\ReviewRepository;
use App\Infrastructure\Service\ReviewService;
use PHPUnit\Framework\TestCase;


class ReviewListTest extends TestCase
{
    public function testShouldListResults()
    {
        $reviewRepo = $this->createMock(ReviewRepository::class);
        $service = new ReviewService($reviewRepo);
        $useCase = new ReviewListUseCase($service);
        $response = $useCase->run($this->getRequest());

        $this->assertInstanceOf(ReviewListResponse::class, $response);

    }

    private function getRequest(): ReviewListRequest
    {
        // If use filters, pagination, I will set here.
        $requestData = [];
        return new ReviewListRequest($requestData);
    }
}
