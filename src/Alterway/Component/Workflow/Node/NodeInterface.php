<?php


namespace Alterway\Component\Workflow\Node;


use Alterway\Component\Workflow\ContextInterface;
use Alterway\Component\Workflow\TransitionInterface;

interface NodeInterface
{
    /**
     * Return the current node's name
     *
     * @return mixed
     */
    public function getName();

    /**
     * Add a transition for the current node
     *
     * @param TransitionInterface $transition
     * @return mixed
     */
    public function addTransition(TransitionInterface $transition);

    /**
     * Return the opened transitions
     *
     * @param ContextInterface $context
     * @return mixed
     */
    public function getOpenTransitions(ContextInterface $context);
}
