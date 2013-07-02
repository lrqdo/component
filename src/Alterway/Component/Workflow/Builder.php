<?php


namespace Alterway\Component\Workflow;


use Alterway\Component\Workflow\Node\NodeInterface;
use Alterway\Component\Workflow\Node\NodeMap;
use Alterway\Component\Workflow\Node\NodeMapInterface;

class Builder implements  BuilderInterface
{
    /**
     * @var NodeMapInterface
     */
    private $nodes;

    /**
     * @var NodeInterface
     */
    private $start;

    /**
     * @var NodeInterface
     */
    private $end;


    public function __construct(NodeInterface $start, NodeInterface $end)
    {
        $this->nodes = new NodeMap();
        $this->start = $this->nodes->get($start->getName());
        $this->end = $this->nodes->get($end->getName());
    }

    public function link(NodeInterface $src, NodeInterface $dst, SpecificationInterface $spec)
    {
        $src = $this->nodes->add($src);

        if ($src === $this->end) {
            throw new \LogicException('Cannot link from ending node.');
        }

        $dst = $this->nodes->add($dst->getName());

        if ($dst === $this->start) {
            throw new \LogicException('Cannot link to starting node.');
        }

        $src->addTransition(new Transition($src, $dst, $spec));

        return $this;
    }

    public function getWorflow()
    {
        $this->nodes->analyse();
        return new Workflow($this->start, $this->end, $this->nodes);
    }
}
