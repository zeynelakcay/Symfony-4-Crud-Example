<?php 

namespace App\Service\Admin;

use App\Service\AbstractService;
use Doctrine\ORM\EntityManager;


class ArticleService extends AbstractService
{

    public function __construct(EntityManager $em, $entityName)
    {
        parent::__construct($em,$entityName);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getArticle($article_id)
    {
        return $this->find($article_id);
    }

    public function getAllArticles()
    {
        return $this->findAll();
    }

    public function addArticle($object)
    {
        return $this->save($object);
    }

    public function deleteArticle($id)
    {
        return $this->delete($this->find($id));
    }



}