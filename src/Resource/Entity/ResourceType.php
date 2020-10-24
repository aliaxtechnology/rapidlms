<?php


namespace Lms\Resource\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable ()
 */
final class ResourceType
{

    /**
     * @ORM\Column(type="string", name="type", length=20)
     */
    private string $type;

    public const QUIZ = 'quiz';

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public static function fromString(string $type): self
    {
        return new self($type);
    }

    public static function types(): array
    {
        return [self::QUIZ];
    }

    public function asString(): string
    {
        return $this->type;
    }
}