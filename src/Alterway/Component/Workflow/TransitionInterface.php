<?php


namespace Alterway\Component\Workflow;


use Alterway\Component\Workflow\Node\NodeInterface;

interface TransitionInterface
{
    /**
     * Check if the current transition satisfies the specifiation on the given context
     *
     * @param ContextInterface $context
     *
     * @return boolean
     */
    public function isOpen(ContextInterface $context);

    /**
     * Return the destination of the current transition
     *
     * @return NodeInterface
     */
    public function getDestination();
}
