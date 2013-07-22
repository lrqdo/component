<?php


namespace Alterway\Component\Workflow\Node;


class NodeMap implements NodeMapInterface
{
    /**
     * @var array
     */
    private $items;

    public function __construct()
    {
        $this->items = array();
    }

    /**
     * @inheritdoc
     */
    public function get($name)
    {
        $name = (string)$name;

        if (!isset($this->items[$name])) {
            $this->items[$name] = new Node($name);
        }

        return $this->items[$name];
    }

    /**
     * @inheritdoc
     */
    public function has($name)
    {
        $name = (string)$name;

        return isset($this->items[$name]);
    }
}
