<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Commentaires;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticlesFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 8; $i++) {
            $categorie = new Categories();
            $categorie->setTitre($faker->sentence())
                ->setContenu($faker->sentence())
                ->setCreeLe($faker->dateTimeBetween('-1 mounths'))
                ->setImage($faker->imageUrl());

            $manager->persist($categorie);

            for ($j = 1; $j <= mt_rand(3, 6); $j++) {
                $article = new Articles();
                $article->setTitre("Titre de la catégorie n°$i")
                    ->setContenu($faker->sentence())
                    ->setImage($faker->imageUrl())
                    ->setCategorie($categorie);

                $manager->persist($article);
            }

            for ($a = 1; $a <= mt_rand(3, 6); $a++) {
                $commentaire = new Commentaires();
                $commentaire->setContenu($faker->sentence())
                            ->setAuteur($faker->name())
                            ->setCreeLe($faker->dateTimeBetween('-1 mounths'))
                            ->setArticle($article);

                $manager->persist($commentaire);
        }
        $manager->flush();
    }
}
}
