<?php
namespace Volleyball\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends \FOS\UserBundle\Form\Type\RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('type');
//        $builder->add(
//              'terms',
//              'checkbox',
//              array('property_path' =>  'termsAccepted')
//        );
    }

    public function getName()
    {
        return 'volleyball_user_registration';
    }
}
