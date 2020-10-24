<?php


namespace Lms\Resource\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ResourceType extends Constraint
{
    public $message = 'Incorrect type {{ type }}, you can only use: {{ types }}';
}