<?php
/**
 * Created by PhpStorm.
 * User: zakcay
 * Date: 31.01.2019
 * Time: 14:06
 */

namespace App\Service\Admin;

use App\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class CategoryService extends AbstractService
{
    public function __construct(EntityManager $em, $entityName)
    {
        parent::__construct($em, $entityName);
    }

    public function getCategory($article_id)
    {
        return $this->find($article_id);
    }

    public function getCategories()
    {
        return $this->findAll();
    }

    public function addCategory($object)
    {
        return $this->save($object);
    }

    public function deleteCategory($id)
    {
        return $this->delete($this->find($id));
    }

    public function getModel()
    {
        return $this->model;
    }
}