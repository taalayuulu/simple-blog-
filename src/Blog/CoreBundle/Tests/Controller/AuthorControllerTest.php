<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AuthorControllerTest
 */
class AuthorControllerTest extends WebTestCase
{
    /*
     * Test show author action :)
     */
    public function testShow()
    {
        $client = static::createClient();
        /** @var Author $author */
        $author = $client->getContainer()->get('doctrine')->getManager->getRepository('ModelBundle:Author')->findFirst();
        $authorPostsCount = $author->getPosts()->count();
        $crawler = $client->request('GET', '/author/'.$author->getSlug());
        $this->assertTrue($client->getResponse()->isSuccessful(),'The responce was not successfull Salak!');
        $this->assertCount($authorPostsCount,$crawler->filter('h2'),'ulan salak bu'.$authorPostsCount.'buna benzemesi lazim');
    }

}
