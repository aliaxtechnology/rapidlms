<?php


namespace Lms\Resource\Services;


use Lms\Resource\Entity\PreviewId;
use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Repository\ResourceRepository;
use Lms\Resource\Services\Command\CreateResource;
use Lms\Resource\Services\Command\UpdateResource;
use Lms\Storage\Repository\FileRepository;

final class ResourceService
{

    private ResourceRepository $resourceRepository;

    private FileRepository $fileRepository;

    public function __construct(ResourceRepository $resourceRepository, FileRepository $fileRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->fileRepository = $fileRepository;
    }


    public function create(CreateResource $command): ResourceId
    {
        $file = $this->fileRepository->getById($command->preview());

        $resourceId = $this->resourceRepository->nextIdentity();

        $resource = Resource::create($resourceId,
            $command->name(),
            $command->type(),
            new PreviewId($file->id()->asString())
        );

        $this->resourceRepository->save($resource);

        return $resourceId;
    }


    public function update(UpdateResource $command): void
    {
        $resource = $this->resourceRepository->getById($command->id());

        $command->editName(fn (string $name) => $resource->rename($name));

        $this->resourceRepository->save($resource);
    }
}