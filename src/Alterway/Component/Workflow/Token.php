<?php


namespace Alterway\Component\Workflow;


class Token implements TokenInterface
{
    private $nodeId;

    public function __construct($nodeId)
    {
        $this->nodeId = (string)$nodeId;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->nodeId;
    }
}
