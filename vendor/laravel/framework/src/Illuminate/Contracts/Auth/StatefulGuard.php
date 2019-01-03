<?php

namespace Illuminate\Contracts\Auth;

interface StatefulGuard extends Guard
{
    /**
     * Attempt to authenticate a user using the given credentials.
     * 尝试根据提供的凭证验证用户是否合法
     * @param  array  $credentials
     * @param  bool   $remember
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false);

    /**
     * Log a user into the application without sessions or cookies.
     * 一次性登录，不记录session or cookie
     * @param  array  $credentials
     * @return bool
     */
    public function once(array $credentials = []);

    /**
     * Log a user into the application.
     * 登录用户，通常在验证成功后记录 session 和 cookie
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  bool  $remember
     * @return void
     */
    public function login(Authenticatable $user, $remember = false);

    /**
     * Log the given user ID into the application.
     * 使用用户 id 登录
     * @param  mixed  $id
     * @param  bool   $remember
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function loginUsingId($id, $remember = false);

    /**
     * Log the given user ID into the application without sessions or cookies.
     * 使用用户 ID 登录，但是不记录 session 和 cookie
     * @param  mixed  $id
     * @return bool
     */
    public function onceUsingId($id);

    /**
     * Determine if the user was authenticated via "remember me" cookie.
     * 通过 cookie 中的 remember token 自动登录
     * @return bool
     */
    public function viaRemember();

    /**
     * Log the user out of the application.
     * 退出
     * @return void
     */
    public function logout();
}
