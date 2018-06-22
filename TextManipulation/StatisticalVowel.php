<?php
/**
 * 统计元音字母——输入一个字符串，统计处其中元音字母的数量。更复杂点的话统计出每个元音字母的数量。
 */

while (!feof(STDIN)) {
    $line = fread(STDIN, 1024);
    $line = str_replace(PHP_EOL, '', $line);
    echo statisVowels($line) . PHP_EOL;
}

function statisVowels($line)
{
    $vowels = array(
        'a' => 0,
        'e' => 0,
        'i' => 0,
        'o' => 0,
        'u' => 0
    );
    for ($i = 0; $i < strlen($line); $i++) {
        if (key_exists($line[$i], $vowels)) {
            $vowels[$line[$i]]++;
        }
    }
    $sum = array_sum($vowels);
    $str = "sum:$sum ";
    foreach ($vowels as $key => $value) {
        $str .= "$key : $value ";
    }
    return $str;
}