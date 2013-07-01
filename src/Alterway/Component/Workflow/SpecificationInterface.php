<?php


namespace Alterway\Component\Workflow;


interface SpecificationInterface
{
    public function isStatisfiedBy(ContextInterface $context);
}