<?php
namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id = 0;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password = '';


    /**
    * @ORM\OneToMany(targetEntity="Article", mappedBy="user")
    */
    private $articles;

    use \Traits\ArrayMappable;

    public function __construct(array $data = []) {
        $this->mapFromArray($data);
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->getEmail();
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


    // Getter und Setter
    public function getArticles() {
        return $this->articles;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
}
