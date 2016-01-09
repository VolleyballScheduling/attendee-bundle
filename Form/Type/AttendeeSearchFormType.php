<?php
namespace Volleyball\Bundle\AttendeeBundle\Form\Type;

class AttendeeSearchFormType extends \Volleyball\Bundle\CoreBundle\Form\Type\SearchFormType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name');
        $builder->add('last_name');
    }

    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Volleyball\Bundle\AttendeeBundle\Entity\Attendee'
        ));
    }

    public function getName()
    {
        return 'attendee_search';
    }
}
    `````                           