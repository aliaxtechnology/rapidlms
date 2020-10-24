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

        $file = File::create(new FileId(1), 'preview.png', 'previews', 'local');
        $manager->persist($file);

        $manager->flush();
    }
}
