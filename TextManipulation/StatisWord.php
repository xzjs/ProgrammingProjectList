<?php
/**
 * 统计字符串中的单词数目——统计字符串中单词的数目，更复杂的话从一个文本中读出字符串并生成单词数目统计结果。
 */

function statisWord($line)
{
    preg_match_all('/[a-zA-Z]+/', $line, $out);
    print_r($out);
}

statisWord('Hello World. I am hero!');