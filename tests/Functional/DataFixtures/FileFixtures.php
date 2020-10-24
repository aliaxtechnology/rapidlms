<?php

namespace Lms\Tests\Functional\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Lms\Storage\Entity\File;
use Lms\Storage\Entity\FileId;

class FileFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($index = 1; $index <= 10; $index++) {
            $file = File::create(new FileId($index), "preview_{$index}.png", 'previews', 'local');
            $manager->persist($file);
        }

        $manager->flush();
    }
}
