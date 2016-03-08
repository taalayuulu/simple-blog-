<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Class AuthorController
 */
class AuthorController extends Controller
{
     /**
     * Show author posts
      *
     * @param string $slug
      *
      * @throws NotFoundHttpException
      * @return array
     * @Route("/author/{slug}")
     * @Template
     */
    public function showAction($slug)
    {
        $author = $this->getDoctrine()->getRepository('ModelBundle:Author')->findOneBy(
         array(
             'slug' => $slug
         )
        );
        if(null=== $author)
        {
            throw $this->createNotFoundException('Author was not found man!');
        }
        $post = $this->getDoctrine()->getRepository('ModelBundle:Post')->findBy(
          array(
              'author' => $author
          )
        );
        return array(
            'author' => $author,
            'post' => $post
        );
    }

}
