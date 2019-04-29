<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/29
 * Time: 15:37
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function build()
    {
        $this->subject('注意：错误日志报告')
            ->markdown('mails.log')->with([
                'level' => $this->params['level'],
                'message' => $this->params['message'],
            ]);
    }
}
