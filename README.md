# Hurl

Hurl is a language wrapper, which allows to build complex functions and concatenate them.

## Installation

You will need ``composer``

Clone the repo.

``composer install``

## Usage

### Creating Nodes
A Node is basically wrapper for ``function``s or  ``Closure``s if you like.
Like functions Nodes have inputs(parameters) and a output.

```php

$fromHex = Node::call(function ($data) {
    return hexdec($data);
});
var_dump($fromHex('a'));
        
//int(10)

```

### Build-in transformations
Nodes are transformation rules. There are several build-in php functions wrapped as Node
```php


$explode = Node::explode('.');
var_dump($explode('a.b'));
//array(2) {
//  [0]=>
//  string(1) "a"
//  [1]=>
//  string(1) "b"
//}


```


### Chained transformations
Nodes can be chained to perform multiple consecutive transformations

```php


$chain = $explode->implode('-');
var_dump($chain('a.b'));
//string(3) "a-b"

```



### Map
One of the most common transformation is ``array_map``. Node provides a convenient way of performing those operations.
Since the ``callback`` function of ``array_map`` is nothing else than a transformation, it's obvious to use Nodes as callbacks.


```php


$map = $explode->map($fromHex)->implode('.');
var_dump($map('a.b'));
//string(5) "10.11"

```



### Sort

```php


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

```