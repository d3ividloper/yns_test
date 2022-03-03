<?php

namespace App\Api\Controller;

use App\Api\Contracts\AbstractApiController;
use App\Application\UseCase\Review\ReviewCreate\ReviewCreateRequest;
use App\Application\UseCase\Review\ReviewCreate\ReviewCreateUseCase;
use App\Application\UseCase\Review\ReviewList\ReviewListRequest;
use App\Application\UseCase\Review\ReviewList\ReviewListUseCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("api/backoffice/")
 */
class ReviewApiController extends AbstractApiController
{
    /**
     * OperationOriginApiController constructor.
     *
     * @param LoggerInterface $logger
     * @param SerializerInterface $serializer
     */
    public function __construct(LoggerInterface $logger, SerializerInterface $serializer)
    {
        parent::__construct($logger, $serializer);
    }

    /**
     * @Route("review/form", name="backoffice_review_form", methods={"GET"})
     */
    public function form(): Response
    {
        /**
         * Usually I have worked at Symfony with backend API. I know that exists Symfony Form component
         * but in order to finish the task today I prefer make this approach.
         * Sorry for the inconvenience.
         * */
        return $this->render('reviews/review_form.html.twig', [ ]);
    }

    /**
     * @param Request $httpRequest
     * @param ReviewListUseCase $useCase
     * @return Response
     * @Route("review/list", name="backoffice_review_list", methods={"GET"} )
     */
    public function list(Request $httpRequest, ReviewListUseCase $useCase): Response
    {
        $data = json_decode($httpRequest->getContent(), true);
        $useCaseRequest = new ReviewListRequest($data);
        $response = $useCase->run($useCaseRequest);
        $dataToSerialize = [
          "data" => $response->items
        ];
        // Uncomment if we want to work as decoupled API (serve to frontend)
        // $data = $this->serializer->serialize($dataToSerialize['data'], 'json', ['groups' => ['full', 'reference']]);
        // return JsonResponse::fromJsonString($data);

        return $this->render('reviews/reviews_list.html.twig', [
            'items' => $response->items,
        ]);
    }


    /**
     * @param Request $httpRequest
     * @param ReviewCreateUseCase $useCase
     * @return Response
     * @Route("review", name="backoffice_review_create", methods={"POST"} )
     */
    public function create(Request $httpRequest, ReviewCreateUseCase $useCase): Response
    {
        try {
            $data = $this->setRequestData($httpRequest);
            $useCaseRequest = new ReviewCreateRequest($data);
            $response = $useCase->run($useCaseRequest);
            // Uncomment if we want to work as decoupled API (serve to frontend)
            // $data = $this->serializer->serialize($response->item, 'json', ['groups' => ['full', 'reference']]);
            // return JsonResponse::fromJsonString($data);

        } catch (\DomainException $e) {
            // TODO: implement Json responses for Exceptions (if necessary).
            return $this->json($e->getMessage());
        }

        return $this->redirectToRoute('backoffice_review_list');
    }

    /**
     * @param Request $data
     * @return array
     */
    private function setRequestData(Request $data): array
    {
        return [
            'user' => $data->request->get('user'),
            'text' => $data->request->get('text'),
            'ratings' => [
                $data->request->get('rating_0'),
                $data->request->get('rating_1'),
                $data->request->get('rating_2'),
                $data->request->get('rating_3'),
            ] ,
            ];
    }
}
