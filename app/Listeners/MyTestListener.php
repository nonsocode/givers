<?php

namespace App\Listeners;

use App\Events\MyCustomEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyTestListener implements ShouldQueue
{
    public $queue = "filer";
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MyCustomEvent  $event
     * @return void
     */
    public function handle(MyCustomEvent $event)
    {
        echo "this is from the listener\n";
        $f = fopen("C:/Users/Nonso/Desktop/fromListener.php", "w+");
        fclose($f);
    }
}
