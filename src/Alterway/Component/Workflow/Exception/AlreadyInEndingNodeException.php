<?php


namespace Alterway\Component\Workflow\Exception;


class AlreadyInEndingNodeException extends \LogicException
{
    public function __construct()
    {
        return parent::__construct('Already at the ending node', 0);
    }
}
