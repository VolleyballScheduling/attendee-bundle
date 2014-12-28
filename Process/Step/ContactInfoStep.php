<?php
namespace Volleyball\Bundle\UserBundle\Process\Step;

use \Volleyball\Bundle\UserBundle\Form\Type\Step\ContactInfoFormType;

class ContactInfoStep extends \Sylius\Bundle\FlowBundle\Process\Step\ControllerStep
{
    /**
     * {@inheritdoc}
     */
    public function displayAction(\Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface $context)
    {
        $form = new ContactInfoFormType();
        return $this->render(
            'VolleyballResourceBundle:Form/Step:contact_info.html.twig',
            array(
                'form' => $form->createView(),
                'context' => $context
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function forwardAction(\Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface $context)
    {
        $request = $context->getRequest();
        $form = new ContactInfoFormType();
        
        if ($form->handleRequest($request)->isValid()) {
            return $this->complete();
        }
        
        return $this->render(
            'VolleyballResourceBundle:Form/Step:contact_info.html.twig',
            array(
                'form' => $form->createView(),
                'context' => $context
            )
        );
    }
}
