<?php


namespace Lms\Resource\Services;


use Lms\Resource\Entity\PreviewId;
use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Repository\ResourceRepository;
use Lms\Resource\Services\Command\CreateResource;
use Lms\Storage\Repository\FileRepository;

final class ResourceService
{

    /**
     * @var ResourceRepository
     */
    private ResourceRepository $resourceRepository;
    /**
     * @var FileRepository
     */
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
}