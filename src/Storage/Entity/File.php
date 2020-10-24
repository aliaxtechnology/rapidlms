<?php


namespace Lms\Storage\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
final class File
{
    /**
     * @ORM\Embedded(class="FileId", columnPrefix=false)
     */
    private FileId $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $disk;

    public function __construct(FileId $id, string $name, string $path, string $disk)
    {
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
        $this->disk = $disk;
    }

    public static function create(FileId $id, string $name, string $path, string $disk): self
    {
        return new self($id, $name, $path, $disk);
    }


    public function id(): FileId {
        return $this->id;
    }
}