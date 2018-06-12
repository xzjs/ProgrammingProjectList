<?php
/**
 * 逆转字符串——输入一个字符串，将其逆转并输出
 */

while (!feof(STDIN)) {
    $line = fread(STDIN, 1024);
    $line = str_replace(PHP_EOL, '', $line);
    echo reverse($line) . PHP_EOL;
}

function reverse($str)
{
    $middle = floor(strlen($str) / 2);
    $length = strlen($str) - 1;
    for ($i = 0; $i < $middle; $i++) {
        $tmp = $str[$i];
        $str[$i] = $str[$length - $i];
        $str[$length - $i] = $tmp;
    }
    return $str;
}
