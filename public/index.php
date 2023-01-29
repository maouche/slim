<?php

require '../vendor/autoload.php';

use App\Controller\PagesController;
use App\Middleware\XssMiddleware;

$app = new \Slim\App([
    "settings" => [
        'displayErrorDetails' => true
    ]
]);

require '../src/container.php';


$app->get('/', PagesController::class . ':home')->setName('home');

$app->get('/contact', PagesController::class . ':getContact')->setName('contact');

$app
    ->post('/contact', PagesController::class . ':postContact')
    ->add(new XssMiddleware())
;



$app->run();