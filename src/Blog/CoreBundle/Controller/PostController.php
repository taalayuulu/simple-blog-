<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * @return array
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findAll();
         $latestPost = $this->getDoctrine()->getRepository('ModelBundle:Post')->findLatest(5);
        return $this->render('CoreBundle:Post:index.html.twig', array(
            'post'=>$posts,
            'latestPost'=>$latestPost
        ));
    }

    /**
     * Show a post
     * @param string $slug
     * @throws NotFoundHttpException
     * @return array
     * @Route("/{slug}")
     * @Template
     */
    public function showAction($slug)
    {
         $post=$this->getDoctrine()->getRepository('ModelBundle:Post')->findOneBy(
             array(
                 'slug' =>$slug
             )
         );
        if(null === $post)
        {
            throw $this->createNotFoundException('Post was not found');
        }
        return array(
          'post' => $post
        );
    }

}
