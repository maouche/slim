<?php 

namespace App\Middleware;

// use Slim\Http\Request;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use HTMLPurifier;
use HTMLPurifier_Config;


class XssMiddleware { 

    /**
     * XssMiddleware middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        // saved original data in request
        $request = $request->withAttribute('original_data', $request->getParsedBody());


        $parsedBody = $request->getParsedBody();
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $filtredData = [];
        foreach ($parsedBody as $key => $value) {
            $filtredData[$key] = $purifier->purify($value);


            // set code 500 if any value is empty
            if (empty($purifier->purify($value)) && $response->getStatusCode()) {
                $response = $response->withStatus(500);
            }
        }
        

        $request = $request->withParsedBody($filtredData);
        $response = $next($request, $response);
        
        return $response;
    }


}