<?php

namespace App\Api\Contracts;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AbstractApiController extends AbstractController
{
    /** @var LoggerInterface $logger */
    protected $logger;
    protected $serializer;

    /** @var TranslatorInterface $translator */
    protected $translator;

    public function __construct(
        LoggerInterface $logger,
        SerializerInterface $serializer,
        TranslatorInterface $translator = null
    ) {
        $this->logger = $logger;
        $this->translator = $translator;
        $this->serializer = $serializer;
    }
}
