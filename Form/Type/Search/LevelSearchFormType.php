<?php
namespace Volleyball\Bundle\AttendeeBundle\Form\Type\Search;

class LevelSearchFormType extends \Volleyball\Bundle\CoreBundle\Form\Type\SearchFormType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('special');
    }

    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Volleyball\Bundle\AttendeeBundle\Entity\Level'
        ));
    }

    public function getName()
    {
        return 'level_search';
    }
}
