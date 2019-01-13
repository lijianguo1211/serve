<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\RabbitmqPull;

class PullMsg extends Command
{
    use RabbitmqPull;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pullMsg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '写实rabbitmq接收消息';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rsu = $this->getMessage();
        var_dump($rsu);
    }
}
