<?php

require __DIR__ . "/../vendor/autoload.php";

use AppserverIo\Fhreads\Thread;

class Runnable extends Thread
{
    private $callables;
    public function __construct(callable ...$callables)
    {
        $this->callables = $callables;
    }
    public function run()
    {
        // add ref count to local function scope to avoid gc destroying object when modified
        $callables = $this->callables;

        do {
            $callable = array_shift($callables);
            $callable();
        } while (count($callables) > 0);
    }
}

$runable = new Runnable(
    function () { echo 'Task 1.' . PHP_EOL; },
    function () { echo 'Task 2.' . PHP_EOL; },
    function () { echo 'Task 3.' . PHP_EOL; },
    function () { echo 'Task 4.' . PHP_EOL; },
    function () { echo 'Task 5.' . PHP_EOL; }
);

$runable->start();
$runable->join();

