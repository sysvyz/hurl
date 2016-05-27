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





$sort = Node::ARRAY()->sort(function ($a,$b){
    return $a-$b;
});
var_dump($sort([2,5,3,4,1]));
//array(5) {
//  [0]=>
//  int(1)
//  [1]=>
//  int(2)
//  [2]=>
//  int(3)
//  [3]=>
//  int(4)
//  [4]=>
//  int(5)
//}
