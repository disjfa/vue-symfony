<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

class MovieFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $movie = new Movie();
        $movie->setName('Star Wars');
        $movie->setReleaseDate(new DateTime('1977-05-25'));
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setName('Star Trek: The Motion Picture');
        $movie->setReleaseDate(new DateTime('1979-12-06'));
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setName('Bill & Ted\'s Excellent Adventure');
        $movie->setReleaseDate(new DateTime('1989-02-17'));
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setName('The Evil Dead');
        $movie->setReleaseDate(new DateTime('1981-10-15'));
        $manager->persist($movie);

        $manager->flush();
    }
}
