<?php


namespace Alterway\Component\Workflow;


interface WorkflowInterface
{
    /**
     * Set the current token
     *
     * @param Token $token
     * @return mixed
     */
    public function setToken(Token $token);

    /**
     * Return the current token
     *
     * @return mixed
     */
    public function getToken();

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher();

    /**
     * Move the current token to the next step of the workflow
     *
     * @param ContextInterface $context
     * @return mixed
     */
    public function next(ContextInterface $context);
}
