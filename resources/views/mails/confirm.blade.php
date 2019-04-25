@component('mail::message')

{{--尊敬的{{ $user->getUser()['username'] }}用户，你正在使用{{ $user->getUser()['email'] }}注册成为 花儿尊上 用户，如果是你本人操作，请点击确认按钮：--}}
尊敬的{{ $user->username }}用户，你正在使用{{ $user->email }}注册成为 花儿尊上 用户，如果是你本人操作，请点击确认按钮：

@component('mail::button', ['url' => $user->geValidateMailLink()])
{{--@component('mail::button', ['url' => 'http://www.lglg.xyz/'])--}}
        确定验证
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
