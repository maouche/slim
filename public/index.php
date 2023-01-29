<?php

require '../vendor/autoload.php';


$app = new \Slim\App([
    "settings" => [
        'displayErrorDetails' => true
    ]
]);

require '../src/container.php';


$app->get('/', App\Controller\PagesController::class . ':home')->setName('home');

$app->get('/contact', App\Controller\PagesController::class . ':getContact')->setName('contact');



$app->run();