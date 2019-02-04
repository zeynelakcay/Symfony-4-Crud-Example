<?php

namespace App\Entity\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
   * @ORM\Column(type="text", length=100)
   */
   private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Admin\Article", mappedBy="category")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    /**
     * @return mixed
     */

      public function getId(){
        return $this->id;
      }

        /**
         * @return mixed
         */
      public function getTitle(){
        return $this->title;
      }

        /**
         * @param $title
         */
      public function setTitle($title){
        $this->title = $title;
      }

}
