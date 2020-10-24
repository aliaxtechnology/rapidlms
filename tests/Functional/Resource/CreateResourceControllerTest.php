<?php


namespace Lms\Tests\Functional\Resource;


use Lms\Tests\Functional\ApiFunctionalTestCase;
use Lms\Tests\Functional\DataFixtures\FileFixtures;

final class CreateResourceControllerTest extends ApiFunctionalTestCase
{

    public function testCreateResource()
    {
        $this->loadFixture(new FileFixtures());

        $this->post('/resources', [
            'name' => 'module de test',
            'type' => 'quiz',
            'preview' => 1
        ]);


        $this->assertResponseIsSuccessful();
    }
}