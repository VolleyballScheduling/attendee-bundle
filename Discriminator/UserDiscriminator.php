<?php
namespace Volleyball\Bundle\UserBundle\Discriminator;

use \Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * User discriminator
 *
 * @author leonardo proietti (leonardo.proietti@gmail.com)
 * @author eux (eugenio@netmeans.net)
 * @author david durost (david.durost@gmail.com)
 */
class UserDiscriminator
{
    const SESSION_NAME = 'volleyball.user.user_discriminator.class';

    /**
     * User session
     * @var SessionInterface
     */
    protected $session;

    /**
     * Configuration
     * @var array 
     */
    protected $configuration = array();

    /**
     * User types
     * @var array 
     */
    protected $userTypes = array();

    /**
     * Registration form
     * @var Symfony\Component\Form\Form
     */
    protected $registrationForm = null;

    /**
     * Profile form
     * @var Symfony\Component\Form\Form
     */
    protected $profileForm = null;

    /**
     * User class
     * @var string
     */
    protected $class = null;

    /**
     * Current form
     * @var string
     */
    protected $form = null;

    /**
     * Construct
     * @param SessionInterface $session
     * @param array $configuration
     * @param array $userTypes
     */
    public function __construct(SessionInterface $session, array $configuration, array $userTypes)
    {
        $this->session = $session;
        $this->configuration = $configuration;
        $this->userTypes = $userTypes;
    }

    /**
     * Get classes
     * @return array
     */
    public function getClasses()
    {
        $classes = array();
        foreach ($this->configuration as $entity => $config) {
            $classes[] = $entity;
        }

        return $classes;
    }

    /**
     * Set class
     * @param string $class
     * @param boolean $persist
     */
    public function setClass($class, $persist = false)
    {
        if (!in_array($class, $this->getClasses())) {
            throw new \LogicException(
                sprintf(
                    'Impossible to set the class discriminator, because the class "%s" is not present in the entities list',
                    $class
                )
            );
        }

        if ($persist) {
            $this->session->set(static::SESSION_NAME, $class);
        }

        $this->class = $class;
    }

    /**
     * Get class
     * @return string
     */
    public function getClass()
    {
        if (!is_null($this->class)) {
            return $this->class;
        }

        $storedClass = $this->session->get(static::SESSION_NAME, null);

        if ($storedClass) {
            $this->class = $storedClass;
        }

        if (is_null($this->class)) {
            $entities = $this->getClasses();
            $this->class = $entities[0];
        }

        return $this->class;
    }

    /**
     * Craete user
     * @param string|null $type
     * @return mixed
     */
    public function createUser($type = null)
    {
        if (!is_null($type) && array_key_exists($type, $this->userTypes)) {
            $class = $this->userTypes[$type];
        } else {
            $class = $this->getClass();
        }
        
        $factory = $this->getUserFactory();
        $factory = new $factory();
        $user    = $factory->build($class);

        return $user;
    }

    /**
     * Get user factory
     * @return string
     */
    public function getUserFactory()
    {
        return $this->configuration[$this->getClass()]['factory'];
    }

    /**
     * Get form type
     * @param string $name
     * @return
     * @throws \InvalidArgumentException
     */
    public function getFormType($name)
    {
        $class = $this->getClass();
        $className = $this->configuration[$class][$name]['form']['type'];

        if (!class_exists($className)) {
            throw new \InvalidArgumentException(
                sprintf('UserDiscriminator, error getting form type : "%s" not found', $className)
            );
        }

        $type = new $className($class);

        return $type;
    }

    /**
     * Get form name
     * @param string $name
     * @return string
     */
    public function getFormName($name)
    {
        return $this->configuration[$this->getClass()][$name]['form']['name'];
    }

    /**
     * Get form validation groups
     * @param string $name
     * @return array
     */
    public function getFormValidationGroups($name)
    {
        return $this->configuration[$this->getClass()][$name]['form']['validation_groups'];
    }

    /**
     * Get template
     * @return string
     */
    public function getTemplate($name)
    {
        return $this->configuration[$this->getClass()][$name]['template'];
    }
}
