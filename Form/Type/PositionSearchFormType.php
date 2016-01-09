<?php
namespace Volleyball\Bundle\AttendeeBundle\Form\Type;

class PositionSearchFormType extends \Volleyball\Bundle\UtilityBundle\Form\Type\SearchFormType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description');
        $builder->add('parent');
    }
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Volleyball\Bundle\AttendeeBundle\Entity\Position'
        ));
    }

    public function getName()
    {
        return 'attendee_position_search';
    }
}
