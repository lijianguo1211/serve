<?php
/***************************************************************************
 *
 * Copyright (c) 2011 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

namespace App\Baidu\Store;

/**
 * Abstract class of storage engine for user session related data,
 * like state & authorization code for oauth2.0, access token &
 * refresh token for current user.
 *
 * @package Baidu
 * @author zhujianting(zhujianting@baidu.com)
 * @version v2.0.0
 */
abstract class BaiduStore
{
	/**
	 * Supported variable key name.
	 * @var array
	 */
	protected static $supportedKeys = array(
		'state', 'code', 'session',
	);

	protected $clientId;

	public function __construct($clientId)
	{
		$this->clientId = $clientId;
	}

	/**
	 * Get the variable value specified by the variable key name for
	 * current session user from the storage system.
	 *
	 * @param string $key Variable key name
	 * @param mix $default Default value if the key couldn't be found
	 * @return mix Returns the value for the specified key if it exists,
	 * otherwise return $default value
	 */
	abstract public function get($key, $default = false);

	/**
	 * Save the variable item specified by the variable key name into
	 * the storage system for current session user.
	 *
	 * @param string $key	Variable key name
	 * @param mix $value	Variable value
	 * @return bool Returns true if the saving operation is success,
	 * otherwise returns false
	 */
	abstract public function set($key, $value);

	/**
	 * Remove the stored variable item specified by the variable key name
	 * from the storage system for current session user.
	 *
	 * @param string $key	Variable key name
	 * @return bool Returns true if remove success, otherwise returns false
	 */
	abstract public function remove($key);

	/**
	 * Remove all the stored variable items for current session user from
	 * the storage system.
	 *
	 * @return bool Returns true if remove success, otherwise returns false
	 */
	abstract public function removeAll();

	/**
	 * Get the actual key name for current storage engine.
	 *
	 * @param string $key The original key name
	 * @return string
	 */
	protected function getKeyForStore($key)
	{
		return implode('_', array('bds', $this->clientId, $key));
	}
}



/**
 * Storage engine using Session.
 */


/**
 * Storage engine using memcached.
 */


/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */
