<?php

require __DIR__ . "/../vendor/autoload.php";

use AppserverIo\Fhreads\Thread;

class DummyThread extends Thread
{
    public function run()
    {
        $this->synchronized(function($self) {
            echo 'In Synchronized Thread Context.' . PHP_EOL;
            $self->b = new stdClass();
            sleep(1);
        });
        usleep(100);
        $this->synchronized(function($self) {
            echo "finished Thread run\n";
        });
    }
}

$objs1 = new stdClass();
$objs1 = new stdClass();
$objs1 = new stdClass();
$t = new DummyThread();

$t->start();

usleep(1000);
$t->synchronized(function($self) use($objs1) {
    echo 'In Synchronized Global Context.' . PHP_EOL;
    $self->a = $objs1;
    sleep(1);
});

$t->join();

var_dump($t);

echo "finished script\n";
