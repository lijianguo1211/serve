<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\EmailToUserEvent' => [
            'App\Listeners\EmailToUserEventListener',
        ],
        'App\Events\UserMonitor' => [
            'App\Listeners\UserMonitorListener',
        ],
        'App\Events\LogToEmailEvent' => [
            'App\Listeners\LogToEmailListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
