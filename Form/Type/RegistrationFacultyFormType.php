<?php
namespace Volleyball\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFacultyFormType extends \FOS\UserBundle\Form\Type\RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'volleyball_faculty_registration';
    }
}
