<?php 

namespace App\Controller;

use \Psr\Http\Message\ResponseInterface as Response;

class DefaultController {

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function render(Response $response, $view, $params = []) {
        $this->container->view->render($response, $view, $params);
    }
}