<?php


namespace Lms\Tests\Functional;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
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

    protected function post(string $route, array $data = array()): void
    {
        $this->client->request('POST', $route, [], [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data));
    }


    protected function loadFixture(FixtureInterface $fixture): void
    {
        $fixtureLoader = new ContainerAwareLoader(self::$kernel->getContainer());
        $fixtureLoader->addFixture($fixture);

        $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();

        $executor = new ORMExecutor($entityManager, new ORMPurger($entityManager));
        $executor->execute($fixtureLoader->getFixtures());
    }

}