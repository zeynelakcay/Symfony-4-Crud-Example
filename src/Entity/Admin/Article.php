<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Article
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
   * @ORM\Column(type="text")
   */
   private $body;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin\Category", inversedBy="articles")
     */
    private $category;

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


    //Getters & Setters
  public function getId(){
    return $this->id;
  }

  public function getTitle(){
    return $this->title;
  }

  public function getBody(){
    return $this->body;
  }

  public function setTitle($title){
    $this->title = $title;
  }

  public function setBody($body){
    $this->body = $body;
  }
}
