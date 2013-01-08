<?php
use mageekguy\atoum;

define('APP_PATH', __DIR__ . '/../..');
$runner->setBootstrapFile(__DIR__ . '/bootstrap.php');
$script->addTestAllDirectory(__DIR__);

// cli
$cliReport = $script->addDefaultReport();
$stdOutWriter = new atoum\writers\std\out();
$cliReport->addWriter($stdOutWriter);
$runner->addReport($cliReport);


// xunit
$xunit = new \mageekguy\atoum\reports\asynchronous\xunit();
$writer = new \mageekguy\atoum\writers\file(APP_PATH . '/build/logs/junit.xml');
$xunit->addWriter($writer);
$runner->addReport($xunit);