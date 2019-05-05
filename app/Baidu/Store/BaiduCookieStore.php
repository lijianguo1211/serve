<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 9:28
 */

namespace App\Baidu\Store;

use App\Baidu\BaiduUtils;

class BaiduCookieStore extends BaiduStore
{
    /**
     * The domain where to save the session cookie.
     * @var string
     */
    protected $domain;

    /**
     * Consturctor
     * @param string $clientId App's client id.
     * @param string $domain The domain where to save the session cookie.
     */
    public function __construct($clientId, $domain = '')
    {
        parent::__construct($clientId);
        $this->domain = $domain;
        header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTR STP IND DEM"');
    }

    public function get($key, $default = false)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return $default;
        }

        $name = $this->getKeyForStore($key);
        $value = $_COOKIE[$name];
        if ($value && $key == 'session') {
            parse_str($value, $value);
        }
        if (empty($value)) {
            $value = $default;
        }

        return $value;
    }

    public function set($key, $value)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return false;
        }

        $name = $this->getKeyForStore($key);
        if ($key == 'session') {
            $expires = isset($value['expires_in']) ? $value['expires_in'] * 2 : 3600*24;
            $value = http_build_query($value, '', '&');
        } else {
            $expires = 3600*24;
        }

        setcookie($name, $value, time() + $expires, '/');
        $_COOKIE[$name] = $value;

        return true;
    }

    public function remove($key)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return false;
        }

        $name = $this->getKeyForStore($key);
        setcookie($name, 'delete', time() - 3600*24, '/');
        unset($_COOKIE[$name]);

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
