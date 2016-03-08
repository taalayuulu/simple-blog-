<?php

namespace Blog\ModelBundle\Repository;
use Blog\ModelBundle\Entity\Post;
use Doctrine\ORM\EntityRepository ;
/**
 * PostRepository
 */
class PostRepository extends EntityRepository
{
    /**
     * Find Latest
     * @param $num
     * @return array
     */
    public function findLatest($num)
    {
      $qb = $this->getQueryBuilder()
          ->orderBy('p.createdAt','desc')
          ->setMaxResults($num);
      return $qb->getQuery()->getResult();
    }

    /**
     * Find first post
     * @return Post
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('p.id','asc')
            ->setMaxResults(1);
        return $qb->getQuery()->getSingleResult();
    }
    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();
        $qb = $em->getRepository('ModelBundle:Post')
            ->createQueryBuilder('p');
        return $qb;
    }
}
