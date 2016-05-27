<?php


use Hurl\Node;

require_once __DIR__ . '/vendor/autoload.php';

$fromHex = Node::call(function ($data) {
    return hexdec($data);
});
var_dump($fromHex('a'));
//int(10)



$explode = Node::explode('.');
var_dump($explode('a.b'));

$chain = $explode->implode('-');
var_dump($chain('a.b'));



$map = $explode->map($fromHex)->implode('.');
var_dump($map('a.b'));