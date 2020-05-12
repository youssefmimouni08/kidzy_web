<?php


namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom', null, array('label' => 'Prénom','label_attr' => array('id' => 'prenom')))
            ->add('nom', null, array('label' => 'Nom','label_attr' => array('id' => 'nom')))
            ->add('cin', null, array('label' => 'Cin','label_attr' => array('id' => 'cin')))
            ->add('tel', null, array('label' => 'Telephone','label_attr' => array('id' => 'tel')));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
