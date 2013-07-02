<?php


namespace Alterway\Component\Workflow;


use Alterway\Component\Workflow\Node\NodeInterface;

interface BuilderInterface
{
    /**
     * Add a link to the workflow builder
     *
     * @param NodeInterface $src
     * @param NodeInterface $dst
     * @param SpecificationInterface $spec
     * @return mixed
     */
    public function link(NodeInterface $src, NodeInterface $dst, SpecificationInterface $spec);

    /**
     * Return the workflow build with the builder
     *
     * @return mixed
     */
    public function getWorflow();
}