<?php


namespace Lms\Resource\Repository\Doctrine;


use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Repository\ResourceRepository;

class DoctrineResourceRepository implements ResourceRepository
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function nextIdentity(): ResourceId
    {
        $id = $this->em->getConnection()->transactional(function (Connection $connection) {

            //$connection->insert('resource_sequence', []);
            $connection->executeStatement('INSERT INTO resource_sequence DEFAULT VALUES');

            return $connection->lastInsertId();
        });

        return new ResourceId($id);
    }
    

    public function save(Resource $resource): void
    {
        $this->em->persist($resource);
        $this->em->flush();
    }
}