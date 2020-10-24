<?php


namespace Lms\Resource\Exception;


use Lms\Resource\Entity\ResourceId;

class ResourceNotFoundException extends \Exception
{

    public static function byId(ResourceId $id): self
    {
        return new self(sprintf('Resource %s was not found.', $id->asString()));
    }
}