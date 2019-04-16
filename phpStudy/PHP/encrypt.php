<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 13:41
 */
// 列出openssl加密扩展支持的对称加密方法
$methods = openssl_get_cipher_methods();
//var_dump($methods);

$iv = substr(md5('test'),0,8);
$encrypt_data = openssl_encrypt('codeman is a good man','des-cbc','passwd',OPENSSL_RAW_DATA,$iv);
//$encrypt_data = openssl_encrypt('codeman is a good man','des-cbc','passwd',OPENSSL_RAW_DATA);
echo '加密'."\n";
echo $encrypt_data;
echo "\n";
echo '解密'."\n";
$decrypt_data = openssl_decrypt($encrypt_data,'des-cbc','passwd',OPENSSL_RAW_DATA,$iv);
echo $decrypt_data;

// 私钥
$private_key = '-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQDS6VbgEpOwVc8jXYx/uL6ItMS6aBPVo8fvw0pd90jLJYvfJcFJ
dYVFh6JPRdpGhlIrED45VdsktcJvJj0cLNI5ZIZ680aS6JTFe3ScBY4Mi7bLKzBN
YtMBtnkAFbMmWlCXV4qzZYg8+xNktY5ClZZCvZzzlaU5djtUSoxTLkxcmwIDAQAB
AoGAZT944gZo+bynvH17JhEk/nFxA19VLjj6kSH6AFPmkQcMN2pjeIU/Hhq3k0Cg
QTzYEy4wAMwzcFME7OC5c14c6GsnOQVEbzT3jA5lNuMnrvb+ehyE0w/O7ah8sSLQ
3B42GFKkaKiuY2ufsVC4pv6LMn5Sh26ApW332yO0dXZXagECQQDvAWV+n41R9pUp
iB0+ycBvkuE6yjlohc2MqAxdD+EYNgO4jb1F21pZcqasd/SbpiQwVUKk/uxlOvl9
3dBlcOWbAkEA4eiMv8UiGwBxjBGrz+I/tBq56gcnjvlOkJFyAyxbKaA1C9C51eVv
39OftI9DqCzcuAYZsCmspb6XEPBIB01VAQJAZVyAQM1Fz+b1p6F0VbaWiDsQjjBJ
XIyyed6jL6yWWABAX7qs9L1sedbn3OkashAp9N2T4AnFE8GJIdo6kWrp1QJAGOiF
LFfWDNgdrO393av6jicsPIuRZwhCC1qeEY+AdbR+ZNEczGLB1RIGV+g7830O0ROL
HYtax+Od0HZN2tBCAQJBANIg+HO5+Qy5hgRO3+uRHERgUQxqHzheLdo5GnoQ/sfT
sex4mxgze6oq+HldvNWzVjBu9g9417T5WMgyWQ8Unhw=
-----END RSA PRIVATE KEY-----';

// 公钥
$public_key = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDS6VbgEpOwVc8jXYx/uL6ItMS6
aBPVo8fvw0pd90jLJYvfJcFJdYVFh6JPRdpGhlIrED45VdsktcJvJj0cLNI5ZIZ6
80aS6JTFe3ScBY4Mi7bLKzBNYtMBtnkAFbMmWlCXV4qzZYg8+xNktY5ClZZCvZzz
laU5djtUSoxTLkxcmwIDAQAB
-----END PUBLIC KEY-----';

//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
$pi_key = openssl_pkey_get_private($private_key);

//这个函数可用来判断公钥是否是可用的
$pu_key = openssl_pkey_get_public($public_key);//这个函数可用来判断公钥是否是可用的

print_r($pi_key);  echo "\n";
print_r($pu_key);  echo "\n";

// 原始数据
$data = 'liyi';
$encrypted = '';
$decrypted = '';

echo "source data:",$data,"\n";
echo "private key encrypt:\n";
echo "私钥加密，公钥解密：\n";

// 私钥加密
openssl_private_encrypt($data, $encrypted, $pi_key);
$encrypted = base64_encode($encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
echo $encrypted,"\n";

// 公钥解密
echo "public key decrypt:\n";
openssl_public_decrypt(base64_decode($encrypted),$decrypted,$pu_key);//私钥加密的内容通过公钥可用解密出来
echo $decrypted,"\n\n";

echo "公钥加密，私钥解密：\n";
//公钥加密
openssl_public_encrypt($data, $encrypted, $pu_key);
$encrypted = base64_encode($encrypted);
echo $encrypted,"\n";

// 私钥解密
echo "private key decrypt:\n";
openssl_private_decrypt(base64_decode($encrypted),$decrypted,$pi_key);//私钥解密
echo $decrypted,"\n";
