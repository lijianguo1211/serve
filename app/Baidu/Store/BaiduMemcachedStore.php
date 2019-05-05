<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 9:30
 */

namespace App\Baidu\Store;

use App\Baidu\BaiduUtils;

class BaiduMemcachedStore extends BaiduStore
{
    /**
     * Memcache instance
     * @var Memcache
     */
    protected $memcache;

    /**
     * Session ID for current user to distinguish with other users.
     * @var string
     */
    protected $sessionId;

    /**
     * @param string $clientId
     * @param Memcache $memcache
     */
    public function __construct($clientId, $memcache, $sessionId)
    {
        $this->memcache = $memcache;
        $this->sessionId = $sessionId;

        parent::__construct($clientId);
    }

    public function get($key, $default = false)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return $default;
        }

        $name = $this->getKeyForStore($key);
        $value = $this->memcache->get($name);
        return ($value === false) ? $default : $value;
    }

    public function set($key, $value)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return false;
        }

        $name = $this->getKeyForStore($key);
        return $this->memcache->set($name, $value, 0, 0);
    }

    public function remove($key)
    {
        if (!in_array($key, self::$supportedKeys)) {
            return false;
        }

        $name = $this->getKeyForStore($key);
        return $this->memcache->delete($name);
    }

    public function removeAll()
    {
        foreach (self::$supportedKeys as $key) {
            $this->remove($key);
        }
        return true;
    }

    protected function getKeyForStore($key)
    {
        return implode('_', array('bds', $this->clientId, $this->sessionId, $key));
    }
}
