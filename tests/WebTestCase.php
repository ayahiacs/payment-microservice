<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as SymfonyWebTestCase;

abstract class WebTestCase extends SymfonyWebTestCase
{
    protected KernelBrowser $client;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }
}