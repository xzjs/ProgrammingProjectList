<?php
/**
 * 拉丁猪文字游戏——这是一个英语语言游戏。基本规则是将一个英语单词的第一个辅音音素的字母移动到词尾并且加上后缀-ay
 * （譬如“banana”会变成“anana-bay”）。可以在维基百科上了解更多内容
 */

while (!feof(STDIN)) {
    $line = fread(STDIN, 1024);
    $line = str_replace(PHP_EOL, '', $line);
    echo latinPig($line) . PHP_EOL;
}

function latinPig($line)
{
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    for ($i = 0; $i < strlen($line); $i++) {
        if (!in_array($line[$i], $vowels)) {
            $consonant = $line[$i];
            break;
        }
    }
    return substr($line, 0, $i) . substr($line, $i + 1) . '-' . $consonant . 'ay';
}