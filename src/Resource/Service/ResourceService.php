<?php


namespace Lms\Resource\Service;


use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Repository\ResourceRepository;
use Lms\Resource\Service\Command\CreateResource;

final class ResourceService
{

    /**
     * @var ResourceRepository
     */
    private ResourceRepository $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function create(CreateResource $command): ResourceId
    {
        $resourceId = $this->resourceRepository->nextIdentity();

        $resource = Resource::create($resourceId, $command->name());

        $this->resourceRepository->save($resource);

        return $resourceId;
    }
}