<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'GPS Tracker');
    }

    public function testLint()
    {
        $output = shell_exec('phpcs --standard=PSR2 src/');
        $this->assertEmpty($output, "PHP_CodeSniffer found coding standard violations:\n$output");
    }
}
