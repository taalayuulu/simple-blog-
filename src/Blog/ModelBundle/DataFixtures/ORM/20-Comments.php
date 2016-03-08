<?php
/**
 * Created by PhpStorm.
 * User: kanat
 * Date: 3/8/16
 * Time: 8:06 PM
 */
namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Class Comment fixture
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface

{
    /**
     * {@inheritDoc}
     */
     public function getOrder()
     {
         return 20;
     }

    /**
     * {@inheritDoc}
     */
     public function load(ObjectManager $manager)
     {
         $post = $manager->getRepository('ModelBundle:Post')->findAll();

         $comments = array(
           0 => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
           1 => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.',
           2 => 'jfdoajfdlsafjdsalkfjdsk afd jsafjdsklajfdskla;fjdksalfjdsal;fj'
         );
         $i = 0;
         foreach ($post as $post) {
             $comment = new Comment();
             $comment->setAuthorName('CommentatorName');
             $comment->setBody($comments[$i++]);
             $comment->setPost($post);

             $manager->persist($comment);
         }
         $manager->flush();
     }

}