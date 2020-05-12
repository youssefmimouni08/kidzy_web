<?php

namespace KidzyBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnfantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEnfant', null, array('label' => 'Nom :','label_attr' => array('idEnfant' => 'nomEnfant')))
            ->add('prenomEnfant', null, array('label' => 'Prénom :','label_attr' => array('idEnfant' => 'prenomEnfant')))

            ->add('imageFile', FileType::class, array('label' => 'Image :','label_attr' => array('idEnfant' => 'imageFile')) ,
                [
                'required'=>false
            ])
            ->add('datenEnfant', null, array('label' => 'Date de naissance :','label_attr' => array('idEnfant' => 'datenEnfant')))
            ->add('idClasse',EntityType::class,
                array(
                    'class'=>'KidzyBundle:Classe',
                    'choice_label'=>'libelleCla',
                    'multiple'=>false
                ),

                array('label' => 'Classe :','label_attr' => array('idEnfant' => 'idClasse'))
            )

            ->add('idGarde',EntityType::class,
                array(
                    'class'=>'KidzyBundle:Garde',
                    'choice_label'=>'nomGarde',
                    'multiple'=>false
                ),
                array('label' => 'Garderie :','label_attr' => array('idEnfant' => 'idGarde')))


            ->add('idParent', null, array('label' => 'L\'enfant du Mr\Mme :','label_attr' => array('idEnfant' => 'idParent.prenom')));
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KidzyBundle\Entity\Enfant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kidzybundle_enfant';
    }


}
