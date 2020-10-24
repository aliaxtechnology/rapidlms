<?php


namespace Lms\Resource\Entity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;
use Lms\Resource\Event\ResourceCreated;
use Lms\Resource\Event\ResourceRenamed;

/**
 * @ORM\Entity()
 */
final class Resource
{
    /**
     * @ORM\Embedded(class="ResourceId", columnPrefix=false)
     */
    private ResourceId $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Embedded(class="ResourceType", columnPrefix=false)
     */
    private ResourceType $type;

    /**
     * @ORM\Embedded(class="PreviewId", columnPrefix=false)
     */
    private PreviewId $previewId;

    private array $events;

    private function __construct(ResourceId $id, string $name, ResourceType $type, PreviewId $previewId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->previewId = $previewId;
        $this->events = [];
    }

    public static function create(ResourceId $id, string $name, ResourceType $type, PreviewId $previewId): self
    {
        $resource = new self($id, $name, $type, $previewId);
        $resource->events[] = new ResourceCreated($id, $name, $type, $previewId);

        return $resource;
    }

    public function id(): ResourceId
    {
        return $this->id;
    }

    public function rename(string $name): void {
        Assertion::notBlank($name);

        $this->name = $name;

        $this->events[] = new ResourceRenamed($this->id, $name);
    }

    public function name(): string {
        return $this->name;
    }

    public function popEvents(): array {
        return $this->events;
    }
}