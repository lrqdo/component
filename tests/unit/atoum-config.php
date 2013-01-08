<?php
use
    mageekguy\atoum;


$script->addTestAllDirectory(__DIR__);

// $cliReport = new atoum\reports\realtime\cli();
$cliReport = $script->addDefaultReport();

$stdOutWriter = new atoum\writers\std\out();
$cliReport->addWriter($stdOutWriter);


$runner->addReport($cliReport);
$runner->setBootstrapFile(__DIR__ . '/bootstrap.php');