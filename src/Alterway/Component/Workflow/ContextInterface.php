<?php


namespace Alterway\Component\Workflow;


interface ContextInterface
{
    /**
     * Return the context defined by the given name
     *
     * @param $name
     */
    public function get($name);
}
