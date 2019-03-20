<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/20
 * Time: 17:07
 */

class Node
{
    /**
     * @var
     * 节点数据
     */
    public $data;

    /**
     * @var
     * 下一节点
     */
    public $next;

    /**
     * Node constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
