<?php

namespace Blog\ModelBundle\Repository;
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
    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();
        $qb = $em->getRepository('ModelBundle:Post')
            ->createQueryBuilder('p');
        return $qb;
    }
}
