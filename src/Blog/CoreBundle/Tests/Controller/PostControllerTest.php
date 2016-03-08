<?php

namespace Blog\CoreBundle\Tests\Controller;

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


}
