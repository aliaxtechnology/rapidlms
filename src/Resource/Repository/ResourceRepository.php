<?php


namespace Lms\Resource\Repository;


use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;

interface ResourceRepository
{
    public function nextIdentity(): ResourceId;

    public function save(Resource $resource): void;
}