<?php


namespace Lms\Storage\Repository;


use Lms\Storage\Entity\File;
use Lms\Storage\Entity\FileId;

interface FileRepository
{
    public function getById(FileId $id): File;
}