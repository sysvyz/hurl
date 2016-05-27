<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 04:09
 */

namespace Hurl;


class StringNode
{


    /**
     * @return AbstractNode
     */
    public static function trim()
    {
        return new class() extends AbstractNode
        {
            public function __invoke($data)
            {
                return trim($data);

            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function ltrim()
    {
        return new class() extends AbstractNode
        {
            public function __invoke($data)
            {
                return ltrim($data);

            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function rtrim()
    {
        return new class() extends AbstractNode
        {
            public function __invoke($data)
            {
                return rtrim($data);

            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function ucfirst()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return ucfirst($data[0]);

            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function lcfirst()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return lcfirst($data[0]);

            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function upper_case()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return strtoupper($data[0]);

            }
        };
    }

    /**
     * @return AbstractNode
     */
    public static function lower_case()
    {
        return new class() extends AbstractNode
        {
            public function __invoke(...$data)
            {
                return strtolower($data[0]);
            }
        };
    }

    public static function implode($glue)
    {
        return ArrayNode::implode($glue);
    }

    public static function explode($delimiter)
    {
        return ArrayNode::explode($delimiter);
    }


    /**
     * @param $glue
     * @return AbstractNode
     */
    public static function substring($start, $length = null)
    {
        return new class($start, $length) extends AbstractNode
        {
            private $start;
            private $length;

            /**
             *  constructor.
             * @param $start
             * @param $length
             */
            public function __construct($start, $length)
            {
                $this->start = $start;
                $this->length = $length;
            }

            public function __invoke(...$data)
            {
                return substr($data[0], $this->start, $this->length);
            }
        };
    }
}