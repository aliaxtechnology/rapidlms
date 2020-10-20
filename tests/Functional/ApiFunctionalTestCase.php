<?php


namespace Lms\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;


abstract class ApiFunctionalTestCase extends WebTestCase
{

    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();

        $application = new Application(self::$kernel);
        $application->setAutoExit(false);

        $application->run(new StringInput('doctrine:migrations:migrate --env=test -n'));

    }

    public function post(string $route, array $data = array()): void
    {
        $this->client->request('POST', $route, [], [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data));
    }

}