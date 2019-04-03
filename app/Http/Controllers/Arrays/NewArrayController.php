<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/3
 * Time: 14:19
 */

namespace App\Http\Controllers\Arrays;


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
        $file = 'F:\LL\serve\phpStudy\Elasticsearch_php\Elasticsearch';
        if(is_file($file)) {
            echo 123;
        }
        echo 456;die();
        return response()->file($file);
    }
}

NewArrayController::index();
