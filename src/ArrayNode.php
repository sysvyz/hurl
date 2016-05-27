<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 17:40
 */

namespace Hurl;


class ArrayNode
{
    /**
     * @param callable $mapping
     * @return AbstractNode
     */
    public static function map(callable $mapping = null)
    {
        return new class($mapping) extends AbstractNode
        {
            private $mapping;

            public function __construct($mapping)
            {
                $this->mapping = $mapping;
            }

            public function __invoke(...$data)
            {
                return array_map($this->mapping, ...$data);
            }
        };
    }

    /**
     * @param callable $callable
     * @return AbstractNode
     */
    public static function fold(callable $callable, $init = null)
    {
        return new class($callable, $init) extends AbstractNode
        {
            /**
             * @var callable
             */
            private $callable;
            /**
             * @var
             */
            private $init;

            /**
             *  constructor.
             * @param $callable
             * @param $init
             */
            public function __construct(callable $callable, $init)
            {
                $this->callable = $callable;
                $this->init = $init;
            }

            public function __invoke(...$data)
            {
                return array_reduce($data[0], $this->callable, $this->init);
            }
        };
    }

    /**
     * @param callable $callable
     * @return AbstractNode
     */
    public static function sort(callable $callable)
    {
        return new class($callable) extends AbstractNode
        {
            /**
             * @var callable
             */
            private $callable;


            /**
             *  constructor.
             * @param $callable
             */
            public function __construct(callable $callable)
            {
                $this->callable = $callable;
            }

            public function __invoke(...$data)
            {

                usort($data[0], $this->callable);
                return $data[0];
            }
        };
    }

    /**
     * @param $delimiter
     * @return AbstractNode
     */
    public static function each(callable $do)
    {
        return new class($do) extends AbstractNode
        {
            private $do;

            public function __construct($do)
            {
                $this->do = $do;
            }

            public function __invoke(...$data)
            {
                array_walk($data[0], $this->do);
                return $data;
            }
        };
    }


    /**
     * @param $delimiter
     * @return AbstractNode
     */
    public static function explode($delimiter)
    {
        return new class($delimiter) extends AbstractNode
        {
            private $delimiter;

            public function __construct($delimiter)
            {
                $this->delimiter = $delimiter;
            }

            public function __invoke(...$data)
            {
                return explode($this->delimiter, $data[0]);

            }
        };
    }

    /**
     * @param $glue
     * @return AbstractNode
     */
    public static function implode($glue)
    {
        return new class($glue) extends AbstractNode
        {
            private $glue;

            public function __construct($glue)
            {
                $this->glue = $glue;
            }

            public function __invoke(...$data)
            {
                return implode($this->glue, $data[0]);
            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function merge()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return _mergeRecursive(...$data);
            }
        };
    }
}

function _mergeRecursive(...$data)
{
    $r = array_map(function ($elem) {
        if (is_array($elem)) {
            return _mergeRecursive(... $elem);
        }
        return [$elem];
    }, $data);
    return array_merge(...$r);
}