<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/25
 * Time: 16:38
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\MailConfirm;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Mail\Mailer;

class EmailToMsg extends Command
{
    protected $signature = 'emailToUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email to User';

    private $e;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->e = $mailer;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->email();
            $this->error('123456');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }

    public function email()
    {
        $user = User::find(15);
        $this->e->to('1539853340@qq.com')->send(new MailConfirm($user));
    }
}
