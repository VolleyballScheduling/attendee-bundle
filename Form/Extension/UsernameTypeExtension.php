<?php
namespace Volleyball\Bundle\UserBundle\Form\Extension;

class UsernameTypeExtension extends \Symfony\Component\Form\AbstractTypeExtension
{
    public function getExtendedType()
    {
        return 'text';
    }
}
