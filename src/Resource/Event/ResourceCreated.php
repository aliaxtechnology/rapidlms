<?php


namespace Lms\Resource\Event;


use Lms\Resource\Entity\PreviewId;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Entity\ResourceType;

final class ResourceCreated
{
    /**
     * @var ResourceId
     */
    private ResourceId $id;
    private string $name;
    /**
     * @var ResourceType
     */
    private ResourceType $type;
    /**
     * @var PreviewId
     */
    private PreviewId $previewId;

    public function __construct(ResourceId $id, string $name, ResourceType $type, PreviewId $previewId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->previewId = $previewId;
    }

    public function message(): string
    {
        return sprintf('Resource %s was created.', $this->id->asString());
    }

    public function asArray(): array
    {
        return [
            'resource_id' => $this->id->asString(),
            'name' => $this->name,
            'type' => $this->type->asString(),
            'preview_id' => $this->previewId->asString(),
        ];
    }
}