<?php

class FunctionGenerator extends Thread
{
    public $a = null;
    
    public function run()
    {
        while(1) {
            $this->a = Closure::bind(function() {}, null);
        }
    }
}

// init threads array
$ths = array();

// define max threads
$tMax = 100;

// initiate threads
for ($i = 1; $i <= $tMax; $i++) {
    $ths[$i] = new FunctionGenerator();
    $ths[$i]->a = 0;
}

// start threads
for ($i = 1; $i <= $tMax; $i++) {
    $ths[$i]->start();
}

// start threads
for ($i = 1; $i <= $tMax; $i++) {
    $ths[$i]->join();
}

$ths = null;

// echo status
echo PHP_EOL . "finished script!" . PHP_EOL;
