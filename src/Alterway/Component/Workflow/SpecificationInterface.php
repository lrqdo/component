<?php


namespace Alterway\Component\Workflow;


interface SpecificationInterface
{
    public function isSatisfiedBy(ContextInterface $context);
}
