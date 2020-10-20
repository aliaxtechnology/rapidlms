<?php


namespace Lms\Resource\Entity;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @ORM\Embeddable ()
 */
final class ResourceType
{

    /**
     * @ORM\Column(type="string", name="type", length="20")
     */
    private string $type;

    private const QUIZ = 'quiz';

    private function __construct(string $type)
    {
        Assert::inArray($type, [self::QUIZ], 'Invalid type resource, expected %2$s, Got: %s');
        $this->type = $type;
    }

    public static function fromString(string $type): self
    {
        return new self($type);
    }

    public function asString(): string
    {
        return $this->type;
    }
}