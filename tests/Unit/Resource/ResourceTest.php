<?php


namespace Lms\Tests\Unit;


use Lms\Resource\Entity\PreviewId;
use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Entity\ResourceType;
use Lms\Resource\Event\ResourceCreated;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{

    public function testResourceCreated() {

        // GIVEN
        $resourceId = new ResourceId(1);
        $name = 'Module 1';
        $type = ResourceType::fromString('quiz');
        $previewId = new PreviewId(5);


        // WHEN
        $resource = Resource::create($resourceId, $name, $type, $previewId);

        // THEN
        $events = $resource->popEvents();

        $this->assertCount(1, $events);
        $this->assertInstanceOf(ResourceCreated::class, $events[0]);

        $expected = [
            'resource_id' => $resourceId->asString(),
            'name' => $name,
            'type' => $type->asString(),
            'preview_id' => $previewId->asString(),
        ];
        $this->assertSame($expected, $events[0]->asArray());

    }
}