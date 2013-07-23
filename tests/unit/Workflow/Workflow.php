<?php


namespace Alterway\Component\Workflow\tests\unit;

use Alterway\Component\Workflow\Builder;
use Alterway\Component\Workflow\Node\Node;
use Alterway\Component\Workflow\Token;
use atoum;

class Workflow extends atoum
{
    private $context;

    public function beforeTestMethod($method)
    {
        $this->context = new \mock\Alterway\Component\Workflow\ContextInterface();
    }

    public function testICanLaunchACorrectWorkflow()
    {
        $spec = new \mock\Alterway\Component\Workflow\SpecificationInterface();
        $this->calling($spec)->isStatisfiedBy = function () {
            return true;
        };

        $builder = new Builder('A', 'F');
        $builder
            ->link('A', 'B', $spec)
            ->link('B', 'C', $spec)
            ->link('C', 'D', $spec)
            ->link('D', 'E', $spec)
            ->link('E', 'F', $spec);

        $workflow = $builder->getWorflow();

        for ($i = 0; $i < 5; $i++) {
            $workflow->next($this->context);
        }

        $this
            ->variable($workflow->getToken())
            ->isEqualTo('F');
    }

    public function testICantHaveMoreThan2OpenedTransitions()
    {
        $spec = new \mock\Alterway\Component\Workflow\SpecificationInterface();
        $this->calling($spec)->isStatisfiedBy = function () {
            return true;
        };

        $builder = new Builder('A', 'G');
        $builder
            ->link('A', 'B', $spec)
            ->link('A', 'C', $spec);

        $workflow = $builder->getWorflow();

        try {
            $workflow->next($this->context);
        } catch (\Exception $e) {
            $this
                ->exception($e)
                ->isInstanceOf('Alterway\Component\Workflow\Exception\MoreThanOneOpenTransitionException')
                ->hasMessage('More than one open transition with current context');
        }
    }

    public function testICantGoToNextIfAlreadyOnEndingNode()
    {
        $spec = new \mock\Alterway\Component\Workflow\SpecificationInterface();
        $this->calling($spec)->isStatisfiedBy = function () {
            return true;
        };

        $builder = new Builder('A', 'C');
        $builder
            ->link('A', 'B', $spec)
            ->link('B', 'C', $spec);

        $workflow = $builder->getWorflow();

        try {
            for ($i = 0; $i < 3; $i++) {
                $workflow->next($this->context);
            }
        } catch (\Exception $e) {
            $this
                ->exception($e)
                ->isInstanceOf('Alterway\Component\Workflow\Exception\AlreadyInEndingNodeException')
                ->hasMessage('Already at the ending node');
        }
    }

    public function testICantGoToNextCauseNoOpenTransition()
    {
        $spec = new \mock\Alterway\Component\Workflow\SpecificationInterface();
        $this->calling($spec)->isStatisfiedBy = function () {
            return false;
        };

        $builder = new Builder('A', 'B');
        $builder
            ->link('A', 'B', $spec);

        $workflow = $builder->getWorflow();

        try {
            $workflow->next($this->context);
        } catch (\Exception $e) {
            $this
                ->exception($e)
                ->isInstanceOf('Alterway\Component\Workflow\Exception\NoOpenTransitionException')
                ->hasMessage('No open transition with current context');
        }
    }

    public function testICantGoToNextCauseWrongToken()
    {
        $spec = new \mock\Alterway\Component\Workflow\SpecificationInterface();
        $this->calling($spec)->isStatisfiedBy = function () {
            return true;
        };

        $builder = new \Alterway\Component\Workflow\Builder('A', 'C');
        $builder
            ->link('A', 'B', $spec)
            ->link('B', 'C', $spec);

        $workflow = $builder->getWorflow();

        try {
            $workflow->setToken(new Token('D'));
        } catch (\Exception $e) {
            $this
                ->exception($e)
                ->isInstanceOf('Alterway\Component\Workflow\Exception\InvalidTokenException')
                ->hasMessage('The given token is invalid');
        }
    }
}
