<?php


namespace Alterway\Component\Workflow\Node;


use Alterway\Component\Workflow\ContextInterface;
use Alterway\Component\Workflow\SpecificationInterface;
use Alterway\Component\Workflow\TransitionInterface;

interface NodeInterface
{
    /**
     * Return the current node's name
     *
     * @return string
     */
    public function getName();

    /**
     * Add a transition for the current node
     *
     * @param string $dst
     * @param SpecificationInterface $spec
     * @return NodeInterface
     */
    public function addTransition($dst, SpecificationInterface $spec);

    /**
     * Return the opened transitions
     *
     * @param ContextInterface $context
     * @return array
     */
    public function getOpenTransitions(ContextInterface $context);
}
