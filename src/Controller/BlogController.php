<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class BlogController extends AbstractController
{

  #[Route('/blog', name: 'article_list')]
  public function list(ArticleRepository $repository): Response
  {
    $articles = $repository->findAll();
    return $this->render('blog/article_list.html.twig', [
      'articles' => $articles,
    ]);
  }

  #[Route('/blog/{slug}', name: 'article_show')]
  public function show(string $slug, ArticleRepository $repository): Response
  {
    $articleToShow = $repository->findOneBy(['slug' => $slug]);
    return $this->render('blog/article.html.twig', [
      'article' => $articleToShow,
    ]);
  }

  #[Route('/blog/{id}/edit', name: 'article_edit')]
  public function editArticle(Article $article, Request $request, EntityManagerInterface $em): Response
  {
    $form = $this->createForm(ArticleType::class, $article);
    $requestedArticle = $request->request->all()["article"];
    $requestedArticle['date'] = (new \DateTime())->format('Y-m-d H:i:s');
    $request->request->add(['article' => $requestedArticle]);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      dd($request);
      $em->flush();
      return $this->redirectToRoute('article_list');
    }
    dd($article);
    return $this->render('blog/article_edit.html.twig', [
      'article' => $article,
      'form' => $form,
    ]);
  }
}
