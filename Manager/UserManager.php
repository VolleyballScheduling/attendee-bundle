<?php
namespace Volleyball\Bundle\UserBundle\Manager;

use \Doctrine\Common\Persistence\ObjectManager;
use \Doctrine\Common\Collections\ArrayCollection;
use \FOS\UserBundle\Util\CanonicalizerInterface;
use \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator;

/**
 * Custom user manager for FOSUserBundle based on
 * PUGXMultiUserBundle
 *
 * @author leonardo proietti (leonardo.proietti@gmail.com)
 * @author eux (eugenio@netmeans.net)
 * @author david durost (david.durost@gmail.com)
 */
class UserManager extends \FOS\UserBundle\Doctrine\UserManager
{
    /**
     *
     * @var ObjectManager
     */
    protected $om;

    /**
     *
     * @var UserDiscriminator
     */
    protected $userDiscriminator;
    
    /**
     * Usertype classes
     * @var ArrayCollection
     */
    protected $classes;

    /**
     * Constructor
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param CanonicalizerInterface  $usernameCanonicalizer
     * @param CanonicalizerInterface  $emailCanonicalizer
     * @param ObjectManager           $om
     * @param string                  $class
     * @param UserDiscriminator       $userDiscriminator
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        CanonicalizerInterface $usernameCanonicalizer,
        CanonicalizerInterface $emailCanonicalizer,
        ObjectManager $om,
        $class,
        UserDiscriminator $userDiscriminator
    ) {
        $this->om = $om;
        $this->userDiscriminator = $userDiscriminator;
        $this->classes = $this->userDiscriminator->getClasses();

        parent::__construct(
            $encoderFactory,
            $usernameCanonicalizer,
            $emailCanonicalizer,
            $om,
            $class
        );
    }

    /**
     *
     * {@inheritDoc}
     */
    public function createUser($type = null)
    {
        return $this->userDiscriminator->createUser($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->userDiscriminator->getClass();
    }

    /**
     * {@inheritDoc}
     */
    public function findUserBy(array $criteria)
    {
        foreach ($this->classes as $class) {

            $repo = $this->om->getRepository($class);

            if (!$repo) {
                throw new \LogicException(sprintf('Repository "%s" not found', $class));
            }

            $user = $repo->findOneBy($criteria);

            if ($user) {
                $this->userDiscriminator->setClass($class);
                return $user;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function findUsers()
    {
        $usersAll = array();
        foreach ($this->classes as $class) {
            $repo = $this->om->getRepository($class);

            $users = $repo->findAll();

            if ($users) {
                $usersAll = array_merge($usersAll, $users); // $usersAll
            }
        }

        return $usersAll;
    }


    /**
     * {@inheritDoc}
     */
    protected function findConflictualUsers($value, array $fields)
    {
        foreach ($this->classes as $class) {

            $repo = $this->om->getRepository($class);

            $users = $repo->findBy($this->getCriteria($value, $fields));

            if (count($users) > 0) {
                return $users;
            }
        }

        return array();
    }
}
