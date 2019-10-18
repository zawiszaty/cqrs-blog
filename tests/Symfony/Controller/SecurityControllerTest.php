<?php

declare(strict_types=1);

namespace Tests\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function test_it_login()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $form = $crawler->selectButton('Sign in')->form();
        $form['username'] = 'test';
        $form['password'] = 'test123';
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertSame('http://localhost/', $crawler->getUri());
    }
}
