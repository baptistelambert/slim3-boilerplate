<?php
namespace Src\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Container;

class Controller
{
    /** @var Container */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param ResponseInterface $response
     * @param string $templateFile
     * @param array $viewData
     *
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $templateFile, array $viewData = [])
    {
        return $this->container->get('view')->render($response, $templateFile, $viewData);
    }

    /**
     * @param ResponseInterface $response
     * @param string $routeName
     *
     * @return ResponseInterface
     */
    public function redirect(ResponseInterface $response, $routeName)
    {
        return $response->withStatus(302)->withHeader('Location', $this->router->pathFor($routeName));
    }

    /**
     * @param string $name
     *
     * @return object
     */
    public function __get($name)
    {
        if ($this->container->{$name}) {
            return $this->container->{$name};
        }
    }
}