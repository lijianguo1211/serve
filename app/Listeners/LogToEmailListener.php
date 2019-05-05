<?php

namespace App\Listeners;

use App\Events\LogToEmailEvent;
use App\Mail\LogEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class LogToEmailListener
{
    private $email;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->email = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  LogToEmailEvent  $event
     * @return void
     */
    public function handle(LogToEmailEvent $event)
    {
        try {
            $this->sendMail($event->params);
        } catch(\Exception $e) {
            \Log::error('邮件发送失败:'.$e->getMessage());
        }
    }

    public function sendMail(array $param)
    {
        return $this->email->to(env('MAIL_TO_ADDRESS'))->send(new LogEmail($param));
    }
}
