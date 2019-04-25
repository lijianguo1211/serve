<?php

namespace App\Listeners;

use App\Events\UserMonitor;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserMonitorListener implements ShouldQueue
{
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
     * @param  UserMonitor  $event
     * @return void
     */
    public function handle(UserMonitor $event)
    {
        Log::info($event->data);
        Log::info('新注册一位用户');

    }
}
