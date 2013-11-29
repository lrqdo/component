<?php


namespace Alterway\Component\Workflow;

use Alterway\Component\Workflow\Node\Node;
use Alterway\Component\Workflow\Node\NodeMap;
use Alterway\Component\Workflow\Node\NodeMapInterface;

class Builder implements BuilderInterface
{
    /**
     * @var NodeMapInterface
     */
    private $nodes;

    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;


    public function __construct($dispatcher = null)
    {
        $this->nodes = new NodeMap();
        $this->eventDispatcher = $dispatcher;

        $this->start = new Node('start');
        $this->end = new Node('end');
    }

    public function open($dst, SpecificationInterface $spec)
    {
        $this->start->addTransition($dst, $spec);

        return $this;
    }

    public function link($src, $dst, SpecificationInterface $spec)
    {
        $src = $this->nodes->get($src);
        if ($src->getName() === $this->end) {
            throw new \LogicException('Cannot link from ending node.');
        }

        $dst = $this->nodes->get($dst);
        if ($dst->getName() === $this->start) {
            throw new \LogicException('Cannot link to starting node.');
        }

        $src->addTransition($dst, $spec);

        return $this;
    }

    public function close($src, SpecificationInterface $spec)
    {
        $src->addTransition($this->end, $spec);

        return $this;
    }

    public function getWorflow()
    {
        return new Workflow($this->start, $this->end, $this->nodes, $this->eventDispatcher);
    }
}
