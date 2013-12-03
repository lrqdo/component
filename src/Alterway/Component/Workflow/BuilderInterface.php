<?php

namespace Alterway\Component\Workflow;

interface BuilderInterface
{
    /**
     * Initialize the builder with the first link
     *
     * @param string                 $src
     * @param SpecificationInterface $spec
     *
     * @return mixed
     */
    public function open($src, SpecificationInterface $spec);

    /**
     * Add a link to the workflow builder
     *
     * @param string                 $src
     * @param string                 $dst
     * @param SpecificationInterface $spec
     *
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
