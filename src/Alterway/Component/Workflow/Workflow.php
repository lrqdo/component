<?php


namespace Alterway\Component\Workflow;


use Alterway\Component\Workflow\Exception\AlreadyInEndingNodeException;
use Alterway\Component\Workflow\Exception\InvalidTokenException;
use Alterway\Component\Workflow\Exception\MoreThanOneOpenTransitionException;
use Alterway\Component\Workflow\Exception\NoOpenTransitionException;
use Alterway\Component\Workflow\Node\NodeInterface;
use Alterway\Component\Workflow\Node\NodeMapInterface;

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

    public function __construct(NodeInterface $start, NodeInterface $end, NodeMapInterface $nodes)
    {
        $this->start = $start;
        $this->end = $end;
        $this->nodes = $nodes;
        $this->current = $start;
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

        // TODO: Fire an event to be able to attach behavior to the current node

        return $this;
    }
}
