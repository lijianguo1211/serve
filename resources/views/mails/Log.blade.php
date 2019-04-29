@component('mail::message')

@component('mail::panel')
尊敬的{{ env('MAIL_TO_ADDRESS') }}管理员，你的网站目前出现的了影响程序正常运行的 {{ $level }} 级别错误,目前已记录在在日志里。请尽快处理。
错误是：{{ $message }}
详细信息请登录查看！！！
@endcomponent

紧急待处理！！！<br/>
{{ config('app.name') }}

@endcomponent
