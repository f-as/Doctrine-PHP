<?php
namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="Repositories\TagRepository")
* @ORM\Table(name="tags")
*/
class Tag {

    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    private $id = 0;

    /**
    * @ORM\Column(type="string", length=25, unique=true)
    */
    private $title = '';

    /**
    * @ORM\ManyToMany(targetEntity="Article", mappedBy="tags")
    */
    private $articles;

    use \Traits\ArrayMappable;

    public function __construct(array $data = []) {
        $this->mapFromArray($data);
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->getTitle();
    }

    public function clearArticles() {
        $this->articles->clear();
    }

    public function addArticle(Article $article) {
        $this->articles->add($article);
    }

    public function hasArticle(Article $article) {
        return $this->articles->contains($article);
    }

    public function removeArticle(Article $article) {
        $this->articles->removeElement($article);
    }

    public function getArticles() {
        return $this->articles;
    }


    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

}
