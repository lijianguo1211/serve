<?php

/***************************************************************************
 *
 * Copyright (c) 2012 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

require_once('../../Baidu.php');

$clientId = 'llYR1Ba1cZ3uwEX4tcbO6QL5';
$clientSecret = 'obh5DcqzusMmhxrlh8tlGYjHYt5px5OS';
$redirectUri = 'http://robin928.sinaapp.com/demos/website/login_callback.php';
$domain = '.robin928.sinaapp.com';

$baidu = new Baidu($clientId, $clientSecret, $redirectUri, new BaiduCookieStore($clientId));
// Get User ID and User Name
$user = $baidu->getLoggedInUser();

 
/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */