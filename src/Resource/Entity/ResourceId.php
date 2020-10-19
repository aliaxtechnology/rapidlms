<?php


namespace Lms\Resource\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class ResourceId
 * @package Lms\Resource\Entity
 * @ORM\Embeddable()
 */
final class ResourceId
{

    /**
     * @ORM\Id()
     * @ORM\Column(type = "integer", name="id")
     */
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function asString(): string
    {
        return (string) $this->id;
    }
}