<?php

namespace App\Form;

use App\Entity\Guests;
use App\Entity\Questions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('related', EntityType::class, [
                'class' => Guests::class,
                'multiple'=> true,
                'choice_label' =>  function (Guests $guests) {
                    return $guests->getFirstName() . ' ' . $guests->getLastName();
                }

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
