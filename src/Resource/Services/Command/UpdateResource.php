<?php


namespace Lms\Resource\Services\Command;

use Lms\Resource\Entity\ResourceId;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdateResource
{

    /**
     * @Assert\NotBlank()
     * @Assert\Positive()
     */
    private string $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="200")
     */
    private ?string $name;

    private function __construct(string $id, ?string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function fromRequest(array $data): self
    {
        $id = $data['resource_id'] ?? '';
        $name = $data['name'] ?? null;

        return new self($id, $name);
    }

    public function id(): ResourceId
    {
        return ResourceId::fromString($this->id);
    }


    public function editName(\Closure $fn): void
    {
        if (!is_null($this->name))
            $fn($this->name);
    }
}