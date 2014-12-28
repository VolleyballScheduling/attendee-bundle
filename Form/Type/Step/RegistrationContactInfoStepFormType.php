<?php
namespace Volleyball\Bundle\UserBundle\Form\Type;

class RegistrationContactInfoStepFormType extends \FOS\UserBundle\Form\Type\RegistrationFormType
{
    public function buildForm(\Symfony\Component\Form\Test\FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('birthdate');
    }
    
    public function getName()
    {
        return 'registration_contact_info_step';
    }
}
