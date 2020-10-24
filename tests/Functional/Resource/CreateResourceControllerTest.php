<?php


namespace Lms\Tests\Functional\Resource;


use Lms\Tests\Functional\ApiFunctionalTestCase;

final class CreateResourceControllerTest extends ApiFunctionalTestCase
{

    public function testCreateResource()
    {
        $this->post('/resources', [
            'name' => 'module de test',
            'type' => 'quiz',
            'preview' => 1
        ]);


        $this->assertResponseIsSuccessful();
    }
}