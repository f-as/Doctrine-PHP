<?php
namespace Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Webmasters\Doctrine\ORM\Util;

/**
 * @ORM\Entity
 * @ORM\Table(name="articles")
 */
class Article {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id = 0;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $teaser = '';

    /**
     * @ORM\Column(type="text")
     */
    private $news = '';

    /**
    * @ORM\Column(name="created_at", type="datetime")
    * @Gedmo\Timestampable(on="create")
    */
    private $createdAt;

    /**
    * @ORM\Column(name="publish_at", type="datetime")
    */
    private $publishAt;

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
    */
    private $user;

    /**
    * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
    * @ORM\JoinTable(name="tagging")
    */
    private $tags;

    use \Traits\ArrayMappable;

    public function __construct(array $data = []) {
        $this->mapFromArray($data);
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }



    public function clearTags() {
        $this->tags->clear();
    }

    public function addTag(Tag $tag) {
        $this->tags->add($tag);
    }

    public function hasTag(Tag $tag) {
        return $this->tags->contains($tag);
    }

    public function removeTag(Tag $tag) {
        $this->tags->removeElement($tag);
    }

    public function getTags() {
        return $this->tags;
    }



    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getUser() {
        return $this->user;
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

    public function getTeaser() {
        return $this->teaser;
    }

    public function setTeaser($teaser) {
        $this->teaser = $teaser;
        return $this;
    }

    public function getNews() {
        return $this->news;
    }

    public function setNews($news) {
        $this->news = $news;
        return $this;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setPublishAt($publishAt) {
        $this->publishAt = new Util\DateTime($publishAt);
        return $this;
    }

    public function getPublishAt() {
        return new Util\DateTime($this->publishAt);
    }

    public function getCreatedAt() {
        return new Util\DateTime($this->createdAt);
    }

}
