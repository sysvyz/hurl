<?php namespace Hurl\Node\Interfaces;

use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Arrays\ArrayEach;
use Hurl\Node\Arrays\ArrayMap;
use Hurl\Node\Arrays\ArraySort;

interface CollectionNodeInterface extends NodeInterface
{

    public function __invoke(... $args);

    /**
     * @param callable $do
     * @return AbstractNode
     */
    public function then(callable $do);

    /**
     * @param callable $do
     * @return ArrayEach
     */
    public function each(callable $do);

    /**
     * @param $init
     * @param callable $do
     * @return ArrayEach
     */
    public function reduce($init, callable $do);

    /**
     * @param callable $callable
     * @return ArrayMap
     */
    public function map(callable $callable);

    /**
     * @param \callable[] ...$callable
     * @return ArraySort
     */
    public function sort(callable ...$callable);

    /**
     * @return ArraySort
     */
    public function merge();

    /**
     * @return ArraySort
     */
    public function values();

    /**
     * @return AbstractNode
     */
    public function debug();

    /**
     * @param string $glue
     * @return AbstractNode
     */
    public function implode(string $glue);

    /**
     * @return AbstractNode
     */
    public function toJson();
}