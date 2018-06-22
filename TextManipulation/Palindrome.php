<?php
/**
 * 判断是否为回文——判断用户输入的字符串是否为回文。回文是指正反拼写形式都是一样的词，譬如“racecar”。
 */

while (!feof(STDIN)) {
    $line = fread(STDIN, 1024);
    $line = str_replace(PHP_EOL, '', $line);
    echo palindrome($line) . PHP_EOL;
}

function palindrome($line)
{
    $result = $line == strrev($line);
    return $result ? 'true' : 'false';
}