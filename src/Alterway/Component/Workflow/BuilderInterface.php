<?php


namespace Alterway\Component\Workflow;


interface BuilderInterface
{
    /**
     * Add a link to the workflow builder
     *
     * @param $src
     * @param $dst
     * @param $spec
     * @return mixed
     */
    public function link($src, $dst, $spec);

    /**
     * Return the workflow build with the builder
     *
     * @return mixed
     */
    public function getWorflow();
}