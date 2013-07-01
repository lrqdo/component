<?php


namespace Alterway\Component\Workflow;


use Alterway\Component\Workflow\Node\NodeMap;

class Builder implements  BuilderInterface
{
    public function __construct($start, $end)
    {
        $this->nodes = new NodeMap();
        $this->start = $this->nodes->get($start);
        $this->end = $this->nodes->get($end);
    }

    public function link($src, $dst, $spec)
    {
        $src = $this->nodes->get($src);

        if ($src === $this->end) {
            throw new \LogicException('Cannot link from ending node.');
        }

        $dst = $this->nodes->get($dst);

        if ($dst === $this->start) {
            throw new \LogicException('Cannot link to starting node.');
        }

        $src->addTransition(new Transition($src, $dst, $spec));

        return $this;
    }

    public function getWorflow()
    {
        return new Workflow($this->start, $this->end, $this->nodes);
    }
}
