<?php

namespace Itech\Repository;
use Itech\Model\Article;

class ArticleManager {
    private \PDO $_db;

    public function __construct(\PDO $db) {
        $this->setDb($db);
    }

    public function setDb(\PDO $db) {
        $this->_db = $db;
    }

    public function addArticle(Article $article)
    {
        $ADD_ARTICLE = $this->_db->prepare('
            INSERT INTO poo.article 
            SET titre=:titre, auteur=:auteur, date=:date, image=:image, message=:message');

        $ADD_ARTICLE->bindValue(':titre', $article->getTitre());
        $ADD_ARTICLE->bindValue(':auteur', $article->getAuteur());
        $ADD_ARTICLE->bindValue(':image', $article->getImage());
        $ADD_ARTICLE->bindValue(':message', $article->getMessage());
        $ADD_ARTICLE->bindValue(':date', $article->getDate());

        $ADD_ARTICLE->execute();
    }

    public function getArticles(): array
    {
        $sth =  $this->_db->prepare(
            'SELECT * FROM poo.article'
        );

        $sth->execute();
        return $sth->fetchAll();
    }

    public function updateArticle(Article $article)
    {
        $UP_ARTICLE = $this->_db->prepare('
        UPDATE poo.article 
        SET titre=:titre, auteur=:auteur, image=:image, message=:message WHERE id=:id');
        $UP_ARTICLE->bindValue(':titre', $article->getTitre());
        $UP_ARTICLE->bindValue(':auteur', $article->getAuteur());
        $UP_ARTICLE->bindValue(':image', $article->getImage());
        $UP_ARTICLE->bindValue(':message', $article->getMessage());
        $UP_ARTICLE->bindValue(':id', $article->getId());
        $UP_ARTICLE->execute();
    }

    public function getArticle($article_id) {
        $ARTICLE = $this->_db->prepare('SELECT * FROM poo.article WHERE id=:id');
        $ARTICLE->bindValue(':id', $article_id);
        $ARTICLE->execute();
        return $ARTICLE->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteArticle($article_id) {
        $article_id = (int) $article_id;
        $ARTICLE = $this->_db->prepare('DELETE FROM poo.article WHERE id=:id');
        $ARTICLE->bindValue(':id', $article_id);
        $ARTICLE->execute();
    }
}
