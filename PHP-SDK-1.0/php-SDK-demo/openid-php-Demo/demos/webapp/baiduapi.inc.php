<?php

/***************************************************************************
 *
 * Copyright (c) 2012 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

require_once('../../Baidu.php');

$clientId = 'h1ogDjq1j7DTtXf2YQcmu4GF';
$clientSecret = 'nQKTH3sblbeGS1CPunzwU46wqOFAWQkl';
$redirectUri = 'http://robin928.sinaapp.com/demos/webapp/login_callback.php';
$domain = '.robin928.sinaapp.com';

$baidu = new Baidu($clientId, $clientSecret, $redirectUri, new BaiduCookieStore($clientId));
// Get User ID and User Name
$user = $baidu->getLoggedInUser();

 
/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */