<?php


namespace Alterway\Component\Workflow\tests\unit;

use Alterway\Component\Workflow\WorkflowInterface;
use atoum;

class Workflow extends atoum
{
    /**
     * @var WorkflowInterface
     */
    private $workflow;

    private $context;

    public function beforeTestMethod($method)
    {
        $spec = new \mock\Alterway\Component\Workflow\SpecificationInterface();
        $this->calling($spec)->isStatisfiedBy = function() { return true; };

        $this->context = new \mock\Alterway\Component\Workflow\ContextInterface();


        $builder = new \Alterway\Component\Workflow\Builder('A', 'G');
        $builder
            ->link('A', 'B', $spec)
            ->link('B', 'C', $spec)
            ->link('B', 'D', $spec)
            ->link('C', 'E', $spec)
            ->link('D', 'E', $spec)
            ->link('E', 'F', $spec)
            ->link('F', 'B', $spec)
            ->link('F', 'G', $spec)
        ;

        $this->workflow = $builder->getWorflow();
    }

    public function testICanUseThisFuckingShit()
    {
        try {
            while (true) {
                echo sprintf('Token: "%s". Advancing...', $this->workflow->getToken()).PHP_EOL;
                $this->workflow->next($this->context);
            }
        } catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
        }
    }
}