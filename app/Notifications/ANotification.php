<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ANotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *每个通知类都会有 via 方法，用来指明通知的方式
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        /*
         * 如果 via 数据库进行通知，那么 toXXX 就是 toDatabase
           如果 via 邮件进行通知，那么 toXXX 就是 toMail
         * */
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *方法接收 $notifiabel 作为参数
      方法返回一个数组，该数组之后会转换成 JSON 数据存放在通知数据表的 data 中
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
