<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 17:40
 */

namespace Hurl\Node\Statics;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Arrays\ArrayEach;
use Hurl\Node\Arrays\ArrayReduce;
use Hurl\Node\Arrays\StringExplode;
use Hurl\Node\Arrays\ArrayFilter;
use Hurl\Node\Arrays\ArrayFold;
use Hurl\Node\Arrays\ArrayMap;
use Hurl\Node\Arrays\ArrayMerge;
use Hurl\Node\Arrays\ArrayRecursiveMerge;
use Hurl\Node\Arrays\ArraySort;
use Hurl\Node\Arrays\ArrayStableSort;
use Hurl\Node\Arrays\ArrayValues;
use Hurl\Node\Filters\IsEmptyFilter;
use Hurl\Node\Interfaces\Traits\ContainerTraitInterface;
use Hurl\Node\Strings\ArrayImplode;
use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Traits\ArrayTrait;
use Hurl\Node\Traits\FilterTrait;

abstract class Arrays
{

    /**
     * _Array constructor.
     * @codeCoverageIgnore
     */
    private final function __construct()
    {
    }

    /**
     * @param callable $mapping
     * @return ArrayMap
     */
    public static function map(callable $mapping = null)
    {
        return new ArrayMap($mapping);
    }

    /**
     * @param $init
     * @param callable $callable
     * @return ArrayReduce
     */
    public static function reduce($init, callable $callable = null)
    {
        return new ArrayReduce($init, $callable);
    }

    /**
     * @return AbstractNode
     */
    public static function length()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return count($data[0]);
            }
        };
    }


    /**
     * @param callable[] $callable
     * @return ArraySort
     */
    public static function sort(callable ...$callable)
    {
        return new ArraySort(...$callable);
    }

    /**
     * @param callable[] $callable
     * @return ArraySort
     */
    public static function stableSort(callable ...$callable)
    {
        return new ArrayStableSort(...$callable);
    }

    /**
     * @param callable $callable
     * @return ArrayFilter
     */
    public static function filter(callable $callable = null)
    {
        return new ArrayFilter($callable);
    }

    /**
     * @param $do
     * @return ArrayEach
     */
    public static function each(callable $do)
    {
        return new ArrayEach($do);
    }

    /**
     * @param $delimiter
     * @return CollectionNodeInterface
     */
    public static function explode($delimiter)
    {
        return new class($delimiter) extends StringExplode
        {
        };

    }


    /**
     * @param $glue
     * @return AbstractStringNode
     */
    public static function implode($glue)
    {
        return new ArrayImplode($glue);
    }

    /**
     * @return ArrayMerge
     */
    public static function merge()
    {
        return new ArrayMerge();
    }

    /**
     * @return ArrayValues
     */
    public static function values()
    {
        return new class() extends ArrayValues
        {
            use ArrayTrait;
        };
    }

    /**
     * @return IsEmptyFilter
     */
    public static function isEmpty()
    {
        return new class() extends IsEmptyFilter
        {
            use FilterTrait;
        };
    }


    /**
     * @return CollectionNodeInterface
     */
    public static function recursiveMerge()
    {
        return new ArrayRecursiveMerge();
    }
}
