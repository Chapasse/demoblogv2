<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            // , TextType::class ,[
            //     'attr' => [
            //         'placeholder' => "contenue de l'article",
            //         'style' => "border-radius: 5px;",
            //         'class' => "form-control"
            //     ]
            // ])
            ->add('image')
            ->add('category', EntityType::class, [ // on indique qu'il faut récupérer les catégories dans une entity
            'class' => Category::class, // on précise le nom de l'entity
            'choice_label' => 'title' // on in dique quoi afficher à l'utilisateur
            ])
            // ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
