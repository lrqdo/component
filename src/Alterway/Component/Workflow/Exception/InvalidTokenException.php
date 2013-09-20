<?php


namespace Alterway\Component\Workflow\Exception;


class InvalidTokenException extends \LogicException
{
    public function __construct()
    {
        return parent::__construct('The given token is invalid', 0);
    }
}
