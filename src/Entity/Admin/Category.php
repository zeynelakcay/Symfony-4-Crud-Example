<?php

namespace App\Entity\Admin;

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
