<?php
/**
 * CD-Key生成器——利用某种算法生成一个唯一的key。软件开发者可以用它来作为软件的激活器。
 */

for ($i = 0; $i < 10; $i++) {
    echo base64_encode(openssl_random_pseudo_bytes(32)) . "\n";
}