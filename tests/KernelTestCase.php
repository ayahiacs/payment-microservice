<?php

namespace App\Tests;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as SymfonyKernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

abstract class KernelTestCase extends SymfonyKernelTestCase
{
    protected Application $application;
    protected ContainerInterface $container;
    
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->application = new Application(self::$kernel);
        $this->container = self::$kernel->getContainer();
    }

    protected function executeCommand(string $command, array $arguments = []): CommandTester
    {
        $commandTester = new CommandTester($this->application->find($command));
        $commandTester->execute($arguments);
        
        return $commandTester;
    }
}