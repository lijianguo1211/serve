<?php

namespace App\Listeners;

use App\Events\EmailToUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\MailConfirm;
use Illuminate\Mail\Mailer;

class EmailToUserEventListener implements ShouldQueue
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
     * @param  EmailToUserEvent  $event
     * @return void
     */
    public function handle(EmailToUserEvent $event)
    {
        try{
            $this->sendValidateMail($event->user);
        } catch(\Exception $e) {
            \Log::error('邮件发送失败:'.$e->getMessage());
        }

    }

    public function sendValidateMail($event)
    {
        return $this->email->to($event->email)->send(new MailConfirm($event));
    }

    /**
     * 处理失败逻辑
     * @param EmailToUserEvent $event
     * @param $exception
     */
    public function failed(EmailToUserEvent $event, $exception)
    {
        //
    }
}
