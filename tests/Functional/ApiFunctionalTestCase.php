<?php


namespace Lms\Tests\Functional;


use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ApiFunctionalTestCase extends WebTestCase
{

    public function post(string $route, array $data = array()): KernelBrowser
    {
        $client = static::createClient();
        $client->request('POST', $route, [], [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data));

        return $client;
    }
}