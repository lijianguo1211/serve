<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 10:03
 */
$str = 'qwertyuiiopopasdgdfhklkjklzxvcvnmsdytyijertyrteyrtyrtytyttrujyjhgjmhgmhgkjhlkijljkhlhjlhjlkhlkhklhjklhjklhjklkuyifghdfgddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddccccccccvvvvvvvvvvvvvvvvvvvvvvvvvvvvbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbnm,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjgfffffffffffffffffffffffffffffffffffffffff';

/*$t1 = microtime(true);
$len = strlen($str);

for ($i=0; $i<$len; $i++) {
   echo 'A';
}

$t2 = microtime(true);

$t3 = ($t2-$t1)/1000;

var_dump($t3.'/ms');*/

$t1 = microtime(true);


for ($i=0; $i<strlen($str); $i++) {
    echo 'A';
}

$t2 = microtime(true);

$t3 = ($t2-$t1)/1000;

var_dump($t3.'/ms');
