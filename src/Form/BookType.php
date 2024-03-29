<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ISBN', TextType::class, [
                "constraints" => [
                    new Length(
                        13,
                        exactMessage: "ISBN must be exactly {{ limit }} caracters"
                    )
                ]
            ])
            ->add('title', TextType::class, [])
            ->add('summary', TextType::class, [
                "constraints" => [
                    new Length([
                        "min" => 10,
                        "minMessage" => "Summary must be at least {{ limit }} caracters"
                    ])
                ]
            ])
            ->add('description', TextType::class, [
                "constraints" => [
                    new Length([
                        "min" => 5,
                        "minMessage" => "Description must be at least {{ limit }} caracters"
                    ])
                ]
            ])
            ->add(
                'price',
                NumberType::class,
                [
                    "constraints" => [
                        new GreaterThan([
                            "value" => 0,
                            "message" => "Price must be positive"
                        ])
                    ]
                ]
            )
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'name',
            ])
            ->add('editor', EntityType::class, [
                'class' => Editor::class,
                'choice_label' => 'name',
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
