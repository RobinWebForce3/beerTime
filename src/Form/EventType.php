<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('startAt')
            ->add('endAt')
            ->add('content')
            ->add('price')
            ->add('posterUrl')
            ->add('posterFile', FileType::class)
            ->add('place', null, [
                'choice_label' => 'name'
            ])
            ->add('categories', null, [
                'choice_label' => 'name'
            ])
            // ->add('owner')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
