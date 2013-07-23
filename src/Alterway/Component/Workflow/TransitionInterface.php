<?php


namespace Alterway\Component\Workflow;


interface TransitionInterface
{
    /**
     * Check if the current transition satisfies the specifiation on the given context
     *
     * @param ContextInterface $context
     * @return mixed
     */
    public function isOpen(ContextInterface $context);

    /**
     * Return the destination of the current transition
     *
     * @return mixed
     */
    public function getDestination();
}
