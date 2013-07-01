<?php
namespace Alterway\Component\Workflow;

use Alterway\Component\Workflow\Node\Builder;

$builder = new Builder('A', 'G');
$builder
    ->link('A', 'B', new Specification())
    ->link('B', 'C', new Specification())
    ->link('B', 'D', new Specification())
    ->link('C', 'E', new Specification())
    ->link('D', 'E', new Specification())
    ->link('E', 'F', new Specification())
    ->link('F', 'B', new Specification())
    ->link('F', 'G', new Specification())
;

$workflow = $builder->getWorflow();

try {
    while (true) {
        echo sprintf('Token: "%s". Advancing...', $workflow->getToken()).PHP_EOL;
        $workflow->next(new Context());
    }
} catch (Exception $e) {
    echo $e->getMessage().PHP_EOL;
}
?>