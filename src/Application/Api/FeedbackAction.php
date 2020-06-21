<?php

namespace Application\Api;

use Factory\FeedbackEntityFactory;
use Feedback\Feedback;
use Feedback\FeedbackId;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;
use Repository\SQLFeedbackRepository;

/**
 * Class FeedbackAction
 * @package Application\Api
 */
class FeedbackAction
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args) {
        // validate data
            // TODO

        // create feedback object
        $feedback = new Feedback(
            new FeedbackId(Uuid::uuid4()->toString()),
            $request->getParsedBody()['text'],
            new \DateTimeImmutable()
        );

        // store in DB
        // TODO: get repository from container
        $feedbackRepository = new SQLFeedbackRepository(
            new \PDO($this->container->get('database_host'))
        );
        
        $feedbackRepository->store(
            FeedbackEntityFactory::createFromFeedback($feedback)
        );

        $response->getBody()->write(json_encode($feedback));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}