<?php


namespace Alterway\Component\Workflow;


class Transition implements TransitionInterface
{
    /**
     * @var string
     */
    private $src;

    /**
     * @var string
     */
    private $dst;

    /**
     * @var SpecificationInterface
     */
    private $spec;

    public function __construct($src, $dst, SpecificationInterface $spec)
    {
        $this->src = $src;
        $this->dst = $dst;
        $this->spec = $spec;
    }

    /**
     * @inheritdoc
     */
    public function isOpen(ContextInterface $context)
    {
        return $this->spec->isSatisfiedBy($context);
    }

    /**
     * @inheritdoc
     */
    public function getDestination()
    {
        return $this->dst;
    }
}
