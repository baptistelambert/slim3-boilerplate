<?php
namespace Src\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ValidationErrorMiddleware extends Middleware
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param $next
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next)
    {
        if (isset($_SESSION['errors'])) {
            $this->container->get('view')
                ->getEnvironment()
                ->addGlobal('errors', $_SESSION['errors'])
            ;

            unset($_SESSION['errors']);
        }

        $response = $next($request, $response);

        return $response;
    }
}