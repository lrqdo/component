<?php


namespace Alterway\Component\Workflow;


use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;

interface ContextInterface
{
    /**
     * Adds parameters to the service container parameters.
     *
     * @param array $parameters An array of parameters
     *
     * @api
     */
    public function add(array $parameters);

    /**
     * Gets a service container parameter.
     *
     * @param string $name The parameter name
     *
     * @return mixed  The parameter value
     *
     * @throws ParameterNotFoundException if the parameter is not defined
     *
     * @api
     */
    public function get($name);

    /**
     * Sets a service container parameter.
     *
     * @param string $name  The parameter name
     * @param mixed $value The parameter value
     *
     * @api
     */
    public function set($name, $value);
}
