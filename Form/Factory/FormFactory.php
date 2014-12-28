<?php
namespace Volleyball\Bundle\UserBundle\Form\Factory;

use \Symfony\Component\Form\FormFactoryInterface;

use \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator;

class FormFactory implements \FOS\UserBundle\Form\Factory\FactoryInterface
{
    /**
     * User discriminator
     * @var \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator 
     */
    private $userDiscriminator;
    
    /**
     * Form factory
     * @var FormFactoryInterface 
     */
    private $formFactory;
    
    /**
     * Form type
     * @var string 
     */
    private $type;
    
    /**
     * Forms
     * @var array 
     */
    private $forms = array();
    
    /**
     * Construct
     * @param \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator $userDiscriminator
     * @param string $type registration|profile
     */
    public function __construct(
        UserDiscriminator $userDiscriminator,
        FormFactoryInterface $formFactory,
        $type
    ) {
        $this->userDiscriminator = $userDiscriminator;
        $this->formFactory = $formFactory;
        $this->type = $type;
    }
    
    /**
     * Create form
     * @return \Symfony\Component\Form\Form 
     */
    public function createForm()
    {
        $type = $this->userDiscriminator->getFormType($this->type);
        $name = $this->userDiscriminator->getFormName($this->type);
        $validationGroups = $this->userDiscriminator->getFormValidationGroups($this->type);
        
        if (array_key_exists($name, $this->forms)) {
            return $this->forms[$name];
        }
            
        $form = $this->formFactory->createNamed(
            $name,
            $type,
            null,
            array('validation_groups' => $validationGroups)
        );
        
        $this->forms[$name] = $form;
        
        return $form;
    }
}
