<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class PageRendering extends WebTestCase
{
    public function testDoesPizzaAppExist()
    {
        $client = static::createClient();

        $client->request('GET', '/index');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    
    
    public function testContentIndexPage1(){
        $client = static::createClient();

        $client->request('GET', '/index');

        $this->assertContains(
            'Welcome',
            $client->getResponse()->getContent()
        );
    }
    
    
    
    public function testContentIndexPage2(){
        $client = static::createClient();

        $client->request('GET', 'index');

        $this->assertContains(
            'Register',
            $client->getResponse()->getContent()
        );
    }
	    
    
    public function testContentIndexPage3(){
        $client = static::createClient();

        $client->request('GET', 'index');

        $this->assertContains(
            'Login',
            $client->getResponse()->getContent()
        );
    } 
    
    
}