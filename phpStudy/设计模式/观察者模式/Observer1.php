<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 19:23
 */

class Observer1 implements Observer
{
    public function update($event_info = null)
    {
        // TODO: Implement update() method.
        echo "观察者1 收到通知，执行完毕\n";
    }
}
