<?php


namespace App\Tests\Application\UseCase\Review;

use App\Application\UseCase\Review\ReviewCreate\ReviewCreateRequest;
use App\Application\UseCase\Review\ReviewCreate\ReviewCreateResponse;
use App\Application\UseCase\Review\ReviewCreate\ReviewCreateUseCase;
use App\Infrastructure\Persistence\Doctrine\ReviewRepository;
use App\Infrastructure\Service\ReviewService;
use PHPUnit\Framework\TestCase;


class ReviewCreateTest extends TestCase
{
    public function testShouldCreateAReview()
    {
        $reviewRepo = $this->createMock(ReviewRepository::class);
        $service = new ReviewService($reviewRepo);
        $useCase = new ReviewCreateUseCase($service);
        $response = $useCase->run($this->getRequest());

        $this->assertInstanceOf(ReviewCreateResponse::class, $response);

    }

    private function getRequest(): ReviewCreateRequest
    {
        $requestData = [
            'user' => 'Son Gohan',
            'text' => 'Review about Son gohan life',
            'ratings' => [4.5, 5, 3, 3.7, 5],
        ];
        return new ReviewCreateRequest($requestData);
    }
}
