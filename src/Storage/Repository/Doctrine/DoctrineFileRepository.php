<?php


namespace Lms\Storage\Repository\Doctrine;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Lms\Storage\Entity\File;
use Lms\Storage\Entity\FileId;
use Lms\Storage\Repository\FileRepository;

final class DoctrineFileRepository implements FileRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $query;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->query = $em->getRepository(File::class);
    }

    public function getById(FileId $id): File
    {
        return $this->query->find($id->asString());
    }
}