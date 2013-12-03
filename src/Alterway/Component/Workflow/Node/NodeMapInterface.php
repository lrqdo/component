<?php


namespace Alterway\Component\Workflow\Node;


interface NodeMapInterface
{
    /**
     * Return the node defined by the given name (add it to the nodemap if not already exist)
     *
     * @param $name
     *
     * @return NodeInterface
     */
    public function get($name);

    /**
     * Check if the node name exist in the map
     *
     * @param $name
     *
     * @return boolean
     */
    public function has($name);
}
