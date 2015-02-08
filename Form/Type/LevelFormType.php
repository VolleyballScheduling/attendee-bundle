<?php
namespace Volleyball\Bundle\AttendeeBundle\Form\Type;

class LevelFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(
        \Symfony\Component\Form\FormBuilderInterface $builder,
        array $options
    ) {
        $builder->add('name');
        $builder->add('description');
        $builder->add('special');
        $builder->add('organizations');
    }

    public function getName()
    {
        return 'level';
    }
}
