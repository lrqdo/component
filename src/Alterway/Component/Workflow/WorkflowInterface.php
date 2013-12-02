<?php


namespace Alterway\Component\Workflow;


interface WorkflowInterface
{
    /**
     * Set the current token
     *
     * @param Token $token
     *
     * @return WorkflowInterface
     */
    public function setToken(Token $token);

    /**
     * Return the current token
     *
     * @return TokenInterface
     */
    public function getToken();

    /**
     * Move the current token to the next step of the workflow
     *
     * @param ContextInterface $context
     *
     * @return WorkflowInterface
     */
    public function next(ContextInterface $context);

    /**
     * Initialize the workflow
     *
     * @param ContextInterface $context
     *
     * @return WorkflowInterface
     */
    public function init(ContextInterface $context);
}
