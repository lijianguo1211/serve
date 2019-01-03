<?php

namespace Illuminate\Contracts\Auth;

interface Guard
{
    /**
     * Determine if the current user is authenticated.
     * 判断当前用户是否登录
     * @return bool
     */
    public function check();

    /**
     * Determine if the current user is a guest.
     * 判断当前用户是否未登录
     * @return bool
     */
    public function guest();

    /**
     * Get the currently authenticated user.
     * 获取当前认证用户
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user();

    /**
     * Get the ID for the currently authenticated user.
     * 获取当前认证用户的 id，严格来说不一定是 id，应该是上个模型中定义的唯一的字段名
     * @return int|null
     */
    public function id();

    /**
     * Validate a user's credentials.
     * 根据提供的消息认证用户
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = []);

    /**
     * Set the current user.
     * 设置当前用户
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user);
}
