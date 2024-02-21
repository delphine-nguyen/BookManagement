<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ISBN', TextType::class, [
                "constraints" => [
                    new EqualTo([
                        "value" => 13,
                        "message" => "ISBN must be exactly {{ compared_value }} caracter-long"
                    ])
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
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
