<?php
/**
 * 密码短信——可以将数据加密解密，并能将其发送给朋友。
 */

$message = '我爱中国共产党，天安门上放光芒';
$key = 'i love you';
$method = 'aes-128-cbc';
$message_encrypt = openssl_encrypt($message, $method, $key);
echo $message_encrypt . "\n";
$message = openssl_decrypt($message_encrypt, $method, $key);
echo $message . "\n";