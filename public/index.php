<?php

use Application\Api\FeedbackAction;
use Application\Utility\VerifySlackSignatureFromRequest;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

date_default_timezone_set('UTC');

require __DIR__ . '/../vendor/autoload.php';

// load .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = [
    'database_host' => $_ENV['DATABASE_HOST'],
    'slack_signing_secret' => $_ENV['SLACK_SIGNING_SECRET']
];

// Create Container using PHP-DI
$builder = new ContainerBuilder();

// put config into container
$builder->addDefinitions($config);
// put utility class into container
$builder->addDefinitions(
    [
        VerifySlackSignatureFromRequest::class => function(ContainerInterface $c) {
            return new VerifySlackSignatureFromRequest($c->get('slack_signing_secret'));
        },
    ]
);
// TODO: move config and custom class container definitions to separate files

$container = $builder->build();

// Set container to create App with AppFactory
AppFactory::setContainer($container);
$app = AppFactory::create();

// Catch and handle any uncaught exceptions
$app->addErrorMiddleware(true, true, true);

// Routing:
$app->post('/feedback', FeedbackAction::class);

$app->run();