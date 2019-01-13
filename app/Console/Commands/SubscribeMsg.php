<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\RabbitmqPush;

class SubscribeMsg extends Command
{
    use RabbitmqPush;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Sub:Msg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        for ($i=0; $i<1000; $i++)
        {
            $msg = [
                'li' => $i,
                'yi' => $i*$i
            ];
            $res = $this->rmqPush(json_encode($msg));
            var_dump($res);
        }
    }
}
