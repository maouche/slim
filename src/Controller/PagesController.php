<?php 


namespace App\Controller;

use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Controller\DefaultController;

class PagesController extends DefaultController {

    public function home(Request $request, Response $response, array $args) {
        return $this->render($response, '/pages/home.twig');
    }
    
    public function getContact(Request $request, Response $response, array $args) {
        return $this->render($response, '/pages/contact.twig');
    }
    
    public function postContact($request, Response $response, array $args) {
        $data = $request->getParsedBody();

        return $this->render($response, '/pages/contact.twig', [
            'debug' => true,
            'data' => $data
        ]);
    }
}