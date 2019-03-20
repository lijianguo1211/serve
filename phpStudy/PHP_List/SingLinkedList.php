<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/20
 * Time: 17:10
 */

include_once 'Node.php';

class SingLinkedList
{
    /**
     * 头节点
     * @var
     */
    private $header;

    public function __construct($data)
    {
        $this->header = new Node($data);
    }

    /**
     * 清空链表
     */
    public function clear()
    {
        $this->header = null;
    }

    /**
     * 显示链表
     * @return string
     */
    public function display()
    {
        $current = $this->header;
        if ($current->next == null) {
            return 'list table is null';
        }

        while($current->next != null) {
            echo "---->" . $current->next->data;
            $current = $current->next;
        }
    }

    /**
     * 查找节点
     * @param $item
     * @return Node
     */
    public function find($item)
    {
        $current = $this->header;
        while($current->data != $item){
            $current = $current->next;
        }
        return $current;
    }

    /**
     * 插入节点
     * @param $item
     * @param $new
     * @return bool
     */
    public function insert($item,$new)
    {
        $newNode = new Node($new);
        $current = $this->find($item);
        $newNode->next = $current->next;
        $current->next = $newNode;
        return true;
    }

    /**
     * 更新节点
     * @param $old
     * @param $new
     * @return string
     */
    public function update($old,$new)
    {
        $current = $this->header;

        if ($current == null) {
            return 'link listed table is null';
        }

        while($current->next != null) {
            if ($current->data == $old) {
                break;
            }
            $current = $current->next;
        }
        return $current->data = $new;
    }

    /**
     * 查找待删除节点的前一个节点
     * @param $item
     * @return Node|null
     */
    public function findPrevious($item)
    {
        $current = $this->header;
        while($current->next != null && $current->next->data != $item) {
            $current = $current->next;
        }

        return $current;
    }

    /**
     * 删除一个节点
     * @param $item
     */
    public function delete($item)
    {
        $previous = $this->findPrevious($item);

        if ($previous->next != null) {
            $previous->next = $previous->next->next;
        }
    }

    public function remove($item)
    {
        $current = $this->header;

        while($current->next != null && $current->next->data != $item) {
            $current = $current->next;
        }

        if ($current->next != null) {
            $current->next = $current->next->next;
        }
    }
}

$link = new SingLinkedList('header');

$link->insert('header','hello');

$link->insert('hello','world');

$link->insert('world','Child');

$link->insert('Child','USA');

$link->insert('USA','Math');

$link->display();

echo "\n";

$link->find('world');

$link->update('Child','WaHaHaHa');

$link->display();
echo "\n";
$link->delete('USA');

$link->display();

var_dump($link);
