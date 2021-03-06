<?php


use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Comparators;
use Hurl\Node\Statics\Nodes;
use Hurl\Node\Statics\Strings;

require_once __DIR__ . '/vendor/autoload.php';

$fromHex = Nodes::init(function ($data) {
	return hexdec($data);
});
var_dump($fromHex('a'));
//int(10)


$explode = Strings::explode('.');
var_dump($explode('a.b'));

$chain = $explode->implode('-');
var_dump($chain('a.b'));


$map = $explode->map($fromHex)->implode('.');
var_dump($map('a.b'));


$sort = Arrays::sort(function ($a, $b) {
	return $a - $b;
});
var_dump($sort([2, 5, 3, 4, 1]));
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


$string = 'a,3,e,22,a2,3e0,cf';
$explodeHexString = Arrays::explode(',')->map(
	Strings::trim()->then($fromHex)
)->sort(Comparators::numeric());
print_r($explodeHexString($string));


$string = 'a,3,e,22,a2,3e0,cf';
$explodeHexString =
	Arrays::explode(',')
		->sort(
			Comparators::boolean()
				->map(
					Strings::trim()
						->then($fromHex)
						->then(function ($e) {
							return $e % 5;
						})
				)
			,
			Comparators::numeric()->map(
				Strings::trim()
					->then($fromHex)
			)
		);

print_r($explodeHexString($string));