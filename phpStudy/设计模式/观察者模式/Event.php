<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 19:26
 */

require_once 'Observer.php';
require_once 'Observer1.php';
require_once 'Observer2.php';

class Event
{
    private $Observers;

    public function add(Observer $observer)
    {
        $this->Observers[] = $observer;
    }

    public function notify()
    {
        foreach ($this->Observers as $observer) {
            $observer->update();
        }
    }

    public function trigger()
    {
        $this->notify();
    }
}

$e = new Event();

$e->add(new Observer1());

$e->add(new Observer2());

$e->trigger();

$a=[0,1,2,3]; $b=[1,2,3,4,5]; $a+=$b; var_dump($a);
