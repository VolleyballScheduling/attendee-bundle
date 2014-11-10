<?php
namespace Volleyball\Bundle\UserBundle\Form\Type;

class RegistrationFormType extends \FOS\UserBundle\Form\Type\RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        parent::buildForm($builder, $option);
    }
    
    public function getName()
    {
        return 'volleyball_user_registration';
    }
    
    public function getParent()
    {
        return 'fos_user_registration';
    }
}
