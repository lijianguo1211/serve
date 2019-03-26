<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 17:49
 */
require_once 'Milldeware.php';
require_once 'AuthOnce.php';
require_once 'AuthTwo.php';
require_once 'VerfiyCsrfToekn.php';
require_once 'SetCookie.php';

$handle = function(){
    echo "当前要执行的程序\n";
};

/*function call_milldware() {
    SetCookie::handle(function(){
        VerfiyCsrfToekn::handle(function(){
            AuthOnce::handle(function(){
                AuthTwo::handle(function(){
                    echo "当前要执行的程序\n";
                });
            });
        });
    });
}*/
//call_milldware();

$pipe_arr = [
    'AuthTwo',
    'AuthOnce',
    'VerfiyCsrfToekn',
    'SetCookie',
];

$callback = array_reduce($pipe_arr,function($stack,$pipe){
        return function() use($stack,$pipe) {
            return $pipe::handle($stack);
        };
},$handle);

call_user_func($callback);
