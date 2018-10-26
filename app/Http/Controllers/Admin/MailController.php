<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailer;


class MailController extends Controller
{
    private $mailer;

    /**
     * UserController constructor.
     * @param \Illuminate\Mail\Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send()
    {
        $emailData = [
            'content' => '1234566',
            'subject' => '1223',
            'addr'    => '270326786@qq.com'
        ];
        $tag = $this->mailer
            ->raw($emailData['content'],
                function ($message)use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
        return $tag;
    }
}
