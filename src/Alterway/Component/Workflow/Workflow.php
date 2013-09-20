<?php


namespace Alterway\Component\Workflow;

use Alterway\Component\Workflow\Event\WorkflowEvent;
use Alterway\Component\Workflow\Exception\AlreadyInEndingNodeException;
use Alterway\Component\Workflow\Exception\InvalidTokenException;
use Alterway\Component\Workflow\Exception\MoreThanOneOpenTransitionException;
use Alterway\Component\Workflow\Exception\NoOpenTransitionException;
use Alterway\Component\Workflow\Node\NodeInterface;
use Alterway\Component\Workflow\Node\NodeMapInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Workflow implements WorkflowInterface
{
    /**
     * @var NodeInterface
     */
    private $start;

    /**
     * @var NodeInterface
     */
    private $end;

    /**
     * @var NodeMapInterface
     */
    private $nodes;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    public function __construct(NodeInterface $start, NodeInterface $end, NodeMapInterface $nodes, $eventDispatcher)
    {
        $this->start = $start;
        $this->end = $end;
        $this->nodes = $nodes;
        $this->current = $start;

        if (null === $eventDispatcher) {
            $eventDispatcher = new EventDispatcher();
        }
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function setToken(Token $token)
    {
        if (!$this->nodes->has($token)) {
            throw new InvalidTokenException();
        }

        $this->current = $this->nodes->get($token);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getToken()
    {
        return new Token($this->current->getName());
    }

    /**
     * @inheritdoc
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function next(ContextInterface $context)
    {
        if ($this->current === $this->end) {
            throw new AlreadyInEndingNodeException();
        }

        $transitions = $this->current->getOpenTransitions($context);

        if (0 === count($transitions)) {
            throw new NoOpenTransitionException();
        } elseif (1 < count($transitions)) {
            throw new MoreThanOneOpenTransitionException();
        }

        $transition = array_pop($transitions);
        $this->setToken(new Token($transition->getDestination()->getName()));

        $context->set('workflow', $this);

        $event = new WorkflowEvent($context);
        $this->eventDispatcher->dispatch($transition->getDestination()->getName(), $event);

        return $this;
    }
}
