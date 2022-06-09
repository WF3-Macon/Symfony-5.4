<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'article' => $articleRepository->find(4),
            'post' => $articleRepository->findOneBy(['title' => 'Titre_7'], ['created_at' => 'DESC']),
            'posts' => $articleRepository->findBy(['created_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-06-08 08:23:03')]),
            'results' => $articleRepository->findByTitleOrDescription('Titre_122', 'Description_200')
        ]);
    }

    #[Route('/article/relation', name: 'app_article_relation')]
    public function relations(AuthorRepository $authorRepository): Response
    {
        return $this->render('article/relations.html.twig', [
            'authors' => $authorRepository->findAll()
        ]);
    }

    #[Route('/author/new', name:'author_new')]
    public function newAuthor(Request $request, AuthorRepository $authorRepository): Response
    {
        // Déclare un objet vide dépendant de l'entité "Author"
        $author = new Author();
        // dump($author);

        // Créer le formulaire
        $form = $this->createForm(AuthorFormType::class, $author);

        // Remplis l'objet "$author" des données du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dump($author);
            $authorRepository->add($author, true);

            $this->addFlash('success', 'Votre auteur à bien été enregistré !');

            $author = new Author();
            $form = $this->createForm(AuthorFormType::class, $author);
        }

        return $this->render('home/newAuthor.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
