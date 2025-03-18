<?php

namespace App\Tests;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as SymfonyWebTestCase;

abstract class WebTestCase extends SymfonyWebTestCase
{
    protected KernelBrowser $client;
    protected ContainerInterface $container;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->container = self::$kernel->getContainer();
    }
}