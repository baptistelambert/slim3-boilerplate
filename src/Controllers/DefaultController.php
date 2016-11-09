<?php
namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DefaultController extends Controller
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'default/index.twig');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function hello(RequestInterface $request, ResponseInterface $response)
    {
        $name = $request->getAttribute('name');

        return $this->render($response, 'default/hello.twig', [
            'name' => $name
        ]);
    }
}