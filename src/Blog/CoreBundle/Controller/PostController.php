<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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

}
