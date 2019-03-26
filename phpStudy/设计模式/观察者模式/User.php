<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 18:58
 */

class User implements \SplSubject
{
    private $email;

    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        // TODO: Implement attach() method.
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        // TODO: Implement detach() method.
        $this->observers->detach($observer);
    }

    public function notify()
    {
        // TODO: Implement notify() method.
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }
}
