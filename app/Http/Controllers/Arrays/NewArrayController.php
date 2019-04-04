<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/3
 * Time: 14:19
 */

namespace App\Http\Controllers\Arrays;


use Illuminate\Support\Facades\DB;

class NewArrayController
{
    public static function index()
    {
        $arr = new \SplFixedArray(5);
        $arr[1] = 2;
        $arr[4] = 'foo';
        var_dump($arr);
        var_dump($arr[0]);
        var_dump($arr[1]);
        var_dump($arr[4]);
        $size = $arr->getSize();
        var_dump($size);
        $arr->setSize(10);
        $arr[9] = 'LiYi';
        var_dump($arr);
        try{
            var_dump($arr['liyi']);
        } catch(\RuntimeException $re) {
            echo $re->getMessage();
        }
        echo '**************count()****************'."\n";
        var_dump($arr->count());
        echo '**************current()****************'."\n";
        var_dump($arr->current());
        echo '**************next()****************'."\n";
        var_dump($arr->next());
        echo '**************key()****************'."\n";
        var_dump($arr->key());
        echo '**************offsetExists()****************'."\n";
        var_dump($arr->offsetExists('liyi'));
        echo '**************offsetGet()****************'."\n";
        var_dump($arr->offsetGet('9'));
        echo '**************offsetSet()****************'."\n";
        var_dump($arr->offsetSet('9','HAHA'));
        echo '**************offsetUnset()****************'."\n";
        var_dump($arr->offsetUnset(1));
        echo '**************rewind()****************'."\n";
        var_dump($arr->rewind());
        echo '**************toArray()****************'."\n";
        var_dump($arr->toArray());
        echo '**************valid()****************'."\n";
        var_dump($arr->valid());
        echo '******************************'."\n";
        $file = __DIR__.'/NewArrayController.php';
        $zip = new \ZipArchive();
        return response()->file($file);
    }

    public function joinForeach()
    {
        $t1 = microtime(true);
        DB::select("select * from users as u left join users_bak as b on u.id = b.id order by u.create_at desc limit 10");
        $t2 = microtime(true);

        echo bcsub($t2,$t1,10);
    }

    public function foreachJoin()
    {
        $t1 = microtime(true);
        $data = DB::select("select * from users order by create_at desc limit 10");

        foreach ($data as $v => $item) {
            DB::select("select * from users_bak where id = ?",[$item->id]);
        }

        $t2 = microtime(true);

        echo bcsub($t2,$t1,10);
    }
}
