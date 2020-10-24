<?php


namespace Lms\Storage\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FileId
 * @package Lms\Storage\Entity
 * @ORM\Embeddable()
 */
final class FileId
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type = "integer", name="id")
     */
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function fromString(string $id): self
    {
        return new self((int) $id);
    }

    public function asString(): string
    {
        return (string) $this->id;
    }
}