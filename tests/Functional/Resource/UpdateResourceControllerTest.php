<?php


namespace Lms\Tests\Functional\Resource;


use Lms\Tests\Functional\ApiFunctionalTestCase;
use Lms\Tests\Functional\DataFixtures\FileFixtures;
use Lms\Tests\Functional\DataFixtures\ResourceFixtures;

final class UpdateResourceControllerTest extends ApiFunctionalTestCase
{

    public function testUpdateNameResource()
    {
        $this->loadFixture(new FileFixtures());
        $this->loadFixture(new ResourceFixtures());

        $this->put('/resources', [
            'resource_id' => 4,
            'name' => 'module de test',
        ]);

        $this->assertResponseIsSuccessful();
    }
}