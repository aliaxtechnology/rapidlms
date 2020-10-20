<?php


namespace Lms\Resource\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class PreviewId
{
    /**
     * @ORM\Column(type="integer", name="preview_id")
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