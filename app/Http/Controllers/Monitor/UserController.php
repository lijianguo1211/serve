<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/1/23
 * Time: 14:14
 */
namespace App\Http\Controllers\Monitor;

use App\Events\UserMonitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UserController
{
    private $input;

    public function __construct(Request $request)
    {
        $this->input = $request->all();
    }

    public function addUser()
    {
        $data = [
            'name' => $this->input['name'],
            'password' => bcrypt($this->input['password']),
            'email' => $this->input['email'],
            'create_at' => time(),
            'update_at' => time()
        ];

        try {
            $res = DB::table('users')->insert($data);
        } catch (Exception $e) {
            return json_encode(['status'=>0,'info'=>$e]);
        }
        if (empty($res))
        {
            return json_encode(['status'=>0,'info'=>'失败']);
        }
        event(new UserMonitor($data));
        return json_encode(['status'=>1, 'info' => $res]);
    }

    public function cacheTest()
    {

    }
}
