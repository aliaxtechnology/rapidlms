<?php


namespace Lms\Resource\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lms\Resource\Event\ResourceCreated;

/**
 * @ORM\Entity()
 */
class Resource
{
    /**
     * @ORM\Embedded(class="ResourceId", columnPrefix=false)
     */
    private ResourceId $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    private array $events;

    private function __construct(ResourceId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->events = [];
    }

    public static function create(ResourceId $id, string $name): self
    {
        $resource = new self($id, $name);
        $resource->events[] = new ResourceCreated($id, $name);

        return $resource;
    }


    public function popEvents(): array {
        return $this->events;
    }
}