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
        $this->start = $this->nodes->get($src);
        $this->nodes->get(Workflow::TECHNICAL_STARTING_NODE)->addTransition($this->start, $spec);

        return $this;
    }

    public function link($src, $dst, SpecificationInterface $spec)
    {
        $src = $this->nodes->get($src);
        $dst = $this->nodes->get($dst);

        if ($dst->getName() === $this->start) {
            throw new \LogicException('Cannot link to starting node.');
        }

        $src->addTransition($dst, $spec);

        return $this;
    }

    public function getWorflow()
    {
        if (null === $this->start) {
            throw new \LogicException('No defined starting node');
        };

        return new Workflow($this->start, $this->nodes, $this->eventDispatcher);
    }
}
