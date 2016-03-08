<?php

namespace Blog\CoreBundle\Tests\Controller;

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

        $crawler = $client->request('GET', '/show');
    }

}
