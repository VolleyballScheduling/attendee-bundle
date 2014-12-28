<?php
namespace Volleyball\Bundle\UserBundle\Process\Scenario;

use \Volleyball\Bundle\UserBundle\Process\Step;

class RegistrationScenario implements \Sylius\Bundle\FlowBundle\Process\Scenario\ProcessScenarioInterface, \Symfony\Component\Form\FormTypeInterface
{
    public function build(\Sylius\Bundle\FlowBundle\Process\Builder\ProcessBuilderInterface $builder)
    {
        $builder
            ->add('contact info', new Step\ContactInfoStep())
            ->add('user info', new Step\UserInfoStep());
    }
    
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        return;
    }
    
    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
        return;
    }
    
    public function finishView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
        return;
    }
    
    public function getName()
    {
        return 'registration_scenario';
    }
    
    public function getParent()
    {
        return;
    }
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('validation_groups' => array()));
        
        return;
    }
}
