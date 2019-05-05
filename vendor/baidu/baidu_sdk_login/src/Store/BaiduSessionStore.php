<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 9:29
 */

namespace Baidu\BaiduLoginSdk\Store;

use Baidu\BaiduLoginSdk\BaiduUtils;

class BaiduSessionStore extends BaiduStore
{
    public function __construct($clientId)
    {
        if (!session_id()) {
            session_start();
        }
        parent::__construct($clientId);
    }

    public function get($key, $default = false)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return $default;
        }

        $name = $this->getKeyForStore($key);
        return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
    }

    public function set($key, $value)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return false;
        }

        $name = $this->getKeyForStore($key);
        $_SESSION[$name] = $value;
        return true;
    }

    public function remove($key)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return false;
        }

        $name = $this->getKeyForStore($key);
        unset($_SESSION[$name]);

        return true;
    }

    public function removeAll()
    {
        foreach (self::$supportedKeys as $key) {
            $this->remove($key);
        }
        return true;
    }
}
