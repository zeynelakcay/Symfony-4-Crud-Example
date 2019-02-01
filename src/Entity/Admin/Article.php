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
