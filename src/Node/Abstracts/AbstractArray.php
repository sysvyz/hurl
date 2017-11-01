<?php

namespace Hurl\Node\Abstracts;

use Hurl\Node\Arrays\ArrayEach;
use Hurl\Node\Arrays\ArrayMap;
use Hurl\Node\Arrays\ArrayMerge;
use Hurl\Node\Arrays\ArrayReduce;
use Hurl\Node\Arrays\ArraySort;
use Hurl\Node\Filters\ContainsFilter;
use Hurl\Node\Filters\IsEmptyFilter;
use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Interfaces\Traits\ContainerTraitInterface;
use Hurl\Node\Math\Math;
use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Filters;
use Hurl\Node\Strings\ArrayImplode;
use Hurl\Node\Traits\ContainerTrait;

abstract class AbstractArray extends AbstractNode implements CollectionNodeInterface
{

    /**
     * @param callable $do
     * @return AbstractNode
     */
    public function then(callable $do)
    {
        $_new_node = new class($this, $do) extends AbstractArray implements ContainerTraitInterface
        {
            use ContainerTrait;
        };
        return $_new_node;
    }

    /**
     * @param callable $do
     * @return ArrayEach
     */
    public function each(callable $do)
    {
        $_new_node = new class($this, Arrays::each($do)) extends ArrayEach implements ContainerTraitInterface, CollectionNodeInterface
        {
            use ContainerTrait;
        };
        return $_new_node;
    }

    /**
     * @param $init
     * @param callable $do
     * @return ArrayReduce
     */
    public function reduce($init, callable $do)
    {
        $_new_node = new class($this, Arrays::reduce($init, $do)) extends ArrayReduce implements ContainerTraitInterface, CollectionNodeInterface
        {
            use ContainerTrait;
        };
        return $_new_node;
    }

    /**
     * @param callable $callable
     * @return ArrayMap
     */
    public function map(callable $callable)
    {
        $_new_node = new class($this, Arrays::map($callable)) extends ArrayMap implements ContainerTraitInterface, CollectionNodeInterface
        {
            use ContainerTrait;
        };
        return $_new_node;

    }


    /**
     * @param \callable[] ...$callable
     * @return ArraySort
     */
    public function sort(callable ...$callable)
    {
        $_new_node = new class($this, Arrays::sort(...$callable)) extends ArraySort implements ContainerTraitInterface, CollectionNodeInterface
        {
            use ContainerTrait;
        };
        return $_new_node;
    }

    /**
     * @return ArrayMerge
     */
    public function merge()
    {
        $_new_node = new class($this, Arrays::merge()) extends ArrayMerge implements ContainerTraitInterface, CollectionNodeInterface
        {
            use ContainerTrait;
        };
        return $_new_node;

    }

    /**
     * @return AbstractNode
     */
    public function sum()
    {
        $_new_node = new class($this, Math::sum()) extends AbstractNode implements ContainerTraitInterface
        {
            use ContainerTrait;
        };
        return $_new_node;
    }

    /**
     * @return AbstractArray
     */
    public function values()
    {
        $_new_node = new class($this, Arrays::values()) extends AbstractArray implements ContainerTraitInterface
        {
            use ContainerTrait;
        };
        return $_new_node;
    }

    /**
     * @param string $glue
     * @return AbstractNode
     */
    public function implode(string $glue)
    {

        $_new_node = new class($this, Arrays::implode($glue)) extends ArrayImplode implements ContainerTraitInterface
        {
            use ContainerTrait;
        };
        return $_new_node;
    }

    /**
     * @return IsEmptyFilter
     */
    public function isEmpty()
    {

        $_new_node = new class($this, Filters::isEmpty()) extends IsEmptyFilter implements ContainerTraitInterface
        {
            use ContainerTrait;
        };
        return $_new_node;

    }

    /**
     * @return ContainsFilter
     */
    public function contains($needle, $strict = null)
    {

        $_new_node = new class($this, Filters::contains($needle, $strict)) extends ContainsFilter implements ContainerTraitInterface
        {
            use ContainerTrait;
        };
        return $_new_node;

    }
}