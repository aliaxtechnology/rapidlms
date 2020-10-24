<?php


namespace Lms\Tests\Unit\Resource;


use Lms\Resource\Entity\PreviewId;
use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Entity\ResourceType;
use Lms\Resource\Services\Command\CreateResource;
use Lms\Resource\Services\Command\UpdateResource;
use Lms\Resource\Services\ResourceService;
use Lms\Storage\Entity\File;
use Lms\Storage\Entity\FileId;
use Lms\Tests\Unit\Resource\Repository\MemoryResourceRepository;
use Lms\Tests\Unit\Storage\Repository\MemoryFileRepository;
use PHPUnit\Framework\TestCase;

final class ResourceServiceTest extends TestCase
{

    public function testCreateResourceService()
    {
        // GIVEN
        $command = CreateResource::fromRequest([
            'name' => 'Module 1',
            'type' => ResourceType::QUIZ,
            'preview' => 4
        ]);

        $resourceRepo = new MemoryResourceRepository();
        $fileRepo = new MemoryFileRepository([4 => File::create(new FileId(1), 'preview.png', 'previews', 'local')]);

        // WHEN
        $service = new ResourceService($resourceRepo, $fileRepo);
        $resourceId = $service->create($command);

        // THEN
        $this->assertEquals(1, $resourceId->asString());
    }


    public function testChangeNameResourceService()
    {
        // GIVEN
        $command = UpdateResource::fromRequest([
            'resource_id' => 1,
            'name' => 'Module 7'
        ]);

        $resourceId = new ResourceId(1);
        $resourceRepo = new MemoryResourceRepository([
            $resourceId->asString() => Resource::create($resourceId,
                'Module 4',
                ResourceType::fromString('quiz'),
                new PreviewId(14)
            )
        ]);
        $fileRepo = new MemoryFileRepository();

        // WHEN
        $service = new ResourceService($resourceRepo, $fileRepo);
        $service->update($command);

        $resource = $resourceRepo->getById($resourceId);

        // THEN
        $this->assertEquals('Module 7', $resource->name());
    }
}