<?php


namespace Lms\Tests\Unit\Storage\Repository;


use Lms\Storage\Entity\File;
use Lms\Storage\Entity\FileId;
use Lms\Storage\Repository\FileRepository;

class MemoryFileRepository implements FileRepository
{

    private array $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function getById(FileId $id): File
    {
        return $this->files[$id->asString()];
    }
}