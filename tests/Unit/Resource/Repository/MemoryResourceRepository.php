<?php


namespace Lms\Tests\Unit\Resource\Repository;


use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Repository\ResourceRepository;

class MemoryResourceRepository implements ResourceRepository
{

    private array $resources;
    private int $sequenceId;


    public function __construct(array $resources = [])
    {
        $this->sequenceId = 0;
        $this->resources = $resources;
    }

    public function nextIdentity(): ResourceId
    {
        $this->sequenceId++;

        return new ResourceId($this->sequenceId);
    }

    public function save(Resource $resource): void
    {
        $this->resources[$resource->id()->asString()] = $resource;
    }
}