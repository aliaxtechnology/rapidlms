<?php

namespace Lms\Tests\Functional\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Lms\Resource\Entity\PreviewId;
use Lms\Resource\Entity\Resource;
use Lms\Resource\Entity\ResourceId;
use Lms\Resource\Entity\ResourceType;


class ResourceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($index = 1; $index <= 10; $index++) {
            $file = Resource::create(new ResourceId($index), "un module au hasard {$index}", ResourceType::fromString('quiz'), new PreviewId(1));
            $manager->persist($file);
        }

        $manager->flush();
    }
}
