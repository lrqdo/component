<?php


namespace Alterway\Component\Workflow;


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
            throw new \LogicException(sprintf('invalid token "%s".', $token));
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
            throw new \LogicException('Already at the ending node.');
        }

        $transitions = $this->current->getOpenTransitions($context);

        if (0 === count($transitions)) {
            throw new \LogicException('No open transition with current context.');
        } elseif (1 < count($transitions)) {
            //throw new LogicException('More than one open transition with current context.');
            shuffle($transitions);
        }

        $transition = array_pop($transitions);
        $this->current = $transition->getDestination();

        // TODO: Fire an event to be able to attach behavior to the current node

        return $this;
    }
}
