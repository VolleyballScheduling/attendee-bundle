<?php
namespace Volleyball\Bundle\UserBundle\Form\Type;

class UserRegistrationFormType extends RegistrationFormType
{
    public function buildForm(
        \Symfony\Component\Form\FormBuilderInterface $builder,
        array $options
    ) {
            parent::buildForm($builder, $options);
    }
    
    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'user_registration';
    }
}
