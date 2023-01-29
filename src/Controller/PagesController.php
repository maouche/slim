<?php 


namespace App\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class PagesController {

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function home(Request $request, Response $response, array $args) {
        return $this->render($response, '/pages/home.twig');
    }
    
    public function getContact(Request $request, Response $response, array $args) {
        return $this->render($response, '/pages/contact.twig');
    }

    public function render($response, $view, $params = []) {
        $this->container->view->render($response, $view, $params);
    }
}