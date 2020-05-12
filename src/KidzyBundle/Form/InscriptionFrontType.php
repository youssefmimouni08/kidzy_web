<?php

namespace KidzyBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionFrontType extends AbstractType
{
    /**
     * {@inheritdoc}
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idParent =null;
        $builder->add('descriptionInscrit')->add('idEnfant',EntityType::class,
                array(
                    'required' => false,
                    'class'=>'KidzyBundle:Enfant',
                    'choice_label'=>'nomEnfant',
                    'multiple'=>true,
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($idParent) {
                        $er->myfinfEnfant($idParent);

                    }


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
