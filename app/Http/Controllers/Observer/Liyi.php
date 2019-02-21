<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/15
 * Time: 17:01
 */
namespace App\Http\Controllers\Observer;

class Liyi implements Car
{
    private $component;

    public function __construct(Car $component)
    {
        $this->component = $component;
    }

    public function disPlay()
    {
        // TODO: Implement disPlay() method.
        $this->component->disPlay();
    }
}
