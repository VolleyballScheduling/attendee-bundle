<?php
namespace Volleyball\Bundle\UserBundle\Validator\Constraints;

/**
 * Constraint for the Unique Entity validator
 *
 * @Annotation
 */
class UniqueEntity extends \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity
{
    public $service = 'volleyball.orm.validator.unique';
    public $targetClass = null;
}
