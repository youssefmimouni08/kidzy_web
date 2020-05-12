<?php

namespace KidzyBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descriptionInscrit')->add('idEnfant',EntityType::class,
                array(
                    'class'=>'KidzyBundle:Enfant',
                    'choice_label'=>'prenomEnfant',
                    'multiple'=>false
                ))->add('idClub',EntityType::class,
                array(
                    'class'=>'KidzyBundle:Club',
                    'choice_label'=>'nomClub',
                    'multiple'=>false
                ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KidzyBundle\Entity\Inscription'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kidzybundle_inscription';
    }


}
