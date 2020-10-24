<?php


namespace Lms\Resource\Event;


use Lms\Resource\Entity\ResourceId;

final class ResourceRenamed
{
    /**
     * @var ResourceId
     */
    private ResourceId $id;
    private string $name;

    public function __construct(ResourceId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function message(): string
    {
        return sprintf('Resource %s was renamed to %s', $this->id, $this->name);
    }

    public function asArray(): array
    {
        return [
            'resource_id' => $this->id->asString(),
            'name' => $this->name
        ];
    }
}