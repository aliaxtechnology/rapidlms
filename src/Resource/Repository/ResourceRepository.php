<?php


namespace Lms\Resource\Repository;


use Lms\Resource\Entity\Resource as ResourceEntity;
use Lms\Resource\Entity\ResourceId;

interface ResourceRepository
{
    public function nextIdentity(): ResourceId;

    public function getById(ResourceId $id): ResourceEntity;

    public function save(ResourceEntity $resource): void;
}