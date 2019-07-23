<?php

namespace App\Form;

use App\Entity\Show;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowType extends AbstractType
{
    public function buildForm ( FormBuilderInterface $builder, array $options )
    {

        $builder
            ->add('date')
            ->add('name')
            ->add('picture')
            ->add('description')
            ->add('artistes', null, [

                    'expanded' => true,
                    'multiple' => true,
                    'by_reference' => false]
            );
    }

    public function configureOptions ( OptionsResolver $resolver )
    {
        $resolver->setDefaults([
            'data_class' => Show::class,
        ]);
    }
}
