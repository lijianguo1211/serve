<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/26
 * Time: 9:53
 */
return [
    //...
    'github' => [
        'client_id'     => 'b0eca095fb6e8c3ed056',
        'client_secret' => 'db6124bbecd7f2865b06c1cac8710b2228c59baf',
        'redirect'      => 'http://www.lglg.xyz/github/callback',
    ],
    /**
     * http://developer.baidu.com/wiki/index.php?title=docs/oauth/rest/file_data_apis_list
     *
     * http://openapi.baidu.com/oauth/2.0/authorize?
        response_type=code&
        client_id=YOUR_CLIENT_ID&
        redirect_uri=YOUR_REGISTERED_REDIRECT_URI&
        scope=email&
        display=popup
     *
     *
     * https://openapi.baidu.com/oauth/2.0/token?
        grant_type=authorization_code&
        code=CODE&
        client_id=YOUR_CLIENT_ID&
        client_secret=YOUR_CLIENT_SECRET&
        redirect_uri=YOUR_REGISTERED_REDIRECT_URI
     */
    'baidu' => [
        'id'=>'16150582',
        'apiKey'=>'CndXzv8eoGtwWGQcj3Q6TuVm',
        'secretKey'=>'QKyou0OMHtp4SHnQpWyoRO5Y2DxyNfen',
        'redirect_uri' => 'http://www.lglg.xyz/getBaiduCode',
    ]
];

