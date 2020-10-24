<?php


namespace Lms\Tests\Unit;


use Lms\Resource\Entity\ResourceType;
use Lms\Resource\Services\Command\CreateResource;
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
}