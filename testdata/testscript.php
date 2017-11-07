<?php
use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Nodes;
use Hurl\Node\Statics\Strings;

include __DIR__ . '/../vendor/autoload.php';

$fromJson = Nodes::fromJson();
$getData = Nodes::init(function ($data) {
    return $data['data'];
});
$fileContent = Nodes::init(function ($path) {
    return file_get_contents($path);
});
function mapKeyValue()
{
    return Arrays::reduce([], function ($a, $data) {
        $value = $data['value'];
        $key = $data['key'];
        if (is_string($value)) {
            $value = trim($value);
        }
        if (is_string($key)) {
            $key = $key === '' ? 'info' : ($key === ' ' ? 'referenz' : $key);
            $key = str_replace(':', '', ucfirst(trim($key)));
        } else {
            $key = 'e';
        }
        $a[$key] = $value;
        return $a;
    });
}

$mapProduct = Nodes::init(function ($data) {
    $reduceData = mapKeyValue();
    $reduceNuts = mapKeyValue();
    $explodeAndTrim = Strings::explode('-')->map(Strings::trim());
    $p = $reduceData($data['data']) + ['nutritions' => $reduceNuts($data['nutritions'])] + ['tags' => $data['tags']];
    $p['ProductDetailsName'] = $explodeAndTrim($p['ProductDetailsName']);
    $p['Producer'] = $p['ProductDetailsName'][0];
    $p['ProductName'] = $p['ProductDetailsName'][1];
    $p['ProductQuantity'] = $p['ProductDetailsName'][2];


    return \Hurl\GenericObject::init($p);
});
$debugEach = Arrays::each(Nodes::debug());

$action = $fileContent
    ->then($fromJson)
    ->then($getData)
    ->then(Arrays::map($mapProduct)->filter(function ($e) { return !empty($e->tags);}))
    ->then($debugEach);


$action(__DIR__ . '/products_2.json');