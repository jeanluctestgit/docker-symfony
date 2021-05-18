<?php

namespace Itech\Controller;

use Itech\Model\Article;
use Itech\Repository\ArticleManager;
use Itech\Repository\DBA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
    /**
     * @var ArticleManager
     */
    private ArticleManager $articleManager;

    public function __construct()
    {
        $dba = new DBA();
        $this->articleManager = new ArticleManager($dba->getPDO());
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $articles = $this->articleManager->getArticles();
        return new Response(json_encode($articles));
    }

    public function show($id): Response
    {
        $article = $this->articleManager->getArticle($id);
        return new Response(json_encode($article));
    }

    public function delete($id): Response
    {
        $this->articleManager->deleteArticle($id);
        return new Response('delete');
    }

    public function update(Request $request, $id): Response
    {
        $article = $request->toArray();
        $article['id'] = $id;
        $this->articleManager->updateArticle(new Article($article));
        return new Response('update');
    }

    public function add(Request $request): Response
    {
        $article = $request->toArray();
        $this->articleManager->addArticle(new Article($article));
        return new Response('add');
    }
}
