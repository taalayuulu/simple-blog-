<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful(),'The responce was not successfull ');
        $this->assertCount(3, $crawler->filter('h2'),'There should be 3 displayed posts');
    }

    /**
     * Test for show post
     */
    public function testShow()
    {
        $client = static::createClient();
        /** @var Post $post */
        $post = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Post')->findFirst();
        $crawler = $client->request('GET','/'.$post->getSlug());
        $this->assertTrue($client->getResponse()->isSuccessful(),'The responce was not successful');
        $this->assertEquals($post->getTitle(),$crawler->filter('h1')->text(), 'invalid post title');
        $this->assertGreaterThanOrEqual(1, $crawler->filter('article.comment')->count(),'There should be at least 1 comment lan!');
    }
}
