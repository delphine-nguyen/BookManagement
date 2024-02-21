<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;

use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route("/create/book", name: "create_book", methods: ["GET", "POST"])]
    public function createBook(Request $request, EntityManagerInterface $manager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($book);
            $manager->flush();
            return $this->redirectToRoute("app_home");
        }
        return $this->render("book/create_book.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
