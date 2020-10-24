<?php


namespace Lms\Resource\Repository\Doctrine;


use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Exception\ResourceNotFoundException;
use Lms\Resource\Repository\ResourceRepository;

class DoctrineResourceRepository implements ResourceRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $query;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->query = $em->getRepository(Resource::class);
    }


    public function nextIdentity(): ResourceId
    {
        $id = $this->em->getConnection()->transactional(function (Connection $connection) {

            $connection->executeStatement('INSERT INTO resource_sequence (id) VALUES (null)');

            return $connection->lastInsertId();
        });

        return new ResourceId($id);
    }

    public function getById(ResourceId $id): Resource
    {
        $resource = $this->query->find($id->asString());

        if (is_null($resource)) {
            throw ResourceNotFoundException::byId($id);
        }

        return $resource;
    }

    public function save(Resource $resource): void
    {
        $this->em->persist($resource);
        $this->em->flush();
    }
}