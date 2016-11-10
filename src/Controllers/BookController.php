<?php
namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Src\Entity\Book;

class BookController extends Controller 
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $books = $this->container->get('em')->getRepository(Book::class)->findAll();

        return $this->render($response, 'book/index.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function book(RequestInterface $request, ResponseInterface $response)
    {
        $bookId = $request->getAttribute('id');
        $book = $this->container->get('em')->getRepository(Book::class)->find($bookId);

        return $this->render($response, 'book/book.twig', [
            'book' => $book,
        ]);
    }
}