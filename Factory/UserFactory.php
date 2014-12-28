<?php
namespace Volleyball\Bundle\UserBundle\Factory;

/**
 * @author leonardo proietti (leonardo.proietti@gmail.com)
 * @author david durost (david.durost@gmail.com)
 */
class UserFactory
{
    /**
     * Build
     * @param string $class
     * @return mixed
     */
    public static function build($class)
    {
        return new $class();
    }
}
