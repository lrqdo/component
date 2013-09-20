<?php


namespace Alterway\Component\Workflow;


use Alterway\Component\Workflow\Node\NodeInterface;

interface BuilderInterface
{
    /**
     * Add a link to the workflow builder
     *
     * @param string $src
     * @param string $dst
     * @param SpecificationInterface $spec
     * @return mixed
     */
    public function link($src, $dst, SpecificationInterface $spec);

    /**
     * Return the workflow build with the builder
     *
     * @return mixed
     */
    public function getWorflow();
}
