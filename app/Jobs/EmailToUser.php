<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EmailToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int 指定队列任务最大失败次数  php artisan queue:work --tries=5
     */
    public $tries = 5;

    /**
     * @var int 队列任务最大运行时长  php artisan queue:work --timeout=30
     */
    public $timeout = 60;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }

    /**
     * 在指定时间内允许任务的最大尝试次数
     * @return \Illuminate\Support\Carbon
     */
    public function retryUntil()
    {
        return now()->addSecond(5);
    }
}
