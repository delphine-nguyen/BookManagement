<?php

namespace App\DataFixtures;

use App\Entity\Book;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

        for ($i = 0; $i < 20; $i++) {
            $book = new Book();

            $isbn = $faker->isbn13();
            $title = $faker->words(3);
            $summary = $faker->paragraph(10, true);
            $description = $faker->paragraph(3, true);
            $price = $faker->randomFloat(2, 0, 50);

            $book->setTitle(ucwords(join(" ", $title)));
            $book->setSummary($summary);
            $book->setDescription($description);
            $book->setISBN($isbn);
            $book->setPrice($price);

            $manager->persist($book);
        }

        $manager->flush();
    }
}
