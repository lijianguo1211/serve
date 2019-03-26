<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 19:04
 */

class UserObserver implements \SplObserver
{
    private $changedUsers = [];

    public function update(SplSubject $subject)
    {
        // TODO: Implement update() method.
        $this->changedUsers[] = clone $subject;
    }

    public function getChangedUser():array
    {
        return $this->changedUsers;
    }
}
