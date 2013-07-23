<?php


namespace Alterway\Component\Workflow\Event;


use Alterway\Component\Workflow\ContextInterface;
use Symfony\Component\EventDispatcher\Event;

class WorkflowEvent extends Event
{

    /**
     * @var ContextInterface
     */
    private $context;

    function __construct(ContextInterface $context)
    {
        $this->context = $context;
    }

    public function getContext()
    {
        return $this->context;
    }
}
