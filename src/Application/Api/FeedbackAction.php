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

        $id = new FeedbackId(Uuid::uuid4()->toString());


        // create feedback object
        $feedback = new Feedback(
            $id,
            $request->getParsedBody()['text'],
            new \DateTimeImmutable()
        );

        // create feedback entity
        $feedbackEntity = FeedbackEntityFactory::createFromFeedback($feedback);

        // store entity in DB
        // TODO: put this into config
        $dbPath = __DIR__ . '/../../../database/feedback.sqlite3';

        // TODO: get repository from container
        $feedbackRepository = new SQLFeedbackRepository(new \PDO('sqlite:' . $dbPath));
        $feedbackRepository->store($feedbackEntity);

        // return 201
        $payload = json_encode($feedback);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}