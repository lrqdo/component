<?php


namespace Alterway\Component\Workflow\Node;


use Symfony\Component\Config\Definition\NodeInterface;

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

    public function add(NodeInterface $node)
    {
        $this->items[$node->getName()] = $node;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function has($name)
    {
        $name = (string)$name;

        return isset($this->items[$name]);
    }

    public function analyse()
    {
        exit('prout');
    }
}
