<?php


namespace Lms\Tests\Unit;


use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Event\ResourceCreated;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{

    public function testResourceCreated() {

        // GIVEN
        $resourceId = new ResourceId(1);
        $name = 'Module 1';

        // WHEN
        $resource = Resource::create($resourceId, $name);

        // THEN
        $events = $resource->popEvents();

        $this->assertCount(1, $events);
        $this->assertInstanceOf(ResourceCreated::class, $events[0]);
        $this->assertSame(['resource_id' => $resourceId->asString(), 'name' => $name], $events[0]->asArray());

    }
}