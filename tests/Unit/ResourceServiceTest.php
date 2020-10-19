<?php


namespace Lms\Tests\Unit;


use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Repository\ResourceRepository;
use Lms\Resource\Services\Command\CreateResource;
use Lms\Resource\Services\ResourceService;
use PHPUnit\Framework\TestCase;

final class ResourceServiceTest extends TestCase
{

    public function testCreateResource()
    {
        // GIVEN
        $command = new CreateResource("module de test");
        $stubResourceRepo = $this->createMock(ResourceRepository::class);
        $stubResourceRepo->method('nextIdentity')->willReturn(new ResourceId(5));
        $stubResourceRepo->expects($this->once())->method('save');

        // WHEN
        $service = new ResourceService($stubResourceRepo);
        $resourceId = $service->create($command);

        // THEN
        $this->assertEquals(5, $resourceId->asString());
    }
}