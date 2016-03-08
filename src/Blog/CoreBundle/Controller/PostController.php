<?php

namespace Blog\CoreBundle\Controller;

use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
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
        $form = $this ->createForm(CommentType::class);
        return array(
          'post' => $post,
           'form' => $form->createView()
        );
    }

    /**
     * Create Comment
     * @param Request $request
     * @param  string  $slug
     * @throws NotFoundHttpException
     * @return array
     * @Route("/{slug}/create-comment")
     * @Method("POST")
     * @Template("CoreBundle:Post:show.html.twig")
     */
    public function createCommentAction(Request $request , $slug)
    {
        $post = $this->getDoctrine()->getRepository('ModelBundle:Post')->findOneBy(
          array(
              'slug'=>$slug
          )
        );
        if (null === $post) {
            throw $this->createNotFoundException('Post was not Found lan iyi back lan!');
        }
        $comment = new Comment();
        $comment->setPost($post);
        $form = $this->createForm(CommentType::class ,$comment);
        $form->handleRequest($request);

        if($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success','Your comment was submitted successfully ! лан бежердин я');
            return $this->redirect($this->generateUrl('blog_core_post_show',array('slug'=>$post->getSlug())));
        }

        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }
}
