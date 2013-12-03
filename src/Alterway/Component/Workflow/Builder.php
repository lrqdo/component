<?php

namespace Alterway\Component\Workflow;

use Alterway\Component\Workflow\Node\NodeInterface;
use Alterway\Component\Workflow\Node\NodeMap;
use Alterway\Component\Workflow\Node\NodeMapInterface;

class Builder implements BuilderInterface
{
    /**
     * @var NodeMapInterface
     */
    private $nodes;

    /**
     * @var NodeInterface
     */
    private $start = null;

    public function __construct($dispatcher = null)
    {
        $this->nodes = new NodeMap();
        $this->eventDispatcher = $dispatcher;
    }

    public function open($src, SpecificationInterface $spec)
    {
        $this->start = $this->nodes->get(uniqid());
        $this->start->addTransition($this->nodes->get($src), $spec);

        return $this;
    }

    public function link($src, $dst, SpecificationInterface $spec)
    {
        $this->nodes->get($src)->addTransition($this->nodes->get($dst), $spec);

        return $this;
    }

    public function getWorflow()
    {
        if (null === $this->start) {
            throw new \LogicException('No starting node defined');
        };

        return new Workflow($this->start, $this->nodes, $this->eventDispatcher);
    }
}
