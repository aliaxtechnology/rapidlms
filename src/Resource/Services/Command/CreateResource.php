<?php


namespace Lms\Resource\Services\Command;


use Lms\Resource\Entity\ResourceType;
use Lms\Storage\Entity\FileId;
use Symfony\Component\Validator\Constraints as Assert;
use Lms\Resource\Validator\Constraints as AcmeAssert;

final class CreateResource
{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="200")
     */
    private string $name;

    /**
     * @Assert\NotBlank()
     * @AcmeAssert\ResourceType
     */
    private string $type;

    /**
     * @Assert\NotBlank()
     * @Assert\Positive()
     */
    private string $preview;

    public function __construct(string $name, string $type, string $preview)
    {
        $this->name = $name;
        $this->type = $type;
        $this->preview = $preview;
    }

    public static function fromRequest(array $data): self
    {
        $name = $data['name'] ?? '';
        $type = $data['type'] ?? '';
        $preview = $data['preview'] ?? '';

        return new self($name, $type, $preview);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): ResourceType
    {
        return ResourceType::fromString($this->type);
    }

    public function preview(): FileId
    {
        return FileId::fromString($this->preview);
    }
}