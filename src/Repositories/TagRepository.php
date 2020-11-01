<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;
use Entities\Tag;

class TagRepository extends EntityRepository {

    public function findDuplicates(Tag $tag) {

        $em = $this->getEntityManager();

        $query = $em
          ->createQueryBuilder()
          ->select('t')
          ->from('Entities\Tag', 't')
          ->where('t.title = :title')
          ->andWhere('t.id != :id')
          ->setParameter('title', $tag->getTitle())
          ->setParameter('id', $tag->getId())
          ->getQuery();

        return $query->getResult();

    }

}
