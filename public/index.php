<?php

use Application\Api\FeedbackAction;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
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
];

// Create Container using PHP-DI
$builder = new ContainerBuilder();
// put config into container
$builder->addDefinitions($config);
$container = $builder->build();

// Set container to create App with AppFactory
AppFactory::setContainer($container);
$app = AppFactory::create();

$app->post('/feedback', FeedbackAction::class);

$app->run();