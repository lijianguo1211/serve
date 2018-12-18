<?php
namespace App\Http\Controllers\Test;

class SaveController
{
  /**
   * [index description]
   * @return [type] [description]
   */
  public function index()
  {

  }

  /**
   * [save description]
   * @param  [type] $param [description]
   * @return [type]        [description]
   */
  public function save($param)
  {
    switch ($param) {
      case '0':
        $result = $param++;
        break;
      case '1':
        $result = $param--;
          break;
      case '2':
        $result = $param * $param;
          break;
      case '3':
        $result = $param % 2;
          break;
      default:
        $result = $param * 0;
        break;
    }
    return $result;
  }
}
