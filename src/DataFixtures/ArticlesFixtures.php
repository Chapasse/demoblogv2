<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use DateTime;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // for($i = 1; $i <= 10; $i++)
        // {
        //     $article = new Article;
        //     $article->setTitle("Titre de l'article n°$i")
        //             ->setContent("<p>Contenu de l'article n°$i</p>")
        //             ->setImage("http://picsum.photos/250/150")
        //             ->setCreatedAt(new \DateTime);
        //     $manager->persist($article);
        // }

        $faker = \Faker\Factory::create('fr_FR');

        //créer 3 catégories
        for ($i=1; $i <= 3; $i++) 
        { 
            $category = new Category;
            $category->setTitle($faker->sentence(3, false)); // renvois 3 mots aléatoire
            
            $manager->persist($category);

            // créer entre 4 et 6 articles
            for ($j=1; $j <= mt_rand(4,6); $j++) 
            { 
                //mt_rand() renvoie un nombre aléatoire parmi les arg (ici 4 à 6)
                
                $article = new Article;

                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';
                // join() prend en param un séparateur et un tableau et renvoie une chaine de caractères
                
                $article->setTitle($faker->sentence())
                ->setContent($content)
                ->setImage($faker->imageUrl())
                ->setCreatedAt($faker->dateTimeBetween("-6 months"))
                ->setCategory($category);
                
                $manager->persist($article);
                
                //créer entre 5 et 10 commentaires par articles
                for ($k=1; $k <= mt_rand(5,10); $k++) 
                { 
                    $comment= new Comment;
                    
                    $content = '<p>' . join('</p><p>', $faker->paragraphs(2)) . '</p>';

                    $now = new \DateTime; // récuération de la date d'ajourd'hui
                    $interval = $now->diff($article->getCreatedAt()); // intervalle entre aujourd'hui et la date de création de l'article
                    $days = $interval->days; // On récupère l'intervalle en jours

                    $comment->setAuthor($faker->name())
                    ->setContent($content)
                    ->setCreatedAt($faker->dateTimeBetween("-$days days"))
                    ->setArticle($article);
    
                    $manager->persist($comment);

                }
            }
        }
        
        $manager->flush();
    }
}
