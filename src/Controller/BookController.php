<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book/{id}', name: 'search_bookId')]
    public function bookById(BookRepository $bookRepository, int $id): Response
    {
        $book = $bookRepository->find($id);
        return $this->render('book/search_bookId.html.twig', [
            "result" => $book,
        ]);
    }
}
