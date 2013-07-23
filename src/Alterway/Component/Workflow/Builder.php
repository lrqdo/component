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
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;


    public function __construct($start, $end, $dispatcher = null)
    {
        $this->nodes = new NodeMap();
        $this->start = $this->nodes->get($start);
        $this->end = $this->nodes->get($end);
        $this->eventDispatcher = $dispatcher;
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

        $src->addTransition(new Transition($src, $dst, $spec));

        return $this;
    }

    public function getWorflow()
    {
        return new Workflow($this->start, $this->end, $this->nodes, $this->eventDispatcher);
    }
}
