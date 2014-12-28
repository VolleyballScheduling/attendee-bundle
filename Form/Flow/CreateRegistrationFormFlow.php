<?php
namespace Volleyball\Bundle\UserBundle\Form\Flow;

use \Volleyball\Bundle\UserBundle\Form\Type\RegistrationContactInfoStepFormType;
use \Volleyball\Bundle\UserBundle\FormType\RegistrationUserInfoStepFormType;

class CreateRegistrationFormFlow extends \Craue\FormFlowBundle\Form\FormFlow
{
    private $configuration;
    
    /**
     * Construct
     */
    public function __construct()
    {
        $this->configuration = array(
            array(
                'label' => 'contact info',
                'type' => new RegistrationContactInfoStepFormType()
            ),
            array(
                'label' => 'user info',
                'type' => new RegistrationUserInfoStepFormType()
            )
        );
    }
    
    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return 'create_registration';
    }
    
    /**
     * Load steps configuration
     * @return array
     */
    protected function loadStepsConfig()
    {
        return $this->configuration;
    }

    /**
     * Add a step
     * @param array $step
     * @param integer|null $position
     * @return \Volleyball\Bundle\UserBundle\Form\Flow\CreateRegistrationFormFlow
     */
    public function addStep(array $step, $position = null)
    {
        if (null !== $position && count($this->configuration) <= $position) {
            $this->configuration = array_merge(
                array_slice($this->configuration, 0, 1, true),
                $step,
                array_slice($this->configuration, 1, null, true)
            );
        } else {
            $this->configuration[] = $step;
        }
        
        return $this;
    }
}
