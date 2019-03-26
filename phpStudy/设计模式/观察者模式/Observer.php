<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 19:22
 */
interface Observer
{
    public function update($event_info = null);
}
