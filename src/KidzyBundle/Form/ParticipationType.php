<?php

namespace KidzyBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description')->add('idEnfant',EntityType::class,
                array(
                    'class'=>'KidzyBundle:Enfant',
                    'choice_label'=>'prenomEnfant',
                    'multiple'=>false
                ))->add('idEvent',EntityType::class,
                array(
                    'class'=>'KidzyBundle:Event',
                    'choice_label'=>'nomEvent',
                    'multiple'=>false
                ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KidzyBundle\Entity\Participation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kidzybundle_Participation';
    }


}
